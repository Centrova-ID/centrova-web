@extends('partials.layouts.main')

@section('title', 'Halaman Tidak Ditemukan - Centrova')

@section('navbar')
    @include('partials.navbar.main')
@endsection

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="description" content="Halaman yang Anda cari tidak ditemukan. Gunakan pencarian untuk menemukan konten yang Anda butuhkan di Centrova."/>
@endsection

@section('style-css')
    <style>
        [x-cloak] { 
            display: none !important; 
        }
        
        .search-suggestion {
            transition: all 0.2s ease;
        }
        
        .search-suggestion:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen bg-white flex items-center justify-center" x-data="notFoundPage">
        <div class="w-full max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-10">
            
            <!-- 404 Illustration -->
            <div class="mb-12 relative">
                <div class="text-[120px] sm:text-[150px] md:text-[200px] font-bold text-slate-200 leading-none select-none">
                    404
                </div>
            </div>

            <!-- Heading & Description -->
            <div class="mb-12" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h1 class="text-3xl sm:text-3xl md:text-4xl font-semibold text-slate-900 mb-6 leading-tight">
                    Maaf, halaman yang Anda cari tidak dapat ditemukan.
                </h1>
            </div>

            <!-- Search Section -->
            <div class="mb-12" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                <div class="max-w-xl mx-auto">
                    <!-- Search Bar -->
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            x-model="searchQuery"
                            @input="handleSearch"
                            placeholder="Cari hal yang ingin kamu temukan ..."
                            class="w-full pl-12 pr-4 py-2 text-lg border border-slate-300 rounded-2xl focus:ring-2 focus:ring-[#128AEB] focus:border-[#128AEB] outline-none transition-all duration-200"
                        />
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <button 
                                @click="performSearch"
                                class="text-[#128AEB] rounded-full font-medium"
                            >
                                Cari
                            </button>
                        </div>
                    </div>

                    <!-- Search Suggestions -->
                    <div x-show="showSuggestions && filteredSuggestions.length > 0" x-cloak class="bg-white border border-slate-200 rounded-xl shadow-lg p-2 mb-6">
                        <div class="text-sm text-slate-600 px-3 py-2 font-medium">Saran Pencarian:</div>
                        <template x-for="suggestion in filteredSuggestions.slice(0, 5)" :key="suggestion.title">
                            <a :href="suggestion.url" class="search-suggestion block px-3 py-2 rounded-lg text-left">
                                <div class="font-medium text-slate-900" x-text="suggestion.title"></div>
                                <div class="text-sm text-slate-600" x-text="suggestion.description"></div>
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mb-12" data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-[#128AEB] text-white font-semibold hover:bg-[#0F76C6] transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('sitemap') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-full border border-[#128AEB] text-[#128AEB] font-semibold hover:bg-[#128AEB]/5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        Lihat Peta Situs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('notFoundPage', () => ({
                searchQuery: '',
                showSuggestions: false,
                showSitemapModal: false,
                searchSuggestions: [
                    {
                        title: 'Jasa Pembuatan Website',
                        description: 'Website profesional dan modern untuk bisnis Anda',
                        url: '{{ route("services.web-development") }}'
                    },
                    {
                        title: 'Layanan Digital Marketing',
                        description: 'Strategi pemasaran digital untuk mengembangkan bisnis',
                        url: '{{ route("services.index") }}'
                    },
                    {
                        title: 'Konsultasi IT',
                        description: 'Konsultasi teknologi informasi untuk transformasi digital',
                        url: '{{ route("services.index") }}'
                    },
                    {
                        title: 'Mobile App Development',
                        description: 'Pengembangan aplikasi mobile iOS dan Android',
                        url: '{{ route("services.index") }}'
                    },
                    {
                        title: 'Kebijakan Privasi',
                        description: 'Informasi tentang perlindungan data pribadi',
                        url: '{{ route("legal.privacy") }}'
                    },
                    {
                        title: 'Ketentuan Layanan',
                        description: 'Syarat dan ketentuan penggunaan layanan',
                        url: '{{ route("legal.terms") }}'
                    }
                ],
                popularSearches: [
                    { text: 'Website Toko Online', url: '{{ route("services.web-development") }}' },
                    { text: 'Mobile App', url: '{{ route("services.index") }}' },
                    { text: 'Digital Marketing', url: '{{ route("services.index") }}' },
                    { text: 'Konsultasi', url: '{{ route("services.index") }}' },
                    { text: 'Tentang Kami', url: '#' }
                ],

                get filteredSuggestions() {
                    if (!this.searchQuery.trim()) return [];
                    
                    const query = this.searchQuery.toLowerCase();
                    return this.searchSuggestions.filter(suggestion => 
                        suggestion.title.toLowerCase().includes(query) ||
                        suggestion.description.toLowerCase().includes(query)
                    );
                },

                handleSearch() {
                    this.showSuggestions = this.searchQuery.trim().length > 0;
                },

                performSearch() {
                    if (this.searchQuery.trim()) {
                        // Redirect to search results page or handle search logic
                        window.location.href = `/search?q=${encodeURIComponent(this.searchQuery)}`;
                    }
                },

                openSitemap() {
                    window.open('{{ route("sitemap") }}', '_blank');
                }
            }));
        });
    </script>
@endsection
