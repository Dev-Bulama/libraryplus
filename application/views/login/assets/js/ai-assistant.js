// AI Assistant Chat Functionality

class AIAssistant {
    constructor(apiBase) {
        this.apiBase = apiBase;
        this.chatHistory = [];
        this.sessionId = this.generateSessionId();
        this.isTyping = false;
        
        this.init();
    }
    
    init() {
        this.showWelcomeMessage();
    }
    
    generateSessionId() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }
    
    async sendMessage(message = null) {
        const input = document.getElementById('chatInput');
        const msg = message || input.value.trim();
        
        if (!msg || this.isTyping) return;

        this.addMessage(msg, 'user');
        if (!message) input.value = '';
        
        this.setTyping(true);
        this.showTypingIndicator();

        try {
            // Simulate API call - replace with actual API endpoint
            await this.simulateAIResponse(msg);
        } catch (error) {
            this.hideTypingIndicator();
            this.addMessage('Sorry, I\'m having trouble connecting. Please try again later.', 'bot', 'error');
        } finally {
            this.setTyping(false);
        }
    }
    
    async simulateAIResponse(userMessage) {
        // Simulate network delay
        await new Promise(resolve => setTimeout(resolve, 1500));
        
        this.hideTypingIndicator();
        
        // Generate contextual responses based on user input
        let response = this.generateResponse(userMessage);
        
        this.addMessage(response, 'bot');
        this.chatHistory.push({ user: userMessage, bot: response });
    }
    
    generateResponse(message) {
        const lowerMsg = message.toLowerCase();
        
        // Fantasy book recommendations
        if (lowerMsg.includes('fantasy') || lowerMsg.includes('magic') || lowerMsg.includes('dragon')) {
            return `🐉 Great choice! Here are some fantastic fantasy recommendations:

- **The Name of the Wind** by Patrick Rothfuss - A beautifully written story about Kvothe, a legendary figure
- **The Way of Kings** by Brandon Sanderson - Epic worldbuilding with unique magic systems
- **The Lies of Locke Lamora** by Scott Lynch - Fantasy meets heist story in a Venice-like setting
- **The Poppy War** by R.F. Kuang - Dark military fantasy inspired by 20th century China

Would you like more recommendations in any specific fantasy subgenre?`;
        }
        
        // Comedy/humor books
        if (lowerMsg.includes('funny') || lowerMsg.includes('laugh') || lowerMsg.includes('comedy') || lowerMsg.includes('humor')) {
            return `😄 Looking for some laughs? Here are some hilarious reads:

- **The Hitchhiker's Guide to the Galaxy** by Douglas Adams - Absurd sci-fi comedy classic
- **Good Omens** by Terry Pratchett & Neil Gaiman - Witty take on the apocalypse
- **Bridget Jones's Diary** by Helen Fielding - Relatable romantic comedy
- **Yes Please** by Amy Poehler - Funny memoir from the comedian

What type of humor do you enjoy most? Witty, absurd, or observational?`;
        }
        
        // Harry Potter similarities
        if (lowerMsg.includes('harry potter') || lowerMsg.includes('potter') || lowerMsg.includes('similar')) {
            return `⚡ If you loved Harry Potter, you'll enjoy these magical reads:

- **Percy Jackson** series by Rick Riordan - Modern mythology with humor
- **The Magicians** by Lev Grossman - Darker, adult take on magic school
- **Carry On** by Rainbow Rowell - Love letter to chosen one stories
- **The Priory of the Orange Tree** by Samantha Shannon - Epic fantasy with dragons

Each captures different aspects of what makes Harry Potter special. Which elements did you love most about HP?`;
        }
        
        // Popular books
        if (lowerMsg.includes('popular') || lowerMsg.includes('trending') || lowerMsg.includes('bestseller')) {
            return `📚 Here are some currently popular books across different genres:

- **Fourth Wing** by Rebecca Yarros - Dragon riders fantasy romance
- **Tomorrow, and Tomorrow, and Tomorrow** by Gabrielle Zevin - Gaming and friendship
- **The Seven Husbands of Evelyn Hugo** by Taylor Jenkins Reid - Hollywood glamour
- **Atomic Habits** by James Clear - Life-changing habits guide

What genre interests you most? I can provide more targeted recommendations!`;
        }
        
        // Beginner recommendations
        if (lowerMsg.includes('beginner') || lowerMsg.includes('start') || lowerMsg.includes('easy')) {
            return `🌱 Perfect for getting started! Here are some accessible, engaging reads:

- **The Alchemist** by Paulo Coelho - Short, inspiring philosophical novel
- **To Kill a Mockingbird** by Harper Lee - Classic with powerful themes
- **The Curious Incident of the Dog in the Night-Time** by Mark Haddon - Unique perspective
- **Eleanor Oliphant Is Completely Fine** by Gail Honeyman - Contemporary with heart

These are all page-turners that aren't too intimidating. What kind of stories appeal to you?`;
        }
        
        // Mood-based recommendations
        if (lowerMsg.includes('mood') || lowerMsg.includes('feel')) {
            return `💭 I'd love to help match a book to your mood! Tell me:

- Are you feeling adventurous or contemplative?
- Do you want something uplifting or thought-provoking?
- Are you in the mood for escape or learning?
- Fast-paced excitement or slow, beautiful prose?

Based on your current mood, I can suggest the perfect book to match how you're feeling right now!`;
        }
        
        // Rainy day books
        if (lowerMsg.includes('rainy') || lowerMsg.includes('cozy')) {
            return `☔ Perfect rainy day companions:

- **The House in the Cerulean Sea** by TJ Klune - Cozy fantasy that feels like a warm hug
- **Anne of Green Gables** by L.M. Montgomery - Charming and comforting classic
- **The Thursday Murder Club** by Richard Osman - Cozy mystery with humor
- **Beach Read** by Emily Henry - Light contemporary romance

These books are perfect for curling up with a warm drink and watching the rain!`;
        }
        
        // Default response
        return `I'm here to help you discover your next great read! 📖

I can help you with:
- Personalized book recommendations based on your interests
- Finding books similar to ones you've loved
- Discovering new genres or authors
- Matching books to your current mood
- Answering questions about our library collection

What kind of book are you in the mood for today? Feel free to be specific about genres, themes, or even just describe how you're feeling!`;
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

- Find books based on your mood or interests
- Get personalized recommendations  
- Discover books similar to ones you've loved
- Answer questions about our library
- Suggest books for specific occasions

What can I help you find today?`, 'bot');
        }, 1000);
    }

    formatMessage(text) {
        // Convert line breaks to <br>
        text = text.replace(/\n/g, '<br>');
        
        // Format book recommendations
        text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        text = text.replace(/\*(.*?)\*/g, '<em>$1</em>');
        
        // Format bullet points
        text = text.replace(/• /g, '<span style="color: #3498db;">•</span> ');
        
        return text;
    }
}

// Export for global use
window.AIAssistant = AIAssistant;