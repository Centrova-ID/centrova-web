{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Jasa Pembuatan Website E-Commerce Toko Online Murah & Profesional | Centrova.id')

{{-- Navbar --}}
@section('navbar')
    {{-- Navbar --}}
    @include('partials.navbar.services-web')
@endsection

{{-- SEO & Meta Tags --}}
@section('seoMetaTags')
    @include('partials.seo.service-page', [
        'service_name' => 'Jasa Pembuatan Website E-Commerce Toko Online',
        'service_description' => 'Layanan pembuatan website e-commerce toko online profesional dengan sistem pembayaran lengkap, manajemen produk, dan optimasi SEO',
        'service_price' => '4049000',
        'service_category' => 'E-Commerce Development',
        'service_keywords' => 'jasa pembuatan website e-commerce, toko online murah, website ecommerce profesional, jasa toko online, pembuatan web ecommerce, desain website toko online, ecommerce murah, jasa web development, website marketplace, centrova',
        'title' => 'Jasa Pembuatan Website E-Commerce Toko Online Murah & Profesional | Centrova.id',
        'description' => 'Jasa pembuatan website e-commerce toko online murah & profesional. Sistem pembayaran lengkap, manajemen produk, SEO ready. Harga mulai 4jt. Konsultasi gratis! ☎️ 085817909560',
        'canonical_url' => config('app.url') . '/services/web/showcase/ecommerce',
        'og_image' => config('app.url') . '/assets/image/services/web-development/ecommerce/og-image.jpg',
        'preload_data' => '/data/services-data.json',
        'prefetch_urls' => [
            config('app.url') . '/services',
            config('app.url') . '/contact'
        ],
        'breadcrumbs' => [
            ['name' => 'Home', 'url' => config('app.url')],
            ['name' => 'Services', 'url' => config('app.url') . '/services'],
            ['name' => 'Web Development', 'url' => config('app.url') . '/services/web-development'],
            ['name' => 'E-Commerce Website', 'url' => config('app.url') . '/services/web/showcase/ecommerce']
        ],
        'faq_data' => [
            [
                'question' => 'Berapa harga jasa pembuatan website e-commerce toko online?',
                'answer' => 'Harga jasa pembuatan website e-commerce mulai dari Rp 4.049.000 dengan fitur lengkap, sistem pembayaran, manajemen produk, dan optimasi SEO.'
            ],
            [
                'question' => 'Berapa lama proses pembuatan website e-commerce?',
                'answer' => 'Proses pembuatan website e-commerce membutuhkan waktu 7-14 hari kerja tergantung kompleksitas dan jumlah fitur yang dibutuhkan.'
            ],
            [
                'question' => 'Apakah website e-commerce sudah terintegrasi dengan payment gateway?',
                'answer' => 'Ya, website e-commerce kami sudah terintegrasi dengan berbagai payment gateway seperti Midtrans, Xendit, dan metode pembayaran lokal lainnya.'
            ],
            [
                'question' => 'Apakah ada fitur manajemen stok dan inventori?',
                'answer' => 'Ya, website e-commerce dilengkapi dengan sistem manajemen stok otomatis, tracking inventori, dan notifikasi stok menipis.'
            ],
            [
                'question' => 'Apakah bisa menambahkan fitur marketplace seperti multi-vendor?',
                'answer' => 'Ya, kami bisa mengembangkan fitur marketplace dengan sistem multi-vendor, komisi otomatis, dan dashboard terpisah untuk setiap penjual.'
            ]
        ]
    ])
@endsection

{{-- External CSS --}}
@section('style-css')
    <link rel="stylesheet" href="{{ asset('css/ecommerce.css') }}">
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="w-full bg-white pt-32 max-md:pt-16">
        <div class="w-full max-w-6xl mx-auto px-4">
            <div 
                class="w-full max-w-6xl mx-auto flex flex-col items-center justify-center text-center" 
                data-aos="fade-up" 
                data-aos-duration="700" 
                data-aos-once="true" 
                data-aos-offset="10"
            >
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold text-slate-900 leading-tight">
                  Jasa Website <span class="text-[#128AEB]">E-Commerce Toko Online</span> Murah dan Profesional!
                </h1>
                <p class="text-sm sm:text-base md:text-lg max-w-3xl my-7 text-slate-700">
                    Bangun toko online impian Anda dengan fitur lengkap, sistem pembayaran terintegrasi, dan manajemen produk yang mudah. Mulai jualan online hari ini juga!
                </p>

                <div class="flex items-center gap-x-5 mt-5">
                    <a href="https://wa.me/6285817909560?text=Halo%20Centrova,%20saya%20tertarik%20dengan%20jasa%20pembuatan%20website%20e-commerce%20toko%20online.%20Bisakah%20kita%20diskusi%20lebih%20lanjut?" target="_blank" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-medium px-7 py-3.5 rounded-full transition flex items-center text-base justify-center">Pesan Sekarang</a>
                    <a href="#packages" class="bg-transparent hover:bg-[#0f75c6] text-[#128AEB] hover:text-white font-medium px-7 py-3.5 rounded-full border-2 border-[#128AEB] hover:border-[#0f75c6] transition flex items-center text-base justify-center">Lihat Paket</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Showcase Frames Section --}}
    <section class="w-full bg-white overflow-x-hidden pt-32 pb-20 max-md:py-16">
        <div class="w-full max-w-7xl mx-auto">

            <!-- Animated Frames Container -->
            <div class="relative overflow-visible" x-data="showcaseFrames" x-init="init()">
                <!-- Desktop View -->
                <div class="hidden lg:flex gap-6 transition-transform duration-300 ease-out justify-center items-center min-h-[500px]" 
                     :style="'transform: translateX(' + scrollOffset + 'px)'">
                    
                    <!-- Frame 1 - Desktop E-commerce -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-video w-auto rounded-xl">
                        <img src="{{ asset('assets/image/services/web-development/ecommerce/desktop-1.png') }}" class="w-full h-full object-cover object-top" alt="E-commerce Desktop View 1">
                    </div>

                    <!-- Frame 2 - Mobile E-commerce -->
                    <div id="frame-2" class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-[9/16] w-auto rounded-xl transition-transform duration-500 ease-out"
                         :style="'transform: translateY(' + frame2Offset + 'px)'">
                        <img src="{{ asset('assets/image/services/web-development/ecommerce/mobile-1.png') }}" class="w-full h-full object-cover object-top" alt="E-commerce Mobile View 1">
                    </div>

                    <!-- Frame 3 - Desktop E-commerce -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-video w-auto rounded-xl">
                        <img src="{{ asset('assets/image/services/web-development/ecommerce/desktop-2.png') }}" class="w-full h-full object-cover object-top" alt="E-commerce Desktop View 2">
                    </div>

                    <!-- Frame 4 - Mobile E-commerce -->
                    <div id="frame-4" class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-[9/16] w-auto rounded-xl transition-transform duration-500 ease-out"
                         :style="'transform: translateY(' + frame4Offset + 'px)'">
                        <img src="{{ asset('assets/image/services/web-development/ecommerce/mobile-2.png') }}" class="w-full h-full object-cover object-top" alt="E-commerce Mobile View 2">
                    </div>

                    <!-- Frame 5 - Desktop E-commerce -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-video w-auto rounded-xl">
                        <img src="{{ asset('assets/image/services/web-development/ecommerce/desktop-3.png') }}" class="w-full h-full object-cover object-top" alt="E-commerce Desktop View 3">
                    </div>

                </div>

                <!-- Mobile View - 3 frames: desktop, mobile (center), desktop -->
                <div class="lg:hidden flex justify-center items-center min-h-[500px] overflow-hidden">
                    <!-- Left Desktop Frame (partial view) -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[280px] aspect-video w-auto rounded-xl opacity-40 -translate-x-5">
                        <img src="{{ asset('assets/image/services/web-development/ecommerce/desktop-3.png') }}" class="w-full h-full object-cover object-top" alt="E-commerce Desktop View">
                    </div>

                    <!-- Center Mobile Frame (main focus) -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[480px] aspect-[9/16] w-auto rounded-xl shadow-lg z-10">
                        <img src="{{ asset('assets/image/services/web-development/ecommerce/mobile-main.png') }}" class="w-full h-full object-cover object-top" alt="E-commerce Mobile Main View">
                    </div>

                    <!-- Right Desktop Frame (partial view) -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[280px] aspect-video w-auto rounded-xl opacity-40 translate-x-5">
                        <img src="{{ asset('assets/image/services/web-development/ecommerce/desktop-1.png') }}" class="w-full h-full object-cover object-top" alt="E-commerce Desktop View">
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        @once
        <script src="{{ asset('js/pages/services/web/showcase/ecommerce/showcase-frames.js') }}"></script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Features Section with E-commerce Focus --}}
    <section class="w-full bg-white py-20 max-md:py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="text-center mb-16 max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    Kenapa Memilih Website E-Commerce <span class="text-[#128AEB]">Centrova</span>?
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Lebih dari sekadar toko online, kami menciptakan platform e-commerce yang mengubah cara Anda berbisnis
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
                <!-- Feature 1 - Payment Gateway -->
                <div class="bg-[#128AEB] p-8 rounded-[32px] text-white relative overflow-hidden min-h-[640px] group" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-100 font-medium uppercase text-base mb-4">Payment Gateway</p>
                        <h3 class="text-4xl font-bold mb-6">Sistem pembayaran lengkap dengan berbagai metode pembayaran</h3>
                        
                        <!-- Payment Methods Illustration -->
                        <div class="mt-8 grid grid-cols-3 gap-4">
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">💳</div>
                                <div class="text-xs">Credit Card</div>
                            </div>
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">🏦</div>
                                <div class="text-xs">Bank Transfer</div>
                            </div>
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">📱</div>
                                <div class="text-xs">E-Wallet</div>
                            </div>
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">🏪</div>
                                <div class="text-xs">Minimarket</div>
                            </div>
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">💰</div>
                                <div class="text-xs">COD</div>
                            </div>
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">⚡</div>
                                <div class="text-xs">Instant</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                </div>

                <!-- Feature 2 - Product Management -->
                <div class="bg-[#128AEB]/10 p-8 rounded-[32px] relative overflow-hidden min-h-[640px]" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-500 font-medium uppercase text-base mb-4">Manajemen Produk</p>
                        <h3 class="text-4xl font-bold text-gray-900 mb-6">Kelola ribuan produk dengan mudah dan otomatis</h3>
                        
                        <!-- Product Management Features -->
                        <div class="space-y-4 mt-8">
                            <div class="flex items-center gap-3 bg-white p-4 rounded-lg border">
                                <div class="w-10 h-10 bg-[#128AEB]/20 rounded-lg flex items-center justify-center">
                                    <span class="text-[#128AEB] font-bold">📦</span>
                                </div>
                                <div>
                                    <div class="font-medium text-slate-900">Manajemen Stok</div>
                                    <div class="text-sm text-slate-600">Tracking otomatis & notifikasi</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 bg-white p-4 rounded-lg border">
                                <div class="w-10 h-10 bg-[#128AEB]/20 rounded-lg flex items-center justify-center">
                                    <span class="text-[#128AEB] font-bold">🏷️</span>
                                </div>
                                <div>
                                    <div class="font-medium text-slate-900">Kategori & Varian</div>
                                    <div class="text-sm text-slate-600">Organisasi produk yang rapi</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 bg-white p-4 rounded-lg border">
                                <div class="w-10 h-10 bg-[#128AEB]/20 rounded-lg flex items-center justify-center">
                                    <span class="text-[#128AEB] font-bold">💰</span>
                                </div>
                                <div>
                                    <div class="font-medium text-slate-900">Harga & Diskon</div>
                                    <div class="text-sm text-slate-600">Sistem promosi fleksibel</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#128AEB] bg-opacity-5 rounded-full"></div>
                </div>

                <!-- Feature 3 - Order Management -->
                <div class="bg-white p-8 rounded-[32px] relative overflow-hidden min-h-[640px] border border-slate-300" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-500 font-medium uppercase text-base mb-4">Order Management</p>
                        <h3 class="text-4xl font-bold text-gray-900 mb-6">Kelola pesanan dari order hingga pengiriman</h3>
                        
                        <!-- Order Flow -->
                        <div class="mt-8">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-8 h-8 bg-[#128AEB] rounded-full flex items-center justify-center text-white text-sm font-bold">1</div>
                                <div class="flex-1 h-1 bg-[#128AEB] mx-2"></div>
                                <div class="w-8 h-8 bg-[#128AEB] rounded-full flex items-center justify-center text-white text-sm font-bold">2</div>
                                <div class="flex-1 h-1 bg-[#128AEB] mx-2"></div>
                                <div class="w-8 h-8 bg-[#128AEB] rounded-full flex items-center justify-center text-white text-sm font-bold">3</div>
                                <div class="flex-1 h-1 bg-[#128AEB] mx-2"></div>
                                <div class="w-8 h-8 bg-[#128AEB] rounded-full flex items-center justify-center text-white text-sm font-bold">4</div>
                            </div>
                            <div class="grid grid-cols-4 gap-2 text-center text-sm">
                                <div>Order Masuk</div>
                                <div>Pembayaran</div>
                                <div>Proses</div>
                                <div>Kirim</div>
                            </div>
                        </div>

                        <div class="mt-8 text-center">
                            <p class="text-gray-600 text-sm">Tracking otomatis untuk customer & admin</p>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#128AEB] bg-opacity-5 rounded-full"></div>
                </div>

                <!-- Feature 4 - Analytics & Reports -->
                <div class="bg-[#0e63a8] p-8 rounded-[32px] text-white relative overflow-hidden min-h-[640px]" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-100 font-medium uppercase text-base mb-4">Analytics & Reports</p>
                        <h3 class="text-4xl font-bold mb-6">Laporan penjualan dan analisis bisnis real-time</h3>
                        
                        <!-- Analytics Dashboard Mock -->
                        <div class="mt-8 space-y-4">
                            <div class="bg-white/10 rounded-lg p-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm">Total Penjualan</span>
                                    <span class="text-green-300">+15%</span>
                                </div>
                                <div class="text-2xl font-bold">Rp 125.000.000</div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white/10 rounded-lg p-4">
                                    <div class="text-sm mb-1">Orders</div>
                                    <div class="text-xl font-bold">1,234</div>
                                </div>
                                <div class="bg-white/10 rounded-lg p-4">
                                    <div class="text-sm mb-1">Customers</div>
                                    <div class="text-xl font-bold">856</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <p class="text-white/80 text-sm">Dashboard analytics lengkap untuk monitoring bisnis</p>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Why Need E-commerce Section --}}
    <section class="w-full bg-white py-20 max-md:py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="text-center mb-16 max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    Kenapa Bisnis Anda Butuh Website E-Commerce?
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Era digital mengharuskan bisnis untuk go online. Jangan sampai kompetitor Anda lebih dulu meraih keuntungan dari penjualan online!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Problem Card -->
                <div class="bg-red-50 p-8 rounded-[32px] relative overflow-hidden group" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                    <div class="relative z-10 md:p-8">
                        <p class="text-red-600 font-medium uppercase text-base mb-4">Tanpa E-Commerce</p>
                        <h3 class="text-4xl text-red-950 font-bold mb-6">Bisnis Anda Kehilangan Jutaan Rupiah!</h3>
                        
                        <div class="space-y-4 mt-8">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-950">Terbatas pada customer lokal dan jam operasional</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-950">Kehilangan potensi penjualan hingga 70% dari online market</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-950">Sulit bersaing dengan marketplace besar</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-950">Tidak ada data analisis customer dan penjualan</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                </div>

                <!-- Solution Card -->
                <div class="bg-[#128AEB]/10 p-8 rounded-[32px] text-white relative overflow-hidden group" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-500 font-medium uppercase text-base mb-4">Dengan E-Commerce</p>
                        <h3 class="text-4xl text-slate-900 font-bold mb-6">Omzet Bisnis Meningkat Hingga 300%!</h3>
                        
                        <div class="space-y-4 mt-8">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-slate-900">Buka 24/7, jangkauan customer seluruh Indonesia</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-slate-900">Otomatisasi penjualan dan manajemen stok</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-slate-900">Data analytics untuk optimasi bisnis</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-slate-900">Brand awareness dan customer loyalty meningkat</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 py-6 gap-8 max-w-5xl w-full mx-auto">
                <div class="px-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600">
                    <div class="text-5xl font-bold text-[#128AEB] mb-3 w-full flex md:justify-center flex-shrink-0">87%</div>
                    <div class="md:text-center">
                        <h4 class="text-xl font-semibold text-slate-900">Belanja Online</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Consumer Indonesia lebih memilih berbelanja online karena kemudahan dan variasi produk yang lebih banyak
                        </p>
                    </div>
                </div>
                
                <div class="px-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700">
                    <div class="text-5xl font-bold text-[#128AEB] mb-3 w-full flex md:justify-center flex-shrink-0">3x</div>
                    <div class="md:text-center">
                        <h4 class="text-xl font-semibold text-slate-900">Peningkatan Omzet</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Bisnis dengan website e-commerce mengalami peningkatan omzet hingga 3 kali lipat dibanding hanya offline
                        </p>
                    </div>
                </div>
                
                <div class="px-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
                    <div class="text-5xl font-bold text-[#128AEB] mb-3 w-full flex md:justify-center flex-shrink-0">24/7</div>
                    <div class="md:text-center">
                        <h4 class="text-xl font-semibold text-slate-900">Penjualan Nonstop</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Toko online Anda bisa menerima orderan 24 jam sehari, 7 hari seminggu tanpa perlu tenaga tambahan
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Service Packages Section --}}
    <section class="w-full bg-white py-20 max-md:py-16" x-data="packagesSection" id="packages">
        <div class="w-full max-w-6xl mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    Paket Jasa Website <span class="text-[#128AEB]">E-Commerce</span>
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Pilih paket yang sesuai dengan skala bisnis Anda, dari toko online sederhana hingga marketplace lengkap
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <template x-for="(pkg, index) in packages" :key="index">
                    <div class="bg-white border-2 rounded-3xl p-8 transition-colors relative flex flex-col justify-between" :class="{'border-[#128AEB] shadow-lg shadow-sky-200': pkg.popular, 'border-neutral-200': !pkg.popular}" data-aos="fade-up" data-aos-duration="700" :data-aos-delay="(index + 1) * 100">
                        <div>
                            <!-- Popular Badge -->
                            <div x-show="pkg.popular" class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                <span class="bg-[#128AEB] text-white px-4 py-1 rounded-full text-sm font-medium">Paling Populer</span>
                            </div>

                            <div class="text-center mb-8">
                                <h3 class="text-2xl font-bold text-slate-900 mb-2" x-text="pkg.name"></h3>
                                <p class="text-slate-600 mb-4" x-text="pkg.description"></p>
                                <div class="mb-4">
                                    <div class="text-4xl font-bold text-[#128AEB] mb-1" x-text="pkg.price"></div>
                                    <div class="text-sm text-slate-500" x-text="pkg.renewalPrice"></div>
                                </div>
                                <p class="text-sm text-slate-500" x-text="pkg.duration"></p>
                            </div>

                            <ul class="space-y-3 mb-8">
                                <template x-for="feature in pkg.features" :key="feature">
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-slate-700" x-text="feature"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <button 
                            class="w-full py-3 rounded-full font-semibold transition duration-150"
                            :class="pkg.popular ? 'bg-gradient-to-br from-yellow-500 to-amber-500 hover:shadow-lg hover:shadow-yellow-200 text-white' : 'border-2 border-[#128AEB] text-[#128AEB] hover:bg-[#128AEB] hover:text-white'"
                            @click="selectPackage(pkg.name)"
                        >
                            Pilih Paket
                        </button>
                    </div>
                </template>
            </div>
        </div>

        @push('scripts')
        @once
        <script src="{{ asset('js/pages/services/web/showcase/ecommerce/packages-section.js') }}"></script>
        @endonce
        @endpush
    </section>

    {{-- FAQ Section --}}
    <section class="py-20 max-md:py-16 bg-neutral-50" x-data="faqSection">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto">
          <h3 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
              Pertanyaan yang Sering Diajukan
          </h3>
        </div>

        <div>
          <template x-for="(faq, index) in faqs" :key="index">
            <div class="py-0 border-b border-neutral-300 focus-within:border-b-2 focus-within:border-[#128AEB] transition">
              <!-- Button -->
              <button 
                @click="toggleFaq(index)"
                class="w-full py-4 text-left flex items-center justify-between focus:z-20 my-0.5 transition-colors gap-2"
              >
                <span class="font-semibold text-sky-700 text-xl sm:text-2xl leading-snug sm:leading-normal flex-wrap sm:flex-nowrap max-w-[80%]" x-text="faq.question"></span>
                <svg 
                  class="w-6 h-6 text-sky-700 transform transition-transform duration-200" 
                  :class="openFaq === index ? 'rotate-180' : ''" 
                  fill="none" stroke="currentColor" viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>

              <!-- Answer -->
              <div 
                class="overflow-hidden will-change-transform will-change-opacity will-change-scroll-position transition-all duration-300"
                :style="openFaq === index ? 'max-height: 200px; opacity: 1;' : 'max-height: 0; opacity: 0;'"
              >
                <div class="pb-4 text-gray-700 leading-relaxed" x-text="faq.answer"></div>
              </div>
            </div>
          </template>
        </div>
      </div>
      @push('scripts')
      @once
      <script src="{{ asset('js/pages/services/web/showcase/ecommerce/faq-section.js') }}"></script>
      @endonce
      @endpush
    </section>

    {{-- Floating WhatsApp Button --}}
    <a href="https://wa.me/6285817909560?text=Halo%20Centrova,%20saya%20tertarik%20dengan%20jasa%20pembuatan%20website%20e-commerce%20toko%20online.%20Bisa%20kita%20diskusi?" target="_blank" class="floating-wa" title="Chat WhatsApp">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.488" fill="white"/>
        </svg>
    </a>

    {{-- Master JavaScript Loader --}}
    @push('scripts')
    @once
    <script src="{{ asset('js/pages/services/web/showcase/ecommerce/ecommerce-master.js') }}"></script>
    @endonce
    @endpush
@endsection
