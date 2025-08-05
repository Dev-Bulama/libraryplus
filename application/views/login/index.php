<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $get_title ?? 'Login - LibraryPlus'; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --light-bg: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --shadow-light: 0 5px 15px rgba(0,0,0,0.08);
            --shadow-medium: 0 10px 30px rgba(0,0,0,0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gradient-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="25" cy="25" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="0.8" fill="rgba(255,255,255,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.6;
            animation: float 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }

        /* Floating Shapes */
        .floating-shape {
            position: absolute;
            opacity: 0.1;
            animation: floatShapes 15s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            top: 70%;
            right: 10%;
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 20px;
            animation-delay: 5s;
        }

        .floating-shape:nth-child(3) {
            bottom: 10%;
            left: 20%;
            width: 60px;
            height: 60px;
            background: white;
            transform: rotate(45deg);
            animation-delay: 10s;
        }

        @keyframes floatShapes {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(15px) rotate(240deg); }
        }

        /* Header */
        .header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 1rem 2rem;
            z-index: 100;
        }

        .header .navbar-brand {
            color: white !important;
            font-size: 1.8rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .header .navbar-brand:hover {
            transform: scale(1.05);
            color: rgba(255,255,255,0.9) !important;
        }

        .header .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .header .nav-link {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .header .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            backdrop-filter: blur(10px);
        }

        .header .btn-home {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .header .btn-home:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Main Container */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: var(--shadow-medium);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-secondary);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.08)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.05)"/></svg>') repeat;
            animation: rotate 30s linear infinite;
            opacity: 0.3;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-icon {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .hero-icon i {
            font-size: 3rem;
            color: white;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .hero-features {
            list-style: none;
            text-align: left;
        }

        .hero-features li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .hero-features i {
            color: rgba(255, 255, 255, 0.8);
            width: 20px;
        }

        /* Login Form Section */
        .form-section {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary-color);
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .form-control.is-invalid {
            border-color: var(--accent-color);
            background: #fff5f5;
        }

        .input-group {
            position: relative;
        }

        .input-group-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .input-group-icon:hover {
            color: var(--secondary-color);
        }

        .btn-login {
            width: 100%;
            padding: 1rem 2rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .form-footer a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: var(--primary-color);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            gap: 1rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .error-message {
            background: #fff5f5;
            color: var(--accent-color);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid var(--accent-color);
            font-size: 0.9rem;
        }

        .error-message i {
            margin-right: 0.5rem;
        }

        /* Loading State */
        .btn-login.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-login.loading::after {
            content: '';
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }

            .header .nav-links {
                gap: 0.5rem;
            }

            .login-card {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 1rem;
            }

            .hero-section {
                padding: 2rem;
                min-height: 300px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .form-section {
                padding: 2rem;
            }

            .floating-shape {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1rem 0.5rem;
            }

            .hero-section,
            .form-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Shapes -->
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>

    <!-- Header -->
    <header class="header">
        <div class="d-flex justify-content-between align-items-center">
            <a href="<?php echo base_url(); ?>" class="navbar-brand">
                <i class="fas fa-book-open me-2"></i>LibraryPlus
            </a>
            <div class="nav-links">
                <a href="<?php echo base_url(); ?>" class="nav-link">
                    <i class="fas fa-home me-1"></i>Home
                </a>
                <a href="<?php echo base_url('frontend/ai_assistant'); ?>" class="nav-link">
                    <i class="fas fa-robot me-1"></i>AI Assistant
                </a>
                <a href="<?php echo base_url(); ?>" class="btn-home">
                    <i class="fas fa-arrow-left me-1"></i>Back to Library
                </a>
            </div>
        </div>
    </header>

    <!-- Main Login Container -->
    <div class="login-container">
        <div class="login-card">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="hero-content">
                    <div class="hero-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h1 class="hero-title">Welcome Back!</h1>
                    <p class="hero-subtitle">
                        Access your LibraryPlus admin dashboard and manage your library with AI-powered tools
                    </p>
                    
                    <ul class="hero-features">
                        <li>
                            <i class="fas fa-brain"></i>
                            <span>AI-Powered Book Management</span>
                        </li>
                        <li>
                            <i class="fas fa-users"></i>
                            <span>Member Management System</span>
                        </li>
                        <li>
                            <i class="fas fa-chart-line"></i>
                            <span>Advanced Analytics & Reports</span>
                        </li>
                        <li>
                            <i class="fas fa-shield-alt"></i>
                            <span>Secure & Reliable Platform</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Login Form Section -->
            <div class="form-section">
                <div class="form-header">
                    <h2 class="form-title">Admin Login</h2>
                    <p class="form-subtitle">Sign in to your account to continue</p>
                </div>

                <!-- Error Messages -->
                <?php if (isset($errors) && !empty($errors)): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?php foreach ($errors as $error): ?>
                            <?php echo htmlspecialchars($error); ?><br>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form action="<?php echo base_url('login/index'); ?>" method="post" id="loginForm">
                    <div class="form-group">
                        <label class="form-label" for="username_or_email">
                            <?php echo $this->lang->line('login_username_or_email') ?? 'Username or Email'; ?>
                            <span style="color: var(--accent-color);">*</span>
                        </label>
                        <div class="input-group">
                            <input 
                                type="text" 
                                id="username_or_email" 
                                class="form-control <?php echo form_error('username_or_email') ? 'is-invalid' : ''; ?>" 
                                name="username_or_email" 
                                value="<?php echo set_value('username_or_email'); ?>"
                                placeholder="Enter your username or email"
                                required
                            />
                            <span class="input-group-icon">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">
                            <?php echo $this->lang->line('login_password') ?? 'Password'; ?>
                            <span style="color: var(--accent-color);">*</span>
                        </label>
                        <div class="input-group">
                            <input 
                                type="password" 
                                id="password" 
                                class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" 
                                name="password"
                                placeholder="Enter your password"
                                required
                            />
                            <span class="input-group-icon" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <?php echo $this->lang->line('login_signin') ?? 'Sign In'; ?>
                    </button>
                </form>

                <div class="divider">
                    <span>New to LibraryPlus?</span>
                </div>

                <div class="form-footer">
                    <p class="mb-2">
                        <a href="<?php echo base_url('login/resetpassword'); ?>">
                            <i class="fas fa-key me-1"></i>Forgot Password?
                        </a>
                    </p>
                    <p class="mb-0">
                        Need an account? 
                        <!--<a href="<?//php echo base_url('login/registermember'); ?>">-->
                            <i class="fas fa-user-plus me-1"></i>CONSULT LIBRARIAN
                        </a>
                    </p>
                    <p class="mt-3">
                        <a href="<?php echo base_url(); ?>" class="text-muted">
                            <i class="fas fa-arrow-left me-1"></i>Back to Library Homepage
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordField.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }
        }

        // Enhanced Form Submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            const username = document.getElementById('username_or_email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!username || !password) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return;
            }

            // Add loading state
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
        });

        // Auto-focus first input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username_or_email').focus();
        });

        // Remove loading state if there are errors
        window.addEventListener('pageshow', function() {
            const loginBtn = document.getElementById('loginBtn');
            loginBtn.classList.remove('loading');
            loginBtn.disabled = false;
        });
    </script>
</body>
</html>