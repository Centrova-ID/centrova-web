@extends('staff.partials.layouts.main')

@section('title', 'Edit Component: ' . $component->title)

@section('content')
<div class="min-h-screen bg-white" id="main-container">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200" id="main-header">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-4">
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
                        <span class="text-gray-900">Edit Component</span>
                    </nav>
                    <h1 class="text-xl font-bold text-gray-900">{{ $component->title }}</h1>
                    <p class="mt-1 text-sm text-gray-600">{{ $component->slug }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('staff.ui-components.show', $component) }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                    <button type="button" id="save-component" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Split Layout -->
    <div class="flex h-screen overflow-hidden bg-gray-50" style="height: calc(100vh - 80px);" id="split-container">
        <!-- Left Panel - Component Details -->
        <div id="left-panel" class="w-1/3 bg-white border-r border-gray-200 overflow-y-auto transition-all duration-300">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-6">Component Details</h3>
                
                <form id="component-form" method="POST" action="{{ route('staff.ui-components.update', $component) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Component Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $component->name) }}" 
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                               placeholder="e.g., simple-hero" required>
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Display Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $component->title) }}" 
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                               placeholder="e.g., Simple Hero Section" required>
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="ui_category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="ui_category_id" id="ui_category_id" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('ui_category_id', $component->ui_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->icon }} {{ $category->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('ui_category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" 
                                  class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                                  placeholder="Describe what this component does..." required>{{ old('description', $component->description) }}</textarea>
                        @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Icon -->
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700">Icon (Emoji)</label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $component->icon) }}" 
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                               placeholder="🧩" maxlength="10">
                        @error('icon')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $component->sort_order) }}" 
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                               min="0" placeholder="0">
                        @error('sort_order')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Demo URL -->
                    <div>
                        <label for="demo_url" class="block text-sm font-medium text-gray-700">Demo URL</label>
                        <input type="url" name="demo_url" id="demo_url" value="{{ old('demo_url', $component->demo_url) }}" 
                               class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                               placeholder="https://example.com/demo">
                        @error('demo_url')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" value="1" 
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                       {{ old('is_active', $component->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Active (visible to users)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Hidden fields for code -->
                    <input type="hidden" name="html_code" id="hidden_html_code" value="{{ old('html_code', $component->html_code) }}">
                    <input type="hidden" name="css_code" id="hidden_css_code" value="{{ old('css_code', $component->css_code) }}">
                    <input type="hidden" name="js_code" id="hidden_js_code" value="{{ old('js_code', $component->js_code) }}">
                </form>
            </div>
        </div>

        <!-- Right Panel - Code Editor & Preview -->
        <div id="right-panel" class="flex-1 flex flex-col overflow-hidden transition-all duration-300">
            <div class="flex-1">
                @include('staff.ui-components.partials.code-editor', [
                    'component' => $component
                ])
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
<div id="success-message" class="fixed top-4 right-4 bg-green-50 border border-green-200 rounded-md p-4 z-50">
    <div class="flex">
        <svg class="flex-shrink-0 h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <div class="ml-3">
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div id="error-message" class="fixed top-4 right-4 bg-red-50 border border-red-200 rounded-md p-4 z-50">
    <div class="flex">
        <svg class="flex-shrink-0 h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <div class="ml-3">
            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form elements
    const saveButton = document.getElementById('save-component');
    const componentForm = document.getElementById('component-form');
    
    // Hidden form fields
    const hiddenHtml = document.getElementById('hidden_html_code');
    const hiddenCss = document.getElementById('hidden_css_code');
    const hiddenJs = document.getElementById('hidden_js_code');
    
    let editors = {};
    
    // Save component
    saveButton.addEventListener('click', function() {
        // Get current values from Monaco editors
        if (editors.htmlEditor) {
            hiddenHtml.value = editors.htmlEditor.getValue();
        }
        if (editors.cssEditor) {
            hiddenCss.value = editors.cssEditor.getValue();
        }
        if (editors.jsEditor) {
            hiddenJs.value = editors.jsEditor.getValue();
        }
        
        // Submit form
        componentForm.submit();
    });
    
    // Listen for editors ready event
    window.addEventListener('monaco-editor-ready', function(event) {
        editors = event.detail;
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 's':
                    e.preventDefault();
                    saveButton.click();
                    break;
            }
        }
    });
    
    // Auto-hide messages
    setTimeout(() => {
        const successMsg = document.getElementById('success-message');
        const errorMsg = document.getElementById('error-message');
        if (successMsg) successMsg.style.display = 'none';
        if (errorMsg) errorMsg.style.display = 'none';
    }, 5000);
});
</script>

@endsection
