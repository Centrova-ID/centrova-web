@props([
    'user' => null,
    'userId' => null,
    'size' => 'md',
    'class' => '',
    'showStatus' => false,
    'status' => 'offline', // online, offline, away, busy
    'clickable' => false,
    'href' => null
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
        'md' => 'w-10 h-10',
        'lg' => 'w-12 h-12',
        'xl' => 'w-16 h-16'
    ];
    
    $statusSizes = [
        'xs' => 'w-1.5 h-1.5',
        'sm' => 'w-2 h-2',
        'md' => 'w-2.5 h-2.5',
        'lg' => 'w-3 h-3',
        'xl' => 'w-4 h-4'
    ];

    $avatarSize = $sizeClasses[$size] ?? $sizeClasses['md'];
    $statusSize = $statusSizes[$size] ?? $statusSizes['md'];
    
    // Status colors
    $statusColors = [
        'online' => 'bg-green-400',
        'offline' => 'bg-gray-400',
        'away' => 'bg-yellow-400',
        'busy' => 'bg-red-400'
    ];
    
    $statusColor = $statusColors[$status] ?? $statusColors['offline'];
    
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
        <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg">
            <rect width="40" height="40" fill="' . $bgColor . '"/>
            <text x="20" y="20" font-family="Arial, sans-serif" font-size="16" font-weight="400" text-anchor="middle" dominant-baseline="central" fill="white">' . $initials . '</text>
        </svg>
    ');
@endphp

<div {{ $attributes->merge(['class' => "relative inline-block $class"]) }}>
    @if($clickable && $href)
        <a href="{{ $href }}" class="block">
    @endif
    
    <div class="{{ $avatarSize }} aspect-square rounded-full overflow-hidden flex-shrink-0 {{ $clickable ? 'hover:opacity-80 transition-opacity cursor-pointer' : '' }}">
        @if($user->profile_picture)
            @if(str_starts_with($user->profile_picture, 'assets/illustrations/'))
                <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
            @else
                <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
            @endif
        @else
            <img src="{{ $svgAvatar }}" alt="Profile Avatar" class="w-full h-full object-cover">
        @endif
    </div>
    
    @if($showStatus)
        <span class="{{ $statusSize }} {{ $statusColor }} border-2 border-white rounded-full absolute bottom-0 right-0"></span>
    @endif
    
    @if($clickable && $href)
        </a>
    @endif
</div>
