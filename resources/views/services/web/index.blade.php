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
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
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
    <meta property="og:site_name" content="Centrova Indonesia"/>
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
    <style>
        .list-check{list-style:none;margin:0;padding:0}
        .list-check li{position:relative;padding-left:32px}
        .list-check li::before{content:"";position:absolute;left:4px;top:12px;transform:translateY(-50%);width:15px;height:11px;background-repeat:no-repeat;background-size:15px 11px;background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='15' height='11' viewBox='0 0 15 11' fill='none'><path d='M13.7319 0.295798C13.639 0.20207 13.5284 0.127675 13.4065 0.0769067C13.2846 0.026138 13.1539 0 13.0219 0C12.8899 0 12.7592 0.026138 12.6373 0.0769067C12.5155 0.127675 12.4049 0.20207 12.3119 0.295798L4.86192 7.7558L1.73192 4.6158C1.6354 4.52256 1.52146 4.44925 1.3966 4.40004C1.27175 4.35084 1.13843 4.32671 1.00424 4.32903C0.870064 4.33135 0.737655 4.36008 0.614576 4.41357C0.491498 4.46706 0.380161 4.54428 0.286922 4.6408C0.193684 4.73732 0.12037 4.85126 0.0711659 4.97612C0.0219619 5.10097 -0.00216855 5.2343 0.000152918 5.36848C0.00247438 5.50266 0.0312022 5.63507 0.0846957 5.75814C0.138189 5.88122 0.215401 5.99256 0.311922 6.0858L4.15192 9.9258C4.24489 10.0195 4.35549 10.0939 4.47735 10.1447C4.59921 10.1955 4.72991 10.2216 4.86192 10.2216C4.99393 10.2216 5.12464 10.1955 5.2465 10.1447C5.36836 10.0939 5.47896 10.0195 5.57192 9.9258L13.7319 1.7658C13.8334 1.67216 13.9144 1.5585 13.9698 1.432C14.0252 1.30551 14.0539 1.1689 14.0539 1.0308C14.0539 0.892697 14.0252 0.756091 13.9698 0.629592C13.9144 0.503092 13.8334 0.389441 13.7319 0.295798Z' fill='%23128AEB'/></svg>");}
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
                <h1 class="text-[3.6rem] max-lg:text-[3rem] max-md:text-[2.6rem] leading-snug font-bold mb-6 text-slate-900">Jasa Pembuatan Website</h1>
                <p class="text-xl max-md:text-lg leading-snug text-neutral-700 mb-6">Ciptakan website profesional dengan desain yang memenuhi ekspektasi. Hasil luar biasa dan posisi terbaik di mesin pencari, selesai dalam waktu singkat.</p>
                <a href="#konsultasi" 
                aria-label="Hubungi kami untuk konsultasi website gratis"
                class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 min-h-[44px]">
                    Hubungi Sekarang
                </a>
            </div>
        </div>
    </section>

    <section id="keunggulan" class="w-full bg-neutral-100 py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{-- Heading --}}
            <div class="max-w-7xl mx-auto text-left mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Kenapa memilih jasa website Centrova?
                </h2>
            </div>

            <div class="grid grid-cols-3 max-lg:grid-cols-1 text-slate-900 gap-12">
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Kecepatan Loading Website 10x Lebih Cepat</h1>
                    <p class="text-gray-600 text-lg">Website Anda akan memuat lebih cepat daripada website pada umumnya. Kami memastikan setiap pengunjung mendapatkan informasi secara instan tanpa hambatan.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Ramah Mesin Pencari, Otomatis Menjadi yang Teratas</h1>
                    <p class="text-gray-600 text-lg">Website Anda terjamin ramah SEO (Search Engine Optimization), sehingga mampu menempati peringkat teratas di mesin pencarian seperti Google.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">100% Perlindungan Keamanan</h1>
                    <p class="text-gray-600 text-lg">Website Anda memiliki rangkaian lengkap sertifikasi SSL untuk perlindungan keamanan, anti-spam, dan firewall.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Separator --}}
    <div class="w-full h-[6px] flex"><div class="w-full bg-[#128AEB] h-full"></div><div class="w-full bg-sky-500 h-full"></div><div class="w-[30%] bg-sky-300 h-full"></div></div>

    {{-- Pilihan dan Jenis Layanan --}}
    @push('styles')
        @once
        <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></noscript>
        @endonce
    @endpush
    <section id="layanan" class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-16" x-data="pilihanLayananSection">
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
                <button @click="closeModal()" aria-label="Tutup modal" class="absolute top-5 right-5 text-[#128AEB] bg-neutral-100 rounded-full w-8 h-8 flex items-center justify-center hover:bg-neutral-200 transition"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
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
                    script.defer = true;
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

    {{-- Paket Layanan Jasa --}}
    <section id="paket" class="w-full py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{-- Heading --}}
            <div class="text-left mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Paket Layanan Jasa Pembuatan Website
                </h2>
                <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                    Pilih paket yang cocok untuk kebutuhan Anda
                </p>
            </div>

            <div class="w-full grid grid-cols-4 gap-5 p-4 bg-neutral-50 rounded-3xl max-lg:grid-cols-1">
                {{-- Paket 1: Starter --}}
                <div class="w-full px-4 py-8 rounded-3xl">
                    <h1 class="text-4xl font-medium text-slate-800 mb-4">Starter</h1>
                    <button aria-label="Pilih paket Starter" class="w-full px-6 py-2.5 text-sm font-medium text-[#0b57d0] hover:bg-gray-200 transition border border-neutral-300 rounded-2xl">Coba Sekarang</button>
                    <div class="mt-8 space-y-2">
                        <span class="font-medium">Starter menyertakan:</span>
                        <ul class="space-y-2 list-check">
                            <li>Desain Profesional</li>
                            <li>Website Full Dinamis</li>
                            <li>Responsive & User Friendly</li>
                            <li>Integrasi Medsos & WhatsApp</li>
                            <li>SEO Friendly & Triendex Google</li>
                            <li>Multi admin</li>
                            <li>Notifikasi Website</li>
                            <li>Panduan Kelola Website</li>
                            <li>Gratis Konsultasi</li>
                            <li>Lifetime support & Maintnance</li>
                        </ul>
                    </div>
                </div>

                {{-- Paket 2: Start Up --}}
                <div class="w-full px-4 py-8 border-2 border-[#128aeb] rounded-3xl">
                    <h1 class="text-4xl font-medium text-slate-800 mb-4">Start Up</h1>
                    <button aria-label="Pilih paket Start Up - Paling Populer" class="w-full px-6 py-2.5 text-sm font-medium bg-[#128aeb] hover:bg-sky-600 text-white transition hover:shadow-md rounded-2xl">Coba Sekarang</button>
                    <div class="mt-8 space-y-2">
                        <span class="font-medium">Start Up menyertakan:</span>
                        <ul class="space-y-2 list-check">
                            <li>Gratis Domain (.com) sebulan</li>
                            <li>Cloud Hosting 35 GB SSD</li>
                            <li>Desain Profesional</li>
                            <li>Website Full Dinamis</li>
                            <li>Responsive & User Friendly</li>
                            <li>Integrasi Medsos & WhatsApp</li>
                            <li>SEO Friendly & Triendex Google</li>
                            <li>Full Akses Kepemilikan Hosting & Domain</li>
                            <li>Unlimited Jumlah Halaman</li>
                            <li>Panduan Kelola Website</li>
                            <li>Gratis Konsultasi</li>
                            <li>Lifetime support & Maintnance</li>
                        </ul>
                    </div>
                </div>

                {{-- Paket 3: Professional --}}
                <div class="w-full px-4 py-8 rounded-3xl">
                    <h1 class="text-4xl font-medium text-slate-800 mb-4">Professional</h1>
                    <button aria-label="Pilih paket Professional" class="w-full px-6 py-2.5 text-sm font-medium text-[#0b57d0] hover:bg-gray-200 transition border border-neutral-300 rounded-2xl">Coba Sekarang</button>
                    <div class="mt-8 space-y-2">
                        <span class="font-medium">Professional menyertakan:</span>
                        <ul class="space-y-2 list-check">
                            <li>Gratis Domain (.com) sebulan</li>
                            <li>Cloud Hosting 50 GB SSD</li>
                            <li>Desain Premium</li>
                            <li>Website Full Dinamis</li>
                            <li>Responsive & User Friendly</li>
                            <li>Integrasi Medsos & WhatsApp</li>
                            <li>SEO Friendly & Triendex Google</li>
                            <li>Full Akses Kepemilikan Hosting & Domain</li>
                            <li>Unlimited Jumlah Halaman</li>
                            <li>Multi admin & Role Management</li>
                            <li>Email Profesional</li>
                            <li>Panduan Kelola Website</li>
                            <li>Gratis Konsultasi</li>
                            <li>Lifetime support & Maintnance</li>
                        </ul>
                    </div>
                </div>

                {{-- Paket 4: Corporate --}}
                <div class="w-full px-4 py-8 rounded-3xl">
                    <h1 class="text-4xl font-medium text-slate-800 mb-4">Corporate</h1>
                    <button aria-label="Pilih paket Corporate" class="w-full px-6 py-2.5 text-sm font-medium text-[#0b57d0] hover:bg-gray-200 transition border border-neutral-300 rounded-2xl">Coba Sekarang</button>
                    <div class="mt-8 space-y-2">
                        <span class="font-medium">Corporate menyertakan:</span>
                        <ul class="space-y-2 list-check">
                            <li>Gratis Domain (.com) sebulan</li>
                            <li>Cloud Hosting 100 GB SSD</li>
                            <li>Desain Premium Custom</li>
                            <li>Website Full Dinamis</li>
                            <li>Responsive & User Friendly</li>
                            <li>Integrasi Medsos & WhatsApp</li>
                            <li>SEO Friendly & Triendex Google</li>
                            <li>Full Akses Kepemilikan Hosting & Domain</li>
                            <li>Unlimited Jumlah Halaman</li>
                            <li>Multi admin & Advanced Role Management</li>
                            <li>Email Profesional (10 akun)</li>
                            <li>SSL Certificate Premium</li>
                            <li>Dedicated Support</li>
                            <li>Panduan Kelola Website</li>
                            <li>Gratis Konsultasi</li>
                            <li>Lifetime support & Maintnance</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Penawaran Harga Add-ons --}}
    <section class="w-full py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{-- Heading --}}
            <div class="text-left mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Lihat Penawaran Add-On dari Centrova
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-8">
                {{-- Domain Pricing Table --}}
                <div class="w-full">
                    <h2 class="text-2xl font-bold text-neutral-900 mb-6">Domain</h2>
                    <div class="overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-neutral-200">
                                    <th class="text-left py-2 px-6 font-semibold text-slate-700">Add-On</th>
                                    <th class="text-right py-2 px-4 font-semibold text-slate-700">Tahunan</th>
                                    <th class="text-right py-2 px-6 font-semibold text-slate-700">Bulanan</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-800">
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.com</td>
                                    <td class="text-right py-1.5 px-4">Rp297.000</td>
                                    <td class="text-right py-1.5 px-6">Rp24.750</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.net</td>
                                    <td class="text-right py-1.5 px-4">Rp308.675</td>
                                    <td class="text-right py-1.5 px-6">Rp25.723</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.org</td>
                                    <td class="text-right py-1.5 px-4">Rp272.000</td>
                                    <td class="text-right py-1.5 px-6">Rp22.667</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.co</td>
                                    <td class="text-right py-1.5 px-4">Rp566.380</td>
                                    <td class="text-right py-1.5 px-6">Rp47.198</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.dev</td>
                                    <td class="text-right py-1.5 px-4">Rp318.175</td>
                                    <td class="text-right py-1.5 px-6">Rp26.515</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.app</td>
                                    <td class="text-right py-1.5 px-4">Rp456.550</td>
                                    <td class="text-right py-1.5 px-6">Rp38.879</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.io</td>
                                    <td class="text-right py-1.5 px-4">Rp1.022.000</td>
                                    <td class="text-right py-1.5 px-6">Rp85.167</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.tech</td>
                                    <td class="text-right py-1.5 px-4">Rp1.023.175</td>
                                    <td class="text-right py-1.5 px-6">Rp85.265</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.online</td>
                                    <td class="text-right py-1.5 px-4">Rp514.000</td>
                                    <td class="text-right py-1.5 px-6">Rp42.833</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.store</td>
                                    <td class="text-right py-1.5 px-4">Rp641.350</td>
                                    <td class="text-right py-1.5 px-6">Rp53.446</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.xyz</td>
                                    <td class="text-right py-1.5 px-4">Rp324.675</td>
                                    <td class="text-right py-1.5 px-6">Rp27.056</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.id</td>
                                    <td class="text-right py-1.5 px-4">Rp341.100</td>
                                    <td class="text-right py-1.5 px-6">Rp28.425</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">.co.id</td>
                                    <td class="text-right py-1.5 px-4">Rp383.400</td>
                                    <td class="text-right py-1.5 px-6">Rp31.950</td>
                                </tr>
                                <tr class="transition">
                                    <td class="py-1.5 px-6">.web.id</td>
                                    <td class="text-right py-1.5 px-4">Rp65.900</td>
                                    <td class="text-right py-1.5 px-6">Rp5.492</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Hosting Pricing Table --}}
                <div class="w-full">
                    <h2 class="text-2xl font-bold text-neutral-900 mb-6">Hosting</h2>
                    <div class="overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-neutral-200">
                                    <th class="text-left py-2 px-6 font-semibold text-slate-700">Add-On</th>
                                    <th class="text-right py-2 px-4 font-semibold text-slate-700">Tahunan</th>
                                    <th class="text-right py-2 px-6 font-semibold text-slate-700">Bulanan</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-800">
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">Hosting 2GB</td>
                                    <td class="text-right py-1.5 px-4">Rp420.000</td>
                                    <td class="text-right py-1.5 px-6">Rp35.000</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">Hosting 5GB</td>
                                    <td class="text-right py-1.5 px-4">Rp660.000</td>
                                    <td class="text-right py-1.5 px-6">Rp55.000</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">Hosting 10GB</td>
                                    <td class="text-right py-1.5 px-4">Rp1.080.000</td>
                                    <td class="text-right py-1.5 px-6">Rp90.000</td>
                                </tr>
                                <tr class="border-b border-neutral-200 transition">
                                    <td class="py-1.5 px-6">Cloud VPS 2GB RAM</td>
                                    <td class="text-right py-1.5 px-4">Rp1.800.000</td>
                                    <td class="text-right py-1.5 px-6">Rp150.000</td>
                                </tr>
                                <tr class="transition">
                                    <td class="py-1.5 px-6">Cloud VPS 4GB RAM</td>
                                    <td class="text-right py-1.5 px-4">Rp3.000.000</td>
                                    <td class="text-right py-1.5 px-6">Rp250.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Proses Pembuatan Website --}}
    <section class="w-full bg-white py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{-- Heading --}}
            <div class="text-left mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Proses Pembuatan Website yang Terstruktur
                </h2>
                <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                    Kami mengikuti metode yang jelas dan terukur untuk memastikan hasil yang maksimal
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="flex flex-col">
                    <div class="mb-4">
                        <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB] text-white text-xl font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Konsultasi & Analisis</h3>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Memahami kebutuhan bisnis Anda secara mendalam, menganalisis target audience, kompetitor, dan menentukan strategi digital yang tepat untuk mencapai tujuan.
                    </p>
                </div>

                <div class="flex flex-col">
                    <div class="mb-4">
                        <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB] text-white text-xl font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Desain & Prototyping</h3>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Membuat wireframe dan mockup visual yang mencerminkan identitas brand Anda. Kami akan melakukan iterasi desain hingga Anda benar-benar puas dengan tampilan website.
                    </p>
                </div>

                <div class="flex flex-col">
                    <div class="mb-4">
                        <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB] text-white text-xl font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Development & Testing</h3>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Mengembangkan website dengan teknologi terkini dan best practices. Setiap fitur diuji secara menyeluruh untuk memastikan performa optimal dan bebas dari bug.
                    </p>
                </div>

                <div class="flex flex-col">
                    <div class="mb-4">
                        <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB] text-white text-xl font-bold">4</span>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Launch & Support</h3>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Meluncurkan website secara live dengan konfigurasi server yang optimal. Kami memberikan training dan dokumentasi lengkap, serta support berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Separator --}}
    <div class="w-full h-[6px] flex"><div class="w-full bg-[#128AEB] h-full"></div><div class="w-full bg-sky-500 h-full"></div><div class="w-[30%] bg-sky-300 h-full"></div></div>

    {{-- Teknologi yang Kami Gunakan --}}
    <section class="w-full bg-neutral-100 py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            {{-- Heading --}}
            <div class="text-left mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                    Teknologi Modern untuk Hasil yang Maksimal
                </h2>
                <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                    Kami menggunakan stack teknologi terkini untuk membangun website yang cepat, aman, dan scalable
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 border border-neutral-200 hover:shadow-md transition-shadow">
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Frontend Development</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">React & Next.js</span>
                            <span class="text-sm text-slate-500">UI Framework</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">Tailwind CSS</span>
                            <span class="text-sm text-slate-500">Styling</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">Alpine.js</span>
                            <span class="text-sm text-slate-500">Interactivity</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-slate-700 font-medium">TypeScript</span>
                            <span class="text-sm text-slate-500">Type Safety</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-neutral-200 hover:shadow-md transition-shadow">
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">Backend Development</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">Laravel</span>
                            <span class="text-sm text-slate-500">PHP Framework</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">Node.js</span>
                            <span class="text-sm text-slate-500">Runtime</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">MySQL / PostgreSQL</span>
                            <span class="text-sm text-slate-500">Database</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-slate-700 font-medium">Redis</span>
                            <span class="text-sm text-slate-500">Caching</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-neutral-200 hover:shadow-md transition-shadow">
                    <h3 class="text-xl font-semibold text-slate-900 mb-4">DevOps & Infrastructure</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">AWS / DigitalOcean</span>
                            <span class="text-sm text-slate-500">Cloud Hosting</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">Docker</span>
                            <span class="text-sm text-slate-500">Containerization</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-neutral-100">
                            <span class="text-slate-700 font-medium">GitHub Actions</span>
                            <span class="text-sm text-slate-500">CI/CD</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-slate-700 font-medium">Cloudflare</span>
                            <span class="text-sm text-slate-500">CDN & Security</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 p-6 bg-sky-50 rounded-2xl border border-sky-100">
                <p class="text-slate-700 text-base leading-relaxed">
                    <span class="font-semibold text-slate-900">Kenapa teknologi penting?</span> Pemilihan stack teknologi yang tepat memastikan website Anda memiliki performa yang cepat, keamanan yang solid, dan kemudahan maintenance di masa depan. Kami selalu mengikuti perkembangan teknologi terkini untuk memberikan solusi terbaik.
                </p>
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
            <button onclick="window.open('{{ route('support.web.consult') }}', '_blank')" aria-label="Hubungi kami untuk konsultasi gratis" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition flex items-center justify-center mx-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
                :aria-expanded="openFaq === index"
                :aria-label="'Toggle FAQ: ' + faq.question"
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
