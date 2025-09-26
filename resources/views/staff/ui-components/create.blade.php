@extends('staff.partials.layouts.main')

@section('title', 'Create UI Component')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.65.0/lib/codemirror.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/codemirror@5.65.0/theme/material.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.0/lib/codemirror.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.0/mode/xml/xml.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.0/mode/javascript/javascript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.0/mode/css/css.js"></script>
<script src="https://cdn.jsdelivr.net/npm/codemirror@5.65.0/mode/htmlmixed/htmlmixed.js"></script>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                        <a href="{{ route('staff.dashboard') }}" class="hover:text-gray-700">Dashboard</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('staff.ui-components.index') }}" class="hover:text-gray-700">UI Components</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-900">Create</span>
                    </nav>
                    <h1 class="text-2xl font-bold text-gray-900">Create New UI Component</h1>
                    <p class="mt-1 text-gray-600">Add a new UI component to the website</p>
                </div>
                <a href="{{ route('staff.ui-components.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    ← Back to Components
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form method="POST" action="{{ route('staff.ui-components.store') }}" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column - Component Info -->
                <div class="space-y-8">
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Component Information</h3>
                        </div>
                        
                        <div class="px-6 py-6 space-y-6">
                            <!-- Category -->
                            <div>
                                <label for="ui_category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <div class="mt-1">
                                    <select name="ui_category_id" id="ui_category_id" required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ui_category_id') border-red-300 @enderror">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('ui_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->icon }} {{ $category->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ui_category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Component Name</label>
                                <div class="mt-1">
                                    <input type="text" name="name" id="name" required
                                           class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-300 @enderror"
                                           value="{{ old('name') }}" placeholder="e.g., Simple Centered Hero">
                                </div>
                                @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">This will be used to generate the URL slug automatically.</p>
                            </div>

                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Display Title</label>
                                <div class="mt-1">
                                    <input type="text" name="title" id="title" required
                                           class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('title') border-red-300 @enderror"
                                           value="{{ old('title') }}" placeholder="e.g., Simple Centered Hero">
                                </div>
                                @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea name="description" id="description" rows="3" required
                                              class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('description') border-red-300 @enderror"
                                              placeholder="Describe this component...">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Sort Order -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                                <div class="mt-1">
                                    <input type="number" name="sort_order" id="sort_order" min="0"
                                           class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('sort_order') border-red-300 @enderror"
                                           value="{{ old('sort_order', 0) }}">
                                </div>
                                @error('sort_order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Lower numbers appear first. Use 0 for default ordering.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - HTML Code -->
                <div class="space-y-8">
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">HTML Code</h3>
                            <p class="text-sm text-gray-500">The HTML code for this component (with Tailwind CSS classes)</p>
                        </div>
                        
                        <div class="p-6">
                            <div>
                                <label for="html_code" class="block text-sm font-medium text-gray-700 mb-2">HTML Code</label>
                                <textarea name="html_code" id="html_code" rows="20" required
                                          class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm font-mono @error('html_code') border-red-300 @enderror"
                                          placeholder="<!-- Enter your HTML code here -->">{!! old('html_code') !!}</textarea>
                                @error('html_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Preview Button -->
                            <div class="mt-4">
                                <button type="button" id="preview-btn" 
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Preview
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Modal -->
            <div id="preview-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-6xl sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Component Preview</h3>
                                <button type="button" id="close-preview" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div id="preview-content" class="border border-gray-200 rounded-lg p-4 bg-gray-50 min-h-96">
                                <!-- Preview will be rendered here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('staff.ui-components.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Component
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize CodeMirror
    const editor = CodeMirror.fromTextArea(document.getElementById('html_code'), {
        mode: 'htmlmixed',
        theme: 'material',
        lineNumbers: true,
        indentWithTabs: false,
        indentUnit: 2,
        tabSize: 2,
        lineWrapping: true,
        autoCloseTags: true,
        matchBrackets: true,
        styleActiveLine: true
    });

    // Preview functionality
    const previewBtn = document.getElementById('preview-btn');
    const previewModal = document.getElementById('preview-modal');
    const previewContent = document.getElementById('preview-content');
    const closePreview = document.getElementById('close-preview');

    previewBtn.addEventListener('click', function() {
        const code = editor.getValue();
        if (code.trim()) {
            previewContent.innerHTML = code;
            previewModal.classList.remove('hidden');
        } else {
            alert('Please enter some HTML code first.');
        }
    });

    closePreview.addEventListener('click', function() {
        previewModal.classList.add('hidden');
    });

    // Close modal when clicking outside
    previewModal.addEventListener('click', function(e) {
        if (e.target === previewModal) {
            previewModal.classList.add('hidden');
        }
    });

    // Update textarea when CodeMirror changes
    editor.on('change', function() {
        document.getElementById('html_code').value = editor.getValue();
    });
});
</script>
@endsection
