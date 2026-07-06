@extends('partials.layouts.main')

@section('title', 'Centrova | AI Venture Engineering, Software Development & AI Agent Automation')

@section('seoMetaTags')
    <meta name="description" content="Centrova adalah AI Venture Engineering company di Indonesia yang menyediakan jasa AI Agent Development, AI Automation, Custom Software Development, SaaS Development, Web & Mobile App Development untuk membantu bisnis tumbuh lebih cepat dan efisien.">
    <meta name="keywords" content="Centrova, PT Centrova Teknologi Indonesia, AI Venture Engineering, Software Development, AI Agent Automation, Artificial Intelligence Indonesia, Custom Software Development, AI Solutions, Business Automation, AI Agent Development, Web Application Development, Mobile Application Development, SaaS Development, Intelligent Automation, centrova, centrova.id, centrova indonesia, centrova teknologi">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="language" content="Indonesian">
    <meta name="author" content="PT Centrova Teknologi Indonesia">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ canonical_url() }}">

    {{-- Hreflang --}}
    <link rel="alternate" href="{{ canonical_url() }}" hreflang="id">
    <link rel="alternate" href="{{ canonical_url() }}" hreflang="x-default">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ canonical_url() }}">
    <meta property="og:title" content="Centrova | AI Venture Engineering, Software Development & AI Agent Automation">
    <meta property="og:description" content="PT Centrova Teknologi Indonesia - AI Venture Engineering company spesialis software development, AI-powered systems, dan AI Agent Automation untuk transformasi digital bisnis Anda.">
    <meta property="og:image" content="{{ config('app.url') }}/thumbnail.png">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="1080">
    <meta property="og:image:alt" content="Centrova - AI Venture Engineering & Software Development Indonesia">
    <meta property="og:image:type" content="image/png">
    <meta property="og:site_name" content="Centrova">
    <meta property="og:locale" content="id_ID">
    <meta property="og:country-name" content="Indonesia">
    <meta property="business:contact_data:country_name" content="Indonesia">

    {{-- Twitter/X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ canonical_url() }}">
    <meta name="twitter:title" content="Centrova | AI Venture Engineering & Software Development Indonesia">
    <meta name="twitter:description" content="PT Centrova Teknologi Indonesia - AI Venture Engineering. Bangun software, AI-powered systems, dan AI Agent Automation untuk efisiensi dan pertumbuhan bisnis Anda.">
    <meta name="twitter:image" content="{{ config('app.url') }}/thumbnail.png">
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
      "@id": "{{ config('app.url') }}/#organization",
      "name": "Centrova",
      "alternateName": "PT Centrova Teknologi Indonesia",
      "url": "{{ config('app.url') }}",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ config('app.url') }}/assets/images/centrova-logo.png",
        "width": 512,
        "height": 512
      },
      "image": "{{ config('app.url') }}/thumbnail.png",
      "description": "AI Venture Engineering company specializing in Software Development, AI-powered Systems, and AI Agent Automation.",
      "foundingDate": "2025",
      "legalName": "PT Centrova Teknologi Indonesia",
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
        "https://instagram.com/centrova_id",
        "{{ config('app.url') }}"
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

    {{-- WebSite Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "@id": "{{ config('app.url') }}/#website",
      "url": "{{ config('app.url') }}",
      "name": "Centrova",
      "alternateName": "PT Centrova Teknologi Indonesia",
      "description": "AI Venture Engineering company specializing in Software Development, AI-powered Systems, and AI Agent Automation.",
      "publisher": {
        "@id": "{{ config('app.url') }}/#organization"
      },
      "inLanguage": "id"
    }
    </script>

    {{-- WebPage Schema --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "@id": "{{ config('app.url') }}/#webpage",
      "url": "{{ config('app.url') }}",
      "name": "Centrova | AI Venture Engineering, Software Development & AI Agent Automation",
      "description": "AI Venture Engineering company specializing in Software Development, AI-powered Systems, and AI Agent Automation.",
      "about": {
        "@id": "{{ config('app.url') }}/#organization"
      },
      "isPartOf": {
        "@id": "{{ config('app.url') }}/#website"
      },
      "primaryImageOfPage": {
        "@type": "ImageObject",
        "url": "{{ config('app.url') }}/thumbnail.png"
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
      "@id": "{{ config('app.url') }}/#breadcrumb",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Beranda",
        "item": "{{ config('app.url') }}"
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
        {{-- Main Hero — Meta-style full-bleed photographic hero with dual-CTA --}}
        <section class="relative overflow-hidden bg-white">
            <div class="max-w-7xl mx-auto px-7 lg:px-8">
                <div class="flex flex-col-reverse lg:flex-row justify-center items-center text-center lg:text-left gap-x-16 gap-y-8 py-10 md:py-20">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-6 text-neutral-900">
                            Tingkatkan Produktivitas dengan <span class="bg-gradient-to-r from-cyan-500 via-blue-600 to-purple-700 bg-clip-text text-transparent">AI Automation.</span>
                        </h1>
                        <p class="text-lg md:text-xl w-full max-w-3xl font-normal text-neutral-600 tracking-tight mb-8">
                            Bangun sistem otomatis yang bekerja 24/7 untuk mendukung operasional dan pertumbuhan bisnis Anda.
                        </p>
                        {{-- Meta-style dual-CTA: primary (filled) + secondary (outlined ghost) --}}
                        <div class="flex max-lg:flex-col lg:flex-row lg:justify-start justify-center items-center gap-x-4 gap-y-4">
                            <a href="{{ route('service.consult') }}" class="py-3.5 px-7 max-lg:w-full rounded-full bg-primary-600 hover:bg-primary-700 transition text-white font-semibold text-base">Jadwalkan Konsultasi</a>
                            <a href="{{ route('services.index') }}" class="py-3 px-7 max-lg:w-full rounded-full border-2 border-primary-600 hover:bg-primary-50 transition text-primary-600 font-semibold text-base">Jelajahi layanan lainnya</a>
                        </div>
                    </div>
                    <div class="w-full max-w-lg lg:max-w-none">
                        <img src="@img('assets/image/ai_automation_illustration.webp', ['w' => 800, 'fit' => 'contain'])" alt="Ilustrasi Otomasi AI" class="w-full object-contain" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </section>

        {{-- Layanan Kami — Meta-style card-product-feature with rounded-[32px] (xxxl) --}}
        <section class="py-20 bg-neutral-100">
            <div class="max-w-7xl mx-auto px-7 lg:px-8">
                <div class="text-center mb-14">
                    <h2 class="text-4xl md:text-5xl max-w-4xl mx-auto font-bold tracking-tight text-neutral-900">Memperkuat sistem bisnis melalui digitalisasi dan otomasi</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    {{-- Card 1 --}}
                    <article class="rounded-[32px] overflow-hidden bg-white border border-neutral-200 hover:border-neutral-300 transition-all duration-200 flex flex-col h-full">
                        <img src="@img('assets/image/U2FuZGkxMjM.webp', ['w' => 600, 'fit' => 'crop', 'h' => 338])"
                             alt="Tim mengembangkan layanan web - Centrova"
                             loading="lazy"
                             decoding="async"
                             fetchpriority="low"
                             class="w-full aspect-video object-cover">
                             
                        <div class="px-8 pt-6 pb-8 flex flex-col flex-1">
                            <div class="flex-1 mb-6">
                                <h3 class="text-2xl font-bold tracking-tight mb-3 text-neutral-900">AI Venture Engineering</h3>
                                <p class="text-neutral-600 leading-relaxed">Merancang dan membangun produk digital berbasis AI.</p>
                            </div>
                            
                            <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center rounded-full border-2 border-primary-600 px-6 py-2.5 text-sm font-bold text-primary-600 hover:bg-primary-50 transition self-start gap-1.5" target="_blank" rel="noopener noreferrer">
                                Learn more
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </article>

                    {{-- Card 2 --}}
                    <article class="rounded-[32px] overflow-hidden bg-white border border-neutral-200 hover:border-neutral-300 transition-all duration-200 flex flex-col h-full">
                        <img src="@img('assets/image/3MjM1ZGaFuMlU.webp', ['w' => 600, 'fit' => 'crop', 'h' => 338])"
                             alt="Tim mengembangkan layanan web - Centrova"
                             loading="lazy"
                             decoding="async"
                             fetchpriority="low"
                             class="w-full aspect-video object-cover">
                             
                        <div class="px-8 pt-6 pb-8 flex flex-col flex-1">
                            <div class="flex-1 mb-6">
                                <h3 class="text-2xl font-bold tracking-tight mb-3 text-neutral-900">Software Development</h3>
                                <p class="text-neutral-600 leading-relaxed">Web applications, mobile applications, SaaS platforms, dan custom software.</p>
                            </div>
                            
                            <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center rounded-full border-2 border-primary-600 px-6 py-2.5 text-sm font-bold text-primary-600 hover:bg-primary-50 transition self-start gap-1.5" target="_blank" rel="noopener noreferrer">
                                Learn more
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </article>

                    {{-- Card 3 --}}
                    <article class="rounded-[32px] overflow-hidden bg-white border border-neutral-200 hover:border-neutral-300 transition-all duration-200 flex flex-col h-full">
                        <img src="@img('assets/image/X3MjM1ZGaFuMlU.webp', ['w' => 600, 'fit' => 'crop', 'h' => 338])"
                             alt="Tim mengembangkan layanan web - Centrova"
                             loading="lazy"
                             decoding="async"
                             fetchpriority="low"
                             class="w-full aspect-video object-cover">
                             
                        <div class="px-8 pt-6 pb-8 flex flex-col flex-1">
                            <div class="flex-1 mb-6">
                                <h3 class="text-2xl font-bold tracking-tight mb-3 text-neutral-900">AI Agent Automation</h3>
                                <p class="text-neutral-600 leading-relaxed">AI Agents dan intelligent automation untuk mengurangi pekerjaan manual dan meningkatkan produktivitas.</p>
                            </div>
                            
                            <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center rounded-full border-2 border-primary-600 px-6 py-2.5 text-sm font-bold text-primary-600 hover:bg-primary-50 transition self-start gap-1.5" target="_blank" rel="noopener noreferrer">
                                Learn more
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- Dampak AI / Stats — Meta-style feature-icon-row with rounded-[16px] (xl) --}}
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-7 lg:px-8">
                {{-- Headline --}}
                <div class="text-center mb-16 max-w-3xl mx-auto">
                    <h2 class="text-4xl md:text-5xl max-w-4xl mx-auto font-bold tracking-tight text-neutral-900 mb-4">
                        Akselerasi Efisiensi dan Pertumbuhan Bisnis dengan Integrasi AI
                    </h2>
                </div>

                {{-- Stats Grid — Meta-style 3-up why-buy tiles --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center max-w-6xl mx-auto">
                    {{-- Stat 1 --}}
                    <div class="flex flex-col items-center px-6 py-10 rounded-[16px] bg-white border border-neutral-200">
                        <span class="text-5xl font-bold text-primary-600 mb-5 tracking-tight">
                            70%<span class="font-variant-numeric:lashed-zero">+</span>
                        </span>
                        <p class="text-base text-neutral-600 leading-relaxed max-w-sm">
                            Waktu operasional tim masih tersita oleh tugas repetitif yang dapat diotomatisasi sepenuhnya.
                        </p>
                    </div>

                    {{-- Stat 2 --}}
                    <div class="flex flex-col items-center px-6 py-10 rounded-[16px] bg-white border border-neutral-200">
                        <span class="text-5xl font-bold text-primary-600 mb-5 tracking-tight whitespace-nowrap">
                            2x Lipat
                        </span>
                        <p class="text-base text-neutral-600 leading-relaxed max-w-sm">
                            Peningkatan kecepatan proses bisnis melalui otomatisasi workflow yang cerdas.
                        </p>
                    </div>

                    {{-- Stat 3 --}}
                    <div class="flex flex-col items-center px-6 py-10 rounded-[16px] bg-white border border-neutral-200">
                        <span class="text-5xl font-bold text-primary-600 mb-5 tracking-tight">
                            24/7
                        </span>
                        <p class="text-base text-neutral-600 leading-relaxed max-w-sm">
                            Layanan pelanggan dan eksekusi proses bisnis berjalan tanpa henti untuk menjamin kontinuitas operasional.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Industries — Meta-style card-feature-photo full-bleed showcase with rounded-[32px] --}}
        <section class="py-20 bg-neutral-100 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-7 lg:px-8 relative z-10">
                <div class="text-center mb-14">
                    <h2 class="text-4xl md:text-5xl max-w-4xl mx-auto font-bold tracking-tight text-neutral-900">Mengembangkan Masa Depan Industri Anda</h2>
                </div>
                
                {{-- Industries List --}}
                <div class="grid grid-cols-1 gap-8">
                    {{-- Industri Software --}}
                    <div class="w-full bg-white rounded-[32px] border border-neutral-200 grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-8 py-10 lg:py-16 lg:px-12 flex justify-center items-center">
                            <div class="w-full text-base lg:text-lg tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-4xl font-bold mb-4 text-neutral-900">Industri Software</h3>
                                <p class="text-neutral-600 leading-relaxed">Berfokus pada kecepatan siklus pengembangan melalui metodologi Agile dan DevOps untuk menghasilkan produk yang stabil namun adaptif. Kuncinya adalah kolaborasi tim yang lancar dan otomatisasi sistem (CI/CD) agar peluncuran fitur baru bisa dilakukan secara instan tanpa hambatan teknis bagi pengguna.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_software"
                                    class="inline-flex items-center justify-center px-7 py-3.5 text-sm font-bold rounded-full bg-primary-600 hover:bg-primary-700 transition text-white mt-8 min-h-[44px]">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-100 aspect-square">
                            <img src="@img('assets/image/home/industri_software.jpg', ['w' => 720, 'fit' => 'crop', 'h' => 720])" class="w-full h-full object-cover" alt="Industri Software" loading="lazy" decoding="async">
                        </div>
                    </div>

                    {{-- Teknologi Keuangan --}}
                    <div class="w-full bg-white rounded-[32px] border border-neutral-200 grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="bg-neutral-100 aspect-square order-2 lg:order-1">
                            <img src="@img('assets/image/home/industri_keuangan.jpg', ['w' => 720, 'fit' => 'crop', 'h' => 720])" class="w-full h-full object-cover" alt="Teknologi Keuangan" loading="lazy" decoding="async">
                        </div>
                        <div class="w-full h-full px-8 py-10 lg:py-16 lg:px-12 flex justify-center items-center order-1 lg:order-2">
                            <div class="w-full text-base lg:text-lg tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-4xl font-bold mb-4 text-neutral-900">Teknologi Keuangan</h3>
                                <p class="text-neutral-600 leading-relaxed">Memberikan solusi transaksi digital yang aman, cepat, dan terintegrasi. Kami membantu membangun ekosistem pembayaran, manajemen aset, dan sistem perbankan digital untuk meningkatkan inklusi keuangan dan efisiensi operasional bisnis Anda.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_fintech"
                                    class="inline-flex items-center justify-center px-7 py-3.5 text-sm font-bold rounded-full bg-primary-600 hover:bg-primary-700 transition text-white mt-8 min-h-[44px]">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Transportasi & Logistik --}}
                    <div class="w-full bg-white rounded-[32px] border border-neutral-200 grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-8 py-10 lg:py-16 lg:px-12 flex justify-center items-center">
                            <div class="w-full text-base lg:text-lg tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-4xl font-bold mb-4 text-neutral-900">Transportasi & Logistik</h3>
                                <p class="text-neutral-600 leading-relaxed">Optimalkan pergerakan barang dan orang dengan sistem pelacakan real-time, manajemen armada, dan integrasi rantai pasokan. Solusi kami dirancang untuk mengurangi biaya operasional dan mempercepat waktu pengiriman melalui efisiensi berbasis data.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_logistics"
                                    class="inline-flex items-center justify-center px-7 py-3.5 text-sm font-bold rounded-full bg-primary-600 hover:bg-primary-700 transition text-white mt-8 min-h-[44px]">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-100 aspect-square">
                            <img src="@img('assets/image/home/industri_transportasi_logistik.jpg', ['w' => 720, 'fit' => 'crop', 'h' => 720])" class="w-full h-full object-cover" alt="Transportasi & Logistik" loading="lazy" decoding="async">
                        </div>
                    </div>

                    {{-- Sektor Pendidikan --}}
                    <div class="w-full bg-white rounded-[32px] border border-neutral-200 grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="bg-neutral-100 aspect-square order-2 lg:order-1">
                            <img src="@img('assets/image/home/sektor_pendidikan.jpg', ['w' => 720, 'fit' => 'crop', 'h' => 720])" class="w-full h-full object-cover" alt="Sektor Pendidikan" loading="lazy" decoding="async">
                        </div>
                        <div class="w-full h-full px-8 py-10 lg:py-16 lg:px-12 flex justify-center items-center order-1 lg:order-2">
                            <div class="w-full text-base lg:text-lg tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-4xl font-bold mb-4 text-neutral-900">Sektor Pendidikan</h3>
                                <p class="text-neutral-600 leading-relaxed">Mendigitalisasi proses belajar mengajar dengan Learning Management Systems (LMS), platform ujian online, dan sistem administrasi sekolah yang terpadu untuk menciptakan pengalaman belajar yang lebih interaktif, inklusif, dan aksesibel bagi semua.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_education"
                                    class="inline-flex items-center justify-center px-7 py-3.5 text-sm font-bold rounded-full bg-primary-600 hover:bg-primary-700 transition text-white mt-8 min-h-[44px]">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Medical System --}}
                    <div class="w-full bg-white rounded-[32px] border border-neutral-200 grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-8 py-10 lg:py-16 lg:px-12 flex justify-center items-center">
                            <div class="w-full text-base lg:text-lg tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-4xl font-bold mb-4 text-neutral-900">Medical System</h3>
                                <p class="text-neutral-600 leading-relaxed">Solusi teknologi kesehatan profesional untuk manajemen data pasien (EMR), sistem janji temu, dan telemedis. Kami memprioritaskan privasi data, kepatuhan regulasi, dan kemudahan akses layanan kesehatan bagi masyarakat melalui inovasi digital.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_medical"
                                    class="inline-flex items-center justify-center px-7 py-3.5 text-sm font-bold rounded-full bg-primary-600 hover:bg-primary-700 transition text-white mt-8 min-h-[44px]">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-100 aspect-square">
                            <img src="@img('assets/image/home/medical_system.jpg', ['w' => 720, 'fit' => 'crop', 'h' => 720])" class="w-full h-full object-cover" alt="Medical System" loading="lazy" decoding="async">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Penawaran / CTA Section — Meta-style card-promo-strip with dark background + rounded-[32px] --}}
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-7 lg:px-8">
                <div class="w-full bg-neutral-900 rounded-[32px] min-h-[400px] lg:h-[480px] flex items-center justify-center lg:justify-start relative overflow-hidden">
                    <div class="absolute inset-0 w-full h-full z-0">
                        <img src="@img('assets/image/home/a2d67684-5efc-6ad8-2cb3-6034d420e88cba88d902848fa4415ffca75da09a257e0c938ac6.webp', ['w' => 1440, 'fit' => 'contain'])" class="h-full object-cover w-full opacity-60" alt="Ilustrasi pembuatan website - Centrova" loading="lazy" decoding="async">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 relative z-10 w-full">
                        <div class="w-full flex justify-center items-center h-full px-8 sm:px-12 lg:px-16 py-10">
                            <div class="flex flex-col max-md:items-center max-md:text-center">
                                <h2 class="font-bold text-neutral-900 text-3xl sm:text-4xl lg:text-5xl mt-2 leading-tight tracking-tight">
                                    Ubah Ide Anda Menjadi Kenyataan
                                </h2>
                                <p class="text-neutral-600 mt-4 text-base sm:text-lg">
                                    Mulailah bangun rumah online Anda dengan memiliki website untuk merek Anda.
                                </p>
                                <div>
                                    <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                                        class="inline-flex items-center justify-center px-7 py-3.5 text-sm font-bold rounded-full bg-primary-600 hover:bg-primary-700 transition text-white mt-8 min-h-[44px]">
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