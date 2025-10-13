@extends('partials.layouts.main')

@section('title', 'Centrova Sales - Sales Management System')

@section('content')
<!-- Hero Section -->
<div class="relative">
    <!-- Main Hero -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 lg:py-20">
        <div class="text-center">
            <!-- Pre-title -->
            <p class="text-xl md:text-2xl lg:text-3xl font-semibold text-slate-900 mb-1 lg:mb-4">
                Maksimalkan Performa Sales Team Anda
            </p>
            
            <!-- Main Title -->
            <h1 class="text-3xl sm:text-4xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-slate-900 leading-snug mb-6 lg:mb-8">
                Centrova <span class="text-[#128AEB]">Sales</span><br>
                Sales Management System
            </h1>

            <!-- Description -->
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-medium text-slate-700 max-w-4xl mx-auto leading-relaxed tracking-tight px-4">
                Platform penjualan all-in-one untuk mengelola lead, opportunity, dan closing deal dengan lebih efisien.
            </p>
        </div>
    </div>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Key Features Section -->
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center" 
             data-aos="fade-up" 
             data-aos-duration="700" 
             data-aos-once="true" 
             data-aos-offset="10">
            
            {{-- Heading --}}
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Fitur Utama Centrova Sales
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Tools lengkap untuk mendorong pertumbuhan penjualan bisnis Anda
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Sales Pipeline</h3>
                        <p class="text-sm text-slate-600">Visualisasi tahapan penjualan dengan kanban board, drag-drop deals, dan forecast revenue akurat</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Lead Management</h3>
                        <p class="text-sm text-slate-600">Capture leads otomatis dari berbagai channel, lead scoring, dan auto-assignment ke sales rep</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Quotation & Proposal</h3>
                        <p class="text-sm text-slate-600">Buat penawaran profesional dengan template, product catalog, pricing rules, dan e-signature</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Sales Analytics</h3>
                        <p class="text-sm text-slate-600">Dashboard analytics lengkap dengan conversion funnel, win/loss analysis, dan sales performance metrics</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Sales Automation</h3>
                        <p class="text-sm text-slate-600">Otomatis follow-up reminder, email sequences, task assignment, dan workflow approval</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#4a5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Commission Tracking</h3>
                        <p class="text-sm text-slate-600">Hitung komisi sales otomatis dengan berbagai aturan, target achievement, dan bonus calculation</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Benefits Section -->
    <section class="w-full overflow-hidden py-32 max-md:py-16 bg-white">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Keunggulan Centrova Sales
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Tingkatkan closing rate dan produktivitas sales team hingga 2x lipat
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
                <div>
                    <div class="space-y-6 max-md:space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Closing Rate +40%</h3>
                                <p class="text-sm text-slate-600">Systematic follow-up dan data-driven approach meningkatkan win rate secara konsisten</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Produktivitas x2</h3>
                                <p class="text-sm text-slate-600">Automation mengurangi admin task, sales team fokus ke aktivitas yang revenue-generating</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Real-time Visibility</h3>
                                <p class="text-sm text-slate-600">Manager dapat monitor sales activity dan performance secara real-time dari dashboard</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Forecast Akurat</h3>
                                <p class="text-sm text-slate-600">AI-powered forecast membantu perencanaan inventory dan cash flow yang lebih baik</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-br from-[#128AEB] to-[#0F76C6] rounded-2xl p-8 text-white shadow-lg">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                            <h3 class="text-xl font-bold mb-3">Mobile Sales App</h3>
                            <p class="mb-4 text-sm">Sales team tetap produktif di mana saja dengan mobile app:</p>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Update deal status on-the-go
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Log visit & meeting notes instantly
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Send quotation via WhatsApp
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    GPS check-in untuk field sales
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Offline mode untuk area tanpa internet
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- CTA Section -->
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 md:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-4">
                Tingkatkan Performa Sales Team Sekarang
            </h2>
            <p class="text-base sm:text-lg text-slate-600 mb-8 max-w-2xl mx-auto">
                Dapatkan demo Centrova Sales dan lihat bagaimana platform kami dapat meningkatkan revenue bisnis Anda
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150">
                    Request Demo
                </a>
                <a href="{{ route('products.business.index') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#128AEB] text-base font-medium rounded-full text-[#128AEB] hover:bg-[#128AEB] hover:text-white transition duration-150">
                    Lihat Aplikasi Lainnya
                </a>
            </div>
        </div>
    </section>
</div>

@endsection
