@props([
    'htmlCode' => '', 
    'html-code' => '', 
    'title' => 'Component'
])

@php
    // Handle both camelCase and kebab-case
    $code = $htmlCode ?: $attributes->get('html-code', '');
@endphp

<div class="bg-white shadow-sm rounded-lg border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
    </div>
    <div class="p-6">
        @if($code)
            <div class="bg-gray-100 rounded-lg p-4">
                <pre class="text-sm text-gray-800 overflow-x-auto"><code>{{ htmlspecialchars($code) }}</code></pre>
            </div>
        @else
            <p class="text-gray-500">No HTML code available</p>
        @endif
    </div>
</div>
