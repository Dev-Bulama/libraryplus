/**
 * AI-Powered Search JavaScript
 * Handles intelligent search, suggestions, and chat functionality
 */

class AISearch {
    constructor() {
        this.apiBase = window.location.origin + '/ai/';
        this.searchInput = document.getElementById('searchInput');
        this.suggestionsDiv = document.getElementById('searchSuggestions');
        this.searchTimeout = null;
        this.currentRequest = null;

        this.init();
    }

    init() {
        this.bindEvents();
        this.initVoiceSearch();
    }

    bindEvents() {
        // Search input events
        if (this.searchInput) {
            this.searchInput.addEventListener('input', (e) => this.handleSearchInput(e));
            this.searchInput.addEventListener('keydown', (e) => this.handleKeyDown(e));
            this.searchInput.addEventListener('focus', () => this.showSuggestions());
        }

        // Click outside to hide suggestions
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-input-group')) {
                this.hideSuggestions();
            }
        });

        // Form submission
        const searchForm = document.getElementById('aiSearchForm');
        if (searchForm) {
            searchForm.addEventListener('submit', (e) => this.handleFormSubmit(e));
        }
    }

    handleSearchInput(e) {
        const query = e.target.value.trim();
        
        // Clear previous timeout
        clearTimeout(this.searchTimeout);
        
        // Cancel previous request
        if (this.currentRequest) {
            this.currentRequest.abort();
        }

        if (query.length < 2) {
            this.hideSuggestions();
            return;
        }

        // Debounce search suggestions
        this.searchTimeout = setTimeout(() => {
            this.fetchSuggestions(query);
        }, 300);
    }

    handleKeyDown(e) {
        const suggestions = this.suggestionsDiv.querySelectorAll('.suggestion-item');
        const activeSuggestion = this.suggestionsDiv.querySelector('.suggestion-item.active');
        
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                this.navigateSuggestions(suggestions, activeSuggestion, 'down');
                break;
            case 'ArrowUp':
                e.preventDefault();
                this.navigateSuggestions(suggestions, activeSuggestion, 'up');
                break;
            case 'Enter':
                if (activeSuggestion) {
                    e.preventDefault();
                    this.selectSuggestion(activeSuggestion.textContent.trim());
                }
                break;
            case 'Escape':
                this.hideSuggestions();
                break;
        }
    }

    navigateSuggestions(suggestions, current, direction) {
        if (suggestions.length === 0) return;

        // Remove current active
        if (current) {
            current.classList.remove('active');
        }

        let nextIndex = 0;
        if (current) {
            const currentIndex = Array.from(suggestions).indexOf(current);
            nextIndex = direction === 'down' 
                ? (currentIndex + 1) % suggestions.length
                : (currentIndex - 1 + suggestions.length) % suggestions.length;
        }

        suggestions[nextIndex].classList.add('active');
        suggestions[nextIndex].scrollIntoView({ block: 'nearest' });
    }

    async fetchSuggestions(query) {
        try {
            this.showLoading();

            const controller = new AbortController();
            this.currentRequest = controller;

            const response = await fetch(this.apiBase + 'search_suggestions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `query=${encodeURIComponent(query)}`,
                signal: controller.signal
            });

            const suggestions = await response.json();
            this.displaySuggestions(suggestions, query);
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('Suggestion fetch error:', error);
                this.hideSuggestions();
            }
        } finally {
            this.currentRequest = null;
        }
    }

    displaySuggestions(suggestions, query) {
        if (!suggestions || suggestions.length === 0) {
            this.hideSuggestions();
            return;
        }

        const html = suggestions.map((item, index) => `
            <div class="suggestion-item ${index === 0 ? 'active' : ''}" 
                 onclick="aiSearch.selectSuggestion('${this.escapeHtml(item.title)}')"
                 data-suggestion="${this.escapeHtml(item.title)}">
                <i class="fas ${this.getSuggestionIcon(item.type)} me-2"></i>
                <span class="suggestion-text">${this.highlightMatch(item.title, query)}</span>
                <small class="suggestion-type text-muted ms-auto">${item.type}</small>
            </div>
        `).join('');

        // Add AI-powered suggestions header
        const aiSuggestionsHtml = `
            <div class="suggestions-header">
                <small class="text-muted">
                    <i class="fas fa-magic me-1"></i>AI Suggestions
                </small>
            </div>
            ${html}
            <div class="suggestions-footer">
                <small class="text-muted">
                    <i class="fas fa-lightbulb me-1"></i>
                    Try natural language: "Books for a cozy evening" or "Something like Twilight"
                </small>
            </div>
        `;

        this.suggestionsDiv.innerHTML = aiSuggestionsHtml;
        this.showSuggestions();
    }

    getSuggestionIcon(type) {
        const icons = {
            'book': 'fa-book',
            'author': 'fa-user',
            'category': 'fa-folder',
            'ai_suggestion': 'fa-magic'
        };
        return icons[type] || 'fa-search';
    }

    highlightMatch(text, query) {
        const regex = new RegExp(`(${this.escapeRegex(query)})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }

    selectSuggestion(suggestion) {
        this.searchInput.value = suggestion;
        this.hideSuggestions();
        
        // Trigger search
        const searchForm = document.getElementById('aiSearchForm');
        if (searchForm) {
            searchForm.dispatchEvent(new Event('submit', { cancelable: true }));
        }
    }

    showSuggestions() {
        if (this.suggestionsDiv.innerHTML.trim()) {
            this.suggestionsDiv.style.display = 'block';
            this.suggestionsDiv.classList.add('show');
        }
    }

    hideSuggestions() {
        this.suggestionsDiv.style.display = 'none';
        this.suggestionsDiv.classList.remove('show');
    }

    showLoading() {
        this.suggestionsDiv.innerHTML = `
            <div class="suggestion-item loading">
                <div class="spinner-border spinner-border-sm me-2" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span>Getting AI suggestions...</span>
            </div>
        `;
        this.showSuggestions();
    }

    handleFormSubmit(e) {
        const query = this.searchInput.value.trim();
        
        if (!query) {
            e.preventDefault();
            this.searchInput.focus();
            return false;
        }

        // Add loading state to search button
        const searchBtn = document.querySelector('.search-btn');
        if (searchBtn) {
            const originalHtml = searchBtn.innerHTML;
            searchBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            // Restore button after a delay
            setTimeout(() => {
                searchBtn.innerHTML = originalHtml;
            }, 2000);
        }

        // Log search for analytics
        this.logSearch(query);
        
        return true;
    }

    async logSearch(query) {
        try {
            await fetch(this.apiBase + 'log_search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `query=${encodeURIComponent(query)}`
            });
        } catch (error) {
            console.error('Search logging error:', error);
        }
    }

    initVoiceSearch() {
        // Check if browser supports speech recognition
        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            this.addVoiceSearchButton();
        }
    }

    addVoiceSearchButton() {
        const searchContainer = document.querySelector('.search-input-group');
        if (!searchContainer) return;

        const voiceBtn = document.createElement('button');
        voiceBtn.type = 'button';
        voiceBtn.className = 'voice-search-btn';
        voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
        voiceBtn.title = 'Voice Search';
        
        // Add CSS for voice button
        const style = document.createElement('style');
        style.textContent = `
            .voice-search-btn {
                position: absolute;
                right: 60px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #666;
                font-size: 1.1rem;
                padding: 10px;
                border-radius: 50%;
                transition: all 0.3s ease;
                z-index: 10;
            }
            .voice-search-btn:hover {
                background: #f8f9fa;
                color: var(--secondary-color);
            }
            .voice-search-btn.listening {
                color: #e74c3c;
                animation: pulse 1s infinite;
            }
            @keyframes pulse {
                0% { transform: translateY(-50%) scale(1); }
                50% { transform: translateY(-50%) scale(1.1); }
                100% { transform: translateY(-50%) scale(1); }
            }
        `;
        document.head.appendChild(style);

        voiceBtn.addEventListener('click', () => this.startVoiceSearch());
        searchContainer.appendChild(voiceBtn);
    }

    startVoiceSearch() {
        const SpeechRecognition = window.webkitSpeechRecognition || window.SpeechRecognition;
        const recognition = new SpeechRecognition();
        
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = 'en-US';

        const voiceBtn = document.querySelector('.voice-search-btn');
        
        recognition.onstart = () => {
            voiceBtn.classList.add('listening');
            voiceBtn.innerHTML = '<i class="fas fa-stop"></i>';
        };

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            this.searchInput.value = transcript;
            this.searchInput.dispatchEvent(new Event('input'));
        };

        recognition.onerror = (event) => {
            console.error('Voice recognition error:', event.error);
        };

        recognition.onend = () => {
            voiceBtn.classList.remove('listening');
            voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
        };

        recognition.start();
    }

    // Utility functions
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    escapeRegex(text) {
        return text.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
}

// AI Chat functionality
class AIChat {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        this.apiBase = window.location.origin + '/ai/';
        this.sessionId = this.generateSessionId();
        this.chatHistory = [];
        
        this.init();
    }

    init() {
        if (!this.container) return;
        
        this.createChatInterface();
        this.bindEvents();
        this.showWelcomeMessage();
    }

    createChatInterface() {
        this.container.innerHTML = `
            <div class="chat-header">
                <h5><i class="fas fa-robot me-2"></i>AI Book Assistant</h5>
                <small class="text-muted">Ask me anything about books!</small>
            </div>
            <div class="chat-messages" id="chatMessages"></div>
            <div class="chat-input-container">
                <div class="input-group">
                    <input type="text" id="chatInput" class="form-control" 
                           placeholder="Ask me for book recommendations...">
                    <button class="btn btn-primary" id="sendChatBtn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        `;
    }

    bindEvents() {
        const chatInput = document.getElementById('chatInput');
        const sendBtn = document.getElementById('sendChatBtn');

        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.sendMessage();
            }
        });

        sendBtn.addEventListener('click', () => this.sendMessage());
    }

    async sendMessage() {
        const input = document.getElementById('chatInput');
        const message = input.value.trim();
        
        if (!message) return;

        this.addMessage(message, 'user');
        input.value = '';
        
        this.showTypingIndicator();

        try {
            const response = await fetch(this.apiBase + 'chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `message=${encodeURIComponent(message)}&session_id=${this.sessionId}&context=${encodeURIComponent(JSON.stringify(this.chatHistory))}`
            });

            const data = await response.json();
            
            this.hideTypingIndicator();
            
            if (data.success) {
                this.addMessage(data.response, 'bot');
                this.chatHistory.push({ user: message, bot: data.response });
            } else {
                this.addMessage('Sorry, I encountered an error. Please try again.', 'bot', 'error');
            }
        } catch (error) {
            this.hideTypingIndicator();
            this.addMessage('Sorry, I\'m having trouble connecting. Please try again later.', 'bot', 'error');
        }
    }

    addMessage(text, sender, type = 'normal') {
        const messagesContainer = document.getElementById('chatMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${sender} ${type}`;
        
        messageDiv.innerHTML = `
            <div class="message-content">
                ${sender === 'bot' ? '<i class="fas fa-robot message-icon"></i>' : '<i class="fas fa-user message-icon"></i>'}
                <div class="message-text">${this.formatMessage(text)}</div>
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
                <i class="fas fa-robot message-icon"></i>
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

    showWelcomeMessage() {
        setTimeout(() => {
            this.addMessage('Hello! I\'m your AI book assistant. I can help you find books, get recommendations, and answer questions about our library. What are you looking for today?', 'bot');
        }, 500);
    }

    formatMessage(text) {
        // Convert line breaks to <br>
        text = text.replace(/\n/g, '<br>');
        
        // Convert URLs to links
        text = text.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank">$1</a>');
        
        return text;
    }

    generateSessionId() {
        return 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AI Search
    window.aiSearch = new AISearch();
    
    // Initialize AI Chat if container exists
    if (document.getElementById('aiChatContainer')) {
        window.aiChat = new AIChat('aiChatContainer');
    }
});

// Global functions for backward compatibility
window.selectSuggestion = function(suggestion) {
    if (window.aiSearch) {
        window.aiSearch.selectSuggestion(suggestion);
    }
};