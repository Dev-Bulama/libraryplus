<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $meta_description; ?>">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --text-color: #2c3e50;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        /* AI Search Box */
        .ai-search-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
        }

        .search-input-group {
            position: relative;
        }

        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 50px;
            padding: 15px 60px 15px 25px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .search-input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 5px 25px rgba(52, 152, 219, 0.3);
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
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: var(--primary-color);
            transform: translateY(-50%) scale(1.05);
        }

        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
            display: none;
        }

        .suggestion-item {
            padding: 12px 20px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .suggestion-item:hover {
            background: var(--light-bg);
        }

        /* Features Section */
        .features {
            padding: 80px 0;
            background: var(--light-bg);
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        /* Books Section */
        .books-section {
            padding: 80px 0;
        }

        .book-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 3rem;
        }

        .book-info {
            padding: 1.5rem;
        }

        .book-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .book-author {
            color: #666;
            margin-bottom: 1rem;
        }

        .book-category {
            background: var(--secondary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--accent-color), #c0392b);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .btn-cta {
            background: white;
            color: var(--accent-color);
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
            font-size: 1.1rem;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            color: var(--accent-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .ai-search-container {
                padding: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner {
            display: inline-block;
            width: 30px;
            height: 30px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: var(--primary-color);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo base_url(); ?>">
                <i class="fas fa-book-open me-2"></i>LibraryPlusllll
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center hero-content">
                    <h1>Discover Your Next Favorite Book</h1>
                    <p>Powered by AI • Find books that match your mood, interests, and reading style</p>
                    
                    <!-- AI Search Box -->
                    <div class="ai-search-container mx-auto" style="max-width: 600px;">
                        <form id="aiSearchForm" action="<?php echo base_url('frontend/search'); ?>" method="GET">
                            <div class="search-input-group">
                                <input 
                                    type="text" 
                                    name="q" 
                                    id="searchInput"
                                    class="form-control search-input" 
                                    placeholder="Ask me anything... 'Books like Harry Potter' or 'I want something mysterious and romantic'"
                                    autocomplete="off"
                                >
                                <button type="submit" class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                                <div id="searchSuggestions" class="search-suggestions"></div>
                            </div>
                        </form>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="fas fa-magic me-1"></i>
                                Try: "Books for rainy days" • "Sci-fi like Dune" • "Something to make me laugh"
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold mb-3">Why Choose LibraryPlus?</h2>
                    <p class="lead">Experience the future of book discovery with our AI-powered features</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4>AI-Powered Search</h4>
                        <p>Describe what you're looking for in natural language. Our AI understands context, mood, and preferences to find perfect matches.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4>Personal Recommendations</h4>
                        <p>Get personalized book suggestions based on your reading history, ratings, and preferences. Discover hidden gems you'll love.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4>Smart Assistant</h4>
                        <p>Chat with our AI librarian for book recommendations, reading advice, and answers to any book-related questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Books -->
    <section class="books-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold mb-3">Featured Books</h2>
                    <p class="lead">Discover our latest additions and popular titles</p>
                </div>
            </div>
            <div class="row g-4">
                <?php if (!empty($featured_books)): ?>
                    <?php foreach ($featured_books as $book): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="book-card">
                                <div class="book-image">
                                    <?php if (!empty($book->coverphoto)): ?>
                                        <img src="<?php echo base_url('uploads/book/' . $book->coverphoto); ?>" 
                                             alt="<?php echo htmlspecialchars($book->name); ?>" 
                                             class="book-image">
                                    <?php else: ?>
                                        <i class="fas fa-book"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="book-info">
                                    <h5 class="book-title"><?php echo htmlspecialchars($book->name); ?></h5>
                                    <p class="book-author">by <?php echo htmlspecialchars($book->author); ?></p>
                                    <span class="book-category"><?php echo htmlspecialchars($book->category_name ?? 'General'); ?></span>
                                    <div class="mt-3">
                                        <a href="<?php echo base_url('frontend/book/' . $book->bookID); ?>" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">No featured books available at the moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Trending Books -->
    <?php if (!empty($trending_books)): ?>
    <section class="books-section" style="background: var(--light-bg);">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold mb-3">Trending Now</h2>
                    <p class="lead">Books that other readers are loving</p>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach (array_slice($trending_books, 0, 6) as $book): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="book-card">
                            <div class="book-image">
                                <?php if (!empty($book->coverphoto)): ?>
                                    <img src="<?php echo base_url('uploads/book/' . $book->coverphoto); ?>" 
                                         alt="<?php echo htmlspecialchars($book->name); ?>" 
                                         class="book-image">
                                <?php else: ?>
                                    <i class="fas fa-book"></i>
                                <?php endif; ?>
                            </div>
                            <div class="book-info">
                                <h5 class="book-title"><?php echo htmlspecialchars($book->name); ?></h5>
                                <p class="book-author">by <?php echo htmlspecialchars($book->author); ?></p>
                                <span class="book-category"><?php echo htmlspecialchars($book->category_name ?? 'General'); ?></span>
                                <div class="mt-2">
                                    <small class="text-success">
                                        <i class="fas fa-fire me-1"></i>Popular
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Ready to Start Your Reading Journey?</h2>
            <p class="lead mb-4">Join thousands of readers discovering their perfect books with AI assistance</p>
            <?php if (!$this->session->userdata('loginmemberID')): ?>
                <a href="<?php echo base_url('login'); ?>" class="btn-cta me-3">Get Started</a>
                <a href="<?php echo base_url('frontend/ai_assistant'); ?>" class="btn btn-outline-light">Try AI Assistant</a>
            <?php else: ?>
                <a href="<?php echo base_url('frontend/recommendations'); ?>" class="btn-cta me-3">Get My Recommendations</a>
                <a href="<?php echo base_url('frontend/ai_assistant'); ?>" class="btn btn-outline-light">Chat with AI</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-book-open me-2"></i>LibraryPlus</h5>
                    <p>AI-powered book discovery platform</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2025 LibraryPlus. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const suggestionsDiv = document.getElementById('searchSuggestions');
            let searchTimeout;

            // Search suggestions
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length < 2) {
                    suggestionsDiv.style.display = 'none';
                    return;
                }

                searchTimeout = setTimeout(() => {
                    fetch('<?php echo base_url("frontend/search_suggestions"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'query=' + encodeURIComponent(query)
                    })
                    .then(response => response.json())
                    .then(suggestions => {
                        showSuggestions(suggestions);
                    })
                    .catch(error => {
                        console.error('Suggestion error:', error);
                    });
                }, 300);
            });

            function showSuggestions(suggestions) {
                if (suggestions.length === 0) {
                    suggestionsDiv.style.display = 'none';
                    return;
                }

                suggestionsDiv.innerHTML = suggestions.map(item => 
                    `<div class="suggestion-item" onclick="selectSuggestion('${item.title}')">
                        <i class="fas ${item.type === 'book' ? 'fa-book' : 'fa-user'} me-2"></i>
                        ${item.title}
                        <small class="text-muted ms-2">(${item.type})</small>
                    </div>`
                ).join('');
                
                suggestionsDiv.style.display = 'block';
            }

            window.selectSuggestion = function(suggestion) {
                searchInput.value = suggestion;
                suggestionsDiv.style.display = 'none';
            };

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.search-input-group')) {
                    suggestionsDiv.style.display = 'none';
                }
            });

            // Enhanced search form submission
            document.getElementById('aiSearchForm').addEventListener('submit', function(e) {
                const query = searchInput.value.trim();
                if (!query) {
                    e.preventDefault();
                    searchInput.focus();
                    return;
                }
                
                // Add AI search parameter
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'type';
                hiddenInput.value = 'intelligent';
                this.appendChild(hiddenInput);
            });
        });
    </script>
</body>
</html>