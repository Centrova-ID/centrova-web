@php
    if (!$__cacheFragmentSkip) {
        $content = ob_get_clean();
        Cache::tags($__cacheFragmentTags)->put($__cacheFragmentKey, $content, $__cacheFragmentTTL);
        echo $content;
    }
@endphp
@endif
