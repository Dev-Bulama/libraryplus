<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ai_training extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ai_model');
        $this->load->model('book_m');
        $this->load->library('upload');
        
        $lang = $this->session->userdata('language');
        $this->lang->load('ai_training', $lang);
    }

    /**
     * AI Training Dashboard
     */
    public function index()
    {
        if (!permissionChecker('ai_management')) {
            redirect(base_url('dashboard/index'));
        }

        $this->data['headerassets'] = [
            'css' => [
                'assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css',
                'assets/custom/css/ai-training.css'
            ],
            'headerjs' => [
                'assets/plugins/datatables.net/js/jquery.dataTables.min.js',
                'assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js'
            ],
            'js' => [
                'assets/custom/js/ai-training.js'
            ]
        ];

        // Get training statistics
        $this->data['training_stats'] = $this->get_training_stats();
        
        // Get recent training data
        $this->data['recent_training'] = $this->get_recent_training();
        
        // Get AI performance metrics
        $this->data['performance_metrics'] = $this->ai_model->get_analytics();

        $this->data["subview"] = "ai_training/index";
        $this->load->view('_main_layout', $this->data);
    }

    /**
     * Bulk Book Data Training
     */
    public function train_books()
    {
        if (!permissionChecker('ai_training')) {
            redirect(base_url('ai_training/index'));
        }

        if ($_POST) {
            $training_type = $this->input->post('training_type', TRUE);
            
            try {
                switch ($training_type) {
                    case 'all_books':
                        $result = $this->train_all_books();
                        break;
                    case 'categories':
                        $result = $this->train_categories();
                        break;
                    case 'tags':
                        $result = $this->train_book_tags();
                        break;
                    default:
                        throw new Exception('Invalid training type');
                }

                $this->session->set_flashdata('success', 'AI training completed successfully: ' . $result['message']);
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Training failed: ' . $e->getMessage());
            }

            redirect(base_url('ai_training/index'));
        }

        $this->data['headerassets'] = [
            'css' => ['assets/custom/css/ai-training.css'],
            'js' => ['assets/custom/js/ai-training.js']
        ];

        $this->data['total_books'] = $this->book_m->count_books();
        $this->data['total_categories'] = $this->count_categories();
        
        $this->data["subview"] = "ai_training/train_books";
        $this->load->view('_main_layout', $this->data);
    }

    /**
     * Upload Training Data
     */
    public function upload_training_data()
    {
        if (!permissionChecker('ai_training')) {
            redirect(base_url('ai_training/index'));
        }

        if ($_POST && $_FILES) {
            $config['upload_path'] = './uploads/ai_training/';
            $config['allowed_types'] = 'csv|json|txt';
            $config['max_size'] = 10240; // 10MB
            $config['file_name'] = 'training_' . time();

            // Create upload directory if it doesn't exist
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            $this->upload->initialize($config);

            if ($this->upload->do_upload('training_file')) {
                $upload_data = $this->upload->data();
                
                try {
                    $result = $this->process_uploaded_training_data($upload_data);
                    $this->session->set_flashdata('success', 'Training data uploaded and processed successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('error', 'Failed to process training data: ' . $e->getMessage());
                    // Clean up uploaded file
                    unlink($upload_data['full_path']);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            }

            redirect(base_url('ai_training/upload_training_data'));
        }

        $this->data['headerassets'] = [
            'css' => ['assets/custom/css/ai-training.css'],
            'js' => ['assets/custom/js/file-upload.js']
        ];

        $this->data["subview"] = "ai_training/upload_data";
        $this->load->view('_main_layout', $this->data);
    }

    /**
     * AI Settings Configuration
     */
    public function settings()
    {
        if (!permissionChecker('ai_management')) {
            redirect(base_url('ai_training/index'));
        }

        if ($_POST) {
            $settings = [
                'openai_api_key' => $this->input->post('openai_api_key', TRUE),
                'ai_enabled' => $this->input->post('ai_enabled', TRUE) ? '1' : '0',
                'ai_search_enabled' => $this->input->post('ai_search_enabled', TRUE) ? '1' : '0',
                'ai_recommendations_enabled' => $this->input->post('ai_recommendations_enabled', TRUE) ? '1' : '0',
                'ai_chat_enabled' => $this->input->post('ai_chat_enabled', TRUE) ? '1' : '0',
                'ai_model_version' => $this->input->post('ai_model_version', TRUE),
                'ai_max_search_results' => $this->input->post('ai_max_search_results', TRUE),
                'ai_recommendation_count' => $this->input->post('ai_recommendation_count', TRUE)
            ];

            try {
                $this->update_ai_settings($settings);
                $this->session->set_flashdata('success', 'AI settings updated successfully');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Failed to update settings: ' . $e->getMessage());
            }

            redirect(base_url('ai_training/settings'));
        }

        $this->data['settings'] = $this->get_ai_settings();
        $this->data["subview"] = "ai_training/settings";
        $this->load->view('_main_layout', $this->data);
    }

    /**
     * AI Analytics Dashboard
     */
    public function analytics()
    {
        if (!permissionChecker('ai_analytics')) {
            redirect(base_url('ai_training/index'));
        }

        $this->data['headerassets'] = [
            'css' => [
                'assets/plugins/chartjs/Chart.min.css',
                'assets/custom/css/ai-analytics.css'
            ],
            'headerjs' => [
                'assets/plugins/chartjs/Chart.min.js'
            ],
            'js' => [
                'assets/custom/js/ai-analytics.js'
            ]
        ];

        try {
            $this->data['analytics'] = $this->ai_model->get_analytics();
            $this->data['search_trends'] = $this->get_search_trends();
            $this->data['recommendation_stats'] = $this->get_recommendation_stats();
            $this->data['user_engagement'] = $this->get_user_engagement_stats();
        } catch (Exception $e) {
            $this->data['error'] = 'Failed to load analytics: ' . $e->getMessage();
        }

        $this->data["subview"] = "ai_training/analytics";
        $this->load->view('_main_layout', $this->data);
    }

    /**
     * Test AI Functionality
     */
    public function test_ai()
    {
        if (!permissionChecker('ai_management')) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $test_type = $this->input->post('test_type', TRUE);
            $test_query = $this->input->post('test_query', TRUE);

            try {
                switch ($test_type) {
                    case 'search':
                        $result = $this->ai_model->intelligent_search($test_query);
                        break;
                    case 'chat':
                        $result = $this->ai_model->chat_response($test_query);
                        break;
                    case 'recommendation':
                        $result = $this->ai_model->get_recommendations(null, $test_query);
                        break;
                    default:
                        throw new Exception('Invalid test type');
                }

                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'result' => $result,
                    'test_type' => $test_type,
                    'query' => $test_query
                ]);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        } else {
            show_404();
        }
    }

    /**
     * Private helper methods
     */
    private function train_all_books()
    {
        $books = $this->book_m->get_book();
        $training_data = [];

        foreach ($books as $book) {
            $training_data[] = [
                'id' => $book->bookID,
                'title' => $book->name,
                'author' => $book->author,
                'category' => $book->bookcategoryID,
                'publisher' => $book->publisher,
                'isbn' => $book->isbnno,
                'description' => $book->notes
            ];
        }

        $result = $this->ai_model->train_model([
            'type' => 'book_catalog',
            'data' => $training_data
        ]);

        return [
            'message' => count($training_data) . ' books processed for AI training',
            'details' => $result
        ];
    }

    private function train_categories()
    {
        $categories = $this->db->get('bookcategory')->result();
        $training_data = [];

        foreach ($categories as $category) {
            $training_data[] = [
                'id' => $category->bookcategoryID,
                'name' => $category->name,
                'description' => $category->description
            ];
        }

        return $this->ai_model->train_model([
            'type' => 'categories',
            'data' => $training_data
        ]);
    }

    private function train_book_tags()
    {
        // Auto-generate tags for books using AI
        $books = $this->book_m->get_book();
        $processed = 0;

        foreach ($books as $book) {
            // This would use AI to generate tags based on book title, author, and description
            $suggested_tags = $this->generate_book_tags($book);
            
            if (!empty($suggested_tags)) {
                $this->save_book_tags($book->bookID, $suggested_tags);
                $processed++;
            }
        }

        return [
            'message' => "Generated tags for $processed books",
            'processed' => $processed
        ];
    }

    private function generate_book_tags($book)
    {
        // This would use AI to analyze book data and suggest tags
        // For now, return basic tags based on category
        $tags = [];
        
        if (!empty($book->notes)) {
            // Simple keyword extraction (in real implementation, this would use AI)
            $keywords = ['fiction', 'adventure', 'mystery', 'romance', 'science', 'history'];
            foreach ($keywords as $keyword) {
                if (stripos($book->notes, $keyword) !== false) {
                    $tags[] = $keyword;
                }
            }
        }

        return $tags;
    }

    private function save_book_tags($book_id, $tags)
    {
        foreach ($tags as $tag) {
            $this->db->insert('book_tags', [
                'bookID' => $book_id,
                'tag_name' => $tag,
                'tag_type' => 'genre',
                'created_by' => 'ai'
            ]);
        }
    }

    private function process_uploaded_training_data($upload_data)
    {
        $file_path = $upload_data['full_path'];
        $file_ext = $upload_data['file_ext'];

        switch ($file_ext) {
            case '.csv':
                return $this->process_csv_training_data($file_path);
            case '.json':
                return $this->process_json_training_data($file_path);
            case '.txt':
                return $this->process_text_training_data($file_path);
            default:
                throw new Exception('Unsupported file format');
        }
    }

    private function process_csv_training_data($file_path)
    {
        $data = [];
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== FALSE) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $this->ai_model->train_model([
            'type' => 'csv_upload',
            'data' => $data
        ]);
    }

    private function process_json_training_data($file_path)
    {
        $json_data = file_get_contents($file_path);
        $data = json_decode($json_data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid JSON format');
        }

        return $this->ai_model->train_model([
            'type' => 'json_upload',
            'data' => $data
        ]);
    }

    private function process_text_training_data($file_path)
    {
        $content = file_get_contents($file_path);
        
        return $this->ai_model->train_model([
            'type' => 'text_content',
            'data' => $content
        ]);
    }

    private function get_training_stats()
    {
        return [
            'total_books' => $this->book_m->count_books(),
            'trained_books' => $this->db->count_all('ai_training_data'),
            'total_searches' => $this->db->count_all('ai_search_logs'),
            'total_recommendations' => $this->db->count_all('ai_recommendations')
        ];
    }

    private function get_recent_training()
    {
        return $this->db->select('*')
                       ->from('ai_training_data')
                       ->order_by('created_at', 'DESC')
                       ->limit(10)
                       ->get()
                       ->result();
    }

    private function get_search_trends()
    {
        return $this->db->query("
            SELECT DATE(created_at) as date, COUNT(*) as searches 
            FROM ai_search_logs 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
            GROUP BY DATE(created_at)
            ORDER BY date ASC
        ")->result_array();
    }

    private function get_recommendation_stats()
    {
        return $this->db->query("
            SELECT recommendation_type, COUNT(*) as count
            FROM ai_recommendations
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY recommendation_type
        ")->result_array();
    }

    private function get_user_engagement_stats()
    {
        return [
            'active_users' => $this->db->query("
                SELECT COUNT(DISTINCT user_id) as count
                FROM ai_search_logs 
                WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
            ")->row()->count,
            'avg_searches_per_user' => $this->db->query("
                SELECT AVG(search_count) as avg_searches
                FROM (
                    SELECT user_id, COUNT(*) as search_count
                    FROM ai_search_logs 
                    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
                    GROUP BY user_id
                ) as user_searches
            ")->row()->avg_searches ?? 0
        ];
    }

    private function get_ai_settings()
    {
        $settings = [];
        $result = $this->db->where_in('optionkey', [
            'openai_api_key', 'ai_enabled', 'ai_search_enabled', 
            'ai_recommendations_enabled', 'ai_chat_enabled', 'ai_model_version',
            'ai_max_search_results', 'ai_recommendation_count'
        ])->get('generalsetting')->result();

        foreach ($result as $setting) {
            $settings[$setting->optionkey] = $setting->optionvalue;
        }

        return $settings;
    }

    private function update_ai_settings($settings)
    {
        foreach ($settings as $key => $value) {
            $this->db->where('optionkey', $key)
                    ->update('generalsetting', ['optionvalue' => $value]);
        }
    }

    private function count_categories()
    {
        return $this->db->count_all('bookcategory');
    }
}