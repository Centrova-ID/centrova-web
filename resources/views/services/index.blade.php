@extends('partials.layouts.main')

@section('title', 'Layanan Jasa Pengembangan Perangkat Lunak - Centrova')

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
                        {
                            title: 'Harga Kompetitif',
                            short: 'Layanan premium dengan harga terjangkau.',
                            desc: 'Kami percaya solusi digital berkualitas tidak harus mahal. Centrova menawarkan layanan premium dengan harga yang sesuai dengan kebutuhan dan budget bisnis Anda.'
                        },
                        {
                            title: 'Customizable Solution',
                            short: 'Fitur & desain disesuaikan dengan visi Anda.',
                            desc: 'Setiap bisnis itu unik. Karena itu, kami selalu menyesuaikan fitur, desain, dan alur kerja aplikasi agar benar-benar relevan dengan visi Anda.'
                        },
                        {
                            title: 'Garansi Revisi',
                            short: 'Garansi revisi sesuai scope project.',
                            desc: 'Kami memberikan garansi revisi sesuai kesepakatan project scope. Tujuan kami adalah memastikan hasil akhirnya 100% memuaskan Anda.'
                        },
                    ],
                    backgroundImages: [
                        '/assets/image/services/keunggulan/tim-berpengalaman.jpg',
                        '/assets/image/services/keunggulan/solusi.jpg',
                        '/assets/image/services/keunggulan/desain-berorientasi.png',
                        '/assets/image/services/keunggulan/technology.png',
                        '/assets/image/services/keunggulan/end-to-end.jpg',
                        'https://images.unsplash.com/photo-1580893246395-52aead8960dc?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                        'https://i.pinimg.com/736x/fb/0e/8e/fb0e8e750dd98dd11adb2194385ea92f.jpg',
                        'https://i.pinimg.com/736x/6e/47/a8/6e47a8f87a40d77d786d8aac5af859dc.jpg',
                        'https://i.pinimg.com/736x/6e/47/a8/6e47a8f87a40d77d786d8aac5af859dc.jpg',
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

    {{-- Mengapa Harus Digitalisasi Bisnis --}}
    <section class="w-full bg-white py-32 max-md:py-16 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-6xl mx-auto">
            {{-- Heading --}}
            <div class="max-w-4xl mx-auto text-center mb-16" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">
                    Mengapa Harus Mendigitalisasi Bisnis Anda?
                </h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto mb-8">
                    Di era digital, bisnis bisa tumbuh lebih cepat dan menjangkau pasar yang lebih luas.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                {{-- Jangkauan Pasar Lebih Luas --}}
                <div class="bg-white rounded-3xl border border-neutral-200 p-8 text-center hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                    <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg width="32" height="32" fill="none" stroke="#128AEB" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Ekspansi Pasar Global</h3>
                    <p class="text-slate-700 leading-relaxed">Platform digital memungkinkan akses customer 24/7 dari seluruh dunia, membuka peluang revenue stream yang tak terbatas.</p>
                </div>

                {{-- Efisiensi Operasional --}}
                <div class="bg-white rounded-3xl border border-neutral-200 p-8 text-center hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
                    <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg width="32" height="32" fill="none" stroke="#128AEB" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Efisiensi Operasional</h3>
                    <p class="text-slate-700 leading-relaxed">Otomatisasi proses bisnis mengurangi human error, meningkatkan produktivitas, dan mengoptimalkan alokasi resources.</p>
                </div>

                {{-- Kredibilitas Professional --}}
                <div class="bg-white rounded-3xl border border-neutral-200 p-8 text-center hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="300" data-aos-once="true">
                    <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg width="32" height="32" fill="none" stroke="#128AEB" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Brand Credibility</h3>
                    <p class="text-slate-700 leading-relaxed">Digital presence yang profesional membangun trust dan diferensiasi brand dalam kompetisi market yang ketat.</p>
                </div>

                {{-- Data & Analytics --}}
                <div class="bg-white rounded-3xl border border-neutral-200 p-8 text-center hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                    <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg width="32" height="32" fill="none" stroke="#128AEB" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Data-Driven Insights</h3>
                    <p class="text-slate-700 leading-relaxed">Analytics platform memberikan business intelligence untuk strategic decision making dan growth optimization.</p>
                </div>

                {{-- Cost Effective --}}
                <div class="bg-white rounded-3xl border border-neutral-200 p-8 text-center hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
                    <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg width="32" height="32" fill="none" stroke="#128AEB" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">ROI Berkelanjutan</h3>
                    <p class="text-slate-700 leading-relaxed">Investasi teknologi menghasilkan compound returns melalui scalability dan operational efficiency jangka panjang.</p>
                </div>

                {{-- Competitive Advantage --}}
                <div class="bg-white rounded-3xl border border-neutral-200 p-8 text-center hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="300" data-aos-once="true">
                    <div class="w-16 h-16 bg-[#128AEB]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg width="32" height="32" fill="none" stroke="#128AEB" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Competitive Advantage</h3>
                    <p class="text-slate-700 leading-relaxed">Digital transformation memberikan first-mover advantage dan sustainable competitive moat dalam industry landscape.</p>
                </div>
            </div>

            {{-- Call to Action --}}
            <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="400" data-aos-once="true">
                <div class="bg-gradient-to-r from-[#128AEB]/5 to-[#128AEB]/10 rounded-3xl border border-[#128AEB]/10 p-8 md:p-12 text-center">
                    <h3 class="text-xl md:text-2xl font-semibold text-slate-900 mb-4">
                        Ready to Transform Your Business?
                    </h3>
                    <p class="text-base md:text-lg text-slate-700 mb-8 max-w-2xl mx-auto">
                        Jangan biarkan kompetitor unggul terlebih dahulu. Mulai digital transformation journey bersama partner teknologi terpercaya.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" class="inline-flex items-center justify-center px-8 py-3 rounded-full bg-[#128AEB] text-white font-semibold hover:bg-[#0F76C6] transition">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Strategic Consultation
                        </a>
                        <a href="#portfolio" class="inline-flex items-center justify-center px-8 py-3 rounded-full border border-[#128AEB] text-[#128AEB] font-semibold hover:bg-[#128AEB]/5 transition">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Explore Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection