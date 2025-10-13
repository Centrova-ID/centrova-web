@extends('partials.layouts.main')

@section('title', 'Centrova POS - Point of Sale System')

@section('content')
<!-- Hero Section -->
<div class="relative">
    <!-- Main Hero -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 lg:py-20">
        <div class="text-center">
            <!-- Pre-title -->
            <p class="text-xl md:text-2xl lg:text-3xl font-semibold text-slate-900 mb-1 lg:mb-4">
                Sistem Kasir Modern untuk Bisnis Retail & F&B
            </p>
            
            <!-- Main Title -->
            <h1 class="text-3xl sm:text-4xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-slate-900 leading-snug mb-6 lg:mb-8">
                Centrova <span class="text-[#128AEB]">POS</span><br>
                Point of Sale System
            </h1>

            <!-- Description -->
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-medium text-slate-700 max-w-4xl mx-auto leading-relaxed tracking-tight px-4">
                Sistem kasir cloud-based yang cepat, mudah, dan terintegrasi dengan inventory, akuntansi, dan loyalty program.
            </p>
        </div>
    </div>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Key Features Section -->
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Fitur Unggulan Centrova POS
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Dilengkapi dengan fitur modern untuk meningkatkan penjualan dan efisiensi operasional
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Multi Payment Method</h3>
                        <p class="text-sm text-slate-600">Cash, debit/credit card, e-wallet (GoPay, OVO, Dana), QRIS, dan split payment dalam satu transaksi</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Express Checkout</h3>
                        <p class="text-sm text-slate-600">Barcode scanner, quick product search, shortcut keys untuk checkout super cepat dalam hitungan detik</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Customer Loyalty</h3>
                        <p class="text-sm text-slate-600">Points reward, membership tier, voucher/promo, dan customer database untuk repeat purchase</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Inventory Sync Real-time</h3>
                        <p class="text-sm text-slate-600">Stock update otomatis saat transaksi, low stock alert, dan multi-outlet inventory management</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Sales Analytics</h3>
                        <p class="text-sm text-slate-600">Dashboard penjualan real-time, best selling products, sales trend, dan profit margin analysis</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6">
                        <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#4a5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Offline Mode</h3>
                        <p class="text-sm text-slate-600">Tetap bisa transaksi meski internet mati, data tersinkronisasi otomatis saat online kembali</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Industry Solutions -->
    <section class="w-full overflow-hidden py-32 max-md:py-16 bg-white">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Solusi untuk Berbagai Jenis Bisnis
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Fitur khusus yang disesuaikan dengan kebutuhan industri Anda
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6 text-center">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-2">Retail & Fashion</h3>
                        <p class="text-sm text-slate-600">Size/color variant, barcode, price tag printing, dan seasonal promo management</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6 text-center">
                        <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-2">Cafe & Restaurant</h3>
                        <p class="text-sm text-slate-600">Table management, kitchen display system, modifier/addon, dan online ordering</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6 text-center">
                        <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#8e44ad]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-2">Beauty & Salon</h3>
                        <p class="text-sm text-slate-600">Appointment booking, service packages, therapist commission, dan membership</p>
                    </div>
                </div>

                <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <div class="px-6 py-6 pb-6 text-center">
                        <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#f39c12]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-2">Minimarket & Grocery</h3>
                        <p class="text-sm text-slate-600">Batch/expiry tracking, wholesale/retail pricing, dan supplier management</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    <!-- Hardware Integration -->
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Hardware Ready
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Compatible dengan berbagai hardware untuk kemudahan operasional
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16">
                <div class="bg-gradient-to-br from-[#128AEB] to-[#0F76C6] rounded-2xl p-8 text-white shadow-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                            <h3 class="text-lg font-bold mb-4">Peripheral Support</h3>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Barcode Scanner (USB/Bluetooth)
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Thermal Printer (58mm/80mm)
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Cash Drawer dengan auto-open
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Customer Display (pole/tablet)
                                </li>
                            </ul>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                            <h3 class="text-lg font-bold mb-4">Payment Terminal</h3>
                            <ul class="space-y-2">
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    EDC Machine (BCA, Mandiri, BNI)
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    QRIS Scanner (all banks)
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    E-wallet integration API
                                </li>
                                <li class="flex items-center text-sm">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Payment Gateway (Midtrans, Xendit)
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
                Mulai Tingkatkan Penjualan Anda Hari Ini
            </h2>
            <p class="text-base sm:text-lg text-slate-600 mb-8 max-w-2xl mx-auto">
                Coba Centrova POS gratis selama 14 hari tanpa kartu kredit. Setup dalam 5 menit!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150">
                    Coba Gratis 14 Hari
                </a>
                <a href="{{ route('products.business.index') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#128AEB] text-base font-medium rounded-full text-[#128AEB] hover:bg-[#128AEB] hover:text-white transition duration-150">
                    Lihat Aplikasi Lainnya
                </a>
            </div>
        </div>
    </section>
</div>

@endsection
