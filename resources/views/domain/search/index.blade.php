@extends('partials.layouts.main')

@section('title', 'Pencarian Domain - Centrova')
@section('description', 'Cari dan daftarkan domain untuk website Anda dengan mudah. Dapatkan domain .com, .id, .co.id dan TLD lainnya dengan harga terbaik.')

@push('styles')
<style>
    [x-cloak] { display: none !important; }
    .domain-card:hover { transform: translateY(-2px); }
    .result-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1rem; }
    .tld-badge { transition: all 0.2s ease; }
    .tld-badge:hover { transform: scale(1.05); }
</style>
@endpush

@section('content')

<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white py-12" x-data="domainSearch()">
    
    <!-- Header Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-[#0B3C70] mb-6">
            Temukan Domain Sempurna Anda
        </h1>
        <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-8">
            Cari dan daftarkan domain untuk website Anda. Dapatkan domain berkualitas dengan harga terbaik dan dukungan penuh dari Centrova.
        </p>
    </div>

    <!-- Search Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form @submit.prevent="searchDomains()" class="space-y-6">
                
                <!-- Domain Input -->
                <div class="space-y-4">
                    <label for="domain" class="block text-sm font-semibold text-gray-900">
                        Masukkan nama domain yang diinginkan
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="domain"
                            x-model="searchTerm"
                            placeholder="contoh: bisnisku"
                            class="w-full px-6 py-4 text-lg border-2 border-gray-300 rounded-xl focus:border-[#128AEB] focus:ring-0 transition-colors"
                            required
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                            <span class="text-gray-400 text-lg">.com</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500">
                        Masukkan nama domain tanpa ekstensi (.com, .id, dll)
                    </p>
                </div>

                <!-- Popular TLDs -->
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-900">Ekstensi Domain Populer</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($popularTlds as $tld)
                        <label class="cursor-pointer">
                            <input 
                                type="checkbox" 
                                x-model="selectedTlds" 
                                value="{{ $tld->tld }}"
                                class="sr-only"
                            >
                            <div class="tld-badge px-4 py-2 rounded-lg border-2 transition-all" 
                                 :class="selectedTlds.includes('{{ $tld->tld }}') 
                                    ? 'border-[#128AEB] bg-[#128AEB] text-white' 
                                    : 'border-gray-300 bg-white text-gray-700 hover:border-[#128AEB]'">
                                <span class="font-medium">.{{ $tld->tld }}</span>
                                <span class="text-sm ml-2">{{ $tld->formatted_registration_price }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    <button 
                        type="button" 
                        @click="showAllTlds = !showAllTlds"
                        class="text-[#128AEB] text-sm font-medium hover:underline"
                    >
                        <span x-text="showAllTlds ? 'Sembunyikan' : 'Lihat semua ekstensi'"></span>
                    </button>
                </div>

                <!-- All TLDs (Hidden by default) -->
                <div x-show="showAllTlds" x-cloak class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-900">Semua Ekstensi Domain</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 max-h-60 overflow-y-auto">
                        @foreach($allTlds as $tld)
                        <label class="cursor-pointer">
                            <input 
                                type="checkbox" 
                                x-model="selectedTlds" 
                                value="{{ $tld->tld }}"
                                class="sr-only"
                            >
                            <div class="tld-badge px-3 py-2 rounded-lg border transition-all text-sm" 
                                 :class="selectedTlds.includes('{{ $tld->tld }}') 
                                    ? 'border-[#128AEB] bg-[#128AEB] text-white' 
                                    : 'border-gray-300 bg-white text-gray-700 hover:border-[#128AEB]'">
                                <div class="font-medium">.{{ $tld->tld }}</div>
                                <div class="text-xs">{{ $tld->formatted_registration_price }}</div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Search Button -->
                <button 
                    type="submit" 
                    :disabled="searching || !searchTerm.trim()"
                    class="w-full bg-[#128AEB] text-white font-semibold py-4 px-8 rounded-xl hover:bg-[#0f7bc4] disabled:opacity-50 disabled:cursor-not-allowed transition-all transform hover:scale-[1.02] active:scale-[0.98]"
                >
                    <span x-show="!searching" class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Domain
                    </span>
                    <span x-show="searching" class="flex items-center justify-center">
                        <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Mencari...
                    </span>
                </button>
            </form>
        </div>
    </div>

    <!-- Loading State -->
    <div x-show="searching" x-cloak class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
        <div class="inline-flex items-center justify-center space-x-2">
            <svg class="animate-spin w-8 h-8 text-[#128AEB]" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-lg font-medium text-gray-700">Mencari domain tersedia...</span>
        </div>
    </div>

    <!-- Results Section -->
    <div x-show="results.length > 0 && !searching" x-cloak class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Results Header -->
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                Hasil Pencarian untuk "<span x-text="lastSearchTerm" class="text-[#128AEB]"></span>"
            </h2>
            <p class="text-gray-600">
                Ditemukan <span x-text="results.length" class="font-semibold"></span> hasil
            </p>
        </div>

        <!-- Domain Results Grid -->
        <div class="result-grid mb-12">
            <template x-for="(result, index) in results" :key="index">
                <div class="domain-card bg-white rounded-xl shadow-lg overflow-hidden border-2 transition-all hover:shadow-xl"
                     :class="result.available ? 'border-green-200 hover:border-green-300' : 'border-red-200'">
                    
                    <!-- Domain Header -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900" x-text="result.domain"></h3>
                                <p class="text-sm text-gray-500" x-text="result.tld.toUpperCase() + ' Domain'"></p>
                            </div>
                            <div class="text-right">
                                <div x-show="result.available" class="flex items-center text-green-600">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium">Tersedia</span>
                                </div>
                                <div x-show="!result.available" class="flex items-center text-red-600">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium">Tidak Tersedia</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Domain Details -->
                    <div x-show="result.available && result.pricing" class="p-6">
                        <div class="space-y-4">
                            
                            <!-- Pricing -->
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Harga Registrasi</span>
                                <span class="text-xl font-bold text-[#128AEB]" x-text="result.pricing.formatted_registration"></span>
                            </div>
                            
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Harga Perpanjangan</span>
                                <span class="text-gray-700" x-text="result.pricing.formatted_renewal + '/tahun'"></span>
                            </div>

                            <!-- Duration Selection -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Durasi Registrasi</label>
                                <select x-model="result.selectedYears" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-[#128AEB] focus:ring-0">
                                    <template x-for="year in Array.from({length: result.pricing.max_years - result.pricing.min_years + 1}, (_, i) => i + result.pricing.min_years)" :key="year">
                                        <option :value="year" x-text="year + ' tahun - ' + formatPrice(result.pricing.registration * year)"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Privacy Protection -->
                            <div x-show="result.pricing.has_privacy" class="flex items-center space-x-3">
                                <input 
                                    type="checkbox" 
                                    :id="'privacy-' + index"
                                    x-model="result.privacyProtection"
                                    class="w-4 h-4 text-[#128AEB] border-gray-300 rounded focus:ring-[#128AEB]"
                                >
                                <label :for="'privacy-' + index" class="text-sm text-gray-700">
                                    Privacy Protection 
                                    <span class="text-gray-500" x-text="'(+' + formatPrice(result.pricing.privacy_price) + '/tahun)'"></span>
                                </label>
                            </div>

                            <!-- Add to Cart Button -->
                            <button 
                                @click="addToCart(result)"
                                :disabled="addingToCart[result.domain]"
                                class="w-full bg-[#128AEB] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#0f7bc4] disabled:opacity-50 disabled:cursor-not-allowed transition-all transform hover:scale-[1.02] active:scale-[0.98]"
                            >
                                <span x-show="!addingToCart[result.domain]">Tambah ke Keranjang</span>
                                <span x-show="addingToCart[result.domain]" class="flex items-center justify-center">
                                    <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Menambahkan...
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Unavailable Domain Info -->
                    <div x-show="!result.available" class="p-6">
                        <p class="text-gray-600 text-center">Domain ini sudah didaftarkan oleh pihak lain.</p>
                    </div>
                </div>
            </template>
        </div>

        <!-- Suggestions Section -->
        <div x-show="suggestions.length > 0" x-cloak class="mb-12">
            <div class="text-center mb-8">
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Saran Domain Alternatif</h3>
                <p class="text-gray-600">Domain alternatif yang mungkin menarik untuk Anda</p>
            </div>
            
            <div class="result-grid">
                <template x-for="(suggestion, index) in suggestions.slice(0, 6)" :key="'suggestion-' + index">
                    <div class="domain-card bg-white rounded-xl shadow-lg overflow-hidden border-2 border-blue-200 hover:border-blue-300 transition-all hover:shadow-xl">
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-bold text-gray-900" x-text="suggestion.domain"></h3>
                                    <div class="flex items-center text-green-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm font-medium">Tersedia</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Harga</span>
                                    <span class="text-lg font-bold text-[#128AEB]" x-text="suggestion.pricing.formatted_registration"></span>
                                </div>

                                <button 
                                    @click="addToCart(suggestion)"
                                    :disabled="addingToCart[suggestion.domain]"
                                    class="w-full bg-[#128AEB] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#0f7bc4] disabled:opacity-50 disabled:cursor-not-allowed transition-all text-sm"
                                >
                                    <span x-show="!addingToCart[suggestion.domain]">Tambah ke Keranjang</span>
                                    <span x-show="addingToCart[suggestion.domain]">Menambahkan...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- No Results -->
    <div x-show="searchPerformed && results.length === 0 && !searching" x-cloak class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Hasil</h3>
            <p class="text-gray-600">Coba gunakan kata kunci yang berbeda atau pilih lebih banyak ekstensi domain.</p>
        </div>
    </div>

    <!-- Cart Float Button -->
    <div x-show="cartCount > 0" x-cloak class="fixed bottom-6 right-6 z-50">
        <a href="{{ route('domain.cart.index') }}" 
           class="bg-[#128AEB] text-white p-4 rounded-full shadow-xl hover:bg-[#0f7bc4] transition-all transform hover:scale-110 group">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"></path>
                </svg>
                <span class="font-semibold hidden group-hover:block" x-text="cartCount"></span>
            </div>
            <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center" x-text="cartCount"></div>
        </a>
    </div>

</div>

@endsection

@push('scripts')
<script>
function domainSearch() {
    return {
        searchTerm: '',
        lastSearchTerm: '',
        selectedTlds: ['com', 'id', 'co.id'],
        showAllTlds: false,
        showAdvancedSearch: false,
        searching: false,
        searchPerformed: false,
        results: [],
        suggestions: [],
        cartCount: 0,
        addingToCart: {},
        popularQuickTlds: [
            { tld: '.com', formatted_registration_price: 'Rp 150.000' },
            { tld: '.id', formatted_registration_price: 'Rp 200.000' },
            { tld: '.co.id', formatted_registration_price: 'Rp 175.000' },
            { tld: '.net', formatted_registration_price: 'Rp 160.000' }
        ],

        init() {
            // Initialize cart count
            this.updateCartCount();
            
            // Set default selected years for results
            this.$watch('results', () => {
                this.results.forEach(result => {
                    if (!result.selectedYears && result.pricing) {
                        result.selectedYears = result.pricing.min_years;
                    }
                    if (result.privacyProtection === undefined) {
                        result.privacyProtection = false;
                    }
                });
            });
        },

        async searchDomains() {
            if (!this.searchTerm.trim()) return;

            this.searching = true;
            this.results = [];
            this.suggestions = [];

            try {
                console.log('Searching for:', this.searchTerm, 'TLDs:', this.selectedTlds);
                
                const response = await fetch('/domain/search', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        domain: this.searchTerm.trim(),
                        tlds: this.selectedTlds.length > 0 ? this.selectedTlds : ['com', 'id', 'net', 'org']
                    })
                });

                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                
                const data = await response.json();
                console.log('Response data:', data);

                if (data.success) {
                    this.results = data.results.map(result => ({
                        ...result,
                        selectedYears: result.pricing ? result.pricing.min_years : 1,
                        privacyProtection: false
                    }));
                    this.suggestions = data.suggestions || [];
                    this.lastSearchTerm = this.searchTerm;
                    
                    if (this.results.length === 0) {
                        this.showError('Tidak ada hasil ditemukan untuk pencarian Anda');
                    }
                } else {
                    this.showError(data.message || 'Terjadi kesalahan saat mencari domain');
                }
            } catch (error) {
                console.error('Search error:', error);
                this.showError(`Terjadi kesalahan jaringan: ${error.message}`);
            } finally {
                this.searching = false;
                this.searchPerformed = true;
            }
        },

        async quickSearch() {
            // Parse domain input - check if user entered full domain or just name
            let domainInput = this.searchTerm.trim();
            let searchName = '';
            let specificTlds = [];

            if (domainInput.includes('.')) {
                // User entered full domain like "bisnisku.com"
                const parts = domainInput.split('.');
                searchName = parts[0];
                const tld = '.' + parts.slice(1).join('.');
                specificTlds = [tld.replace('.', '')];
            } else {
                // User entered just name like "bisnisku"
                searchName = domainInput;
                specificTlds = ['com', 'id', 'co.id', 'net']; // Default popular TLDs
            }

            this.searchTerm = searchName;
            this.selectedTlds = specificTlds;
            await this.searchDomains();
        },

        async quickDomainSearch(tld) {
            if (!this.searchTerm.trim()) return;
            
            this.selectedTlds = [tld.replace('.', '')];
            await this.searchDomains();
        },

        async addToCart(domain) {
            if (this.addingToCart[domain.domain]) return;
            
            this.addingToCart[domain.domain] = true;

            try {
                const response = await fetch('/domain/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        domain: domain.domain,
                        years: domain.selectedYears || 1,
                        privacy_protection: domain.privacyProtection || false
                    })
                });

                const data = await response.json();

                if (data.success) {
                    this.cartCount = data.cart_count;
                    this.showSuccess(data.message);
                } else {
                    this.showError(data.message);
                }
            } catch (error) {
                console.error('Add to cart error:', error);
                this.showError('Terjadi kesalahan saat menambahkan ke keranjang');
            } finally {
                this.addingToCart[domain.domain] = false;
            }
        },

        async updateCartCount() {
            try {
                const response = await fetch('/domain/cart/count');
                const data = await response.json();
                if (data.success) {
                    this.cartCount = data.count;
                }
            } catch (error) {
                console.error('Cart count error:', error);
            }
        },

        formatPrice(amount) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
        },

        showSuccess(message) {
            // You can implement a toast notification here
            alert(message);
        },

        showError(message) {
            // You can implement a toast notification here
            alert(message);
        }
    }
}
</script>
@endpush
