{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'AuditorLab - Audit Digitalisasi Bisnis Gratis | Centrova')

{{-- SEO & Meta Tags --}}
@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta property="og:description" content="Ubah alur kerja yang lambat jadi sistem yang 2X lebih efisien. Dapatkan audit digitalisasi bisnis gratis dari Centrova dan tingkatkan efisiensi operasional hingga 40 jam per minggu."/>
    <meta name="twitter:site" content="@centrovaid"/>
    <meta property="og:title" content="AuditorLab - Audit Digitalisasi Bisnis Gratis | Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:image" content="{{ asset('assets/image/auditorlab-og.jpg') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/auditorlab') }}"/>
    <meta name="description" content="Audit digitalisasi bisnis gratis untuk mengidentifikasi kebocoran waktu dan sistem yang menghambat pertumbuhan bisnis Anda. Raih efisiensi hingga 2X lipat."/>
    <link rel="canonical" href="{{ url('/auditorlab') }}"/>
@endsection

{{-- Critical CSS --}}
@section('style-css')
    <style>
        [x-cloak]{display:none!important}
        .gradient-text{background:linear-gradient(90deg,#128AEB 0%,#0066CC 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .gradient-bg{background:linear-gradient(135deg,#128AEB 0%,#0066CC 100%)}
        .box-shadow-custom{box-shadow:0 10px 40px rgba(18,138,235,0.1)}
        .box-shadow-hover:hover{box-shadow:0 20px 60px rgba(18,138,235,0.15);transform:translateY(-4px);transition:all 0.3s ease}
        .hero-gradient{background:linear-gradient(180deg,#FFFFFF 0%,#F8FAFC 100%)}
        /* Google-style cards */
        .google-card{background:#fff;border:1px solid #dadce0;border-radius:24px;transition:box-shadow 0.3s ease}
        .google-card:hover{box-shadow:0 1px 3px 0 rgba(60,64,67,0.3),0 4px 8px 3px rgba(60,64,67,0.15)}
        .google-section-title{font-size:32px;font-weight:400;color:#202124;letter-spacing:-0.5px;line-height:40px}
        .google-text{color:#5f6368;font-size:16px;line-height:24px;font-weight:400}
        .google-text-dark{color:#202124;font-size:16px;line-height:24px}
    </style>
@endsection

@section('content')

{{-- HERO SECTION --}}
<section class="py-20 lg:pt-26">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto text-center">
            {{-- Headline --}}
            <img src="{{ asset('logo/auditorlab/auditorlab-logotype.svg') }}" alt="Logo Produk Centrova AuditorLab" class="h-7 lg:h-10 mx-auto mb-5 lg:mb-7">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold lg:tracking-[-2px] text-gray-900 mb-8">
                Ubah Alur Kerja yang Lambat Jadi Sistem yang 
                <span class="gradient-text"><span class="italic font-extrabold">2X</span> Lebih Efisien</span> 
                dengan Solusi Digitalisasi Bisnis Anda
            </h1>
            
            {{-- Sub Headline --}}
            <p class="text-base sm:text-lg md:text-xl text-gray-600 mb-10 max-w-3xl mx-auto tracking-tight">
                84% klien kami berhasil memangkas waktu kerja hingga 40 jam per minggu
            </p>
            
            {{-- CTA --}}
            <div class="flex justify-center">
                <a href="#audit-form" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-1 min-h-[44px] tracking-normal">
                    Klaim Audit Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

{{-- GROWTH BUSINESS CARDS SECTION --}}
<section class="py-10 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Card 1: AI --}}
                <div class="bg-gray-100/80 p-3 rounded-3xl overflow-hidden flex flex-col">
                    <div class="rounded-2xl overflow-hidden mx-4 mt-4 mb-6">
                        <div class="relative w-full aspect-video">
                            {{-- Abstract AI visual --}}
                            <img src="{{ asset('assets/image/ai-homepage-card.jpg') }}" alt="AI visual" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-[28px] font-semibold text-gray-900 mb-6 leading-snug">
                            Meningkatkan Efisiensi Bisnis Anda dengan AI
                        </h3>
                        <p class="text-gray-900 text-[17px] leading-snug font-normal mb-6 flex-1">
                            Dengan teknologi AI, Anda dapat mengotomasi proses bisnis yang berulang, mengurangi human error, serta menyajikan wawasan real-time demi keputusan bisnis yang lebih cepat dan akurat.
                        </p>
                        <div>
                            <a href="{{ url('/growth-business/ai') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#0F76C6] hover:border-[#128aeb] min-w-[126px] text-base font-medium rounded-full text-[#0F76C6] hover:text-white active:shadow-md bg-transparent hover:bg-[#128aeb] transition duration-200 mt-1 min-h-[44px] tracking-normal">
                                Investasikan
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Customer Analytics --}}
                <div class="bg-gray-100/80 p-3 rounded-3xl overflow-hidden flex flex-col">
                    <div class="rounded-2xl overflow-hidden mx-4 mt-4 mb-6">
                        <div class="relative w-full aspect-video">
                            {{-- Abstract AI visual --}}
                            <img src="{{ asset('assets/image/centrova-analytics-card.jpg') }}" alt="AI visual" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-[28px] font-semibold text-gray-900 mb-6 leading-snug">
                            Personalisasi Pengalaman Pelanggan Melalui Data Analytics
                        </h3>
                        <p class="text-gray-900 text-[17px] leading-snug font-normal mb-6 flex-1">
                            Gunakan strategi berbasis data pelanggan untuk mempersonalisasi pengalaman, memperkuat loyalitas, dan memaksimalkan konversi.
                        </p>
                        <div>
                            <a href="{{ url('/growth-business/customer-analytics') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#0F76C6] hover:border-[#128aeb] min-w-[126px] text-base font-medium rounded-full text-[#0F76C6] hover:text-white active:shadow-md bg-transparent hover:bg-[#128aeb] transition duration-200 mt-1 min-h-[44px] tracking-normal">
                                Mulai Mencoba
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- BENEFIT SECTION --}}
<section class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            {{-- Headline --}}
            <h2 class="text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Sesi Konsultasi Digitalisasi Gratis Untuk<br><span class="gradient-text">Bedah Sistem Bisnis Anda</span>
            </h2>
            
            <p class="text-xl text-slate-600 text-center mb-14 mt-16 max-w-3xl mx-auto">
                Apa yang Akan Kami Audit di Bisnis Anda?
            </p>
            
            {{-- Benefit Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Card 1: APA --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-12 h-12 bg-[#128aeb] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        Apa yang Masih Manual
                    </h3>
                    <p class="text-gray-800 text-[17.2px] leading-snug">
                        Kami akan membedah proses kerja tim Anda dan menunjukkan di bagian mana kebocoran waktu terjadi akibat sistem yang masih manual atau konvensional.
                    </p>
                </div>
                
                {{-- Card 2: MENGAPA --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-12 h-12 bg-[#128aeb] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        Mengapa Bisa Menghambat
                    </h3>
                    <p class="text-gray-800 text-[17.2px] leading-snug">
                        Penjelasan teknis mengapa alur kerja saat ini membuat biaya operasional membengkak, data sering selisih, dan bisnis Anda sulit untuk scale-up (tumbuh besar).
                    </p>
                </div>
                
                {{-- Card 3: BAGAIMANA --}}
                <div class="bg-white rounded-3xl p-8">
                    <div class="w-12 h-12 bg-[#128aeb] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        Bagaimana Solusi Digitalnya
                    </h3>
                    <p class="text-gray-800 text-[17.2px] leading-snug">
                        Kami berikan Digital Roadmap berupa rekomendasi sistem (ERP, CRM, atau Dashboard Custom) yang paling tepat sasaran. Anda bisa langsung tahu teknologi apa yang harus dibangun HARI INI juga.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- RESULTS SECTION --}}
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Hasil yang Bisa Anda Raih Setelah Optimasi
            </h2>
            
            <p class="google-text text-center mb-16 max-w-2xl mx-auto">
                Transformasi digital yang tepat sasaran akan mengubah operasional bisnis Anda secara radikal
            </p>
            
            <div class="space-y-4">
                {{-- Result 1 --}}
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Produktivitas Tim Meningkat 2X Lipat
                            </h3>
                            <p class="google-text">
                                Tanpa harus menambah jumlah tim atau jam kerja. Sistem otomatis menghilangkan pekerjaan manual yang membuang waktu.
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- Result 2 --}}
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Selamat Tinggal Human Error
                            </h3>
                            <p class="google-text">
                                Data selalu akurat dan sinkron real-time. Tidak ada lagi selisih stok, salah input, atau laporan yang berbeda-beda.
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- Result 3 --}}
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Biaya Operasional Turun Drastis
                            </h3>
                            <p class="google-text">
                                Hemat biaya lembur, kurangi kesalahan yang merugikan, dan optimalkan resource yang ada untuk hasil maksimal.
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- Result 4 --}}
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Kompetitor Gigit Jari
                            </h3>
                            <p class="google-text">
                                Sistem yang terintegrasi membuat bisnis Anda bergerak lebih cepat dan efisien, ninggalin kompetitor yang masih pakai cara lama.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROCESS SECTION --}}
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            {{-- Headline --}}
            <h2 class="google-section-title text-center mb-16">
                3 Langkah Transformasi Digital Bisnis Anda
            </h2>
            
            {{-- Steps --}}
            <div class="space-y-6">
                {{-- Step 1 --}}
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-xl font-medium text-white">1</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Free Digital Audit
                            </h3>
                            <p class="google-text">
                                Sesi konsultasi 1-on-1 untuk membedah masalah operasional Anda saat ini.
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- Step 2 --}}
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-xl font-medium text-white">2</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Strategic Development
                            </h3>
                            <p class="google-text">
                                Kami membangun purwarupa (prototype) sistem berdasarkan Digital Roadmap yang telah disepakati.
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- Step 3 --}}
                <div class="google-card p-6 md:p-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-xl font-medium text-white">3</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">
                                Seamless Integration
                            </h3>
                            <p class="google-text">
                                Implementasi sistem ke dalam bisnis Anda, lengkap dengan pelatihan tim untuk memastikan transisi berjalan mulus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- WHO SECTION --}}
<section class="py-20 md:py-28 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="google-section-title text-center mb-16">
                Siapa yang Akan Membedah Bisnis Anda?
            </h2>
            
            <div class="google-card p-8 md:p-12">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 md:space-x-10">
                    {{-- Photo --}}
                    <div class="flex-shrink-0">
                        <div class="w-40 h-40 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-5xl font-medium text-white">CS</span>
                        </div>
                    </div>
                    
                    {{-- Content --}}
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="text-2xl font-normal text-gray-900 mb-2">
                            Centrova Sultan Team
                        </h3>
                        <p class="text-base text-blue-600 font-normal mb-6">
                            Tech Entrepreneur & Digital Transformation Expert
                        </p>
                        
                        <div class="space-y-4 google-text mb-6">
                            <p>
                                Selama bertahun-tahun membangun ratusan sistem digital untuk berbagai industri, kami melihat pola yang sama berulang kali: <strong class="font-medium text-gray-900">Banyak pebisnis menguras uang jutaan rupiah karena tidak paham di mana letak kebocoran sistemnya</strong>.
                            </p>
                            <p>
                                <strong class="font-medium text-gray-900">Developer biasanya cuma peduli membuat sistem yang berfungsi.</strong><br>
                                <strong class="font-medium text-gray-900">Konsultan bisnis biasanya cuma peduli strategi tanpa implementasi teknis.</strong>
                            </p>
                            <p>
                                Hasilnya? Sistem ada, strategi ada, tapi pertumbuhan bisnis tetap stagnan.
                            </p>
                            <p>
                                Kami hadir untuk menjembatani jurang tersebut. <strong class="font-medium text-gray-900">Kami memahami Bahasa Teknologi sekaligus Bahasa Bisnis</strong>. Di sesi audit nanti, kami akan gunakan pengalaman kami untuk bantu optimalkan operasional bisnis Anda secara holistik.
                            </p>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">5+ Tahun Pengalaman</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">100+ Sistem Dibangun</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">Full-Stack Developer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CASE STUDY SECTION --}}
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                Studi Kasus: Transformasi Bisnis Retail
            </h2>
            
            <p class="google-text text-center mb-16 max-w-3xl mx-auto">
                Bagaimana digitalisasi mengubah chaos operasional menjadi sistem yang efisien
            </p>
            
            {{-- Case Study Content --}}
            <div class="space-y-12">
                {{-- The Problem --}}
                <div class="google-card p-8 md:p-12">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">Masalahnya</h3>
                            <p class="text-sm text-gray-500">Sebelum digitalisasi</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4 google-text">
                        <p>
                            Bisnis retail dengan <strong class="font-medium text-gray-900">5 cabang</strong> dan omset puluhan juta per bulan. Namun sistem operasionalnya masih sangat manual dan berantakan.
                        </p>
                        <p>
                            <strong class="font-medium text-gray-900">Realita yang terjadi:</strong>
                        </p>
                        <ul class="space-y-2 ml-6 list-disc">
                            <li>Stok barang sering selisih antara gudang dan data Excel</li>
                            <li>Data penjualan antar cabang tidak sinkron</li>
                            <li>Tim admin lembur setiap akhir bulan untuk rekap manual</li>
                            <li>Laporan tetap berantakan dan sering salah meskipun sudah lembur 3 hari</li>
                        </ul>
                    </div>
                </div>
                
                {{-- Root Cause Analysis --}}
                <div class="google-card p-8 md:p-12">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">Akar Masalah</h3>
                            <p class="text-sm text-gray-500">Temuan dari audit mendalam</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4 google-text">
                        <p>
                            Setelah analisis mendalam, masalahnya <strong class="font-medium text-gray-900">bukan pada tim yang tidak becus</strong>, melainkan pada sistem yang masih mengandalkan:
                        </p>
                        <ul class="space-y-3 ml-6 list-disc">
                            <li><strong class="font-medium text-gray-900">Excel</strong> untuk pencatatan stok (sering lupa di-update)</li>
                            <li><strong class="font-medium text-gray-900">WhatsApp Group</strong> untuk koordinasi antar cabang (informasi berceceran)</li>
                            <li><strong class="font-medium text-gray-900">Nota fisik</strong> untuk transaksi (susah dilacak kalau hilang)</li>
                            <li><strong class="font-medium text-gray-900">Rekap manual</strong> akhir bulan (butuh 3 hari dan tetap error)</li>
                        </ul>
                        <p>
                            Dengan sistem seperti ini, mustahil bisnis bisa scale-up. Semakin banyak cabang, semakin chaos prosesnya.
                        </p>
                    </div>
                </div>
                
                {{-- The Solution --}}
                <div class="google-card p-8 md:p-12">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">Solusi yang Diterapkan</h3>
                            <p class="text-sm text-gray-500">Transformasi digital custom-built</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4 google-text mb-8">
                        <p>
                            Kami membedah seluruh alur kerja dari A-Z, mengidentifikasi setiap bottleneck dan potensi human error. Kemudian membangun:
                        </p>
                        <ul class="space-y-3 ml-6 list-disc">
                            <li><strong class="font-medium text-gray-900">Sistem POS Terintegrasi</strong> - Semua transaksi tercatat otomatis, real-time di semua cabang</li>
                            <li><strong class="font-medium text-gray-900">Inventory Management System</strong> - Stok update otomatis setiap ada penjualan atau restok</li>
                            <li><strong class="font-medium text-gray-900">Dashboard Analytics</strong> - Owner bisa pantau performa semua cabang dari mana saja, kapan saja</li>
                            <li><strong class="font-medium text-gray-900">Automated Reports</strong> - Laporan harian, mingguan, bulanan muncul otomatis tanpa perlu rekap manual</li>
                        </ul>
                    </div>
                    
                    {{-- Before After Comparison --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border-2 border-red-200 bg-red-50 rounded-2xl p-6">
                            <div class="text-sm font-medium text-red-600 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                SEBELUM
                            </div>
                            <ul class="space-y-3 google-text">
                                <li class="flex items-start">
                                    <span class="text-red-600 mr-2">✗</span>
                                    <span>Rekap data: 3 hari per bulan</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-600 mr-2">✗</span>
                                    <span>Tim admin lembur terus</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-600 mr-2">✗</span>
                                    <span>Stok sering selisih 10-15%</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-600 mr-2">✗</span>
                                    <span>Laporan tidak akurat</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-red-600 mr-2">✗</span>
                                    <span>Monitoring manual via WA</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="border-2 border-green-200 bg-green-50 rounded-2xl p-6">
                            <div class="text-sm font-medium text-green-600 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                SESUDAH
                            </div>
                            <ul class="space-y-3 google-text">
                                <li class="flex items-start">
                                    <span class="text-green-600 mr-2">✓</span>
                                    <span>Rekap data: Real-time otomatis</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-600 mr-2">✓</span>
                                    <span>Hemat 40+ jam per minggu</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-600 mr-2">✓</span>
                                    <span>Akurasi stok 99.9%</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-600 mr-2">✓</span>
                                    <span>Dashboard live 24/7</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-green-600 mr-2">✓</span>
                                    <span>Monitoring dari smartphone</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                {{-- The Results --}}
                <div class="google-card p-8 md:p-12 border-l-4 border-green-500">
                    <div class="flex items-start space-x-4 mb-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">Hasil Terukur</h3>
                            <p class="text-sm text-gray-500">Bukti nyata dalam hitungan minggu</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4 google-text">
                        <p class="text-lg font-medium text-gray-900">
                            Tanpa menambah jumlah karyawan, tanpa mengubah produk, dan tanpa ekspansi cabang baru... efisiensi operasional mereka meledak:
                        </p>
                        <ul class="space-y-3 ml-6 list-disc">
                            <li><strong class="font-medium text-gray-900">Waktu operasional terpangkas 50%+</strong> - yang tadinya butuh 3 hari, sekarang otomatis real-time</li>
                            <li><strong class="font-medium text-gray-900">Akurasi data mencapai 99.9%</strong> - stok selalu sinkron di semua cabang</li>
                            <li><strong class="font-medium text-gray-900">Biaya lembur berkurang hingga 70%</strong> - tim tidak perlu rekap manual lagi</li>
                            <li><strong class="font-medium text-gray-900">Owner bisa monitoring 24/7</strong> - dari mana saja tanpa harus ke kantor</li>
                        </ul>
                        <p class="text-lg font-medium text-green-600 mt-6">
                            Hanya dalam hitungan minggu, sistem yang tepat menghasilkan transformasi yang luar biasa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ SECTION --}}
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h2 class="google-section-title text-center mb-16">
                Pertanyaan yang Sering Ditanyakan
            </h2>
            
            <div class="space-y-4" x-data="{ openFaq: null }">
                {{-- FAQ 1 --}}
                <div class="border border-gray-300 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition-colors">
                        <span class="google-text-dark font-normal text-base">Apa yang akan saya dapatkan dari audit ini?</span>
                        <svg class="w-5 h-5 text-gray-600 transition-transform" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse class="px-6 pb-5 border-t border-gray-100">
                        <p class="google-text leading-relaxed pt-5">
                            Anda akan mendapat sesi konsultasi 1-on-1 dimana kami akan membedah sistem operasional bisnis Anda, menunjukkan di mana kebocoran waktu terjadi, dan memberikan Digital Roadmap lengkap dengan rekomendasi teknologi yang paling tepat untuk bisnis Anda.
                        </p>
                    </div>
                </div>
                
                {{-- FAQ 2 --}}
                <div class="border border-gray-300 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition-colors">
                        <span class="google-text-dark font-normal text-base">Apakah audit ini benar-benar gratis?</span>
                        <svg class="w-5 h-5 text-gray-600 transition-transform" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse class="px-6 pb-5 border-t border-gray-100">
                        <p class="google-text leading-relaxed pt-5">
                            Ya, 100% gratis. Tidak ada biaya tersembunyi. Kami memberikan konsultasi dan Digital Roadmap secara cuma-cuma. Jika setelah audit Anda tertarik untuk mengimplementasikan solusi bersama kami, barulah ada pembahasan investasi.
                        </p>
                    </div>
                </div>
                
                {{-- FAQ 3 --}}
                <div class="border border-gray-300 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition-colors">
                        <span class="google-text-dark font-normal text-base">Berapa lama hasil audit akan saya terima?</span>
                        <svg class="w-5 h-5 text-gray-600 transition-transform" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse class="px-6 pb-5 border-t border-gray-100">
                        <p class="google-text leading-relaxed pt-5">
                            Dalam 1x24 jam setelah Anda submit form, tim kami akan menghubungi untuk menjadwalkan sesi konsultasi. Sesi audit berlangsung 30-60 menit, dan di akhir sesi Anda langsung mendapat insight & roadmap yang bisa dieksekusi.
                        </p>
                    </div>
                </div>
                
                {{-- FAQ 4 --}}
                <div class="border border-gray-300 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 4 ? null : 4" class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition-colors">
                        <span class="google-text-dark font-normal text-base">Apakah data bisnis saya aman?</span>
                        <svg class="w-5 h-5 text-gray-600 transition-transform" :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" x-collapse class="px-6 pb-5 border-t border-gray-100">
                        <p class="google-text leading-relaxed pt-5">
                            Kami menjaga kerahasiaan data bisnis Anda dengan ketat. Semua informasi yang Anda bagikan dilindungi oleh Non-Disclosure Agreement (NDA) dan hanya akan digunakan untuk keperluan audit Anda.
                        </p>
                    </div>
                </div>
                
                {{-- FAQ 5 --}}
                <div class="border border-gray-300 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 5 ? null : 5" class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition-colors">
                        <span class="google-text-dark font-normal text-base">Apakah audit ini cocok untuk niche bisnis saya?</span>
                        <svg class="w-5 h-5 text-gray-600 transition-transform" :class="{ 'rotate-180': openFaq === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 5" x-collapse class="px-6 pb-5 border-t border-gray-100">
                        <p class="google-text leading-relaxed pt-5">
                            Audit ini cocok untuk hampir semua jenis bisnis yang masih menggunakan proses manual: retail, F&B, manufaktur, jasa, pendidikan, kesehatan, dll. Selama bisnis Anda punya operasional yang berulang, pasti ada ruang untuk digitalisasi.
                        </p>
                    </div>
                </div>
                
                {{-- FAQ 6 --}}
                <div class="border border-gray-300 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 6 ? null : 6" class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition-colors">
                        <span class="google-text-dark font-normal text-base">Kenapa hanya 5 slot per minggu?</span>
                        <svg class="w-5 h-5 text-gray-600 transition-transform" :class="{ 'rotate-180': openFaq === 6 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 6" x-collapse class="px-6 pb-5 border-t border-gray-100">
                        <p class="google-text leading-relaxed pt-5">
                            Kami membatasi slot agar setiap klien mendapat perhatian penuh dan analisis yang mendalam. Audit yang berkualitas membutuhkan riset, persiapan, dan waktu konsultasi yang tidak bisa di-rush. Kualitas lebih penting daripada kuantitas.
                        </p>
                    </div>
                </div>
                
                {{-- FAQ 7 --}}
                <div class="border border-gray-300 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 7 ? null : 7" class="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition-colors">
                        <span class="google-text-dark font-normal text-base">Hasil apa yang bisa saya harapkan setelah audit?</span>
                        <svg class="w-5 h-5 text-gray-600 transition-transform" :class="{ 'rotate-180': openFaq === 7 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 7" x-collapse class="px-6 pb-5 border-t border-gray-100">
                        <p class="google-text leading-relaxed pt-5">
                            Setelah audit, Anda akan punya clarity (kejelasan) tentang bottleneck di bisnis Anda, roadmap konkret untuk digitalisasi, estimasi ROI dari implementasi sistem, dan action plan yang bisa dieksekusi segera—baik dengan kami atau tim internal Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONIAL SECTION --}}
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            {{-- Headline --}}
            <h2 class="google-section-title text-center mb-16">
                Apa Kata Mereka?
            </h2>
            
            {{-- Testimonial Card --}}
            <div class="google-card p-8 md:p-12">
                <div class="flex flex-col md:flex-row items-start space-y-6 md:space-y-0 md:space-x-8">
                    <div class="flex-shrink-0">
                        <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="google-text text-lg md:text-xl leading-relaxed mb-6 italic">
                            "Dulu rekap stok barang butuh waktu 3 hari setiap akhir bulan. Setelah didigitalisasi oleh tim Sultan (Centrova), laporan muncul secara real-time setiap detik. Kami menghemat biaya lembur hingga puluhan juta."
                        </p>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-semibold text-lg">R</span>
                            </div>
                            <div>
                                <p class="google-text-dark font-medium">Owner</p>
                                <p class="google-text text-sm">Retail Business</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CLOSING SECTION --}}
<section class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="google-card p-8 md:p-12 text-center">
                <h2 class="google-section-title mb-6">
                    Jangan Tunggu Sampai Sistem Anda<br class="hidden sm:block"/> 
                    Benar-benar "Lumpuh"
                </h2>
                
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-8 md:p-10 mb-12">
                    <p class="text-xl md:text-2xl font-medium text-gray-900 mb-4">
                        Slot Audit Gratis Terbatas Setiap Minggunya
                    </p>
                    <p class="google-text text-lg">
                        Kami hanya menerima <span class="text-blue-600 font-semibold">5 sesi audit gratis</span> per minggu untuk memastikan kualitas diagnosa operasional yang mendalam bagi setiap klien.
                    </p>
                </div>
                
                {{-- Final CTA --}}
                <div class="space-y-6">
                    <h3 class="text-2xl md:text-3xl font-medium text-gray-900">
                        Siap Menjadikan Bisnis Anda Lebih Pintar & Otomatis?
                    </h3>
                    
                    <a href="#audit-form" class="inline-flex items-center px-10 py-5 text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-2xl transition-colors duration-200 shadow-sm hover:shadow-md">
                        Klaim Sesi Audit & Digital Roadmap Saya
                        <svg class="ml-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    
                    <p class="google-text text-sm md:text-base">
                        Tanpa Komitmen. Tanpa Biaya. 100% Solusi Teknis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- AUDIT FORM SECTION --}}
<section id="audit-form" class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="google-card p-8 md:p-12">
                <h2 class="text-4xl font-semibold tracking-tight text-gray-900 text-center mb-6">
                    Isi Form Audit Sekarang
                </h2>
                <p class="google-text text-center mb-10">
                    Kami akan menghubungi Anda dalam 1x24 jam untuk menjadwalkan sesi konsultasi gratis.
                </p>
                
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="subject" value="AuditorLab - Request Audit">
                    
                    <div>
                        <label for="name" class="block text-sm font-medium google-text-dark mb-2">
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
                        <label for="email" class="block text-sm font-medium google-text-dark mb-2">
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
                        <label for="phone" class="block text-sm font-medium google-text-dark mb-2">
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
                        <label for="company" class="block text-sm font-medium google-text-dark mb-2">
                            Nama Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="company" 
                            name="company" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none google-text"
                            placeholder="PT. Nama Perusahaan Anda"
                        >
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium google-text-dark mb-2">
                            Ceritakan Masalah Operasional Anda <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="5" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all outline-none resize-none google-text"
                            placeholder="Contoh: Tim saya masih rekap data manual di Excel setiap hari dan sering terjadi kesalahan data..."
                        ></textarea>
                    </div>
                    
                    <button 
                        type="submit"
                        class="w-full bg-blue-600 text-white font-medium py-4 rounded-2xl hover:bg-blue-700 transition-colors duration-200 shadow-sm hover:shadow-md"
                    >
                        Kirim & Klaim Audit Gratis
                    </button>
                    
                    <p class="text-xs google-text text-center">
                        Dengan mengirim form ini, Anda menyetujui kami untuk menghubungi Anda terkait konsultasi digitalisasi bisnis.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
