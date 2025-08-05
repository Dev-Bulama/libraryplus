<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ai_model extends CI_Model
{
    private $openai_api_key = ''; // Set your OpenAI API key here
    private $api_url = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('book_m');
        
        // Get API key from config or database
        $this->openai_api_key = $this->get_setting('openai_api_key');
    }

    /**
     * Intelligent book search using AI
     */
    public function intelligent_search($query)
    {
        // First, get all books from database
        $all_books = $this->get_all_books_for_ai();
        
        if (empty($all_books)) {
            return [];
        }

        // Use AI to understand user intent and find relevant books
        $search_results = $this->ai_powered_search($query, $all_books);
        
        return $search_results;
    }

    /**
     * Get personalized book recommendations
     */
    public function get_recommendations($user_id = null, $preferences = '')
    {
        $user_history = $this->get_user_reading_history($user_id);
        $all_books = $this->get_all_books_for_ai();
        
        $prompt = $this->build_recommendation_prompt($user_history, $preferences, $all_books);
        
        $ai_response = $this->call_openai_api($prompt);
        
        return $this->parse_recommendation_response($ai_response);
    }

    /**
     * AI Chat Response
     */
    public function chat_response($message, $context = '')
    {
        $books_context = $this->get_books_context();
        
        $prompt = "You are a helpful library assistant AI. You help users find books and answer questions about the library.

Available books context: " . $books_context . "

User question: " . $message . "

Previous context: " . $context . "

Please provide a helpful, friendly response. If the user is asking for book recommendations, suggest specific books from the available collection with reasons why they might like them.";

        return $this->call_openai_api($prompt);
    }

    /**
     * Train AI model with new data
     */
    public function train_model($training_data)
    {
        // Store training data in database for future use
        $this->db->insert('ai_training_data', [
            'data' => json_encode($training_data),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Update AI knowledge base
        $this->update_ai_knowledge_base();

        return [
            'status' => 'success',
            'message' => 'Training data processed and stored'
        ];
    }

    /**
     * Get AI usage analytics
     */
    public function get_analytics()
    {
        // Search analytics
        $search_stats = $this->db->query("
            SELECT DATE(created_at) as date, COUNT(*) as searches 
            FROM ai_search_logs 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY DATE(created_at)
            ORDER BY date DESC
        ")->result_array();

        // Popular search terms
        $popular_terms = $this->db->query("
            SELECT search_query, COUNT(*) as count 
            FROM ai_search_logs 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY search_query 
            ORDER BY count DESC 
            LIMIT 10
        ")->result_array();

        // Recommendation stats
        $recommendation_stats = $this->db->query("
            SELECT COUNT(*) as total_recommendations,
                   AVG(rating) as avg_rating
            FROM ai_recommendations 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        ")->row_array();

        return [
            'search_stats' => $search_stats,
            'popular_terms' => $popular_terms,
            'recommendation_stats' => $recommendation_stats
        ];
    }

    /**
     * Private helper methods
     */
    private function get_all_books_for_ai()
    {
        $query = $this->db->select('b.*, bc.name as category_name')
                          ->from('book b')
                          ->join('bookcategory bc', 'b.bookcategoryID = bc.bookcategoryID', 'left')
                          ->where('b.status', 0)
                          ->where('b.deleted_at', 0)
                          ->get();
        
        return $query->result_array();
    }

    private function ai_powered_search($query, $books)
    {
        // Log the search
        $this->log_search($query);

        // Create a simplified book list for AI
        $book_summaries = array_map(function($book) {
            return sprintf(
                "ID: %d, Title: %s, Author: %s, Category: %s, Publisher: %s",
                $book['bookID'],
                $book['name'],
                $book['author'],
                $book['category_name'] ?? 'Unknown',
                $book['publisher']
            );
        }, array_slice($books, 0, 50)); // Limit to prevent API limits

        $prompt = "You are a library search AI. Based on the user's search query, find the most relevant books from this collection.

User query: \"$query\"

Available books:
" . implode("\n", $book_summaries) . "

Return only the book IDs of the most relevant books (up to 10), separated by commas. Consider the user's intent, not just exact keyword matches.";

        $ai_response = $this->call_openai_api($prompt);
        
        return $this->parse_search_response($ai_response, $books);
    }

    private function call_openai_api($prompt)
    {
        if (empty($this->openai_api_key)) {
            // Fallback to simple keyword search if no API key
            return $this->fallback_search($prompt);
        }

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->openai_api_key
        ]);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'max_tokens' => 500,
            'temperature' => 0.7
        ]));
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode !== 200) {
            throw new Exception('AI API request failed');
        }
        
        $decoded = json_decode($response, true);
        return $decoded['choices'][0]['message']['content'] ?? '';
    }

    private function fallback_search($query)
    {
        // Simple keyword-based search as fallback
        return "I'm currently operating in basic mode. Please configure the AI API key for enhanced intelligent search.";
    }

    private function parse_search_response($ai_response, $books)
    {
        // Extract book IDs from AI response
        preg_match_all('/\d+/', $ai_response, $matches);
        $book_ids = array_map('intval', $matches[0]);
        
        // Get full book details for the recommended IDs
        $results = [];
        foreach ($books as $book) {
            if (in_array($book['bookID'], $book_ids)) {
                $results[] = $book;
            }
        }
        
        return $results;
    }

    private function get_user_reading_history($user_id)
    {
        if (!$user_id) {
            return [];
        }

        return $this->db->select('b.name, b.author, bc.name as category')
                       ->from('bookissue bi')
                       ->join('book b', 'bi.bookID = b.bookID')
                       ->join('bookcategory bc', 'b.bookcategoryID = bc.bookcategoryID', 'left')
                       ->where('bi.memberID', $user_id)
                       ->limit(10)
                       ->get()
                       ->result_array();
    }

    private function build_recommendation_prompt($history, $preferences, $books)
    {
        $history_text = '';
        if (!empty($history)) {
            $history_text = "User's reading history:\n";
            foreach ($history as $book) {
                $history_text .= "- {$book['name']} by {$book['author']} ({$book['category']})\n";
            }
        }

        $book_list = '';
        foreach (array_slice($books, 0, 30) as $book) {
            $book_list .= sprintf(
                "- %s by %s (%s)\n",
                $book['name'],
                $book['author'],
                $book['category_name'] ?? 'Unknown'
            );
        }

        return "Based on the user's reading history and preferences, recommend 5 books from the available collection.

{$history_text}

User preferences: {$preferences}

Available books:
{$book_list}

Provide recommendations with brief explanations why each book would be a good fit.";
    }

    private function parse_recommendation_response($ai_response)
    {
        // Parse AI response and format for frontend
        return [
            'recommendations' => $ai_response,
            'generated_at' => date('Y-m-d H:i:s')
        ];
    }

    private function get_books_context()
    {
        $books = $this->get_all_books_for_ai();
        $context = "Library has " . count($books) . " books available including:\n";
        
        foreach (array_slice($books, 0, 10) as $book) {
            $context .= "- {$book['name']} by {$book['author']}\n";
        }
        
        return $context;
    }

    private function log_search($query)
    {
        $this->db->insert('ai_search_logs', [
            'search_query' => $query,
            'user_id' => $this->session->userdata('loginmemberID'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    private function get_setting($key)
    {
        $setting = $this->db->where('optionkey', $key)
                           ->get('generalsetting')
                           ->row();
        
        return $setting ? $setting->optionvalue : '';
    }

    private function update_ai_knowledge_base()
    {
        // This would update the AI's knowledge base with new training data
        // Implementation depends on specific AI service being used
        return true;
    }
}