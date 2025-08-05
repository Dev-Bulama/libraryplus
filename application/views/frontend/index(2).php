<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraryPlus - AI-Powered Digital Library</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --success-color: #4ade80;
            --warning-color: #fbbf24;
            --error-color: #ef4444;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --bg-tertiary: #f3f4f6;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --text-muted: #9ca3af;
            --bg-primary: #111827;
            --bg-secondary: #1f2937;
            --bg-tertiary: #374151;
            --border-color: #374151;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: var(--transition);
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            transition: var(--transition);
        }

        [data-theme="dark"] .navbar {
            background: rgba(17, 24, 39, 0.95);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
            text-decoration: none;
        }

        .nav-brand i {
            margin-right: 0.75rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 1px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .theme-toggle:hover {
            background: var(--bg-tertiary);
            color: var(--primary-color);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Hero Section */
        .hero {
            padding: 8rem 2rem 4rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
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
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 3rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* AI Search Bar */
        .ai-search-container {
            max-width: 600px;
            margin: 0 auto 3rem;
            position: relative;
        }

        .ai-search-bar {
            width: 100%;
            padding: 1.25rem 1.5rem 1.25rem 4rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            background: rgba(255, 255, 255, 0.95);
            color: var(--text-primary);
            box-shadow: var(--shadow-xl);
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .ai-search-bar:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.3);
        }

        .search-icon {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        .search-btn {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .search-btn:hover {
            background: var(--secondary-color);
        }

        /* Search Suggestions */
        .search-suggestions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .suggestion-chip {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .suggestion-chip:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Stats Section */
        .stats-section {
            padding: 4rem 2rem;
            background: var(--bg-secondary);
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .stat-card {
            background: var(--bg-primary);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            text-align: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* Categories Section */
        .categories-section {
            padding: 4rem 2rem;
        }

        .section-header {
            max-width: 1200px;
            margin: 0 auto 3rem;
            text-align: center;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        .categories-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .category-card {
            background: var(--bg-primary);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .category-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            position: relative;
            overflow: hidden;
        }

        .category-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }

        .category-content {
            padding: 1.5rem;
        }

        .category-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .category-description {
            color: var(--text-secondary);
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .category-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .category-stat {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .category-stat strong {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* AI Features Section */
        .ai-features {
            padding: 4rem 2rem;
            background: var(--bg-secondary);
        }

        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3rem;
        }

        .feature-card {
            background: var(--bg-primary);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .feature-description {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .feature-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .feature-link:hover {
            gap: 1rem;
        }

        /* Virtual Librarian Chat */
        .chat-fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            z-index: 1000;
        }

        .chat-fab:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-xl);
        }

        .chat-widget {
            position: fixed;
            bottom: 100px;
            right: 2rem;
            width: 350px;
            height: 500px;
            background: var(--bg-primary);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-xl);
            display: none;
            flex-direction: column;
            z-index: 1000;
            border: 1px solid var(--border-color);
        }

        .chat-header {
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-messages {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
        }

        .chat-input-container {
            padding: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .chat-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 25px;
            outline: none;
            background: var(--bg-secondary);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero {
                padding: 6rem 1rem 3rem;
            }

            .categories-grid,
            .features-grid {
                grid-template-columns: 1fr;
            }

            .chat-widget {
                width: calc(100% - 2rem);
                right: 1rem;
                left: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        .chat-fab {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                <i class="fas fa-brain"></i>
                LibraryPlus AI
            </a>
            
            <ul class="nav-menu">
                <li><a href="#" class="nav-link active">Home</a></li>
                <li><a href="#" class="nav-link">Discover</a></li>
                <li><a href="#" class="nav-link">Categories</a></li>
                <li><a href="#" class="nav-link">Community</a></li>
                <li><a href="#" class="nav-link">Reading List</a></li>
            </ul>
            
            <div class="nav-actions">
                <button class="theme-toggle" onclick="toggleTheme()">
                    <i class="fas fa-moon"></i>
                </button>
                <a href="#" class="btn btn-outline">Sign In</a>
                <a href="#" class="btn btn-primary">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-sparkles"></i> Powered by Advanced AI
            </div>
            
            <h1 class="hero-title">Discover Your Next Great Read</h1>
            <p class="hero-subtitle">
                Experience the future of digital libraries with AI-powered recommendations, 
                intelligent search, and personalized book discovery.
            </p>
            
            <div class="ai-search-container">
                <i class="fas fa-magic search-icon"></i>
                <input 
                    type="text" 
                    class="ai-search-bar" 
                    placeholder="Ask me anything... 'Books like Harry Potter' or 'Romance novels set in Paris'"
                    id="aiSearchInput"
                >
                <button class="search-btn" onclick="performAISearch()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <div class="search-suggestions">
                <div class="suggestion-chip" onclick="suggestSearch('fantasy books with magic')">Fantasy with Magic</div>
                <div class="suggestion-chip" onclick="suggestSearch('sci-fi novels under 300 pages')">Short Sci-Fi</div>
                <div class="suggestion-chip" onclick="suggestSearch('books that will make me cry')">Emotional Reads</div>
                <div class="suggestion-chip" onclick="suggestSearch('best books of 2024')">2024 Bestsellers</div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-card animate-fade-in">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-number" data-count="50000">0</div>
                <div class="stat-label">Digital Books</div>
            </div>
            
            <div class="stat-card animate-fade-in">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number" data-count="25000">0</div>
                <div class="stat-label">Active Readers</div>
            </div>
            
            <div class="stat-card animate-fade-in">
                <div class="stat-icon">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="stat-number" data-count="1000000">0</div>
                <div class="stat-label">AI Recommendations</div>
            </div>
            
            <div class="stat-card animate-fade-in">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-number" data-count="98">0</div>
                <div class="stat-label">User Satisfaction</div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="section-header">
            <h2 class="section-title">Explore by Category</h2>
            <p class="section-subtitle">
                Discover curated collections across all genres with AI-powered insights and recommendations
            </p>
        </div>
        
        <div class="categories-grid">
            <div class="category-card" onclick="exploreCategory('fiction')">
                <div class="category-image">
                    <div class="category-overlay">
                        <i class="fas fa-feather"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3 class="category-title">Fiction & Literature</h3>
                    <p class="category-description">
                        Immerse yourself in captivating stories, from contemporary fiction to timeless classics.
                    </p>
                    <div class="category-stats">
                        <span class="category-stat"><strong>12,500+</strong> books</span>
                        <span class="category-stat"><strong>4.8★</strong> avg rating</span>
                    </div>
                </div>
            </div>
            
            <div class="category-card" onclick="exploreCategory('science')">
                <div class="category-image">
                    <div class="category-overlay">
                        <i class="fas fa-atom"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3 class="category-title">Science & Technology</h3>
                    <p class="category-description">
                        Stay current with the latest developments in science, technology, and innovation.
                    </p>
                    <div class="category-stats">
                        <span class="category-stat"><strong>8,200+</strong> books</span>
                        <span class="category-stat"><strong>4.7★</strong> avg rating</span>
                    </div>
                </div>
            </div>
            
            <div class="category-card" onclick="exploreCategory('history')">
                <div class="category-image">
                    <div class="category-overlay">
                        <i class="fas fa-landmark"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3 class="category-title">History & Biography</h3>
                    <p class="category-description">
                        Explore the past through compelling historical accounts and inspiring biographies.
                    </p>
                    <div class="category-stats">
                        <span class="category-stat"><strong>6,800+</strong> books</span>
                        <span class="category-stat"><strong>4.6★</strong> avg rating</span>
                    </div>
                </div>
            </div>
            
            <div class="category-card" onclick="exploreCategory('business')">
                <div class="category-image">
                    <div class="category-overlay">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3 class="category-title">Business & Economics</h3>
                    <p class="category-description">
                        Master business strategies, economics, and entrepreneurship with expert insights.
                    </p>
                    <div class="category-stats">
                        <span class="category-stat"><strong>5,400+</strong> books</span>
                        <span class="category-stat"><strong>4.5★</strong> avg rating</span>
                    </div>
                </div>
            </div>
            
            <div class="category-card" onclick="exploreCategory('health')">
                <div class="category-image">
                    <div class="category-overlay">
                        <i class="fas fa-heart"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3 class="category-title">Health & Wellness</h3>
                    <p class="category-description">
                        Improve your well-being with comprehensive guides on health, fitness, and mindfulness.
                    </p>
                    <div class="category-stats">
                        <span class="category-stat"><strong>4,100+</strong> books</span>
                        <span class="category-stat"><strong>4.7★</strong> avg rating</span>
                    </div>
                </div>
            </div>
            
            <div class="category-card" onclick="exploreCategory('arts')">
                <div class="category-image">
                    <div class="category-overlay">
                        <i class="fas fa-palette"></i>
                    </div>
                </div>
                <div class="category-content">
                    <h3 class="category-title">Arts & Culture</h3>
                    <p class="category-description">
                        Dive into the world of art, music, culture, and creative expression.
                    </p>
                    <div class="category-stats">
                        <span class="category-stat"><strong>3,600+</strong> books</span>
                        <span class="category-stat"><strong>4.8★</strong> avg rating</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Features Section -->
    <section class="ai-features">
        <div class="section-header">
            <h2 class="section-title">AI-Powered Features</h2>
            <p class="section-subtitle">
                Experience the next generation of digital reading with intelligent features designed for you
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3 class="feature-title">Smart Recommendations</h3>
                <p class="feature-description">
                    Our AI analyzes your reading patterns, preferences, and mood to suggest books you'll love. 
                    Get personalized recommendations that evolve with your taste.
                </p>
                <a href="#" class="feature-link">
                    Explore Recommendations <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 class="feature-title">Virtual Librarian</h3>
                <p class="feature-description">
                    Chat with our AI librarian for instant help. Ask questions about books, get reading suggestions, 
                    or find specific information. Available 24/7.
                </p>
                <a href="#" class="feature-link" onclick="toggleChat()">
                    Start Chatting <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="feature-title">Semantic Search</h3>
                <p class="feature-description">
                    Search using natural language. Ask for "books that will make me think" or "stories about redemption" 
                    and find exactly what you're looking for.
                </p>
                <a href="#" class="feature-link">
                    Try Advanced Search <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Virtual Librarian Chat Widget -->
    <button class="chat-fab" onclick="toggleChat()">
        <i class="fas fa-comments"></i>
    </button>

    <div class="chat-widget" id="chatWidget">
        <div class="chat-header">
            <div>
                <h4 style="margin: 0; font-size: 1rem;">AI Librarian</h4>
                <small style="opacity: 0.8;">Always here to help</small>
            </div>
            <button style="background: none; border: none; color: white; cursor: pointer;" onclick="toggleChat()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="chat-messages" id="chatMessages">
            <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px; margin-bottom: 1rem;">
                <p style="margin: 0; color: var(--text-secondary); font-size: 0.9rem;">
                    👋 Hi! I'm your AI librarian. I can help you find books, answer questions, or provide reading recommendations. What can I help you with today?
                </p>
            </div>
        </div>
        
        <div class="chat-input-container">
            <input 
                type="text" 
                class="chat-input" 
                placeholder="Ask me anything about books..."
                id="chatInput"
                onkeypress="handleChatInput(event)"
            >
        </div>
    </div>

    <script>
        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const themeToggle = document.querySelector('.theme-toggle i');
            
            if (html.getAttribute('data-theme') === 'dark') {
                html.removeAttribute('data-theme');
                themeToggle.className = 'fas fa-moon';
                localStorage.setItem('theme', 'light');
            } else {
                html.setAttribute('data-theme', 'dark');
                themeToggle.className = 'fas fa-sun';
                localStorage.setItem('theme', 'dark');
            }
        }

        // Initialize theme from localStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.querySelector('.theme-toggle i').className = 'fas fa-sun';
        }

        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number[data-count]');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const increment = target / 100;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString() + (target === 98 ? '%' : '');
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 20);
            });
        }

        // AI Search
        function performAISearch() {
            const query = document.getElementById('aiSearchInput').value;
            if (query.trim()) {
                // Simulate AI search - replace with actual implementation
                alert(`Searching for: "${query}"\n\nThis would perform an AI-powered semantic search!`);
            }
        }

        function suggestSearch(query) {
            document.getElementById('aiSearchInput').value = query;
            performAISearch();
        }

        // Category Exploration
        function exploreCategory(category) {
            alert(`Exploring ${category} category!\n\nThis would navigate to the category page with AI-powered filtering and recommendations.`);
        }

        // Chat Widget
        function toggleChat() {
            const chatWidget = document.getElementById('chatWidget');
            const isVisible = chatWidget.style.display === 'flex';
            chatWidget.style.display = isVisible ? 'none' : 'flex';
        }

        function handleChatInput(event) {
            if (event.key === 'Enter') {
                const input = document.getElementById('chatInput');
                const message = input.value.trim();
                if (message) {
                    addChatMessage(message, 'user');
                    input.value = '';
                    
                    // Simulate AI response
                    setTimeout(() => {
                        const response = generateAIResponse(message);
                        addChatMessage(response, 'ai');
                    }, 1000);
                }
            }
        }

        function addChatMessage(message, sender) {
            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.style.cssText = `
                padding: 0.75rem;
                margin-bottom: 1rem;
                border-radius: 10px;
                background: ${sender === 'user' ? 'var(--primary-color)' : 'var(--bg-secondary)'};
                color: ${sender === 'user' ? 'white' : 'var(--text-primary)'};
                font-size: 0.9rem;
                line-height: 1.4;
                ${sender === 'user' ? 'margin-left: 2rem; text-align: right;' : 'margin-right: 2rem;'}
            `;
            messageDiv.textContent = message;
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function generateAIResponse(message) {
            const responses = {
                'help': "I can help you find books, get recommendations, answer questions about our library, or assist with research. What are you looking for?",
                'recommend': "I'd be happy to recommend books! What genres do you enjoy? Are you looking for fiction or non-fiction? Any specific topics or moods?",
                'fiction': "Great choice! Some popular fiction categories include contemporary fiction, historical fiction, mystery/thriller, romance, and literary fiction. Which appeals to you?",
                'science': "Science books are fascinating! Are you interested in popular science, academic texts, biographies of scientists, or specific fields like physics, biology, or chemistry?",
                'fantasy': "Fantasy is amazing! Some top recommendations: 'The Name of the Wind' by Patrick Rothfuss, 'The Way of Kings' by Brandon Sanderson, and 'The Priory of the Orange Tree' by Samantha Shannon. Want more details on any of these?"
            };
            
            const lowerMessage = message.toLowerCase();
            for (const key in responses) {
                if (lowerMessage.includes(key)) {
                    return responses[key];
                }
            }
            
            return "That's an interesting question! I can help you find books on that topic or provide more specific recommendations. Could you tell me more about what you're looking for?";
        }

        // Initialize animations when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Animate counters when stats section comes into view
            const statsSection = document.querySelector('.stats-section');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.disconnect();
                    }
                });
            });
            observer.observe(statsSection);

            // Search input focus
            document.getElementById('aiSearchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performAISearch();
                }
            });
        });
    </script>
</body>
</html>