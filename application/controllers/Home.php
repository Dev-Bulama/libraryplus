<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('book_m');
        $this->load->model('bookcategory_m');
        $this->load->model('generalsetting_m');
        $this->load->helper(['url', 'html']);
        $this->load->library('session');
    }

    /**
     * Main Landing Page with AI Features
     */
    public function index()
    {
        // Check if system is installed
        if (config_item('installed') == 'NO') {
            redirect('install');
            return;
        }

        // Get general settings for site info
        $this->data['generalsetting'] = $this->generalsetting_m->get_generalsetting();
        
        // Get site name for title
        $sitename = 'LibraryPlus';
        if (!empty($this->data['generalsetting'])) {
            foreach ($this->data['generalsetting'] as $setting) {
                if ($setting->optionkey == 'sitename') {
                    $sitename = $setting->optionvalue;
                    break;
                }
            }
        }
        
        // Set page data
        $this->data['page_title'] = $sitename . ' - AI-Powered Book Discovery Platform';
        $this->data['meta_description'] = 'Discover your next favorite book with our AI-powered library management system. Smart search, personalized recommendations, and intelligent book discovery.';
        
        // Get featured books for stats (optional)
        $this->data['total_books'] = $this->get_total_books();
        $this->data['total_categories'] = $this->get_total_categories();
        
        // Check if user is logged in
        $this->data['is_logged_in'] = $this->session->userdata('loggedin') ? true : false;
        $this->data['user_name'] = $this->session->userdata('name') ?? '';
        
        // Load the landing page view
        $this->load->view('landing', $this->data);
    }

    /**
     * Get total number of available books
     */
    private function get_total_books()
    {
        try {
            return $this->db->where('status', 0)
                           ->where('deleted_at', 0)
                           ->count_all_results('book');
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Get total number of book categories
     */
    private function get_total_categories()
    {
        try {
            return $this->db->where('status', 1)
                           ->count_all_results('bookcategory');
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Quick search functionality for AJAX requests
     */
    public function quick_search()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $query = $this->input->post('query', TRUE);
        
        if (empty($query) || strlen($query) < 2) {
            echo json_encode([]);
            return;
        }

        try {
            // Get quick search results
            $results = $this->db->select('bookID, name as title, author, "book" as type')
                               ->from('book')
                               ->where('status', 0)
                               ->where('deleted_at', 0)
                               ->group_start()
                                   ->like('name', $query)
                                   ->or_like('author', $query)
                               ->group_end()
                               ->limit(5)
                               ->get()
                               ->result_array();

            // Add author suggestions
            $authors = $this->db->select('DISTINCT author as title, "author" as type')
                               ->from('book')
                               ->where('status', 0)
                               ->where('deleted_at', 0)
                               ->like('author', $query)
                               ->limit(3)
                               ->get()
                               ->result_array();

            $all_results = array_merge($results, $authors);
            
            header('Content-Type: application/json');
            echo json_encode($all_results);
            
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode([]);
        }
    }

    /**
     * Get popular search terms for suggestions
     */
    public function popular_searches()
    {
        // Return some popular search suggestions
        $suggestions = [
            'mystery novels',
            'science fiction',
            'romantic comedy',
            'books for rainy day',
            'award winning books',
            'fantasy adventure',
            'historical fiction',
            'self help books',
            'biography',
            'classic literature'
        ];

        header('Content-Type: application/json');
        echo json_encode($suggestions);
    }

    /**
     * Handle contact form submissions
     */
    public function contact()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $name = $this->input->post('name', TRUE);
        $email = $this->input->post('email', TRUE);
        $message = $this->input->post('message', TRUE);

        // Basic validation
        if (empty($name) || empty($email) || empty($message)) {
            echo json_encode([
                'success' => false,
                'message' => 'All fields are required.'
            ]);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid email address.'
            ]);
            return;
        }

        // Here you would typically save to database or send email
        // For now, just return success
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for your message. We will get back to you soon!'
        ]);
    }

    /**
     * About page
     */
    public function about()
    {
        $this->data['page_title'] = 'About LibraryPlus';
        $this->data['generalsetting'] = $this->generalsetting_m->get_generalsetting();
        
        $this->load->view('about', $this->data);
    }

    /**
     * Features page
     */
    public function features()
    {
        $this->data['page_title'] = 'Features - LibraryPlus';
        $this->data['generalsetting'] = $this->generalsetting_m->get_generalsetting();
        
        $this->load->view('features', $this->data);
    }

    /**
     * Privacy policy page
     */
    public function privacy()
    {
        $this->data['page_title'] = 'Privacy Policy - LibraryPlus';
        $this->data['generalsetting'] = $this->generalsetting_m->get_generalsetting();
        
        $this->load->view('privacy', $this->data);
    }

    /**
     * Terms of service page
     */
    public function terms()
    {
        $this->data['page_title'] = 'Terms of Service - LibraryPlus';
        $this->data['generalsetting'] = $this->generalsetting_m->get_generalsetting();
        
        $this->load->view('terms', $this->data);
    }
}