<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - LibraryPlus</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --light-bg: #f8f9fa;
            --text-color: #2c3e50;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-bg);
            color: var(--text-color);
        }

        .navbar {
            background: var(--primary-color) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .search-header {
            background: white;
            padding: 2rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .search-box {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 50px;
            padding: 15px 60px 15px 25px;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--secondary-color);
            border: none;
            border-radius: 50px;
            width: 50px;
            height: 50px;
            color: white;
            font-size: 1.2rem;
        }

        .search-stats {
            text-align: center;
            margin-top: 1rem;
            color: #6c757d;
        }

        .ai-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-left: 0.5rem;
            font-weight: 500;
        }

        .search-filters {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filter-chip {
            display: inline-block;
            background: var(--light-bg);
            border: 1px solid #e9ecef;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            font-size: 0.9rem;
            text-decoration: none;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .filter-chip:hover, .filter-chip.active {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .results-container {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
            align-items: start;
        }

        .search-results {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .results-header {
            background: var(--light-bg);
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .results-header h3 {
            margin: 0;
            color: var(--primary-color);
        }

        .result-item {
            border-bottom: 1px solid #f8f9fa;
            padding: 1.5rem;
            transition: background 0.3s ease;
        }

        .result-item:hover {
            background: #fcfcfc;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .book-card {
            display: flex;
            gap: 1.5rem;
        }

        .book-cover {
            width: 80px;
            height: 120px;
            background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 2rem;
            flex-shrink: 0;
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .book-info {
            flex: 1;
        }

        .book-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            text-decoration: none;
        }

        .book-title:hover {
            color: var(--secondary-color);
        }

        .book-author {
            color: #6c757d;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        .book-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }

        .book-category {
            background: var(--secondary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
        }

        .book-isbn {
            color: #6c757d;
        }

        .book-description {
            color: #495057;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .book-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-view {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        .btn-favorite {
            background: none;
            border: 1px solid #e9ecef;
            color: #6c757d;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-favorite:hover {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        .sidebar {
            position: sticky;
            top: 2rem;
        }

        .sidebar-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .sidebar-card h5 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .suggested-book {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f8f9fa;
        }

        .suggested-book:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .suggested-cover {
            width: 50px;
            height: 70px;
            background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .suggested-info {
            flex: 1;
        }

        .suggested-title {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
            color: var(--primary-color);
            text-decoration: none;
        }

        .suggested-author {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .no-results i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .ai-suggestion {
            background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
            border-radius: 10px;
            padding: 1rem;
            margin: 1rem 0;
            border-left: 4px solid var(--secondary-color);
        }

        .ai-suggestion-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .ai-suggestion-header i {
            color: var(--secondary-color);
            margin-right: 0.5rem;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 10px;
            margin: 1rem 0;
            border-left: 4px solid var(--accent-color);
        }

        @media (max-width: 768px) {
            .results-container {
                grid-template-columns: 1fr;
            }

            .book-card {
                flex-direction: column;
                text-align: center;
            }

            .book-cover {
                align-self: center;
            }

            .search-header {
                padding: 1rem 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo base_url(); ?>">
                <i class="fas fa-book-open me-2"></i>LibraryPlus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('frontend/category'); ?>">Browse Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('frontend/ai_assistant'); ?>">AI Assistant</a>
                    </li>
                    <?php if ($this->session->userdata('loginmemberID')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('frontend/recommendations'); ?>">My Recommendations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('login'); ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Header -->
    <div class="search-header">
        <div class="container">
            <form action="<?php echo base_url('frontend/search'); ?>" method="GET">
                <div class="search-box">
                    <input 
                        type="text" 
                        name="q" 
                        class="search-input" 
                        value="<?php echo htmlspecialchars($query ?? ''); ?>"
                        placeholder="Search for books, authors, or ask AI for recommendations..."
                        autocomplete="off"
                    >
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            
            <div class="search-stats">
                <?php if (isset($total_results)): ?>
                    Found <strong><?php echo $total_results; ?></strong> results for "<strong><?php echo htmlspecialchars($query); ?></strong>"
                    <?php if (isset($search_type)): ?>
                        <span class="ai-badge">
                            <i class="fas fa-magic me-1"></i><?php echo $search_type; ?>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Search Filters -->
    <div class="container">
        <div class="search-filters">
            <h6 class="mb-3">Filter by:</h6>
            <a href="<?php echo base_url('frontend/search?q=' . urlencode($query ?? '') . '&type=intelligent'); ?>" 
               class="filter-chip <?php echo (!isset($_GET['type']) || $_GET['type'] == 'intelligent') ? 'active' : ''; ?>">
                <i class="fas fa-magic me-1"></i>AI Search
            </a>
            <a href="<?php echo base_url('frontend/search?q=' . urlencode($query ?? '') . '&type=basic'); ?>" 
               class="filter-chip <?php echo (isset($_GET['type']) && $_GET['type'] == 'basic') ? 'active' : ''; ?>">
                <i class="fas fa-search me-1"></i>Basic Search
            </a>
            <a href="<?php echo base_url('frontend/category'); ?>" class="filter-chip">
                <i class="fas fa-folder me-1"></i>Browse Categories
            </a>
            <a href="<?php echo base_url('frontend/ai_assistant'); ?>" class="filter-chip">
                <i class="fas fa-comments me-1"></i>Chat with AI
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="results-container">
            <!-- Search Results -->
            <div class="search-results">
                <div class="results-header">
                    <h3>
                        <i class="fas fa-book me-2"></i>Search Results
                        <?php if (isset($search_type) && $search_type === 'AI-Powered'): ?>
                            <small class="text-muted">- Powered by AI</small>
                        <?php endif; ?>
                    </h3>
                </div>

                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($search_type) && $search_type === 'AI-Powered'): ?>
                    <div class="ai-suggestion">
                        <div class="ai-suggestion-header">
                            <i class="fas fa-lightbulb"></i>
                            <strong>AI Insight</strong>
                        </div>
                        <p class="mb-0">
                            I analyzed your search for "<em><?php echo htmlspecialchars($query); ?></em>" 
                            and found these relevant books based on context, themes, and reading patterns.
                        </p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $book): ?>
                        <div class="result-item">
                            <div class="book-card">
                                <div class="book-cover">
                                    <?php if (!empty($book->coverphoto) && file_exists('uploads/book/' . $book->coverphoto)): ?>
                                        <img src="<?php echo base_url('uploads/book/' . $book->coverphoto); ?>" 
                                             alt="<?php echo htmlspecialchars($book->name); ?>">
                                    <?php else: ?>
                                        <i class="fas fa-book"></i>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="book-info">
                                    <a href="<?php echo base_url('frontend/book/' . $book->bookID); ?>" class="book-title">
                                        <?php echo htmlspecialchars($book->name); ?>
                                    </a>
                                    
                                    <div class="book-author">
                                        by <?php echo htmlspecialchars($book->author); ?>
                                    </div>
                                    
                                    <div class="book-meta">
                                        <?php if (!empty($book->category_name)): ?>
                                            <span class="book-category">
                                                <?php echo htmlspecialchars($book->category_name); ?>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($book->publisher)): ?>
                                            <span class="book-publisher">
                                                <i class="fas fa-building me-1"></i>
                                                <?php echo htmlspecialchars($book->publisher); ?>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($book->isbnno)): ?>
                                            <span class="book-isbn">
                                                ISBN: <?php echo htmlspecialchars($book->isbnno); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php if (!empty($book->notes)): ?>
                                        <div class="book-description">
                                            <?php echo nl2br(htmlspecialchars(substr($book->notes, 0, 200))); ?>
                                            <?php if (strlen($book->notes) > 200): ?>...<?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="book-actions">
                                        <a href="<?php echo base_url('frontend/book/' . $book->bookID); ?>" class="btn-view">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </a>
                                        <button class="btn-favorite" onclick="toggleFavorite(<?php echo $book->bookID; ?>)">
                                            <i class="far fa-heart me-1"></i>Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h4>No books found</h4>
                        <p>Try searching with different keywords or ask our AI assistant for help.</p>
                        <a href="<?php echo base_url('frontend/ai_assistant'); ?>" class="btn btn-primary">
                            <i class="fas fa-robot me-1"></i>Get AI Help
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- AI Suggestions -->
                <div class="sidebar-card">
                    <h5><i class="fas fa-magic me-2"></i>AI Suggestions</h5>
                    <p class="small text-muted mb-3">Based on your search, you might also like:</p>
                    
                    <div class="suggested-book">
                        <div class="suggested-cover">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="suggested-info">
                            <a href="#" class="suggested-title">Similar Theme Books</a>
                            <div class="suggested-author">Various Authors</div>
                        </div>
                    </div>
                    
                    <div class="suggested-book">
                        <div class="suggested-cover">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="suggested-info">
                            <a href="#" class="suggested-title">Trending in Category</a>
                            <div class="suggested-author">Popular picks</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="sidebar-card">
                    <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    
                    <a href="<?php echo base_url('frontend/ai_assistant'); ?>" class="btn btn-outline-primary btn-sm d-block mb-2">
                        <i class="fas fa-comments me-1"></i>Chat with AI
                    </a>
                    
                    <a href="<?php echo base_url('frontend/category'); ?>" class="btn btn-outline-secondary btn-sm d-block mb-2">
                        <i class="fas fa-th-large me-1"></i>Browse Categories
                    </a>
                    
                    <?php if ($this->session->userdata('loginmemberID')): ?>
                        <a href="<?php echo base_url('frontend/recommendations'); ?>" class="btn btn-outline-success btn-sm d-block">
                            <i class="fas fa-heart me-1"></i>My Recommendations
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Search Tips -->
                <div class="sidebar-card">
                    <h5><i class="fas fa-lightbulb me-2"></i>Search Tips</h5>
                    <ul class="small text-muted mb-0">
                        <li>Use natural language: "books like Harry Potter"</li>
                        <li>Describe mood: "something uplifting"</li>
                        <li>Specify genre: "mystery novels"</li>
                        <li>Ask for occasion: "books for vacation"</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleFavorite(bookId) {
            // Placeholder for favorite functionality
            const btn = event.target.closest('.btn-favorite');
            const icon = btn.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                btn.style.background = 'var(--accent-color)';
                btn.style.color = 'white';
                btn.style.borderColor = 'var(--accent-color)';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                btn.style.background = 'none';
                btn.style.color = '#6c757d';
                btn.style.borderColor = '#e9ecef';
            }
        }

        // Auto-focus search input
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-input');
            if (searchInput && !searchInput.value) {
                searchInput.focus();
            }
        });
    </script>
</body>
</html>