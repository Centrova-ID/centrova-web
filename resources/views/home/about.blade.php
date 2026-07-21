@extends('partials.layouts.main')

@section('title', 'Tentang Kami | PT Centrova Teknologi Indonesia - AI Venture Engineering & Software Development')

{{-- Navbar --}}
@section('navbar')
    @include('partials.navbar.main')
@endsection

@section('seoMetaTags')
    <meta name="description" content="PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering terdepan yang menggabungkan Software Development, AI-powered Systems, dan AI Agents. Pelajari visi, misi, prinsip, dan nilai-nilai perusahaan dalam memberdayakan bisnis di Indonesia melalui inovasi digital dan otomatisasi cerdas.">
    <meta name="keywords" content="PT Centrova Teknologi Indonesia, Centrova, AI Venture Engineering Indonesia, perusahaan AI Indonesia, Software Development Indonesia, AI Agent Automation, Centrova Teknologi, AI Development Indonesia, jasa pembuatan website Indonesia, digital transformation Indonesia, centrova.id, AI startup Indonesia, venture builder AI, intelligent automation Indonesia">
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
    <meta property="og:title" content="Tentang Kami | PT Centrova Teknologi Indonesia - AI Venture Engineering & Software Development">
    <meta property="og:description" content="PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang menggabungkan Software Development, AI-powered Systems, dan AI Agents. Pelajari visi, misi, prinsip, dan nilai perusahaan.">
    <meta property="og:image" content="{{ config('app.url') }}/thumbnail.png">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="1080">
    <meta property="og:image:alt" content="Centrova - AI Venture Engineering & Software Development Indonesia">
    <meta property="og:site_name" content="Centrova">
    <meta property="og:locale" content="id_ID">
    <meta property="og:country-name" content="Indonesia">
    <meta property="business:contact_data:country_name" content="Indonesia">

    {{-- Twitter/X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ canonical_url() }}">
    <meta name="twitter:title" content="Tentang Centrova | PT Centrova Teknologi Indonesia - AI Venture Engineering">
    <meta name="twitter:description" content="PT Centrova Teknologi Indonesia - AI Venture Engineering. Pelajari visi, misi, dan nilai perusahaan dalam memberdayakan bisnis Indonesia melalui AI dan software development.">
    <meta name="twitter:image" content="{{ config('app.url') }}/thumbnail.png">
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

@section('scripts-body')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('testimonialCarousel', () => ({
                activeIndex: 0,
                testimonials: [0, 1, 2, 3],

                get isAtStart() {
                    return this.activeIndex === 0;
                },

                get isAtEnd() {
                    return this.activeIndex >= this.testimonials.length - 1;
                },

                init() {
                    this.updateActive();
                },

                getCardWidth() {
                    const track = this.$refs.track;
                    if (!track) return 1;
                    const card = track.querySelector('.snap-start');
                    return card ? card.offsetWidth : track.offsetWidth;
                },

                updateActive() {
                    const track = this.$refs.track;
                    if (!track) return;
                    const slideWidth = this.getCardWidth();
                    const index = Math.round(track.scrollLeft / slideWidth);
                    this.activeIndex = Math.min(index, this.testimonials.length - 1);
                },

                scrollTo(index) {
                    const track = this.$refs.track;
                    if (!track) return;
                    const slideWidth = this.getCardWidth();
                    const target = Math.max(0, Math.min(index, this.testimonials.length - 1));
                    track.scrollTo({
                        left: target * slideWidth,
                        behavior: 'smooth'
                    });
                    this.activeIndex = target;
                },

                prev() {
                    this.scrollTo(this.activeIndex - 1);
                },

                next() {
                    this.scrollTo(this.activeIndex + 1);
                }
            }));
        });
    </script>
@endsection

@push('structured-data')
    {{-- AboutPage Schema --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AboutPage",
        "@id": "{{ canonical_url() }}#aboutpage",
        "url": "{{ canonical_url() }}",
        "name": "Tentang PT Centrova Teknologi Indonesia",
        "description": "PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang menggabungkan software development, sistem berbasis AI, dan AI Agents untuk membantu bisnis membangun, mengotomatisasi, serta mengembangkan operasional mereka.",
        "mainEntity": {
            "@id": "{{ config('app.url') }}/#organization"
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
        "@id": "{{ config('app.url') }}/#organization",
        "name": "Centrova",
        "legalName": "PT Centrova Teknologi Indonesia",
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
        "foundingLocation": { "@type": "Place", "name": "Indonesia" },
        "email": "info@centrova.id",
        "telephone": "+62-858-1790-9560",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID",
            "addressRegion": "DKI Jakarta"
        },
        "sameAs": [
            "https://linkedin.com/company/centrova",
            "https://instagram.com/centrova_id",
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
            }
        ]
    }
    </script>



    {{-- BreadcrumbList Schema --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "@id": "{{ canonical_url() }}#breadcrumb",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Beranda",
                "item": "{{ config('app.url') }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Tentang Kami",
                "item": "{{ canonical_url() }}"
            }
        ]
    }
    </script>

    {{-- Enhanced FAQPage Schema for GEO (AI search visibility) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "@id": "{{ canonical_url() }}#faq",
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
                    "text": "Menjadi salah satu perusahaan teknologi terbaik yang menghadirkan inovasi, layanan terbaik, serta memberdayakan masyarakat melalui solusi digital yang berdampak."
                }
            },
            {
                "@type": "Question",
                "name": "Apa misi Centrova?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Misi Centrova meliputi: menyederhanakan kehidupan melalui solusi digital inovatif, membangun ekosistem teknologi kelas dunia, membantu bisnis mengadopsi teknologi modern, menghasilkan solusi digital berdampak nyata, dan mendorong transformasi digital melalui AI dan software."
                }
            },
            {
                "@type": "Question",
                "name": "Apa prinsip utama Centrova?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Centrova berpegang pada empat prinsip utama: AI-Driven Innovation (memanfaatkan AI untuk solusi cerdas), Business-First Thinking (solusi berangkat dari kebutuhan bisnis), Scalable Engineering (sistem yang siap berkembang), dan Long-Term Partnership (mitra teknologi jangka panjang)."
                }
            },
            {
                "@type": "Question",
                "name": "Apa company values Centrova?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Centrova memiliki empat nilai perusahaan yang dikenal dengan CORE: Create (menciptakan inovasi dari setiap tantangan), Own (bertanggung jawab penuh atas komitmen), Rise (terus belajar dan berkembang), dan Empower (memberdayakan klien, tim, dan komunitas)."
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
        "@id": "{{ canonical_url() }}#webpage",
        "url": "{{ canonical_url() }}",
        "name": "Tentang Kami | PT Centrova Teknologi Indonesia - AI Venture Engineering & Software Development",
        "description": "PT Centrova Teknologi Indonesia adalah perusahaan AI Venture Engineering yang menggabungkan software development, AI-powered systems, dan AI Agents. Pelajari visi, misi, prinsip, dan nilai-nilai perusahaan kami.",
        "about": { "@id": "{{ config('app.url') }}/#organization" },
        "isPartOf": { "@id": "{{ config('app.url') }}/#website" },
        "primaryImageOfPage": {
            "@type": "ImageObject",
            "url": "{{ config('app.url') }}/thumbnail.png"
        },
        "inLanguage": "id",
        "datePublished": "2025-09-13",
        "dateModified": "{{ date('Y-m-d') }}"
    }
    </script>
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="w-full bg-white py-16 sm:py-24" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold text-neutral-900 mb-6 sm:mb-8 leading-tight tracking-tight">Build to Shape the Future!</h1>
                <p class="text-base sm:text-lg font-figtree text-neutral-600 leading-normal max-w-3xl mx-auto">
                    Centrova adalah perusahaan teknologi Indonesia yang membantu bisnis membangun masa depan melalui solusi <strong class="font-semibold">AI Venture Engineering</strong> dan <strong class="font-semibold">Software Development</strong>. Kami merancang, mengembangkan, dan mengimplementasikan teknologi yang tidak hanya menyelesaikan masalah hari ini, tetapi juga mempersiapkan bisnis untuk menghadapi tantangan dan peluang di masa depan.
                </p>
            </div>
        </div>
    </section>

    {{-- Hero Image --}}
    <div class="max-w-7xl mx-auto px-4 lg:px-8" data-aos="fade-up" data-aos-duration="700">
        <div class="rounded-[32px] overflow-hidden">
            <img src="@img('assets/image/8934KW4IYT.webp', ['w' => 1440, 'fit' => 'contain'])"
                 alt="Centrova Teknologi Indonesia - AI Venture Engineering Company"
                 class="w-full aspect-[16/7] object-cover"
                 loading="lazy" decoding="async">
        </div>
    </div>

    {{-- Tentang Centrova --}}
    <section class="w-full bg-white py-16 sm:py-20" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto bg-white rounded-[32px] border border-neutral-200 p-8 sm:p-12 lg:p-16">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-12">
                    <div>
                        <h2 class="text-2xl sm:text-4xl font-bold text-neutral-900 tracking-tight">Tentang Centrova</h2>
                    </div>
                    <div class="space-y-5 text-neutral-600 text-base sm:text-lg font-figtree leading-normal lg:col-span-2">
                        <p>
                            Kecepatan perkembangan teknologi saat ini menuntut perusahaan untuk terus beradaptasi, meningkatkan efisiensi, dan mempertahankan daya saing. Centrova memposisikan diri bukan sekadar penyedia jasa pengembangan software, melainkan sebagai <strong class="font-semibold">technology partner</strong> bagi setiap klien yang kami dampingi.
                        </p>
                        <p>
                            Bagi kami, teknologi baru memberi arti ketika benar-benar mendorong pertumbuhan bisnis. Karena itu, setiap solusi yang kami kembangkan diarahkan untuk menghasilkan dampak yang terukur—mulai dari meningkatkan produktivitas tim, mengotomatisasi proses kerja yang selama ini menyita waktu, hingga mendukung pengambilan keputusan yang lebih cepat dan lebih akurat.
                        </p>
                        <p>
                            Melalui dua fokus utama, <strong class="font-semibold">AI Venture Engineering</strong> dan <strong class="font-semibold">Software Development</strong>, Centrova membantu perusahaan merancang strategi digital, membangun aplikasi modern, mengimplementasikan Artificial Intelligence, serta mengembangkan sistem yang mampu berkembang seiring pertumbuhan bisnis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Empat Prinsip Utama Centrova --}}
    <section class="w-full bg-neutral-50 py-16 sm:py-20" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="700">
                    <h2 class="text-2xl sm:text-4xl font-bold text-neutral-900 tracking-tight">Prinsip Utama</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                        <div class="mb-4">
                            <span class="material-symbols-outlined text-primary-600 text-4xl">psychology</span>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3 tracking-tight">AI-Driven Innovation</h3>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Kami memanfaatkan Artificial Intelligence untuk menciptakan solusi yang lebih cerdas, efisien, dan berdampak nyata bagi pertumbuhan bisnis.</p>
                    </div>
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                        <div class="mb-4">
                            <span class="material-symbols-outlined text-primary-600 text-4xl">business_center</span>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3 tracking-tight">Business-First Thinking</h3>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Teknologi hanyalah sarana. Setiap solusi yang kami bangun selalu berangkat dari kebutuhan, tantangan, dan tujuan bisnis klien.</p>
                    </div>
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                        <div class="mb-4">
                            <span class="material-symbols-outlined text-primary-600 text-4xl">trending_up</span>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3 tracking-tight">Scalable Engineering</h3>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Kami membangun sistem yang siap berkembang bersama organisasi, mulai dari tahap awal hingga skala enterprise.</p>
                    </div>
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
                        <div class="mb-4">
                            <span class="material-symbols-outlined text-primary-600 text-4xl">handshake</span>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3 tracking-tight">Long-Term Partnership</h3>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Kami percaya hubungan terbaik bukan berhenti setelah proyek selesai. Kami tumbuh bersama klien sebagai mitra teknologi jangka panjang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Visi Kami --}}
    <section class="w-full bg-white py-16 sm:py-20" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto bg-white rounded-[32px] border border-neutral-200 p-8 sm:p-12 lg:p-16">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-12">
                    <div>
                        <h2 class="text-2xl sm:text-4xl font-bold text-neutral-900 tracking-tight">Visi Kami</h2>
                    </div>
                    <p class="text-neutral-600 font-figtree text-base sm:text-lg text-base sm:text-lg font-figtree leading-normal lg:col-span-2">
                        Menjadi salah satu perusahaan teknologi terbaik yang menghadirkan inovasi, layanan terbaik, serta memberdayakan masyarakat melalui solusi digital yang berdampak.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Misi Kami --}}
    <section class="w-full bg-neutral-50 py-16 sm:py-20" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto bg-white rounded-[32px] border border-neutral-200 p-8 sm:p-12 lg:p-16">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                    <div>
                        <h2 class="text-2xl sm:text-4xl font-bold text-neutral-900 tracking-tight">Misi Kami</h2>
                    </div>
                    <div class="space-y-4 text-neutral-600 text-base sm:text-lg font-figtree leading-normal lg:col-span-2">
                        <p>Menyederhanakan kehidupan dan pekerjaan melalui solusi digital yang inovatif.</p>
                        <p>Membangun ekosistem teknologi kelas dunia yang mudah diakses oleh semua orang.</p>
                        <p>Membantu bisnis mengadopsi teknologi modern secara strategis dan berkelanjutan.</p>
                        <p>Menghasilkan solusi digital yang memberikan dampak nyata terhadap pertumbuhan organisasi.</p>
                        <p>Mendorong transformasi digital melalui implementasi AI dan software yang praktis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Company Values (CORE) --}}
    <section class="w-full bg-white py-16 sm:py-20" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="700">
                    <h2 class="text-2xl sm:text-4xl font-bold text-neutral-900 tracking-tight">Company Values</h2>
                    <p class="text-neutral-600 font-figtree text-base sm:text-lg text-lg mt-4 max-w-2xl mx-auto">Prinsip yang menuntun setiap langkah kami dalam berkarya dan berkolaborasi.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                        <div class="flex items-center gap-4 mb-5">
                            <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary-50 text-primary-600 text-xl font-bold">C</span>
                            <h3 class="text-2xl font-bold text-neutral-900 tracking-tight">Create</h3>
                        </div>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Kami percaya setiap tantangan memiliki peluang untuk melahirkan inovasi. Karena itu kami terus berpikir kreatif, berani bereksperimen, dan menciptakan solusi yang memberikan dampak nyata.</p>
                    </div>
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                        <div class="flex items-center gap-4 mb-5">
                            <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary-50 text-primary-600 text-xl font-bold">O</span>
                            <h3 class="text-2xl font-bold text-neutral-900 tracking-tight">Own</h3>
                        </div>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Kami bertanggung jawab penuh terhadap setiap komitmen, keputusan, dan hasil pekerjaan. Integritas dan rasa memiliki menjadi fondasi dalam setiap kolaborasi.</p>
                    </div>
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                        <div class="flex items-center gap-4 mb-5">
                            <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary-50 text-primary-600 text-xl font-bold">R</span>
                            <h3 class="text-2xl font-bold text-neutral-900 tracking-tight">Rise</h3>
                        </div>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Perubahan adalah bagian dari perjalanan teknologi. Kami terus belajar, berkembang, beradaptasi, dan bangkit dari setiap tantangan untuk menjadi lebih baik setiap hari.</p>
                    </div>
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
                        <div class="flex items-center gap-4 mb-5">
                            <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary-50 text-primary-600 text-xl font-bold">E</span>
                            <h3 class="text-2xl font-bold text-neutral-900 tracking-tight">Empower</h3>
                        </div>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Kesuksesan terbaik adalah ketika semua pihak dapat tumbuh bersama. Kami berkomitmen untuk memberdayakan klien, tim, dan komunitas melalui teknologi yang bermanfaat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kenapa Memilih Centrova --}}
    <section class="w-full bg-white py-16 sm:py-20" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="700">
                    <h2 class="text-2xl sm:text-4xl font-bold text-neutral-900 tracking-tight">Kenapa Memilih Centrova?</h2>
                    <p class="text-neutral-600 font-figtree text-base sm:text-lg text-lg mt-4 max-w-2xl mx-auto">Kami berkomitmen menjadi mitra teknologi yang tepat untuk membantu bisnis Anda bertumbuh.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                        <div class="mb-4">
                            <span class="material-symbols-outlined text-primary-600 text-4xl">trending_up</span>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3 tracking-tight">Berorientasi pada Hasil Bisnis</h3>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Setiap solusi yang kami bangun selalu diarahkan untuk memberikan dampak nyata pada pertumbuhan bisnis Anda — bukan sekadar proyek teknologi tanpa arah yang jelas.</p>
                    </div>
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                        <div class="mb-4">
                            <span class="material-symbols-outlined text-primary-600 text-4xl">tune</span>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3 tracking-tight">Solusi yang Dibangun Sesuai Kebutuhan</h3>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Tidak ada pendekatan one-size-fits-all. Setiap solusi dirancang khusus berdasarkan kebutuhan, tantangan, dan tujuan unik bisnis Anda.</p>
                    </div>
                    <div class="rounded-[16px] border border-neutral-200 bg-white p-8 hover:border-neutral-300 transition-all duration-200" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
                        <div class="mb-4">
                            <span class="material-symbols-outlined text-primary-600 text-4xl">groups</span>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3 tracking-tight">Fokus pada Jangka Panjang</h3>
                        <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal">Kami tidak berhenti setelah proyek selesai. Centrova hadir sebagai mitra jangka panjang yang terus mendampingi dan mendukung perkembangan digital bisnis Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimoni --}}
    <section class="w-full bg-neutral-50 py-16 sm:py-20" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="700">
                    <h2 class="text-2xl sm:text-4xl font-bold text-neutral-900 tracking-tight">Apa Kata Klien Kami</h2>
                    <p class="text-neutral-600 font-figtree text-base sm:text-lg text-lg mt-4 max-w-2xl mx-auto">Dengarkan pengalaman mereka yang telah bekerja sama dengan Centrova.</p>
                </div>

                {{-- Container Utama Karosel --}}
                <div class="relative px-0 sm:px-4" 
                     x-data="{
                        activeIndex: 0,
                        totalItems: 4,
                        updateActive() {
                            let track = this.$refs.track;
                            this.activeIndex = Math.round(track.scrollLeft / track.clientWidth);
                        },
                        next() {
                            let track = this.$refs.track;
                            track.scrollLeft += track.clientWidth;
                        },
                        prev() {
                            let track = this.$refs.track;
                            track.scrollLeft -= track.clientWidth;
                        },
                        scrollTo(index) {
                            let track = this.$refs.track;
                            track.scrollLeft = track.clientWidth * index;
                        }
                     }">
                    
                    {{-- Gradien Transparan Kiri --}}
                    <div class="absolute left-0 top-0 bottom-0 w-16 sm:w-24 bg-gradient-to-r from-neutral-50 to-transparent z-10 pointer-events-none"
                         x-show="activeIndex > 0"
                         x-transition.opacity.duration.300ms>
                    </div>

                    {{-- Gradien Transparan Kanan --}}
                    <div class="absolute right-0 top-0 bottom-0 w-16 sm:w-24 bg-gradient-to-l from-neutral-50 to-transparent z-10 pointer-events-none"
                         x-show="activeIndex < (totalItems - 1)"
                         x-transition.opacity.duration.300ms>
                    </div>

                    {{-- Carousel Track --}}
                    <div class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth scrollbar-none [-ms-overflow-style:none] [scrollbar-width:none]" 
                         x-ref="track" 
                         @scroll.throttle.10ms="updateActive()">
                        
                        {{-- Testimonial 1 --}}
                        <div class="snap-start shrink-0 w-full px-4 sm:px-12 text-center">
                            <div class="p-8 h-full flex flex-col items-center">
                                <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal mb-6 flex-1 text-2xl">
                                    "Centrova membantu kami membangun platform digital yang benar-benar sesuai dengan kebutuhan bisnis. Prosesnya transparan, timnya responsif, dan hasilnya melebihi ekspektasi kami."
                                </p>
                                <div class="flex items-center gap-4 pt-4 border-t border-neutral-100">
                                    <div>
                                        <p class="font-semibold text-neutral-900 tracking-tight">Andi Pratama</p>
                                        <p class="text-sm text-neutral-500 tracking-tight">CEO, Startup Teknologi</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 2 --}}
                        <div class="snap-start shrink-0 w-full px-4 sm:px-12 text-center">
                            <div class="p-8 h-full flex flex-col items-center">
                                <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal mb-6 flex-1 text-2xl">
                                    "Tim Centrova tidak hanya sekadar membuat website, tetapi benar-benar memahami visi bisnis kami. Hasilnya adalah solusi digital yang memperkuat brand dan meningkatkan konversi secara signifikan."
                                </p>
                                <div class="flex items-center gap-4 pt-4 border-t border-neutral-100">
                                    <div>
                                        <p class="font-semibold text-neutral-900 tracking-tight">Sari Dewi</p>
                                        <p class="text-sm text-neutral-500 tracking-tight">Founder, E-Commerce Brand</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 3 --}}
                        <div class="snap-start shrink-0 w-full px-4 sm:px-12 text-center">
                            <div class="p-8 h-full flex flex-col items-center">
                                <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal mb-6 flex-1 text-2xl">
                                    "Kami sangat puas dengan implementasi AI Automation yang dilakukan Centrova. Proses operasional yang dulu memakan waktu berhari-hari kini bisa selesai dalam hitungan jam."
                                </p>
                                <div class="flex items-center gap-4 pt-4 border-t border-neutral-100">
                                    <div>
                                        <p class="font-semibold text-neutral-900 tracking-tight">Rudi Hartono</p>
                                        <p class="text-sm text-neutral-500 tracking-tight">Operations Director, Perusahaan Logistik</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 4 --}}
                        <div class="snap-start shrink-0 w-full px-4 sm:px-12 text-center">
                            <div class="p-8 h-full flex flex-col items-center">
                                <p class="text-neutral-600 font-figtree text-base sm:text-lg leading-normal mb-6 flex-1 text-2xl">
                                    "Pendekatan Centrova yang mengutamakan kemitraan jangka panjang membuat kami merasa didukung penuh. Bukan sekadar vendor, tapi benar-benar partner teknologi."
                                </p>
                                <div class="flex items-center gap-4 pt-4 border-t border-neutral-100">
                                    <div>
                                        <p class="font-semibold text-neutral-900 tracking-tight">Maya Putri</p>
                                        <p class="text-sm text-neutral-500 tracking-tight">CMO, Perusahaan Fintech</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Navigasi Otomatis Hilang (x-show) --}}
                    {{-- Prev Button --}}
                    <button @click="prev()"
                            x-show="activeIndex > 0"
                            x-transition.opacity.duration.200ms
                            class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-16 h-16 rounded-full bg-white text-neutral-600 hover:text-primary-600 hover:bg-neutral-100 transition-all duration-200 cursor-pointer"
                            aria-label="Sebelumnya">
                        <span class="material-symbols-outlined text-4xl">chevron_left</span>
                    </button>

                    {{-- Next Button --}}
                    <button @click="next()"
                            x-show="activeIndex < (totalItems - 1)"
                            x-transition.opacity.duration.200ms
                            class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-16 h-16 rounded-full bg-white text-neutral-600 hover:text-primary-600 hover:bg-neutral-100 transition-all duration-200 cursor-pointer"
                            aria-label="Selanjutnya">
                        <span class="material-symbols-outlined text-4xl">chevron_right</span>
                    </button>

                    {{-- Indikator Dots --}}
                    <div class="flex items-center justify-center gap-2 mt-8">
                        <template x-for="i in totalItems">
                            <button @click="scrollTo(i - 1)"
                                    class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                                    :class="activeIndex === (i - 1) ? 'bg-primary-600 w-6' : 'bg-neutral-300 hover:bg-neutral-400'"
                                    :aria-label="'Testimoni ke-' + i">
                            </button>
                        </template>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="w-full bg-neutral-50 py-16 sm:py-20" data-aos="fade-up" data-aos-duration="700">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-2xl sm:text-4xl font-bold text-neutral-900 mb-6 tracking-tight">Percayakan Perjalanan Digital Anda kepada Centrova</h2>
                <p class="text-lg text-neutral-600 leading-normal mb-8 max-w-3xl mx-auto">
                    Setiap bisnis memiliki tantangan yang berbeda, sehingga tidak ada solusi yang benar-benar cocok untuk semua. Di Centrova, kami memulai setiap kolaborasi dengan memahami kebutuhan bisnis Anda, kemudian merancang solusi teknologi yang tepat, terukur, dan siap berkembang di masa depan.
                </p>
                <p class="text-base text-neutral-600 leading-normal mb-10 max-w-3xl mx-auto">
                    Baik Anda ingin membangun website perusahaan, mengembangkan aplikasi, mengotomatisasi proses bisnis dengan AI, maupun menciptakan produk digital baru, tim kami siap menjadi partner yang membantu mewujudkannya.
                </p>
                <p class="text-lg font-semibold text-primary-600">
                    Mari bangun teknologi yang bukan hanya berfungsi hari ini, tetapi juga membentuk masa depan bisnis Anda.
                </p>
            </div>
        </div>
    </section>
@endsection
