@extends('staff.partials.layouts.chat')

@push('head')
    <!-- Disable transitions during page load for faster rendering -->
    <style>
        .no-transitions * {
            transition: none !important;
            animation: none !important;
        }
        
        /* Profile picture loading optimization */
        .profile-picture {
            background-color: #f3f4f6;
            transition: opacity 0.2s ease-in-out;
        }
        
        .profile-picture.loaded {
            opacity: 1;
        }
        
        /* Custom radio button styling */
        .form-radio {
            width: 1rem;
            height: 1rem;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            background-color: white;
            cursor: pointer;
            position: relative;
        }
        
        .form-radio:checked {
            background-color: currentColor;
            border-color: currentColor;
        }
        
        .form-radio:checked::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0.375rem;
            height: 0.375rem;
            background-color: white;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        
        .text-blue-600 {
            color: #2563eb;
        }
        
        .text-red-600 {
            color: #dc2626;
        }
        
        /* Send button animation */
        .send-button-active {
            opacity: 0.7;
            transform: scale(0.95);
        }
        
        .send-button-active .send-icon {
            display: none;
        }
        
        .send-button-active .loading-spinner {
            display: block !important;
        }
        
        /* Disabled textarea styling */
        textarea:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        /* WhatsApp-like message grouping */
        [data-message-group] .mb-1:not(:last-child) {
            margin-bottom: 2px; /* Reduce spacing between messages in same group */
        }
        
        [data-message-group] .mb-1:last-child {
            margin-bottom: 4px; /* Small spacing before timestamp */
        }
        
        /* Adjust message group spacing */
        [data-message-group] {
            margin-bottom: 16px; /* Spacing between different message groups */
        }
    </style>
@endpush

@section('content')
@php
// Helper function to generate profile picture HTML with consistent logic
function generateProfilePicture($user, $size = 48, $additionalClasses = '') {
    $colors = [
        '#3B82F6', '#8B5CF6', '#EF4444', '#10B981', '#F59E0B',
        '#EC4899', '#6366F1', '#84CC16', '#F97316', '#06B6D4',
        '#8B5A2B', '#DC2626', '#7C3AED', '#059669', '#D97706',
        '#BE185D', '#4F46E5', '#65A30D', '#EA580C', '#0891B2'
    ];
    
    $baseClasses = "rounded-full object-cover border border-neutral-200 flex-shrink-0 profile-picture loaded";
    $classes = "w-{$size} h-{$size} " . $baseClasses . ' ' . $additionalClasses;
    
    if ($user->profile_picture) {
        if (str_starts_with($user->profile_picture, 'assets/illustrations/')) {
            $src = asset($user->profile_picture);
        } else {
            $src = Storage::url($user->profile_picture);
        }
        return '<img src="' . $src . '" alt="' . e($user->name) . '" class="' . $classes . '" loading="eager">';
    } else {
        $colorIndex = $user->id % count($colors);
        $bgColor = $colors[$colorIndex];
        $initials = substr(collect(explode(' ', $user->name))->map(fn($word) => substr($word, 0, 1))->implode(''), 0, 2);
        $fontSize = round($size * 0.375); // Dynamic font size based on image size
        
        $svgAvatar = "data:image/svg+xml;base64," . base64_encode('
            <svg width="' . $size . '" height="' . $size . '" xmlns="http://www.w3.org/2000/svg">
                <rect width="' . $size . '" height="' . $size . '" fill="' . $bgColor . '"/>
                <text x="' . ($size/2) . '" y="' . ($size/2) . '" font-family="Arial, sans-serif" font-size="' . $fontSize . '" font-weight="400" text-anchor="middle" dominant-baseline="central" fill="white">' . $initials . '</text>
            </svg>
        ');
        return '<img src="' . $svgAvatar . '" alt="' . e($user->name) . '" class="' . $classes . '" loading="eager">';
    }
}
@endphp

<div class="h-screen bg-white no-transitions" id="chatContainer">
    <div class="flex h-screen">
        <div class="w-[50px] h-full bg-neutral-200">
            
        </div>
        <!-- Sidebar with conversations list -->
        <div class="w-[400px] bg-neutral-50 border-r border-neutral-200 flex flex-col">
            <div class="px-4 py-3 h-[70px] w-full flex items-end">
                <div class="flex items-center w-full justify-between space-x-3">
                    <a href="{{ route('staff.chat.index') }}" class="text-neutral-500 h-[32px] aspect-square flex justify-center items-center hover:bg-neutral-100 rounded-md">
                        <svg class="h-[24px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.5 15.1C20.2626 14.9821 19.9881 14.9633 19.7369 15.0477C19.4856 15.1321 19.2781 15.3127 19.16 15.55C18.5271 16.8282 17.5639 17.914 16.3703 18.6948C15.1767 19.4756 13.796 19.9231 12.3713 19.991C10.9466 20.0588 9.52961 19.7445 8.2672 19.0806C7.00479 18.4167 5.94283 17.4274 5.19132 16.2151C4.4398 15.0028 4.02607 13.6116 3.99296 12.1857C3.95985 10.7597 4.30858 9.35088 5.00302 8.10502C5.69747 6.85915 6.71237 5.82161 7.94261 5.09985C9.17284 4.37809 10.5737 3.99837 12 4.00001C13.4911 3.99355 14.9539 4.40764 16.2203 5.19476C17.4868 5.98188 18.5057 7.11012 19.16 8.45001C19.2794 8.6887 19.4886 8.87021 19.7418 8.9546C19.995 9.03899 20.2713 9.01936 20.51 8.90001C20.7487 8.78066 20.9302 8.57138 21.0146 8.31821C21.099 8.06503 21.0794 7.7887 20.96 7.55001C19.9566 5.53075 18.3002 3.90987 16.2597 2.95044C14.2192 1.99101 11.9143 1.74935 9.71921 2.26469C7.52407 2.78002 5.56753 4.0221 4.16713 5.78933C2.76674 7.55656 2.0047 9.74519 2.0047 12C2.0047 14.2548 2.76674 16.4435 4.16713 18.2107C5.56753 19.9779 7.52407 21.22 9.71921 21.7353C11.9143 22.2507 14.2192 22.009 16.2597 21.0496C18.3002 20.0901 19.9566 18.4693 20.96 16.45C21.0196 16.3314 21.055 16.2021 21.0641 16.0696C21.0732 15.9372 21.0558 15.8043 21.013 15.6786C20.9702 15.5529 20.9027 15.437 20.8147 15.3377C20.7266 15.2384 20.6196 15.1576 20.5 15.1ZM21 11H11.41L13.71 8.71001C13.8032 8.61677 13.8772 8.50608 13.9277 8.38426C13.9781 8.26244 14.0041 8.13187 14.0041 8.00001C14.0041 7.86815 13.9781 7.73758 13.9277 7.61576C13.8772 7.49394 13.8032 7.38325 13.71 7.29001C13.6168 7.19677 13.5061 7.12281 13.3843 7.07235C13.2624 7.02189 13.1319 6.99592 13 6.99592C12.8681 6.99592 12.7376 7.02189 12.6158 7.07235C12.4939 7.12281 12.3832 7.19677 12.29 7.29001L8.29001 11.29C8.19897 11.3851 8.1276 11.4973 8.08001 11.62C7.97999 11.8635 7.97999 12.1365 8.08001 12.38C8.1276 12.5028 8.19897 12.6149 8.29001 12.71L12.29 16.71C12.383 16.8037 12.4936 16.8781 12.6154 16.9289C12.7373 16.9797 12.868 17.0058 13 17.0058C13.132 17.0058 13.2627 16.9797 13.3846 16.9289C13.5064 16.8781 13.617 16.8037 13.71 16.71C13.8037 16.617 13.8781 16.5064 13.9289 16.3846C13.9797 16.2627 14.0058 16.132 14.0058 16C14.0058 15.868 13.9797 15.7373 13.9289 15.6154C13.8781 15.4936 13.8037 15.383 13.71 15.29L11.41 13H21C21.2652 13 21.5196 12.8947 21.7071 12.7071C21.8946 12.5196 22 12.2652 22 12C22 11.7348 21.8946 11.4804 21.7071 11.2929C21.5196 11.1054 21.2652 11 21 11Z" fill="currentColor"/>
                        </svg>
                    </a>
                    <input type="text" 
                           name="search" 
                           id="searchInput"
                           class="h-[32px] px-2 rounded-md outline-none w-full bg-neutral-100 border border-neutral-300 truncate text-sm focus:border-neutral-400 focus:bg-white" 
                           placeholder="Cari nama, email, layanan, percakapan..."
                           onkeyup="searchConversations(this.value)"
                           oninput="instantSearch(this.value)"
                           autocomplete="off">
                </div>
            </div>
            <div class="flex-1 space-y-1 overflow-y-auto px-2" id="conversationsList">
                @foreach($allConversations as $conv)
                    <div class="px-4 py-3 hover:bg-neutral-100 cursor-pointer rounded-lg {{ $conv->user_id === $conversation->user_id ? 'bg-neutral-200/70' : '' }} relative"
                         onclick="navigateToConversation({{ $conv->user_id }})"
                         oncontextmenu="showContextMenu(event, {{ $conv->id }}, {{ $conv->user_id }}, '{{ $conv->user->name }}', {{ $conv->is_pinned_by_staff ? 'true' : 'false' }})"
                         data-conversation-id="{{ $conv->id }}"
                         data-user-id="{{ $conv->user_id }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                {!! generateProfilePicture($conv->user, 12) !!}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center">
                                        @if($conv->is_pinned_by_staff)
                                            <svg class="w-4 h-4 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                                            </svg>
                                        @endif
                                        <p class="text-base font-medium text-neutral-900 truncate">{{ $conv->user->name }}</p>
                                        @if($conv->status === 'waiting')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 ml-2">Menunggu</span>
                                        @elseif($conv->status === 'active')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 ml-2">Aktif</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-neutral-500 truncate">{{ $conv->subject }}</p>
                                </div>
                            </div>
                            <div class="flex-col flex items-end">
                                <div class="text-xs text-neutral-400 mb-1.5">
                                    {{ $conv->last_message_at->format('g:i A') }}
                                </div>
                                @if($conv->getUnreadCountForStaff() > 0)
                                    <div class="flex justify-center py-[1px] px-[4px] items-center min-w-[20px] rounded-full text-center text-[12px] font-medium bg-[#128AEB] text-white">{{ $conv->getUnreadCountForStaff() }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Main chat area -->
        <div class="flex-1 flex flex-col relative overflow-hidden">
            <!-- Chat header -->
            <div class="px-6 h-[70px] py-3 w-full bg-gradient-to-b via-white/50 from-white to-white/0 z-10 absolute top-0">
                <div class="max-w-4xl mx-auto">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            {!! generateProfilePicture($conversation->user, 10,) !!}
                            <div class="ml-3">
                                <span class="text-base font-medium text-neutral-900">{{ $conversation->user->name }}</span>
                                <br>
                                @if($conversation->status === 'waiting')
                                    <span class="text-sm text-neutral-500">
                                        Menunggu
                                    </span>
                                @elseif($conversation->status === 'active')
                                    <span class="text-sm text-neutral-500">
                                        Aktif
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($conversation->status !== 'closed')
                                <button onclick="closeConversation()" class="inline-flex items-center px-3 py-2 bg-neutral-100 text-sm leading-4 font-medium rounded-full text-neutral-700 hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Tutup Chat
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages area -->
            <div class="flex-1 overflow-y-auto px-8 -mb-5" id="messagesContainer">
                <div class="max-w-3xl mx-auto px-2 pt-12">
                    <!-- Load more indicator -->
                    <div id="loadMoreIndicator" class="hidden text-center py-4">
                        <div class="inline-flex items-center px-4 py-2 text-sm text-gray-600">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memuat pesan...
                        </div>
                    </div>
                    
                    <div class="w-full py-4" id="chatMessages">
                        <!-- Messages will be loaded here dynamically -->
                        
                        <!-- Typing indicator -->
                        <div id="typingIndicator" class="hidden flex justify-start mb-4">
                            <div class="max-w-xs lg:max-w-md">
                                <div class="bg-white border border-neutral-200 px-4 py-3 rounded-2xl rounded-bl-md">
                                    <div class="flex items-center space-x-1">
                                        <div class="flex space-x-1">
                                            <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                                            <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                            <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                        </div>
                                        <span class="text-xs text-neutral-500 ml-2" id="typingUserName">sedang mengetik...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message input area -->
            <div class="flex-shrink-0 px-6 pb-6 z-10">
                <div class="max-w-3xl mx-auto">
                    @if($conversation->status !== 'closed')
                        <div class="bg-white border border-neutral-300 rounded-[28px] min-h-[100px] p-[12px] w-full">
                            <!-- Reply preview -->
                            <div id="replyPreview" class="hidden mb-3 px-3 py-3 bg-neutral-100 rounded-[18px]">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="text-xs text-neutral-600 mb-1">Membalas <span id="replyToUser"></span></p>
                                        <p class="text-sm text-neutral-800" id="replyToMessage"></p>
                                    </div>
                                    <button onclick="cancelReply()" class="text-neutral-400 hover:text-neutral-600">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="flex flex-col w-full">
                                <div class="w-full mb-4 px-1">
                                    <textarea 
                                        id="messageInput" 
                                        rows="1" 
                                        class="block w-full placeholder-neutral-400 focus:outline-none focus:border-transparent resize-none"
                                        placeholder="Ketik pesan Anda..."
                                        onkeydown="handleKeyPress(event)"
                                        oninput="adjustTextareaHeight(this); handleTyping()"
                                        onblur="stopTyping()"
                                    ></textarea>
                                </div>
                                <div class="w-full flex justify-between items-center">
                                    <!-- Debug button (temporary) -->
                                    <button type="button" onclick="" class="inline-flex items-center h-[30px] px-2 text-xs border border-gray-300 rounded text-gray-600 bg-gray-100 hover:bg-gray-200">
                                        Debug
                                    </button>
                                    
                                    <button type="button" class="inline-flex items-center h-[38px] flex justify-center items-center aspect-square border border-transparent text-sm font-medium rounded-full text-blue-500 bg-neutral-200/60 hover:bg-neutral-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <svg class="h-[16px]" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.125 6.125H7.875V0.875C7.875 0.642936 7.78281 0.420376 7.61872 0.256282C7.45462 0.0921874 7.23206 0 7 0C6.76794 0 6.54538 0.0921874 6.38128 0.256282C6.21719 0.420376 6.125 0.642936 6.125 0.875V6.125H0.875C0.642936 6.125 0.420376 6.21719 0.256282 6.38128C0.0921874 6.54538 0 6.76794 0 7C0 7.23206 0.0921874 7.45462 0.256282 7.61872C0.420376 7.78281 0.642936 7.875 0.875 7.875H6.125V13.125C6.125 13.3571 6.21719 13.5796 6.38128 13.7437C6.54538 13.9078 6.76794 14 7 14C7.23206 14 7.45462 13.9078 7.61872 13.7437C7.78281 13.5796 7.875 13.3571 7.875 13.125V7.875H13.125C13.3571 7.875 13.5796 7.78281 13.7437 7.61872C13.9078 7.45462 14 7.23206 14 7C14 6.76794 13.9078 6.54538 13.7437 6.38128C13.5796 6.21719 13.3571 6.125 13.125 6.125Z" fill="#128AEB"/>
                                        </svg>
                                    </button>
                                    <button id="sendButton" onclick="sendMessage()" class="inline-flex items-center h-[38px] flex justify-center items-center aspect-square border border-transparent text-sm font-medium rounded-full text-blue-500 bg-neutral-200/60 hover:bg-neutral-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                        disabled>
                                        <svg class="h-[18px] send-icon" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.8368 5.12146L3.03732 0.220051C2.65059 0.0275025 2.2139 -0.0410462 1.7868 0.0237512C1.35969 0.0885486 0.962959 0.283539 0.650686 0.582136C0.338414 0.880734 0.1258 1.26841 0.0418322 1.6923C-0.0421352 2.11619 0.00663017 2.55568 0.18148 2.95083L1.86139 6.71091C1.89951 6.80182 1.91914 6.89941 1.91914 6.99799C1.91914 7.09658 1.89951 7.19417 1.86139 7.28508L0.18148 11.0452C0.0391775 11.3649 -0.0209803 11.7152 0.00647321 12.0642C0.0339267 12.4132 0.148121 12.7497 0.338679 13.0433C0.529236 13.3369 0.790115 13.5782 1.09761 13.7453C1.4051 13.9124 1.74945 13.9999 2.09938 14C2.42712 13.9967 2.74998 13.9202 3.04432 13.7759L12.8438 8.87453C13.1914 8.69961 13.4836 8.43152 13.6877 8.10017C13.8919 7.76881 14 7.38723 14 6.99799C14 6.60876 13.8919 6.22718 13.6877 5.89582C13.4836 5.56447 13.1914 5.29638 12.8438 5.12146H12.8368ZM12.2138 7.62117L2.41436 12.5226C2.28568 12.5844 2.14119 12.6054 2.00025 12.5827C1.85932 12.56 1.72868 12.4948 1.62586 12.3957C1.52304 12.2967 1.45295 12.1686 1.42498 12.0285C1.39702 11.8885 1.41252 11.7433 1.46941 11.6123L3.14232 7.85224C3.16397 7.80203 3.18267 7.75059 3.19832 7.69819H8.02105C8.20669 7.69819 8.38473 7.62442 8.516 7.49311C8.64727 7.3618 8.72102 7.1837 8.72102 6.99799C8.72102 6.81229 8.64727 6.63419 8.516 6.50288C8.38473 6.37156 8.20669 6.29779 8.02105 6.29779H3.19832C3.18267 6.2454 3.16397 6.19396 3.14232 6.14375L1.46941 2.38367C1.41252 2.25271 1.39702 2.10748 1.42498 1.96745C1.45295 1.82742 1.52304 1.6993 1.62586 1.60025C1.72868 1.5012 1.85932 1.43597 2.00025 1.4133C2.14119 1.39063 2.28568 1.4116 2.41436 1.47341L12.2138 6.37482C12.3285 6.43357 12.4247 6.52285 12.4919 6.6328C12.5591 6.74275 12.5946 6.86912 12.5946 6.99799C12.5946 7.12686 12.5591 7.25323 12.4919 7.36319C12.4247 7.47314 12.3285 7.56241 12.2138 7.62117V7.62117Z" fill="#128AEB"/>
                                        </svg>
                                        <!-- Loading spinner (hidden by default) -->
                                        <svg class="h-[18px] loading-spinner hidden animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.25"></circle>
                                            <path d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" fill="currentColor"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-neutral-100 w-full border border-neutral-200 rounded-lg px-6 py-4 text-center">
                            <p class="text-sm text-neutral-500">Percakapan ini telah ditutup</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message Context Menu -->
<div id="messageContextMenu" class="fixed bg-neutral-100/80 backdrop-blur-lg min-w-[12rem] border border-neutral-200/70 rounded-lg shadow-lg drop-shadow py-1 px-1 z-50 hidden transform scale-0 opacity-0 transition-all duration-150 ease-out origin-top-left">
    <button onclick="replyToMessage()" class="w-full p-2 gap-x-3 rounded-md text-left text-base hover:bg-white/40 flex items-center pr-10 transition-colors duration-150">
        <svg class="w-[20px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 9.5H7.40999L8.70999 8.21C8.89829 8.0217 9.00408 7.7663 9.00408 7.5C9.00408 7.2337 8.89829 6.97831 8.70999 6.79C8.52168 6.6017 8.26629 6.49591 7.99999 6.49591C7.73369 6.49591 7.47829 6.6017 7.28999 6.79L4.28999 9.79C4.19895 9.88511 4.12758 9.99725 4.07999 10.12C3.97997 10.3635 3.97997 10.6365 4.07999 10.88C4.12758 11.0028 4.19895 11.1149 4.28999 11.21L7.28999 14.21C7.38295 14.3037 7.49355 14.3781 7.61541 14.4289C7.73727 14.4797 7.86798 14.5058 7.99999 14.5058C8.132 14.5058 8.26271 14.4797 8.38456 14.4289C8.50642 14.3781 8.61702 14.3037 8.70999 14.21C8.80372 14.117 8.87811 14.0064 8.92888 13.8846C8.97965 13.7627 9.00579 13.632 9.00579 13.5C9.00579 13.368 8.97965 13.2373 8.92888 13.1154C8.87811 12.9936 8.80372 12.883 8.70999 12.79L7.40999 11.5H17C17.2652 11.5 17.5196 11.6054 17.7071 11.7929C17.8946 11.9804 18 12.2348 18 12.5V16.5C18 16.7652 18.1053 17.0196 18.2929 17.2071C18.4804 17.3946 18.7348 17.5 19 17.5C19.2652 17.5 19.5196 17.3946 19.7071 17.2071C19.8946 17.0196 20 16.7652 20 16.5V12.5C20 11.7044 19.6839 10.9413 19.1213 10.3787C18.5587 9.81607 17.7956 9.5 17 9.5Z" fill="currentColor"/>
        </svg>
        Balas
    </button>
    <button onclick="copyMessage()" class="w-full p-2 gap-x-3 rounded-md text-left text-base hover:bg-white/40 flex items-center pr-10 transition-colors duration-150">
        <svg class="w-[20px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 4H16C16 3.46957 15.7893 2.96086 15.4142 2.58579C15.0391 2.21071 14.5304 2 14 2H10C9.46957 2 8.96086 2.21071 8.58579 2.58579C8.21071 2.96086 8 3.46957 8 4H7C6.20435 4 5.44129 4.31607 4.87868 4.87868C4.31607 5.44129 4 6.20435 4 7V19C4 19.7956 4.31607 20.5587 4.87868 21.1213C5.44129 21.6839 6.20435 22 7 22H17C17.7956 22 18.5587 21.6839 19.1213 21.1213C19.6839 20.5587 20 19.7956 20 19V7C20 6.20435 19.6839 5.44129 19.1213 4.87868C18.5587 4.31607 17.7956 4 17 4ZM10 4H14V5V6H10V4ZM18 19C18 19.2652 17.8946 19.5196 17.7071 19.7071C17.5196 19.8946 17.2652 20 17 20H7C6.73478 20 6.48043 19.8946 6.29289 19.7071C6.10536 19.5196 6 19.2652 6 19V7C6 6.73478 6.10536 6.48043 6.29289 6.29289C6.48043 6.10536 6.73478 6 7 6H8C8 6.53043 8.21071 7.03914 8.58579 7.41421C8.96086 7.78929 9.46957 8 10 8H14C14.5304 8 15.0391 7.78929 15.4142 7.41421C15.7893 7.03914 16 6.53043 16 6H17C17.2652 6 17.5196 6.10536 17.7071 6.29289C17.8946 6.48043 18 6.73478 18 7V19Z" fill="currentColor"/>
        </svg>
        Salin
    </button>
    <button onclick="toggleStarMessage()" class="w-full p-2 gap-x-3 rounded-md text-left text-base hover:bg-white/40 flex items-center pr-10 hidden transition-colors duration-150">
        <svg id="starIcon" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>
        <span id="starText">Beri Bintang</span>
    </button>
    <button onclick="deleteMessageConfirm()" class="w-full p-2 gap-x-3 rounded-md text-left text-base hover:bg-white/40 flex items-center pr-10 transition-colors duration-150" id="deleteMessageBtn">
        <svg class="h-[20px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10 18C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17V11C11 10.7348 10.8946 10.4804 10.7071 10.2929C10.5196 10.1054 10.2652 10 10 10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11V17C9 17.2652 9.10536 17.5196 9.29289 17.7071C9.48043 17.8946 9.73478 18 10 18ZM20 6H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2H11C10.2044 2 9.44129 2.31607 8.87868 2.87868C8.31607 3.44129 8 4.20435 8 5V6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7C3 7.26522 3.10536 7.51957 3.29289 7.70711C3.48043 7.89464 3.73478 8 4 8H5V19C5 19.7956 5.31607 20.5587 5.87868 21.1213C6.44129 21.6839 7.20435 22 8 22H16C16.7956 22 17.5587 21.6839 18.1213 21.1213C18.6839 20.5587 19 19.7956 19 19V8H20C20.2652 8 20.5196 7.89464 20.7071 7.70711C20.8946 7.51957 21 7.26522 21 7C21 6.73478 20.8946 6.48043 20.7071 6.29289C20.5196 6.10536 20.2652 6 20 6ZM10 5C10 4.73478 10.1054 4.48043 10.2929 4.29289C10.4804 4.10536 10.7348 4 11 4H13C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V6H10V5ZM17 19C17 19.2652 16.8946 19.5196 16.7071 19.7071C16.5196 19.8946 16.2652 20 16 20H8C7.73478 20 7.48043 19.8946 7.29289 19.7071C7.10536 19.5196 7 19.2652 7 19V8H17V19ZM14 18C14.2652 18 14.5196 17.8946 14.7071 17.7071C14.8946 17.5196 15 17.2652 15 17V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10C13.7348 10 13.4804 10.1054 13.2929 10.2929C13.1054 10.4804 13 10.7348 13 11V17C13 17.2652 13.1054 17.5196 13.2929 17.7071C13.4804 17.8946 13.7348 18 14 18Z" fill="currentColor"/>
        </svg>
        Hapus Pesan Saya
    </button>
</div>

<!-- Context Menu -->
<div id="contextMenu" class="fixed bg-neutral-100/80 backdrop-blur-lg min-w-[12rem] border border-neutral-200/70 rounded-lg shadow-lg drop-shadow py-1 px-1 z-50 hidden transform scale-0 opacity-0 transition-all duration-150 ease-out origin-top-left">
    <button onclick="togglePinConversation()" class="w-full p-2 gap-x-3 rounded-md text-left text-base hover:bg-white/40 flex items-center pr-10 transition-colors duration-150">
        <svg id="pinIcon" class="w-[20px]" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
        </svg>
        <span id="pinText">Pin Chat</span>
    </button>
    <button onclick="showDeleteModal()" class="w-full p-2 gap-x-3 rounded-md text-left text-base hover:bg-white/40 flex items-center pr-10 text-red-600 transition-colors duration-150">
        <svg class="w-[20px]" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        Hapus Chat
    </button>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-neutral-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-neutral-900">Hapus Percakapan</h3>
        </div>
        <div class="px-6 py-4">
            <p class="text-sm text-neutral-600 mb-4">
                Pilih tindakan untuk percakapan dengan <span id="deleteUserName" class="font-medium"></span>:
            </p>
            <div class="space-y-3">
                <label class="flex items-center">
                    <input type="radio" name="deleteType" value="hide" class="form-radio text-blue-600" checked>
                    <span class="ml-2 text-sm">Hapus dari daftar percakapan saja</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="deleteType" value="delete" class="form-radio text-red-600">
                    <span class="ml-2 text-sm text-red-600">Hapus percakapan dan semua pesan secara permanen</span>
                </label>
            </div>
        </div>
        <div class="px-6 py-4 bg-neutral-50 flex justify-end space-x-3 rounded-b-lg">
            <button onclick="hideDeleteModal()" class="px-4 py-2 text-sm font-medium text-neutral-700 bg-white border border-neutral-300 rounded-md hover:bg-neutral-50">
                Batal
            </button>
            <button onclick="confirmDeleteConversation()" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                Hapus
            </button>
        </div>
    </div>
</div>

@push('scripts')
<style>
    /* Message Animation Styles */
    .message-enter {
        transform: translateY(20px);
        opacity: 0;
        scale: 0.95;
    }
    
    .message-enter-active {
        transform: translateY(0);
        opacity: 1;
        scale: 1;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .message-group-enter {
        transform: translateY(30px);
        opacity: 0;
    }
    
    .message-group-enter-active {
        transform: translateY(0);
        opacity: 1;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .message-bubble {
        transition: all 0.3s ease;
    }
    
    .message-bubble:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    /* Typing indicator animation */
    .typing-indicator {
        animation: fadeInUp 0.3s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Send button animation */
    .send-button-active {
        transform: scale(0.95);
        background-color: #0ea5e9;
    }
    
    /* Smooth scroll behavior - disabled initially */
    #messagesContainer {
        scroll-behavior: auto;
    }
    
    /* Enable smooth scroll after initial load */
    #messagesContainer.smooth-scroll {
        scroll-behavior: smooth;
    }
    
    /* Enhanced message group animation on load */
    @keyframes slideInFromBottom {
        0% {
            transform: translateY(20px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .message-group-loaded {
        animation: slideInFromBottom 0.3s ease-out forwards;
    }
    
    /* Remove transition on initial load to prevent flash */
    .no-transitions * {
        transition: none !important;
        animation: none !important;
    }
</style>

<script>
    const conversationId = {{ $conversation->id }};
    const currentUserId = {{ $conversation->user_id }};
    let lastMessageId = 0; // Will be set after initial load
    let oldestMessageId = null; // For pagination
    let isPolling = false;
    let isPollingConversations = false;
    let isLoadingMessages = false;
    let hasMoreMessages = true;
    let typingTimeout;
    let lastConversationUpdate = 0;
    let documentVisible = true;
    let lastUserActivity = Date.now();
    let messagesContainer = null;
    let isInitialLoad = true;

    // Load initial messages and setup pagination
    function loadInitialMessages() {
        loadMessages(null, true);
    }

    // Load messages with pagination
    function loadMessages(beforeMessageId = null, isInitial = false) {
        if (isLoadingMessages && !isInitial) return;
        
        isLoadingMessages = true;
        
        // Show loading indicator for pagination (not initial load)
        if (!isInitial && hasMoreMessages) {
            document.getElementById('loadMoreIndicator').classList.remove('hidden');
        }

        fetch('/staff/chat/get-messages-paginated', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                conversation_id: conversationId,
                before_message_id: beforeMessageId,
                limit: 30
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.messages.length === 0) {
                    hasMoreMessages = false;
                    return;
                }

                // Update pagination state
                hasMoreMessages = data.has_more;
                if (data.messages.length > 0) {
                    oldestMessageId = data.messages[0].id;
                    
                    // Set lastMessageId from latest message if initial load
                    if (isInitial) {
                        lastMessageId = data.messages[data.messages.length - 1].id;
                    }
                }

                // Process and render messages
                if (isInitial) {
                    renderInitialMessages(data.messages);
                    // Additional immediate scroll after AJAX response
                    requestAnimationFrame(() => {
                        scrollToBottomImmediate();
                    });
                } else {
                    prependMessages(data.messages);
                }
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
        })
        .finally(() => {
            isLoadingMessages = false;
            document.getElementById('loadMoreIndicator').classList.add('hidden');
        });
    }

    // Render initial messages (latest 30)
    function renderInitialMessages(messages) {
        const chatMessages = document.getElementById('chatMessages');
        chatMessages.innerHTML = ''; // Clear existing content
        
        // Group messages and render
        const groupedMessages = groupMessages(messages);
        groupedMessages.forEach((group, index) => {
            // Track all loaded messages to prevent duplicates
            group.forEach(message => {
                if (message.id) {
                    processedMessages.add(message.id);
                    const messageKey = `${message.sender_type}_${message.message}_${message.created_at}`;
                    processedMessages.add(messageKey);
                }
            });
            
            renderMessageGroup(group, true); // append = true for initial load
            
            // Add staggered animation for initial load only if not first load
            if (!isInitialLoad) {
                const groupElement = chatMessages.children[chatMessages.children.length - 1];
                if (groupElement) {
                    groupElement.style.animationDelay = `${index * 0.1}s`;
                    groupElement.classList.add('message-group-loaded');
                }
            }
        });
        
        addTypingIndicator();
        
        // Reprocess message grouping to ensure proper timestamp display
        requestAnimationFrame(() => {
            reprocessMessageGrouping();
        });
        
        // Mark that initial load is complete
        if (isInitialLoad) {
            isInitialLoad = false;
            // Multiple attempts to ensure scroll works
            scrollToBottomImmediate();
            setTimeout(() => {
                scrollToBottomImmediate();
            }, 10);
            setTimeout(() => {
                scrollToBottomImmediate();
            }, 100);
        }
    }

    // Prepend older messages to the top
    function prependMessages(messages) {
        const chatMessages = document.getElementById('chatMessages');
        const scrollHeight = messagesContainer.scrollHeight;
        const scrollTop = messagesContainer.scrollTop;
        
        // Group messages and render at the beginning
        const groupedMessages = groupMessages(messages);
        
        // Track all prepended messages to prevent duplicates
        messages.forEach(message => {
            if (message.id) {
                processedMessages.add(message.id);
                const messageKey = `${message.sender_type}_${message.message}_${message.created_at}`;
                processedMessages.add(messageKey);
            }
        });
        
        // Create temporary container for new messages
        const tempContainer = document.createElement('div');
        groupedMessages.forEach(group => {
            const groupElement = createMessageGroupElement(group);
            tempContainer.appendChild(groupElement);
        });
        
        // Insert all new messages at the beginning
        while (tempContainer.firstChild) {
            chatMessages.insertBefore(tempContainer.firstChild, chatMessages.firstChild);
        }
        
        // Maintain scroll position
        const newScrollHeight = messagesContainer.scrollHeight;
        messagesContainer.scrollTop = scrollTop + (newScrollHeight - scrollHeight);
        
        // Reprocess message grouping to ensure proper timestamp display
        requestAnimationFrame(() => {
            reprocessMessageGrouping();
        });
    }

    // Group messages by sender and time
    function groupMessages(messages) {
        const groupedMessages = [];
        let currentGroup = [];
        let lastSender = null;
        let lastTime = null;
        
        messages.forEach(message => {
            const messageTime = new Date(message.created_at);
            const timeDiff = lastTime ? Math.abs(messageTime.getTime() - lastTime.getTime()) / 1000 : 301;
            
            // Group messages if same sender and within 5 minutes (300 seconds)
            if (lastSender === message.sender_type && timeDiff <= 300) {
                currentGroup.push(message);
            } else {
                if (currentGroup.length > 0) {
                    groupedMessages.push(currentGroup);
                }
                currentGroup = [message];
                lastSender = message.sender_type;
            }
            lastTime = messageTime;
        });
        
        // Add last group
        if (currentGroup.length > 0) {
            groupedMessages.push(currentGroup);
        }
        
        return groupedMessages;
    }

    // Render a message group
    function renderMessageGroup(messageGroup, append = true) {
        const groupElement = createMessageGroupElement(messageGroup);
        const chatMessages = document.getElementById('chatMessages');
        
        if (append) {
            // Add animation class for new messages
            groupElement.classList.add('message-group-enter');
            
            // Find typing indicator and insert before it
            const typingIndicator = document.getElementById('typingIndicator');
            if (typingIndicator) {
                chatMessages.insertBefore(groupElement, typingIndicator);
            } else {
                chatMessages.appendChild(groupElement);
            }
            
            // Trigger animation
            requestAnimationFrame(() => {
                groupElement.classList.add('message-group-enter-active');
            });
        } else {
            chatMessages.insertBefore(groupElement, chatMessages.firstChild);
        }
    }

    // Create message group DOM element
    function createMessageGroupElement(messageGroup) {
        const firstMessage = messageGroup[0];
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex ${firstMessage.sender_type === 'staff' ? 'justify-end' : 'justify-start'} mb-4`;
        messageDiv.setAttribute('data-message-group', firstMessage.sender_type);
        
        if (firstMessage.sender_type === 'staff') {
            messageDiv.innerHTML = createStaffMessageGroupHTML(messageGroup);
        } else {
            messageDiv.innerHTML = createUserMessageGroupHTML(messageGroup);
        }
        
        return messageDiv;
    }

    // Create staff message group HTML
    function createStaffMessageGroupHTML(messageGroup) {
        let messagesHTML = '';
        const lastMessage = messageGroup[messageGroup.length - 1];
        
        messageGroup.forEach((message, index) => {
            let replyHtml = '';
            if (message.reply_to_message_id && message.reply_to_message) {
                const replySender = message.reply_to_message.sender_type === 'user' ? '{{ $conversation->user->name }}' : (message.reply_to_message.sender_name || 'Staff');
                replyHtml = `
                    <div class="bg-neutral-200 p-2 rounded-lg mb-2 border-l-2 border-blue-500">
                        <p class="text-xs text-neutral-600">${replySender}</p>
                        <p class="text-sm text-neutral-700 truncate">${message.reply_to_message.message.substring(0, 50)}${message.reply_to_message.message.length > 50 ? '...' : ''}</p>
                    </div>
                `;
            }

            const roundingClass = messageGroup.length === 1 ? 'rounded-2xl rounded-br-md' :
                                 index === 0 ? 'rounded-t-2xl rounded-bl-2xl rounded-br-lg' :
                                 index === messageGroup.length - 1 ? 'rounded-b-2xl rounded-bl-lg rounded-br-md' : 
                                 'rounded-lg rounded-br-lg';

            messagesHTML += `
                <div class="mb-1" data-message-id="${message.id}">
                    ${replyHtml}
                    <div class="bg-[#128AEB] border-t border-sky-300 text-white px-4 py-3 ${roundingClass} relative group message-bubble"
                         oncontextmenu="showMessageContextMenu(event, ${message.id}, '${message.sender_type}', '${message.message.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}', ${message.is_starred ? 'true' : 'false'})"
                         data-message="${message.message.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}">
                        <p class="text-sm">${message.message}</p>
                        ${message.is_starred ? `
                            <svg class="w-3 h-3 text-yellow-300 absolute top-1 right-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        ` : ''}
                    </div>
                </div>
            `;
        });

        const time = new Date(lastMessage.created_at).toLocaleTimeString('en-US', { 
            hour: 'numeric', 
            minute: '2-digit',
            hour12: true 
        });

        return `
            <div class="max-w-xs lg:max-w-md min-w-[100px]">
                ${messagesHTML}
                <div class="flex items-center justify-end mt-1 mr-2">
                    <span class="text-xs text-neutral-500 hidden">${lastMessage.sender_name || 'Staff'}</span>
                    <span class="text-xs text-neutral-400 ml-2">${time}</span>
                </div>
            </div>
        `;
    }

    // Create user message group HTML  
    function createUserMessageGroupHTML(messageGroup) {
        let messagesHTML = '';
        const lastMessage = messageGroup[messageGroup.length - 1];
        
        messageGroup.forEach((message, index) => {
            let replyHtml = '';
            if (message.reply_to_message_id && message.reply_to_message) {
                const replySender = message.reply_to_message.sender_type === 'user' ? '{{ $conversation->user->name }}' : (message.reply_to_message.sender_name || 'Staff');
                replyHtml = `
                    <div class="bg-neutral-200 p-2 rounded-lg mb-2 border-l-2 border-neutral-500">
                        <p class="text-xs text-neutral-600">${replySender}</p>
                        <p class="text-sm text-neutral-700 truncate">${message.reply_to_message.message.substring(0, 50)}${message.reply_to_message.message.length > 50 ? '...' : ''}</p>
                    </div>
                `;
            }

            const roundingClass = messageGroup.length === 1 ? 'rounded-2xl rounded-bl-md' :
                                 index === 0 ? 'rounded-t-2xl rounded-br-2xl rounded-bl-lg' :
                                 index === messageGroup.length - 1 ? 'rounded-b-2xl rounded-br-lg rounded-bl-md' : 
                                 'rounded-lg rounded-bl-lg';

            messagesHTML += `
                <div class="mb-1" data-message-id="${message.id}">
                    ${replyHtml}
                    <div class="bg-white border border-neutral-200 px-4 py-3 ${roundingClass} relative group message-bubble"
                         oncontextmenu="showMessageContextMenu(event, ${message.id}, '${message.sender_type}', '${message.message.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}', ${message.is_starred ? 'true' : 'false'})"
                         data-message="${message.message.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}">
                        <p class="text-sm text-neutral-800">${message.message}</p>
                        ${message.is_starred ? `
                            <svg class="w-3 h-3 text-yellow-500 absolute top-1 right-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        ` : ''}
                    </div>
                </div>
            `;
        });

        const time = new Date(lastMessage.created_at).toLocaleTimeString('en-US', { 
            hour: 'numeric', 
            minute: '2-digit',
            hour12: true 
        });

        return `
            <div class="max-w-xs lg:max-w-md">
                ${messagesHTML}
                <div class="flex items-center mt-1 ml-2">
                    <span class="text-xs text-neutral-500 hidden">${lastMessage.sender_name || '{{ $conversation->user->name }}'}</span>
                    <span class="text-xs text-neutral-400">${time}</span>
                </div>
            </div>
        `;
    }

    // Add typing indicator to the bottom
    function addTypingIndicator() {
        const chatMessages = document.getElementById('chatMessages');
        const typingIndicatorHTML = `
            <div id="typingIndicator" class="hidden flex justify-start mb-4 typing-indicator">
                <div class="max-w-xs lg:max-w-md">
                    <div class="bg-white border border-neutral-200 px-4 py-3 rounded-2xl rounded-bl-md message-bubble">
                        <div class="flex items-center space-x-1">
                            <div class="flex space-x-1">
                                <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                                <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                <div class="w-2 h-2 bg-neutral-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            </div>
                            <span class="text-xs text-neutral-500 ml-2" id="typingUserName">sedang mengetik...</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        chatMessages.insertAdjacentHTML('beforeend', typingIndicatorHTML);
    }

    // Scroll to bottom immediately without delay for initial load
    function scrollToBottomImmediate() {
        if (messagesContainer) {
            // Disable smooth scrolling temporarily
            messagesContainer.classList.remove('smooth-scroll');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            // Force immediate scroll, then scroll again after a short delay to ensure it worked
            requestAnimationFrame(() => {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                // Re-enable smooth scrolling for future scrolls
                setTimeout(() => {
                    messagesContainer.classList.add('smooth-scroll');
                }, 100);
            });
        }
    }

    // Scroll to bottom smoothly
    function scrollToBottom() {
        setTimeout(() => {
            if (messagesContainer) {
                // Ensure smooth scrolling is enabled for regular scrolls
                messagesContainer.classList.add('smooth-scroll');
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        }, 100);
    }

    // Scroll to bottom with animation for new messages
    function scrollToBottomAnimated() {
        setTimeout(() => {
            if (messagesContainer) {
                // Ensure smooth scrolling is enabled
                messagesContainer.classList.add('smooth-scroll');
                messagesContainer.scrollTo({
                    top: messagesContainer.scrollHeight,
                    behavior: 'smooth'
                });
            }
        }, 50);
    }

    // Setup scroll event listener for loading more messages
    function setupScrollListener() {
        messagesContainer.addEventListener('scroll', function() {
            // Check if user scrolled to near the top (within 100px)
            if (messagesContainer.scrollTop <= 100 && hasMoreMessages && !isLoadingMessages) {
                loadMessages(oldestMessageId, false);
            }
        });
    }
    const profileData = {
        currentUser: {
            id: {{ $conversation->user_id }},
            name: @json($conversation->user->name),
            @if($conversation->user->profile_picture)
                @if(str_starts_with($conversation->user->profile_picture, 'assets/illustrations/'))
                    profilePicture: @json(asset($conversation->user->profile_picture)),
                @else
                    profilePicture: @json(Storage::url($conversation->user->profile_picture)),
                @endif
            @else
                profilePicture: null,
            @endif
        },
        colors: [
            '#3B82F6', '#8B5CF6', '#EF4444', '#10B981', '#F59E0B',
            '#EC4899', '#6366F1', '#84CC16', '#F97316', '#06B6D4',
            '#8B5A2B', '#DC2626', '#7C3AED', '#059669', '#D97706',
            '#BE185D', '#4F46E5', '#65A30D', '#EA580C', '#0891B2'
        ]
    };

    // Fast profile picture generator using pre-built data
    function getProfilePictureUrl(userId, userName, profilePicture) {
        if (profilePicture) {
            if (profilePicture.startsWith('assets/illustrations/')) {
                return `/${profilePicture}`;
            } else {
                return `/storage/${profilePicture}`;
            }
        } else {
            const colorIndex = userId % profileData.colors.length;
            const bgColor = profileData.colors[colorIndex];
            const initials = userName.split(' ').map(word => word.charAt(0)).join('').substring(0, 2).toUpperCase();
            return `data:image/svg+xml;base64,${btoa(`<svg width="48" height="48" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" fill="${bgColor}"/><text x="24" y="24" font-family="Arial, sans-serif" font-size="18" font-weight="400" text-anchor="middle" dominant-baseline="central" fill="white">${initials}</text></svg>`)}`;
        }
    }

    // Add profile picture preloading
    document.addEventListener('DOMContentLoaded', function() {
        // Preload current user profile picture if it exists
        if (profileData.currentUser.profilePicture) {
            const preloadImg = new Image();
            preloadImg.src = profileData.currentUser.profilePicture;
        }
        
        // Ensure all profile pictures are marked as loaded
        setTimeout(() => {
            document.querySelectorAll('.profile-picture').forEach(img => {
                img.classList.add('loaded');
            });
        }, 50);
        
        // Remove no-transitions class after DOM is ready
        setTimeout(() => {
            document.getElementById('chatContainer').classList.remove('no-transitions');
        }, 100);
    });

    // Track document visibility for performance optimization
    document.addEventListener('visibilitychange', function() {
        documentVisible = !document.hidden;
        if (documentVisible) {
            lastUserActivity = Date.now();
            // Immediately poll when user returns
            setTimeout(() => {
                pollForNewMessages();
                pollConversationsList();
            }, 100);
        }
    });

    // Cleanup tracking sets periodically to prevent memory leaks
    setInterval(() => {
        // Keep only recent message IDs (last 1000)
        if (sentMessageIds.size > 1000) {
            const oldIds = Array.from(sentMessageIds).slice(0, sentMessageIds.size - 500);
            oldIds.forEach(id => sentMessageIds.delete(id));
        }
        
        if (processedMessages.size > 2000) {
            const oldMessages = Array.from(processedMessages).slice(0, processedMessages.size - 1000);
            oldMessages.forEach(msg => processedMessages.delete(msg));
        }
    }, 300000); // Every 5 minutes

    // Track user activity
    ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(function(event) {
        document.addEventListener(event, function() {
            lastUserActivity = Date.now();
        }, { passive: true });
    });

    // Search conversations functionality
    let searchTimeout;
    let searchCache = new Map(); // Cache search results
    let profilePictureCache = new Map(); // Cache profile pictures to prevent refresh loops
    
    // Instant search for immediate response
    function instantSearch(query) {
        if (query.length === 0) {
            performSearch(query);
            return;
        }
        
        // For single character, do instant search without debounce
        if (query.length === 1) {
            performSearch(query);
        }
    }
    
    function searchConversations(query) {
        clearTimeout(searchTimeout);
        
        // Immediate search for very short queries or empty
        if (query.length <= 1) {
            performSearch(query);
            return;
        }
        
        // Check cache first
        if (searchCache.has(query.toLowerCase())) {
            applySearchResults(searchCache.get(query.toLowerCase()));
            return;
        }
        
        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 100); // Reduced debounce to 100ms for faster response
    }

    function performSearch(query) {
        const conversationItems = document.querySelectorAll('#conversationsList > div');
        const searchQuery = query.toLowerCase().trim();
        
        if (searchQuery === '') {
            // Show all conversations and clear cache
            conversationItems.forEach(item => {
                item.style.display = 'block';
            });
            searchCache.clear();
            return;
        }

        const results = [];
        conversationItems.forEach(item => {
            const userName = item.querySelector('.text-base.font-medium')?.textContent?.toLowerCase() || '';
            const subject = item.querySelector('.text-sm.text-neutral-500')?.textContent?.toLowerCase() || '';
            
            // Get user email from data attribute or context menu call
            const contextMenuCall = item.getAttribute('oncontextmenu') || '';
            const emailMatch = contextMenuCall.match(/'([^']*@[^']*)'/) || [];
            const userEmail = emailMatch[1] ? emailMatch[1].toLowerCase() : '';
            
            // Check if query matches any field
            const matches = userName.includes(searchQuery) || 
                          subject.includes(searchQuery) || 
                          userEmail.includes(searchQuery);
            
            results.push({ element: item, matches });
            item.style.display = matches ? 'block' : 'none';
        });
        
        // Cache results for faster subsequent searches
        searchCache.set(searchQuery, results);
        
        // If no client-side matches and query length > 2, try server search
        const hasMatches = results.some(r => r.matches);
        if (!hasMatches && searchQuery.length > 2) {
            advancedSearch(searchQuery);
        }
    }
    
    function applySearchResults(results) {
        results.forEach(result => {
            result.element.style.display = result.matches ? 'block' : 'none';
        });
    }

    // Advanced search with backend support for message content
    function advancedSearch(query) {
        if (!query.trim()) return;
        
        fetch('/staff/chat/search-conversations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                query: query,
                search_in: ['name', 'email', 'subject', 'messages', 'service_type']
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                filterConversationsByIds(data.conversation_ids);
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            // Fallback to client-side search
            performSearch(query);
        });
    }

    function filterConversationsByIds(ids) {
        const conversationItems = document.querySelectorAll('#conversationsList > div');
        
        conversationItems.forEach(item => {
            const conversationId = item.getAttribute('data-conversation-id');
            const shouldShow = ids.includes(parseInt(conversationId));
            item.style.display = shouldShow ? 'block' : 'none';
        });
    }
    let isTyping = false;
    let replyToMessageId = null;
    let isScrolling = false;

    // Current message context menu data
    let currentMessageData = {
        id: null,
        senderType: '',
        message: '',
        isStarred: false
    };

    // Chat initialized with conversation ID: {conversationId}

    // Initialize send button state
    document.addEventListener('DOMContentLoaded', function() {
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        
        // Update send button state on input
        messageInput.addEventListener('input', function() {
            if (!isSendingMessage) {
                sendButton.disabled = this.value.trim().length === 0;
            }
        });
        
        // Add click event listener with debouncing to prevent double-clicks
        let lastClickTime = 0;
        sendButton.addEventListener('click', function(event) {
            const now = Date.now();
            
            // Prevent rapid clicks (debounce 500ms)
            if (now - lastClickTime < 500) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            }
            
            lastClickTime = now;
            
            // Prevent if already sending
            if (isSendingMessage) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            }
        });
    });

    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto';
        const maxHeight = 120; // max 5 lines
        const newHeight = Math.min(textarea.scrollHeight, maxHeight);
        textarea.style.height = newHeight + 'px';
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            event.stopPropagation();
            
            // Only send if not already sending and has content
            const textarea = document.getElementById('messageInput');
            if (!isSendingMessage && textarea.value.trim().length > 0) {
                sendMessage();
            }
        }
    }

    // Flag to prevent multiple simultaneous message sending
    let isSendingMessage = false;
    let lastMessageContent = '';
    let lastMessageTime = 0;
    let sentMessageIds = new Set(); // Track sent message IDs to prevent duplicates
    let processedMessages = new Set(); // Track processed messages from server

    function sendMessage() {
        // Prevent multiple simultaneous sends
        if (isSendingMessage) {
            return;
        }
        
        const textarea = document.getElementById('messageInput');
        const message = textarea.value.trim();
        
        if (!message) {
            return;
        }
        
        const currentTime = Date.now();
        
        // Only prevent if exact same message within 1 second (very strict timing)
        if (message === lastMessageContent && (currentTime - lastMessageTime) < 1000) {
            return;
        }
        
        if (message) {
            const sendButton = document.getElementById('sendButton');
            
            // Set flags and disable UI
            isSendingMessage = true;
            lastMessageContent = message;
            lastMessageTime = currentTime;
            sendButton.disabled = true;
            textarea.disabled = true;
            
            // Show loading state
            sendButton.classList.add('send-button-active');
            const sendIcon = sendButton.querySelector('.send-icon');
            const loadingSpinner = sendButton.querySelector('.loading-spinner');
            if (sendIcon) sendIcon.style.display = 'none';
            if (loadingSpinner) loadingSpinner.classList.remove('hidden');
            
            // Stop typing indicator
            stopTyping();
            
            const requestData = {
                conversation_id: conversationId,
                message: message
            };
            
            // Add reply_to_message_id if replying
            if (replyToMessageId) {
                requestData.reply_to_message_id = replyToMessageId;
            }
            
            
            fetch('/staff/chat/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(requestData)
            })
            .then(response => response.json())
            .then(data => {
                
                if (data.success) {
                    
                    // Check if we already processed this message
                    if (sentMessageIds.has(data.message.id)) {
                        return;
                    }
                    
                    // Mark message as sent
                    sentMessageIds.add(data.message.id);
                    
                    addMessage(
                        data.message.message, 
                        'staff', 
                        data.message.created_at, 
                        '{{ auth()->user()->name }}', 
                        data.message.reply_to_message_id, 
                        data.message.id,
                        data.message.reply_to_message || null
                    );
                    lastMessageId = data.message.id;
                    
                    textarea.value = '';
                    adjustTextareaHeight(textarea);
                    
                    // Clear reply if exists
                    cancelReply();
                } else {
                    console.error('Send message failed:', data);
                    alert('Gagal mengirim pesan');
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                alert('Terjadi kesalahan saat mengirim pesan: ' + error.message);
            })
            .finally(() => {
                // Reset flags and re-enable UI
                isSendingMessage = false;
                textarea.disabled = false;
                sendButton.disabled = textarea.value.trim().length === 0;
                sendButton.classList.remove('send-button-active');
                
                // Reset button icons
                const sendIcon = sendButton.querySelector('.send-icon');
                const loadingSpinner = sendButton.querySelector('.loading-spinner');
                if (sendIcon) sendIcon.style.display = 'block';
                if (loadingSpinner) loadingSpinner.classList.add('hidden');
                
                // Focus back to textarea for better UX
                textarea.focus();
            });
        }
    }

    function addMessage(text, senderType, timestamp, senderName, replyToMessageId = null, messageId = null, replyMessageData = null) {
        
        // Simple duplicate check by ID only (most reliable)
        if (messageId && processedMessages.has(messageId)) {
            return;
        }
        
        // Mark message as processed
        if (messageId) {
            processedMessages.add(messageId);
        }
        
        const chatMessages = document.getElementById('chatMessages');
        const time = new Date(timestamp).toLocaleTimeString('en-US', { 
            hour: 'numeric', 
            minute: '2-digit',
            hour12: true 
        });
        
        // Check if we can group with last message
        const lastMessageGroup = chatMessages.querySelector(`[data-message-group="${senderType}"]:last-child`);
        const canGroup = shouldGroupMessage(lastMessageGroup, senderType, timestamp);
        
        if (canGroup && lastMessageGroup) {
            // Add to existing group - update time on last message only
            addToMessageGroup(lastMessageGroup, text, messageId, replyToMessageId, time, senderType, replyMessageData);
            // Force re-render message grouping for all visible messages
            requestAnimationFrame(() => {
                reprocessMessageGrouping();
            });
        } else {
            // Create new message group with animation
            createNewMessageGroup(chatMessages, text, senderType, senderName, time, messageId, replyToMessageId, replyMessageData, true);
        }
        
        scrollToBottomAnimated();
    }
    
    // Function to reprocess message grouping in real-time
    function reprocessMessageGrouping() {
        const chatMessages = document.getElementById('chatMessages');
        const messageGroups = chatMessages.querySelectorAll('[data-message-group]');
        
        // First, remove any duplicate messages by content and time
        const seenMessages = new Set();
        const messagesToRemove = [];
        
        chatMessages.querySelectorAll('[data-message-id]').forEach(messageElement => {
            const messageId = messageElement.getAttribute('data-message-id');
            const messageText = messageElement.querySelector('.message-bubble p')?.textContent || '';
            const messageGroup = messageElement.closest('[data-message-group]');
            const senderType = messageGroup?.getAttribute('data-message-group') || '';
            
            // Create unique key for message
            const messageKey = `${senderType}_${messageText}`;
            
            if (seenMessages.has(messageKey) || seenMessages.has(messageId)) {
                messagesToRemove.push(messageElement);
            } else {
                seenMessages.add(messageKey);
                if (messageId) seenMessages.add(messageId);
            }
        });
        
        // Remove duplicate messages
        messagesToRemove.forEach(element => {
            const parentGroup = element.closest('[data-message-group]');
            element.remove();
            
            // If group is now empty, remove it
            if (parentGroup && parentGroup.querySelectorAll('[data-message-id]').length === 0) {
                parentGroup.remove();
            }
        });
        
        // Then process normal grouping
        messageGroups.forEach(group => {
            const senderType = group.getAttribute('data-message-group');
            const messages = group.querySelectorAll('[data-message-id]');
            
            // Hide all timestamps except the last one in the group
            messages.forEach((message, index) => {
                const timeContainer = group.querySelector('.text-xs.text-neutral-400')?.parentElement;
                if (timeContainer) {
                    const isLastMessage = index === messages.length - 1;
                    // Only show timestamp on the last message in the group
                    timeContainer.style.display = isLastMessage ? 'flex' : 'none';
                }
            });
            
            // Ensure the timestamp container is visible for the group
            const timeContainer = group.querySelector('.text-xs.text-neutral-400')?.parentElement;
            if (timeContainer && messages.length > 0) {
                timeContainer.style.display = 'flex';
            }
        });
    }

    function shouldGroupMessage(lastMessageGroup, senderType, timestamp) {
        if (!lastMessageGroup) return false;
        
        // Check if sender type matches
        const lastGroupSenderType = lastMessageGroup.getAttribute('data-message-group');
        if (lastGroupSenderType !== senderType) return false;
        
        const lastTimeElement = lastMessageGroup.querySelector('.text-xs.text-neutral-400:last-child');
        if (!lastTimeElement) return false;
        
        const lastTimeText = lastTimeElement.textContent.trim();
        const currentTime = new Date(timestamp);
        
        // Parse last message time (assuming it's in "h:mm AM/PM" format)
        const lastTime = parseTimeString(lastTimeText);
        if (!lastTime) return false;
        
        // Check if within 5 minutes for better grouping (like WhatsApp)
        const timeDiff = Math.abs(currentTime.getTime() - lastTime.getTime()) / 1000;
        return timeDiff <= 300; // 5 minutes = 300 seconds
    }

    function parseTimeString(timeStr) {
        const now = new Date();
        const [time, period] = timeStr.split(' ');
        if (!time || !period) return null;
        
        const [hours, minutes] = time.split(':').map(Number);
        if (isNaN(hours) || isNaN(minutes)) return null;
        
        let hour24 = hours;
        if (period === 'PM' && hours !== 12) hour24 += 12;
        if (period === 'AM' && hours === 12) hour24 = 0;
        
        const parsedTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hour24, minutes);
        
        // If time is in the future, assume it's from yesterday
        if (parsedTime > now) {
            parsedTime.setDate(parsedTime.getDate() - 1);
        }
        
        return parsedTime;
    }

    function addToMessageGroup(messageGroup, text, messageId, replyToMessageId, time, senderType, replyMessageData = null) {
        const messagesContainer = messageGroup.querySelector('.max-w-xs, .max-w-lg');
        const timeElement = messageGroup.querySelector('.text-xs.text-neutral-400:last-child');
        
        // Create new message bubble
        const newMessageDiv = document.createElement('div');
        newMessageDiv.className = 'mb-1 message-enter';
        newMessageDiv.setAttribute('data-message-id', messageId || Date.now());
        
        let replyHtml = '';
        if (replyToMessageId) {
            let replyText = '';
            let replySender = '';
            
            if (replyMessageData) {
                // Use reply data from server
                replyText = replyMessageData.message;
                replySender = replyMessageData.sender_type === 'user' ? '{{ $conversation->user->name }}' : replyMessageData.sender_name;
            } else {
                // Fallback to finding reply message in DOM
                const replyMessage = document.querySelector(`[data-message-id="${replyToMessageId}"]`);
                if (replyMessage) {
                    replyText = replyMessage.querySelector('.bg-[#128AEB] p, .bg-white p').textContent;
                    replySender = replyMessage.closest('[data-message-group]').querySelector('.text-xs.text-neutral-500').textContent;
                }
            }
            
            if (replyText) {
                replyHtml = `
                    <div class="bg-neutral-200 p-2 rounded-lg mb-2 border-l-2 border-${senderType === 'staff' ? 'blue' : 'neutral'}-500">
                        <p class="text-xs text-neutral-600">${replySender}</p>
                        <p class="text-sm text-neutral-700 truncate">${replyText.substring(0, 50)}...</p>
                    </div>
                `;
            }
        }
        
        // Adjust border radius for grouped messages (like WhatsApp)
        const isFirstInGroup = messagesContainer.children.length === 0;
        const bgColor = senderType === 'staff' ? 'bg-[#128AEB] border-t border-sky-300 text-white' : 'bg-white border border-neutral-200';
        const textColor = senderType === 'staff' ? 'text-white' : 'text-neutral-800';
        
        // Different border radius for grouped messages
        let borderRadius = 'rounded-lg';
        if (senderType === 'staff') {
            borderRadius = isFirstInGroup ? 'rounded-2xl rounded-br-md' : 'rounded-lg rounded-br-md';
        } else {
            borderRadius = isFirstInGroup ? 'rounded-2xl rounded-bl-md' : 'rounded-lg rounded-bl-md';
        }
        
        newMessageDiv.innerHTML = `
            ${replyHtml}
            <div class="${bgColor} px-4 py-3 ${borderRadius} relative group message-bubble"
                 oncontextmenu="showMessageContextMenu(event, ${messageId || Date.now()}, '${senderType}', '${text.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}', false)"
                 data-message="${text.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}">
                <p class="text-sm ${textColor}">${text}</p>
            </div>
        `;
        
        // Insert before time element
        messagesContainer.insertBefore(newMessageDiv, timeElement.parentElement);
        
        // Trigger animation
        requestAnimationFrame(() => {
            newMessageDiv.classList.add('message-enter-active');
        });
        
        // Update time to show latest message time (only at the bottom of group)
        timeElement.textContent = time;
    }

    function createNewMessageGroup(container, text, senderType, senderName, time, messageId, replyToMessageId, replyMessageData = null, withAnimation = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex ${senderType === 'staff' ? 'justify-end' : 'justify-start'} mb-4`;
        messageDiv.setAttribute('data-message-group', senderType);
        
        // Add animation classes if specified
        if (withAnimation) {
            messageDiv.classList.add('message-group-enter');
        }
        
        let replyHtml = '';
        if (replyToMessageId) {
            let replyText = '';
            let replySender = '';
            
            if (replyMessageData) {
                // Use reply data from server
                replyText = replyMessageData.message;
                replySender = replyMessageData.sender_type === 'user' ? '{{ $conversation->user->name }}' : replyMessageData.sender_name;
            } else {
                // Fallback to finding reply message in DOM
                const replyMessage = document.querySelector(`[data-message-id="${replyToMessageId}"]`);
                if (replyMessage) {
                    replyText = replyMessage.querySelector('.bg-[#128AEB] p, .bg-white p').textContent;
                    replySender = replyMessage.closest('[data-message-group]').querySelector('.text-xs.text-neutral-500').textContent;
                }
            }
            
            if (replyText) {
                replyHtml = `
                    <div class="bg-neutral-200 p-2 rounded-lg mb-2 border-l-2 border-${senderType === 'staff' ? 'blue' : 'neutral'}-500">
                        <p class="text-xs text-neutral-600">${replySender}</p>
                        <p class="text-sm text-neutral-700 truncate">${replyText.substring(0, 50)}...</p>
                    </div>
                `;
            }
        }
        
        if (senderType === 'staff') {
            messageDiv.innerHTML = `
                <div class="max-w-xs lg:max-w-md min-w-[100px]">
                    <div class="mb-1" data-message-id="${messageId || Date.now()}">
                        ${replyHtml}
                        <div class="bg-[#128AEB] border-t border-sky-300 text-white px-4 py-3 rounded-2xl rounded-br-md relative group message-bubble"
                             oncontextmenu="showMessageContextMenu(event, ${messageId || Date.now()}, 'staff', '${text.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}', false)"
                             data-message="${text.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}">
                            <p class="text-sm">${text}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-1 mr-2">
                        <span class="text-xs text-neutral-500 hidden">${senderName}</span>
                        <span class="text-xs text-neutral-400 ml-2">${time}</span>
                    </div>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="max-w-xs lg:max-w-md">
                    <div class="mb-1" data-message-id="${messageId || Date.now()}">
                        ${replyHtml}
                        <div class="bg-white border border-neutral-200 px-4 py-3 rounded-2xl rounded-bl-md relative group message-bubble"
                             oncontextmenu="showMessageContextMenu(event, ${messageId || Date.now()}, 'user', '${text.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}', false)"
                             data-message="${text.replace(/"/g, '&quot;').replace(/'/g, '&#39;')}">
                            <p class="text-sm text-neutral-800">${text}</p>
                        </div>
                    </div>
                    <div class="flex items-center mt-1 ml-2">
                        <span class="text-xs text-neutral-500 hidden">${senderName}</span>
                        <span class="text-xs text-neutral-400">${time}</span>
                    </div>
                </div>
            `;
        }
        
        container.appendChild(messageDiv);
        
        // Trigger animation if specified
        if (withAnimation) {
            requestAnimationFrame(() => {
                messageDiv.classList.add('message-group-enter-active');
            });
        }
    }

    // Poll for new messages
    function pollForNewMessages() {
        if (isPolling) return;
        isPolling = true;

        fetch('/staff/chat/get-new-messages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                conversation_id: conversationId,
                last_message_id: lastMessageId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.messages.length > 0) {
                data.messages.forEach(message => {
                    // Skip if we already processed this message from manual send
                    if (sentMessageIds.has(message.id) || processedMessages.has(message.id)) {
                        return;
                    }
                    
                    const senderName = message.sender_type === 'user' ? '{{ $conversation->user->name }}' : message.sender_name;
                    addMessage(
                        message.message, 
                        message.sender_type, 
                        message.created_at, 
                        senderName, 
                        message.reply_to_message_id, 
                        message.id,
                        message.reply_to_message || null
                    );
                    lastMessageId = message.id;
                });
                
                // Reprocess message grouping for all new messages
                requestAnimationFrame(() => {
                    reprocessMessageGrouping();
                    pollConversationsList();
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

    // Poll for conversation list updates (realtime)
    function pollConversationsList() {
        if (isPollingConversations) return;
        isPollingConversations = true;

        fetch('/staff/chat/get-conversations-update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                last_update: lastConversationUpdate
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.conversations && data.conversations.length > 0) {
                // Clear search cache when conversations update to ensure fresh results
                searchCache.clear();
                updateConversationsListRealtime(data.conversations);
                lastConversationUpdate = data.timestamp;
            } else {
                // No updates - reduce polling frequency temporarily
                setTimeout(() => {
                    if (documentVisible) pollConversationsList();
                }, 2000); // Wait 2 seconds before next poll if no updates
                return;
            }
        })
        .catch(error => {
            console.error('Error polling conversations:', error);
        })
        .finally(() => {
            isPollingConversations = false;
        });
    }

    // Update conversations list in realtime
    function updateConversationsListRealtime(conversations) {
        const conversationsList = document.getElementById('conversationsList');
        
        conversations.forEach(conv => {
            const existingItem = document.querySelector(`[data-conversation-id="${conv.id}"]`);
            
            if (existingItem) {
                // Update existing conversation
                updateExistingConversationItem(existingItem, conv);
                
                // Update header profile picture if this is the current conversation
                if (conv.user_id == {{ $conversation->user_id }}) {
                    updateHeaderProfilePicture(conv);
                }
            } else {
                // Add new conversation
                addNewConversationItem(conversationsList, conv);
            }
        });
        
        // Re-sort conversations by last message time
        sortConversationsList();
    }
    
    // Update header profile picture in real-time
    function updateHeaderProfilePicture(conv) {
        const headerContainer = document.querySelector('.bg-white.px-6.h-\\[70px\\] .flex.items-center');
        if (!headerContainer) return;
        
        const currentProfileElement = headerContainer.querySelector('img');
        if (!currentProfileElement) return;
        
        // Generate profile picture cache key for header
        const headerCacheKey = `header_${conv.user_id}_${conv.profile_picture || 'default'}`;
        
        // Only update if not already cached
        if (!profilePictureCache.has(headerCacheKey) || profilePictureCache.get(headerCacheKey) !== currentProfileElement.src) {
            const expectedSrc = getProfilePictureUrl(conv.user_id, conv.user_name, conv.profile_picture);
            
            // Update only if different to prevent refresh loops
            if (currentProfileElement.src !== expectedSrc) {
                currentProfileElement.src = expectedSrc;
                currentProfileElement.alt = conv.user_name;
                currentProfileElement.classList.add('loaded');
                
                // Cache the new src
                profilePictureCache.set(headerCacheKey, expectedSrc);
            }
        }
    }

    // Update existing conversation item
    function updateExistingConversationItem(item, conv) {
        // Generate profile picture cache key
        const cacheKey = `${conv.user_id}_${conv.profile_picture || 'default'}`;
        
        // Update profile picture if it has changed
        const currentProfileContainer = item.querySelector('.flex.items-center.space-x-3 > :first-child');
        
        // Only update if profile picture cache indicates a change
        if (!profilePictureCache.has(cacheKey) || profilePictureCache.get(cacheKey) !== currentProfileContainer?.src) {
            const expectedSrc = getProfilePictureUrl(conv.user_id, conv.user_name, conv.profile_picture);
            
            // Check if profile picture needs updating by comparing current src with expected
            if (currentProfileContainer && currentProfileContainer.src !== expectedSrc) {
                currentProfileContainer.src = expectedSrc;
                currentProfileContainer.alt = conv.user_name;
                currentProfileContainer.classList.add('loaded');
                
                // Cache the new src to prevent unnecessary updates
                profilePictureCache.set(cacheKey, expectedSrc);
            }
        }
        
        // Update unread count
        const unreadBadge = item.querySelector('.bg-\\[\\#128AEB\\]');
        const unreadContainer = item.querySelector('.flex-col.flex.items-end');
        
        if (conv.unread_count > 0) {
            if (unreadBadge) {
                unreadBadge.textContent = conv.unread_count;
            } else {
                // Create new unread badge
                const newBadge = document.createElement('div');
                newBadge.className = 'flex justify-center py-[1px] px-[4px] items-center min-w-[20px] rounded-full text-center text-[12px] font-medium bg-[#128AEB] text-white';
                newBadge.textContent = conv.unread_count;
                unreadContainer.appendChild(newBadge);
            }
        } else {
            if (unreadBadge) {
                unreadBadge.remove();
            }
        }
        
        // Update last message time
        const timeElement = item.querySelector('.text-xs.text-neutral-400.mb-1\\.5');
        if (timeElement && conv.last_message_time) {
            timeElement.textContent = conv.last_message_time;
        }
        
        // Update subject/last message
        const subjectElement = item.querySelector('.text-sm.text-neutral-500.truncate');
        if (subjectElement && conv.last_message) {
            subjectElement.textContent = conv.last_message.substring(0, 50) + (conv.last_message.length > 50 ? '...' : '');
        }
        
        // Update pin status
        const pinIcon = item.querySelector('svg.text-yellow-500');
        const nameContainer = item.querySelector('.flex.items-center');
        
        if (conv.is_pinned_by_staff && !pinIcon) {
            // Add pin icon
            const pinSvg = document.createElement('svg');
            pinSvg.className = 'w-4 h-4 text-yellow-500 mr-2';
            pinSvg.setAttribute('fill', 'currentColor');
            pinSvg.setAttribute('viewBox', '0 0 20 20');
            pinSvg.innerHTML = '<path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />';
            nameContainer.insertBefore(pinSvg, nameContainer.firstChild);
        } else if (!conv.is_pinned_by_staff && pinIcon) {
            // Remove pin icon
            pinIcon.remove();
        }
        
        // Update data attributes
        item.setAttribute('data-conversation-id', conv.id);
        item.setAttribute('data-user-id', conv.user_id);
        item.setAttribute('oncontextmenu', `showContextMenu(event, ${conv.id}, ${conv.user_id}, '${conv.user_name}', ${conv.is_pinned_by_staff ? 'true' : 'false'})`);
    }

    // Add new conversation item
    function addNewConversationItem(container, conv) {
        const newItem = document.createElement('div');
        newItem.className = `px-4 py-3 hover:bg-neutral-100 cursor-pointer rounded-lg relative`;
        newItem.setAttribute('onclick', `navigateToConversation(${conv.user_id})`);
        newItem.setAttribute('oncontextmenu', `showContextMenu(event, ${conv.id}, ${conv.user_id}, '${conv.user_name}', ${conv.is_pinned_by_staff ? 'true' : 'false'})`);
        newItem.setAttribute('data-conversation-id', conv.id);
        newItem.setAttribute('data-user-id', conv.user_id);
        
        // Generate profile picture HTML using fast helper
        const profilePictureUrl = getProfilePictureUrl(conv.user_id, conv.user_name, conv.profile_picture);
        const profilePictureHtml = `<img src="${profilePictureUrl}" alt="${conv.user_name}" class="w-12 h-12 rounded-full object-cover border border-neutral-200 flex-shrink-0 profile-picture loaded" loading="eager">`;
        
        newItem.innerHTML = `
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 flex-1 min-w-0">
                    ${profilePictureHtml}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center">
                            ${conv.is_pinned_by_staff ? `
                                <svg class="w-4 h-4 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                                </svg>
                            ` : ''}
                            <p class="text-base font-medium text-neutral-900 truncate">${conv.user_name}</p>
                            ${conv.status === 'waiting' ? `
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 ml-2">Menunggu</span>
                            ` : conv.status === 'active' ? `
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 ml-2">Aktif</span>
                            ` : ''}
                        </div>
                        <p class="text-sm text-neutral-500 truncate">${conv.subject || ''}</p>
                    </div>
                </div>
                <div class="flex-col flex items-end">
                    <div class="text-xs text-neutral-400 mb-1.5">
                        ${conv.last_message_time || ''}
                    </div>
                    ${conv.unread_count > 0 ? `
                        <div class="flex justify-center py-[1px] px-[4px] items-center min-w-[20px] rounded-full text-center text-[12px] font-medium bg-[#128AEB] text-white">${conv.unread_count}</div>
                    ` : ''}
                </div>
            </div>
        `;
        
        container.appendChild(newItem);
    }

    // Sort conversations list by last message time and pin status
    function sortConversationsList() {
        const container = document.getElementById('conversationsList');
        const items = Array.from(container.children);
        
        items.sort((a, b) => {
            // Pinned conversations first
            const aPinned = a.querySelector('svg.text-yellow-500') !== null;
            const bPinned = b.querySelector('svg.text-yellow-500') !== null;
            
            if (aPinned && !bPinned) return -1;
            if (!aPinned && bPinned) return 1;
            
            // Then by last message time (newest first)
            const aTime = a.querySelector('.text-xs.text-neutral-400.mb-1\\.5')?.textContent || '';
            const bTime = b.querySelector('.text-xs.text-neutral-400.mb-1\\.5')?.textContent || '';
            
            // Convert time to comparable format
            const aTimeValue = convertTimeToMinutes(aTime);
            const bTimeValue = convertTimeToMinutes(bTime);
            
            return bTimeValue - aTimeValue;
        });
        
        // Re-append in sorted order
        items.forEach(item => container.appendChild(item));
    }

    // Helper function to convert time string to minutes for comparison
    function convertTimeToMinutes(timeStr) {
        if (!timeStr) return 0;
        
        const now = new Date();
        const [time, period] = timeStr.split(' ');
        const [hours, minutes] = time.split(':').map(Number);
        
        let hour24 = hours;
        if (period === 'PM' && hours !== 12) hour24 += 12;
        if (period === 'AM' && hours === 12) hour24 = 0;
        
        const timeToday = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hour24, minutes);
        
        // If time is in the future, assume it's from yesterday
        if (timeToday > now) {
            timeToday.setDate(timeToday.getDate() - 1);
        }
        
        return timeToday.getTime();
    }

    function closeConversation() {
        if (confirm('Apakah Anda yakin ingin menutup percakapan ini?')) {
            fetch('/staff/chat/close-conversation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    conversation_id: conversationId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }

    // Message Context Menu Functions
    function showMessageContextMenu(event, messageId, senderType, message, isStarred) {
        event.preventDefault();
        event.stopPropagation();
        
        
        const messageContextMenu = document.getElementById('messageContextMenu');
        const starText = document.getElementById('starText');
        const starIcon = document.getElementById('starIcon');
        const deleteBtn = document.getElementById('deleteMessageBtn');
        
        // Get message text from data attribute or parameter
        const messageText = typeof message === 'string' ? message : event.target.closest('[data-message]')?.getAttribute('data-message') || '';
        
        // Store current message data
        currentMessageData = {
            id: messageId,
            senderType: senderType,
            message: messageText,
            isStarred: isStarred
        };
        
        
        // Update star button
        if (isStarred) {
            starText.textContent = 'Hapus Bintang';
            starIcon.className = 'w-4 h-4 mr-2 text-yellow-500';
        } else {
            starText.textContent = 'Beri Bintang';
            starIcon.className = 'w-4 h-4 mr-2';
        }
        
        // Show/hide delete button based on sender (only staff can delete their own messages)
        if (senderType === 'staff') {
            deleteBtn.style.display = 'inline-flex';
        } else {
            deleteBtn.style.display = 'none';
        }
        
        // Reset transform classes for calculation
        messageContextMenu.classList.remove('hidden');
        messageContextMenu.style.transform = 'scale(0)';
        messageContextMenu.style.opacity = '0';
        
        // Get viewport dimensions
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        const menuRect = messageContextMenu.getBoundingClientRect();
        const menuWidth = menuRect.width || 192; // fallback width
        const menuHeight = menuRect.height || 150; // fallback height
        
        // Calculate position to prevent overflow
        let x = event.pageX;
        let y = event.pageY;
        
        // Adjust horizontal position if menu would overflow right edge
        if (x + menuWidth > viewportWidth - 10) {
            x = viewportWidth - menuWidth - 10;
            messageContextMenu.style.transformOrigin = 'top-right';
        } else {
            messageContextMenu.style.transformOrigin = 'top-left';
        }
        
        // Adjust vertical position if menu would overflow bottom edge
        if (y + menuHeight > viewportHeight - 10) {
            y = y - menuHeight;
            // Update transform origin for upward opening
            if (x + menuWidth > viewportWidth - 10) {
                messageContextMenu.style.transformOrigin = 'bottom-right';
            } else {
                messageContextMenu.style.transformOrigin = 'bottom-left';
            }
        }
        
        // Ensure minimum distance from edges
        x = Math.max(10, x);
        y = Math.max(10, y);
        
        // Position context menu
        messageContextMenu.style.left = x + 'px';
        messageContextMenu.style.top = y + 'px';
        
        // Animate in with WhatsApp-like effect
        requestAnimationFrame(() => {
            messageContextMenu.style.transform = 'scale(1)';
            messageContextMenu.style.opacity = '1';
        });
        
        // Add click outside listener
        setTimeout(() => {
            document.addEventListener('click', hideMessageContextMenu);
        }, 10);
    }

    function hideMessageContextMenu() {
        const messageContextMenu = document.getElementById('messageContextMenu');
        
        // Animate out
        messageContextMenu.style.transform = 'scale(0)';
        messageContextMenu.style.opacity = '0';
        
        // Hide after animation
        setTimeout(() => {
            messageContextMenu.classList.add('hidden');
        }, 150);
        
        document.removeEventListener('click', hideMessageContextMenu);
    }

    function replyToMessage() {
        hideMessageContextMenu();
        
        const replyPreview = document.getElementById('replyPreview');
        const replyToUser = document.getElementById('replyToUser');
        const replyToMessage = document.getElementById('replyToMessage');
        const messageInput = document.getElementById('messageInput');
        
        // Set reply data
        replyToMessageId = currentMessageData.id;
        replyToUser.textContent = currentMessageData.senderType === 'staff' ? 'Staff' : '{{ $conversation->user->name }}';
        replyToMessage.textContent = currentMessageData.message.substring(0, 100) + (currentMessageData.message.length > 100 ? '...' : '');
        
        // Show reply preview
        replyPreview.classList.remove('hidden');
        
        // Focus message input
        messageInput.focus();
    }

    function cancelReply() {
        const replyPreview = document.getElementById('replyPreview');
        replyPreview.classList.add('hidden');
        replyToMessageId = null;
    }

    function copyMessage() {
        hideMessageContextMenu();
        
        navigator.clipboard.writeText(currentMessageData.message).then(() => {
            setTimeout(() => {
            }, 100);
        }).catch(err => {
            console.error('Error copying text: ', err);
            alert('Gagal menyalin pesan');
        });
    }

    function toggleStarMessage() {
        hideMessageContextMenu();
        
        fetch('/staff/chat/toggle-star-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                message_id: currentMessageData.id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update star indicator on message
                const messageElement = document.querySelector(`[data-message-id="${currentMessageData.id}"] .relative`);
                let starElement = messageElement.querySelector('.text-yellow-300, .text-yellow-500');
                
                if (data.is_starred) {
                    if (!starElement) {
                        const star = document.createElement('svg');
                        star.className = currentMessageData.senderType === 'staff' ? 'w-3 h-3 text-yellow-300 absolute top-1 right-1' : 'w-3 h-3 text-yellow-500 absolute top-1 right-1';
                        star.setAttribute('fill', 'currentColor');
                        star.setAttribute('viewBox', '0 0 20 20');
                        star.innerHTML = '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />';
                        messageElement.appendChild(star);
                    }
                } else {
                    if (starElement) {
                        starElement.remove();
                    }
                }
                
                currentMessageData.isStarred = data.is_starred;
            } else {
                alert('Gagal mengubah status bintang');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }

    function deleteMessageConfirm() {
        hideMessageContextMenu();
        
        if (confirm('Apakah Anda yakin ingin menghapus pesan ini? Pesan akan dihapus permanen.')) {
            fetch('/staff/chat/delete-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message_id: currentMessageData.id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove message from DOM immediately
                    const messageElement = document.querySelector(`[data-message-id="${currentMessageData.id}"]`);
                    if (messageElement) {
                        // Remove the entire message group if it's the only message
                        const messageGroup = messageElement.closest('[data-message-group]');
                        const messagesInGroup = messageGroup.querySelectorAll('[data-message-id]');
                        
                        if (messagesInGroup.length === 1) {
                            // Remove entire group if this is the only message
                            messageGroup.remove();
                        } else {
                            // Just remove this message
                            messageElement.remove();
                            
                            // Reprocess message grouping after removal
                            requestAnimationFrame(() => {
                                reprocessMessageGrouping();
                            });
                        }
                    }
                    
                } else {
                    alert('Gagal menghapus pesan: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus pesan');
            });
        }
    }

    // Typing Indicator Functions
    function handleTyping() {
        if (!isTyping) {
            isTyping = true;
            updateTypingStatus(true);
        }
        
        clearTimeout(typingTimeout);
        
        typingTimeout = setTimeout(() => {
            stopTyping();
        }, 3000);
    }

    function stopTyping() {
        if (isTyping) {
            isTyping = false;
            updateTypingStatus(false);
        }
        clearTimeout(typingTimeout);
    }

    function updateTypingStatus(typing) {
        fetch('/staff/chat/typing-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                conversation_id: conversationId,
                is_typing: typing
            })
        })
        .catch(error => {
            console.error('Error updating typing status:', error);
        });
    }

    function checkTypingUsers() {
        fetch(`/staff/chat/typing-users?conversation_id=${conversationId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const typingIndicator = document.getElementById('typingIndicator');
                const typingUserName = document.getElementById('typingUserName');
                
                if (data.typing_users.length > 0) {
                    const userNames = data.typing_users.map(user => user.user_name);
                    typingUserName.textContent = userNames.join(', ') + ' sedang mengetik...';
                    typingIndicator.classList.remove('hidden');
                } else {
                    typingIndicator.classList.add('hidden');
                }
            }
        })
        .catch(error => {
            console.error('Error checking typing users:', error);
        });
    }

    // Instant navigation - no loading indicators
    function navigateToConversation(userId) {
        if (userId === currentUserId) return; // Already on this conversation
        
        // Instant navigation - no loading state
        window.location.href = `/staff/chat/conversation/${userId}`;
    }

    // Update unread count when new messages arrive
    function updateConversationListItem(userId, unreadCount) {
        const items = document.querySelectorAll('#conversationsList > div');
        items.forEach(item => {
            if (item.onclick && item.onclick.toString().includes(userId)) {
                const unreadBadge = item.querySelector('.bg-red-100');
                if (unreadCount > 0) {
                    if (unreadBadge) {
                        unreadBadge.textContent = unreadCount;
                    } else {
                        // Add unread badge if doesn't exist
                        const badgeContainer = item.querySelector('.flex.items-center');
                        const newBadge = document.createElement('span');
                        newBadge.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 ml-2';
                        newBadge.textContent = unreadCount;
                        badgeContainer.appendChild(newBadge);
                    }
                } else {
                    if (unreadBadge) {
                        unreadBadge.remove();
                    }
                }
            }
        });
    }

    // Enable/disable send button
    function initSendButton() {
        document.getElementById('messageInput').addEventListener('input', function() {
            const sendButton = document.getElementById('sendButton');
            sendButton.disabled = this.value.trim() === '';
        }, { passive: true });
    }

    // Navigation function for conversation list
    function navigateToConversation(userId) {
        window.location.href = `/staff/chat/conversation/${userId}`;
    }

    // Context Menu Variables
    let currentConversationData = {
        id: null,
        userId: null,
        userName: '',
        isPinned: false
    };

    // Context Menu Functions
    function showContextMenu(event, conversationId, userId, userName, isPinned) {
        event.preventDefault();
        event.stopPropagation();
        
        const contextMenu = document.getElementById('contextMenu');
        const pinText = document.getElementById('pinText');
        const pinIcon = document.getElementById('pinIcon');
        
        // Store current conversation data
        currentConversationData = {
            id: conversationId,
            userId: userId,
            userName: userName,
            isPinned: isPinned
        };
        
        // Update pin button text and icon
        if (isPinned) {
            pinText.textContent = 'Unpin Chat';
            pinIcon.className = 'w-[20px] text-yellow-500';
        } else {
            pinText.textContent = 'Pin Chat';
            pinIcon.className = 'w-[20px]';
        }
        
        // Reset transform classes for calculation
        contextMenu.classList.remove('hidden');
        contextMenu.style.transform = 'scale(0)';
        contextMenu.style.opacity = '0';
        
        // Get viewport dimensions
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        const menuRect = contextMenu.getBoundingClientRect();
        const menuWidth = menuRect.width || 192; // fallback width
        const menuHeight = menuRect.height || 100; // fallback height
        
        // Calculate position to prevent overflow
        let x = event.pageX;
        let y = event.pageY;
        
        // Adjust horizontal position if menu would overflow right edge
        if (x + menuWidth > viewportWidth - 10) {
            x = viewportWidth - menuWidth - 10;
            contextMenu.style.transformOrigin = 'top-right';
        } else {
            contextMenu.style.transformOrigin = 'top-left';
        }
        
        // Adjust vertical position if menu would overflow bottom edge
        if (y + menuHeight > viewportHeight - 10) {
            y = y - menuHeight;
            // Update transform origin for upward opening
            if (x + menuWidth > viewportWidth - 10) {
                contextMenu.style.transformOrigin = 'bottom-right';
            } else {
                contextMenu.style.transformOrigin = 'bottom-left';
            }
        }
        
        // Ensure minimum distance from edges
        x = Math.max(10, x);
        y = Math.max(10, y);
        
        // Position context menu
        contextMenu.style.left = x + 'px';
        contextMenu.style.top = y + 'px';
        
        // Animate in with WhatsApp-like effect
        requestAnimationFrame(() => {
            contextMenu.style.transform = 'scale(1)';
            contextMenu.style.opacity = '1';
        });
        
        // Add click outside listener
        setTimeout(() => {
            document.addEventListener('click', hideContextMenu);
        }, 10);
    }

    function hideContextMenu() {
        const contextMenu = document.getElementById('contextMenu');
        
        // Animate out
        contextMenu.style.transform = 'scale(0)';
        contextMenu.style.opacity = '0';
        
        // Hide after animation
        setTimeout(() => {
            contextMenu.classList.add('hidden');
        }, 150);
        
        document.removeEventListener('click', hideContextMenu);
    }

    function togglePinConversation() {
        hideContextMenu();
        
        fetch('/staff/chat/toggle-pin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                conversation_id: currentConversationData.id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload page to reflect changes
                location.reload();
            } else {
                alert('Gagal mengubah status pin');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }

    function showDeleteModal() {
        hideContextMenu();
        
        const deleteModal = document.getElementById('deleteModal');
        const deleteUserName = document.getElementById('deleteUserName');
        
        deleteUserName.textContent = currentConversationData.userName;
        deleteModal.classList.remove('hidden');
    }

    function hideDeleteModal() {
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.classList.add('hidden');
        
        // Reset radio buttons
        document.querySelector('input[name="deleteType"][value="hide"]').checked = true;
    }

    function confirmDeleteConversation() {
        const deleteType = document.querySelector('input[name="deleteType"]:checked').value;
        
        fetch('/staff/chat/remove-conversation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                conversation_id: currentConversationData.id,
                delete_type: deleteType
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                hideDeleteModal();
                
                if (deleteType === 'delete') {
                    // If we deleted the current conversation, redirect to chat index
                    if (currentConversationData.userId == currentUserId) {
                        window.location.href = '/staff/chat';
                    } else {
                        location.reload();
                    }
                } else {
                    // Just hide from list
                    location.reload();
                }
            } else {
                alert('Gagal menghapus percakapan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }

    // Initialize with minimal JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize messages container reference
        messagesContainer = document.getElementById('messagesContainer');
        
        // Remove no-transitions class after initial load
        setTimeout(() => {
            document.getElementById('chatContainer').classList.remove('no-transitions');
        }, 100);
        
        // Initialize components
        initSendButton();
        
        // Load initial messages (latest 30)
        loadInitialMessages();
        
        // Setup scroll listener for lazy loading
        setupScrollListener();
        
        // Start adaptive realtime polling
        function startPolling() {
            setInterval(() => {
                if (!documentVisible) return; // Don't poll when tab is not visible
                
                const timeSinceActivity = Date.now() - lastUserActivity;
                
                // Adaptive polling intervals based on user activity
                if (timeSinceActivity < 30000) { // Active user (last 30 seconds)
                    pollForNewMessages();
                } else if (timeSinceActivity < 300000) { // Moderately active (last 5 minutes)
                    if (Math.random() > 0.5) pollForNewMessages(); // 50% chance
                }
                // For inactive users (>5 minutes), poll very rarely or not at all
            }, 500);

            setInterval(() => {
                if (!documentVisible) return;
                
                const timeSinceActivity = Date.now() - lastUserActivity;
                
                if (timeSinceActivity < 60000) { // Active user (last 1 minute)
                    pollConversationsList();
                } else if (timeSinceActivity < 300000) { // Moderately active (last 5 minutes)
                    if (Math.random() > 0.7) pollConversationsList(); // 30% chance
                }
            }, 1000);

            setInterval(() => {
                if (!documentVisible) return;
                checkTypingUsers();
            }, 1000);
        }
        
        startPolling();
        
        // Initial conversation list update
        setTimeout(() => {
            pollConversationsList();
        }, 100);
    });
</script>
@endpush
@endsection
