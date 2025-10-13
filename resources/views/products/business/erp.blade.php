@extends('partials.layouts.main')

@section('title', 'Centrova ERP - Enterprise Resource Planning')

@section('content')
<!-- Hero Section -->
<div class="relative">
    <!-- Main Hero -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 lg:py-20">
        <div class="text-center">
            <!-- Pre-title -->
            <p class="text-xl md:text-2xl lg:text-3xl font-semibold text-slate-900 mb-1 lg:mb-4">
                Kelola Seluruh Operasional Bisnis dalam Satu Platform
            </p>
            
            <!-- Main Title -->
            <h1 class="text-3xl sm:text-4xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-slate-900 leading-snug mb-6 lg:mb-8">
                Centrova <span class="text-[#128AEB]">ERP</span><br>
                Enterprise Resource Planning
            </h1>

            <!-- Description -->
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-medium text-slate-700 max-w-4xl mx-auto leading-relaxed tracking-tight px-4">
                Sistem ERP terpadu untuk manufaktur, distribusi, retail, dan service business dengan modul lengkap dan fleksibel.
            </p>
        </div>
    </div>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Key Modules Section -->
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Modul Lengkap Centrova ERP
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk menjalankan bisnis modern dan efisien
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Inventory Management</h3>
                        <p class="text-sm text-slate-600">Multi-warehouse, stock tracking real-time, batch/serial number, dan automatic reorder point</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Financial Accounting</h3>
                        <p class="text-sm text-slate-600">General ledger, accounts receivable/payable, bank reconciliation, dan multi-currency support</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Manufacturing</h3>
                        <p class="text-sm text-slate-600">Bill of materials (BOM), production planning, work orders, dan quality control management</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Purchase Management</h3>
                        <p class="text-sm text-slate-600">Purchase requisition, purchase order, vendor management, dan automated approval workflow</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Human Resource</h3>
                        <p class="text-sm text-slate-600">Employee database, payroll, attendance, leave management, dan performance appraisal</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#4a5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Project Management</h3>
                        <p class="text-sm text-slate-600">Project planning, task assignment, timesheet, expense tracking, dan project profitability</p>
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
                    Mengapa Memilih Centrova ERP?
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Solusi ERP yang scalable, fleksibel, dan mudah digunakan untuk bisnis Indonesia
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
                <div>
                    <div class="space-y-6 max-md:space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Efisiensi Operasional 60%</h3>
                                <p class="text-sm text-slate-600">Integrasi antar departemen menghilangkan duplikasi data dan mempercepat proses bisnis</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Real-time Visibility</h3>
                                <p class="text-sm text-slate-600">Dashboard comprehensive memberikan insight bisnis secara real-time untuk decision making</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Kurangi Biaya 40%</h3>
                                <p class="text-sm text-slate-600">Optimasi inventory, procurement, dan resource allocation mengurangi operational cost</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Scalable & Flexible</h3>
                                <p class="text-sm text-slate-600">Grow with your business, tambahkan modul dan user sesuai kebutuhan tanpa batasan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-br from-[#128AEB] to-[#0F76C6] rounded-2xl p-8 text-white shadow-lg">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                            <h3 class="text-xl font-bold mb-3">Compliance & Security</h3>
                            <p class="mb-4 text-sm">Centrova ERP memastikan kepatuhan regulasi dan keamanan data:</p>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Perpajakan Indonesia (e-Faktur ready)
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Standar Akuntansi Keuangan (SAK)
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    ISO 27001 Information Security
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Role-based access control (RBAC)
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Audit trail untuk semua transaksi
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
                Transform Your Business with Centrova ERP
            </h2>
            <p class="text-base sm:text-lg text-slate-600 mb-8 max-w-2xl mx-auto">
                Konsultasi gratis dengan expert kami untuk mengetahui solusi ERP yang tepat untuk bisnis Anda
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150">
                    Konsultasi Gratis
                </a>
                <a href="{{ route('products.business.index') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#128AEB] text-base font-medium rounded-full text-[#128AEB] hover:bg-[#128AEB] hover:text-white transition duration-150">
                    Lihat Aplikasi Lainnya
                </a>
            </div>
        </div>
    </section>
</div>

@endsection
