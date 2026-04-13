{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Personalisasi Pengalaman Pelanggan Melalui Data Analytics | Centrova')

{{-- SEO & Meta Tags --}}
@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta property="og:description" content="Manfaatkan data pelanggan untuk menciptakan pengalaman yang lebih personal, meningkatkan loyalitas, dan mendorong konversi lebih tinggi dengan Customer Analytics dari Centrova."/>
    <meta name="twitter:site" content="@centrovaid"/>
    <meta property="og:title" content="Personalisasi Pengalaman Pelanggan Melalui Data Analytics | Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/growth-business/customer-analytics') }}"/>
    <meta name="description" content="Gunakan data analytics untuk memahami pelanggan Anda secara mendalam, personalisasi setiap interaksi, dan tingkatkan retensi serta konversi bisnis Anda bersama Centrova."/>
    <link rel="canonical" href="{{ url('/growth-business/customer-analytics') }}"/>
@endsection

{{-- Critical CSS --}}
@section('style-css')
    <style>
        [x-cloak]{display:none!important}
        .gradient-text{background:linear-gradient(90deg,#128AEB 0%,#0066CC 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .hero-gradient{background:linear-gradient(180deg,#F0FDF4 0%,#DCFCE7 50%,#FFFFFF 100%)}
        .google-card{background:#fff;border:1px solid #dadce0;border-radius:24px;transition:box-shadow 0.3s ease}
        .google-card:hover{box-shadow:0 1px 3px 0 rgba(60,64,67,0.3),0 4px 8px 3px rgba(60,64,67,0.15)}
        .google-text{color:#5f6368;font-size:16px;line-height:24px;font-weight:400}
        .google-text-dark{color:#202124;font-size:16px;line-height:24px}
        .feature-icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .stat-card{background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);border-radius:24px;color:white}
    </style>
@endsection

@section('content')

{{-- HERO SECTION --}}
<section class="hero-gradient py-20 md:py-28 lg:py-36">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold tracking-wide uppercase mb-6">
                Berita Terbaru
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold tracking-tight text-gray-900 mb-8 leading-tight">
                Personalisasi Pengalaman Pelanggan
                <span class="gradient-text"> Melalui Data Analytics</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                Ubah data pelanggan menjadi insight yang actionable. Ciptakan pengalaman yang terasa personal untuk setiap pelanggan dan tingkatkan loyalitas jangka panjang bisnis Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#contact-form" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 min-h-[48px]">
                    Daftar Sekarang
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="#features" class="inline-flex items-center justify-center px-8 py-3.5 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 transition duration-150 min-h-[48px]">
                    Pelajari Selengkapnya
                </a>
            </div>
        </div>
    </div>
</section>

{{-- STATS SECTION --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="stat-card p-8 text-center">
                    <p class="text-4xl font-bold text-white mb-2">80%</p>
                    <p class="text-gray-300 text-sm">Pelanggan lebih memilih brand yang memberikan pengalaman personal</p>
                </div>
                <div class="stat-card p-8 text-center">
                    <p class="text-4xl font-bold text-white mb-2">3×</p>
                    <p class="text-gray-300 text-sm">Peningkatan konversi dengan rekomendasi produk yang dipersonalisasi</p>
                </div>
                <div class="stat-card p-8 text-center">
                    <p class="text-4xl font-bold text-white mb-2">65%</p>
                    <p class="text-gray-300 text-sm">Pendapatan bisnis berasal dari pelanggan yang sudah ada (existing)</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- WHY SECTION --}}
<section class="py-20 md:py-28 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Mengapa Personalisasi itu Penting?
            </h2>
            <p class="google-text text-center mb-14 max-w-2xl mx-auto">
                Di era digital yang penuh persaingan, pengalaman pelanggan yang generik tidak lagi cukup
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-red-100">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Email Blast yang Diabaikan</h3>
                            <p class="google-text">Promosi massal yang tidak relevan membuat open rate turun dan pelanggan bosan, bahkan berujung pada unsubscribe.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-orange-100">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Data Pelanggan yang Tidak Dimanfaatkan</h3>
                            <p class="google-text">Banyak bisnis sudah memiliki data berharga tapi tidak tahu cara mengolahnya menjadi strategi marketing yang efektif.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-yellow-100">
                            <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Biaya Akuisisi Pelanggan yang Tinggi</h3>
                            <p class="google-text">Tanpa retensi yang baik, bisnis terus membuang anggaran besar untuk mendapatkan pelanggan baru padahal pelanggan lama pergi begitu saja.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-purple-100">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pengalaman Pelanggan yang Tidak Konsisten</h3>
                            <p class="google-text">Tanpa data terpadu, setiap interaksi dengan pelanggan terasa asing — tim tidak tahu history pelanggan dan pelanggan pun merasa tidak dihargai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FEATURES SECTION --}}
<section id="features" class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Fitur Customer Analytics Kami
            </h2>
            <p class="google-text text-center mb-16 max-w-2xl mx-auto">
                Platform analytics yang komprehensif untuk memahami dan melayani pelanggan Anda lebih baik
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div class="bg-gray-50 rounded-3xl p-8">
                    <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Customer 360° Profile</h3>
                    <p class="google-text leading-relaxed">Lihat gambaran lengkap setiap pelanggan — riwayat pembelian, preferensi, interaksi, dan prediksi perilaku dalam satu dashboard terpadu.</p>
                </div>

                {{-- Feature 2 --}}
                <div class="bg-gray-50 rounded-3xl p-8">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Segmentasi Pelanggan Otomatis</h3>
                    <p class="google-text leading-relaxed">AI mengelompokkan pelanggan berdasarkan perilaku, nilai, dan potensi secara otomatis sehingga Anda bisa menargetkan pesan yang tepat untuk segmen yang tepat.</p>
                </div>

                {{-- Feature 3 --}}
                <div class="bg-gray-50 rounded-3xl p-8">
                    <div class="w-14 h-14 bg-violet-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Mesin Rekomendasi Produk</h3>
                    <p class="google-text leading-relaxed">Sajikan produk atau layanan yang paling relevan untuk setiap pelanggan secara real-time berdasarkan riwayat dan preferensi mereka — seperti Netflix atau Amazon.</p>
                </div>

                {{-- Feature 4 --}}
                <div class="bg-gray-50 rounded-3xl p-8">
                    <div class="w-14 h-14 bg-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Prediksi Churn Pelanggan</h3>
                    <p class="google-text leading-relaxed">Identifikasi pelanggan yang berisiko pergi sebelum mereka benar-benar pergi — sehingga Anda bisa mengambil tindakan retensi yang proaktif dan tepat waktu.</p>
                </div>

                {{-- Feature 5 --}}
                <div class="bg-gray-50 rounded-3xl p-8">
                    <div class="w-14 h-14 bg-rose-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Personalisasi Kampanye Marketing</h3>
                    <p class="google-text leading-relaxed">Kirim pesan yang tepat, ke orang yang tepat, pada waktu yang tepat — melalui email, WhatsApp, atau push notification yang dipersonalisasi secara otomatis.</p>
                </div>

                {{-- Feature 6 --}}
                <div class="bg-gray-50 rounded-3xl p-8">
                    <div class="w-14 h-14 bg-amber-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Analisis Customer Journey</h3>
                    <p class="google-text leading-relaxed">Pahami setiap titik interaksi pelanggan dengan bisnis Anda — dari pertama mengenal brand hingga menjadi pelanggan setia — dan optimalkan setiap tahapannya.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- RESULTS SECTION --}}
<section class="py-20 md:py-28 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Hasil yang Dapat Anda Capai
            </h2>
            <p class="google-text text-center mb-16 max-w-2xl mx-auto">
                Bisnis yang menggunakan customer analytics melaporkan pertumbuhan yang signifikan
            </p>

            <div class="space-y-4">
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-emerald-100">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tingkat Retensi Pelanggan Meningkat 40%+</h3>
                            <p class="google-text">Dengan memahami kebutuhan pelanggan lebih dalam, Anda bisa memberikan pengalaman yang membuat mereka tidak ingin pergi ke kompetitor.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-blue-100">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Revenue per Pelanggan Naik 2–3×</h3>
                            <p class="google-text">Rekomendasi produk yang tepat mendorong upsell dan cross-sell yang relevan — pelanggan membeli lebih banyak karena merasa rekomendasi Anda memang untuk mereka.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-purple-100">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Kepuasan Pelanggan Meningkat Signifikan</h3>
                            <p class="google-text">Pelanggan yang merasakan pengalaman personal cenderung memberikan rating lebih tinggi, merekomendasikan bisnis Anda, dan menjadi brand ambassador organik.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-orange-100">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">ROI Marketing Lebih Terukur & Efisien</h3>
                            <p class="google-text">Tidak ada lagi anggaran marketing yang dibuang untuk audiens yang salah. Setiap rupiah yang Anda keluarkan untuk marketing menjadi lebih tepat sasaran dan terukur hasilnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Bagaimana Cara Kerjanya?
            </h2>
            <p class="google-text text-center mb-16 max-w-2xl mx-auto">
                Dari data mentah ke pengalaman pelanggan yang personal — dalam empat langkah sederhana
            </p>

            <div class="space-y-6">
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">1</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pengumpulan Data Terpadu</h3>
                            <p class="google-text">Kami mengintegrasikan semua sumber data pelanggan Anda — POS, website, aplikasi, CRM, sosial media — ke dalam satu platform terpusat.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">2</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Analisis & Segmentasi Cerdas</h3>
                            <p class="google-text">AI menganalisis pola perilaku, mengelompokkan pelanggan berdasarkan karakteristik, dan menghasilkan insight yang actionable secara otomatis.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">3</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Personalisasi Otomatis</h3>
                            <p class="google-text">Sistem secara otomatis menyesuaikan konten, rekomendasi, dan pesan marketing untuk setiap segmen atau bahkan setiap individu pelanggan.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">4</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pengukuran & Optimasi Terus-menerus</h3>
                            <p class="google-text">Pantau setiap metrik penting dan biarkan sistem belajar dari hasilnya — semakin lama digunakan, semakin akurat dan efektif personalisasinya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section id="contact-form" class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="google-card p-8 md:p-12">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 text-center mb-4">
                    Mulai Personalisasi Pengalaman Pelanggan Anda
                </h2>
                <p class="google-text text-center mb-10">
                    Daftarkan bisnis Anda dan dapatkan demo gratis platform Customer Analytics Centrova.
                </p>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="subject" value="Growth Business Customer Analytics - Daftar">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none google-text"
                            placeholder="Masukkan nama lengkap Anda"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none google-text"
                            placeholder="nama@perusahaan.com"
                        >
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none google-text"
                            placeholder="08xxxxxxxxxx"
                        >
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Bisnis / Perusahaan
                        </label>
                        <input
                            type="text"
                            id="company"
                            name="company"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none google-text"
                            placeholder="Nama perusahaan atau bisnis Anda"
                        >
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Ceritakan Kebutuhan Analytics Anda
                        </label>
                        <textarea
                            id="message"
                            name="message"
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none google-text resize-none"
                            placeholder="Berapa jumlah pelanggan Anda? Apa yang ingin Anda ketahui tentang perilaku mereka?..."
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full flex items-center justify-center px-8 py-4 bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium rounded-xl transition-colors duration-200 text-base"
                    >
                        Daftar & Dapatkan Demo Gratis
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>

                    <p class="text-center text-sm text-gray-500">
                        Tim kami akan menghubungi Anda dalam 1×24 jam untuk menjadwalkan demo.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
