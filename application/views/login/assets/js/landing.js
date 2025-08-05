// Landing Page Animations and Interactions

document.addEventListener('DOMContentLoaded', function() {
    // Demo typing animation
    const demoText = document.getElementById('demoText');
    const demoResponse = document.getElementById('demoResponse');
    
    const messages = [
        "I want a fantasy book with magic and dragons",
        "Recommend me something funny to read",
        "What's a good book for a rainy day?",
        "I loved Harry Potter, what's similar?"
    ];
    
    let currentMessageIndex = 0;
    let currentCharIndex = 0;
    let isTyping = true;
    
    function typeMessage() {
        if (isTyping) {
            const currentMessage = messages[currentMessageIndex];
            
            if (currentCharIndex < currentMessage.length) {
                demoText.textContent = currentMessage.slice(0, currentCharIndex + 1);
                currentCharIndex++;
                setTimeout(typeMessage, 100);
            } else {
                isTyping = false;
                setTimeout(() => {
                    showResponse();
                }, 1000);
            }
        }
    }
    
    function showResponse() {
        demoResponse.style.display = 'flex';
        setTimeout(() => {
            hideResponse();
        }, 3000);
    }
    
    function hideResponse() {
        demoResponse.style.display = 'none';
        currentCharIndex = 0;
        currentMessageIndex = (currentMessageIndex + 1) % messages.length;
        isTyping = true;
        setTimeout(() => {
            typeMessage();
        }, 1000);
    }
    
    // Start the demo
    setTimeout(() => {
        typeMessage();
    }, 2000);
    
    // Smooth scrolling for navigation links
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
    
    // Navbar background change on scroll
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            navbar.style.background = 'rgba(44, 62, 80, 0.98)';
        } else {
            navbar.style.background = 'rgba(44, 62, 80, 0.95)';
        }
    });
    
    // Feature cards animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all feature cards
    document.querySelectorAll('.feature-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});