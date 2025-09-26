@props([
    'message' => null,
    'user' => null,
    'isOwn' => false,
    'showAvatar' => true,
    'showTime' => true,
    'class' => ''
])

@php
    $user = $user ?? $message->user ?? null;
    $messageText = $message->message ?? $message->content ?? '';
    $messageTime = $message->created_at ?? now();
@endphp

<div {{ $attributes->merge(['class' => "flex gap-3 $class"]) }}>
    @if(!$isOwn && $showAvatar)
        <div class="flex-shrink-0">
            <x-chat-avatar 
                :user="$user" 
                size="sm"
                :showStatus="false"
            />
        </div>
    @endif
    
    <div class="flex-1 max-w-xs {{ $isOwn ? 'ml-auto' : '' }}">
        @if(!$isOwn && $user && $user->name)
            <div class="text-xs text-gray-500 mb-1">{{ $user->name }}</div>
        @endif
        
        <div class="inline-block px-4 py-2 rounded-2xl {{ $isOwn ? 'bg-[#128AEB] text-white ml-auto' : 'bg-gray-100 text-gray-900' }}">
            {{ $messageText }}
        </div>
        
        @if($showTime)
            <div class="text-xs text-gray-400 mt-1 {{ $isOwn ? 'text-right' : '' }}">
                {{ \Carbon\Carbon::parse($messageTime)->format('H:i') }}
            </div>
        @endif
    </div>
    
    @if($isOwn && $showAvatar)
        <div class="flex-shrink-0">
            <x-chat-avatar 
                :user="auth()->user()" 
                size="sm"
                :showStatus="false"
            />
        </div>
    @endif
</div>
