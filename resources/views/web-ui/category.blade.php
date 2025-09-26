@extends('partials.layouts.main')

@section('title', $categoryTitle . ' - Web UI Blocks')
@section('description', 'Beautiful ' . strtolower($categoryTitle) . ' components built with Tailwind CSS. Copy and paste ready-to-use blocks.')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/components/prism-core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/autoloader/prism-autoloader.min.js"></script>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                        <a href="{{ route('webui.index') }}" class="hover:text-gray-700">Web UI</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-900">{{ $categoryTitle }}</span>
                    </nav>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $categoryTitle }}</h1>
                    <p class="mt-2 text-gray-600">Choose from {{ $components->count() }} beautiful {{ strtolower($categoryTitle) }} components</p>
                </div>
                <a href="{{ route('webui.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    ← Back to All Blocks
                </a>
            </div>
        </div>
    </div>

    <!-- Components Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($components->count() > 0)
        <div class="space-y-12">
            @foreach($components as $component)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <!-- Component Header -->
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $component->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $component->description }}</p>
                            @if($component->creator)
                            <p class="text-xs text-gray-400 mt-1">Created by {{ $component->creator->name }}</p>
                            @endif
                        </div>
                        
                        <!-- Toggle Switch -->
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500">Preview</span>
                            <button type="button" 
                                    class="toggle-switch relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                    data-block="{{ $component->id }}">
                                <span class="toggle-thumb pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
                            </button>
                            <span class="text-sm text-gray-500">Code</span>
                        </div>
                    </div>
                </div>

                <!-- Preview Section -->
                <div id="preview-{{ $component->id }}" class="preview-section p-6">
                    {!! $component->html_code !!}
                </div>

                <!-- Code Section (Hidden by default) -->
                <div id="code-{{ $component->id }}" class="code-section hidden">
                    <div class="bg-gray-900 p-4 overflow-x-auto">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-gray-300 text-sm font-medium">HTML</span>
                            <button class="copy-btn px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors duration-200"
                                    data-clipboard-target="#code-content-{{ $component->id }}">
                                Copy Code
                            </button>
                        </div>
                        <pre class="text-sm"><code id="code-content-{{ $component->id }}" class="language-html">{{ $component->formatted_html }}</code></pre>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="text-gray-400 text-6xl mb-4">{{ $category->icon ?? '📦' }}</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Components Available</h3>
            <p class="text-gray-500">Components for this category will appear here once they are created by staff.</p>
        </div>
        @endif
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize clipboard
    new ClipboardJS('.copy-btn').on('success', function(e) {
        e.trigger.textContent = 'Copied!';
        setTimeout(() => {
            e.trigger.textContent = 'Copy Code';
        }, 2000);
        e.clearSelection();
    });

    // Toggle switches
    document.querySelectorAll('.toggle-switch').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const blockId = this.dataset.block;
            const previewSection = document.getElementById(`preview-${blockId}`);
            const codeSection = document.getElementById(`code-${blockId}`);
            const thumb = this.querySelector('.toggle-thumb');

            if (previewSection.classList.contains('hidden')) {
                // Show preview, hide code
                previewSection.classList.remove('hidden');
                codeSection.classList.add('hidden');
                this.classList.remove('bg-blue-600');
                this.classList.add('bg-gray-200');
                thumb.classList.remove('translate-x-5');
                thumb.classList.add('translate-x-0');
            } else {
                // Show code, hide preview
                previewSection.classList.add('hidden');
                codeSection.classList.remove('hidden');
                this.classList.remove('bg-gray-200');
                this.classList.add('bg-blue-600');
                thumb.classList.remove('translate-x-0');
                thumb.classList.add('translate-x-5');
            }
        });
    });
});
</script>
@endsection
