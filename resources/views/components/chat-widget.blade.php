<!-- Chat Widget -->
<div id="chat-widget" class="fixed bottom-6 right-6 z-50">
    <!-- Chat Button -->
    <button id="chat-toggle" class="w-14 h-14 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-110">
        <svg id="chat-icon" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Chat Panel -->
    <div id="chat-panel" class="hidden absolute bottom-16 right-0 w-96 max-w-[calc(100vw-2rem)] bg-white rounded-lg shadow-2xl border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-indigo-600 text-white px-4 py-3 flex items-center justify-between">
            <div>
                <h3 class="font-semibold">Meal Planning Assistant</h3>
                <p class="text-xs text-indigo-200">Ask about recipes, ingredients, or cooking tips</p>
            </div>
            <button id="clear-chat" class="text-indigo-200 hover:text-white text-xs">Clear</button>
        </div>

        <!-- Messages -->
        <div id="chat-messages" class="h-80 overflow-y-auto p-4 space-y-4 bg-gray-50">
            <div class="text-center text-gray-500 text-sm">
                <p>Hi! I'm your meal planning assistant.</p>
                <p class="mt-2 text-xs">Try asking:</p>
                <div class="mt-2 space-y-1">
                    <button class="suggestion-btn text-xs bg-white border border-gray-200 rounded-full px-3 py-1 hover:bg-indigo-50 hover:border-indigo-300">Make this recipe Japanese style</button>
                    <button class="suggestion-btn text-xs bg-white border border-gray-200 rounded-full px-3 py-1 hover:bg-indigo-50 hover:border-indigo-300">I already have chicken and rice</button>
                    <button class="suggestion-btn text-xs bg-white border border-gray-200 rounded-full px-3 py-1 hover:bg-indigo-50 hover:border-indigo-300">Suggest Indian variations</button>
                </div>
            </div>
        </div>

        <!-- Input -->
        <div class="p-3 border-t border-gray-200 bg-white">
            <form id="chat-form" class="flex gap-2">
                <input type="text" id="chat-input" placeholder="Ask about your meal plan..."
                    class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <button type="submit" id="chat-submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Send
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatToggle = document.getElementById('chat-toggle');
    const chatPanel = document.getElementById('chat-panel');
    const chatIcon = document.getElementById('chat-icon');
    const closeIcon = document.getElementById('close-icon');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');
    const chatSubmit = document.getElementById('chat-submit');
    const clearChat = document.getElementById('clear-chat');

    // Get current page context
    const pathParts = window.location.pathname.split('/');
    let dietSlug = null;
    let servings = null;
    if (pathParts[1] === 'meal-plan' || pathParts[1] === 'shopping-list') {
        dietSlug = pathParts[2];
        servings = pathParts[3];
    }

    // Toggle chat panel
    chatToggle.addEventListener('click', function() {
        chatPanel.classList.toggle('hidden');
        chatIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
        if (!chatPanel.classList.contains('hidden')) {
            chatInput.focus();
        }
    });

    // Handle suggestion buttons
    document.querySelectorAll('.suggestion-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            chatInput.value = this.textContent;
            chatForm.dispatchEvent(new Event('submit'));
        });
    });

    // Clear chat
    clearChat.addEventListener('click', async function() {
        try {
            await fetch('/chat/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            chatMessages.innerHTML = `
                <div class="text-center text-gray-500 text-sm">
                    <p>Chat cleared. How can I help you?</p>
                </div>
            `;
        } catch (error) {
            console.error('Error clearing chat:', error);
        }
    });

    // Handle form submission
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const message = chatInput.value.trim();
        if (!message) return;

        // Add user message to chat
        addMessage(message, 'user');
        chatInput.value = '';
        chatSubmit.disabled = true;

        // Add loading indicator
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'flex items-start gap-2';
        loadingDiv.id = 'loading-message';
        loadingDiv.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <div class="bg-white rounded-lg px-3 py-2 shadow-sm max-w-[80%]">
                <div class="flex items-center gap-1">
                    <div class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                    <div class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                    <div class="w-2 h-2 bg-indigo-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                </div>
            </div>
        `;
        chatMessages.appendChild(loadingDiv);
        scrollToBottom();

        try {
            const response = await fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    message: message,
                    diet_slug: dietSlug,
                    servings: servings
                })
            });

            const data = await response.json();

            // Remove loading indicator
            document.getElementById('loading-message')?.remove();

            if (data.error) {
                addMessage('Sorry, I encountered an error. Please try again.', 'assistant', true);
            } else {
                addMessage(data.message, 'assistant');
            }
        } catch (error) {
            document.getElementById('loading-message')?.remove();
            addMessage('Sorry, I couldn\'t connect. Please try again.', 'assistant', true);
        }

        chatSubmit.disabled = false;
        chatInput.focus();
    });

    function addMessage(content, role, isError = false) {
        // Clear initial suggestions if this is the first real message
        const initialSuggestions = chatMessages.querySelector('.text-center');
        if (initialSuggestions && initialSuggestions.querySelector('.suggestion-btn')) {
            initialSuggestions.remove();
        }

        const div = document.createElement('div');
        div.className = role === 'user' ? 'flex items-start gap-2 justify-end' : 'flex items-start gap-2';

        if (role === 'user') {
            div.innerHTML = `
                <div class="bg-indigo-600 text-white rounded-lg px-3 py-2 max-w-[80%]">
                    <p class="text-sm">${escapeHtml(content)}</p>
                </div>
            `;
        } else {
            const bgColor = isError ? 'bg-red-50' : 'bg-white';
            const textColor = isError ? 'text-red-700' : 'text-gray-700';
            div.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="${bgColor} rounded-lg px-3 py-2 shadow-sm max-w-[80%]">
                    <div class="text-sm ${textColor} prose prose-sm">${formatMarkdown(content)}</div>
                </div>
            `;
        }

        chatMessages.appendChild(div);
        scrollToBottom();
    }

    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function formatMarkdown(text) {
        // Simple markdown formatting
        return text
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/^- (.*)$/gm, '<li>$1</li>')
            .replace(/(<li>.*<\/li>)/gs, '<ul class="list-disc ml-4 my-1">$1</ul>')
            .replace(/\n/g, '<br>');
    }
});
</script>
