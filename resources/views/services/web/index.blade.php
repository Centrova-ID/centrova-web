{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Solusi Website Profesional untuk Bisnis Anda - Centrova')

{{-- Navbar --}}
@section('navbar')
    {{-- Navbar --}}
    @include('partials.navbar.services')
    {{-- Sub Navbar --}}
    @include('partials.navbar.subnavbar.services', [
        'servicesLinkText' => 'Web Development',
        'servicesLinkUrl' => route('services.web.index'),
        'menuItems' => [
            ['text' => 'Layanan', 'url' => url('#layanan')],
            ['text' => 'Keunggulan', 'url' => url('#keunggulan')],
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
    <link rel="dns-prefetch" href="https://jasterweb.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://unpkg.com">
    
    {{-- Preload critical images --}}
    <link rel="preload" href="https://jasterweb.com/wp-content/uploads/2024/07/jasa-website.png" as="image">
    {{-- Preload critical data --}}
    <link rel="preload" href="/data/services-data.json" as="fetch" crossorigin="anonymous">
    
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta property="og:description" content="Centrova menyediakan jasa pembuatan website profesional, modern, dan responsif untuk bisnis Anda. Dapatkan website berkualitas, desain elegan, performa optimal, dan support jangka panjang!"/>
    <meta name="twitter:site" content="@centrovaid"/>
    <meta property="og:title" content="Jasa Pembuatan Website Profesional & Modern | Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:site_name" content="Centrova"/>
    <meta property="og:image" content="https://centrova.id/assets/image/services/web-development/og-image.jpg"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://centrova.id/services/web"/>
    <meta name="description" content="Jasa pembuatan website profesional, modern, dan responsif untuk bisnis, UMKM, toko online, edukasi, dan kebutuhan lainnya. Gratis konsultasi dan harga terjangkau!"/>
    <link rel="canonical" href="https://centrova.id/services/web"/>
@endsection

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
    {{-- <section class="w-full bg-white py-32 max-md:py-16">
        <div class="w-full max-w-3xl mx-auto pt-24 md:pt-38 lg:pt-32 px-4">
            <div 
                class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center text-center" 
            >
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold text-slate-900 mb-6 sm:mb-8 md:mb-10 leading-tight">
                    Jasa Pembuatan Website <br class="block sm:hidden">
                    <span class="text-[#128AEB]">Profesional & Modern</span>
                </h1>
                <p class="text-sm sm:text-base md:text-lg max-w-3xl text-slate-600">
                    Kami menyediakan layanan pembuatan website berkualitas tinggi dengan desain elegan, performa optimal, dan siap digunakan untuk berbagai kebutuhan—mulai dari profil perusahaan hingga sistem berbasis web.
                </p>
            </div>
        </div>
    </section> --}}

    {{-- Hero Section --}}
    <section class="w-full bg-white py-16 pt-32">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-3xl">
                <h1 class="text-[3.6rem] max-lg:text-[3rem] max-md:text-[2.6rem] leading-snug font-bold mb-6 bg-gradient-to-r from-blue-600 to-[#128aeb] bg-clip-text text-transparent">Jasa Pembuatan Website</h1>
                <p class="text-xl max-md:text-lg leading-snug text-neutral-700 mb-6">Ciptakan website profesional dengan desain yang memenuhi ekspektasi. Hasil luar biasa dan posisi terbaik di mesin pencari, selesai dalam waktu singkat, hanya 3 hari kerja.</p>
                <a href="#" 
                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 min-h-[44px]">
                    Pelajari selengkapnya
                </a>
            </div>
        </div>
    </section>

    <section class="w-full bg-neutral-100 py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{-- Heading --}}
            <div class="max-w-7xl mx-auto text-left mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Kenapa memilih jasa website Centrova?
                </h2>
            </div>

            <div class="grid grid-cols-3 max-md:grid-cols-1 max-lg:grid-cols-3 gap-8">
                <div class="flex flex-col items-start">
                    <h1 class="font-bold text-2xl mb-1">Kecepatan Loading Website 10x Lebih Cepat</h1>
                    <p>Jalankan website Anda pada disk SSD! Website Anda akan memuat lebih cepat daripada website pada umumnya.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-bold text-2xl mb-1">Ramah Mesin Pencari</h1>
                    <p>Website Anda terjamin ramah SEO (Search Engine Optimization), sehingga mampu menempati peringkat teratas di mesin pencarian seperti Google.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-bold text-2xl mb-1">100% Perlindungan Kemanan</h1>
                    <p>Website Anda memiliki rangkaian lengkap sertifikasi SSL untuk perlindungan keamanan, anti-spam, firewall, dan backup harian.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Pilihan dan Jenis Layanan --}}
    @push('styles')
        @once
        <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></noscript>
        @endonce
    @endpush
    <section id="pilihan-layanan" class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-16" x-data="pilihanLayananSection">
        {{-- Heading --}}
        <div class="text-left mb-8">
            <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                Pilihan & Jenis Layanan Website
            </h2>
            <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                Kami menyediakan berbagai jenis layanan website sesuai kebutuhan
            </p>
        </div>
        
        {{-- Service Cards - Mobile: Swiper, Desktop: Grid --}}
        <div class="w-full max-w-screen-xl mx-auto">
            {{-- Mobile Swiper --}}
            <div class="swiper services-swiper block lg:hidden">
                <div class="swiper-wrapper">
                    <template x-for="(item, idx) in services" :key="idx">
                        <div class="swiper-slide py-3">
                            <div
                            class="group relative cursor-pointer flex flex-col rounded-2xl justify-between overflow-hidden border border-neutral-200 shadow hover:shadow-md bg-white/80 min-h-[500px] max-h-[500px] lazy-bg-services"
                            :data-bg="item.image"
                            @click="handleClick(idx)">
                                <div class="relative z-10 flex flex-col h-full px-7 py-6 justify-between">
                                    <span class="text-2xl font-semibold mb-1 transition text-slate-900 text-left w-full mt-2" x-text="item.title"></span>
                                    <span class="text-lg font-normal transition text-slate-800 text-left w-full" x-text="item.short"></span>
                                </div>
                                <template x-if="item.consultation">
                                    <div class="w-full bg-white/90 backdrop-blur-xl px-7 py-4 flex justify-between items-center">
                                        <div>
                                            <span x-text="item.consultation.name" class="text-lg font-medium text-slate-900"></span><br>
                                            <span x-text="item.consultation.role" class="text-slate-600"></span>
                                        </div>
                                        <div class="w-12 h-12 flex-shrink-0 flex justify-center items-center">
                                            <img src="{{ asset('assets/icons/ui/services/web/support.svg') }}" 
                                                 class="h-[28px]"
                                                 loading="lazy"
                                                 decoding="async"
                                                 alt="Support icon">
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Desktop Grid --}}
            <div class="hidden lg:grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="(item, idx) in services" :key="idx">
                    <div class="py-3">
                        <div
                        class="group relative cursor-pointer flex flex-col rounded-2xl justify-between overflow-hidden border border-neutral-200 shadow hover:shadow-md bg-white/80 min-h-[500px] max-h-[500px] lazy-bg-services"
                        :data-bg="item.image"
                        @click="handleClick(idx)">
                            <div class="relative z-10 flex flex-col h-full px-7 py-6 justify-between">
                                <span class="text-2xl font-semibold mb-1 transition text-slate-900 text-left w-full mt-2" x-text="item.title"></span>
                                <span class="text-lg font-normal transition text-slate-800 text-left w-full" x-text="item.short"></span>
                            </div>
                            <template x-if="item.consultation">
                                <div class="w-full bg-white/90 backdrop-blur-xl px-7 py-4 flex justify-between items-center">
                                    <div>
                                        <span x-text="item.consultation.name" class="text-lg font-medium text-slate-900"></span><br>
                                        <span x-text="item.consultation.role" class="text-slate-600"></span>
                                    </div>
                                    <div class="w-12 h-12 flex-shrink-0 flex justify-center items-center">
                                        <img src="{{ asset('assets/icons/ui/services/web/support.svg') }}" 
                                             class="h-[28px]"
                                             loading="lazy"
                                             decoding="async"
                                             alt="Support icon">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
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
            const loadSwiperServices = () => {
                if (typeof Swiper === 'undefined') {
                    const script = document.createElement('script');
                    script.src = 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js';
                    script.async = true;
                    script.onload = initSwiperServicesComponents;
                    document.head.appendChild(script);
                } else {
                    initSwiperServicesComponents();
                }
            };

            // Load Swiper when page is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', loadSwiperServices);
            } else {
                loadSwiperServices();
            }

            // Lazy load background images for services section
            const lazyBgServicesObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const bgUrl = element.dataset.bg;
                        if (bgUrl) {
                            element.style.backgroundImage = `url(${bgUrl})`;
                            element.style.backgroundSize = 'cover';
                            element.style.backgroundPosition = 'center';
                            element.classList.remove('lazy-bg-services');
                            lazyBgServicesObserver.unobserve(element);
                        }
                    }
                });
            }, {
                rootMargin: '50px 0px'
            });

            // Observe lazy background elements when Alpine is ready
            document.addEventListener('alpine:initialized', () => {
                setTimeout(() => {
                    document.querySelectorAll('.lazy-bg-services').forEach(el => {
                        lazyBgServicesObserver.observe(el);
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
                Alpine.data('pilihanLayananSection', () => ({
                    services: [
                        {
                            title: 'Company Profile',
                            short: 'Pembuatan website company profile untuk menampilkan profil perusahaan atau bisnis secara mendetail.',
                            title_modal: 'Website Company Profile Profesional',
                            desc: 'Tampilkan profil perusahaan Anda secara profesional dengan website company profile yang elegan dan informatif.<br><br>Website ini dilengkapi dengan halaman tentang perusahaan, layanan, portofolio, tim, dan kontak. Desain responsif yang optimal di semua perangkat, SEO-friendly untuk meningkatkan visibilitas online, dan mudah dikelola melalui admin panel.<br><br>Cocok untuk perusahaan, konsultan, startup, dan bisnis yang ingin membangun kredibilitas dan kepercayaan klien melalui kehadiran digital yang kuat.<br><br><a href="{{ route('services.web-company-profile') }}" class="inline-flex items-center text-[#128AEB] hover:text-[#0f75c6] font-medium transition-colors duration-200">Pelajari selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>',
                            image: '/assets/image/services/web-development/6.jpg'
                        },
                        {
                            title: 'E-commerce & Toko Online',
                            short: 'Pembuatan website dengan berbagai fitur untuk mengelola transaksi & penjualan secara online.',
                            title_modal: 'Toko Online & E-commerce Terintegrasi',
                            desc: 'Bangun toko online yang powerful dengan fitur lengkap untuk mengelola bisnis e-commerce Anda.<br><br>Dilengkapi dengan katalog produk, keranjang belanja, sistem pembayaran (transfer bank, e-wallet, COD), manajemen stok, laporan penjualan, dan notifikasi otomatis. Interface admin yang user-friendly untuk mengelola pesanan, produk, dan pelanggan.<br><br>Terintegrasi dengan ekspedisi untuk tracking pengiriman, sistem review produk, dan optimasi SEO untuk meningkatkan penjualan online. Ideal untuk UMKM, retailer, dan bisnis yang ingin go digital.',
                            image: '/assets/image/services/web-development/7.jpg'
                        },
                        {
                            title: 'Custom Web',
                            short: 'Kebutuhan website yang lebih spesifik dan kompleks? kami juga dapat membantu Anda mewujudkannya.',
                            title_modal: 'Aplikasi Web Custom Sesuai Kebutuhan',
                            desc: 'Solusi aplikasi web yang dikembangkan khusus sesuai dengan kebutuhan unik bisnis Anda.<br><br>Mulai dari sistem manajemen internal, portal karyawan, sistem booking, aplikasi CRM, hingga platform marketplace khusus. Dikembangkan dengan teknologi modern, database yang robust, dan keamanan tingkat enterprise.<br><br>Fitur dapat disesuaikan sepenuhnya - multi-user access, dashboard analytics, integrasi API eksternal, dan skalabilitas tinggi. Cocok untuk perusahaan besar, institusi, atau bisnis dengan workflow khusus yang membutuhkan solusi digital terintegrasi.',
                            image: '/assets/image/services/web-development/8.jpg'
                        }
                    ],
                    showModal: false,
                    modalIndex: null,
                    modalTitle: '',
                    modalDesc: '',
                    handleClick(idx) {
                        const item = this.services[idx];

                        if (item.route && item.route.url) {
                            const url = item.route.url;
                            const winSize = item.route.window_size === 'window' ? 'width=375,height=667' : '';

                            if (item.route.target === '_blank') {
                                window.open(url, '_blank', winSize);
                            } else {
                                window.location.href = url;
                            }

                        } else if (item.link && item.link.url) {
                            const url = item.link.url;
                            const winSize = item.link.window_size === 'window' ? 'width=375,height=667' : '';

                            if (item.link.target === '_blank') {
                                window.open(url, '_blank', winSize);
                            } else {
                                window.location.href = url;
                            }

                        } else {
                            this.openModal(idx);
                        }
                    },
                    openModal(idx) {
                        this.modalIndex = idx;
                        const item = this.services[idx];
                        this.modalTitle = item.title_modal ?? item.title;
                        this.modalDesc = item.desc;
                        this.showModal = true;
                        document.body.style.overflow = 'hidden';
                    },
                    closeModal() {
                        this.showModal = false;
                        document.body.style.overflow = 'auto';

                        {{-- Tunda reset konten modal setelah animasi selesai (misal: 300ms) --}}
                        setTimeout(() => {
                            this.modalIndex = null;
                            this.modalTitle = '';
                            this.modalDesc = '';
                        }, 300);
                    },
                    init() {
                        {{-- Pastikan modal tidak aktif saat init --}}
                        this.showModal = false;
                        this.modalIndex = null;
                        this.modalTitle = '';
                        this.modalDesc = '';

                        {{-- Initialize Swiper for mobile --}}
                        this.$nextTick(() => {
                            if (this.swiper) this.swiper.destroy();
                            this.swiper = new Swiper('.services-swiper', {
                                slidesPerView: 1,
                                spaceBetween: 24,
                                loop: true,
                                speed: 600,
                                grabCursor: true,
                                navigation: {
                                    nextEl: '.swiper-button-next-services',
                                    prevEl: '.swiper-button-prev-services'
                                },
                                breakpoints: {
                                    640: { slidesPerView: 1.2 },
                                    768: { slidesPerView: 2 }
                                }
                            });
                        });
                    },
                    swiper: null
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Kenapa Wajib Punya Website --}}
    <section class="w-full py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{-- Heading --}}
            <div class="text-left mb-8">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Kenapa Perusahaan Wajib Punya Website?
                </h2>
                <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                    Jangan biarkan kompetitor unggul! Dapatkan website profesional yang akan membuat perusahaan tampil lebih credible dan menarik lebih banyak customer
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12" role="list" aria-label="Perbandingan dampak memiliki dan tidak memiliki website">
                <!-- Problem Card -->
                <div class="bg-red-50 p-8 rounded-2xl  relative overflow-hidden group" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                    <div class="relative z-10 md:p-8">
                        <p class="text-red-600 font-medium uppercase text-base mb-4">Tanpa Website</p>
                        <h3 class="text-4xl text-red-950 font-bold mb-6">Bisnis Anda Kehilangan Banyak Peluang!</h3>
                        
                        <div class="space-y-4 mt-8">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-950">Customer tidak bisa menemukan bisnis Anda secara online</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-950">Kehilangan kepercayaan karena terlihat kurang profesional</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-950">Sulit bersaing dengan kompetitor yang sudah online</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-red-950">Terbatasnya jangkauan pemasaran dan penjualan</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                </div>

                <!-- Solution Card -->
                <div class="bg-[#128AEB]/10 p-8 rounded-2xl text-white relative overflow-hidden group" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-500 font-medium uppercase text-base mb-4">Dengan Website</p>
                        <h3 class="text-4xl text-slate-900 font-bold mb-6">Bisnis Anda Akan Berkembang Pesat!</h3>
                        
                        <div class="space-y-4 mt-8">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-slate-900">Tampil profesional dan terpercaya di mata customer</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-slate-900">Mudah ditemukan customer melalui Search Engine</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-slate-900">Jangkauan pasar lebih luas, 24 jam nonstop</p>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-slate-900">Meningkatkan penjualan dan revenue secara signifikan</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kenapa Wajib Punya Website --}}
    <section class="w-full py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{-- Heading --}}
            <div class="text-left mb-8">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Kenapa Perusahaan Wajib Punya Website?
                </h2>
                <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                    Jangan biarkan kompetitor unggul! Dapatkan website profesional yang akan membuat perusahaan tampil lebih credible dan menarik lebih banyak customer
                </p>
            </div>

            <!-- Easy Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16" role="list" aria-label="Kemudahan layanan Centrova">
                <template x-for="(feature, index) in easyFeatures" :key="index">
                    <div class="bg-[#128AEB]/5 p-8 rounded-[32px] relative overflow-hidden min-h-[500px]" 
                         data-aos="fade-up" 
                         data-aos-duration="700" 
                         :data-aos-delay="index * 100">
                        <div class="relative z-10 md:p-8">
                            <h3 class="text-4xl font-bold text-gray-900 mb-6" x-text="feature.title"></h3>
                            <p class="text-slate-800 leading-relaxed mb-8" x-text="feature.description"></p>
                            
                            <!-- Easy Steps -->
                            <div class="space-y-4 mt-8">
                                <template x-for="step in feature.steps" :key="step">
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-[#128AEB] mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-slate-900" x-text="step"></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#128AEB] bg-opacity-5 rounded-full"></div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    {{-- CTA Konsultasi --}}
    <div id="konsultasi" class="text-center py-32 max-md:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-slate-900 mb-4">
                Coba Gratis Konsultasi Website Anda
            </h3>
            <p class="text-slate-600 text-base sm:text-lg mb-6">
                Lihat kenapa puluhan pelaku usaha mempercayakan pembuatan website mereka kepada Centrova.
            </p>
            <button onclick="window.open('{{ route('support.web.consult') }}', '_blank')" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition flex items-center justify-center mx-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Hubungi Kami
            </button>
        </div>
    </div>

    {{-- FAQ Section --}}
    <section class="py-32 max-md:py-16 bg-neutral-50" x-data="faqSection">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-slate-900 mb-4">
              Pertanyaan yang Sering Diajukan
          </h3>
        </div>

        <div>
          <template x-for="(faq, index) in faqs" :key="index">
            <div class="py-0 border-b border-neutral-300 focus-within:border-b-2 focus-within:border-[#128AEB] transition">
              <!-- Button -->
              <button 
                @click="toggleFaq(index)"
                class="w-full py-4 text-left flex items-center justify-between focus:z-20 my-0.5 transition-colors gap-2"
              >
                <span class="font-semibold text-sky-700 text-xl sm:text-2xl leading-snug sm:leading-normal flex-wrap sm:flex-nowrap max-w-[80%]" x-text="faq.question"></span>
                <svg 
                  class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0"
                  :class="{ 'rotate-180': openFaq === index }"
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>

              <!-- Answer -->
              <div
                x-show="openFaq === index"
                x-transition:enter="transition-[max-height] duration-[600ms] ease-in"
                x-transition:leave="transition-[max-height] duration-[600ms] ease-out"
                x-transition:enter-start="max-h-0"
                x-transition:enter-end="max-h-[300px]"
                x-transition:leave-start="max-h-[300px]"
                x-transition:leave-end="max-h-0"
                class="overflow-hidden will-change-transform will-change-opacity will-change-scroll-position"
              >
                <div class="pb-6 pt-2 text-slate-700 text-base sm:text-lg leading-relaxed max-w-full sm:max-w-[90%]" x-text="faq.answer"></div>
              </div>
            </div>
          </template>
        </div>
      </div>
      @push('scripts')
      @once
      <script>
          document.addEventListener('alpine:init', () => {
              Alpine.data('faqSection', () => ({
                  openFaq: null,
                  faqs: [
                      {
                          question: 'Berapa lama waktu pengerjaan website?',
                          answer: 'Waktu pengerjaan disesuaikan dengan kompleksitas project: landing page / website personal sekitar 3 hari hingga 1 minggu, website corporate 1–2 minggu, dan e-commerce atau marketplace 4–8 minggu. Kami berkomitmen untuk menyampaikan timeline secara jelas di awal dan menjaga komunikasi terbuka selama proses berlangsung, agar setiap project selesai tepat waktu dengan kualitas terbaik.'
                      },
                      {
                          question: 'Apakah website yang dibuat mobile-friendly?',
                          answer: 'Ya, semua website yang kami buat sudah responsive dan mobile-friendly. Kami memastikan tampilan dan functionality website optimal di semua device, mulai dari smartphone, tablet, hingga desktop.'
                      },
                      {
                          question: 'Apakah termasuk hosting dan domain?',
                          answer: 'Paket kami sudah termasuk layanan hosting dengan performa andal untuk mendukung website Anda. Untuk domain, Anda dapat menggunakan domain yang sudah dimiliki atau kami bantu proses pembeliannya melalui registrar terpercaya.'
                      },
                      {
                          question: 'Bagaimana sistem pembayaran?',
                          answer: 'Sistem pembayaran dibagi dalam beberapa termin: 30% di awal, 40% saat desain disetujui, dan 30% setelah website selesai. Invoice akan diterbitkan sesuai setiap tahap pembayaran. Kami menerima pembayaran melalui transfer bank, e-wallet, dan metode digital lainnya.'
                      },
                      {
                          question: 'Apakah bisa request revisi?',
                          answer: 'Ya, kami memberikan kesempatan revisi sesuai scope project yang disepakati. Biasanya 2-3 kali revisi untuk desain dan 1-2 kali revisi untuk functionality. Revisi di luar scope akan dikenakan biaya tambahan.'
                      },
                      {
                          question: 'Apakah mendapat source code website?',
                          answer: 'Ya, setelah project selesai dan pelunasan, Anda akan mendapat seluruh source code website beserta dokumentasinya. Anda memiliki full control atas website yang telah dibuat oleh kami.'
                      },
                      {
                          question: 'Bagaimana dengan maintenance setelah website jadi?',
                          answer: 'Kami menyediakan layanan maintenance dengan berbagai paket. Mulai dari basic maintenance (bug fixes, security updates) hingga comprehensive maintenance (feature development, performance optimization, content updates).'
                      },
                      {
                          question: 'Apakah website sudah SEO-ready?',
                          answer: 'Ya, semua website yang kami buat sudah dioptimasi untuk SEO dasar, termasuk meta tags, site structure, loading speed, dan mobile optimization. Untuk advanced SEO, tersedia sebagai layanan tambahan.'
                      }
                  ],
                  toggleFaq(index) {
                      this.openFaq = this.openFaq === index ? null : index;
                  },
                  init() {
                      {{-- Pastikan tidak ada FAQ yang terbuka saat init --}}
                      this.openFaq = null;
                  }
              }));
          });
      </script>
      @endonce
      @endpush
    </section>

    {{-- Quick Links --}}
    <section class="w-full pt-10 bg-neutral-100" x-data="quickLinksSection">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <h1 class="font-semibold text-2xl mb-4">Quick Links</h1>
            <div class="flex justify-start gap-3 items-center w-full border-b border-neutral-300 pb-10 flex-wrap">
                <template x-for="(link, index) in quickLinks" :key="index">
                    <a 
                        :href="link.url" 
                        :target="link.target || '_self'"
                        class="px-4 py-1 font-normal border border-neutral-700 rounded-full hover:bg-neutral-700 hover:text-white hover:underline transition-colors duration-200"
                        x-text="link.text">
                    </a>
                </template>
            </div>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('quickLinksSection', () => ({
                    quickLinks: [
                        {
                            text: "Konsultasi Gratis",
                            url: "{{ route('support.web.consult') }}",
                            target: "_blank"
                        },
                        {
                            text: "Pusat Bantuan",
                            url: "{{ route('support.services.home') }}",
                            target: "_self"
                        },
                        {
                            text: "Pembatalan Layanan",
                            url: "{{ route('services.cancellation.index') }}",
                            target: "_self"
                        },
                    ],
                }));
            });
        </script>
        @endonce
        @endpush
    </section>
    
@endsection
