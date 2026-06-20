@extends('partials.layouts.main')

@section('title', 'Tentang Kami | PT Centrova Teknologi Indonesia - AI Venture Engineering & Software Development')

{{-- Navbar --}}
@section('navbar')
    @include('partials.navbar.main')
@endsection

@section('seoMetaTags')
    <meta name="description" content="PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering terdepan yang menggabungkan Software Development, AI-powered Systems, dan AI Agents. Pelajari visi, misi, dan nilai kami dalam memberdayakan bisnis di Indonesia melalui inovasi digital dan otomatisasi cerdas.">
    <meta name="keywords" content="PT Centrova Teknologi Indonesia, Centrova, AI Venture Engineering Indonesia, perusahaan AI Indonesia, Software Development Indonesia, AI Agent Automation, Centrova Teknologi, AI Development Indonesia, jasa pembuatan website Indonesia, digital transformation Indonesia, centrova.id, AI startup Indonesia, venture builder AI, intelligent automation Indonesia">
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
    <meta property="og:title" content="Tentang Kami | PT Centrova Teknologi Indonesia - AI Venture Engineering & Software Development">
    <meta property="og:description" content="PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang menggabungkan Software Development, AI-powered Systems, dan AI Agents untuk transformasi digital bisnis Anda.">
    <meta property="og:image" content="{{ asset('thumbnail.png') }}">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="1080">
    <meta property="og:image:alt" content="Centrova - AI Venture Engineering & Software Development Indonesia">
    <meta property="og:site_name" content="Centrova Indonesia">
    <meta property="og:locale" content="id_ID">
    <meta property="og:country-name" content="Indonesia">
    <meta property="business:contact_data:country_name" content="Indonesia">

    {{-- Twitter/X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Tentang Centrova | PT Centrova Teknologi Indonesia - AI Venture Engineering">
    <meta name="twitter:description" content="PT Centrova Teknologi Indonesia - AI Venture Engineering. Pelajari visi, misi, dan nilai perusahaan dalam memberdayakan bisnis Indonesia melalui AI dan software development.">
    <meta name="twitter:image" content="{{ asset('thumbnail.png') }}">
    <meta name="twitter:image:alt" content="Centrova Logo - AI Venture Engineering Indonesia">
    <meta name="twitter:site" content="@centrova_id">
    <meta name="twitter:creator" content="@centrova_id">

    {{-- Geo Tags for Local SEO --}}
    <meta name="geo.region" content="ID">
    <meta name="geo.country" content="ID">
    <meta name="geo.placename" content="Indonesia">

    {{-- Verify for Google Search Console --}}
    @if(config('services.google.site_verification'))
    <meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
    @endif

    {{-- Verify for Bing --}}
    @if(config('services.bing.site_verification'))
    <meta name="msvalidate.01" content="{{ config('services.bing.site_verification') }}">
    @endif
@endsection

@section('style-css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endsection

@push('structured-data')
    {{-- AboutPage Schema --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AboutPage",
        "@id": "{{ url()->current() }}#aboutpage",
        "url": "{{ url()->current() }}",
        "name": "Tentang PT Centrova Teknologi Indonesia",
        "description": "PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang menggabungkan software development, sistem berbasis AI, dan AI Agents untuk membantu bisnis membangun, mengotomatisasi, serta mengembangkan operasional mereka.",
        "mainEntity": {
            "@id": "https://centrova.id/#organization"
        },
        "speakable": {
            "@type": "SpeakableSpecification",
            "cssSelector": ["h1", "h2"]
        }
    }
    </script>

    {{-- Organization Schema with full legal name --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "@id": "https://centrova.id/#organization",
        "name": "Centrova",
        "legalName": "PT Centrova Teknologi Indonesia",
        "alternateName": "Centrova Teknologi Indonesia",
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
        "foundingLocation": { "@type": "Place", "name": "Indonesia" },
        "email": "info@centrova.id",
        "telephone": "+62-858-1790-9560",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID",
            "addressRegion": "Indonesia"
        },
        "sameAs": [
            "https://centrova.id",
            "https://linkedin.com/company/centrova",
            "https://instagram.com/centrova.id",
            "https://twitter.com/centrova_id"
        ],
        "knowsAbout": [
            "AI Automation",
            "Software Development",
            "AI Agents",
            "Web Development",
            "Mobile Applications",
            "Digital Transformation",
            "AI Venture Engineering",
            "Intelligent Automation",
            "Custom Software Development"
        ],
        "areaServed": { "@type": "Country", "name": "Indonesia" },
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+62-858-1790-9560",
                "contactType": "Customer Service",
                "availableLanguage": ["Indonesian", "English"],
                "areaServed": "ID"
            },
            {
                "@type": "ContactPoint",
                "telephone": "+62-858-1790-9560",
                "contactType": "Sales",
                "availableLanguage": ["Indonesian", "English"],
                "areaServed": "ID"
            }
        ]
    }
    </script>

    {{-- LocalBusiness Schema for PT Centrova Teknologi Indonesia --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "@id": "https://centrova.id/#localbusiness",
        "name": "PT Centrova Teknologi Indonesia",
        "alternateName": "Centrova",
        "description": "AI Venture Engineering company - Software Development, AI-powered Systems, dan AI Agent Automation untuk transformasi digital bisnis di Indonesia.",
        "url": "https://centrova.id",
        "telephone": "+62-858-1790-9560",
        "email": "info@centrova.id",
        "areaServed": "Indonesia",
        "priceRange": "Rp 699.000 - Rp 10.000.000",
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                "opens": "08:00",
                "closes": "20:00"
            }
        ],
        "sameAs": [
            "https://linkedin.com/company/centrova",
            "https://instagram.com/centrova.id",
            "https://twitter.com/centrova_id"
        ],
        "parentOrganization": {
            "@id": "https://centrova.id/#organization"
        }
    }
    </script>

    {{-- BreadcrumbList Schema --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "@id": "{{ url()->current() }}#breadcrumb",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Beranda",
                "item": "https://centrova.id"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Tentang Kami",
                "item": "{{ url()->current() }}"
            }
        ]
    }
    </script>

    {{-- Enhanced FAQPage Schema for GEO (AI search visibility) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "@id": "{{ url()->current() }}#faq",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Apa itu PT Centrova Teknologi Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang menggabungkan software development, sistem berbasis AI, dan AI Agents untuk membantu bisnis membangun, mengotomatisasi, serta mengembangkan operasional mereka secara lebih efisien, cepat, dan berkelanjutan."
                }
            },
            {
                "@type": "Question",
                "name": "Apa layanan utama Centrova?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Centrova menawarkan solusi perangkat lunak, pengembangan web dan aplikasi, integrasi sistem, AI Agent Automation, infrastruktur yang dapat diskalakan, serta dukungan pelatihan adopsi digital untuk bisnis di Indonesia."
                }
            },
            {
                "@type": "Question",
                "name": "Apa visi PT Centrova Teknologi Indonesia?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Menjadi mitra teknologi terdepan yang memberdayakan bisnis di Indonesia melalui inovasi AI, pengembangan perangkat lunak berkualitas tinggi, dan solusi digital yang terintegrasi."
                }
            },
            {
                "@type": "Question",
                "name": "Apa misi Centrova?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Mengintegrasikan prinsip AI Venture Engineering ke dalam setiap aspek layanan kami, untuk menghadirkan solusi digital yang efisien, terotomatisasi, dan mampu mendorong pertumbuhan bisnis secara berkelanjutan."
                }
            },
            {
                "@type": "Question",
                "name": "Apa prinsip-prinsip Centrova?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Centrova berpegang pada prinsip Inovatif (bersemangat dalam berkarya), Terpercaya (berprinsip dalam bertindak dengan integritas), serta Cepat dan Efisien (rasional dalam berpikir dan unggul dalam hasil)."
                }
            },
            {
                "@type": "Question",
                "name": "Kapan Centrova didirikan?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "PT Centrova Teknologi Indonesia didirikan pada tahun 2025 dan beroperasi di Indonesia."
                }
            }
        ]
    }
    </script>

    {{-- WebPage Schema --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "@id": "{{ url()->current() }}#webpage",
        "url": "{{ url()->current() }}",
        "name": "Tentang Kami | PT Centrova Teknologi Indonesia - AI Venture Engineering & Software Development",
        "description": "PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang menggabungkan software development, AI-powered systems, dan AI Agents. Pelajari visi, misi, dan nilai kami.",
        "about": { "@id": "https://centrova.id/#organization" },
        "isPartOf": { "@id": "https://centrova.id/#website" },
        "primaryImageOfPage": {
            "@type": "ImageObject",
            "url": "https://centrova.id/thumbnail.png"
        },
        "inLanguage": "id",
        "datePublished": "2025-09-13",
        "dateModified": "{{ date('Y-m-d') }}"
    }
    </script>
@endpush

@section('content')
    {{-- Hero: Esensi Inovasi Digital --}}
    <section class="w-full bg-white py-10 sm:py-16 tracking-tight">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold text-neutral-900 mb-6 sm:mb-8 leading-tight">Build to Shape the Future!</h1>
                <p class="text-base sm:text-xl text-neutral-900 font-medium leading-relaxed max-w-3xl mx-auto">
                    Centrova hadir dengan pendekatan AI Venture Engineering — melampaui pola pikir pengembangan konvensional, berfokus pada fungsionalitas, otomatisasi, dan konteks penggunaan yang secara langsung meningkatkan efisiensi bisnis Anda.
                </p>
            </div>
        </div>
    </section>

    <div class="mt-6 sm:mt-10">
        <img src="https://www.gstatic.com/marketing-cms/assets/images/0b/d4/e6516d32418884386205621ad689/about-companyinfo-hero.jpg=n-w2000-h625-fcrop64=1,0000051ffffffae1-rw"
             alt="Centrova Inovasi Digital"
             class="w-full h-auto object-cover">
    </div>

    {{-- Tentang Kami --}}
    <section class="w-full bg-white py-10 sm:py-16 mt-6 sm:mt-10">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-neutral-900">Tentang Kami</h2>
            <div class="space-y-4 sm:space-y-6 text-neutral-700 text-base sm:text-lg leading-relaxed lg:col-span-2">
                <p>
                    PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang menggabungkan software development, sistem berbasis AI, dan AI Agents untuk membantu bisnis membangun, mengotomatisasi, serta mengembangkan operasional mereka secara lebih efisien, cepat, dan berkelanjutan.
                </p>
                <p>
                    Kami berkomitmen untuk memberikan solusi teknologi yang terintegrasi dan inovatif, membantu bisnis di Indonesia bertransformasi secara digital dengan pendekatan yang terukur, efisien, dan berorientasi pada hasil nyata.
                </p>
            </div>
        </div>
    </section>

    {{-- Misi Kami --}}
    <section class="w-full bg-white py-10 sm:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-neutral-900">Misi Kami</h2>
            <p class="text-neutral-700 text-base sm:text-lg leading-relaxed w-full lg:col-span-2">
                Mengintegrasikan prinsip AI Venture Engineering ke dalam setiap aspek layanan kami, untuk menghadirkan solusi digital yang efisien, terotomatisasi, dan mampu mendorong pertumbuhan bisnis secara berkelanjutan.
            </p>
        </div>
    </section>

    {{-- Visi Kami --}}
    <section class="w-full bg-white py-10 sm:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-neutral-900">Visi Kami</h2>
            <p class="text-neutral-700 text-base sm:text-lg leading-relaxed w-full lg:col-span-2">
                Menjadi mitra teknologi terdepan yang memberdayakan bisnis di Indonesia melalui inovasi AI, pengembangan perangkat lunak berkualitas tinggi, dan solusi digital yang terintegrasi.
            </p>
        </div>
    </section>

    {{-- Prinsip Kami --}}
    <section class="w-full bg-white py-10 sm:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-neutral-900">Prinsip Kami</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:col-span-2 gap-4 sm:gap-6">
                <div class="rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4">
                        <span class="material-symbols-outlined text-primary-600 text-4xl">lightbulb</span>
                    </div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Inovatif</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Bersemangat dalam berkarya dan menghadirkan solusi kreatif yang mendorong perubahan positif.</p>
                </div>
                <div class="rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4">
                        <span class="material-symbols-outlined text-primary-600 text-4xl">verified</span>
                    </div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Terpercaya</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Berprinsip dalam bertindak, mengedepankan integritas dan kejujuran dalam setiap proses.</p>
                </div>
                <div class="rounded-md border border-neutral-200 bg-white p-8 hover:shadow-md hover:shadow-black/35 transition-shadow duration-150">
                    <div class="text-primary-500 mb-4">
                        <span class="material-symbols-outlined text-primary-600 text-4xl">bolt</span>
                    </div>
                    <h3 class="text-xl font-semibold text-neutral-900 mb-3 tracking-tight">Cepat & Efisien</h3>
                    <p class="text-neutral-700 text-base tracking-tight">Rasional dalam berpikir, unggul dalam hasil, dan gesit dalam beradaptasi dengan kebutuhan bisnis.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Gambar --}}
    <section class="w-full bg-white py-10 sm:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 sm:space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&q=80"
                     alt="Tim Centrova"
                     class="w-full h-48 sm:h-64 object-cover rounded-xl">
                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=600&q=80"
                     alt="Kolaborasi Centrova"
                     class="w-full h-48 sm:h-64 object-cover rounded-xl">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=600&q=80"
                     alt="Workshop Centrova"
                     class="w-full h-48 sm:h-52 object-cover rounded-xl">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=600&q=80"
                     alt="Teknologi Centrova"
                     class="w-full h-48 sm:h-52 object-cover rounded-xl">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&q=80"
                     alt="Tim Centrova"
                     class="w-full h-48 sm:h-52 object-cover rounded-xl">
            </div>
        </div>
    </section>
@endsection
