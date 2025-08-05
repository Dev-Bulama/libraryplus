<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $get_title ?? 'Register - LibraryPlus'; ?></title>
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
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6rem 1rem 2rem;
            position: relative;
            z-index: 10;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: var(--shadow-medium);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 700px;
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

        /* Form Section */
        .form-section {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-height: 700px;
            overflow-y: auto;
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
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary-color);
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .has-error .form-control {
            border-color: var(--accent-color);
            background: #fff5f5;
        }

        .text-red {
            color: var(--accent-color);
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: block;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* File Upload Styling */
        .image-preview {
            position: relative;
        }

        .image-preview-filename {
            background: #f8f9fa !important;
        }

        .image-preview-input {
            overflow: hidden;
            position: relative;
        }

        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .btn-success {
            background: var(--success-color);
            border-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background: #219a52;
            border-color: #219a52;
        }

        .btn-register {
            width: 100%;
            padding: 1rem 2rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 1rem 0;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .btn-back {
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            color: white;
        }

        .form-footer {
            text-align: center;
            margin-top: 1rem;
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
            margin: 1rem 0;
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

        .alert {
            padding: 0.875rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid;
            font-size: 0.9rem;
        }

        .alert-info {
            background: #f0f9ff;
            color: var(--secondary-color);
            border-left-color: var(--secondary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-card {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 1rem;
            }

            .hero-section {
                padding: 2rem;
                min-height: 250px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .form-section {
                padding: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 4rem 0.5rem 1rem;
            }

            .hero-section,
            .form-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="d-flex justify-content-between align-items-center">
            <a href="<?php echo base_url(); ?>" class="navbar-brand">
                <i class="fas fa-book-open me-2"></i><?php echo $generalsetting->sitename ?? 'LibraryPlus'; ?>
            </a>
            <div class="nav-links">
                <a href="<?php echo base_url(); ?>" class="nav-link">
                    <i class="fas fa-home me-1"></i>Home
                </a>
                <a href="<?php echo base_url('login'); ?>" class="nav-link">
                    <i class="fas fa-sign-in-alt me-1"></i>Login
                </a>
                <a href="<?php echo base_url(); ?>" class="btn-home">
                    <i class="fas fa-arrow-left me-1"></i>Back to Library
                </a>
            </div>
        </div>
    </header>

    <!-- Main Registration Container -->
    <div class="register-container">
        <div class="register-card">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="hero-content">
                    <div class="hero-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h1 class="hero-title">Join Our Library</h1>
                    <p class="hero-subtitle">
                        Create your account and discover amazing books with our AI-powered recommendations
                    </p>
                    
                    <ul class="hero-features">
                        <li>
                            <i class="fas fa-robot"></i>
                            <span>AI-Powered Book Recommendations</span>
                        </li>
                        <li>
                            <i class="fas fa-search"></i>
                            <span>Smart Search & Discovery</span>
                        </li>
                        <li>
                            <i class="fas fa-bookmark"></i>
                            <span>Track Your Reading Journey</span>
                        </li>
                        <li>
                            <i class="fas fa-comments"></i>
                            <span>Chat with AI Book Assistant</span>
                        </li>
                        <li>
                            <i class="fas fa-mobile-alt"></i>
                            <span>Access Anywhere, Anytime</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Registration Form Section -->
            <div class="form-section">
                <div class="form-header">
                    <h2 class="form-title">Create Account</h2>
                    <p class="form-subtitle"><?php echo $this->lang->line('login_provide_validinformation') ?? 'Please provide valid information to create your account'; ?></p>
                </div>

                <!-- Success/Info Message -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <!-- Registration Form -->
                <form action="<?php echo base_url('login/registermember'); ?>" method="post" enctype="multipart/form-data" id="registerForm">
                    <div class="form-group <?php echo form_error('name') ? 'has-error' : ''; ?>">
                        <label class="form-label" for="name">
                            <?php echo $this->lang->line('login_name') ?? 'Full Name'; ?>
                            <span class="text-red">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            class="form-control" 
                            name="name" 
                            value="<?php echo set_value('name'); ?>"
                            placeholder="Enter your full name"
                            required
                        />
                        <?php echo form_error('name', '<span class="text-red">', '</span>'); ?>
                    </div>

                    <div class="form-row">
                        <div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
                            <label class="form-label" for="email">
                                <?php echo $this->lang->line('login_email') ?? 'Email Address'; ?>
                                <span class="text-red">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                class="form-control" 
                                name="email" 
                                value="<?php echo set_value('email'); ?>"
                                placeholder="your@email.com"
                                required
                            />
                            <?php echo form_error('email', '<span class="text-red">', '</span>'); ?>
                        </div>

                        <div class="form-group <?php echo form_error('phone') ? 'has-error' : ''; ?>">
                            <label class="form-label" for="phone">
                                <?php echo $this->lang->line('login_phone') ?? 'Phone Number'; ?>
                                <span class="text-red">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                class="form-control" 
                                name="phone" 
                                value="<?php echo set_value('phone'); ?>"
                                placeholder="Your phone number"
                                required
                            />
                            <?php echo form_error('phone', '<span class="text-red">', '</span>'); ?>
                        </div>
                    </div>

                    <div class="form-group <?php echo form_error('photo') ? 'has-error' : ''; ?>">
                        <label for="photo" class="form-label">
                            <?php echo $this->lang->line("login_photo") ?? 'Profile Photo'; ?>
                            <span class="text-red">*</span>
                        </label>
                        <div class="input-group image-preview">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled" placeholder="Choose your profile photo">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="fa fa-remove"></span><?php echo $this->lang->line('login_clear') ?? 'Clear'; ?>
                                </button>
                                <div class="btn btn-success image-preview-input">
                                    <span class="fa fa-repeat"></span>
                                    <span class="image-preview-input-title"><?php echo $this->lang->line('login_filebrowse') ?? 'Browse'; ?></span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="photo" required/>
                                </div>
                            </span>
                        </div>
                        <?php echo form_error('photo', '<span class="text-red">', '</span>'); ?>
                    </div>

                    <div class="form-row">
                        <div class="form-group <?php echo form_error('username') ? 'has-error' : ''; ?>">
                            <label class="form-label" for="username">
                                <?php echo $this->lang->line('login_username') ?? 'Username'; ?>
                                <span class="text-red">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="username" 
                                class="form-control" 
                                name="username" 
                                value="<?php echo set_value('username'); ?>"
                                placeholder="Choose a username"
                                minlength="4"
                                maxlength="20"
                                required
                            />
                            <?php echo form_error('username', '<span class="text-red">', '</span>'); ?>
                        </div>

                        <div class="form-group <?php echo form_error('password') ? 'has-error' : ''; ?>">
                            <label class="form-label" for="password">
                                <?php echo $this->lang->line('login_password') ?? 'Password'; ?>
                                <span class="text-red">*</span>
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                class="form-control" 
                                name="password" 
                                value="<?php echo set_value('password'); ?>"
                                placeholder="Create a secure password"
                                minlength="6"
                                required
                            />
                            <?php echo form_error('password', '<span class="text-red">', '</span>'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <a href="<?php echo base_url('login/index'); ?>" class="btn btn-back btn-block">
                                <i class="fas fa-arrow-left me-1"></i>
                                <?php echo $this->lang->line('login_back_to_login') ?? 'Back to Login'; ?>
                            </a>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn-register" id="registerBtn">
                                <i class="fas fa-user-plus me-2"></i>
                                <?php echo $this->lang->line('login_submit') ?? 'Create Account'; ?>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="divider">
                    <span>Already have an account?</span>
                </div>

                <div class="form-footer">
                    <p class="mb-0">
                        <a href="<?php echo base_url('login'); ?>">
                            <i class="fas fa-sign-in-alt me-1"></i>Sign In Instead
                        </a>
                    </p>
                    <p class="mt-2">
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
    <script type="text/javascript">
        var globalFilebrowse = "<?php echo $this->lang->line('filebrowse') ?? 'Browse'; ?>";
    </script>
    <script src="<?php echo base_url('assets/custom/js/fileupload.js'); ?>"></script>
    
    <script>
        // Form Validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const registerBtn = document.getElementById('registerBtn');
            const requiredFields = ['name', 'email', 'phone', 'username', 'password'];
            
            let isValid = true;
            
            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                const formGroup = input.closest('.form-group');
                
                if (!input.value.trim()) {
                    isValid = false;
                    formGroup.classList.add('has-error');
                } else {
                    formGroup.classList.remove('has-error');
                }
            });

            // Email validation
            const email = document.getElementById('email').value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                isValid = false;
                document.getElementById('email').closest('.form-group').classList.add('has-error');
            }

            // Password validation
            const password = document.getElementById('password').value;
            if (password.length < 6) {
                isValid = false;
                document.getElementById('password').closest('.form-group').classList.add('has-error');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields correctly.');
                return;
            }

            // Add loading state
            registerBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Account...';
            registerBtn.disabled = true;
        });

        // Real-time validation
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('blur', function() {
                const formGroup = this.closest('.form-group');
                if (this.hasAttribute('required') && !this.value.trim()) {
                    formGroup.classList.add('has-error');
                } else {
                    formGroup.classList.remove('has-error');
                }
            });
        });

        // Auto-focus first input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('name').focus();
        });
    </script>
</body>
</html>