{{-- 
    Cached Fragment Directive
    Usage: @cacheFragment('unique-key', 900)
        ... expensive content ...
    @endCacheFragment
--}}

@php
    if (!isset($__cacheFragmentKey)) {
        throw new Exception('Cache fragment key not set');
    }
    
    $__cacheFragmentTTL = $__cacheFragmentTTL ?? 900;
    $__cacheFragmentTags = $__cacheFragmentTags ?? ['fragments'];
    
    if (Cache::tags($__cacheFragmentTags)->has($__cacheFragmentKey)) {
        echo Cache::tags($__cacheFragmentTags)->get($__cacheFragmentKey);
        $__cacheFragmentSkip = true;
    } else {
        ob_start();
        $__cacheFragmentSkip = false;
    }
@endphp

@if(!$__cacheFragmentSkip)
