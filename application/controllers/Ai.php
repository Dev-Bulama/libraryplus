<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('book_m');
        $this->load->model('ai_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    /**
     * AI Search API Endpoint
     */
    public function search()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $query = $this->input->post('query', TRUE);
        if (empty($query)) {
            echo json_encode(['error' => 'Query cannot be empty']);
            return;
        }

        try {
            // Get AI-powered search results
            $results = $this->ai_model->intelligent_search($query);
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'query' => $query,
                'results' => $results,
                'total' => count($results)
            ]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'error' => 'Search failed: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get book recommendations for user
     */
    public function recommend()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $user_id = $this->input->post('user_id', TRUE);
        $preferences = $this->input->post('preferences', TRUE);
        
        try {
            $recommendations = $this->ai_model->get_recommendations($user_id, $preferences);
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'recommendations' => $recommendations
            ]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'error' => 'Recommendation failed: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Chat with AI Assistant
     */
    public function chat()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $message = $this->input->post('message', TRUE);
        $context = $this->input->post('context', TRUE);
        
        try {
            $response = $this->ai_model->chat_response($message, $context);
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'response' => $response,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'error' => 'Chat failed: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Train AI with new data (Admin only)
     */
    public function train()
    {
        // Check if user is admin
        if (!$this->session->userdata('roleID') || $this->session->userdata('roleID') != 1) {
            show_404();
        }

        if ($this->input->method() !== 'post') {
            show_404();
        }

        $training_data = $this->input->post('training_data', TRUE);
        
        try {
            $result = $this->ai_model->train_model($training_data);
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'AI training completed successfully',
                'details' => $result
            ]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'error' => 'Training failed: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get AI analytics (Admin only)
     */
    public function analytics()
    {
        if (!$this->session->userdata('roleID') || $this->session->userdata('roleID') != 1) {
            show_404();
        }

        try {
            $analytics = $this->ai_model->get_analytics();
            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'analytics' => $analytics
            ]);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'error' => 'Analytics failed: ' . $e->getMessage()
            ]);
        }
    }
}