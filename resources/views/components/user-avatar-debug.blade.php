@props([
    'user' => null,
    'userId' => null,
    'size' => 'md',
    'class' => '',
    'showName' => false,
    'showEmail' => false,
    'clickable' => false,
    'href' => null,
    'debug' => false
])

@php
    // Handle user data - either from user object or user ID
    if (!$user && $userId) {
        $user = \App\Models\User::find($userId);
    }
    
    if (!$user) {
        $user = (object) [
            'id' => $userId ?? 1,
            'name' => 'User',
            'email' => null,
            'profile_picture' => null
        ];
    }

    // Size configurations
    $sizeClasses = [
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8', 
        'md' => 'w-12 h-12',
        'lg' => 'w-16 h-16',
        'xl' => 'w-20 h-20',
        '2xl' => 'w-24 h-24',
        '3xl' => 'w-32 h-32'
    ];
    
    $textSizes = [
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg', 
        'xl' => 'text-xl',
        '2xl' => 'text-2xl',
        '3xl' => 'text-3xl'
    ];

    $avatarSize = $sizeClasses[$size] ?? $sizeClasses['md'];
    $textSize = $textSizes[$size] ?? $textSizes['md'];
    
    // Generate avatar if no profile picture
    $colors = [
        '#3B82F6', '#8B5CF6', '#EF4444', '#10B981', '#F59E0B',
        '#EC4899', '#6366F1', '#84CC16', '#F97316', '#06B6D4',
        '#8B5A2B', '#DC2626', '#7C3AED', '#059669', '#D97706',
        '#BE185D', '#4F46E5', '#65A30D', '#EA580C', '#0891B2'
    ];
    $colorIndex = ($user->id ?? 1) % count($colors);
    $bgColor = $colors[$colorIndex];
    
    // Get initials
    $name = $user->name ?? 'User';
    $initials = substr(collect(explode(' ', $name))->map(fn($word) => substr($word, 0, 1))->implode(''), 0, 2);
    
    // Generate SVG avatar
    $svgAvatar = "data:image/svg+xml;base64," . base64_encode('
        <svg width="128" height="128" xmlns="http://www.w3.org/2000/svg">
            <rect width="128" height="128" fill="' . $bgColor . '"/>
            <text x="64" y="64" font-family="Arial, sans-serif" font-size="48" font-weight="400" text-anchor="middle" dominant-baseline="central" fill="white">' . $initials . '</text>
        </svg>
    ');
@endphp

@if($debug)
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-3 py-2 rounded mb-2 text-xs">
        <strong>Debug Info:</strong><br>
        User ID: {{ $user->id ?? 'N/A' }}<br>
        Name: {{ $user->name ?? 'N/A' }}<br>
        Profile Picture: {{ $user->profile_picture ?? 'NULL' }}<br>
        @if($user->profile_picture)
            Storage URL: {{ Storage::url($user->profile_picture) }}<br>
            File exists: {{ Storage::exists($user->profile_picture) ? 'Yes' : 'No' }}
        @endif
    </div>
@endif

<div {{ $attributes->merge(['class' => "flex items-center gap-3 $class"]) }}>
    @if($clickable && $href)
        <a href="{{ $href }}" class="block">
    @endif
    
    <div class="{{ $avatarSize }} aspect-square rounded-full bg-white/10 overflow-hidden flex-shrink-0 {{ $clickable ? 'hover:opacity-80 transition-opacity cursor-pointer' : '' }}">
        @if($user->profile_picture)
            @if(str_starts_with($user->profile_picture, 'assets/illustrations/'))
                <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover" loading="lazy">
            @elseif(str_starts_with($user->profile_picture, 'http'))
                {{-- Full URL (external images) --}}
                <img src="{{ $user->profile_picture }}" alt="Profile Picture" class="w-full h-full object-cover" loading="lazy">
            @else
                {{-- Storage path --}}
                <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover" loading="lazy" 
            @endif
        @else
            <img src="{{ $svgAvatar }}" alt="Profile Avatar" class="w-full h-full object-cover">
        @endif
    </div>
    
    @if($clickable && $href)
        </a>
    @endif
    
    @if($showName || $showEmail)
        <div class="flex-1 min-w-0">
            @if($showName)
                <h3 class="{{ $textSize }} font-semibold text-slate-900 truncate">{{ $user->name }}</h3>
            @endif
            @if($showEmail && $user->email)
                <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
            @endif
        </div>
    @endif
</div>
