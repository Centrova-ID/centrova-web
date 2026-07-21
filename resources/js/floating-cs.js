document.addEventListener('alpine:init', function() {
    Alpine.data('floatingCS', function() {
        return {
            menuOpen: false,
            chatModalOpen: false,
            messageText: '',
            isLoading: false,
            isNearBottom: true,
            hasSentMessage: false,
            messages: [],

            init: function() {
                // Clear any saved messages on page load (refresh = fresh start)
                localStorage.removeItem('cs_chat_messages');
            },

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
                var self = this;
                this.$nextTick(function() {
                    self.restoreMessages();
                });
            },

            minimizeChat: function() {
                this.chatModalOpen = false;
                document.body.style.overflow = '';
            },

            closeChat: function() {
                this.chatModalOpen = false;
                this.menuOpen = false;
                document.body.style.overflow = '';
                // Clear localStorage on close so refresh = fresh start
                localStorage.removeItem('cs_chat_messages');
                this.messages = [];
            },

            onScroll: function() {
                var el = this.$refs.messagesContainer;
                if (!el) return;
                var threshold = 100;
                this.isNearBottom = (el.scrollTop + el.clientHeight >= el.scrollHeight - threshold);
            },

            scrollToBottom: function() {
                var el = this.$refs.messagesContainer;
                if (el) {
                    // Smooth scroll with animation
                    el.scrollTo({ top: el.scrollHeight, behavior: 'smooth' });
                }
            },

            saveMessages: function() {
                localStorage.setItem('cs_chat_messages', JSON.stringify(this.messages));
            },

            restoreMessages: function() {
                var saved = localStorage.getItem('cs_chat_messages');
                if (!saved) return;
                try {
                    var parsed = JSON.parse(saved);
                    if (Array.isArray(parsed) && parsed.length > 0) {
                        this.messages = parsed;
                        var msgContainer = document.getElementById('cs-chat-messages');
                        // Remove welcome message, rebuild from saved
                        while (msgContainer.children.length > 1) {
                            msgContainer.removeChild(msgContainer.lastChild);
                        }
                        var self = this;
                        parsed.forEach(function(msg) {
                            var div = document.createElement('div');
                            if (msg.role === 'user') {
                                div.className = 'flex justify-end';
                                div.innerHTML = '<div class="bg-neutral-900 text-white rounded-2xl px-5 py-3 max-w-[75%]"><p class="text-sm leading-relaxed">' + msg.content + '<\/p><\/div>';
                            } else {
                                div.className = 'flex items-start w-full';
                                div.innerHTML = '<div class="prose prose-sm prose-headings:font-bold prose-a:text-[#128AEB] prose-blockquote:border-l-[#128AEB] prose-img:rounded-xl max-w-none text-neutral-800">' + msg.content + '<\/div>';
                            }
                            msgContainer.appendChild(div);
                        });
                        self.$nextTick(function() {
                            self.scrollToBottom();
                        });
                    }
                } catch(e) {}
            },

            sendMessage: function() {
                var text = this.messageText.trim();
                if (!text || this.isLoading) return;

                this.hasSentMessage = true;
                this.addMessage('user', this.escapeHtml(text));
                this.messageText = '';
                this.isLoading = true;

                var self = this;
                var msgContainer = document.getElementById('cs-chat-messages');

                var loadingDiv = document.createElement('div');
                loadingDiv.id = 'cs-loading';
                loadingDiv.className = 'flex items-start';
                loadingDiv.innerHTML = '<div class="bg-white rounded-2xl px-5 py-4"><div class="flex items-center gap-1.5"><div class="loading-dot"></div><div class="loading-dot"></div><div class="loading-dot"></div><div class="loading-dot"></div></div></div>';
                msgContainer.appendChild(loadingDiv);
                self.scrollToBottom();

                // Build conversation history for context
                var conversationHistory = this.messages.map(function(m) {
                    return { role: m.role, content: m.content };
                });

                fetch('/api/chatbot/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') || {}).content || ''
                    },
                    body: JSON.stringify({
                        message: text,
                        history: conversationHistory
                    })
                })
                .then(function(res) {
                    if (!res.ok) throw new Error('Network error');
                    return res.json();
                })
                .then(function(data) {
                    var el = document.getElementById('cs-loading');
                    if (el) el.remove();
                    if (data.reply) {
                        // AI returns HTML, render with typing fade effect
                        self.addMessageWithTyping(data.reply, data.reply);
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

            addMessage: function(role, content, plainContent) {
                var msgContainer = document.getElementById('cs-chat-messages');
                var isUser = role === 'user';
                var div = document.createElement('div');

                if (isUser) {
                    div.className = 'flex justify-end';
                    div.innerHTML = '<div class="bg-primary-600 text-white rounded-full text-[17px] px-5 py-3 max-w-[75%]"><p class="text-sm leading-relaxed">' + content + '<\/p><\/div>';
                } else {
                    div.className = 'flex items-start w-full';
                    div.innerHTML = '<div class="prose prose-sm font-figtree prose-headings:font-bold prose-a:text-[#128AEB] prose-blockquote:border-l-[#128AEB] prose-img:rounded-xl max-w-none text-neutral-900">' + content + '<\/div>';
                }

                var loading = document.getElementById('cs-loading');
                if (loading) {
                    msgContainer.insertBefore(div, loading);
                } else {
                    msgContainer.appendChild(div);
                }

                // Store plain text in memory array (for API context)
                var storeContent = plainContent || content;
                this.messages.push({ role: role, content: storeContent });
                // Save to localStorage (will be cleared on close/refresh)
                this.saveMessages();

                // Auto scroll only if user is near bottom
                if (this.isNearBottom) {
                    this.scrollToBottom();
                }
            },

            escapeHtml: function(text) {
                var d = document.createElement('div');
                d.textContent = text;
                return d.innerHTML;
            },

            addMessageWithTyping: function(htmlContent, plainContent) {
                var msgContainer = document.getElementById('cs-chat-messages');
                var div = document.createElement('div');
                div.className = 'flex items-start w-full message-fade-in';
                var proseDiv = document.createElement('div');
                proseDiv.className = 'prose prose-sm font-figtree prose-headings:font-bold prose-a:text-[#128AEB] prose-blockquote:border-l-[#128AEB] prose-img:rounded-xl max-w-none text-neutral-800';
                div.appendChild(proseDiv);

                var loading = document.getElementById('cs-loading');
                if (loading) {
                    msgContainer.insertBefore(div, loading);
                } else {
                    msgContainer.appendChild(div);
                }

                // Store plain text
                this.messages.push({ role: 'assistant', content: plainContent });
                this.saveMessages();

                // Typing effect: render HTML in chunks for streaming feel
                var self = this;
                var fullHtml = htmlContent;
                
                // Split by block-level tags for chunked rendering
                var chunks = fullHtml.split(/(?=<\/?[hbpoaud][^>]*>)/);
                if (chunks.length <= 1) {
                    // Fallback: use word-by-word for plain text
                    chunks = fullHtml.split(/(?<=\s)/);
                }
                
                var currentIndex = 0;
                var accumulated = '';
                
                function renderNextChunk() {
                    if (currentIndex >= chunks.length) {
                        // Final scroll
                        if (self.isNearBottom) {
                            self.scrollToBottom();
                        }
                        return;
                    }
                    
                    accumulated += chunks[currentIndex];
                    proseDiv.innerHTML = accumulated;
                    currentIndex++;
                    
                    // Scroll during typing if near bottom
                    if (self.isNearBottom) {
                        self.scrollToBottom();
                    }
                    
                    // Variable delay: longer for block tags, shorter for inline
                    var delay = 15;
                    if (chunks[currentIndex - 1].startsWith('<')) {
                        delay = 40; // Slower for HTML tags
                    }
                    
                    setTimeout(renderNextChunk, delay);
                }
                
                renderNextChunk();
            }
        };
    });
});
