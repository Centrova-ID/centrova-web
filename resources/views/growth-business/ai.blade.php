{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Meningkatkan Efisiensi Bisnis Anda dengan AI | Centrova')

{{-- SEO & Meta Tags --}}
@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta property="og:description" content="Otomasi proses bisnis Anda dengan teknologi AI terkini. Kurangi human error, dapatkan insight real-time, dan buat keputusan lebih cepat bersama Centrova."/>
    <meta name="twitter:site" content="@centrovaid"/>
    <meta property="og:title" content="Meningkatkan Efisiensi Bisnis Anda dengan AI | Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/growth-business/ai') }}"/>
    <meta name="description" content="Transformasi bisnis Anda dengan solusi AI dari Centrova. Otomasi alur kerja, analisis data real-time, dan tingkatkan efisiensi operasional secara signifikan."/>
    <link rel="canonical" href="{{ url('/growth-business/ai') }}"/>
@endsection

{{-- Critical CSS --}}
@section('style-css')
    <style>
        [x-cloak]{display:none!important}
        .gradient-text{background:linear-gradient(90deg,#128AEB 0%,#0066CC 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .gradient-bg{background:linear-gradient(135deg,#128AEB 0%,#0066CC 100%)}
        .hero-gradient{background:linear-gradient(180deg,#EFF6FF 0%,#DBEAFE 50%,#FFFFFF 100%)}
        .google-card{background:#fff;border:1px solid #dadce0;border-radius:24px;transition:box-shadow 0.3s ease}
        .google-card:hover{box-shadow:0 1px 3px 0 rgba(60,64,67,0.3),0 4px 8px 3px rgba(60,64,67,0.15)}
        .google-text{color:#5f6368;font-size:16px;line-height:24px;font-weight:400}
        .google-text-dark{color:#202124;font-size:16px;line-height:24px}
        .feature-icon{width:56px;height:56px;border-radius:16px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    </style>
@endsection

@section('content')

{{-- HERO SECTION --}}
<section class="hero-gradient py-20 md:py-28 lg:py-36">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold tracking-wide uppercase mb-6">
                Unggulan
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold tracking-tight text-gray-900 mb-8 leading-tight">
                Meningkatkan Efisiensi Bisnis Anda
                <span class="gradient-text"> dengan AI</span>
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                Dengan teknologi AI terkini, Anda dapat mengotomasi proses bisnis yang berulang, mengurangi human error, dan mendapatkan insight real-time untuk pengambilan keputusan yang lebih cepat dan akurat.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#contact-form" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 min-h-[48px]">
                    Mulai Sekarang
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

{{-- PROBLEMS SECTION --}}
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Tantangan Bisnis yang Bisa Diatasi dengan AI
            </h2>
            <p class="google-text text-center mb-14 max-w-2xl mx-auto">
                Banyak bisnis masih menghadapi hambatan yang sebenarnya bisa diselesaikan oleh teknologi AI
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-red-100">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Proses Manual yang Lambat</h3>
                            <p class="google-text">Tugas berulang seperti entri data, pembuatan laporan, dan pemrosesan dokumen membuang waktu berharga karyawan setiap harinya.</p>
                        </div>
                    </div>
                </div>
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-orange-100">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Keputusan Berdasarkan Intuisi</h3>
                            <p class="google-text">Tanpa data yang teranalisis dengan baik, keputusan bisnis sering didasari asumsi dan bukan fakta — hasil pun tidak optimal.</p>
                        </div>
                    </div>
                </div>
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-purple-100">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Layanan Pelanggan Tidak Konsisten</h3>
                            <p class="google-text">Respons yang lambat dan tidak seragam membuat pelanggan frustasi dan beralih ke kompetitor yang lebih responsif.</p>
                        </div>
                    </div>
                </div>
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-yellow-100">
                            <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Biaya Operasional Membengkak</h3>
                            <p class="google-text">Pekerjaan yang seharusnya bisa diotomasi justru membutuhkan sumber daya manusia yang besar, sehingga margin keuntungan terus tergerus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FEATURES SECTION --}}
<section id="features" class="py-20 md:py-28 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Solusi AI yang Kami Hadirkan
            </h2>
            <p class="google-text text-center mb-16 max-w-2xl mx-auto">
                Rangkaian teknologi AI yang terintegrasi dan siap diterapkan di bisnis Anda
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">AI Chatbot & Asisten Virtual</h3>
                    <p class="google-text leading-relaxed">Layani pelanggan 24/7 tanpa henti. Chatbot AI kami mampu menjawab pertanyaan, memproses pesanan, dan menangani keluhan secara otomatis.</p>
                </div>

                {{-- Feature 2 --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Analitik Prediktif</h3>
                    <p class="google-text leading-relaxed">Prediksi tren penjualan, kebutuhan stok, dan perilaku pelanggan sebelum kejadian. Buat keputusan proaktif berdasarkan data, bukan reaksi.</p>
                </div>

                {{-- Feature 3 --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-14 h-14 bg-violet-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Otomasi Alur Kerja</h3>
                    <p class="google-text leading-relaxed">Eliminasi pekerjaan berulang dengan workflow automation — dari pemrosesan dokumen, notifikasi otomatis, hingga sinkronisasi data antar sistem.</p>
                </div>

                {{-- Feature 4 --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-14 h-14 bg-cyan-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Computer Vision</h3>
                    <p class="google-text leading-relaxed">Kenali produk, cek kualitas, dan pantau kehadiran melalui analisis gambar/video secara otomatis — cocok untuk manufaktur, retail, dan keamanan.</p>
                </div>

                {{-- Feature 5 --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-14 h-14 bg-teal-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Deteksi Fraud & Anomali</h3>
                    <p class="google-text leading-relaxed">Lindungi bisnis Anda dari transaksi mencurigakan dan anomali data secara real-time dengan model AI yang terus belajar dan berkembang.</p>
                </div>

                {{-- Feature 6 --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Dashboard Insight Real-time</h3>
                    <p class="google-text leading-relaxed">Pantau seluruh KPI bisnis Anda dari satu tampilan terpadu. AI mengolah data mentah menjadi insight yang actionable untuk Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BENEFITS SECTION --}}
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Hasil Nyata yang Bisa Anda Harapkan
            </h2>
            <p class="google-text text-center mb-16 max-w-2xl mx-auto">
                Bisnis yang mengadopsi AI melaporkan peningkatan signifikan dalam efisiensi dan profitabilitas
            </p>

            <div class="space-y-4">
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-blue-100">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Efisiensi Operasional Meningkat hingga 60%</h3>
                            <p class="google-text">Proses yang biasanya membutuhkan berjam-jam diselesaikan dalam hitungan detik oleh AI — tim Anda fokus pada pekerjaan yang benar-benar bernilai tinggi.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-green-100">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Akurasi Data Mencapai 99%+</h3>
                            <p class="google-text">AI tidak lelah, tidak lupa, dan tidak membuat human error. Setiap data diproses dengan presisi tinggi sehingga laporan Anda selalu akurat.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-purple-100">
                            <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Penghematan Biaya Operasional 30-50%</h3>
                            <p class="google-text">Kurangi biaya lembur, minimalkan kesalahan yang berbiaya mahal, dan optimalkan alokasi sumber daya untuk hasil yang maksimal.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="feature-icon bg-orange-100">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Respons Lebih Cepat di Pasar</h3>
                            <p class="google-text">Dengan insight real-time dari AI, Anda bisa merespons perubahan pasar lebih cepat dari kompetitor dan selalu berada selangkah di depan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROCESS SECTION --}}
<section class="py-20 md:py-28 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Bagaimana Kami Mengimplementasikan AI untuk Bisnis Anda
            </h2>
            <p class="google-text text-center mb-16 max-w-2xl mx-auto">
                Proses implementasi yang terstruktur untuk memastikan hasil yang optimal
            </p>

            <div class="space-y-6">
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">1</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Analisis Kebutuhan & Audit Proses</h3>
                            <p class="google-text">Kami mempelajari alur kerja bisnis Anda secara mendalam untuk mengidentifikasi area yang paling potensial untuk diotomasi dengan AI.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">2</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Desain Solusi & Roadmap AI</h3>
                            <p class="google-text">Berdasarkan temuan audit, kami merancang solusi AI yang custom-built sesuai kebutuhan spesifik bisnis Anda beserta roadmap implementasinya.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">3</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pembangunan & Integrasi</h3>
                            <p class="google-text">Tim engineer kami membangun solusi AI dan mengintegrasikannya dengan sistem yang sudah ada tanpa mengganggu operasional harian bisnis Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">4</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pelatihan Tim & Go-Live</h3>
                            <p class="google-text">Kami melatih tim Anda untuk menggunakan sistem AI yang baru dan mendampingi proses go-live hingga semua berjalan lancar dan optimal.</p>
                        </div>
                    </div>
                </div>

                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-xl font-semibold text-white">5</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Monitoring & Optimasi Berkelanjutan</h3>
                            <p class="google-text">AI terus belajar dari data bisnis Anda. Kami memantau performa dan melakukan optimasi berkala untuk memastikan AI selalu memberikan hasil terbaik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section id="contact-form" class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="google-card p-8 md:p-12">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 text-center mb-4">
                    Siap Mengadopsi AI untuk Bisnis Anda?
                </h2>
                <p class="google-text text-center mb-10">
                    Konsultasikan kebutuhan bisnis Anda dengan tim ahli kami. Gratis tanpa komitmen.
                </p>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="subject" value="Growth Business AI - Konsultasi">

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
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Ceritakan Bisnis & Kebutuhan Anda
                        </label>
                        <textarea
                            id="message"
                            name="message"
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none google-text resize-none"
                            placeholder="Ceritakan tentang bisnis Anda dan apa yang ingin Anda otomasi dengan AI..."
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full flex items-center justify-center px-8 py-4 bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium rounded-xl transition-colors duration-200 text-base"
                    >
                        Mulai Konsultasi Gratis
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>

                    <p class="text-center text-sm text-gray-500">
                        Tim kami akan menghubungi Anda dalam 1×24 jam.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
