@extends('staff.partials.layouts.main')

@section('title', 'View Component: ' . $component->title)

@push('styles')
<style>
/* Specific styles for this page only */
</style>
@endpush

@push('scripts')
<!-- Monaco Editor is now handled by the component -->
@endpush

@section('content')
<div class="min-h-screen bg-white">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
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
                        <span class="text-gray-900">{{ $component->title }}</span>
                    </nav>
                    <div class="flex items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $component->title }}</h1>
                            <p class="mt-1 text-gray-600 max-w-[80%]">{{ $component->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('staff.ui-components.index') }}" 
                       class="flex whitespace-nowrap items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Components
                    </a>
                    <a href="{{ route('staff.ui-components.edit', $component) }}" 
                       class="flex whitespace-nowrap items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Component
                    </a>
                    @if($component->demo_url)
                    <a href="{{ $component->demo_url }}" target="_blank"
                       class="inline-flex items-center px-4 py-2 border border-green-300 rounded-md shadow-sm text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        View Demo
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- Component Details -->
        <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-900 tracking-tight">Component Details</h3>
            
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <!-- Basic Info Card -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Basic Information</h4>
                    <div class="space-y-3">
                        <div>
                            <div class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Name</div>
                            <div class="text-sm text-gray-900">{{ $component->name }}</div>
                        </div>
                        <div>
                            <div class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Slug</div>
                            <div class="text-sm text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded">{{ $component->slug }}</div>
                        </div>
                        <div>
                            <div class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Sort Order</div>
                            <div class="text-sm text-gray-900">{{ $component->sort_order }}</div>
                        </div>
                    </div>
                </div>

                <!-- Category & Status Card -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Category & Status</h4>
                    <div class="space-y-3">
                        <div>
                            <div class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Category</div>
                            <a href="{{ route('staff.ui-categories.show', $component->category) }}" 
                               class="inline-flex items-center gap-2 text-sm text-gray-900 hover:text-gray-700 transition-colors">
                                <span class="text-base">{{ $component->category->icon ?? '📦' }}</span>
                                {{ $component->category->title }}
                            </a>
                        </div>
                        <div>
                            <div class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Status</div>
                            @if($component->is_active)
                            <div class="inline-flex items-center gap-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-900">Active</span>
                            </div>
                            @else
                            <div class="inline-flex items-center gap-2">
                                <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                <span class="text-sm text-gray-900">Inactive</span>
                            </div>
                            @endif
                        </div>
                        <div>
                            <div class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Created</div>
                            <div class="text-sm text-gray-900">{{ $component->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>

                @if($component->demo_url)
                <!-- Demo Card -->
                <div class="bg-white border border-gray-200 rounded-xl p-6">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Demo</h4>
                    <div class="space-y-3">
                        <div>
                            <div class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Demo URL</div>
                            <a href="{{ $component->demo_url }}" target="_blank" 
                               class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                View Demo
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if($component->description)
            <!-- Description Card -->
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Description</h4>
                <p class="text-sm text-gray-700 leading-relaxed">{{ $component->description }}</p>
            </div>
            @endif
        </div>

        <!-- Component Code & Preview -->
        @if($component->html_code)
        @include('staff.ui-components.partials.code-display')
        @endif

    </div>
</div>
@endsection
