{{-- Floating Customer Service Icon + Fullscreen Chat Modal --}}
<div x-data="floatingCS()" 
     x-cloak
     class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
    {{-- Submenu (Meta style - minimal pill buttons) --}}
    <div x-show="menuOpen" 
         x-cloak
         x-transition:enter="transition-all duration-300 ease-out"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition-all duration-200 ease-in"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         class="mb-3 flex flex-col gap-2 w-full"
         @click.away="menuOpen = false"
         @keydown.escape.window="menuOpen = false">
        
        {{-- WhatsApp --}}
        <a href="https://wa.me/62895397633012?text=Halo%20Centrova,%20saya%20ingin%20konsultasi" 
           target="_blank" rel="noopener noreferrer"
           class="flex items-center gap-3 bg-white border border-neutral-200 shadow-lg rounded-full px-5 py-3 hover:bg-neutral-50 hover:border-neutral-300 transition-all duration-200 group min-w-[240px]">
            <div class="w-9 h-9 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-rounded text-white text-lg">chat</span>
            </div>
            <div class="flex flex-col">
                <span class="text-sm font-semibold text-neutral-800 group-hover:text-green-700 transition-colors">Konsultasi via WhatsApp</span>
                <span class="text-xs text-neutral-500">Respon cepat 1x24 jam</span>
            </div>
        </a>

        {{-- AI Chat --}}
        <button @click="openChatModal()"
                class="flex items-center gap-3 bg-white border border-neutral-200 shadow-lg rounded-full px-5 py-3 hover:bg-neutral-50 hover:border-neutral-300 transition-all duration-200 group w-full text-left min-w-[240px]">
            <div class="w-9 h-9 bg-neutral-900 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-rounded text-white text-lg">smart_toy</span>
            </div>
            <div class="flex flex-col">
                <span class="text-sm font-semibold text-neutral-800 group-hover:text-neutral-900 transition-colors">Tanya dengan AI</span>
                <span class="text-xs text-neutral-500">Chatbot pintar siap membantu</span>
            </div>
        </button>
    </div>

    {{-- Main Toggle Button (Meta style - black pill) --}}
    <button @click="toggleMenu()" 
            :class="{ 'rotate-45': menuOpen }"
            class="w-14 h-14 bg-primary-500 hover:bg-primary-600 cursor-pointer text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center focus:outline-none focus:ring-4 focus:ring-cyan-200/50">
        <span x-show="!menuOpen" class="material-symbols-rounded text-2xl">chat</span>
        <span x-show="menuOpen" class="material-symbols-rounded text-2xl">close</span>
    </button>

    {{-- ========== Fullscreen Chat Modal (Google AI Style) ========== --}}
    <div x-show="chatModalOpen"
         x-cloak
         x-transition:enter="transition-all duration-300 ease-out"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-all duration-200 ease-in"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-60 flex flex-col bg-neutral-50"
         @keydown.escape.window="minimizeChat()">

        {{-- Header --}}
        <div class="w-full bg-white border-b border-neutral-200">
            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="px-3 h-12 hover:bg-gray-50 rounded-md flex items-center ml-2 md:ml-0 mr-8 select-none">
                        <img src="{{ asset('/assets/brand/centrova-logo.svg') }}" 
                             class="h-[24px] w-auto transition-all duration-300" 
                             alt="Centrova Logo" 
                             draggable="false" />
                    </a>
                </div>
                <div class="flex items-center gap-1">
                    <button @click="closeChat()"
                            class="w-10 h-10 inline-flex items-center justify-center rounded-full hover:bg-neutral-100 transition cursor-pointer">
                        <span class="material-symbols-rounded text-neutral-500 text-2xl">close</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Messages Area --}}
        <div class="flex-1 overflow-y-auto min-h-0" x-ref="messagesContainer" @scroll="onScroll()">
            <div class="mx-auto max-w-3xl px-4 pt-8 pb-4">
                <div id="cs-chat-messages" class="space-y-8">
                    {{-- Say Hello (first message, gone after user sends a message) --}}
                    <div x-show="!hasSentMessage" class="flex flex-col items-start gap-2">
                        <p class="text-2xl font-light text-neutral-800 leading-relaxed">
                            Halo! Ada yang bisa saya bantu?
                        </p>
                        <p class="text-sm text-neutral-500 mt-2">
                            Silakan tanyakan apapun tentang layanan Centrova.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input Area --}}
        <div class="bg-white border-t border-neutral-200 px-4 py-4 w-full flex-shrink-0">
            <div class="max-w-3xl mx-auto">
                <form x-on:submit.prevent="sendMessage()" class="relative">
                    <div class="ai-glow-container-input flex items-center gap-2 bg-neutral-100 rounded-full px-2 py-2 border border-neutral-200 focus-within:bg-white focus-within:border-neutral-300 focus-within:shadow-lg transition-all duration-200">
                        <input type="text"
                               x-model="messageText"
                               placeholder="Ketik pesan..."
                               autocomplete="off"
                               class="flex-1 bg-transparent border-none text-base font-figtree text-neutral-900 placeholder-neutral-400 focus:outline-none px-4 py-2">
                        <button type="submit"
                                :disabled="!messageText.trim() || isLoading"
                                class="w-10 h-10 bg-neutral-900 hover:bg-neutral-800 text-white rounded-full flex items-center justify-center transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex-shrink-0">
                            <span x-show="!isLoading" class="material-symbols-rounded text-2xl">arrow_upward</span>
                            <span x-show="isLoading" class="material-symbols-rounded text-2xl animate-spin">progress_activity</span>
                        </button>
                    </div>
                </form>
                <p class="text-xs text-neutral-500 font-medium mt-3 text-center">AI dapat menghasilkan informasi yang tidak akurat. Verifikasi informasi penting dengan tim kami.</p>
            </div>
        </div>
    </div>
</div>

<style>
/* x-cloak styling to prevent FOUC */
[x-cloak] {
    display: none !important;
}

/* AI Glowing Animation */
@keyframes ai-glow {
    0%, 100% {
        box-shadow: 0 0 15px rgba(59, 130, 246, 1), 0 0 30px rgba(168, 85, 247, 0.4), 0 0 45px rgba(236, 72, 153, 0.1);
    }
    25% {
        box-shadow: 0 0 15px rgba(234, 179, 8, 1), 0 0 30px rgba(59, 130, 246, 0.4), 0 0 45px rgba(168, 85, 247, 0.1);
    }
    50% {
        box-shadow: 0 0 15px rgba(34, 197, 94, 1), 0 0 30px rgba(234, 179, 8, 0.4), 0 0 45px rgba(59, 130, 246, 0.1);
    }
    75% {
        box-shadow: 0 0 15px rgba(236, 72, 153, 1), 0 0 30px rgba(34, 197, 94, 0.4), 0 0 45px rgba(234, 179, 8, 0.1);
    }
}

.ai-glow-container {
    animation: ai-glow 3s ease-in-out infinite;
}

.ai-glow-container-input {
    animation: ai-glow 3s ease-in-out infinite;
    border-radius: 9999px;
}

/* AI Loading Indicator with colorful dots */
@keyframes loading-dot-1 {
    0%, 100% { background-color: #128aeb; transform: scale(1); }
    25% { background-color: #EAB308; transform: scale(1.3); }
    50% { background-color: #22C55E; transform: scale(1); }
    75% { background-color: #EC4899; transform: scale(1.3); }
}

@keyframes loading-dot-2 {
    0%, 100% { background-color: #EAB308; transform: scale(1); }
    25% { background-color: #22C55E; transform: scale(1.3); }
    50% { background-color: #EC4899; transform: scale(1); }
    75% { background-color: #128aeb; transform: scale(1.3); }
}

@keyframes loading-dot-3 {
    0%, 100% { background-color: #22C55E; transform: scale(1); }
    25% { background-color: #EC4899; transform: scale(1.3); }
    50% { background-color: #128aeb; transform: scale(1); }
    75% { background-color: #EAB308; transform: scale(1.3); }
}

@keyframes loading-dot-4 {
    0%, 100% { background-color: #EC4899; transform: scale(1); }
    25% { background-color: #128aeb; transform: scale(1.3); }
    50% { background-color: #EAB308; transform: scale(1); }
    75% { background-color: #22C55E; transform: scale(1.3); }
}

.loading-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    margin: 0 2px;
}

.loading-dot:nth-child(1) { animation: loading-dot-1 1.5s ease-in-out infinite; }
.loading-dot:nth-child(2) { animation: loading-dot-2 1.5s ease-in-out infinite 0.2s; }
.loading-dot:nth-child(3) { animation: loading-dot-3 1.5s ease-in-out infinite 0.4s; }
.loading-dot:nth-child(4) { animation: loading-dot-4 1.5s ease-in-out infinite 0.6s; }

/* Smooth scrollbar for messages area */
.flex-1.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.flex-1.overflow-y-auto::-webkit-scrollbar-track {
    background: transparent;
}

.flex-1.overflow-y-auto::-webkit-scrollbar-thumb {
    background-color: #D1D5DB;
    border-radius: 20px;
}

.flex-1.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background-color: #9CA3AF;
}

/* Smooth scroll behavior for messages container */
[x-ref="messagesContainer"] {
    scroll-behavior: smooth;
}

/* Fade-in animation for AI messages */
@keyframes messageFadeIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message-fade-in {
    animation: messageFadeIn 0.4s ease-out;
}

/* Prose styling for chat messages */
#cs-chat-messages .prose {
    font-size: 17px;
    line-height: 1.55;
}

#cs-chat-messages .prose h2 {
    font-size: 1.125rem;
    margin-top: 1.25em;
    margin-bottom: 0.5em;
}

#cs-chat-messages .prose h3 {
    font-size: 1rem;
    margin-top: 1em;
    margin-bottom: 0.4em;
}

#cs-chat-messages .prose p {
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

#cs-chat-messages .prose ul,
#cs-chat-messages .prose ol {
    margin-top: 0.3em;
    margin-bottom: 0.3em;
    padding-left: 1.25em;
}

#cs-chat-messages .prose li {
    margin-top: 0.15em;
    margin-bottom: 0.15em;
}

#cs-chat-messages .prose blockquote {
    font-style: italic;
    border-left-width: 3px;
    padding-left: 1em;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    color: #525252;
}

#cs-chat-messages .prose a {
    color: #128AEB;
    text-decoration: underline;
}

#cs-chat-messages .prose a:hover {
    color: #0a6bc7;
}

#cs-chat-messages .prose strong {
    font-weight: 600;
}

#cs-chat-messages .prose code {
    background-color: #f4f4f5;
    padding: 0.15em 0.35em;
    border-radius: 4px;
    font-size: 0.8em;
}

#cs-chat-messages .prose pre {
    background-color: #f4f4f5;
    padding: 0.75em 1em;
    border-radius: 8px;
    overflow-x: auto;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    font-size: 0.8em;
}
</style>