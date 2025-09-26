@extends('partials.layouts.main')

@section('title', $query ? 'Hasil Pencarian: ' . $query . ' - Centrova' : 'Pencarian Cerdas - Temukan Semua Halaman di Centrova')

@section('navbar')
    @include('partials.navbar.main')
@endsection

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="{{ $query ? 'noindex, nofollow' : 'index, follow' }}"/>
    <meta name="description" content="{{ $query ? 'Hasil pencarian untuk: ' . $query . '. Temukan halaman, layanan, dan informasi yang Anda cari di website Centrova.' : 'Fitur pencarian canggih Centrova memungkinkan Anda menemukan semua halaman, layanan, informasi legal, dan konten website dengan mudah dan cepat.' }}"/>
    <meta name="keywords" content="pencarian, search, centrova, website, layanan, informasi, teknologi, digital, jasa pembuatan website, website profesional, web development, website bisnis, toko online, landing page, company profile, website responsif, jasa website, pembuatan website, website modern, e-commerce, aplikasi web, desain website, website murah"/>
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:title" content="{{ $query ? 'Hasil Pencarian: ' . $query . ' - Centrova' : 'Pencarian Cerdas - Centrova' }}"/>
    <meta property="og:description" content="{{ $query ? 'Hasil pencarian untuk: ' . $query : 'Temukan semua yang Anda butuhkan di website Centrova dengan fitur pencarian yang canggih' }}"/>
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image"/>
    <meta property="twitter:url" content="{{ request()->url() }}"/>
    <meta property="twitter:title" content="{{ $query ? 'Hasil Pencarian: ' . $query . ' - Centrova' : 'Pencarian Cerdas - Centrova' }}"/>
    <meta property="twitter:description" content="{{ $query ? 'Hasil pencarian untuk: ' . $query : 'Temukan semua yang Anda butuhkan di website Centrova' }}"/>

    @if($query)
        <link rel="canonical" href="{{ route('search') }}?q={{ urlencode($query) }}"/>
    @else
        <link rel="canonical" href="{{ route('search') }}"/>
    @endif
@endsection

@section('style-css')
    <style>
        [x-cloak] { 
            display: none !important; 
        }
        
        .highlight {
            background-color: #97deff;
            padding: 1px 3px;
            border-radius: 3px;
            font-weight: 600;
        }
        
        .search-filters {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        
        .search-filters::-webkit-scrollbar {
            display: none;
        }
        
        .category-badge {
            transition: all 0.2s ease;
        }
        
        .category-badge.active {
            background-color: #128AEB;
            color: white;
        }
        
        .search-suggestion-tag {
            transition: all 0.2s ease;
        }
        
        .search-suggestion-tag:hover {
            background-color: #e2e8f0;
            transform: translateY(-1px);
        }

        .search-shortcuts {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        @media (max-width: 640px) {
            .search-shortcuts {
                bottom: 80px;
            }
        }

        .search-shortcut-tooltip {
            transform: translateY(-10px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .search-shortcut-tooltip.show {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen" x-data="searchPage">
        <!-- Search Header -->
        <div class="bg-white border-b border-gray-200 pt-10 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('search') }}" class="relative mb-6" @submit.prevent="submitSearch()">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                x-ref="searchInput"
                                x-model="searchQuery"
                                @input="handleSearchInput"
                                @keydown="handleKeydown"
                                @focus="showSuggestions = searchQuery.trim().length > 1"
                                @blur="hideSuggestions"
                                type="text" 
                                name="q"
                                placeholder="Cari layanan, jasa website, pembuatan website, toko online..."
                                class="w-full pl-12 pr-4 py-3 text-lg border border-slate-300 rounded-2xl focus:ring-1 focus:ring-[#128AEB] focus:border-[#128AEB] outline-none transition-all duration-150"
                                autocomplete="off"
                            />
                            <input type="hidden" name="category" value="{{ $category }}">
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <button 
                                    type="submit"
                                    class="text-[#128AEB] hover:text-[#0f75c6] rounded-full font-medium transition-colors duration-200 flex items-center space-x-1"
                                >
                                    <span>Cari</span>
                                </button>
                            </div>
                        </div>

                        <!-- Live Search Suggestions Dropdown -->
                        <div 
                            x-show="showSuggestions && liveSuggestions.length > 0" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-full left-0 right-0 mt-2 bg-white border border-slate-200 rounded-xl shadow-lg z-50 max-h-96 overflow-y-auto"
                            @click.away="showSuggestions = false"
                            x-cloak
                        >
                            <div>
                                <div class="flex items-center justify-between px-4 py-2">
                                    <div class="text-sm text-slate-600 uppercase">Hasil Pencarian</div>
                                    <div x-show="isLoading" class="text-xs text-slate-400">Mencari...</div>
                                </div>
                                <template x-for="(suggestion, index) in liveSuggestions" :key="index">
                                    <a 
                                        :href="suggestion.url"
                                        @click.prevent="selectSuggestion(suggestion)"
                                        class="flex items-start py-2 px-4 hover:bg-neutral-100 cursor-pointer group"
                                    >
                                        <div class="flex-1 min-w-0">
                                            <p class="text-base font-normal text-slate-900 group-hover:text-[#128AEB] group-hover:underline" x-html="suggestion.title"></p>
                                        </div>  
                                    </a>
                                </template>
                            </div>
                        </div>
                    </form>

                    <!-- Search Filters -->
                    @if($query)
                        <div class="flex space-x-3 overflow-x-auto search-filters pb-2">
                            <a href="{{ route('search') }}?q={{ urlencode($query) }}" 
                               class="category-badge whitespace-nowrap inline-flex items-center px-4 py-2 rounded-full text-sm font-medium border {{ empty($category) ? 'active' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                                Semua
                            </a>
                            @if(isset($suggestions['categories']))
                                @foreach($suggestions['categories'] as $catKey => $catName)
                                    <a href="{{ route('search') }}?q={{ urlencode($query) }}&category={{ $catKey }}" 
                                       class="category-badge whitespace-nowrap inline-flex items-center px-4 py-2 rounded-full text-sm font-medium border {{ $category === $catKey ? 'active' : 'bg-white border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                                        {{ $catName }}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if($query)
                <div class="max-w-4xl mx-auto">
                    <!-- Results Info -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <p class="text-slate-500 text-sm">
                                @if($totalResults > 0)
                                    Menampilkan <span class="font-normal text-slate-900">{{ $totalResults }}</span> hasil untuk 
                                    "<span class="font-normal text-slate-900">{{ $query }}</span>"
                                    @if($category)
                                        dalam kategori <span class="font-normal text-[#128AEB]">{{ $suggestions['categories'][$category] ?? $category }}</span>
                                    @endif
                                @else
                                    Tidak ada hasil untuk "<span class="font-normal text-slate-900">{{ $query }}</span>"
                                    @if($category)
                                        dalam kategori <span class="font-normal text-[#128AEB]">{{ $suggestions['categories'][$category] ?? $category }}</span>
                                    @endif
                                @endif
                            </p>
                            @if($totalResults > 0)
                                <div class="text-sm text-slate-500">
                                    Diurutkan berdasarkan relevansi
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($totalResults > 0)
                        <!-- Search Results -->
                        <div class="space-y-6">
                            @foreach($results as $result)
                                <div class="bg-white search-result-card py-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center mb-3 hidden">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                                    @if($result['category'] === 'services') bg-blue-100 text-blue-800
                                                    @elseif($result['category'] === 'legal') bg-purple-100 text-purple-800
                                                    @elseif($result['category'] === 'support') bg-green-100 text-green-800
                                                    @elseif($result['category'] === 'company') bg-orange-100 text-orange-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif mr-3">
                                                    {{ $result['type'] }}
                                                </span>
                                                @if(isset($result['score']))
                                                    <div class="text-xs text-slate-400">
                                                        {{ round($result['score']) }}% relevan
                                                    </div>
                                                @endif
                                            </div>
                                            <h3 class="text-xl font-medium text-slate-900 mb-3">
                                                <a href="{{ $result['url'] }}" class="hover:text-[#128aeb] hover:underline">
                                                    {!! $result['highlighted_title'] ?? $result['title'] !!}
                                                </a>
                                            </h3>
                                            <p class="text-slate-800 mb-4 leading-relaxed">
                                                @php
                                                    $description = $result['excerpt'] ?? $result['highlighted_description'] ?? $result['description'] ?? '';
                                                    // Clean any remaining artifacts
                                                    $description = preg_replace('/[\'"][a-zA-Z_-]*[\'"]/', '', $description);
                                                    $description = preg_replace('/\b(menuitems|url|text|title|icon|type|category)\b/i', '', $description);
                                                    $description = trim($description);
                                                    
                                                    // If description is empty or looks corrupted, use fallback
                                                    if (empty($description) || strlen($description) < 10) {
                                                        $fallbacks = [
                                                            'services' => 'Layanan profesional untuk kebutuhan teknologi bisnis Anda.',
                                                            'legal' => 'Informasi legal dan kebijakan layanan.',
                                                            'support' => 'Bantuan dan dukungan teknis.',
                                                            'team' => 'Tim profesional berpengalaman.',
                                                            'general' => 'Informasi lengkap tentang layanan kami.'
                                                        ];
                                                        $description = $fallbacks[$result['category']] ?? 'Temukan informasi yang Anda butuhkan.';
                                                    }
                                                @endphp
                                                {!! $description !!}
                                            </p>
                                            <div class="flex items-center">
                                                <a href="{{ $result['url'] }}" class="inline-flex items-center text-[#128aeb] rounded-full transition-colors duration-200 group">
                                                    <span class="text-base group-hover:underline">Buka Halaman</span>
                                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                    </svg>
                                                </a>
                                                <div class="text-xs text-slate-400 hidden">
                                                    {{ parse_url($result['url'], PHP_URL_PATH) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- No Results -->
                        <div class="text-center py-16">
                            <div class="w-24 h-24 mx-auto mb-6 bg-slate-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-slate-900 mb-4">Tidak Ada Hasil Ditemukan</h3>
                            <p class="text-slate-600 mb-8 max-w-md mx-auto">
                                Kami tidak dapat menemukan halaman yang sesuai dengan pencarian Anda. 
                                @if($category)
                                    Coba hapus filter kategori atau 
                                @endif
                                gunakan kata kunci yang berbeda.
                            </p>
                            
                            <!-- Search Suggestions -->
                            <div class="max-w-2xl mx-auto">
                                <h4 class="text-lg font-medium text-slate-900 mb-6">Coba Cari:</h4>
                                
                                <!-- Popular Search Terms -->
                                <div class="mb-8">
                                    <h5 class="text-sm font-medium text-slate-700 mb-3">Pencarian Populer:</h5>
                                    <div class="flex flex-wrap justify-center gap-2">
                                        @if(isset($suggestions['popular']) && count($suggestions['popular']) > 0)
                                            @foreach($suggestions['popular'] as $suggestion)
                                                <a href="{{ route('search') }}?q={{ urlencode($suggestion) }}" 
                                                   class="search-suggestion-tag inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-full text-sm transition-all duration-200">
                                                    {{ $suggestion }}
                                                </a>
                                            @endforeach
                                        @else
                                            {{-- Default web development keywords --}}
                                            @php
                                                $noResultsKeywords = [
                                                    'jasa pembuatan website',
                                                    'website profesional', 
                                                    'web development',
                                                    'toko online',
                                                    'landing page',
                                                    'company profile',
                                                    'website bisnis',
                                                    'e-commerce'
                                                ];
                                            @endphp
                                            @foreach($noResultsKeywords as $keyword)
                                                <a href="{{ route('search') }}?q={{ urlencode($keyword) }}" 
                                                   class="search-suggestion-tag inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-full text-sm transition-all duration-200">
                                                    {{ $keyword }}
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <!-- Quick Links -->
                                <div>
                                    <h5 class="text-sm font-medium text-slate-700 mb-4">Atau Jelajahi Langsung:</h5>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                        @if(isset($quickLinks))
                                            @foreach($quickLinks as $link)
                                                <a href="{{ $link['url'] }}" class="bg-white border border-slate-200 rounded-xl p-4 text-center hover:shadow-md hover:border-[#128AEB] transition-all duration-200 group">
                                                    <div class="text-sm font-medium text-slate-900 group-hover:text-[#128AEB]">{{ $link['title'] }}</div>
                                                    <div class="text-xs text-slate-600 mt-1">{{ $link['description'] }}</div>
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <!-- Search Suggestions when no query -->
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4 text-center">Jelajahi Website Centrova</h2>
                    <p class="text-slate-600 text-center mb-12 max-w-2xl mx-auto">
                        Temukan semua layanan, informasi, dan konten yang Anda butuhkan dengan fitur pencarian yang canggih
                    </p>
                    
                    <!-- Quick Access Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                        @if(isset($quickLinks) && count($quickLinks) > 0)
                            @foreach($quickLinks as $link)
                                <a href="{{ $link['url'] }}" class="bg-white rounded-2xl border border-slate-200 p-6 text-center hover:shadow-lg hover:border-[#128AEB] transition-all duration-200 group">
                                    <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#128AEB]/20 transition-colors duration-200">
                                        @if($link['icon'] === 'globe')
                                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 919-9"/>
                                            </svg>
                                        @elseif($link['icon'] === 'mobile')
                                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        @elseif($link['icon'] === 'design')
                                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"/>
                                            </svg>
                                        @else
                                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <h3 class="text-xl font-semibold text-slate-900 mb-2 group-hover:text-[#128AEB] transition-colors duration-200">{{ $link['title'] }}</h3>
                                    <p class="text-slate-600">{{ $link['description'] }}</p>
                                </a>
                            @endforeach
                        @else
                            {{-- Default service cards jika tidak ada quickLinks --}}
                            <a href="{{ route('services.web.index') }}" class="bg-white rounded-2xl border border-slate-200 p-6 text-center hover:shadow-lg hover:border-[#128AEB] transition-all duration-200 group">
                                <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#128AEB]/20 transition-colors duration-200">
                                    <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 919-9"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-slate-900 mb-2 group-hover:text-[#128AEB] transition-colors duration-200">Web Development</h3>
                                <p class="text-slate-600">Jasa pembuatan website profesional dan modern</p>
                            </a>
                            
                            <a href="#" class="bg-white rounded-2xl border border-slate-200 p-6 text-center hover:shadow-lg hover:border-[#128AEB] transition-all duration-200 group">
                                <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#128AEB]/20 transition-colors duration-200">
                                    <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-slate-900 mb-2 group-hover:text-[#128AEB] transition-colors duration-200">Mobile App</h3>
                                <p class="text-slate-600">Pengembangan aplikasi mobile iOS dan Android</p>
                            </a>
                            
                            <a href="#" class="bg-white rounded-2xl border border-slate-200 p-6 text-center hover:shadow-lg hover:border-[#128AEB] transition-all duration-200 group">
                                <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#128AEB]/20 transition-colors duration-200">
                                    <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-slate-900 mb-2 group-hover:text-[#128AEB] transition-colors duration-200">UI/UX Design</h3>
                                <p class="text-slate-600">Desain antarmuka dan pengalaman pengguna</p>
                            </a>
                        @endif
                    </div>                    
                    <!-- Search Tips -->
                    <div class="bg-slate-50 rounded-2xl p-8">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4 text-center">Tips Pencarian</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-[#128AEB]/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-4 h-4 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-900 mb-1">Gunakan kata kunci spesifik</h4>
                                    <p class="text-sm text-slate-600">Contoh: "pembuatan website", "jasa website", "toko online", "landing page"</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-[#128AEB]/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-4 h-4 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-slate-900 mb-1">Filter berdasarkan kategori</h4>
                                    <p class="text-sm text-slate-600">Gunakan filter untuk hasil yang lebih tepat</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Searches -->
                    <div class="text-center mt-12">
                        <h3 class="text-lg font-semibold text-slate-900 mb-6">Pencarian Populer</h3>
                        <div class="flex flex-wrap justify-center gap-3">
                            @if(isset($suggestions['popular']))
                                @foreach($suggestions['popular'] as $suggestion)
                                    <a href="{{ route('search') }}?q={{ urlencode($suggestion) }}" 
                                       class="search-suggestion-tag inline-flex items-center px-5 py-3 bg-white border border-slate-200 hover:border-[#128AEB] hover:bg-[#128AEB]/5 text-slate-700 hover:text-[#128AEB] rounded-full transition-all duration-200 shadow-sm hover:shadow-md">
                                        {{ $suggestion }}
                                    </a>
                                @endforeach
                            @else
                                {{-- Default web development keywords jika tidak ada suggestions dari backend --}}
                                @php
                                    $webKeywords = [
                                        'jasa pembuatan website',
                                        'website profesional',
                                        'web development',
                                        'website bisnis',
                                        'toko online',
                                        'landing page',
                                        'company profile',
                                        'website responsif',
                                        'jasa website',
                                        'pembuatan website',
                                        'website modern',
                                        'e-commerce',
                                        'aplikasi web',
                                        'desain website',
                                        'website murah'
                                    ];
                                @endphp
                                @foreach($webKeywords as $keyword)
                                    <a href="{{ route('search') }}?q={{ urlencode($keyword) }}" 
                                       class="search-suggestion-tag inline-flex items-center px-5 py-3 bg-white border border-slate-200 hover:border-[#128AEB] hover:bg-[#128AEB]/5 text-slate-700 hover:text-[#128AEB] rounded-full transition-all duration-200 shadow-sm hover:shadow-md">
                                        {{ $keyword }}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Back to Home -->
            <div class="text-center mt-12">
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-[#128AEB] text-white rounded-full hover:bg-[#0f75c6] transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Floating Search Shortcuts -->
        <div class="search-shortcuts">
            <div class="relative">
                <button 
                    @click="$refs.searchInput?.focus()"
                    @mouseenter="showTooltip = true"
                    @mouseleave="showTooltip = false"
                    class="w-12 h-12 bg-[#128AEB] text-white rounded-full shadow-lg hover:bg-[#0f75c6] transition-all duration-200 flex items-center justify-center hover:scale-110"
                    title="Quick Search (Ctrl+K)"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
                
                <!-- Tooltip -->
                <div 
                    x-show="showTooltip" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="absolute bottom-full right-0 mb-2 px-3 py-2 bg-slate-900 text-white text-sm rounded-lg whitespace-nowrap"
                    x-cloak
                >
                    Quick Search
                    <div class="absolute top-full right-3 w-0 h-0 border-l-4 border-r-4 border-t-4 border-l-transparent border-r-transparent border-t-slate-900"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchPage', () => ({
                searchQuery: '{{ $query }}',
                liveSuggestions: [],
                popularSuggestions: [],
                showSuggestions: false,
                showTooltip: false,
                isLoading: false,
                searchTimeout: null,

                init() {
                    // Auto-focus search input
                    this.$nextTick(() => {
                        if (this.$refs.searchInput) {
                            this.$refs.searchInput.focus();
                        }
                    });

                    // Load popular suggestions
                    this.loadPopularSuggestions();
                },

                loadPopularSuggestions() {
                    // Load from backend atau fallback ke default web development keywords
                    const backendSuggestions = @json($suggestions['popular'] ?? []);
                    
                    if (backendSuggestions.length > 0) {
                        this.popularSuggestions = backendSuggestions;
                    } else {
                        // Default web development keywords
                        this.popularSuggestions = [
                            'jasa pembuatan website',
                            'website profesional',
                            'web development', 
                            'website bisnis',
                            'toko online',
                            'landing page',
                            'company profile',
                            'website responsif',
                            'jasa website',
                            'pembuatan website',
                            'website modern',
                            'e-commerce',
                            'aplikasi web',
                            'desain website',
                            'website murah',
                            'website berkualitas',
                            'optimasi SEO',
                            'hosting website',
                            'domain website',
                            'maintenance website'
                        ];
                    }
                },

                async getLiveSuggestions(query) {
                    const trimmedQuery = query.trim();
                    
                    if (trimmedQuery.length < 2) {
                        this.liveSuggestions = [];
                        this.showSuggestions = false;
                        return;
                    }

                    this.isLoading = true;
                    
                    try {
                        const response = await fetch(`{{ route('search.suggestions') }}?q=${encodeURIComponent(trimmedQuery)}`);
                        const data = await response.json();
                        this.liveSuggestions = data;
                        this.showSuggestions = data.length > 0;
                    } catch (error) {
                        console.error('Search suggestions error:', error);
                        this.liveSuggestions = [];
                        this.showSuggestions = false;
                        // Fallback to popular suggestions
                        this.filterPopularSuggestions(trimmedQuery);
                    } finally {
                        this.isLoading = false;
                    }
                },

                filterPopularSuggestions(query) {
                    // Web development keywords mapping untuk pencarian yang lebih pintar
                    const webKeywordMap = {
                        'website': ['jasa pembuatan website', 'website profesional', 'website bisnis', 'website responsif'],
                        'web': ['web development', 'jasa website', 'aplikasi web', 'desain website'],
                        'toko': ['toko online', 'e-commerce', 'website bisnis'],
                        'landing': ['landing page', 'website profesional'],
                        'company': ['company profile', 'website perusahaan'],
                        'profesional': ['website profesional', 'jasa pembuatan website'],
                        'bisnis': ['website bisnis', 'toko online', 'company profile'],
                        'modern': ['website modern', 'website profesional'],
                        'murah': ['website murah', 'jasa website'],
                        'ecommerce': ['e-commerce', 'toko online'],
                        'pembuatan': ['jasa pembuatan website', 'pembuatan website'],
                        'jasa': ['jasa pembuatan website', 'jasa website'],
                        'responsive': ['website responsif', 'website modern'],
                        'seo': ['optimasi SEO', 'website profesional'],
                        'hosting': ['hosting website', 'domain website'],
                        'maintenance': ['maintenance website', 'jasa website']
                    };
                    
                    let filtered = [];
                    const queryLower = query.toLowerCase();
                    
                    // Cari berdasarkan exact match atau partial match
                    filtered = this.popularSuggestions.filter(suggestion => 
                        suggestion.toLowerCase().includes(queryLower) || 
                        queryLower.includes(suggestion.toLowerCase())
                    );
                    
                    // Jika tidak ada exact match, cari berdasarkan keyword mapping
                    if (filtered.length === 0) {
                        for (const [keyword, suggestions] of Object.entries(webKeywordMap)) {
                            if (queryLower.includes(keyword) || keyword.includes(queryLower)) {
                                suggestions.forEach(suggestion => {
                                    if (this.popularSuggestions.includes(suggestion) && !filtered.includes(suggestion)) {
                                        filtered.push(suggestion);
                                    }
                                });
                            }
                        }
                    }
                    
                    // Jika masih tidak ada, tampilkan beberapa suggestions default
                    if (filtered.length === 0 && query.length >= 2) {
                        filtered = [
                            'jasa pembuatan website',
                            'website profesional', 
                            'web development',
                            'toko online'
                        ];
                    }
                    
                    if (filtered.length > 0) {
                        this.liveSuggestions = filtered.slice(0, 6).map(suggestion => ({
                            title: suggestion,
                            description: 'Pencarian populer',
                            url: `{{ route('search') }}?q=${encodeURIComponent(suggestion)}`,
                            type: 'Suggestion'
                        }));
                        
                        // Tambahkan direct link ke halaman web development jika query cocok
                        if (queryLower.includes('web') || queryLower.includes('website') || queryLower.includes('pembuatan')) {
                            this.liveSuggestions.unshift({
                                title: 'Layanan Web Development',
                                description: 'Jasa pembuatan website profesional dan modern',
                                url: '{{ route("services.web.index") }}',
                                type: 'Layanan'
                            });
                        }
                        
                        this.showSuggestions = true;
                    }
                },

                handleSearchInput(event) {
                    const query = event.target.value; // Tidak trim di sini agar spasi bisa diketik
                    this.searchQuery = query;
                    
                    // Clear previous timeout
                    if (this.searchTimeout) {
                        clearTimeout(this.searchTimeout);
                    }
                    
                    // Debounce search requests
                    this.searchTimeout = setTimeout(() => {
                        this.getLiveSuggestions(query.trim()); // Trim saat search suggestions
                    }, 300);
                },

                selectSuggestion(suggestion) {
                    if (suggestion.url) {
                        window.location.href = suggestion.url;
                    } else {
                        this.searchQuery = suggestion.title || suggestion;
                        this.showSuggestions = false;
                        this.submitSearch();
                    }
                },

                submitSearch() {
                    if (this.searchQuery.trim()) {
                        window.location.href = '{{ route("search") }}?q=' + encodeURIComponent(this.searchQuery.trim());
                    }
                },

                hideSuggestions() {
                    setTimeout(() => {
                        this.showSuggestions = false;
                    }, 150);
                },

                // Keyboard navigation for suggestions
                handleKeydown(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        this.showSuggestions = false; // Tutup suggestions sebelum submit
                        this.submitSearch();
                    } else if (event.key === 'Escape') {
                        this.showSuggestions = false;
                        event.target.blur();
                    }
                }
            }));
        });

        // Global keyboard shortcuts and enhancements
        document.addEventListener('DOMContentLoaded', function() {
            // Add keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + K to focus search
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    const searchInput = document.querySelector('input[name="q"]');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
            });

            // Analytics tracking for search
            const searchForm = document.querySelector('form[action*="search"]');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const query = this.querySelector('input[name="q"]').value;
                    // Track search event (add your analytics code here)
                });
            }

            // Add search result click tracking
            document.querySelectorAll('.search-result-card a').forEach(link => {
                link.addEventListener('click', function() {
                });
            });
        });
    </script>
@endsection
