@extends('staff.partials.layouts.main')

@section('title', 'UI Components Management')

@section('content')
<div class="min-h-screen bg-gray-50">
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
                        <span class="text-gray-900">UI Components</span>
                    </nav>
                    <h1 class="text-2xl font-bold text-gray-900">UI Components Management</h1>
                    <p class="mt-1 text-gray-600">Manage website UI components and blocks</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('staff.ui-categories.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Categories
                    </a>
                    <a href="{{ route('staff.ui-components.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Component
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-wrap items-center gap-4">
                <!-- Search -->
                <div class="flex-1 min-w-64">
                    <label for="search" class="sr-only">Search components</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="realtime-search" 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="Search components...">
                    </div>
                </div>

                <!-- Category Filter -->
                <div>
                    <select id="category-filter" 
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->title }}">
                            {{ $category->title }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <select id="status-filter" 
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Clear Filters -->
                <button id="clear-filters" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Clear
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
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
        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
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

        <!-- Components Table -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">
                    All Components (<span id="component-count">{{ $components->total() }}</span>)
                </h3>
            </div>
            
            @if($components->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Component</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="components-table-body" class="bg-white divide-y divide-gray-200">
                        @foreach($components as $component)
                        <tr class="hover:bg-gray-50 component-row" 
                            data-title="{{ strtolower($component->title) }}"
                            data-slug="{{ strtolower($component->slug) }}"
                            data-description="{{ strtolower($component->description) }}"
                            data-category="{{ strtolower($component->category->title) }}"
                            data-status="{{ $component->is_active ? 'active' : 'inactive' }}"
                            data-creator="{{ strtolower($component->creator->name ?? 'unknown') }}">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $component->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $component->slug }}</div>
                                    <div class="text-xs text-gray-400 mt-1">{{ Str::limit($component->description, 60) }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $component->category->icon ?? '📦' }} {{ $component->category->title }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($component->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactive
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $component->sort_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $component->creator->name ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $component->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('staff.ui-components.preview', $component) }}" 
                                       class="text-green-600 hover:text-green-900" target="_blank">Preview</a>
                                    <a href="{{ route('staff.ui-components.show', $component) }}" 
                                       class="text-blue-600 hover:text-blue-900">View</a>
                                    <a href="{{ route('staff.ui-components.edit', $component) }}" 
                                       class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form method="POST" action="{{ route('staff.ui-components.destroy', $component) }}" 
                                          class="inline" onsubmit="return confirm('Are you sure you want to delete this component?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- No Results Message -->
            <div id="no-results" class="text-center py-12 hidden">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No components found</h3>
                <p class="mt-1 text-sm text-gray-500">Try adjusting your search terms or filters.</p>
                <div class="mt-6">
                    <button id="clear-search-filters" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear Filters
                    </button>
                </div>
            </div>

            <!-- Pagination -->
            @if($components->hasPages())
            <div class="bg-white px-6 py-3 border-t border-gray-200">
                {{ $components->appends(request()->query())->links() }}
            </div>
            @endif
            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No components</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new UI component.</p>
                <div class="mt-6">
                    <a href="{{ route('staff.ui-components.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Component
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('realtime-search');
    const categoryFilter = document.getElementById('category-filter');
    const statusFilter = document.getElementById('status-filter');
    const clearFiltersBtn = document.getElementById('clear-filters');
    const clearSearchFiltersBtn = document.getElementById('clear-search-filters');
    const componentRows = document.querySelectorAll('.component-row');
    const componentCount = document.getElementById('component-count');
    const noResults = document.getElementById('no-results');
    const tableBody = document.getElementById('components-table-body');
    
    let debounceTimer;
    
    function debounce(func, delay) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(func, delay);
    }
    
    function filterComponents() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCategory = categoryFilter.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value.toLowerCase().trim();
        
        let visibleCount = 0;
        
        componentRows.forEach(row => {
            const title = row.dataset.title || '';
            const slug = row.dataset.slug || '';
            const description = row.dataset.description || '';
            const category = row.dataset.category || '';
            const status = row.dataset.status || '';
            const creator = row.dataset.creator || '';
            
            // Check search match
            const searchMatch = !searchTerm || 
                title.includes(searchTerm) || 
                slug.includes(searchTerm) || 
                description.includes(searchTerm) || 
                creator.includes(searchTerm);
            
            // Check category match
            const categoryMatch = !selectedCategory || category === selectedCategory;
            
            // Check status match
            const statusMatch = !selectedStatus || status === selectedStatus;
            
            // Show/hide row based on all filters
            const shouldShow = searchMatch && categoryMatch && statusMatch;
            
            if (shouldShow) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Update count and show/hide no results message
        componentCount.textContent = visibleCount;
        
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
            tableBody.parentElement.style.display = 'none';
        } else {
            noResults.classList.add('hidden');
            tableBody.parentElement.style.display = '';
        }
    }
    
    function clearAllFilters() {
        searchInput.value = '';
        categoryFilter.value = '';
        statusFilter.value = '';
        filterComponents();
    }
    
    // Add event listeners with debouncing for search
    searchInput.addEventListener('input', function() {
        debounce(filterComponents, 300);
    });
    
    // Immediate filtering for dropdowns
    categoryFilter.addEventListener('change', filterComponents);
    statusFilter.addEventListener('change', filterComponents);
    
    // Clear filters
    clearFiltersBtn.addEventListener('click', clearAllFilters);
    clearSearchFiltersBtn.addEventListener('click', clearAllFilters);
    
    // Handle Enter key in search
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterComponents();
        }
    });
    
    // Focus search on Ctrl+F or Cmd+F
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            searchInput.focus();
        }
    });
    
    // Highlight search terms
    function highlightSearchTerms() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        if (!searchTerm) return;
        
        componentRows.forEach(row => {
            if (row.style.display !== 'none') {
                const titleElement = row.querySelector('.text-sm.font-medium.text-gray-900');
                const descElement = row.querySelector('.text-xs.text-gray-400');
                
                if (titleElement && titleElement.textContent.toLowerCase().includes(searchTerm)) {
                    const regex = new RegExp(`(${searchTerm})`, 'gi');
                    titleElement.innerHTML = titleElement.textContent.replace(regex, '<mark class="bg-yellow-200">$1</mark>');
                }
                
                if (descElement && descElement.textContent.toLowerCase().includes(searchTerm)) {
                    const regex = new RegExp(`(${searchTerm})`, 'gi');
                    descElement.innerHTML = descElement.textContent.replace(regex, '<mark class="bg-yellow-200">$1</mark>');
                }
            }
        });
    }
    
    // Remove highlights
    function removeHighlights() {
        componentRows.forEach(row => {
            const marks = row.querySelectorAll('mark');
            marks.forEach(mark => {
                mark.outerHTML = mark.innerHTML;
            });
        });
    }
    
    // Update search with highlighting
    searchInput.addEventListener('input', function() {
        removeHighlights();
        debounce(() => {
            filterComponents();
            highlightSearchTerms();
        }, 300);
    });
    
    // Show loading state during filter
    function showLoadingState() {
        componentCount.textContent = '...';
    }
    
    // Enhanced search with loading state
    searchInput.addEventListener('input', function() {
        showLoadingState();
        removeHighlights();
        debounce(() => {
            filterComponents();
            highlightSearchTerms();
        }, 300);
    });
});
</script>

@endsection
