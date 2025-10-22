@extends('partials.layouts.main')

@php
    // Set SEO for this page using the shared SEOService injected by the SEOServiceProvider
    if (isset($seoService)) {
        $seoService->setPageSEO([
            'title' => 'Aplikasi Bisnis - Centrova',
            'description' => 'Centrova Enterprise: Solusi terpadu untuk mengelola bisnis—dari CRM, ERP, POS hingga manajemen pelanggan. Mudah digunakan, aman, dan skalabel untuk semua ukuran bisnis.',
            'keywords' => ['aplikasi bisnis', 'CRM', 'ERP', 'POS', 'manajemen pelanggan', 'software bisnis', 'centrova'],
            // let SEOService use default image and current URL
        ]);

        // Expose some structured data to the layout (will be injected in the head)
        $organizationSchema = $seoService->addOrganizationSchema();
        $websiteSchema = $seoService->addWebsiteSchema();
    }
@endphp

@section('title', 'Aplikasi Bisnis - Centrova')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Main Hero - Improved Responsive Version -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 lg:py-20">
            <div class="text-center">
                <!-- Pre-title -->
                <p class="text-xl md:text-2xl lg:text-4xl font-semibold text-slate-900 mb-1 lg:mb-4">
                    Dengan Centrova Enterprise,
                </p>
                
                <!-- Main Title -->
                <h1 class="text-3xl sm:text-4xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-slate-900 leading-snug mb-6 lg:mb-8">
                    Ubah Cara Kelola Bisnis<br>
                    Jadi 
                    <span class="text-[#4285f4]">Lebih Mudah</span> 
                    dan 
                    <span class="text-[#34a853]">Cepat</span>
                </h1>

                <!-- Hero Image -->
                <div class="relative -mt-8 mb-2 mx-auto max-w-5xl">
                    <div class="aspect-video overflow-hidden">
                        <img 
                            src="https://images-bonnier.imgix.net/files/kom/production/2024/09/13162307/hero_2x-b0i95PPH7LM1OrDm12OGqw_xx5155.png?auto=compress,format" 
                            alt="Centrova Enterprise Dashboard" 
                            class="w-full h-full object-cover object-center"
                            loading="lazy"
                        >
                    </div>
                </div>

                <!-- Description -->
                <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-medium text-slate-700 max-w-4xl mx-auto leading-relaxed tracking-tight px-4">
                    Solusi terpadu untuk mengelola bisnis lebih efisien—dari kasir, laporan, hingga manajemen pelanggan, semua terintegrasi dalam satu platform modern yang mudah digunakan.
                </p>
            </div>
        </div>

        <!-- Featured Products Grid -->
        <div class="py-16" id="produk">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Layanan Web Development" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Pengembangan Perangkat Lunak</h3>
                            <p class="text-[18px] font-medium mb-2">Kami ahli dalam merancang solusi perangkat lunak berkualitas sesuai kebutuhan Anda.</p>
                            <a href="{{ route('services.index') }}" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <img src="https://images.unsplash.com/photo-1667984390553-7f439e6ae401?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Layanan App Development" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Infrastruktur</h3>
                            <p class="text-[18px] font-medium mb-2">Membangun infrastruktur TI yang kuat dan skalabel untuk mendukung bisnis Anda.</p>
                            <a href="/layanan/app-development" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <img src="https://plus.unsplash.com/premium_photo-1661429422690-f7dfe21d54c4?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Integrasi Sistem" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Dukungan</h3>
                            <p class="text-[18px] font-medium mb-2">Memberikan dukungan terbaik untuk memastikan operasional TI Anda berjalan dengan lancar.</p>
                            <a href="{{ route('support.home') }}" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <img src="https://images.unsplash.com/photo-1667372283545-1261fb5c427a?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Integrasi Sistem" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Keamanan Data</h3>
                            <p class="text-[18px] font-medium mb-2">Menjaga keamanan dan kerahasiaan data bisnis penting Anda.</p>
                            <a href="{{ route('legal.privacy') }}" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

        <!-- Features Section -->
        <section class="w-full overflow-hidden py-32 max-md:py-16 bg-white" id="fitur">
            <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center" 
                 data-aos="fade-up" 
                 data-aos-duration="700" 
                 data-aos-once="true" 
                 data-aos-offset="10">
                
                {{-- Heading --}}
                <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                        Kelola Semua Aspek Bisnis dalam Satu Platform
                    </h2>
                    <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                        Dari CRM hingga ERP, semua yang Anda butuhkan untuk mengembangkan bisnis
                    </p>
                </div>

                <div class="w-full mt-10 md:mt-16 grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
                    <div>
                        <div class="space-y-6 max-md:space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-900 mb-2">CRM Terintegrasi</h3>
                                    <p class="text-sm text-slate-600">Kelola hubungan pelanggan, otomatisasi penjualan, dan tingkatkan konversi dengan sistem CRM yang powerful</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-900 mb-2">ERP Lengkap</h3>
                                    <p class="text-sm text-slate-600">Sistem ERP komprehensif untuk manajemen inventory, keuangan, procurement, dan operasional bisnis</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Analitik & Reporting</h3>
                                    <p class="text-sm text-slate-600">Dashboard real-time dan laporan mendalam untuk pengambilan keputusan yang lebih baik</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-900 mb-2">Kustomisasi Mudah</h3>
                                    <p class="text-sm text-slate-600">Sesuaikan aplikasi dengan kebutuhan spesifik bisnis Anda tanpa coding yang rumit</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="bg-gradient-to-br from-[#128AEB] to-[#0F76C6] rounded-2xl p-8 text-white shadow-lg">
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                                <h3 class="text-xl font-bold mb-3">Platform Masa Depan</h3>
                                <p class="mb-4 text-sm">Centrova Enterprise terus berkembang dengan integrasi teknologi terkini:</p>
                                <ul class="space-y-2">
                                    <li class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Kecerdasan Buatan (AI) untuk analitik prediktif
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Cloud computing yang skalabel
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Integrasi perangkat keras IoT
                                    </li>
                                    <li class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Keamanan enterprise-grade
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

        {{-- CRM Features (Syahied) --}}
        <section class="w-full overflow-hidden py-32 max-md:py-16">
            <div>
                <h1 class="text-[8rem] font-medium text-center max-w-7xl mx-auto leading-[8rem] tracking-tight text-slate-900"><span class="text-amber-500">Built-in security.</span><br><span>That won’t clock out.</span></h1>
                <p class="text-xl font-medium text-neutral-500 mx-auto w-full max-w-5xl text-center mt-14">Apple hardware and software are designed together for advanced security that’s always on — without extra work. So it’s simpler to protect your employees, devices, and company data.</p>
            </div>
            <img src="https://www.apple.com/v/business/small-business/h/images/overview/security_lockup__rpior2xt02im_large.jpg" class="mx-auto mt-24">
            <div class="grid grid-cols-2 w-full mx-auto max-w-5xl gap-x-10 gap-y-20 mt-14 px-4 sm:px-6 md:px-8 ">
                {{-- card 1--}}
                <div class="w-full mx-auto border-t border-neutral-300 hover:border-[#128aeb] transition duration-300 p-5">
                    <h1 class="text-lg font-bold text-slate-900">Malware? Not here.</h1>
                    <p class="text-lg font-medium text-neutral-600">XProtect is built in to detect and remove viruses and malware, while Gatekeeper and app notarization keep you and your colleagues from installing malicious software by accident.</p>
                </div>
                <div class="w-full mx-auto border-t border-neutral-300 hover:border-[#128aeb] transition duration-300 p-5">
                    <h1 class="text-lg font-bold text-slate-900">Malware? Not here.</h1>
                    <p class="text-lg font-medium text-neutral-600">XProtect is built in to detect and remove viruses and malware, while Gatekeeper and app notarization keep you and your colleagues from installing malicious software by accident.</p>
                </div>
                <div class="w-full mx-auto border-t border-neutral-300 hover:border-[#128aeb] transition duration-300 p-5">
                    <h1 class="text-lg font-bold text-slate-900">Malware? Not here.</h1>
                    <p class="text-lg font-medium text-neutral-600">XProtect is built in to detect and remove viruses and malware, while Gatekeeper and app notarization keep you and your colleagues from installing malicious software by accident.</p>
                </div>
                <div class="w-full mx-auto border-t border-neutral-300 hover:border-[#128aeb] transition duration-300 p-5">
                    <h1 class="text-lg font-bold text-slate-900">Malware? Not here.</h1>
                    <p class="text-lg font-medium text-neutral-600">XProtect is built in to detect and remove viruses and malware, while Gatekeeper and app notarization keep you and your colleagues from installing malicious software by accident.</p>
                </div>
            </div>
        </section>

        <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

        <!-- Industry Solutions -->
        <section class="w-full overflow-hidden py-32 max-md:py-16">
            <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center" 
                 data-aos="fade-up" 
                 data-aos-duration="700" 
                 data-aos-once="true" 
                 data-aos-offset="10">
                
                {{-- Heading --}}
                <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                        Cocok untuk Berbagai Jenis Bisnis
                    </h2>
                    <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                        Dari UMKM hingga perusahaan besar, Centrova Enterprise siap mendukung pertumbuhan bisnis Anda
                    </p>
                </div>

                <div class="w-full mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <div class="px-6 py-6 pb-6 text-center">
                            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-slate-900 mb-2">UMKM & Retail</h3>
                            <p class="text-sm text-slate-600">Solusi point of sale, inventory, dan CRM untuk toko retail modern</p>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <div class="px-6 py-6 pb-6 text-center">
                            <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-slate-900 mb-2">Restoran & F&B</h3>
                            <p class="text-sm text-slate-600">Sistem manajemen restoran dengan kitchen display dan online ordering</p>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <div class="px-6 py-6 pb-6 text-center">
                            <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-slate-900 mb-2">Perusahaan Menengah</h3>
                            <p class="text-sm text-slate-600">ERP lengkap dengan modul SDM, keuangan, dan project management</p>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <div class="px-6 py-6 pb-6 text-center">
                            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-semibold text-slate-900 mb-2">Korporasi</h3>
                            <p class="text-sm text-slate-600">Solusi enterprise dengan multi-company, multi-currency, dan konsolidasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

        <!-- Applications Suite Section -->
        <section class="w-full overflow-hidden py-32 max-md:py-16 bg-white">
            <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center" 
                 data-aos="fade-up" 
                 data-aos-duration="700" 
                 data-aos-once="true" 
                 data-aos-offset="10">
                
                {{-- Heading --}}
                <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                        Jelajahi Aplikasi Suite Bisnis Kami
                    </h2>
                    <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                        Pilih aplikasi yang sesuai dengan kebutuhan bisnis Anda atau gunakan semuanya dalam satu platform terintegrasi
                    </p>
                </div>

                <div class="w-full mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{ route('products.business.crm') }}" class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow-lg hover:border-[#128AEB] transition-all duration-150 group">
                        <div class="px-6 py-6 pb-6">
                            <div class="w-12 h-12 bg-blue-50 group-hover:bg-blue-100 rounded-xl flex items-center justify-center mb-4 transition-colors">
                                <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2 group-hover:text-[#128AEB] transition-colors">CRM</h3>
                            <p class="text-sm text-slate-600 mb-3">Customer Relationship Management untuk mengelola hubungan pelanggan dan meningkatkan penjualan</p>
                            <span class="inline-flex items-center text-[#128AEB] font-medium text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>

                    <a href="{{ route('products.business.sales') }}" class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow-lg hover:border-[#34a853] transition-all duration-150 group">
                        <div class="px-6 py-6 pb-6">
                            <div class="w-12 h-12 bg-green-50 group-hover:bg-green-100 rounded-xl flex items-center justify-center mb-4 transition-colors">
                                <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2 group-hover:text-[#34a853] transition-colors">Sales</h3>
                            <p class="text-sm text-slate-600 mb-3">Sales Management System untuk mengelola pipeline penjualan dan meningkatkan closing rate</p>
                            <span class="inline-flex items-center text-[#34a853] font-medium text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>

                    <a href="{{ route('products.business.erp') }}" class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow-lg hover:border-[#8e44ad] transition-all duration-150 group">
                        <div class="px-6 py-6 pb-6">
                            <div class="w-12 h-12 bg-purple-50 group-hover:bg-purple-100 rounded-xl flex items-center justify-center mb-4 transition-colors">
                                <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2 group-hover:text-[#8e44ad] transition-colors">ERP</h3>
                            <p class="text-sm text-slate-600 mb-3">Enterprise Resource Planning untuk mengelola seluruh operasional bisnis secara terintegrasi</p>
                            <span class="inline-flex items-center text-[#8e44ad] font-medium text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>

                    <a href="{{ route('products.business.pos') }}" class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow-lg hover:border-[#f39c12] transition-all duration-150 group">
                        <div class="px-6 py-6 pb-6">
                            <div class="w-12 h-12 bg-orange-50 group-hover:bg-orange-100 rounded-xl flex items-center justify-center mb-4 transition-colors">
                                <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2 group-hover:text-[#f39c12] transition-colors">POS</h3>
                            <p class="text-sm text-slate-600 mb-3">Point of Sale System modern untuk transaksi cepat dan manajemen kasir yang efisien</p>
                            <span class="inline-flex items-center text-[#f39c12] font-medium text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>

                    <a href="{{ route('products.business.rental') }}" class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow-lg hover:border-[#ea4335] transition-all duration-150 group">
                        <div class="px-6 py-6 pb-6">
                            <div class="w-12 h-12 bg-red-50 group-hover:bg-red-100 rounded-xl flex items-center justify-center mb-4 transition-colors">
                                <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2 group-hover:text-[#ea4335] transition-colors">Rental</h3>
                            <p class="text-sm text-slate-600 mb-3">Rental Management System untuk mengelola bisnis rental dengan booking dan tracking aset</p>
                            <span class="inline-flex items-center text-[#ea4335] font-medium text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-gradient-to-br from-[#128AEB] to-[#0F76C6] text-white border border-neutral-200 flex items-center justify-center">
                        <div class="px-6 py-6 pb-6 text-center">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Aplikasi Lainnya</h3>
                            <p class="text-sm mb-3 text-white/90">Lebih banyak aplikasi akan segera hadir untuk melengkapi ekosistem bisnis Anda</p>
                            <span class="inline-flex items-center font-medium text-sm text-white/90">
                                Segera Hadir
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection