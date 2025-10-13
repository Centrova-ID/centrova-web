@extends('partials.layouts.main')

@section('title', 'Centrova Rental - Rental Management System')

@section('content')
<!-- Hero Section -->
<div class="relative">
    <!-- Main Hero -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 lg:py-20">
        <div class="text-center">
            <!-- Pre-title -->
            <p class="text-xl md:text-2xl lg:text-3xl font-semibold text-slate-900 mb-1 lg:mb-4">
                Solusi Lengkap untuk Bisnis Rental & Sewa
            </p>
            
            <!-- Main Title -->
            <h1 class="text-3xl sm:text-4xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-slate-900 leading-snug mb-6 lg:mb-8">
                Centrova <span class="text-[#128AEB]">Rental</span><br>
                Rental Management System
            </h1>

            <!-- Description -->
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-medium text-slate-700 max-w-4xl mx-auto leading-relaxed tracking-tight px-4">
                Platform manajemen rental yang memudahkan pemesanan, tracking aset, invoicing, dan maintenance scheduling.
            </p>
        </div>
    </div>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Key Features Section -->
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Fitur Utama Centrova Rental
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Kelola bisnis rental Anda dengan lebih efisien dan profesional
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Booking Management</h3>
                        <p class="text-sm text-slate-600">Calendar view booking, availability check real-time, online booking, dan automatic confirmation</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Asset Tracking</h3>
                        <p class="text-sm text-slate-600">GPS tracking, usage history, condition monitoring, dan photo documentation untuk setiap aset</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Flexible Pricing</h3>
                        <p class="text-sm text-slate-600">Hourly/daily/weekly/monthly rates, seasonal pricing, package deals, dan automatic calculation</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Contract & Agreement</h3>
                        <p class="text-sm text-slate-600">Digital contracts, e-signature, terms & conditions, security deposit, dan damage claim management</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Maintenance Schedule</h3>
                        <p class="text-sm text-slate-600">Preventive maintenance, service log, spare parts inventory, dan downtime tracking</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#4a5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Payment & Billing</h3>
                        <p class="text-sm text-slate-600">Auto invoice generation, multiple payment methods, late fee calculation, dan payment reminder</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Industry Use Cases -->
    <section class="w-full overflow-hidden py-32 max-md:py-16 bg-white">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Cocok untuk Berbagai Bisnis Rental
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Dari kendaraan hingga equipment, kelola semua jenis rental dengan mudah
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6 text-center">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-2">Vehicle Rental</h3>
                        <p class="text-sm text-slate-600">Mobil, motor, truk dengan fitur GPS tracking dan fuel management</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6 text-center">
                        <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-2">Property Rental</h3>
                        <p class="text-sm text-slate-600">Apartemen, villa, kos dengan utility billing dan tenant management</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6 text-center">
                        <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-2">Equipment Rental</h3>
                        <p class="text-sm text-slate-600">Kamera, sound system, alat berat dengan damage insurance</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6 text-center">
                        <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-2">Event & Party</h3>
                        <p class="text-sm text-slate-600">Perlengkapan pesta, dekorasi dengan booking calendar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Benefits Section -->
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Keunggulan Centrova Rental
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Tingkatkan utilization rate dan revenue dengan sistem yang tepat
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
                <div>
                    <div class="space-y-6 max-md:space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Utilization Rate +45%</h3>
                                <p class="text-sm text-slate-600">Optimasi booking schedule dan availability visibility meningkatkan penggunaan aset</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Revenue +35%</h3>
                                <p class="text-sm text-slate-600">Dynamic pricing dan upselling features meningkatkan average booking value</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Reduce No-Show 90%</h3>
                                <p class="text-sm text-slate-600">Automated reminders dan deposit system meminimalkan booking yang dibatalkan</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Save Time 60%</h3>
                                <p class="text-sm text-slate-600">Automation untuk booking, invoicing, dan contract generation menghemat waktu admin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-br from-[#128AEB] to-[#0F76C6] rounded-2xl p-8 text-white shadow-lg">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                            <h3 class="text-xl font-bold mb-3">Customer Portal</h3>
                            <p class="mb-4 text-sm">Self-service portal untuk kemudahan pelanggan:</p>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Browse catalog dan check availability
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Online booking dengan instant confirmation
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Digital contract signing
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Payment gateway integration
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Booking history & invoice download
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
                Modernisasi Bisnis Rental Anda Sekarang
            </h2>
            <p class="text-base sm:text-lg text-slate-600 mb-8 max-w-2xl mx-auto">
                Dapatkan demo Centrova Rental dan lihat bagaimana kami dapat meningkatkan efisiensi bisnis Anda
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
