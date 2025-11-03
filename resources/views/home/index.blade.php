@extends('partials.layouts.main')

@section('title', 'Centrova - Solusi Digital untuk Bisnis Anda')

@section('seoMetaTags')
        <meta name="description" content="Centrova adalah startup teknologi Indonesia yang menyediakan solusi digital terintegrasi untuk bisnis. Kami menghadirkan layanan pengembangan website, aplikasi, dan sistem bisnis seperti POS, CRM, dan ERP untuk mendukung transformasi digital yang efisien dan berkelanjutan.">
        <meta name="keywords" content="Centrova, web service, layanan digital, pengembangan website, pengembangan aplikasi, sistem POS, CRM, ERP, transformasi digital, teknologi Indonesia, software bisnis">
        <meta name="robots" content="index, follow">
        <meta name="language" content="Indonesian">
        <meta name="author" content="Centrova Indonesia">

        {{-- Open Graph / Facebook --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="Centrova - Solusi Digital untuk Bisnis Anda">
        <meta property="og:description" content="Centrova adalah startup teknologi Indonesia yang menyediakan solusi digital terintegrasi untuk bisnis. Kami menghadirkan layanan pengembangan website, aplikasi, dan sistem bisnis seperti POS, CRM, dan ERP untuk mendukung transformasi digital yang efisien dan berkelanjutan.">
        <meta property="og:image" content="{{ asset('images/centrova-og-image.jpg') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:site_name" content="Centrova Indonesia">
        <meta property="og:locale" content="id_ID">

        {{-- Twitter --}}
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="Centrova - Solusi Digital untuk Bisnis Anda">
        <meta property="twitter:description" content="Centrova adalah startup teknologi Indonesia yang menyediakan solusi digital terintegrasi untuk bisnis. Kami menghadirkan layanan pengembangan website, aplikasi, dan sistem bisnis seperti POS, CRM, dan ERP untuk mendukung transformasi digital yang efisien dan berkelanjutan.">
        <meta property="twitter:image" content="{{ asset('images/centrova-og-image.jpg') }}">
        <meta property="twitter:site" content="@centrova_id">
        <meta property="twitter:creator" content="@centrova_id">
@endsection

@section('link-head')
    {{-- Preload hero image (LCP) and preconnect to common external image hosts to reduce DNS/TLS latency --}}
    <link rel="preload" as="image" href="{{ asset('assets/image/home/hero_image_business.jpg') }}">
    <link rel="preconnect" href="https://plus.unsplash.com">
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preconnect" href="https://lookaside.fbsbx.com">
@endsection

@section('content')

    <div class="relative">
        {{-- Main Hero --}}
        <div class="relative">
            {{-- Background image with overlay --}}
                <div class="absolute inset-0">
                    <img src="{{ asset('assets/image/home/hero_image_business.jpg') }}"
                         class="w-full h-full object-cover"
                         alt="Hero background - Solusi Digital Centrova"
                         loading="eager"
                         decoding="async"
                         fetchpriority="high"
                         width="1600"
                         height="900">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-white/40 to-transparent"></div>
                </div>
            
            {{-- Content --}}
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 min-h-[550px] flex items-center text-slate-900">
                <div class="max-w-lg space-y-6">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-semibold leading-tight">
                        Solusi Digital untuk Bisnis Anda
                    </h1>
                    <p class="text-base sm:text-lg">
                        Centrova membantu Anda mengelola bisnis dengan lebih efisien melalui solusi software inovatif.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ localizedRoute('services.index') }}?utm_source=learn" 
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 min-h-[44px]">
                            Pelajari selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Featured Products Grid --}}
        <div class="pt-16 pb-10" id="produk">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Tim mengembangkan layanan web - Centrova"
                        loading="lazy"
                        decoding="async"
                        width="870"
                        height="489"
                        class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Pengembangan Perangkat Lunak</h3>
                            <p class="text-[18px] font-medium mb-2">Kami ahli dalam merancang solusi perangkat lunak berkualitas sesuai kebutuhan Anda.</p>
                            <a href="{{ route('services.index') }}" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition h-11 px-2">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <img src="https://images.unsplash.com/photo-1667984390553-7f439e6ae401?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Infrastruktur dan arsitektur server"
                        loading="lazy"
                        decoding="async"
                        width="1032"
                        height="579"
                        class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Infrastruktur</h3>
                            <p class="text-[18px] font-medium mb-2">Membangun infrastruktur TI yang kuat dan skalabel untuk mendukung bisnis Anda.</p>
                            <a href="/layanan/app-development" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition h-11 px-2">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <img src="{{ asset('assets/image/home/cs_20251017_17282871894827354.jpg') }}"
                        alt="Dukungan teknis tim Centrova"
                        loading="lazy"
                        decoding="async"
                        width="870"
                        height="489"
                        class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Dukungan</h3>
                            <p class="text-[18px] font-medium mb-2">Memberikan dukungan terbaik untuk memastikan operasional TI Anda berjalan dengan lancar.</p>
                            <a href="{{ route('support.home') }}" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition h-11 px-2">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <img src="{{ asset('assets/image/home/data_security_x7a3m2q9t0l5c1z8n6r4y3b9v1p7f0d5g2s6j8w4k9h1.jpg') }}"
                        alt="Keamanan data dan privasi"
                        loading="lazy"
                        decoding="async"
                        width="870"
                        height="489"
                        class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Keamanan Data</h3>
                            <p class="text-[18px] font-medium mb-2">Menjaga keamanan dan kerahasiaan data bisnis penting Anda.</p>
                            <a href="{{ route('legal.privacy') }}" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition h-11 px-2">
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

        {{-- Penawaran Section --}}
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Hero Box -->
                <div class="w-full bg-sky-100 rounded-[36px] min-h-[400px] lg:h-[540px] flex items-center justify-center lg:justify-start relative overflow-hidden">
                    <div class="max-w-md h-full flex flex-col justify-center text-center lg:text-left z-10 p-8 sm:p-12 lg:p-16">
                        <span class="text-base font-medium text-slate-900">Jasa Pembuatan Website</span>
                        <h2 class="font-bold text-slate-900 text-3xl sm:text-4xl mt-2 leading-snug">
                            Ubah Ide Anda Menjadi Kenyataan
                        </h2>
                        <p class="text-slate-800 mt-4 text-base sm:text-lg">
                            Mulailah bangun "rumah" online Anda dengan memiliki website untuk merek Anda.
                        </p>
                        <div>
                                     <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                                         class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px]">
                                Dapatkan Sekarang
                            </a>
                        </div>
                    </div>
                    <div class="absolute w-full h-full">
                        <img src="{{ asset('assets/image/home/a2d67684-5efc-6ad8-2cb3-6034d420e88cba88d902848fa4415ffca75da09a257e0c938ac6.jpg') }}" class="h-full bg-cover w-full" alt="Ilustrasi pembuatan website - Centrova" loading="lazy" decoding="async">
                    </div>
                </div>

                {{-- Cards Section --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-12">
                    {{-- Card 1 --}}
                    <div class="w-full px-4 sm:px-8 lg:px-16">
                        <img src="https://www.exabytes.co.id/wp-content/uploads/product-icon-ecommerce-1-1.svg" alt="E-commerce Icon" class="h-[79px] mb-5 mx-0">
                        <span class="text-base text-slate-900 block text-left">Jasa Pembuatan Toko Online</span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2 mb-3 text-left">
                            Segalanya Dimulai dari Toko Online
                        </h3>
                        <p class="text-slate-700 text-left">
                            Kami siap membantu Anda membangun toko online yang sesuai dengan kebutuhan Anda. Tingkatkan kehadiran digital bisnis Anda dan capai lebih banyak pelanggan secara online bersama kami!
                        </p>
                        <div class="flex justify-start">
                                     <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                                         class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-400 hover:border-[#128AEB] text-base font-semibold rounded-full text-sky-700 hover:text-[#128AEB] transition duration-150 mt-8 min-h-[44px]">
                                Coba Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 2 --}}
                    <div class="w-full px-4 sm:px-8 lg:px-16">
                        <img src="https://www.exabytes.co.id/wp-content/uploads/product-icon-hosting-2.svg" alt="Hosting Icon" class="h-[79px] mb-5 mx-0">
                        <span class="text-base text-slate-900 block text-left">Website Profil Perusahaan</span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2 mb-3 text-left">
                            Hosting Website di Tempat yang Tepat, Aman & Cepat
                        </h3>
                        <p class="text-slate-700 text-left">
                            Layanan kami menyertakan backup harian untuk file web Anda dan menggunakan server super cepat yang didedikasikan khusus untuk kebutuhan Anda. Percayakan keberhasilan online Anda pada layanan hosting terbaik kami!
                        </p>
                        <div class="flex justify-start">
                                     <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                                         class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-400 hover:border-[#128AEB] text-base font-semibold rounded-full text-sky-700 hover:text-[#128AEB] transition duration-150 mt-8 min-h-[44px]">
                                Coba Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Paket Lengkap Section --}}
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Hero Box -->
                <div class="w-full bg-sky-100 rounded-[36px] min-h-[400px] lg:h-[540px] flex items-center justify-center lg:justify-start relative overflow-hidden">
                    <div class="absolute w-full h-full">
                            <img src="{{ asset('assets/image/home/f416765167bbdf72.jpg') }}" class="h-full bg-cover w-full" alt="Paket layanan Centrova" loading="lazy" decoding="async">
                        </div>
                    <div class="max-w-md h-full flex flex-col justify-center text-center lg:text-left z-10 p-8 sm:p-12 lg:p-16">
                        <span class="text-base font-medium text-slate-900">Jasa Desain Website</span>
                        <h2 class="font-bold text-slate-900 text-3xl sm:text-4xl mt-2 leading-snug">
                            Paket Design <br> Web Super Lengkap
                        </h2>
                        <p class="text-slate-800 mt-4 text-base sm:text-lg">
                            Dapatkan website profesional yang memperkuat brand dan meningkatkan penjualan.
                        </p>
                        <div>
                            <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                           class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px]">
                            Dapatkan Sekarang</a>
                        </div>
                    </div>
                </div>

                {{-- Cards Section. Reff: https://www.exabytes.co.id/design --}}
                <div class="grid grid-cols-4 gap-7 mt-12">
                    {{-- Feature: Gratis Nama Domain --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h3 class="text-xl font-medium mb-5">Gratis Nama Domain</h3>
                        <p class="text-base text-slate-800">Pilih nama domain .COM / .ID / .CO.ID gratis saat Anda membuat website bersama kami.</p>
                    </div>

                    {{-- Feature: Personalisasi Sesuai Keinginan --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h3 class="text-xl font-medium mb-5">Personalisasi Sesuai Keinginan</h3>
                        <p class="text-base text-slate-800">Desain profesional dan copywriting yang dibuat khusus untuk merek dan tujuan bisnis Anda.</p>
                    </div>

                    {{-- Feature: Dioptimalkan Untuk SEO & Mobile --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h3 class="text-xl font-medium mb-5">Dioptimalkan untuk SEO & Mobile</h3>
                        <p class="text-base text-slate-800">Website SEO-friendly dan responsif di semua perangkat untuk meningkatkan visibilitas dan konversi.</p>
                    </div>

                    {{-- Feature: Dasbor Ramah Pengguna --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h3 class="text-xl font-medium mb-5">Dasbor Ramah Pengguna</h3>
                        <p class="text-base text-slate-800">Kelola konten dan update website dengan mudah lewat dasbor intuitif tanpa perlu keahlian teknis.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Latest Insights Section --}}
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Terbaru dari Centrova</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <article class="overflow-hidden">
                        <a href="{{ route('news.home') }}">
                            <div class="aspect-video bg-neutral-200 overflow-hidden rounded-3xl relative">
                                <img src="https://lookaside.fbsbx.com/elementpath/media/?media_id=1320873176424839&version=1757543352&transcode_extension=webp" alt="Ilustrasi transformasi digital" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            </div>
                            <div class="pt-6">
                                <h3 class="text-xl text-slate-900">5 Tren Digital Transformation yang Harus Diketahui di 2024</h3>
                            </div>
                        </a>
                    </article>
                    
                    <article class="overflow-hidden">
                        <a href="{{ route('news.home') }}">
                            <div class="aspect-video bg-neutral-200 overflow-hidden rounded-3xl relative">
                                <img src="https://lookaside.fbsbx.com/elementpath/media/?media_id=1531311658047829&version=1757543328&transcode_extension=webp" alt="Ilustrasi business analytics dan data" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            </div>
                            <div class="pt-6">
                                <h3 class="text-xl text-slate-900">Mengoptimalkan Business Intelligence dengan Data Analytics</h3>
                            </div>
                        </a>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection