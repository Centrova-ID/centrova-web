{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Jasa UI/UX Design Profesional & User-Centered - Centrova')

{{-- Navbar --}}
@section('navbar')
    {{-- Navbar --}}
    @include('partials.navbar.services')
    {{-- Sub Navbar --}}
    @include('partials.navbar.subnavbar.services', [
        'servicesLinkText' => 'UI/UX Design',
        'servicesLinkUrl' => route('services.uiux-design'),
        'menuItems' => [
            ['text' => 'Layanan', 'url' => url('#layanan')],
            ['text' => 'Keunggulan', 'url' => url('#keunggulan')],
            ['text' => 'Proses', 'url' => url('#proses')],
            ['text' => 'Harga', 'url' => url('#harga')],
            ['text' => 'Konsultasi', 'url' => url('#konsultasi')],
        ],
    ])
@endsection

{{-- SEO & Meta Tags --}}
@section('seoMetaTags')
    {{-- Resource hints untuk performa --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://images.unsplash.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://unpkg.com">
    
    {{-- Preload critical images --}}
    <link rel="preload" href="/assets/image/services/uiux-design/hero-section/design-process.jpg" as="image">
    {{-- Preload critical data --}}
    <link rel="preload" href="/data/services-data.json" as="fetch" crossorigin="anonymous">
    
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta property="og:description" content="Centrova menyediakan jasa UI/UX design profesional dengan pendekatan user-centered. Dapatkan design interface yang menarik, usable, dan meningkatkan konversi bisnis Anda!"/>
    <meta name="twitter:site" content="@centrovaid"/>
    <meta property="og:title" content="Jasa UI/UX Design Profesional & User-Centered | Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:image" content="{{ config('app.url') }}/assets/image/services/uiux-design/og-image.jpg"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url('/services/uiux-design') }}"/>
    <meta name="description" content="Jasa UI/UX design profesional dengan metodologi design thinking, user research, wireframing, prototyping, dan usability testing. Gratis konsultasi dan harga terjangkau!"/>
    <link rel="canonical" href="{{ url('/services/uiux-design') }}"/>
@endsection

{{-- Structured Data: Service Schema — SEO untuk halaman jasa --}}
@push('structured-data')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "@id": "{{ url()->current() }}#service",
    "name": "Jasa UI/UX Design Profesional & User-Centered",
    "description": "Centrova menyediakan jasa UI/UX design profesional dengan pendekatan user-centered. Dapatkan design interface yang menarik, usable, dan meningkatkan konversi bisnis Anda.",
    "provider": {
        "@type": "Organization",
        "@id": "{{ url('/') }}#organization",
        "name": "Centrova",
        "url": "{{ url('/') }}"
    },
    "serviceType": "UI/UX Design",
    "areaServed": {
        "@type": "Country",
        "name": "Indonesia"
    },
    "offers": {
        "@type": "Offer",
        "availability": "https://schema.org/InStock",
        "priceCurrency": "IDR"
    }
}
</script>
@endpush

{{-- Critical CSS --}}
@section('style-css')
    <style>
        [x-cloak]{display:none!important}
        .scrollbar-hide{scrollbar-width:none;-ms-overflow-style:none}
        .scrollbar-hide::-webkit-scrollbar{display:none}
        .line-clamp-4{display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;line-clamp:4}
        .lazy-bg{background-color:#f3f4f6}
        .filter-scroll-drag{cursor:grab}
        .filter-scroll-drag.active{cursor:grabbing}
        html {
            scroll-behavior: smooth;
        }
        
        /* Mobile touch scrolling */
        @media (max-width: 768px) {
            html {
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
@endsection

{{-- Non-critical CSS --}}
@push('styles')
@once
<style>
    .swiper{padding-bottom:0}
    .swiper-button-next,.swiper-button-prev{display:none}
    .swiper-button-prev-custom,.swiper-button-next-custom{cursor:pointer}
    .swiper-button-prev-custom:active,.swiper-button-next-custom:active{transform:scale(.95)}
    .swiper-pagination-bullet-active{background:#128AEB!important}
</style>
@endonce
@endpush

@section('content')
    {{-- Hero Section --}}
    <section class="w-full bg-white py-32 max-md:py-16">
        <div class="w-full max-w-3xl mx-auto pt-24 md:pt-38 lg:pt-32 px-4">
            <div 
                class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center text-center" 
                data-aos="fade-up" 
                data-aos-duration="700" 
                data-aos-once="true" 
                data-aos-offset="10"
            >
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold text-slate-900 mb-6 sm:mb-8 md:mb-10 leading-tight">
                    Jasa UI/UX Design <br class="block sm:hidden">
                    <span class="text-[#128AEB]">Profesional & User-Centered</span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg max-w-3xl text-slate-600">
                    Kami menyediakan layanan UI/UX design berkualitas tinggi dengan pendekatan user-centered, design thinking yang terstruktur, dan focus pada pengalaman pengguna yang optimal untuk aplikasi mobile, web, dan desktop.
                </p>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Sudah saatnya --}}
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center" 
             data-aos="fade-up" 
             data-aos-duration="700" 
             data-aos-once="true" 
             data-aos-offset="10">
            
            {{-- Heading --}}
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Sudah Saatnya User Experience Anda Lebih Baik
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Design yang baik bukan hanya tentang visual, tapi bagaimana user merasa nyaman dan mudah mencapai tujuan mereka.
                </p>
            </div>
            
            <div class="w-full mt-10 md:mt-16 flex flex-col-reverse md:flex-row items-center justify-between gap-10 md:gap-16">
                
                {{-- Kiri --}}
                <div class="text-center md:text-left max-w-xl">
                    <h2 class="text-slate-900 font-medium text-2xl sm:text-3xl mb-4 sm:mb-6 leading-snug">Aplikasi Anda butuh design yang user-friendly</h2>
                    <p class="text-base sm:text-lg text-slate-600">Centrova menyediakan jasa UI/UX design profesional dengan pendekatan user-centered dan metodologi design thinking. Kami fokus pada research mendalam, wireframing yang matang, visual design yang menarik, dan testing berkelanjutan. Dengan experience di berbagai industri, kami siap membantu menciptakan digital experience yang memorable dan meningkatkan konversi bisnis Anda.</p>
                </div>

                {{-- Kanan --}}
                <img src="{{ asset('/assets/image/services/uiux-design/section_1.png') }}" 
                     alt="Ilustrasi jasa UI/UX design"
                     class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-lg flex-shrink-0"
                     loading="lazy"
                     decoding="async" />
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Bagaimana Cara Kerjanya --}}
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center" 
             data-aos="fade-up" 
             data-aos-duration="700" 
             data-aos-once="true" 
             data-aos-offset="10">
            
            {{-- Heading --}}
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Bagaimana Proses Design Kami?
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Metodologi design thinking yang terstruktur dari research hingga final design yang siap implementasi.
                </p>
            </div>
            
            <div class="w-full mt-10 md:mt-16 flex flex-col md:flex-row items-center justify-between gap-10 md:gap-16">
                
                {{-- Kiri - Gambar --}}
                <img src="{{ asset('/assets/image/services/uiux-design/how-it-works.png') }}" 
                     alt="Proses UI/UX design"
                     class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-lg flex-shrink-0"
                     loading="lazy"
                     decoding="async" />

                {{-- Kanan - Konten --}}
                <div class="text-center text-left max-w-xl">
                    {{-- Point 1 --}}
                    <div class="flex items-start gap-4 mb-6 text-left">
                        <div class="flex-shrink-0 w-8 h-8 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-sm">
                            1
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-semibold text-lg mb-2">Research & Discovery</h4>
                            <p class="text-slate-600 text-base">Memulai dengan user research mendalam, competitor analysis, dan pemahaman bisnis objectives. Kami juga melakukan stakeholder interview dan menyusun user persona yang akurat untuk foundation design yang solid.</p>
                        </div>
                    </div>

                    {{-- Point 2 --}}
                    <div class="flex items-start gap-4 mb-6 text-left">
                        <div class="flex-shrink-0 w-8 h-8 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-sm">
                            2
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-semibold text-lg mb-2">Wireframe & Prototyping</h4>
                            <p class="text-slate-600 text-base">Membuat information architecture, user flow mapping, dan wireframe detail. Kemudian mengembangkan interactive prototype untuk testing awal sebelum masuk ke tahap visual design.</p>
                        </div>
                    </div>

                    {{-- Point 3 --}}
                    <div class="flex items-start gap-4 text-left">
                        <div class="flex-shrink-0 w-8 h-8 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-sm">
                            3
                        </div>
                        <div>
                            <h4 class="text-slate-900 font-semibold text-lg mb-2">Visual Design & Testing</h4>
                            <p class="text-slate-600 text-base">Menerapkan visual design, branding, dan design system yang konsisten. Dilanjutkan dengan usability testing, iterasi berdasarkan feedback, dan design handoff yang complete untuk development team.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Pilihan dan Jenis Layanan --}}
    @push('styles')
    @once
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></noscript>
    @endonce
    @endpush
    <section id="layanan" class="w-full px-4 sm:px-6 lg:px-8 py-32 max-md:py-16" x-data="uiuxServicesSection">
        {{-- Heading --}}
        <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                Fokus Layanan UI/UX Design Kami
            </h2>
            <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                Layanan design komprehensif dari research hingga implementation
            </p>
        </div>
        
        {{-- Service Cards - Mobile: Swiper, Desktop: Grid --}}
        <div class="w-full max-w-screen-xl mx-auto">
            {{-- Mobile Swiper --}}
            <div class="swiper services-swiper block lg:hidden">
                <div class="swiper-wrapper" data-aos="fade-in" data-aos-duration="300" data-aos-delay="200" data-aos-once="true">
                    <template x-for="(item, idx) in services" :key="idx">
                        <div class="swiper-slide py-3">
                            <div
                            class="group relative cursor-pointer rounded-3xl flex flex-col justify-between overflow-hidden border border-neutral-200 shadow hover:shadow-md bg-white/80 transition-all duration-300 min-h-[500px] max-h-[500px] lazy-bg-services"
                            :data-bg="item.image"
                            @click="handleClick(idx)">
                                <div class="relative z-10 flex flex-col h-full px-7 py-6 justify-between">
                                    <span class="text-2xl font-semibold mb-1 transition text-slate-900 text-left w-full mt-2" x-text="item.title"></span>
                                    <span class="text-lg font-normal transition text-slate-800 text-left w-full" x-text="item.short"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Desktop Grid --}}
            <div class="hidden lg:grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-in" data-aos-duration="300" data-aos-delay="200" data-aos-once="true">
                <template x-for="(item, idx) in services" :key="idx">
                    <div class="py-3">
                        <div
                        class="group relative cursor-pointer rounded-3xl flex flex-col justify-between overflow-hidden border border-neutral-200 shadow hover:shadow-md bg-white/80 transition-all duration-300 min-h-[500px] max-h-[500px] lazy-bg-services"
                        :data-bg="item.image"
                        @click="handleClick(idx)">
                            <div class="relative z-10 flex flex-col h-full px-7 py-6 justify-between">
                                <span class="text-2xl font-semibold mb-1 transition text-slate-900 text-left w-full mt-2" x-text="item.title"></span>
                                <span class="text-lg font-normal transition text-slate-800 text-left w-full" x-text="item.short"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Custom Navigation Buttons for Mobile --}}
            <div class="flex justify-end items-center gap-3 mt-8 lg:hidden">
                <button class="swiper-button-prev-services flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB]/5 border-0 text-[#128AEB] hover:border hover:border-[#128AEB] hover:text-[#128AEB] hover:bg-[#128AEB]/15 transition-all duration-300 shadow-sm">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="swiper-button-next-services flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB]/5 border-0 text-[#128AEB] hover:border hover:border-[#128AEB] hover:text-[#128AEB] hover:bg-[#128AEB]/15 transition-all duration-300 shadow-sm">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Service Modal --}}
        <div x-show="showModal"
        x-cloak
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 flex items-center justify-center bg-black/80 backdrop-blur-md overflow-y-auto">
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-3xl w-full py-12 px-16 mx-4 border border-[#128AEB]/10 flex flex-col items-center max-md:py-16" @click.away="closeModal()">
                <button @click="closeModal()" class="absolute top-5 right-5 text-[#128AEB] bg-neutral-100 rounded-full w-8 h-8 flex items-center justify-center hover:bg-neutral-200 transition"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <span class="text-3xl font-bold text-slate-900 mb-6 text-left block w-full" x-text="modalTitle"></span>
                <div class="text-slate-800 text-xl leading-relaxed text-left" x-html="modalDesc"></div>
            </div>
        </div>
        @push('scripts')
        @once
        <script>
            // Load Swiper asynchronously for services section
            const loadSwiperUIUXServices = () => {
                if (typeof Swiper === 'undefined') {
                    const script = document.createElement('script');
                    script.src = 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js';
                    script.async = true;
                    script.onload = initSwiperUIUXServicesComponents;
                    document.head.appendChild(script);
                } else {
                    initSwiperUIUXServicesComponents();
                }
            };

            const initSwiperUIUXServicesComponents = () => {
                // Initialize swiper components if they exist
                if (window.Alpine && Alpine.store) {
                    setTimeout(() => {
                        if (document.querySelector('.services-swiper')) {
                            new Swiper('.services-swiper', {
                                slidesPerView: 1,
                                spaceBetween: 30,
                                loop: true,
                                navigation: {
                                    nextEl: '.swiper-button-next-services',
                                    prevEl: '.swiper-button-prev-services',
                                },
                                autoplay: {
                                    delay: 5000,
                                    disableOnInteraction: false,
                                },
                                breakpoints: {
                                    640: {
                                        slidesPerView: 2,
                                    },
                                    1024: {
                                        slidesPerView: 3,
                                    },
                                },
                            });
                        }
                    }, 100);
                }
            };

            // Load Swiper when page is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', loadSwiperUIUXServices);
            } else {
                loadSwiperUIUXServices();
            }

            // Lazy load background images for services section
            const lazyBgUIUXServicesObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const bgUrl = element.dataset.bg;
                        if (bgUrl) {
                            element.style.backgroundImage = `url(${bgUrl})`;
                            element.style.backgroundSize = 'cover';
                            element.style.backgroundPosition = 'center';
                            element.classList.remove('lazy-bg-services');
                        }
                        lazyBgUIUXServicesObserver.unobserve(element);
                    }
                });
            }, {
                rootMargin: '50px 0px'
            });

            // Observe lazy background elements when Alpine is ready
            document.addEventListener('alpine:initialized', () => {
                setTimeout(() => {
                    document.querySelectorAll('.lazy-bg-services').forEach(el => {
                        lazyBgUIUXServicesObserver.observe(el);
                    });
                }, 100);
            });
        </script>
        @endonce
        @endpush
        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('uiuxServicesSection', () => ({
                    services: [
                        {
                            title: 'User Research',
                            short: 'Riset mendalam untuk memahami kebutuhan dan behavior pengguna.',
                            desc: 'Melakukan user interview, survey, competitive analysis, dan persona development untuk memahami target user secara mendalam. Termasuk journey mapping dan pain point analysis untuk foundation design yang solid.',
                            image: '/assets/image/services/uiux-design/user-research.jpg'
                        },
                        {
                            title: 'Wireframe & Prototyping',
                            short: 'Kerangka layout dan prototype interaktif untuk validasi konsep.',
                            desc: 'Membuat information architecture, user flow, dan wireframe detail dari low-fidelity hingga high-fidelity. Dilanjutkan dengan interactive prototype menggunakan tools modern untuk testing dan iterasi sebelum visual design.',
                            image: '/assets/image/services/uiux-design/wireframe-prototype.jpg'
                        },
                        {
                            title: 'Visual Design',
                            short: 'Design interface yang menarik dengan konsistensi brand.',
                            desc: 'Menerapkan visual hierarchy, typography, color theory, dan brand identity ke dalam interface design. Fokus pada aesthetic usability dan emotional design yang menciptakan connection dengan user.',
                            image: '/assets/image/services/uiux-design/visual-design.jpg'
                        },
                        {
                            title: 'Design System',
                            short: 'Sistem design yang konsisten dan scalable.',
                            desc: 'Membangun design system komprehensif dengan component library, design tokens, style guide, dan documentation yang memastikan konsistensi di seluruh platform dan memudahkan development team.',
                            image: '/assets/image/services/uiux-design/design-system.jpg'
                        },
                        {
                            title: 'Usability Testing',
                            short: 'Testing dengan real users untuk optimasi design.',
                            desc: 'Melakukan moderated dan unmoderated usability testing, A/B testing, dan heuristic evaluation untuk mengidentifikasi usability issues dan melakukan iterasi design berdasarkan data user behavior.',
                            image: '/assets/image/services/uiux-design/usability-testing.jpg'
                        },
                        {
                            title: 'Design Handoff',
                            short: 'Dokumentasi dan asset siap untuk development.',
                            desc: 'Menyiapkan design specifications, asset export, developer-friendly documentation, dan collaboration tools seperti Figma Dev Mode untuk memastikan implementation yang pixel-perfect oleh development team.',
                            image: '/assets/image/services/uiux-design/design-handoff.jpg'
                        },
                    ],
                    showModal: false,
                    modalIndex: null,
                    modalTitle: '',
                    modalDesc: '',
                    handleClick(idx) {
                        this.openModal(idx);
                    },
                    openModal(idx) {
                        this.modalIndex = idx;
                        const item = this.services[idx];
                        this.modalTitle = item.title;
                        this.modalDesc = item.desc;
                        this.showModal = true;
                        document.body.style.overflow = 'hidden';
                    },
                    closeModal() {
                        this.showModal = false;
                        document.body.style.overflow = 'auto';

                        // Tunda reset konten modal setelah animasi selesai
                        setTimeout(() => {
                            this.modalDesc = '';
                        }, 300);
                    },
                    swiper: null,
                    init() {
                        // Pastikan modal tidak aktif saat init
                        this.showModal = false;
                        this.modalIndex = null;
                        this.modalTitle = '';
                        this.modalDesc = '';

                        this.$nextTick(() => {
                            // Initialize swiper for mobile view
                            if (window.innerWidth < 1024) {
                                this.initSwiper();
                            }
                        });
                    },
                    initSwiper() {
                        if (typeof Swiper !== 'undefined' && document.querySelector('.services-swiper')) {
                            this.swiper = new Swiper('.services-swiper', {
                                slidesPerView: 1,
                                spaceBetween: 30,
                                loop: true,
                                navigation: {
                                    nextEl: '.swiper-button-next-services',
                                    prevEl: '.swiper-button-prev-services',
                                },
                                autoplay: {
                                    delay: 5000,
                                    disableOnInteraction: false,
                                },
                                breakpoints: {
                                    640: {
                                        slidesPerView: 2,
                                    },
                                },
                            });
                        }
                    }
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Keunggulan Layanan Kami --}}
    @push('styles')
    @once
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></noscript>
    @endonce
    @endpush
    <section id="keunggulan" class="w-full px-4 sm:px-6 lg:px-8 py-32 max-md:py-16" x-data="uiuxAdvantagesSection">
        {{-- Heading --}}
        <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                Keunggulan Layanan UI/UX Design Kami
            </h2>
            <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto mb-4">
                Mengapa memilih Centrova untuk UI/UX design yang user-centered dan conversion-focused
            </p>
            {{-- Swipe Indicator --}}
            <div class="flex items-center justify-center gap-2 text-sm text-slate-500 mt-6">
                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                <span class="font-medium">Geser untuk melihat lebih banyak</span>
                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </div>
        </div>
        <div class="w-full max-w-screen-xl mx-auto">
            {{-- Progress Indicator --}}
            <div class="flex justify-center mb-6">
                <div class="flex space-x-2">
                    <template x-for="(item, idx) in advantages" :key="idx">
                        <div 
                            class="w-2 h-2 rounded-full transition-all duration-300 cursor-pointer"
                            :class="currentSlide === idx ? 'bg-[#128AEB] w-6' : 'bg-gray-300 hover:bg-gray-400'"
                            @click="goToSlide(idx)">
                        </div>
                    </template>
                </div>
            </div>

            <div class="swiper advantages-swiper relative overflow-hidden">
                {{-- Gradient Overlays for scroll indication --}}
                <div class="absolute left-0 top-0 w-8 h-full bg-gradient-to-r from-white to-transparent z-10 pointer-events-none opacity-50"></div>
                <div class="absolute right-0 top-0 w-8 h-full bg-gradient-to-l from-white to-transparent z-10 pointer-events-none opacity-50"></div>
                
                <div class="swiper-wrapper" data-aos="fade-in" data-aos-duration="300" data-aos-delay="200" data-aos-once="true">
                    <template x-for="(item, idx) in advantages" :key="idx">
                        <div class="swiper-slide py-3">
                            <div
                                class="group relative cursor-pointer rounded-3xl flex flex-col justify-between overflow-hidden border border-neutral-200 shadow hover:shadow-lg bg-white/80 transition-all duration-300 min-h-[500px] max-h-[500px] lazy-bg-advantages hover:scale-105 hover:border-[#128AEB]/30"
                                :data-bg="item.image"
                                @click="handleClick(idx)">
                                {{-- Click indicator --}}
                                <div class="absolute top-4 right-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="bg-[#128AEB]/10 backdrop-blur-sm rounded-full p-2">
                                        <svg class="w-4 h-4 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="relative z-10 flex flex-col h-full px-7 py-6 justify-between">
                                    <span class="text-2xl font-semibold mb-1 transition text-slate-900 text-left w-full mt-2 group-hover:text-[#128AEB]" x-text="item.title"></span>
                                    <div class="space-y-3">
                                        <span class="text-lg font-normal transition text-slate-800 text-left w-full" x-text="item.short"></span>
                                        <div class="text-sm text-[#128AEB] font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            Klik untuk detail lengkap →
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Navigation & Instructions --}}
            <div class="flex justify-between items-center mt-8">
                {{-- Left side: Touch instruction --}}
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <div class="hidden sm:flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.121 2.122"/>
                        </svg>
                        <span>Klik card untuk detail</span>
                    </div>
                    <div class="sm:hidden flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                        </svg>
                        <span>Swipe untuk navigasi</span>
                    </div>
                </div>

                {{-- Right side: Navigation buttons --}}
                <div class="flex items-center gap-3">
                    <button class="swiper-button-prev-custom flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB]/5 border-0 text-[#128AEB] hover:border hover:border-[#128AEB] hover:text-[#128AEB] hover:bg-[#128AEB]/15 transition-all duration-300 shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="swiper-button-next-custom flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB]/5 border-0 text-[#128AEB] hover:border hover:border-[#128AEB] hover:text-[#128AEB] hover:bg-[#128AEB]/15 transition-all duration-300 shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Advantages Modal --}}
        <div x-show="showModal"
        x-cloak
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 flex items-center justify-center bg-black/80 backdrop-blur-md overflow-y-auto">
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-3xl w-full py-12 px-16 mx-4 border border-[#128AEB]/10 flex flex-col items-center max-md:py-16" @click.away="closeModal()">
                <button @click="closeModal()" class="absolute top-5 right-5 text-[#128AEB] bg-neutral-100 rounded-full w-8 h-8 flex items-center justify-center hover:bg-neutral-200 transition"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <span class="text-3xl font-bold text-slate-900 mb-6 text-left block w-full" x-text="modalTitle"></span>
                <div class="text-slate-800 text-xl leading-relaxed text-left" x-html="modalDesc"></div>
            </div>
        </div>
        @push('scripts')
        @once
        <script>
            // Load Swiper asynchronously
            const loadSwiperUIUX = () => {
                if (typeof Swiper === 'undefined') {
                    const script = document.createElement('script');
                    script.src = 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js';
                    script.async = true;
                    script.onload = initSwiperUIUXComponents;
                    document.head.appendChild(script);
                } else {
                    initSwiperUIUXComponents();
                }
            };

            const initSwiperUIUXComponents = () => {
                // Initialize swiper components if they exist
                if (window.Alpine && Alpine.store) {
                    setTimeout(() => {
                        if (document.querySelector('.advantages-swiper')) {
                            new Swiper('.advantages-swiper', {
                                slidesPerView: 1,
                                spaceBetween: 30,
                                loop: true,
                                navigation: {
                                    nextEl: '.swiper-button-next-custom',
                                    prevEl: '.swiper-button-prev-custom',
                                },
                                autoplay: {
                                    delay: 5000,
                                    disableOnInteraction: false,
                                },
                                breakpoints: {
                                    640: {
                                        slidesPerView: 2,
                                    },
                                    1024: {
                                        slidesPerView: 3,
                                    },
                                },
                            });
                        }
                    }, 100);
                }
            };

            // Load Swiper when page is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', loadSwiperUIUX);
            } else {
                loadSwiperUIUX();
            }

            // Lazy load background images for advantages section
            const lazyBgUIUXAdvantagesObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const bgUrl = element.dataset.bg;
                        if (bgUrl) {
                            element.style.backgroundImage = `url(${bgUrl})`;
                            element.style.backgroundSize = 'cover';
                            element.style.backgroundPosition = 'center';
                            element.classList.remove('lazy-bg-advantages');
                        }
                        lazyBgUIUXAdvantagesObserver.unobserve(element);
                    }
                });
            }, {
                rootMargin: '50px 0px'
            });

            // Observe lazy background elements when Alpine is ready
            document.addEventListener('alpine:initialized', () => {
                setTimeout(() => {
                    document.querySelectorAll('.lazy-bg-advantages').forEach(el => {
                        lazyBgUIUXAdvantagesObserver.observe(el);
                    });
                }, 100);
            });
        </script>
        @endonce
        @endpush
        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('uiuxAdvantagesSection', () => ({
                    advantages: [
                        {
                            title: 'User-Centered Approach',
                            short: 'Metodologi design yang berpusat pada kebutuhan user.',
                            desc: 'Kami selalu memulai dengan memahami user behavior, pain points, dan goals melalui research mendalam. Setiap design decision divalidasi dengan user testing untuk memastikan solusi yang tepat sasaran dan meningkatkan user satisfaction.',
                            image: '/assets/image/services/uiux-design/advantages/user-centered.jpg'
                        },
                        {
                            title: 'Data-Driven Design',
                            short: 'Design berdasarkan data dan analytics yang valid.',
                            desc: 'Menggunakan analytics, heatmaps, user behavior data, dan A/B testing untuk membuat design decisions yang objektif. Pendekatan ini memastikan design yang tidak hanya terlihat bagus, tapi juga terbukti efektif meningkatkan conversion dan engagement.',
                            image: '/assets/image/services/uiux-design/advantages/data-driven.jpg'
                        },
                        {
                            title: 'Design System Expertise',
                            short: 'Membangun sistem design yang scalable dan maintainable.',
                            desc: 'Specialist dalam membangun design system yang comprehensive dengan component library, design tokens, dan documentation yang detail. Memastikan konsistensi brand dan mempercepat development cycle di masa depan.',
                            image: '/assets/image/services/uiux-design/advantages/design-system.jpg'
                        },
                        {
                            title: 'Cross-Platform Design',
                            short: 'Expertise di mobile, web, dan desktop platforms.',
                            desc: 'Berpengalaman dalam design untuk berbagai platform dengan memahami platform-specific guidelines (Material Design, Human Interface Guidelines) dan responsive design principles yang optimal untuk setiap device.',
                            image: '/assets/image/services/uiux-design/advantages/cross-platform.jpg'
                        },
                        {
                            title: 'Rapid Prototyping',
                            short: 'Prototype cepat untuk validasi konsep early stage.',
                            desc: 'Menggunakan tools modern seperti Figma, Framer, dan ProtoPie untuk membuat interactive prototype yang realistic. Memungkinkan stakeholder dan user untuk merasakan experience sebelum development dimulai.',
                            image: '/assets/image/services/uiux-design/advantages/prototyping.jpg'
                        },
                        {
                            title: 'Conversion Optimization',
                            short: 'Focus pada peningkatan conversion dan business metrics.',
                            desc: 'Setiap design element dirancang dengan mempertimbangkan conversion funnel dan business objectives. Menggunakan psychology principles, persuasive design patterns, dan CRO best practices untuk maximizing business impact.',
                            image: '/assets/image/services/uiux-design/advantages/conversion.jpg'
                        },
                    ],
                showModal: false,
                modalIndex: null,
                modalTitle: '',
                modalDesc: '',
                swiper: null,
                currentSlide: 0,
                handleClick(idx) {
                    this.openModal(idx);
                },
                openModal(idx) {
                    this.modalIndex = idx;
                    const item = this.advantages[idx];
                    this.modalTitle = item.title;
                    this.modalDesc = item.desc;
                    this.showModal = true;
                    document.body.style.overflow = 'hidden';
                },
                closeModal() {
                    this.showModal = false;
                    document.body.style.overflow = 'auto';

                    // Tunda reset konten modal setelah animasi selesai (misal: 300ms)
                    setTimeout(() => {
                        this.modalDesc = '';
                    }, 300);
                },
                goToSlide(index) {
                    if (this.swiper) {
                        this.swiper.slideTo(index);
                        this.currentSlide = index;
                    }
                },
                init() {
                    // Pastikan modal tidak aktif saat init
                    this.showModal = false;
                    this.modalIndex = null;
                    this.modalTitle = '';
                    this.modalDesc = '';

                    this.$nextTick(() => {
                        this.initSwiper();
                    });
                },
                initSwiper() {
                    if (typeof Swiper !== 'undefined' && document.querySelector('.advantages-swiper')) {
                        this.swiper = new Swiper('.advantages-swiper', {
                            slidesPerView: 1,
                            spaceBetween: 30,
                            loop: true,
                            navigation: {
                                nextEl: '.swiper-button-next-custom',
                                prevEl: '.swiper-button-prev-custom',
                            },
                            autoplay: {
                                delay: 5000,
                                disableOnInteraction: false,
                            },
                            breakpoints: {
                                640: {
                                    slidesPerView: 2,
                                },
                                1024: {
                                    slidesPerView: 3,
                                },
                            },
                            on: {
                                slideChange: (swiper) => {
                                    this.currentSlide = swiper.realIndex;
                                },
                                reachBeginning: (swiper) => {
                                    const prevBtn = document.querySelector('.swiper-button-prev-custom');
                                    if (prevBtn) prevBtn.classList.add('opacity-50');
                                },
                                reachEnd: (swiper) => {
                                    const nextBtn = document.querySelector('.swiper-button-next-custom');
                                    if (nextBtn) nextBtn.classList.add('opacity-50');
                                },
                                fromEdge: (swiper) => {
                                    const prevBtn = document.querySelector('.swiper-button-prev-custom');
                                    const nextBtn = document.querySelector('.swiper-button-next-custom');
                                    if (prevBtn) prevBtn.classList.remove('opacity-50');
                                    if (nextBtn) nextBtn.classList.remove('opacity-50');
                                }
                            }
                        });
                    }
                }
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">
    {{-- Proses Design --}}
    <section id="proses" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Metodologi Design Thinking Kami</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto">
                    Proses terstruktur dan user-centered dari research hingga implementation
                </p>
            </div>

            <div class="space-y-12">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-1/2">
                        <div class="bg-gradient-to-br from-pink-50 to-white p-8 rounded-2xl shadow-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-pink-100 rounded-full p-4 flex-shrink-0">
                                    <span class="text-pink-600 font-bold text-xl">1</span>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Empathize & Research</h3>
                                    <p class="text-slate-600 mb-4">Memahami user secara mendalam melalui research dan empathy building.</p>
                                    <ul class="space-y-2 text-sm text-slate-600">
                                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-500 rounded-full mr-3"></span>User interviews & contextual inquiry</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-500 rounded-full mr-3"></span>Surveys & analytics analysis</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-500 rounded-full mr-3"></span>Competitor & market research</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-500 rounded-full mr-3"></span>Stakeholder interviews</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <img src="/assets/image/services/uiux-design/process/empathize-research.jpg" alt="Empathize & Research" class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                    <div class="lg:w-1/2">
                        <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-100 rounded-full p-4 flex-shrink-0">
                                    <span class="text-blue-600 font-bold text-xl">2</span>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Define & Synthesize</h3>
                                    <p class="text-slate-600 mb-4">Mendefinisikan problem statement dan user needs yang actionable.</p>
                                    <ul class="space-y-2 text-sm text-slate-600">
                                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>User persona development</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Customer journey mapping</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Problem statement definition</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Design requirements & constraints</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <img src="/assets/image/services/uiux-design/process/define-synthesize.jpg" alt="Define & Synthesize" class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-1/2">
                        <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-green-100 rounded-full p-4 flex-shrink-0">
                                    <span class="text-green-600 font-bold text-xl">3</span>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Ideate & Conceptualize</h3>
                                    <p class="text-slate-600 mb-4">Brainstorming dan ideation untuk mengeksplorasi solusi kreatif.</p>
                                    <ul class="space-y-2 text-sm text-slate-600">
                                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Ideation workshops & brainstorming</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Information architecture</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>User flow mapping</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Feature prioritization matrix</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <img src="/assets/image/services/uiux-design/process/ideate-conceptualize.jpg" alt="Ideate & Conceptualize" class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                    <div class="lg:w-1/2">
                        <div class="bg-gradient-to-br from-purple-50 to-white p-8 rounded-2xl shadow-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-purple-100 rounded-full p-4 flex-shrink-0">
                                    <span class="text-purple-600 font-bold text-xl">4</span>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Prototype & Design</h3>
                                    <p class="text-slate-600 mb-4">Mengembangkan wireframe dan visual design yang tangible.</p>
                                    <ul class="space-y-2 text-sm text-slate-600">
                                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Low-fi to high-fi wireframes</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Interactive prototypes</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Visual design & branding</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Design system development</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <img src="/assets/image/services/uiux-design/process/prototype-design.jpg" alt="Prototype & Design" class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <div class="lg:w-1/2">
                        <div class="bg-gradient-to-br from-orange-50 to-white p-8 rounded-2xl shadow-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-orange-100 rounded-full p-4 flex-shrink-0">
                                    <span class="text-orange-600 font-bold text-xl">5</span>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Test & Iterate</h3>
                                    <p class="text-slate-600 mb-4">Validasi design dengan user testing dan continuous improvement.</p>
                                    <ul class="space-y-2 text-sm text-slate-600">
                                        <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Usability testing sessions</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>A/B testing & analytics</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Heuristic evaluation</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Design iteration & refinement</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <img src="/assets/image/services/uiux-design/process/test-iterate.jpg" alt="Test & Iterate" class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                    <div class="lg:w-1/2">
                        <div class="bg-gradient-to-br from-teal-50 to-white p-8 rounded-2xl shadow-lg">
                            <div class="flex items-start space-x-4">
                                <div class="bg-teal-100 rounded-full p-4 flex-shrink-0">
                                    <span class="text-teal-600 font-bold text-xl">6</span>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Handoff & Support</h3>
                                    <p class="text-slate-600 mb-4">Memastikan implementation yang accurate dan ongoing support.</p>
                                    <ul class="space-y-2 text-sm text-slate-600">
                                        <li class="flex items-center"><span class="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>Design specifications & redlines</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>Asset preparation & export</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>Developer collaboration</li>
                                        <li class="flex items-center"><span class="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>QA & implementation review</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <img src="/assets/image/services/uiux-design/process/handoff-support.jpg" alt="Handoff & Support" class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Paket & Harga Section --}}
    <section id="harga" x-data="uiuxPricingSection" class="py-32 max-md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Paket UI/UX Design</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto mb-8">
                    Pilih paket design yang sesuai dengan kebutuhan dan budget proyek Anda
                </p>

                {{-- Pricing Toggle --}}
                <div class="mx-auto">
                    <div class="flex items-center justify-center rounded-full overflow-x-auto overflow-y-hidden p-1 gap-1 w-auto scrollbar-hide select-none mx-auto">
                        <template x-for="(category, idx) in categories" :key="idx">
                            <button 
                                @click="currentCategory = category.key"
                                :class="currentCategory === category.key ? 'bg-[#128AEB] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                                class="px-6 py-3 rounded-full font-medium text-sm transition-all duration-300 whitespace-nowrap"
                                x-text="category.name">
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Pricing Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="(plan, index) in currentPlans" :key="index">
                    <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-shadow duration-300"
                         :class="plan.featured ? 'ring-2 ring-[#128AEB] transform scale-105' : ''">
                        <template x-if="plan.featured">
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                <span class="bg-[#128AEB] text-white px-4 py-2 rounded-full text-sm font-medium">
                                    Most Popular
                                </span>
                            </div>
                        </template>
                        
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-slate-900 mb-2" x-text="plan.name"></h3>
                            <p class="text-gray-600 mb-4" x-text="plan.description"></p>
                            <div class="mb-4">
                                <span class="text-4xl font-bold text-slate-900" x-text="plan.price"></span>
                                <template x-if="plan.timeline">
                                    <span class="text-gray-600 ml-2" x-text="'/ ' + plan.timeline"></span>
                                </template>
                            </div>
                            <template x-if="plan.note">
                                <p class="text-sm text-gray-500" x-text="plan.note"></p>
                            </template>
                        </div>

                        <ul class="space-y-3 mb-8">
                            <template x-for="feature in plan.features" :key="feature">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700" x-text="feature"></span>
                                </li>
                            </template>
                        </ul>

                        <button 
                            @click="selectPlan(plan)"
                            :class="plan.featured ? 'bg-[#128AEB] hover:bg-[#0f75c6] text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-800'"
                            class="w-full py-3 px-6 rounded-lg font-semibold transition-colors duration-300">
                            <template x-if="plan.cta">
                                <span x-text="plan.cta"></span>
                            </template>
                            <template x-if="!plan.cta">
                                <span>Pilih Paket</span>
                            </template>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        {{-- Modal Konsultasi untuk User Belum Login --}}
        <div x-show="showConsultationModal"
        x-cloak
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-start justify-center bg-black/80 backdrop-blur-md overflow-y-auto">
            <div class="relative bg-white rounded-[32px] mt-12 mb-44 shadow-2xl max-w-2xl w-full py-12 px-16 mx-4 border border-[#128AEB]/10 flex flex-col items-center max-md:py-8 max-md:px-8" @click.away="closeConsultationModal()">
                <button @click="closeConsultationModal()" class="absolute top-8 right-8 text-[#128AEB] bg-neutral-100 rounded-full w-8 h-8 flex items-center justify-center hover:bg-neutral-200 transition">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold text-slate-900 mb-4">Konsultasi UI/UX Design</h3>
                    <p class="text-lg text-slate-600">Diskusikan kebutuhan design project Anda dengan tim expert kami</p>
                </div>

                {{-- Info Paket yang Dipilih --}}
                <div class="w-full bg-gradient-to-r from-[#128AEB]/5 to-blue-50 rounded-2xl p-6 mb-8 border border-[#128AEB]/20">
                    <h4 class="font-semibold text-lg text-slate-900 mb-2">Paket yang Dipilih:</h4>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-700" x-text="selectedPlan?.name"></span>
                        <span class="font-bold text-[#128AEB]" x-text="selectedPlan?.price"></span>
                    </div>
                </div>

                {{-- Form Konsultasi Singkat --}}
                <div class="w-full space-y-4 mb-8">
                    <input type="text" placeholder="Nama Lengkap" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                    <input type="email" placeholder="Email" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                    <input type="tel" placeholder="WhatsApp" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                    <textarea placeholder="Ceritakan tentang project UI/UX design Anda..." rows="4" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#128AEB] focus:border-transparent"></textarea>
                </div>

                {{-- Tombol Action --}}
                <div class="w-full">
                    <button class="w-full bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold py-4 px-6 rounded-xl transition-colors duration-300 mb-4">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Kirim & Mulai Konsultasi
                    </button>
                    <p class="text-sm text-gray-500 text-center">Atau hubungi kami langsung via WhatsApp untuk konsultasi cepat</p>
                </div>
            </div>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('uiuxPricingSection', () => ({
                    currentCategory: 'website',
                    showConsultationModal: false,
                    selectedPlan: null,
                    categories: [
                        { key: 'website', name: 'Website & Web App' },
                        { key: 'mobile', name: 'Mobile App' },
                        { key: 'system', name: 'Design System' }
                    ],
                    plans: {
                        website: [
                            {
                                name: 'Basic Web UI',
                                description: 'Perfect untuk startup dan landing page',
                                price: 'Rp 5-15 Juta',
                                timeline: '2-3 minggu',
                                features: [
                                    'User research & persona',
                                    'Wireframe low-fidelity',
                                    'Visual design 5-8 halaman',
                                    'Desktop & mobile responsive',
                                    'Basic component library',
                                    '2x revisi design',
                                    'Design handoff untuk developer'
                                ],
                                cta: 'Mulai Project'
                            },
                            {
                                name: 'Professional Web UX',
                                description: 'Solusi lengkap untuk business website',
                                price: 'Rp 15-35 Juta',
                                timeline: '4-6 minggu',
                                featured: true,
                                features: [
                                    'Deep user research & analytics',
                                    'User journey mapping',
                                    'Interactive wireframes',
                                    'Visual design 10-15 halaman',
                                    'Advanced micro-interactions',
                                    'Comprehensive design system',
                                    'Usability testing session',
                                    '3x revisi design',
                                    'Developer collaboration'
                                ],
                                cta: 'Most Popular'
                            },
                            {
                                name: 'Enterprise Web',
                                description: 'Complete solution untuk enterprise platform',
                                price: 'Rp 35+ Juta',
                                timeline: '8-12 minggu',
                                features: [
                                    'Extensive user research',
                                    'Multiple user personas',
                                    'Complex user flow mapping',
                                    'High-fidelity prototypes',
                                    'Advanced design system',
                                    'Multiple usability testing',
                                    'A/B testing consultation',
                                    'Unlimited revisi',
                                    'Ongoing design support'
                                ],
                                cta: 'Konsultasi Custom'
                            }
                        ],
                        mobile: [
                            {
                                name: 'Simple Mobile App',
                                description: 'Basic mobile app dengan core features',
                                price: 'Rp 8-20 Juta',
                                timeline: '3-4 minggu',
                                features: [
                                    'Mobile-first user research',
                                    'Native platform guidelines',
                                    'Wireframe & user flow',
                                    'Visual design 8-12 screens',
                                    'Basic animation specs',
                                    'Component documentation',
                                    '2x revisi design'
                                ],
                                cta: 'Mulai Project'
                            },
                            {
                                name: 'Advanced Mobile UX',
                                description: 'Complete mobile experience design',
                                price: 'Rp 20-50 Juta',
                                timeline: '6-8 minggu',
                                featured: true,
                                features: [
                                    'Comprehensive user research',
                                    'Cross-platform design system',
                                    'Interactive prototypes',
                                    'Advanced micro-interactions',
                                    'Usability testing on devices',
                                    'Accessibility compliance',
                                    'Animation & transition specs',
                                    '3x revisi design',
                                    'Implementation support'
                                ],
                                cta: 'Most Popular'
                            },
                            {
                                name: 'Enterprise Mobile',
                                description: 'Complex mobile ecosystem design',
                                price: 'Rp 50+ Juta',
                                timeline: '10-16 minggu',
                                features: [
                                    'Multi-platform user research',
                                    'Enterprise design system',
                                    'Complex user journey design',
                                    'Advanced prototyping',
                                    'Multiple device testing',
                                    'Security & compliance design',
                                    'Performance optimization',
                                    'Unlimited revisi',
                                    'Long-term design partnership'
                                ],
                                cta: 'Konsultasi Custom'
                            }
                        ],
                        system: [
                            {
                                name: 'Basic Design System',
                                description: 'Starter kit untuk konsistensi brand',
                                price: 'Rp 10-25 Juta',
                                timeline: '3-4 minggu',
                                features: [
                                    'Brand audit & guidelines',
                                    'Color palette & typography',
                                    'Basic component library',
                                    'Icon set & imagery style',
                                    'Style guide documentation',
                                    'Figma component kit',
                                    '2x revisi system'
                                ],
                                cta: 'Mulai Project'
                            },
                            {
                                name: 'Complete Design System',
                                description: 'Production-ready design system',
                                price: 'Rp 25-60 Juta',
                                timeline: '6-10 minggu',
                                featured: true,
                                features: [
                                    'Comprehensive design audit',
                                    'Design tokens & variables',
                                    'Complete component library',
                                    'Responsive grid system',
                                    'Animation & interaction specs',
                                    'Accessibility guidelines',
                                    'Developer handoff tools',
                                    'Implementation guidelines',
                                    '3x revisi system'
                                ],
                                cta: 'Most Popular'
                            },
                            {
                                name: 'Enterprise Design System',
                                description: 'Scalable system untuk organisasi besar',
                                price: 'Rp 60+ Juta',
                                timeline: '12-20 minggu',
                                features: [
                                    'Multi-brand system architecture',
                                    'Advanced design tokens',
                                    'Cross-platform components',
                                    'Governance & maintenance plan',
                                    'Team training & workshops',
                                    'Version control system',
                                    'Integration with dev tools',
                                    'Ongoing system evolution',
                                    'Unlimited revisi'
                                ],
                                cta: 'Konsultasi Custom'
                            }
                        ]
                    },
                    get currentPlans() {
                        return this.plans[this.currentCategory] || [];
                    },
                    selectPlan(plan) {
                        this.selectedPlan = plan;
                        this.showConsultationModal = true;
                        document.body.style.overflow = 'hidden';
                    },
                    closeConsultationModal() {
                        this.showConsultationModal = false;
                        document.body.style.overflow = 'auto';
                        setTimeout(() => {
                            this.selectedPlan = null;
                        }, 300);
                    }
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- CTA Konsultasi --}}
    <div id="konsultasi" class="text-center py-32 max-md:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-slate-900 mb-4">
                Coba Gratis Konsultasi UI/UX Design Anda
            </h3>
            <p class="text-slate-600 text-base sm:text-lg mb-6">
                Lihat kenapa puluhan startup dan enterprise mempercayakan UI/UX design mereka kepada Centrova.
            </p>
            <a href="{{ route('service.consult') }}" target="_blank" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition flex items-center justify-center mx-auto inline-block">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                Hubungi Kami
            </a>
        </div>
    </div>

    {{-- FAQ Section --}}
    <section class="py-32 max-md:py-16 bg-neutral-50" x-data="uiuxFaqSection">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-slate-900 mb-4">
            Frequently Asked Questions
          </h3>
          <p class="text-lg text-slate-600">
            Jawaban untuk pertanyaan umum tentang layanan UI/UX design kami
          </p>
        </div>

        <div>
          <template x-for="(faq, index) in faqs" :key="index">
            <div class="border-b border-gray-200 py-6">
              <button @click="toggleFaq(index)" class="flex justify-between items-center w-full text-left">
                <span class="text-lg font-medium text-slate-900" x-text="faq.question"></span>
                <svg :class="openIndex === index ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div x-show="openIndex === index" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-4">
                <p class="text-slate-600 leading-relaxed" x-text="faq.answer"></p>
              </div>
            </div>
          </template>
        </div>
      </div>
      @push('scripts')
      @once
      <script>
          document.addEventListener('alpine:init', () => {
              Alpine.data('uiuxFaqSection', () => ({
                  openIndex: null,
                  faqs: [
                      {
                          question: 'Apa perbedaan UI dan UX Design?',
                          answer: 'UI (User Interface) fokus pada tampilan visual dan elemen interaktif, sedangkan UX (User Experience) fokus pada keseluruhan pengalaman pengguna. Kami menggabungkan keduanya untuk hasil yang optimal - interface yang beautiful dan experience yang seamless.'
                      },
                      {
                          question: 'Berapa lama proses UI/UX design untuk satu project?',
                          answer: 'Timeline bervariasi tergantung kompleksitas project. Basic design 2-3 minggu, Professional 4-6 minggu, dan Enterprise bisa 8-12 minggu. Kami selalu memberikan timeline yang realistic dan transparan sejak awal.'
                      },
                      {
                          question: 'Apakah termasuk user research dan testing?',
                          answer: 'Ya, semua paket kami include user research sebagai foundation. Untuk paket Professional ke atas, kami juga melakukan usability testing untuk memvalidasi design sebelum handoff ke development.'
                      },
                      {
                          question: 'Tools apa yang digunakan untuk design?',
                          answer: 'Kami menggunakan Figma sebagai primary tool untuk collaborative design, plus tools pendukung seperti Miro untuk workshop, Maze untuk testing, dan ProtoPie untuk advanced prototyping jika diperlukan.'
                      },
                      {
                          question: 'Apakah design responsive untuk mobile dan desktop?',
                          answer: 'Absolutely! Semua design kami responsive dan kami selalu consider mobile-first approach. Kami juga familiar dengan platform-specific guidelines seperti Material Design dan HIG.'
                      },
                      {
                          question: 'Bagaimana proses revisi design?',
                          answer: 'Setiap paket include revisi rounds yang sudah ditentukan. Kami structured feedback process dengan clear timeline dan scope untuk memastikan hasil final sesuai ekspektasi tanpa scope creep.'
                      },
                      {
                          question: 'Apakah bisa design untuk industri khusus seperti fintech atau healthcare?',
                          answer: 'Ya, kami berpengalaman di berbagai industri including regulated industries seperti fintech, healthcare, dan edtech. Kami understand compliance requirements dan industry best practices.'
                      },
                      {
                          question: 'Bagaimana handoff ke developer setelah design selesai?',
                          answer: 'Kami provide comprehensive design specs, asset export, dan developer-friendly documentation. Plus kami available untuk collaboration during implementation untuk ensure pixel-perfect results.'
                      }
                  ],
                  toggleFaq(index) {
                      this.openIndex = this.openIndex === index ? null : index;
                  }
              }));
          });
      </script>
      @endonce
      @endpush
    </section>

    {{-- Quick Links --}}
    <section class="w-full pt-10 bg-neutral-100" x-data="uiuxQuickLinksSection">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <h1 class="font-semibold text-2xl mb-4">Quick Links</h1>
            <div class="flex justify-start gap-3 items-center w-full border-b border-neutral-300 pb-10 flex-wrap">
                <template x-for="(link, index) in quickLinks" :key="index">
                    <a :href="link.url" class="bg-white hover:bg-gray-50 text-slate-700 hover:text-[#128AEB] px-4 py-2 rounded-full border border-gray-200 hover:border-[#128AEB] text-sm font-medium transition-all duration-300" x-text="link.text"></a>
                </template>
            </div>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('uiuxQuickLinksSection', () => ({
                    quickLinks: [
                        { text: 'UI Design', url: '#layanan' },
                        { text: 'UX Research', url: '#layanan' },
                        { text: 'Design System', url: '#layanan' },
                        { text: 'Wireframing', url: '#proses' },
                        { text: 'Prototyping', url: '#proses' },
                        { text: 'Usability Testing', url: '#keunggulan' },
                        { text: 'Mobile App Design', url: '#harga' },
                        { text: 'Web Design', url: '#harga' },
                        { text: 'Design Consultation', url: '#konsultasi' },
                        { text: 'Portfolio UI/UX', url: '/portfolio' }
                    ],
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    <script>
        // Initialize Swiper when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                if (document.querySelector('.advantages-swiper')) {
                    new Swiper('.advantages-swiper', {
                        slidesPerView: 1,
                        spaceBetween: 30,
                        loop: true,
                        navigation: {
                            nextEl: '.swiper-button-next-custom',
                            prevEl: '.swiper-button-prev-custom',
                        },
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 2,
                            },
                            1024: {
                                slidesPerView: 3,
                            },
                        },
                    });
                }
            }, 100);
        });
    </script>
    
</div>
@endsection
