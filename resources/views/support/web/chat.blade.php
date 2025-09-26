@extends('partials.layouts.consult')

@section('title', 'Konsultasi Website Development - Centrova')

@section('content')

@php
    $user = Auth::user();
    // Redirect staff to staff chat dashboard
    if ($user && $user->role && $user->role !== 'customer') {
        echo '<script>window.location.href = "' . route('staff.chat.index') . '";</script>';
        return;
    }
@endphp

<style>
    #messageInput::-webkit-scrollbar {
      display: none;
    }
    #messageInput {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
</style>

<section class="w-full h-screen overflow-hidden flex flex-col">
    <div class="w-full h-[80px] bg-neutral-50 border-neutral-100 border-b border-neutral-300">
        <div class="w-full max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center items-center relative">
            @if($conversation->staff)
                <x-user-avatar 
                    :user="$conversation->staff" 
                    size="md" 
                />
            @else
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            @endif
            <span class="text-sm text-neutral-700">
                @if($conversation->staff)
                    Anda telah terkoneksi dengan <span class="font-medium text-slate-900">{{ $conversation->staff->name }}</span>
                @else
                    <span class="font-medium text-slate-900">Menunggu staff...</span>
                @endif
            </span>
            <div class="absolute right-0 h-full flex items-center">
                <button type="button" onclick="closeConversation()" class="px-3 py-1 hover:bg-neutral-200 rounded-full font-medium text-neutral-700 focus:text-white focus:bg-[#128AEB]">Selesai</button>
            </div>
        </div>
    </div>

    <div class="flex-1 bg-white overflow-y-auto">
        <div class="w-full max-w-3xl mx-auto px-4 py-6 space-y-4" id="chatMessages">
            <!-- Pesan waktu koneksi -->
            <div class="flex justify-center">
                <div class="text-xs text-neutral-500 bg-neutral-100 px-3 py-1 rounded-full">
                    {{ $conversation->created_at->format('m/d/Y g:i A') }}
                </div>
            </div>
            
            <div class="flex justify-center">
                <div class="text-xs text-neutral-500 bg-neutral-100 px-3 py-1 rounded-full">
                    @if($conversation->staff)
                        You are connected with {{ $conversation->staff->name }}.
                    @else
                        Waiting for staff to connect...
                    @endif
                </div>
            </div>

            <!-- Pesan dari database -->
            @foreach($messages as $message)
                @if($message->sender_type === 'staff')
                    <!-- Pesan dari Staff (kiri) -->
                    <div class="flex justify-start" data-message-id="{{ $message->id }}" data-message="{{ $message->message }}">
                        <div class="max-w-xs lg:max-w-md">
                            @if($message->reply_to_message_id)
                                @php
                                    $replyMessage = $messages->where('id', $message->reply_to_message_id)->first();
                                @endphp
                                @if($replyMessage)
                                    <div class="bg-neutral-100 p-2 rounded-lg mb-2 border-l-2 border-neutral-500">
                                        <p class="text-xs text-neutral-600">{{ $replyMessage->sender_type === 'staff' ? 'Staff' : 'Anda' }}</p>
                                        <p class="text-sm text-neutral-700 truncate">{{ Str::limit($replyMessage->message, 50) }}</p>
                                    </div>
                                @endif
                            @endif
                            <div class="bg-neutral-200 text-neutral-800 px-4 py-3 rounded-2xl rounded-bl-md relative group"
                                 oncontextmenu="showMessageContextMenu(event, {{ $message->id }}, 'staff', '{{ addslashes($message->message) }}', false)">
                                <p class="text-sm">{{ $message->message }}</p>
                            </div>
                            <div class="text-xs text-neutral-500 mt-1 ml-2">
                                {{ $message->created_at->format('g:i A') }}
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Pesan dari User (kanan) -->
                    <div class="flex justify-end" data-message-id="{{ $message->id }}" data-message="{{ $message->message }}">
                        <div class="max-w-xs lg:max-w-md">
                            @if($message->reply_to_message_id)
                                @php
                                    $replyMessage = $messages->where('id', $message->reply_to_message_id)->first();
                                @endphp
                                @if($replyMessage)
                                    <div class="bg-blue-50 p-2 rounded-lg mb-2 border-l-2 border-blue-500">
                                        <p class="text-xs text-blue-600">{{ $replyMessage->sender_type === 'staff' ? 'Staff' : 'Anda' }}</p>
                                        <p class="text-sm text-blue-700 truncate">{{ Str::limit($replyMessage->message, 50) }}</p>
                                    </div>
                                @endif
                            @endif
                            <div class="bg-[#128AEB] text-white px-4 py-3 rounded-2xl rounded-br-md relative group"
                                 oncontextmenu="showMessageContextMenu(event, {{ $message->id }}, 'user', '{{ addslashes($message->message) }}', false)">
                                <p class="text-sm">{{ $message->message }}</p>
                            </div>
                            <div class="text-xs text-neutral-500 mt-1 mr-2 text-right">
                                {{ $message->created_at->format('g:i A') }}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="w-full min-h-[80px] bg-neutral-50 border-neutral-100 border-t border-neutral-300 p-4">
        <div class="w-full max-w-3xl mx-auto">
            <!-- Reply Indicator (akan ditampilkan dengan PHP jika ada) -->
            @if(session('reply_to_message_id'))
                @php
                    $replyMessage = $messages->where('id', session('reply_to_message_id'))->first();
                @endphp
                @if($replyMessage)
                    <div class="reply-indicator bg-blue-50 border-l-4 border-blue-400 p-3 mb-2 rounded-r-lg">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-xs text-blue-600 font-medium">Membalas {{ $replyMessage->sender_type === 'user' ? 'Anda' : 'Staff' }}</p>
                                <p class="text-sm text-gray-700 truncate">{{ Str::limit($replyMessage->message, 50) }}</p>
                            </div>
                            <a href="{{ route('support.web.chat') }}" class="ml-2 text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif
            @endif
            
            <form method="POST" action="{{ route('support.web.chat.send') }}" class="relative flex items-center">
                @csrf
                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                @if(session('reply_to_message_id'))
                    <input type="hidden" name="reply_to_message_id" value="{{ session('reply_to_message_id') }}">
                @endif
                
                <textarea 
                    name="message"
                    id="messageInput"
                    placeholder="Ketik pesan Anda di sini..."
                    class="w-full min-h-[32px] max-h-[96px] px-2 py-2 pr-12 bg-white border border-neutral-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent text-sm leading-5"
                    rows="1"
                    oninput="adjustTextareaHeight(this)"
                    required
                >{{ old('message') }}</textarea>
                
                <button 
                    type="submit"
                    id="sendButton"
                    class="absolute right-1 bottom-[5px] w-7 h-7 bg-[#128AEB] hover:bg-[#0f7bd4] text-white rounded-full flex items-center justify-center transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg class="w-5 ml-0.5 h-5 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        const conversationId = {{ $conversation->id }};
        let lastMessageId = {{ $messages->last() ? $messages->last()->id : 0 }};
        let isPolling = false;

        // Debug: Log query parameters
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('package_name')) {
                package_name: urlParams.get('package_name'),
                package_price: urlParams.get('package_price'),
                customer_name: urlParams.get('customer_name'),
                business_type: urlParams.get('business_type')
            });
        }

        function adjustTextareaHeight(textarea) {
            // Reset height to auto to get the correct scrollHeight
            textarea.style.height = 'auto';
            
            // Calculate the new height (max 4 lines)
            const lineHeight = 20; // Approximate line height in pixels
            const minHeight = 32; // Minimum height (1 line + padding)
            const maxHeight = 96; // Maximum height (4 lines + padding)
            
            let newHeight = Math.min(Math.max(textarea.scrollHeight, minHeight), maxHeight);
            textarea.style.height = newHeight + 'px';
            
            // Update send button position
            const sendButton = document.getElementById('sendButton');
            sendButton.style.bottom = '5px';
        }

        // Poll for new messages (still using AJAX for real-time updates)
        function pollForNewMessages() {
            if (isPolling) return;
            isPolling = true;

            fetch(`{{ route("support.web.chat.messages", $conversation) }}?last_message_id=${lastMessageId}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.messages.length > 0) {
                    data.messages.forEach(message => {
                        addMessage(
                            message.message, 
                            message.sender_type, 
                            message.created_at, 
                            message.reply_to_message_id, 
                            message.id,
                            message.reply_to_message || null
                        );
                        lastMessageId = message.id;
                    });
                }
            })
            .catch(error => {
                console.error('Error polling messages:', error);
            })
            .finally(() => {
                isPolling = false;
            });
        }

        // Add message to chat (for real-time updates)
        function addMessage(text, sender, timestamp, replyToMessageId = null, messageId = null, replyMessageData = null) {
            const chatMessages = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            const time = new Date(timestamp).toLocaleTimeString('en-US', { 
                hour: 'numeric', 
                minute: '2-digit',
                hour12: true 
            });
            
            messageDiv.setAttribute('data-message-id', messageId || Date.now());
            messageDiv.setAttribute('data-message', text);
            
            let replyHtml = '';
            if (replyToMessageId) {
                let replyText = '';
                let replySender = '';
                
                if (replyMessageData) {
                    replyText = replyMessageData.message;
                    replySender = replyMessageData.sender_type === 'user' ? 'Anda' : 'Staff';
                } else {
                    const replyMessage = document.querySelector(`[data-message-id="${replyToMessageId}"]`);
                    if (replyMessage) {
                        replyText = replyMessage.getAttribute('data-message');
                        replySender = replyMessage.querySelector('.bg-[#128AEB]') ? 'Anda' : 'Staff';
                    }
                }
                
                if (replyText) {
                    replyHtml = `
                        <div class="bg-neutral-100 p-2 rounded-lg mb-2 border-l-2 border-${sender === 'user' ? 'blue' : 'neutral'}-500">
                            <p class="text-xs text-neutral-600">${replySender}</p>
                            <p class="text-sm text-neutral-700 truncate">${replyText.substring(0, 50)}...</p>
                        </div>
                    `;
                }
            }
            
            if (sender === 'user') {
                messageDiv.className = 'flex justify-end';
                messageDiv.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        ${replyHtml}
                        <div class="bg-[#128AEB] text-white px-4 py-3 rounded-2xl rounded-br-md relative group"
                             oncontextmenu="showMessageContextMenu(event, ${messageId || Date.now()}, '${sender}', '${text.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}', false)">
                            <p class="text-sm">${text}</p>
                        </div>
                        <div class="text-xs text-neutral-500 mt-1 mr-2 text-right">
                            ${time}
                        </div>
                    </div>
                `;
            } else {
                messageDiv.className = 'flex justify-start';
                messageDiv.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        ${replyHtml}
                        <div class="bg-neutral-200 text-neutral-800 px-4 py-3 rounded-2xl rounded-bl-md relative group"
                             oncontextmenu="showMessageContextMenu(event, ${messageId || Date.now()}, '${sender}', '${text.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}', false)">
                            <p class="text-sm">${text}</p>
                        </div>
                        <div class="text-xs text-neutral-500 mt-1 ml-2">
                            ${time}
                        </div>
                    </div>
                `;
            }
            
            chatMessages.appendChild(messageDiv);
            
            // Scroll to bottom
            const chatContainer = chatMessages.parentElement;
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Global variables for context menu
        let contextMenu = null;

        // Show context menu for messages
        function showMessageContextMenu(event, messageId, senderType, messageText, canEdit = false) {
            event.preventDefault();
            
            // Remove existing context menu
            if (contextMenu) {
                contextMenu.remove();
            }

            // Create context menu
            contextMenu = document.createElement('div');
            contextMenu.className = 'fixed bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50';
            contextMenu.style.left = event.pageX + 'px';
            contextMenu.style.top = event.pageY + 'px';

            const menuItems = [];

            // Reply option (available for all messages)
            menuItems.push({
                text: 'Balas',
                icon: 'fas fa-reply',
                action: () => replyToMessage(messageId)
            });

            // Delete option (only for own messages)
            if (senderType === 'user') {
                menuItems.push({
                    text: 'Hapus',
                    icon: 'fas fa-trash',
                    action: () => deleteMessage(messageId),
                    className: 'text-red-600 hover:bg-red-50'
                });
            }

            menuItems.forEach(item => {
                const menuItem = document.createElement('div');
                menuItem.className = `px-4 py-2 cursor-pointer hover:bg-gray-100 flex items-center space-x-2 ${item.className || ''}`;
                menuItem.innerHTML = `
                    <i class="${item.icon} text-sm w-4"></i>
                    <span class="text-sm">${item.text}</span>
                `;
                menuItem.addEventListener('click', (e) => {
                    e.stopPropagation();
                    item.action();
                    contextMenu.remove();
                    contextMenu = null;
                });
                contextMenu.appendChild(menuItem);
            });

            document.body.appendChild(contextMenu);

            // Close context menu when clicking outside
            setTimeout(() => {
                document.addEventListener('click', function closeContextMenu() {
                    if (contextMenu) {
                        contextMenu.remove();
                        contextMenu = null;
                    }
                    document.removeEventListener('click', closeContextMenu);
                });
            }, 0);
        }

        // Reply to message - now uses PHP redirect
        function replyToMessage(messageId) {
            window.location.href = `{{ route('support.web.chat.reply', '') }}/${messageId}`;
        }

        // Delete message
        function deleteMessage(messageId) {
            if (confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
                alert('Fitur hapus pesan belum tersedia');
                // TODO: Implement delete message functionality
            }
        }

        // Close conversation
        function closeConversation() {
            if (confirm('Apakah Anda yakin ingin mengakhiri percakapan ini?')) {
                fetch('{{ route("support.web.chat.close", $conversation) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Percakapan telah berakhir. Terima kasih!');
                        window.location.href = '/';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

        // Send message when Enter is pressed (without Shift)
        document.getElementById('messageInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.form.submit();
            }
        });

        // Start polling for new messages every 3 seconds
        setInterval(pollForNewMessages, 3000);

        // Scroll to bottom on page load
        window.addEventListener('load', function() {
            const chatContainer = document.getElementById('chatMessages').parentElement;
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    </script>
</section>

@endsection