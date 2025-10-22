@extends('partials.layouts.main')

@section('title', 'Layanan Jasa Pengembangan Perangkat Lunak - Centrova')

<meta charset=utf-8>
<meta name=description content="Centrova menyediakan aplikasi bisnis.">
<meta name=viewport content="width=device-width, initial-scale=1">
<meta name="keywords" content="aplikasi bisnis, aplikasi bisnis no. 1">

{{-- Navbar --}}
@section('navbar')
    {{-- Navbar --}}
    @include('partials.navbar.services')
@endsection

{{-- Style CSS --}}
@section('style-css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endsection

@section('content')
<div class="bg-white overflow-x-hidden">
    {{-- Hero Section --}}
    <div class="bg-neutral-100 relative z-0 overflow-hidden py-10 flex items-center">
        <div class="absolute inset-0">
            <img src="{{ asset('/assets/random/banner.jpg') }}"
                srcset="{{ asset('/assets/random/banner.jpg') }}"
                sizes="(max-width:768px) 600px, 1200px"
                width="1200" height="800"
                loading="lazy"
                alt="Digital Business Solutions"
                class="w-full h-full object-cover object-top opacity-70 max-md:opacity-30 max-md:object-right" />
        </div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 flex justify-center items-center z-10">
            <div class="w-full text-left max-md:text-center text-slate-900">
                <h1 class="text-5xl leading-[54px] max-w-2xl font-medium max-md:text-3xl max-md:leading-snug mb-6">Kami menawarkan solusi terbaik untuk bisnis Anda</h1>
                <p class="text-xl text-neutral-700">Layanan pengembangan perangkat lunak yang efisien dan profesional.</p>
            </div>

            <div class="mr-10 flex-shrink-0">
               <div class="flex items-center max-md:hidden gap-x-2 flex-shrink-0">
                   <img src="{{ asset('assets/image/customer-profile/frisca.png') }}" srcset="{{ asset('assets/image/customer-profile/frisca.png') }}" class="h-[32px] aspect-square rounded-full">
                   <div class="flex flex-col items-center">
                       <span class="font-medium text-base -mb-1">Butuh Bantuan Kami?</span>
                       <button type="button" class="hover:underline text-[15px] text-blue-600 text-left w-full">Hubungi Spesialis</button>
                   </div>
               </div> 
            </div>
        </div>
    </div>

    <p class="text-lg text-neutral-600 text-center w-full max-w-3xl mx-auto px-8 mt-32">Our mission to make information universally accessible and useful starts with making our products safe. Explore our Transparency Center to understand the policies that keep users safe from harm and abuse, as well as information about how we develop and enforce those policies.</p>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 my-16 sm:my-20 md:my-24 mx-auto border-0">

    {{-- Jelajahi Semua Layanan Kami --}}
    <section id="layanan" class="w-full bg-white py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Jelajahi Semua Layanan Kami</h2>
        </div>
        <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-8">
            {{-- Web Development --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">Web Development</h3>
                <p class="text-slate-700 mb-4">Website modern, cepat, dan responsif yang mempresentasikan bisnis Anda secara profesional.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Custom & CMS Website</li>
                    <li>Integrasi API</li>
                    <li>SEO Optimization</li>
                </ul>
                <a href="{{ route('services.web.index') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- App Development --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">App Development</h3>
                <p class="text-slate-700 mb-4">Aplikasi berbasis web atau desktop yang disesuaikan untuk meningkatkan produktivitas bisnis.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Aplikasi Kustom</li>
                    <li>Sistem Manajemen Data</li>
                    <li>Dashboard Analitik</li>
                </ul>
                <a href="{{ route('services.app.index') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- UI/UX Design --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">UI/UX Design</h3>
                <p class="text-slate-700 mb-4">Desain antarmuka yang estetis dan pengalaman pengguna yang intuitif.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Prototype & Wireframe</li>
                    <li>User Flow Mapping</li>
                    <li>Design System</li>
                </ul>
                <a href="{{ route('services.uiux.index') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
            {{-- Mobile App Development --}}
            <div class="service-card group bg-white rounded-2xl border border-neutral-200 p-8 flex flex-col items-start shadow-sm hover:shadow">
                <h3 class="text-2xl font-semibold mb-2">Mobile App Development</h3>
                <p class="text-slate-700 mb-4">Aplikasi mobile Android dan iOS yang canggih dan mudah digunakan.</p>
                <ul class="text-slate-600 text-base mb-6 space-y-1 pl-4 list-disc hidden">
                    <li>Native & Hybrid Apps</li>
                    <li>Integrasi API</li>
                    <li>Publikasi Store</li>
                </ul>
                <a href="{{ route('services.mobile-app.index') }}" class="inline-block mt-auto px-5 py-2 rounded-full bg-[#128AEB] text-white font-medium hover:bg-[#0F76C6] transition">Lihat Detail</a>
            </div>
        </div>
        {{-- CTA bawah --}}
        <div class="max-w-2xl mx-auto text-center mt-16">
            <p class="text-lg md:text-xl text-slate-800 mb-6">Tidak yakin layanan mana yang sesuai kebutuhan Anda?</p>
            <a href="#" class="inline-block px-8 py-3 rounded-full bg-[#128AEB] text-white font-semibold text-lg shadow hover:bg-[#0F76C6] transition">Konsultasi Gratis Sekarang</a>
        </div>
    </section>

    {{-- Keunggulan Kami --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <section class="w-full bg-white py-32 max-md:py-16 px-4 sm:px-6 lg:px-8" x-data="advantagesSection">
        {{-- Heading --}}
        <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">
                Keunggulan Layanan Kami
            </h2>
        </div>
        <div class="w-full max-w-screen-xl mx-auto">
            <div class="swiper advantages-swiper">
                <div class="swiper-wrapper" data-aos="fade-in" data-aos-duration="300" data-aos-delay="200" data-aos-once="true">
                    <template x-for="(item, idx) in advantages" :key="idx">
                        <div class="swiper-slide py-3">
                            <div
                                class="group relative cursor-pointer rounded-3xl flex flex-col justify-between overflow-hidden border border-neutral-200 shadow hover:shadow-md bg-white/80 transition-all duration-300 flex flex-col min-h-[500px] max-h-[500px]"
                                x-bind:style="'background-image:url(' + backgroundImages[idx] + ');background-size:cover;background-position:center;'"
                                @click="openModal(idx)" loading="lazy">
                                <div class="relative z-10 flex flex-col h-full px-7 py-6 justify-between">
                                    <span class="text-base font-medium mb-1 transition text-neutral-600 text-left w-full" x-text="item.title"></span>
                                    <span class="text-2xl font-semibold transition text-slate-900 text-left w-full" x-text="item.short"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Custom Navigation Buttons --}}
            <div class="flex justify-end items-center gap-3 mt-8">
                <button class="swiper-button-prev-custom flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB]/5 border-0 text-[#128AEB] hover:border hover:border-[#128AEB] hover:text-[#128AEB] hover:bg-[#128AEB]/15 transition-all duration-300 shadow-sm">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="swiper-button-next-custom flex items-center justify-center w-12 h-12 rounded-full bg-[#128AEB]/5 border-0 text-[#128AEB] hover:border hover:border-[#128AEB] hover:text-[#128AEB] hover:bg-[#128AEB]/15 transition-all duration-300 shadow-sm">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        {{-- Modal Pop-up --}}
        <div x-show="showModal"
             x-cloak
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 flex items-center justify-center bg-black/80 backdrop-blur-md overflow-y-auto">
            <div class="relative bg-white rounded-3xl shadow-2xl max-w-3xl w-full py-12 px-16 mx-4 border border-[#128AEB]/10 flex flex-col items-center max-md:py-8 max-md:px-8" @click.away="closeModal()">
                <button @click="closeModal()" class="absolute top-5 right-5 text-[#128AEB] bg-neutral-100 rounded-full w-8 h-8 flex items-center justify-center hover:bg-neutral-200 transition"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <span class="text-3xl font-bold text-slate-900 mb-6 text-left block w-full" x-text="modalTitle"></span>
                <div class="text-slate-800 text-xl leading-relaxed text-left" x-text="modalDesc"></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('advantagesSection', () => ({
                    advantages: [{
                            title: 'Tim Berpengalaman',
                            short: 'Developer, designer, dan engineer profesional dengan pengalaman bertahun-tahun.',
                            desc: 'Tim kami terdiri dari developer, designer, dan engineer profesional dengan pengalaman bertahun-tahun dalam mengerjakan berbagai jenis proyek digital. Kami memahami kebutuhan industri dan selalu siap membantu Anda mencapai hasil terbaik.'
                        },
                        {
                            title: 'Solusi End-to-End',
                            short: 'Layanan lengkap dari riset hingga maintenance.',
                            desc: 'Kami menyediakan layanan lengkap, mulai dari riset, desain UI/UX, pengembangan aplikasi, hingga proses deployment dan maintenance. Dengan Centrova, Anda tidak perlu repot mencari vendor terpisah.'
                        },
                        {
                            title: 'Desain Berorientasi Pengguna',
                            short: 'Fokus pada kenyamanan dan pengalaman pengguna.',
                            desc: 'Setiap desain kami dibuat dengan fokus pada kenyamanan dan pengalaman pengguna. Hasilnya adalah aplikasi yang tidak hanya menarik secara visual tetapi juga mudah digunakan.'
                        },
                        {
                            title: 'Teknologi Terkini',
                            short: 'Selalu update dengan teknologi dan framework modern.',
                            desc: 'Kami selalu menggunakan teknologi terbaru dan framework modern untuk memastikan aplikasi Anda aman, cepat, dan siap berkembang di masa depan.'
                        },
                        {
                            title: 'Pengembangan Cepat & Transparan',
                            short: 'Metode Agile, update progres rutin.',
                            desc: 'Proyek Anda akan dikerjakan dengan metode Agile, disertai pembaruan rutin mengenai progres. Anda akan selalu tahu sejauh mana pengembangan berjalan.'
                        },
                        {
                            title: 'Dukungan Purna Jual',
                            short: 'Support & maintenance setelah proyek selesai.',
                            desc: 'Setelah proyek selesai, tim kami tetap siap membantu Anda melalui layanan support dan maintenance, agar aplikasi selalu optimal.'
                        },
                    ],
                    backgroundImages: [
                        '/assets/image/services/keunggulan/tim-berpengalaman.jpg',
                        '/assets/image/services/keunggulan/solusi.jpg',
                        '/assets/image/services/keunggulan/desain-berorientasi.png',
                        '/assets/image/services/keunggulan/technology.png',
                        '/assets/image/services/keunggulan/end-to-end.jpg',
                        'https://images.unsplash.com/photo-1580893246395-52aead8960dc?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    ],
                    showModal: false,
                    modalIndex: null,
                    modalTitle: '',
                    modalDesc: '',
                    openModal(idx) {
                        this.modalIndex = idx;
                        this.modalTitle = this.advantages[idx].title;
                        this.modalDesc = this.advantages[idx].desc;
                        this.showModal = true;
                        document.body.style.overflow = 'hidden';
                    },
                    closeModal() {
                        this.showModal = false;
                        document.body.style.overflow = 'auto';
                        
                        // Tunda reset konten modal setelah animasi selesai
                        setTimeout(() => {
                            this.modalIndex = null;
                            this.modalTitle = '';
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
                            if (this.swiper) this.swiper.destroy();
                            this.swiper = new Swiper('.advantages-swiper', {
                                slidesPerView: 1,
                                spaceBetween: 24,
                                loop: true,
                                speed: 600,
                                grabCursor: true,
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true
                                },
                                navigation: {
                                    nextEl: '.swiper-button-next-custom',
                                    prevEl: '.swiper-button-prev-custom'
                                },
                                breakpoints: {
                                    768: {
                                        slidesPerView: 2
                                    },
                                    1024: {
                                        slidesPerView: 3
                                    }
                                },
                            });
                        });
                    }
                }));
            });
        </script>
    </section>
    <style>
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-clamp: 4;
        }

        .swiper {
            padding-bottom: 0px;
        }

        /* Hide default swiper navigation */
        .swiper-button-next,
        .swiper-button-prev {
            display: none;
        }

        /* Custom navigation buttons */
        .swiper-button-prev-custom,
        .swiper-button-next-custom {
            cursor: pointer;
        }

        .swiper-button-prev-custom:active,
        .swiper-button-next-custom:active {
            transform: scale(0.95);
        }

        .swiper-pagination-bullet-active {
            background: #128AEB !important;
        }
    </style>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">
</div>
@endsection