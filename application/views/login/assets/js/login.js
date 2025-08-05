// Login Page Functionality

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const usernameInput = document.getElementById('username_or_email');
    const passwordInput = document.getElementById('password');
    
    // Form validation
    function validateForm() {
        let isValid = true;
        
        // Reset previous error states
        document.querySelectorAll('.form-group').forEach(group => {
            group.classList.remove('has-error');
        });
        
        // Validate username/email
        if (!usernameInput.value.trim()) {
            usernameInput.closest('.form-group').classList.add('has-error');
            isValid = false;
        }
        
        // Validate password
        if (!passwordInput.value.trim()) {
            passwordInput.closest('.form-group').classList.add('has-error');
            isValid = false;
        }
        
        return isValid;
    }
    
    // Handle form submission
    loginForm.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            
            // Show error message
            loginBtn.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Please fix errors';
            loginBtn.style.background = '#e74c3c';
            
            setTimeout(() => {
                loginBtn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i>Sign In';
                loginBtn.style.background = '';
            }, 2000);
            
            return false;
        }
        
        // Show loading state
        loginBtn.disabled = true;
        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing In...';
    });
    
    // Real-time validation
    [usernameInput, passwordInput].forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim()) {
                this.closest('.form-group').classList.remove('has-error');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.closest('.form-group').classList.contains('has-error') && this.value.trim()) {
                this.closest('.form-group').classList.remove('has-error');
            }
        });
    });
    
    // Handle Enter key submission
    [usernameInput, passwordInput].forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                loginForm.dispatchEvent(new Event('submit'));
            }
        });
    });
    
    // Auto-focus first input
    setTimeout(() => {
        usernameInput.focus();
    }, 300);
});