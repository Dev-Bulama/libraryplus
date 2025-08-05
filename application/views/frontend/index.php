<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraryPlus - AI-Powered Book Discovery</title>
    <meta name="description" content="Discover your next favorite book with AI-powered recommendations">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --white: #ffffff;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: var(--shadow-md);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-primary) !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: #667eea !important;
        }

        .btn-auth {
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-login {
            color: var(--text-primary);
            border-color: #e2e8f0;
        }

        .btn-login:hover {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
        }

        .btn-register {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Hero Section */
        .hero {
            background: var(--primary-gradient);
            padding: 120px 0 100px;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 8px rgba(0,0,0,0.2);
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 3rem;
            opacity: 0.95;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* AI Search Container */
        .ai-search-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 700px;
            margin: 0 auto;
        }

        .search-input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .search-input {
            width: 100%;
            padding: 18px 70px 18px 25px;
            border: 2px solid #e2e8f0;
            border-radius: 60px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .search-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-gradient);
            border: none;
            border-radius: 50px;
            width: 50px;
            height: 50px;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        .ai-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .ai-pulse {
            width: 8px;
            height: 8px;
            background: #667eea;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        /* Search Results */
        .search-results {
            margin-top: 3rem;
            display: none;
        }

        .results-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .results-count {
            background: var(--success-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 1rem;
        }

        /* Book Cards */
        .book-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #f1f5f9;
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .book-image {
            width: 100%;
            height: 280px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
            overflow: hidden;
        }

        .book-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 25%, transparent 25%), 
                        linear-gradient(-45deg, rgba(255,255,255,0.1) 25%, transparent 25%), 
                        linear-gradient(45deg, transparent 75%, rgba(255,255,255,0.1) 75%), 
                        linear-gradient(-45deg, transparent 75%, rgba(255,255,255,0.1) 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
        }

        .book-info {
            padding: 1.5rem;
        }

        .book-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
            font-size: 1.1rem;
            line-height: 1.4;
        }

        .book-author {
            color: var(--text-secondary);
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .book-category {
            background: var(--secondary-gradient);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .book-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .stars {
            color: #ffd700;
        }

        .rating-text {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .book-description {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-view {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Categories Filter */
        .categories-filter {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .category-btn {
            background: white;
            border: 2px solid #e2e8f0;
            color: var(--text-secondary);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            white-space: nowrap;
            cursor: pointer;
        }

        .category-btn.active,
        .category-btn:hover {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
        }

        /* Loading Animation */
        .loading-container {
            text-align: center;
            padding: 3rem;
            display: none;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: var(--bg-light);
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #f1f5f9;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-gradient);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        /* Stats Section */
        .stats-section {
            padding: 80px 0;
            background: var(--dark-gradient);
            color: white;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: var(--success-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: var(--secondary-gradient);
            color: white;
            text-align: center;
        }

        .btn-cta {
            background: white;
            color: #f5576c;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
            font-size: 1.1rem;
            margin: 0 0.5rem;
        }

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
            color: #f5576c;
        }

        .btn-cta-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-cta-outline:hover {
            background: white;
            color: #f5576c;
        }

        /* Footer */
        .footer {
            background: #1a202c;
            color: white;
            padding: 60px 0 30px;
        }

        .footer-brand {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary-gradient);
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .ai-search-container {
                padding: 2rem;
                margin: 0 1rem;
            }

            .search-input {
                padding: 15px 60px 15px 20px;
                font-size: 1rem;
            }

            .categories-filter {
                justify-content: flex-start;
            }
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 2rem 2rem 1rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-modal {
            width: 100%;
            padding: 0.75rem;
            border-radius: 10px;
            font-weight: 500;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-brain me-2"></i>LibraryPlus
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#books">Browse Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                </ul>
                <div class="d-flex gap-2 ms-3">
                    <button class="btn btn-auth btn-login" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-auth btn-register" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Discover Books with AI Magic</h1>
                <p>Ask our intelligent assistant to find your perfect next read. From "books like Harry Potter" to "something mysterious and romantic" - we understand what you're looking for.</p>
                
                <!-- AI Search Container -->
                <div class="ai-search-container">
                    <form id="aiSearchForm">
                        <div class="search-input-group">
                            <input 
                                type="text" 
                                id="searchInput"
                                class="search-input" 
                                placeholder="Try: 'Fantasy books with dragons' or 'Romance novels that make you cry'"
                                autocomplete="off"
                            >
                            <button type="submit" class="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <div class="ai-indicator">
                        <div class="ai-pulse"></div>
                        <span>AI-Powered Search • Natural Language Understanding</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Results Section -->
    <section id="searchResults" class="search-results">
        <div class="container">
            <div class="results-header">
                <div class="results-count" id="resultsCount"></div>
                <h2>Search Results</h2>
                <p class="text-muted">Found the perfect matches for your request</p>
            </div>

            <!-- Categories Filter -->
            <div class="categories-filter" id="categoriesFilter">
                <button class="category-btn active" data-category="all">All Books</button>
                <button class="category-btn" data-category="Fiction">Fiction</button>
                <button class="category-btn" data-category="Romance">Romance</button>
                <button class="category-btn" data-category="Science Fiction">Sci-Fi</button>
                <button class="category-btn" data-category="Fantasy">Fantasy</button>
                <button class="category-btn" data-category="Mystery">Mystery</button>
                <button class="category-btn" data-category="Non-Fiction">Non-Fiction</button>
            </div>

            <!-- Loading Animation -->
            <div class="loading-container" id="loadingContainer">
                <div class="loading-spinner"></div>
                <h4>AI is searching for you...</h4>
                <p class="text-muted">Analyzing your request and finding perfect matches</p>
            </div>

            <!-- Books Grid -->
            <div class="row g-4" id="booksGrid">
                <!-- Books will be dynamically inserted here -->
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold mb-3">Powered by Advanced AI</h2>
                    <p class="lead">Experience the future of book discovery with our intelligent features</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4>Natural Language Search</h4>
                        <p>Describe what you want in plain English. Our AI understands context, mood, and subtle preferences to find exactly what you're looking for.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4>Personalized Recommendations</h4>
                        <p>Get book suggestions that match your unique taste. The more you interact, the better our AI understands your preferences.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-magic"></i>
                        </div>
                        <h4>Smart Categorization</h4>
                        <p>Books are intelligently categorized by genre, mood, complexity, and themes. Find books that match your current reading mood.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">10,000+</div>
                        <div class="stat-label">Books Available</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">50,000+</div>
                        <div class="stat-label">Happy Readers</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Match Accuracy</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">AI Assistant</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Ready to Find Your Next Favorite Book?</h2>
            <p class="lead mb-4">Join thousands of readers who've discovered amazing books with our AI assistant</p>
            <button class="btn-cta" data-bs-toggle="modal" data-bs-target="#registerModal">Start Reading</button>
            <button class="btn-cta btn-cta-outline" onclick="document.getElementById('searchInput').focus()">Try AI Search</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">LibraryPlus</div>
                    <p>AI-powered book discovery platform that understands what you're looking for, even when you can't quite put it into words.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Platform</h6>
                    <ul class="footer-links">
                        <li><a href="#">Browse Books</a></li>
                        <li><a href="#">AI Search</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">Recommendations</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Support</h6>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Community</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Company</h6>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Legal</h6>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">DMCA</a></li>
                    </ul>
                </div>
            </div>
            <hr style="margin: 2rem 0; opacity: 0.1;">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 LibraryPlus. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Made with <i class="fas fa-heart text-danger"></i> for book lovers</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Welcome Back</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-modal" style="background: var(--primary-gradient); color: white;">Sign In</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Join LibraryPlus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="registerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="registerEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">I agree to the Terms of Service</label>
                        </div>
                        <button type="submit" class="btn btn-modal" style="background: var(--secondary-gradient); color: white;">Create Account</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Sign in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dummy Books Data
        const dummyBooks = [
            {
                id: 1,
                title: "The Midnight Library",
                author: "Matt Haig",
                category: "Fiction",
                rating: 4.5,
                description: "Between life and death there is a library, and within that library, the shelves go on forever. Every book provides a chance to try another life you could have lived.",
                keywords: ["philosophical", "life choices", "fantasy", "inspiring", "thought-provoking"]
            },
            {
                id: 2,
                title: "Dune",
                author: "Frank Herbert",
                category: "Science Fiction",
                rating: 4.8,
                description: "Set on the desert planet Arrakis, this epic saga follows Paul Atreides as he becomes part of a massive political and religious conspiracy.",
                keywords: ["epic", "space", "politics", "desert", "prophesy", "adventure"]
            },
            {
                id: 3,
                title: "The Seven Husbands of Evelyn Hugo",
                author: "Taylor Jenkins Reid",
                category: "Romance",
                rating: 4.7,
                description: "Reclusive Hollywood icon Evelyn Hugo finally decides to tell her life story—but only to unknown journalist Monique Grant.",
                keywords: ["hollywood", "glamour", "secrets", "love", "lgbtq", "emotional"]
            },
            {
                id: 4,
                title: "The Name of the Wind",
                author: "Patrick Rothfuss",
                category: "Fantasy",
                rating: 4.6,
                description: "The tale of Kvothe, from his childhood in a troupe of traveling players, to years spent as a near-feral orphan, to his time as a student at the University.",
                keywords: ["magic", "university", "music", "adventure", "coming-of-age", "dragons"]
            },
            {
                id: 5,
                title: "Gone Girl",
                author: "Gillian Flynn",
                category: "Mystery",
                rating: 4.3,
                description: "Nick Dunne's wife Amy disappears on their fifth wedding anniversary, and Nick becomes the prime suspect in her disappearance.",
                keywords: ["psychological", "thriller", "marriage", "dark", "twisted", "mystery"]
            },
            {
                id: 6,
                title: "Educated",
                author: "Tara Westover",
                category: "Non-Fiction",
                rating: 4.9,
                description: "A memoir about a young woman who, kept out of school, leaves her survivalist family and goes on to earn a PhD from Cambridge University.",
                keywords: ["memoir", "education", "family", "survival", "inspiring", "self-discovery"]
            },
            {
                id: 7,
                title: "It Ends with Us",
                author: "Colleen Hoover",
                category: "Romance",
                rating: 4.4,
                description: "A story of a woman who must choose between the life she wants and the life she's familiar with when her first love returns.",
                keywords: ["emotional", "domestic abuse", "love triangle", "crying", "heart-breaking", "realistic"]
            },
            {
                id: 8,
                title: "The Silent Patient",
                author: "Alex Michaelides",
                category: "Mystery",
                rating: 4.2,
                description: "A woman refuses to speak after allegedly murdering her husband, and a psychotherapist becomes obsessed with treating her.",
                keywords: ["psychological", "thriller", "twist", "mental health", "obsession", "silence"]
            },
            {
                id: 9,
                title: "Project Hail Mary",
                author: "Andy Weir",
                category: "Science Fiction",
                rating: 4.8,
                description: "A man wakes up on a spaceship with no memory of how he got there, and must save humanity from extinction.",
                keywords: ["space", "humor", "science", "problem-solving", "friendship", "aliens"]
            },
            {
                id: 10,
                title: "Circe",
                author: "Madeline Miller",
                category: "Fantasy",
                rating: 4.6,
                description: "The story of the Greek goddess Circe, from her childhood among the gods to her encounter with the hero Odysseus.",
                keywords: ["mythology", "greek gods", "witchcraft", "beautiful writing", "feminist", "magical"]
            }
        ];

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('aiSearchForm');
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            const loadingContainer = document.getElementById('loadingContainer');
            const booksGrid = document.getElementById('booksGrid');
            const resultsCount = document.getElementById('resultsCount');
            const categoryButtons = document.querySelectorAll('.category-btn');

            let currentBooks = [];
            let currentCategory = 'all';

            // Search form submission
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const query = searchInput.value.trim();
                if (query) {
                    performSearch(query);
                }
            });

            // Category filter functionality
            categoryButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    categoryButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentCategory = this.dataset.category;
                    filterBooksByCategory();
                });
            });

            function performSearch(query) {
                // Show loading
                searchResults.style.display = 'block';
                loadingContainer.style.display = 'block';
                booksGrid.innerHTML = '';
                
                // Scroll to results
                searchResults.scrollIntoView({ behavior: 'smooth' });

                // Simulate AI processing time
                setTimeout(() => {
                    const results = searchBooks(query);
                    currentBooks = results;
                    displayBooks(results);
                    loadingContainer.style.display = 'none';
                }, 2000);
            }

            function searchBooks(query) {
                const lowerQuery = query.toLowerCase();
                
                // Simple AI-like search algorithm
                const results = dummyBooks.filter(book => {
                    const titleMatch = book.title.toLowerCase().includes(lowerQuery);
                    const authorMatch = book.author.toLowerCase().includes(lowerQuery);
                    const categoryMatch = book.category.toLowerCase().includes(lowerQuery);
                    const descriptionMatch = book.description.toLowerCase().includes(lowerQuery);
                    const keywordMatch = book.keywords.some(keyword => 
                        keyword.toLowerCase().includes(lowerQuery) || lowerQuery.includes(keyword.toLowerCase())
                    );
                    
                    return titleMatch || authorMatch || categoryMatch || descriptionMatch || keywordMatch;
                });

                // If no direct matches, return books based on mood/theme keywords
                if (results.length === 0) {
                    const moodKeywords = {
                        'romantic': ['love', 'romance'],
                        'funny': ['humor'],
                        'sad': ['emotional', 'crying'],
                        'scary': ['thriller', 'mystery'],
                        'adventure': ['adventure', 'epic'],
                        'magic': ['fantasy', 'magical', 'dragons'],
                        'space': ['science fiction', 'space'],
                        'inspiring': ['inspiring', 'memoir']
                    };

                    for (const [mood, keywords] of Object.entries(moodKeywords)) {
                        if (lowerQuery.includes(mood)) {
                            return dummyBooks.filter(book => 
                                keywords.some(keyword => 
                                    book.keywords.includes(keyword) || book.category.toLowerCase().includes(keyword)
                                )
                            );
                        }
                    }

                    // Return all books if no matches found
                    return dummyBooks;
                }

                return results;
            }

            function filterBooksByCategory() {
                if (currentCategory === 'all') {
                    displayBooks(currentBooks);
                } else {
                    const filtered = currentBooks.filter(book => book.category === currentCategory);
                    displayBooks(filtered);
                }
            }

            function displayBooks(books) {
                resultsCount.textContent = `${books.length} books found`;
                
                if (books.length === 0) {
                    booksGrid.innerHTML = '<div class="col-12 text-center"><p class="text-muted">No books found. Try a different search term.</p></div>';
                    return;
                }

                booksGrid.innerHTML = books.map(book => `
                    <div class="col-lg-4 col-md-6">
                        <div class="book-card">
                            <div class="book-image">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-info">
                                <h5 class="book-title">${book.title}</h5>
                                <p class="book-author">by ${book.author}</p>
                                <span class="book-category">${book.category}</span>
                                <div class="book-rating">
                                    <div class="stars">
                                        ${'★'.repeat(Math.floor(book.rating))}${'☆'.repeat(5 - Math.floor(book.rating))}
                                    </div>
                                    <span class="rating-text">${book.rating}/5</span>
                                </div>
                                <p class="book-description">${book.description}</p>
                                <button class="btn-view" onclick="viewBook(${book.id})">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('');
            }

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Login form handling
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const email = document.getElementById('loginEmail').value;
                const password = document.getElementById('loginPassword').value;
                
                // Simulate login
                if (email && password) {
                    alert('Login successful! Welcome back to LibraryPlus.');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                    modal.hide();
                    
                    // Update UI for logged in user
                    updateUIForLoggedInUser(email);
                }
            });

            // Register form handling
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('registerName').value;
                const email = document.getElementById('registerEmail').value;
                const password = document.getElementById('registerPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                if (password !== confirmPassword) {
                    alert('Passwords do not match!');
                    return;
                }
                
                // Simulate registration
                if (name && email && password) {
                    alert(`Welcome to LibraryPlus, ${name}! Your account has been created.`);
                    const modal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
                    modal.hide();
                    
                    // Update UI for logged in user
                    updateUIForLoggedInUser(email);
                }
            });

            function updateUIForLoggedInUser(email) {
                // Update auth buttons
                const authSection = document.querySelector('.d-flex.gap-2.ms-3');
                authSection.innerHTML = `
                    <div class="dropdown">
                        <button class="btn btn-auth btn-login dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i>${email.split('@')[0]}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-heart me-2"></i>My Books</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="logout()"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                `;
            }
        });

        // Global functions
        function viewBook(bookId) {
            const book = dummyBooks.find(b => b.id === bookId);
            if (book) {
                alert(`Viewing details for "${book.title}" by ${book.author}\n\n${book.description}\n\nRating: ${book.rating}/5 stars`);
            }
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                location.reload();
            }
        }

        // Initialize with featured books on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-show some featured books after a delay
            setTimeout(() => {
                if (document.getElementById('booksGrid').innerHTML === '') {
                    document.getElementById('searchInput').value = 'featured books';
                    document.getElementById('aiSearchForm').dispatchEvent(new Event('submit'));
                }
            }, 3000);
        });
    </script>
</body>
</html>