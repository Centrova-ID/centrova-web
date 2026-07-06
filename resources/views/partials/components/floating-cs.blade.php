{{-- Floating Customer Service Icon + Fullscreen Chat Modal --}}
<div x-data="floatingCS()" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
    {{-- Submenu (Meta style - minimal pill buttons) --}}
    <div x-show="menuOpen" 
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
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.488"/>
                </svg>
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
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
                </svg>
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
            class="w-14 h-14 bg-neutral-900 hover:bg-neutral-800 cursor-pointer text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-neutral-400">
        <svg x-show="!menuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
        </svg>
        <svg x-show="menuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    {{-- ========== Fullscreen Chat Modal (Meta Design - Minimal & Clean) ========== --}}
    <div x-show="chatModalOpen"
         x-transition:enter="transition-all duration-300 ease-out"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-all duration-200 ease-in"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-60 flex flex-col bg-white"
         @keydown.escape.window="minimizeChat()">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-neutral-200 bg-white">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-neutral-900 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-neutral-900">Asisten AI Centrova</h3>
                    <p class="text-xs text-neutral-500 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full inline-block"></span>
                        Online
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <button @click="minimizeChat()"
                        class="w-9 h-9 inline-flex items-center justify-center rounded-full text-neutral-400 hover:text-neutral-600 hover:bg-neutral-100 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/>
                    </svg>
                </button>
                <button @click="closeChat()"
                        class="w-9 h-9 inline-flex items-center justify-center rounded-full text-neutral-400 hover:text-neutral-600 hover:bg-neutral-100 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Messages --}}
        <div class="flex-1 overflow-y-auto bg-white">
            <div class="mx-auto max-w-3xl px-6 py-6">
                <div id="cs-chat-messages" class="space-y-5">
                    {{-- Welcome message --}}
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-neutral-900 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
                            </svg>
                        </div>
                        <div class="bg-neutral-50 rounded-[16px] rounded-tl-sm px-5 py-3.5 max-w-[85%]">
                            <p class="text-sm text-neutral-700 leading-relaxed">
                                Halo! Ada yang bisa saya bantu? Silakan tanyakan apapun tentang layanan Centrova.
                            </p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <button type="button" @click="pickSuggested('Apa itu Centrova?')" class="text-xs font-medium bg-white hover:bg-neutral-100 text-neutral-600 hover:text-neutral-900 px-3.5 py-1.5 rounded-full border border-neutral-200 hover:border-neutral-300 transition-all">
                                    Apa itu Centrova?
                                </button>
                                <button type="button" @click="pickSuggested('Layanan AI automation')" class="text-xs font-medium bg-white hover:bg-neutral-100 text-neutral-600 hover:text-neutral-900 px-3.5 py-1.5 rounded-full border border-neutral-200 hover:border-neutral-300 transition-all">
                                    Layanan AI automation
                                </button>
                                <button type="button" @click="pickSuggested('Harga website')" class="text-xs font-medium bg-white hover:bg-neutral-100 text-neutral-600 hover:text-neutral-900 px-3.5 py-1.5 rounded-full border border-neutral-200 hover:border-neutral-300 transition-all">
                                    Harga website
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input --}}
        <div class="border-t border-neutral-200 px-6 py-4 bg-white">
            <form x-on:submit.prevent="sendMessage()" class="flex items-center gap-3 max-w-3xl mx-auto">
                <input type="text"
                       x-model="messageText"
                       placeholder="Ketik pesan Anda..."
                       autocomplete="off"
                       class="flex-1 bg-neutral-100 border border-neutral-200 rounded-full px-5 py-3 text-sm text-neutral-900 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:border-transparent transition-all">
                <button type="submit"
                        :disabled="!messageText.trim() || isLoading"
                        class="bg-neutral-900 hover:bg-neutral-800 text-white rounded-full px-5 py-3 text-sm font-semibold transition-all duration-200 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!isLoading" class="hidden sm:inline">Kirim</span>
                    <svg x-show="!isLoading" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L18 12M12 6L12 18"/>
                    </svg>
                    <svg x-show="isLoading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </button>
            </form>
            <p class="text-[11px] text-neutral-400 mt-3 text-center">AI dapat menghasilkan informasi yang tidak akurat. Verifikasi informasi penting dengan tim kami.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', function() {
    Alpine.data('floatingCS', function() {
        return {
            menuOpen: false,
            chatModalOpen: false,
            messageText: '',
            isLoading: false,

            toggleMenu: function() {
                this.menuOpen = !this.menuOpen;
                if (this.menuOpen) {
                    this.chatModalOpen = false;
                }
            },

            openChatModal: function() {
                this.chatModalOpen = true;
                this.menuOpen = false;
                document.body.style.overflow = 'hidden';
            },

            minimizeChat: function() {
                this.chatModalOpen = false;
                document.body.style.overflow = '';
            },

            closeChat: function() {
                this.chatModalOpen = false;
                this.menuOpen = false;
                document.body.style.overflow = '';
            },

            pickSuggested: function(text) {
                this.messageText = text;
                var self = this;
                this.$nextTick(function() {
                    self.sendMessage();
                });
            },

            sendMessage: function() {
                var text = this.messageText.trim();
                if (!text || this.isLoading) return;

                this.addMessage('user', this.escapeHtml(text));
                this.messageText = '';
                this.isLoading = true;

                var self = this;
                var msgContainer = document.getElementById('cs-chat-messages');

                var loadingDiv = document.createElement('div');
                loadingDiv.id = 'cs-loading';
                loadingDiv.className = 'flex items-start gap-3';
                loadingDiv.innerHTML = '<div class="bg-neutral-50 rounded-[16px] rounded-tl-sm px-4 py-3.5"><div class="flex items-center gap-2"><div class="w-2 h-2 bg-neutral-900 rounded-full animate-bounce" style="animation-delay:0ms"></div><div class="w-2 h-2 bg-neutral-900 rounded-full animate-bounce" style="animation-delay:150ms"></div><div class="w-2 h-2 bg-neutral-900 rounded-full animate-bounce" style="animation-delay:300ms"></div></div></div>';
                msgContainer.appendChild(loadingDiv);
                msgContainer.scrollTop = msgContainer.scrollHeight;

                fetch('/api/chatbot/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') || {}).content || ''
                    },
                    body: JSON.stringify({ message: text })
                })
                .then(function(res) {
                    if (!res.ok) throw new Error('Network error');
                    return res.json();
                })
                .then(function(data) {
                    var el = document.getElementById('cs-loading');
                    if (el) el.remove();
                    if (data.reply) {
                        var formatted = data.reply.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>').replace(/\n/g, '<br>');
                        self.addMessage('assistant', formatted);
                    } else {
                        self.addMessage('assistant', 'Maaf, saya tidak bisa memproses pertanyaan Anda saat ini.');
                    }
                })
                .catch(function() {
                    var el = document.getElementById('cs-loading');
                    if (el) el.remove();
                    self.addMessage('assistant', 'Maaf, terjadi kesalahan koneksi. Silakan coba lagi.');
                })
                .finally(function() {
                    self.isLoading = false;
                });
            },

            addMessage: function(role, content) {
                var msgContainer = document.getElementById('cs-chat-messages');
                var isUser = role === 'user';
                var div = document.createElement('div');
                div.className = 'flex items-start gap-3' + (isUser ? ' flex-row-reverse' : '');

                var avatarHtml;
                if (isUser) {
                    avatarHtml = '<div class="w-8 h-8 bg-neutral-700 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5"><svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>';
                } else {
                    avatarHtml = '';
                }

                var bubbleClass = isUser ? 'bg-neutral-900 text-white rounded-[16px] rounded-tr-sm px-4 py-3 max-w-[85%]' : 'bg-neutral-50 rounded-[16px] rounded-tl-sm px-4 py-3 max-w-[85%]';
                var textClass = isUser ? 'text-white' : 'text-neutral-700';

                div.innerHTML = avatarHtml + '<div class="' + bubbleClass + '"><p class="text-sm leading-relaxed ' + textClass + '">' + content + '</p></div>';

                var loading = document.getElementById('cs-loading');
                if (loading) {
                    msgContainer.insertBefore(div, loading);
                } else {
                    msgContainer.appendChild(div);
                }
                msgContainer.scrollTop = msgContainer.scrollHeight;
            },

            escapeHtml: function(text) {
                var d = document.createElement('div');
                d.textContent = text;
                return d.innerHTML;
            }
        };
    });
});
</script>