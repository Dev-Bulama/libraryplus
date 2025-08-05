<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraryPlus - AI-Powered Book Discovery Platform</title>
    <meta name="description" content="Discover your next favorite book with our AI-powered library management system. Smart search, personalized recommendations, and intelligent book discovery.">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --light-bg: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --shadow-light: 0 5px 15px rgba(0,0,0,0.08);
            --shadow-medium: 0 10px 30px rgba(0,0,0,0.15);
            --shadow-heavy: 0 20px 60px rgba(0,0,0,0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--primary-color);
            overflow-x: hidden;
        }

        /* Header */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .navbar.scrolled {
            background: white !important;
            box-shadow: var(--shadow-light);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-color) !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: var(--secondary-color) !important;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--primary-color) !important;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(52, 152, 219, 0.1);
            color: var(--secondary-color) !important;
        }

        .btn-login, .btn-register {
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .btn-login {
            background: var(--gradient-primary);
            color: white;
            border: none;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
            color: white;
        }

        .btn-register {
            background: transparent;
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
        }

        .btn-register:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            background: var(--gradient-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            color: white;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="25" cy="25" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="0.8" fill="rgba(255,255,255,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.3;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #e8f4f8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            line-height: 1.6;
            max-width: 600px;
        }

        .hero-search {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: var(--shadow-heavy);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .search-input {
            width: 100%;
            padding: 1.25rem 4rem 1.25rem 1.5rem;
            border: 2px solid #e9ecef;
            border-radius: 60px;
            font-size: 1.1rem;
            color: var(--primary-color);
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 5px 25px rgba(52, 152, 219, 0.3);
        }

        .search-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--gradient-success);
            border: none;
            border-radius: 50px;
            width: 55px;
            height: 55px;
            color: white;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .search-suggestions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
        }

        .suggestion-chip {
            background: rgba(52, 152, 219, 0.1);
            color: var(--secondary-color);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(52, 152, 219, 0.2);
        }

        .suggestion-chip:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn-hero-primary, .btn-hero-secondary {
            padding: 1rem 2rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-hero-primary {
            background: white;
            color: var(--primary-color);
            box-shadow: var(--shadow-medium);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-heavy);
            color: var(--primary-color);
        }

        .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-hero-secondary:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Features Section */
        .features {
            padding: 5rem 0;
            background: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-badge {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-medium);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .feature-description {
            color: #6c757d;
            line-height: 1.6;
        }

        /* Stats Section */
        .stats {
            background: var(--gradient-secondary);
            padding: 4rem 0;
            color: white;
            position: relative;
        }

        .stats::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.08)"/></svg>') repeat;
            opacity: 0.3;
        }

        .stat-item {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 500;
        }

        /* CTA Section */
        .cta {
            background: var(--light-bg);
            padding: 5rem 0;
            text-align: center;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .cta-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 3rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta-primary, .btn-cta-secondary {
            padding: 1rem 2.5rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-cta-primary {
            background: var(--gradient-primary);
            color: white;
        }

        .btn-cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            color: white;
        }

        .btn-cta-secondary {
            background: transparent;
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
        }

        .btn-cta-secondary:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-3px);
        }

        /* Footer */
        .footer {
            background: var(--primary-color);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-description {
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            text-align: center;
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .navbar-nav {
                text-align: center;
                margin-top: 1rem;
            }

            .hero-cta, .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .search-suggestions {
                justify-content: flex-start;
            }
        }

        /* Loading Animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <i class="fas fa-book-open me-2"></i>LibraryPlus
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('frontend/ai_assistant'); ?>">AI Assistant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('frontend/category'); ?>">Browse Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                </ul>
                
                <div class="d-flex">
                    <a href="<?php echo base_url('login/login'); ?>" class="btn-login">
                        <i class="fas fa-sign-in-alt me-1"></i>Login
                    </a>
                    <a href="<?php echo base_url('login/registermember'); ?>" class="btn-register">
                        <i class="fas fa-user-plus me-1"></i>Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <i class="fas fa-magic me-1"></i>AI-Powered Library System
                        </div>
                        
                        <h1 class="hero-title">
                            Discover Your Next<br>
                            Favorite Book
                        </h1>
                        
                        <p class="hero-subtitle">
                            Experience the future of book discovery with our AI-powered search engine. 
                            Find books that match your mood, interests, and reading preferences with 
                            natural language queries.
                        </p>
                        
                        <!-- AI Search Box -->
                        <div class="hero-search">
                            <form action="<?php echo base_url('frontend/search'); ?>" method="GET" id="heroSearchForm">
                                <div class="search-input-group">
                                    <input 
                                        type="text" 
                                        name="q"
                                        class="search-input" 
                                        placeholder="Try: 'Books like Harry Potter' or 'Something romantic for tonight'"
                                        autocomplete="off"
                                        id="heroSearchInput"
                                    />
                                    <button type="submit" class="search-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            
                            <div class="search-suggestions">
                                <a href="<?php echo base_url('frontend/search?q=mystery+novels'); ?>" class="suggestion-chip">Mystery Novels</a>
                                <a href="<?php echo base_url('frontend/search?q=sci-fi+adventure'); ?>" class="suggestion-chip">Sci-Fi Adventure</a>
                                <a href="<?php echo base_url('frontend/search?q=romantic+comedy'); ?>" class="suggestion-chip">Romantic Comedy</a>
                                <a href="<?php echo base_url('frontend/search?q=books+for+rainy+day'); ?>" class="suggestion-chip">Rainy Day Reads</a>
                                <a href="<?php echo base_url('frontend/search?q=award+winning+books'); ?>" class="suggestion-chip">Award Winners</a>
                            </div>
                        </div>
                        
                        <div class="hero-cta">
                            <a href="<?php echo base_url('frontend/ai_assistant'); ?>" class="btn-hero-primary">
                                <i class="fas fa-robot"></i>
                                Chat with AI Assistant
                            </a>
                            <a href="<?php echo base_url('frontend/category'); ?>" class="btn-hero-secondary">
                                <i class="fas fa-book"></i>
                                Browse Library
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">Why Choose LibraryPlus?</div>
                <h2 class="section-title">Powered by Artificial Intelligence</h2>
                <p class="section-subtitle">
                    Experience the next generation of library management with cutting-edge AI features 
                    designed to revolutionize how you discover and enjoy books.
                </p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3 class="feature-title">AI-Powered Search</h3>
                        <p class="feature-description">
                            Search using natural language. Ask for "books like Harry Potter" or 
                            "something to make me laugh" and get intelligent, contextual results.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3 class="feature-title">Personal Recommendations</h3>
                        <p class="feature-description">
                            Get personalized book suggestions based on your reading history, 
                            preferences, and mood. Discover hidden gems you'll absolutely love.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3 class="feature-title">Smart Assistant</h3>
                        <p class="feature-description">
                            Chat with our AI librarian for instant book recommendations, 
                            reading advice, and answers to any book-related questions.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">Access Anywhere</h3>
                        <p class="feature-description">
                            Responsive design ensures perfect experience on desktop, tablet, 
                            and mobile. Access your library from anywhere, anytime.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Reading Analytics</h3>
                        <p class="feature-description">
                            Track your reading progress, discover patterns in your preferences, 
                            and set reading goals with detailed analytics and insights.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">Secure & Reliable</h3>
                        <p class="feature-description">
                            Enterprise-grade security with regular backups, role-based access, 
                            and data protection to keep your library safe and secure.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item">
                        <span class="stat-number" data-target="10000">0</span>
                        <span class="stat-label">Books Available</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item">
                        <span class="stat-number" data-target="5000">0</span>
                        <span class="stat-label">Happy Readers</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item">
                        <span class="stat-number" data-target="25000">0</span>
                        <span class="stat-label">AI Recommendations</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-item">
                        <span class="stat-number" data-target="98">0</span>
                        <span class="stat-label">% Satisfaction Rate</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="about">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Transform Your Reading Experience?</h2>
                <p class="cta-subtitle">
                    Join thousands of readers who have discovered their next favorite books with our 
                    AI-powered recommendation system. Start your intelligent reading journey today.
                </p>
                
                <div class="cta-buttons">
                    <a href="<?php echo base_url('login/registermember'); ?>" class="btn-cta-primary">
                        <i class="fas fa-user-plus"></i>
                        Get Started Free
                    </a>
                    <a href="<?php echo base_url('frontend/ai_assistant'); ?>" class="btn-cta-secondary">
                        <i class="fas fa-robot"></i>
                        Try AI Assistant
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div>
                    <div class="footer-brand">
                        <i class="fas fa-book-open me-2"></i>LibraryPlus
                    </div>
                    <p class="footer-description">
                        The next generation library management system powered by artificial intelligence. 
                        Discover, explore, and enjoy books like never before.
                    </p>
                </div>
                
                <div>
                    <h4 class="footer-title">Features</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo base_url('frontend/ai_assistant'); ?>">AI Assistant</a></li>
                        <li><a href="<?php echo base_url('frontend/search'); ?>">Smart Search</a></li>
                        <li><a href="<?php echo base_url('frontend/category'); ?>">Browse Books</a></li>
                        <li><a href="<?php echo base_url('frontend/recommendations'); ?>">Recommendations</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="footer-title">Account</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
                        <li><a href="<?php echo base_url('login/registermember'); ?>">Register</a></li>
                        <li><a href="<?php echo base_url('myaccount'); ?>">My Account</a></li>
                        <li><a href="<?php echo base_url('login/forgotpassword'); ?>">Reset Password</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="footer-title">Support</h4>
                    <ul class="footer-links">
                        <li><a href="#help">Help Center</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="#privacy">Privacy Policy</a></li>
                        <li><a href="#terms">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 LibraryPlus. All rights reserved. Powered by AI for the future of reading.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current).toLocaleString();
                }, 16);
            });
        }

        // Trigger counter animation when stats section is visible
        const statsSection = document.querySelector('.stats');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        if (statsSection) {
            observer.observe(statsSection);
        }

        // Enhanced search form
        document.getElementById('heroSearchForm').addEventListener('submit', function(e) {
            const input = document.getElementById('heroSearchInput');
            const button = document.querySelector('.search-btn');
            
            if (!input.value.trim()) {
                e.preventDefault();
                input.focus();
                return;
            }
            
            button.classList.add('loading');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Auto-focus search on page load
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('heroSearchInput');
            if (searchInput) {
                // Small delay to ensure page is fully loaded
                setTimeout(() => {
                    searchInput.focus();
                }, 500);
            }
        });
    </script>
</body>
</html>