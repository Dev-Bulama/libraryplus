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
            --chat-bg: #ffffff;
            --user-msg-bg: #e3f2fd;
            --bot-msg-bg: #f5f5f5;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-bg);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: var(--primary-color) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .main-container {
            min-height: 100vh;
            padding: 2rem 0;
        }

        .ai-assistant-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .assistant-header {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .assistant-header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .assistant-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .chat-container {
            display: flex;
            height: 600px;
        }

        .chat-sidebar {
            width: 300px;
            background: var(--light-bg);
            border-right: 1px solid #e9ecef;
            padding: 1.5rem;
        }

        .quick-actions {
            margin-bottom: 2rem;
        }

        .quick-action-btn {
            display: block;
            width: 100%;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            text-align: left;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .quick-action-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .quick-action-btn i {
            width: 20px;
            margin-right: 0.75rem;
        }

        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-messages {
            flex: 1;
            padding: 1.5rem;
            overflow-y: auto;
            background: var(--chat-bg);
        }

        .chat-message {
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.3s ease;
        }

        .chat-message.user {
            text-align: right;
        }

        .message-content {
            display: inline-block;
            max-width: 70%;
            position: relative;
        }

        .user .message-content {
            background: var(--user-msg-bg);
            color: var(--primary-color);
            border-radius: 18px 18px 5px 18px;
        }

        .bot .message-content {
            background: var(--bot-msg-bg);
            color: var(--text-color);
            border-radius: 18px 18px 18px 5px;
        }

        .message-text {
            padding: 1rem 1.25rem;
            line-height: 1.5;
        }

        .message-icon {
            position: absolute;
            top: -5px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: white;
        }

        .user .message-icon {
            right: -35px;
            background: var(--secondary-color);
        }

        .bot .message-icon {
            left: -35px;
            background: var(--success-color);
        }

        .message-time {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.75rem;
            color: #6c757d;
        }

        .user .message-time {
            text-align: right;
        }

        .bot .message-time {
            text-align: left;
        }

        .typing-dots {
            display: flex;
            gap: 4px;
            padding: 1rem 1.25rem;
        }

        .typing-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #6c757d;
            animation: typingDots 1.4s infinite both;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typingDots {
            0%, 60%, 100% {
                transform: scale(0.7);
                opacity: 0.5;
            }
            30% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .chat-input-container {
            padding: 1.5rem;
            background: white;
            border-top: 1px solid #e9ecef;
        }

        .chat-input {
            border: 2px solid #e9ecef;
            border-radius: 25px;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .chat-input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .send-btn {
            background: var(--secondary-color);
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .send-btn:hover {
            background: var(--primary-color);
            transform: scale(1.05);
        }

        .send-btn:disabled {
            background: #6c757d;
            transform: none;
        }

        .suggestions-container {
            margin-top: 1rem;
        }

        .suggestion-chip {
            display: inline-block;
            background: var(--light-bg);
            border: 1px solid #e9ecef;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            font-size: 0.9rem;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .suggestion-chip:hover {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .book-recommendation {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 1rem;
            margin: 0.5rem 0;
            border-left: 4px solid var(--secondary-color);
        }

        .book-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
        }

        .book-author {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .book-reason {
            font-size: 0.9rem;
            color: var(--text-color);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .chat-container {
                flex-direction: column;
                height: auto;
            }

            .chat-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }

            .chat-main {
                height: 500px;
            }

            .assistant-header h1 {
                font-size: 2rem;
            }

            .message-content {
                max-width: 85%;
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
                        <a class="nav-link active" href="<?php echo base_url('frontend/ai_assistant'); ?>">AI Assistant</a>
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

    <!-- Main Content -->
    <div class="main-container">
        <div class="container">
            <div class="ai-assistant-container">
                <!-- Header -->
                <div class="assistant-header">
                    <h1><i class="fas fa-robot me-3"></i>AI Book Assistant</h1>
                    <p>Ask me anything about books, get personalized recommendations, or find your next great read!</p>
                </div>

                <!-- Chat Interface -->
                <div class="chat-container">
                    <!-- Sidebar with Quick Actions -->
                    <div class="chat-sidebar">
                        <div class="quick-actions">
                            <h6 class="mb-3 text-muted">Quick Actions</h6>
                            
                            <a href="#" class="quick-action-btn" onclick="sendQuickMessage('What are some popular books right now?')">
                                <i class="fas fa-fire"></i>
                                Popular Books
                            </a>
                            
                            <a href="#" class="quick-action-btn" onclick="sendQuickMessage('I need book recommendations for a cozy evening')">
                                <i class="fas fa-mug-hot"></i>
                                Cozy Evening Reads
                            </a>
                            
                            <a href="#" class="quick-action-btn" onclick="sendQuickMessage('Suggest books similar to Harry Potter')">
                                <i class="fas fa-magic"></i>
                                Books Like Harry Potter
                            </a>
                            
                            <a href="#" class="quick-action-btn" onclick="sendQuickMessage('What are good mystery novels?')">
                                <i class="fas fa-search"></i>
                                Mystery Novels
                            </a>
                            
                            <a href="#" class="quick-action-btn" onclick="sendQuickMessage('Recommend some science fiction books')">
                                <i class="fas fa-rocket"></i>
                                Science Fiction
                            </a>
                            
                            <a href="#" class="quick-action-btn" onclick="sendQuickMessage('I want to read romance novels')">
                                <i class="fas fa-heart"></i>
                                Romance Novels
                            </a>
                        </div>

                        <!-- Sample Questions -->
                        <div class="sample-questions">
                            <h6 class="mb-3 text-muted">Sample Questions</h6>
                            <div class="small text-muted">
                                <div class="mb-2">"Books for a rainy day"</div>
                                <div class="mb-2">"Something uplifting and inspiring"</div>
                                <div class="mb-2">"I loved The Great Gatsby"</div>
                                <div class="mb-2">"Short books I can finish in a weekend"</div>
                                <div class="mb-2">"Books that will make me cry"</div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Chat Area -->
                    <div class="chat-main">
                        <div class="chat-messages" id="chatMessages">
                            <!-- Messages will be added here dynamically -->
                        </div>

                        <!-- Chat Input -->
                        <div class="chat-input-container">
                            <div class="input-group">
                                <input 
                                    type="text" 
                                    id="chatInput" 
                                    class="form-control chat-input" 
                                    placeholder="Ask me about books, get recommendations, or chat about reading..."
                                    autocomplete="off"
                                >
                                <button class="btn send-btn" id="sendChatBtn" type="button">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                            
                            <!-- Suggestion Chips -->
                            <div class="suggestions-container" id="suggestionsContainer">
                                <span class="suggestion-chip" onclick="sendQuickMessage('What should I read next?')">
                                    What should I read next?
                                </span>
                                <span class="suggestion-chip" onclick="sendQuickMessage('Books for beginners')">
                                    Books for beginners
                                </span>
                                <span class="suggestion-chip" onclick="sendQuickMessage('Award-winning novels')">
                                    Award-winning novels
                                </span>
                                <span class="suggestion-chip" onclick="sendQuickMessage('Books under 300 pages')">
                                    Books under 300 pages
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/js/ai-search.js'); ?>"></script>
    
    <script>
        class AIAssistant {
            constructor() {
                this.apiBase = '<?php echo base_url("ai/"); ?>';
                this.sessionId = this.generateSessionId();
                this.chatHistory = [];
                this.isTyping = false;
                
                this.init();
            }

            init() {
                this.bindEvents();
                this.showWelcomeMessage();
            }

            bindEvents() {
                const chatInput = document.getElementById('chatInput');
                const sendBtn = document.getElementById('sendChatBtn');

                chatInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter' && !this.isTyping) {
                        this.sendMessage();
                    }
                });

                sendBtn.addEventListener('click', () => {
                    if (!this.isTyping) {
                        this.sendMessage();
                    }
                });
            }

            async sendMessage(message = null) {
                const input = document.getElementById('chatInput');
                const msg = message || input.value.trim();
                
                if (!msg) return;

                this.addMessage(msg, 'user');
                if (!message) input.value = '';
                
                this.setTyping(true);
                this.showTypingIndicator();

                try {
                    const response = await fetch(this.apiBase + 'chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `message=${encodeURIComponent(msg)}&session_id=${this.sessionId}&context=${encodeURIComponent(JSON.stringify(this.chatHistory))}`
                    });

                    const data = await response.json();
                    
                    this.hideTypingIndicator();
                    
                    if (data.success) {
                        this.addMessage(data.response, 'bot');
                        this.chatHistory.push({ user: msg, bot: data.response });
                    } else {
                        this.addMessage('Sorry, I encountered an error. Please try again.', 'bot', 'error');
                    }
                } catch (error) {
                    this.hideTypingIndicator();
                    this.addMessage('Sorry, I\'m having trouble connecting. Please try again later.', 'bot', 'error');
                } finally {
                    this.setTyping(false);
                }
            }

            addMessage(text, sender, type = 'normal') {
                const messagesContainer = document.getElementById('chatMessages');
                const messageDiv = document.createElement('div');
                messageDiv.className = `chat-message ${sender} ${type}`;
                
                const content = this.formatMessage(text);
                
                messageDiv.innerHTML = `
                    <div class="message-content">
                        <div class="message-icon">
                            <i class="fas ${sender === 'bot' ? 'fa-robot' : 'fa-user'}"></i>
                        </div>
                        <div class="message-text">${content}</div>
                    </div>
                    <small class="message-time">${new Date().toLocaleTimeString()}</small>
                `;

                messagesContainer.appendChild(messageDiv);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            showTypingIndicator() {
                const messagesContainer = document.getElementById('chatMessages');
                const typingDiv = document.createElement('div');
                typingDiv.className = 'chat-message bot typing';
                typingDiv.id = 'typingIndicator';
                
                typingDiv.innerHTML = `
                    <div class="message-content">
                        <div class="message-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="typing-dots">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                `;

                messagesContainer.appendChild(typingDiv);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            hideTypingIndicator() {
                const typingIndicator = document.getElementById('typingIndicator');
                if (typingIndicator) {
                    typingIndicator.remove();
                }
            }

            setTyping(isTyping) {
                this.isTyping = isTyping;
                const sendBtn = document.getElementById('sendChatBtn');
                const chatInput = document.getElementById('chatInput');
                
                sendBtn.disabled = isTyping;
                chatInput.disabled = isTyping;
                
                if (isTyping) {
                    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                } else {
                    sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
                }
            }

            showWelcomeMessage() {
                setTimeout(() => {
                    this.addMessage(`Hello! 👋 I'm your AI book assistant. I can help you:

• Find books based on your mood or interests
• Get personalized recommendations  
• Discover books similar to ones you've loved
• Answer questions about our library
• Suggest books for specific occasions

What can I help you find today?`, 'bot');
                }, 1000);
            }

            formatMessage(text) {
                // Convert line breaks to <br>
                text = text.replace(/\n/g, '<br>');
                
                // Format book recommendations
                text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                text = text.replace(/\*(.*?)\*/g, '<em>$1</em>');
                
                // Create book recommendation cards
                const bookPattern = /📚\s*(.*?)\s*by\s*(.*?)(?:\s*-\s*(.*?))?(?=📚|$)/g;
                text = text.replace(bookPattern, (match, title, author, reason) => {
                    return `<div class="book-recommendation">
                        <div class="book-title">📚 ${title}</div>
                        <div class="book-author">by ${author}</div>
                        ${reason ? `<div class="book-reason">${reason}</div>` : ''}
                    </div>`;
                });
                
                return text;
            }

            generateSessionId() {
                return 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            }
        }

        // Global function for quick messages
        function sendQuickMessage(message) {
            if (window.aiAssistant) {
                window.aiAssistant.sendMessage(message);
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            window.aiAssistant = new AIAssistant();
        });
    </script>
</body>
</html>