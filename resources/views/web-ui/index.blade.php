@extends('partials.layouts.main')

@section('title', 'Web UI Blocks - Ready-to-use Components')
@section('description', 'Beautiful, responsive UI components built with Tailwind CSS. Copy and paste ready-to-use blocks for your web projects.')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl md:text-6xl">
                    Web UI Blocks
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Beautiful, responsive components built with Tailwind CSS. Ready to copy and paste into your projects.
                </p>
                <div class="mt-8">
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        ✨ Free to use
                    </span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 ml-2">
                        📱 Responsive
                    </span>
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800 ml-2">
                        🎨 Tailwind CSS
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- UI Blocks Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($uiCategories->count() > 0)
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($uiCategories as $category)
            <a href="{{ route('webui.category', $category->slug) }}" 
               class="group relative bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <!-- Icon -->
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg mb-4 group-hover:bg-blue-50 transition-colors duration-200">
                        <span class="text-2xl">{{ $category->icon ?? '📦' }}</span>
                    </div>
                    
                    <!-- Content -->
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                        {{ $category->title }}
                    </h3>
                    <p class="text-sm text-gray-500 mb-4">
                        {{ $category->description }}
                    </p>
                    
                    <!-- Count Badge -->
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $category->active_components_count ?? 0 }} components
                        </span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Hover Effect -->
                <div class="absolute inset-0 bg-blue-500 opacity-0 group-hover:opacity-5 transition-opacity duration-200"></div>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="text-gray-400 text-6xl mb-4">📦</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No UI Categories Available</h3>
            <p class="text-gray-500">UI categories will appear here once they are created by staff.</p>
        </div>
        @endif
    </div>

    <!-- CTA Section -->
    <div class="bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl">
                    Start Building Beautiful UIs
                </h2>
                <p class="mt-4 text-lg text-blue-100">
                    All components are built with Tailwind CSS and are fully responsive.
                </p>
                <div class="mt-8">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 transition-colors duration-200">
                        ← Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
