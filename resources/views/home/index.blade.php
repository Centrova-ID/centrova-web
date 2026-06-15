@extends('partials.layouts.main')

@section('title', 'Centrova | AI Venture Engineering, Software Development & AI Agent Automation')

@section('seoMetaTags')
    <meta name="description" content="PT Centrova Teknologi Indonesia adalah AI Venture Engineering company yang membantu bisnis membangun software, AI-powered systems, dan AI Agent Automation untuk meningkatkan efisiensi, mempercepat pertumbuhan, dan mendorong transformasi digital.">
    <meta name="keywords" content="Centrova, PT Centrova Teknologi Indonesia, AI Venture Engineering, Software Development, AI Agent Automation, Artificial Intelligence Indonesia, Custom Software Development, AI Solutions, Business Automation, AI Agent Development, Web Application Development, Mobile Application Development, SaaS Development, Intelligent Automation, centrova, centrova.id, centrova indonesia, centrova teknologi">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="language" content="Indonesian">
    <meta name="author" content="PT Centrova Teknologi Indonesia">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Hreflang --}}
    <link rel="alternate" href="{{ url()->current() }}" hreflang="id">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="x-default">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Centrova | AI Venture Engineering, Software Development & AI Agent Automation">
    <meta property="og:description" content="PT Centrova Teknologi Indonesia - AI Venture Engineering company spesialis software development, AI-powered systems, dan AI Agent Automation untuk transformasi digital bisnis Anda.">
    <meta property="og:image" content="{{ asset('thumbnail.png') }}">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="1080">
    <meta property="og:image:alt" content="Centrova - AI Venture Engineering & Software Development Indonesia">
    <meta property="og:site_name" content="Centrova">
    <meta property="og:locale" content="id_ID">
    <meta property="og:country-name" content="Indonesia">
    <meta property="business:contact_data:country_name" content="Indonesia">

    {{-- Twitter/X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Centrova | AI Venture Engineering & Software Development Indonesia">
    <meta name="twitter:description" content="PT Centrova Teknologi Indonesia - AI Venture Engineering. Bangun software, AI-powered systems, dan AI Agent Automation untuk efisiensi dan pertumbuhan bisnis Anda.">
    <meta name="twitter:image" content="{{ asset('thumbnail.png') }}">
    <meta name="twitter:image:alt" content="Centrova Logo - AI Venture Engineering Indonesia">
    <meta name="twitter:site" content="@centrova_id">
    <meta name="twitter:creator" content="@centrova_id">

    {{-- Geo Tags for Local SEO --}}
    <meta name="geo.region" content="ID">
    <meta name="geo.country" content="ID">

    {{-- Verify for Google Search Console --}}
    @if(config('services.google.site_verification'))
    <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
    @endif

    {{-- Verify for Bing --}}
    @if(config('services.bing.site_verification'))
    <meta name="msvalidate.01" content="{{ config('services.bing.site_verification') }}">
    @endif
@endsection

@push('structured-data')
    {{-- Organization Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "@id": "https://centrova.id/#organization",
      "name": "Centrova",
      "legalName": "PT Centrova Teknologi Indonesia",
      "url": "https://centrova.id",
      "logo": {
        "@type": "ImageObject",
        "url": "https://centrova.id/assets/brand/centrova-logo.svg",
        "width": 131,
        "height": 24
      },
      "image": "https://centrova.id/thumbnail.png",
      "description": "AI Venture Engineering company specializing in Software Development, AI-powered Systems, and AI Agent Automation. Membantu bisnis membangun software dan AI automation.",
      "foundingDate": "2025",
      "foundingLocation": {
        "@type": "Place",
        "name": "Indonesia"
      },
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "ID"
      },
      "sameAs": [
        "https://linkedin.com/company/centrova",
        "https://instagram.com/centrova.id",
        "https://centrova.id"
      ],
      "knowsAbout": [
        "AI Automation",
        "Software Development",
        "AI Agents",
        "Web Development",
        "Mobile Applications",
        "Digital Transformation"
      ],
      "areaServed": { "@type": "Country", "name": "Indonesia" }
    }
    </script>

    {{-- WebSite Schema with SearchAction (Google Sitelinks Search Box) --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "@id": "https://centrova.id/#website",
      "url": "https://centrova.id",
      "name": "Centrova",
      "description": "AI Venture Engineering & Software Development - AI Agent Automation, AI-powered Systems, dan Custom Software Development",
      "publisher": {
        "@id": "https://centrova.id/#organization"
      },
      "inLanguage": "id",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "https://centrova.id/search?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    {{-- WebPage Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "@id": "https://centrova.id/#webpage",
      "url": "https://centrova.id",
      "name": "Centrova | AI Venture Engineering, Software Development & AI Agent Automation",
      "description": "PT Centrova Teknologi Indonesia adalah AI Venture Engineering company yang membantu bisnis membangun software, AI-powered systems, dan AI Agent Automation untuk meningkatkan efisiensi, mempercepat pertumbuhan, dan mendorong transformasi digital.",
      "about": {
        "@id": "https://centrova.id/#organization"
      },
      "isPartOf": {
        "@id": "https://centrova.id/#website"
      },
      "primaryImageOfPage": {
        "@type": "ImageObject",
        "url": "https://centrova.id/thumbnail.png"
      },
      "inLanguage": "id",
      "datePublished": "2025-09-13",
      "dateModified": "2026-06-15"
    }
    </script>

    {{-- BreadcrumbList Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "@id": "https://centrova.id/#breadcrumb",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Beranda",
        "item": "https://centrova.id"
      }]
    }
    </script>
@endpush

@section('link-head')
    {{-- Preconnect to common external image hosts --}}
    <link rel="preconnect" href="https://plus.unsplash.com">
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preconnect" href="https://lookaside.fbsbx.com">
@endsection

@section('content')

    <div class="relative">
        {{-- Main Hero --}}
        <section class="relative overflow-hidden">
            {{-- Content --}}
            <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:pt-32 pb-20 flex justify-center items-center text-center">
                <div class="max-w-5xl">
                    <h1 class="text-4xl md:text-7xl font-semibold tracking-[-4%] mb-8">
                        Build Smarter. <br class="md:hidden"> Scale Faster. <br> With <span class="bg-gradient-to-r from-cyan-500 via-blue-600 to-purple-700 bg-clip-text text-transparent">AI Automation.</span>
                    </h1>
                    <p class="text-lg w-full max-w-3xl mx-auto text-neutral-950 tracking-tight mb-8">
                        Centrova membantu bisnis membangun software, AI-powered systems, dan AI Agent Automation untuk meningkatkan efisiensi, mempercepat pertumbuhan, dan menciptakan keunggulan kompetitif.
                    </p>
                    <div class="flex justify-center items-center gap-x-5">
                        <a href="#" class="py-4 px-6 rounded-full bg-primary-500 hover:bg-primary-600 transition text-white font-medium">Mulai konsultasi</a>
                        <a href="#" class="py-4 px-6 rounded-full bg-neutral-50 hover:bg-neutral-100 transition text-primary-600 font-medium">Jelajahi layanan</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Layanan Kami --}}
        <section class="py-20 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl max-w-4xl mx-auto font-medium tracking-tighter text-neutral-900 mb-4">Memperkuat sistem bisnis melalui digitalisasi dan otomasi</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                    
                    {{-- Card 1 --}}
                    <article class="font-sans rounded-2xl overflow-hidden bg-white border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col h-full">
                        <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                             alt="Tim mengembangkan layanan web - Centrova"
                             loading="lazy"
                             decoding="async"
                             class="w-full aspect-video object-cover">
                             
                        <div class="px-6 pt-5 pb-7 flex flex-col flex-1 text-neutral-900">
                            <div class="flex-1 mb-6">
                                <h3 class="text-2xl font-semibold tracking-tight mb-2 text-neutral-950">AI Venture Engineering</h3>
                                <p class="text-lg text-neutral-900 font-normal leading-relaxed">Merancang dan membangun produk digital berbasis AI.</p>
                            </div>
                            
                            <a href="{{ route('services.index') }}" class="inline-flex items-center text-primary-500 font-semibold transition group mt-auto">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-4 h-4 ml-1 mt-0.5 transform group-hover:translate-x-0.5 transition-transform duration-150" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>

                    {{-- Card 2 --}}
                    <article class="font-sans rounded-2xl overflow-hidden bg-white border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col h-full">
                        <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                             alt="Tim mengembangkan layanan web - Centrova"
                             loading="lazy"
                             decoding="async"
                             class="w-full aspect-video object-cover">
                             
                        <div class="px-6 pt-5 pb-7 flex flex-col flex-1 text-neutral-900">
                            <div class="flex-1 mb-6">
                                <h3 class="text-2xl font-semibold tracking-tight mb-2 text-neutral-950">Software Development</h3>
                                <p class="text-lg text-neutral-900 font-normal leading-relaxed">Web applications, mobile applications, SaaS platforms, dan custom software.</p>
                            </div>
                            
                            <a href="{{ route('services.index') }}" class="inline-flex items-center text-primary-500 font-semibold transition group mt-auto">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-4 h-4 ml-1 mt-0.5 transform group-hover:translate-x-0.5 transition-transform duration-150" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>

                    {{-- Card 3 --}}
                    <article class="font-sans rounded-2xl overflow-hidden bg-white border border-neutral-200 hover:shadow transition-shadow duration-150 flex flex-col h-full">
                        <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                             alt="Tim mengembangkan layanan web - Centrova"
                             loading="lazy"
                             decoding="async"
                             class="w-full aspect-video object-cover">
                             
                        <div class="px-6 pt-5 pb-7 flex flex-col flex-1 text-neutral-900">
                            <div class="flex-1 mb-6">
                                <h3 class="text-2xl font-semibold tracking-tight mb-2 text-neutral-950">AI Agent Automation</h3>
                                <p class="text-lg text-neutral-900 font-normal leading-relaxed">AI Agents dan intelligent automation untuk mengurangi pekerjaan manual dan meningkatkan produktivitas.</p>
                            </div>
                            
                            <a href="{{ route('services.index') }}" class="inline-flex items-center text-primary-500 font-semibold transition group mt-auto">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-4 h-4 ml-1 mt-0.5 transform group-hover:translate-x-0.5 transition-transform duration-150" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- Dampak AI --}}
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Headline --}}
                <div class="text-center mb-16 max-w-3xl mx-auto">
                    <h2 class="text-4xl max-w-4xl mx-auto font-medium tracking-tighter text-neutral-900 mb-4">
                        Potensi Besar AI untuk Meningkatkan Kinerja Bisnis
                    </h2>
                </div>

                {{-- Stats Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center max-w-6xl mx-auto">
                    {{-- Stat 1 --}}
                    <div class="flex flex-col items-center px-4">
                        <span class="text-4xl font-bold text-[#128AEB] mb-5 tracking-tight">
                            70%+
                        </span>
                        <p class="text-base text-neutral-900 font-normal leading-relaxed max-w-sm">
                            Waktu kerja administratif masih dihabiskan untuk tugas berulang yang sebenarnya dapat diotomatisasi.
                        </p>
                    </div>

                    {{-- Stat 2 --}}
                    <div class="flex flex-col items-center px-4">
                        <span class="text-4xl font-bold text-[#128AEB] mb-5 tracking-tight whitespace-nowrap">
                            2x Lebih Cepat
                        </span>
                        <p class="text-base text-neutral-900 font-normal leading-relaxed max-w-sm">
                            Proses operasional dapat berjalan lebih efisien dengan integrasi AI dan workflow automation yang tepat.
                        </p>
                    </div>

                    {{-- Stat 3 --}}
                    <div class="flex flex-col items-center px-4">
                        <span class="text-4xl font-bold text-[#128AEB] mb-5 tracking-tight">
                            24/7
                        </span>
                        <p class="text-base text-neutral-900 font-normal leading-relaxed max-w-sm">
                            AI Agent mampu melayani pelanggan, menjawab pertanyaan, dan menjalankan proses bisnis tanpa henti.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Industries --}}
        <section class="py-16 bg-neutral-100 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12">
                    <h2 class="text-4xl max-w-4xl mx-auto font-medium tracking-tighter text-gray-900 mb-4">Mengembangkan Masa Depan Industri Anda</h2>
                </div>
                
                {{-- Industries List --}}
                <div class="grid grid-cols-1 gap-8">
                    {{-- Industri Software --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Industri Software</h3>
                                <p class="text-neutral-800">Berfokus pada kecepatan siklus pengembangan melalui metodologi Agile dan DevOps untuk menghasilkan produk yang stabil namun adaptif. Kuncinya adalah kolaborasi tim yang lancar dan otomatisasi sistem (CI/CD) agar peluncuran fitur baru bisa dilakukan secara instan tanpa hambatan teknis bagi pengguna.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_software"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-200 aspect-square">
                            <img src="{{ asset('assets/image/home/industri_software.jpg') }}" class="w-full h-full object-cover" alt="Industri Software">
                        </div>
                    </div>

                    {{-- Teknologi Keuangan --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="bg-neutral-200 aspect-square order-2 lg:order-1">
                            <img src="{{ asset('assets/image/home/industri_keuangan.jpg') }}" class="w-full h-full object-cover" alt="Teknologi Keuangan">
                        </div>
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center order-1 lg:order-2">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Teknologi Keuangan</h3>
                                <p class="text-neutral-800">Memberikan solusi transaksi digital yang aman, cepat, dan terintegrasi. Kami membantu membangun ekosistem pembayaran, manajemen aset, dan sistem perbankan digital untuk meningkatkan inklusi keuangan dan efisiensi operasional bisnis Anda.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_fintech"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Transportasi & Logistik --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Transportasi & Logistik</h3>
                                <p class="text-neutral-800">Optimalkan pergerakan barang dan orang dengan sistem pelacakan real-time, manajemen armada, dan integrasi rantai pasokan. Solusi kami dirancang untuk mengurangi biaya operasional dan mempercepat waktu pengiriman melalui efisiensi berbasis data.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_logistics"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-200 aspect-square">
                            <img src="{{ asset('assets/image/home/industri_transportasi_logistik.jpg') }}" class="w-full h-full object-cover" alt="Transportasi & Logistik">
                        </div>
                    </div>

                    {{-- Sektor Pendidikan --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="bg-neutral-200 aspect-square order-2 lg:order-1">
                            <img src="{{ asset('assets/image/home/sektor_pendidikan.jpg') }}" class="w-full h-full object-cover" alt="Sektor Pendidikan">
                        </div>
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center order-1 lg:order-2">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Sektor Pendidikan</h3>
                                <p class="text-neutral-800">Mendigitalisasi proses belajar mengajar dengan Learning Management Systems (LMS), platform ujian online, dan sistem administrasi sekolah yang terpadu untuk menciptakan pengalaman belajar yang lebih interaktif, inklusif, dan aksesibel bagi semua.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_education"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Medical System --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Medical System</h3>
                                <p class="text-neutral-800">Solusi teknologi kesehatan profesional untuk manajemen data pasien (EMR), sistem janji temu, dan telemedis. Kami memprioritaskan privasi data, kepatuhan regulasi, dan kemudahan akses layanan kesehatan bagi masyarakat melalui inovasi digital.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_medical"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-200 aspect-square">
                            <img src="{{ asset('assets/image/home/medical_system.jpg') }}" class="w-full h-full object-cover" alt="Medical System">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Penawaran Section --}}
        <section class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="w-full bg-sky-100 rounded-xl min-h-[400px] lg:h-[540px] flex items-center justify-center lg:justify-start relative overflow-hidden">
                    <div class="absolute inset-0 w-full h-full z-0">
                        <img src="{{ asset('assets/image/home/a2d67684-5efc-6ad8-2cb3-6034d420e88cba88d902848fa4415ffca75da09a257e0c938ac6.webp') }}" class="h-full object-cover w-full" alt="Ilustrasi pembuatan website - Centrova" loading="lazy" decoding="async">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 relative z-10 w-full">
                        <div class="w-full flex justify-center items-center h-full px-6 sm:px-12 lg:px-24 py-10">
                            <div class="flex flex-col max-md:items-center max-md:text-center">
                                <h2 class="font-semibold text-gray-900 text-3xl sm:text-4xl mt-2 leading-snug">
                                    Ubah Ide Anda Menjadi Kenyataan
                                </h2>
                                <p class="text-gray-900 mt-4 text-base sm:text-lg">
                                    Mulailah bangun rumah online Anda dengan memiliki website untuk merek Anda.
                                </p>
                                <div>
                                    <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                        Dapatkan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection