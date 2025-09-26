@extends('partials.layouts.main')

@section('title', 'Layanan - App Development')

@section('navbar')
    @include('partials.navbar.services')
    @include('partials.navbar.subnavbar.services', [
        'servicesLinkText' => 'App Development',
        'servicesLinkUrl' => route('services.app.index'),
        'menuItems' => [
            ['text' => 'Layanan', 'url' => url('#')],
            ['text' => 'Portfolio', 'url' => url('#')],
            ['text' => 'Teknologi', 'url' => url('#')],
            ['text' => 'Konsultasi', 'url' => url('#')],
        ],
    ])
@endsection

<style>
    .bg-own {
        background-color: #ffffff90 !important;
        backdrop-filter: blur(32px) !important;
        -webkit-backdrop-filter: blur(32px); /* Untuk dukungan Safari */
    }
    
    /* Simple smooth scrolling */
    html {
        scroll-behavior: smooth;
    }
    
    /* Mobile touch scrolling */
    @media (max-width: 768px) {
        html {
            -webkit-overflow-scrolling: touch;
        }
    }
    
    /* Hide elements until Alpine.js loads */
    [x-cloak] { 
        display: none !important; 
    }
</style>

@section('content')
<div>
    {{-- Parallax Section 1 --}}
    <section class="relative min-h-screen overflow-hidden parallax-section" data-parallax="0.5">
      <div class="absolute inset-0 bg-cover bg-center z-0 bg-fixed" 
           style="background-image: url('/assets/image/services/app-development/hero-section/desktop-app.jpg');"></div>
      <div class="absolute inset-0 z-5"></div>
      <div class="relative z-10 flex items-center justify-center h-screen">
        <div class="text-center parallax-content max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
          <h1 class="text-slate-900 text-4xl md:text-6xl font-bold mb-4">Solusi Aplikasi Desktop Profesional</h1>
        </div>
      </div>
      <div class="relative z-10 flex items-start justify-center min-h-screen">
        <div class="text-center parallax-content max-w-xl mx-auto font-semibold">
          <p class="text-slate-600/80 text-lg md:text-2xl max-w-2xl mx-auto px-4 mb-6" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
            Pengembangan <span class="text-slate-900">aplikasi desktop berbasis Electron, PHP, atau Python</span>, untuk kebutuhan bisnis seperti Point of Sale, manajemen inventori, atau sistem internal perusahaan.
          </p>
          <p class="text-slate-600/80 text-lg md:text-2xl max-w-2xl mx-auto px-4 mb-6" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
            Aplikasi yang <span class="text-slate-900">cepat, efisien</span>, dan dapat bekerja <span class="text-slate-900">offline</span> tanpa ketergantungan koneksi internet.
          </p>
          <p class="text-slate-600/80 text-lg md:text-2xl max-w-2xl mx-auto px-4" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
            Dengan <span class="text-slate-900">performa tinggi</span> dan fitur lengkap untuk mendukung operasional bisnis Anda.
          </p>
        </div>
      </div>
    </section>

    {{-- Parallax Section 2 --}}
    <section class="relative min-h-screen overflow-hidden parallax-section" data-parallax="0.3">
      <div class="absolute inset-0 bg-cover bg-center z-0 bg-fixed" 
           style="background-image: url('/assets/image/services/app-development/hero-section/pos-system.jpg');"></div>
      <div class="absolute inset-0 z-5"></div>
      <div class="relative z-10 flex items-center justify-center h-full">
        <div class="text-center parallax-content" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
          <h1 class="text-white text-4xl md:text-6xl font-bold mb-4">Sistem Terintegrasi</h1>
          <p class="text-white/90 text-lg md:text-xl max-w-2xl mx-auto px-4">
            Solusi komprehensif untuk operasional bisnis yang lebih efisien
          </p>
        </div>
      </div>
    </section>

    {{-- Hero Section --}}
    <section class="w-full bg-white">
        <div class="w-full max-w-6xl mx-auto pt-32 md:pt-40 lg:pt-44 px-4">
            <div 
                class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center text-center" 
                data-aos="fade-up" 
                data-aos-duration="700" 
                data-aos-once="true" 
                data-aos-offset="10"
            >
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-medium text-slate-900 mb-6 sm:mb-8 md:mb-10 leading-tight">
                    Jasa Pembuatan Aplikasi Desktop <br class="block sm:hidden">
                    <span class="text-[#128AEB]">Profesional & Modern</span>
                </h1>
                <p class="text-base sm:text-lg md:text-xl max-w-2xl text-slate-900">
                    Kami menyediakan layanan pembuatan aplikasi desktop berkualitas tinggi yang cepat, aman, dan dapat bekerja offline—mulai dari Point of Sale hingga sistem manajemen internal perusahaan.
                </p>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 my-16 sm:my-20 md:my-24 mx-auto border-0">

    {{-- Sudah saatnya --}}
    <section class="w-full overflow-hidden">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center" 
             data-aos="fade-up" 
             data-aos-duration="700" 
             data-aos-once="true" 
             data-aos-offset="10">
            
            {{-- Heading --}}
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3 leading-snug">
                    Sudah Saatnya Operasional Bisnismu Lebih Efisien
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Miliki aplikasi desktop yang dapat bekerja offline, memproses data dengan cepat, dan mendukung operasional harian tanpa gangguan
                </p>
            </div>
            
            <div class="w-full mt-10 md:mt-16 flex flex-col-reverse md:flex-row items-center justify-between gap-10 md:gap-16">
                
                {{-- Kiri --}}
                <div class="text-center md:text-left max-w-xl">
                    <h2 class="text-slate-800 font-medium text-2xl sm:text-3xl mb-4 sm:mb-6 leading-snug">Aplikasi Desktop Custom untuk Bisnismu</h2>
                    <p class="text-base sm:text-lg text-slate-600">Centrova menghadirkan jasa pembuatan aplikasi desktop profesional yang dirancang khusus untuk kebutuhan operasional bisnis. Aplikasi yang kami buat dapat bekerja offline, memiliki performa tinggi, dan mudah digunakan untuk meningkatkan produktivitas tim.</p>
                    
                    <button class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-2.5 rounded-full transition flex items-center gap-2 mt-6 mx-auto md:mx-0 group">
                        Konsultasi Gratis
                        <svg class="w-5 h-5 group-hover:translate-x-[4px] transition duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>

                {{-- Kanan --}}
                <img src="/assets/image/services/app-development/desktop-illustration.png" 
                     alt="Ilustrasi aplikasi desktop"
                     class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl flex-shrink-0" />
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 my-16 sm:my-20 md:my-24 mx-auto border-0">

    {{-- Pilihan Jenis Aplikasi Desktop --}}
    <section class="w-full bg-white">
        <div class="w-full max-w-6xl mx-auto px-6">
            {{-- Heading --}}
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3 leading-snug">
                    Pilihan Jenis Aplikasi Desktop
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Temukan solusi aplikasi desktop yang tepat untuk kebutuhan operasional bisnis Anda
                </p>
            </div>

            {{-- Filter --}}
            <div class="flex justify-center mb-12 px-4 sm:px-0" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                <div 
                    id="filter-scroll"
                    class="flex items-center bg-neutral-50 rounded-full overflow-x-auto overflow-y-hidden p-1 gap-1 max-w-full sm:max-w-max scrollbar-hide select-none"
                    x-data="{ 
                        activeFilter: 'semua',
                        filters: [
                            { value: 'semua', label: 'Semua' },
                            { value: 'bisnis', label: 'Bisnis' },
                            { value: 'retail', label: 'Retail' },
                            { value: 'keuangan', label: 'Keuangan' },
                            { value: 'produktivitas', label: 'Produktivitas' },
                            { value: 'data', label: 'Data' },
                        ]
                    }"
                >
                    <div class="flex flex-nowrap gap-1">
                        <template x-for="filter in filters" :key="filter.value">
                            <span
                                @click="activeFilter = filter.value; $dispatch('filter-changed', { filter: filter.value })"
                                :class="activeFilter === filter.value 
                                    ? 'bg-[#128AEB] text-white' 
                                    : 'text-gray-700 hover:bg-neutral-100 cursor-pointer'"
                                class="px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200 whitespace-nowrap"
                                x-text="filter.label">
                            </span>
                        </template>
                    </div>
                </div>
            </div>

            {{-- CSS & JS untuk horizontal scroll --}}
            <style>
                .scrollbar-hide {
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                }
                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }
            </style>

            <script>
                const slider = document.getElementById('filter-scroll');
                if (slider) {
                    let isDown = false;
                    let startX;
                    let scrollLeft;

                    slider.addEventListener('mousedown', (e) => {
                        isDown = true;
                        slider.classList.add('active');
                        startX = e.pageX - slider.offsetLeft;
                        scrollLeft = slider.scrollLeft;
                    });

                    slider.addEventListener('mouseleave', () => {
                        isDown = false;
                        slider.classList.remove('active');
                    });

                    slider.addEventListener('mouseup', () => {
                        isDown = false;
                        slider.classList.remove('active');
                    });

                    slider.addEventListener('mousemove', (e) => {
                        if (!isDown) return;
                        e.preventDefault();
                        const x = e.pageX - slider.offsetLeft;
                        const walk = (x - startX) * 1.5;
                        slider.scrollLeft = scrollLeft - walk;
                    });
                }
            </script>

            {{-- Aplikasi Desktop --}}
            <div x-data="{
                currentFilter: 'semua',
                itemsToShow: window.innerWidth < 768 ? 4 : 12,
                aplikasi: [
                    // BISNIS (8)
                    { name: 'Point of Sale (POS)', category: 'bisnis' },
                    { name: 'Customer Relationship Management (CRM)', category: 'bisnis' },
                    { name: 'Employee Management System', category: 'bisnis' },
                    { name: 'Document Management System', category: 'bisnis' },
                    { name: 'Project Management Tool', category: 'bisnis' },
                    { name: 'Attendance & Payroll System', category: 'bisnis' },
                    { name: 'Invoice & Billing System', category: 'bisnis' },
                    { name: 'Business Intelligence Dashboard', category: 'bisnis' },

                    // RETAIL (6)
                    { name: 'Inventory Management System', category: 'retail' },
                    { name: 'Warehouse Management System', category: 'retail' },
                    { name: 'Barcode & RFID Scanner App', category: 'retail' },
                    { name: 'Stock Alert & Reorder System', category: 'retail' },
                    { name: 'Supplier Management Tool', category: 'retail' },
                    { name: 'Sales Analytics Dashboard', category: 'retail' },

                    // KEUANGAN (6)
                    { name: 'Accounting & Bookkeeping Software', category: 'keuangan' },
                    { name: 'Financial Planning Tool', category: 'keuangan' },
                    { name: 'Tax Management System', category: 'keuangan' },
                    { name: 'Budget Tracking Application', category: 'keuangan' },
                    { name: 'Expense Management System', category: 'keuangan' },
                    { name: 'Financial Report Generator', category: 'keuangan' },

                    // PRODUKTIVITAS (6)
                    { name: 'Task & Time Management Tool', category: 'produktivitas' },
                    { name: 'Note Taking & Knowledge Base', category: 'produktivitas' },
                    { name: 'File Organization System', category: 'produktivitas' },
                    { name: 'Calendar & Scheduling App', category: 'produktivitas' },
                    { name: 'Team Communication Tool', category: 'produktivitas' },
                    { name: 'Workflow Automation System', category: 'produktivitas' },

                    // DATA (6)
                    { name: 'Data Import/Export Tool', category: 'data' },
                    { name: 'Database Management System', category: 'data' },
                    { name: 'Report Generation Tool', category: 'data' },
                    { name: 'Data Visualization Dashboard', category: 'data' },
                    { name: 'Analytics & Statistics Tool', category: 'data' },
                    { name: 'Data Backup & Recovery System', category: 'data' }
                ],
                filteredAplikasi() {
                    if (this.currentFilter === 'semua') {
                        return this.aplikasi.slice(0, this.itemsToShow);
                    }
                    return this.aplikasi.filter(item => item.category === this.currentFilter);
                },
                hasMoreItems() {
                    return this.currentFilter === 'semua' && this.itemsToShow < this.aplikasi.length;
                },
                loadMore() {
                    this.itemsToShow += window.innerWidth < 768 ? 4 : 12;
                },
                updateItemsToShow() {
                    this.itemsToShow = this.currentFilter === 'semua' ? (window.innerWidth < 768 ? 4 : 12) : this.aplikasi.filter(item => item.category === this.currentFilter).length;
                },
                init() {
                    window.addEventListener('resize', () => {
                        this.updateItemsToShow();
                    });
                }
            }" 
            @filter-changed.window="currentFilter = $event.detail.filter; updateItemsToShow();">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <template x-for="item in filteredAplikasi()" :key="item.name">
                        <div class="p-5 border border-gray-200 rounded-lg transition-all duration-200 hover:shadow-sm group">
                            <div class="flex justify-center items-center">
                                <h3 class="text-gray-800 font-medium transition-colors text-center" x-text="item.name"></h3>
                            </div>
                        </div>
                    </template>
                </div>
                
                {{-- Tombol Lihat Lebih Banyak --}}
                <div class="text-center mt-8" x-show="hasMoreItems()" x-transition>
                    <button 
                        @click="loadMore()"
                        class="px-6 py-2 bg-white border border-blue-600 text-blue-600 rounded-full hover:bg-blue-50 transition-colors duration-200 font-medium">
                        Lihat Lebih Banyak
                    </button>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 my-16 sm:my-20 md:my-24 mx-auto border-0">

    {{-- Tentang Layanan --}}
    <div class="max-w-4xl mx-auto px-4 max-md:px-8 lg:px-8 text-center border-none border-neutral-300 py-32">
        <p class="mt-8 text-2xl max-lg:text-xl max-w-3xl mx-auto font-medium text-slate-900/60" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
            Kami menawarkan <span class="text-slate-900">layanan pengembangan aplikasi desktop</span> yang cepat, aman, dan fleksibel—mulai dari Point of Sale hingga sistem manajemen internal. Semua dikembangkan secara custom sesuai kebutuhan bisnismu, dengan desain profesional, fitur lengkap, dan <span class="text-slate-900">performa optimal</span> untuk mendukung pertumbuhan operasional di era digital.
        </p>
    </div>

    {{-- Fokus Layanan --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <section class="w-full bg-neutral-50 py-24 px-4 sm:px-6 lg:px-8" x-data="appDevAdvantagesSection">
        <div class="max-w-4xl mx-auto text-center mb-6">
            <h2 class="text-4xl font-bold text-slate-900 mb-3">Fokus Layanan Kami</h2>
            <p class="text-xl text-slate-700">Mengapa aplikasi desktop dari Centrova?</p>
        </div>
        <div class="w-full max-w-screen-2xl mx-auto">
            <div class="swiper advantages-swiper">
                <div class="swiper-wrapper">
                    <template x-for="(item, idx) in advantages" :key="idx">
                        <div class="swiper-slide py-3">
                            <div
                                class="group relative cursor-pointer rounded-3xl overflow-hidden shadow hover:shadow-md bg-white/80 transition-all duration-300 flex flex-col min-h-[500px]"
                                x-bind:style="'background-image:url(' + backgroundImages[idx] + ');background-size:cover;background-position:center;'"
                                @click="openModal(idx)" loading="lazy">
                                <!-- Overlay gelap agar teks putih lebih jelas -->
                                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0"></div>
                                <div class="relative z-10 flex flex-col h-full px-7 py-6 justify-between">
                                    <span class="text-[26px] font-semibold mb-1 transition text-slate-900 text-left w-full" x-text="item.title"></span>
                                    <span class="text-lg font-normal transition text-slate-800 text-left w-full" x-text="item.short"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <!-- Navigasi panah - dipindah ke bawah -->
            </div>
            <!-- Custom Navigation Buttons -->
            <div class="flex justify-end items-center mt-8 gap-3">
                <button class="swiper-button-prev-custom flex items-center justify-center w-12 h-12 rounded-full bg-white border-2 border-gray-200 text-gray-400 hover:border-[#128AEB] hover:text-[#128AEB] hover:bg-[#128AEB]/5 transition-all duration-300 shadow-sm">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="swiper-button-next-custom flex items-center justify-center w-12 h-12 rounded-full bg-white border-2 border-gray-200 text-gray-400 hover:border-[#128AEB] hover:text-[#128AEB] hover:bg-[#128AEB]/5 transition-all duration-300 shadow-sm">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Advantages Modal -->
        <div x-show="showModal"
             x-cloak
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 flex items-center justify-center bg-black/80 backdrop-blur-md">
            <div class="relative bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl max-w-2xl w-full p-12 mx-4 border border-[#128AEB]/10 flex flex-col items-center" @click.away="closeModal()">
                <button @click="closeModal()" class="absolute top-5 right-5 text-[#128AEB] bg-white/80 rounded-full w-10 h-10 flex items-center justify-center hover:bg-[#e0f2fe] transition"><svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                <span class="text-3xl font-bold text-slate-900 mb-6 text-center block" x-text="modalTitle"></span>
                <div class="text-slate-800 text-xl leading-relaxed text-center" x-text="modalDesc"></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('appDevAdvantagesSection', () => ({
                    advantages: [{
                            title: 'Performa Tinggi',
                            short: 'Aplikasi yang cepat dan efisien dalam penggunaan sumber daya komputer.',
                            desc: 'Aplikasi desktop kami dirancang untuk memberikan performa tinggi dengan optimasi penggunaan memori dan CPU. Cocok untuk operasional bisnis yang membutuhkan respon cepat dan stabil.'
                        },
                        {
                            title: 'Fitur Lengkap',
                            short: 'Solusi komprehensif untuk semua kebutuhan operasional bisnis Anda.',
                            desc: 'Dari manajemen inventori, sistem POS, hingga laporan analitik - semua fitur terintegrasi dalam satu aplikasi yang mudah digunakan dan powerful.'
                        },
                        {
                            title: 'Integrasi Lokal',
                            short: 'Bekerja optimal secara offline tanpa ketergantungan koneksi internet.',
                            desc: 'Aplikasi dapat beroperasi sepenuhnya offline, dengan kemampuan sinkronisasi data saat koneksi tersedia. Ideal untuk bisnis di area dengan koneksi internet tidak stabil.'
                        },
                        {
                            title: 'Teknologi Modern',
                            short: 'Menggunakan teknologi terkini seperti Electron, Python, dan PHP.',
                            desc: 'Dikembangkan dengan teknologi modern yang terbukti reliable dan mudah untuk maintenance di masa depan. Cross-platform dan user-friendly.'
                        },
                        {
                            title: 'Keamanan Data',
                            short: 'Sistem keamanan berlapis untuk melindungi data bisnis Anda.',
                            desc: 'Enkripsi data, backup otomatis, dan sistem autentikasi yang robust untuk memastikan data bisnis Anda selalu aman dan terlindungi.'
                        },
                        {
                            title: 'Support & Maintenance',
                            short: 'Dukungan teknis dan pemeliharaan sistem berkelanjutan.',
                            desc: 'Tim support kami siap membantu 24/7 untuk memastikan aplikasi selalu berjalan optimal. Termasuk update fitur dan perbaikan bug secara berkala.'
                        },
                    ],
                    backgroundImages: [
                        '/assets/image/services/app-development/performa-tinggi.jpg',
                        '/assets/image/services/app-development/fitur-lengkap.jpg',
                        '/assets/image/services/app-development/integrasi-lokal.jpg',
                        '/assets/image/services/app-development/teknologi-modern.jpg',
                        '/assets/image/services/app-development/keamanan-data.jpg',
                        '/assets/image/services/app-development/support-maintenance.jpg',
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
                        this.modalIndex = null;
                        document.body.style.overflow = 'unset';
                    },
                    initSwiper() {
                        // Wait for DOM to be ready
                        setTimeout(() => {
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
                        }, 100);
                    }
                }));

                // Initialize swiper after Alpine data is set up
                setTimeout(() => {
                    if (window.Alpine && document.querySelector('.advantages-swiper')) {
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
                }, 500);
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

    {{-- Teknologi yang Kami Gunakan --}}
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Teknologi yang Kami Gunakan</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto">
                    Aplikasi desktop yang kami kembangkan menggunakan teknologi modern dan terpercaya
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                {{-- Electron --}}
                <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="bg-blue-100 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Electron</h3>
                    <p class="text-slate-600 mb-4">Framework untuk membangun aplikasi desktop cross-platform menggunakan teknologi web modern.</p>
                    <ul class="text-sm text-slate-600 space-y-2">
                        <li>• Cross-platform compatibility</li>
                        <li>• Modern UI/UX</li>
                        <li>• Web technologies integration</li>
                        <li>• Easy maintenance</li>
                    </ul>
                </div>

                {{-- Python --}}
                <div class="text-center p-8 bg-gradient-to-br from-green-50 to-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="bg-green-100 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14.25.18l.9.2.73.26.59.3.45.32.34.34.25.34.16.33.1.3.04.26.02.2-.01.13V8.5l-.05.63-.13.55-.21.46-.26.38-.3.31-.33.25-.35.19-.35.14-.33.1-.3.07-.26.04-.21.02H8.77l-.69.05-.59.14-.5.22-.41.27-.33.32-.27.35-.2.36-.15.37-.1.35-.07.32-.04.27-.02.21v3.06H3.17l-.21-.03-.28-.07-.32-.12-.35-.18-.36-.26-.36-.36-.35-.46-.32-.59-.28-.73-.21-.88-.14-1.05-.05-1.23.06-1.22.16-1.04.24-.87.32-.71.36-.57.4-.44.42-.33.42-.24.4-.16.36-.1.32-.05.26-.02.21-.01h5.84l.69-.05.59-.14.5-.21.41-.28.33-.32.27-.35.2-.36.15-.36.1-.35.07-.32.04-.28.02-.21V6.07h2.09l.14.01zm-6.47 14.25c-.2 0-.37.09-.5.27-.13.18-.2.39-.2.63 0 .24.07.45.2.63.13.18.3.27.5.27.2 0 .37-.09.5-.27.13-.18.2-.39.2-.63 0-.24-.07-.45-.2-.63-.13-.18-.3-.27-.5-.27z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Python</h3>
                    <p class="text-slate-600 mb-4">Bahasa pemrograman yang powerful untuk aplikasi desktop dengan fokus pada data processing dan analisis.</p>
                    <ul class="text-sm text-slate-600 space-y-2">
                        <li>• Data processing excellence</li>
                        <li>• Rich library ecosystem</li>
                        <li>• Rapid development</li>
                        <li>• Scientific computing</li>
                    </ul>
                </div>

                {{-- PHP --}}
                <div class="text-center p-8 bg-gradient-to-br from-purple-50 to-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="bg-purple-100 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7.01 10.207h-.944l-.515 2.648h.838c.556 0 .982-.122 1.292-.391.291-.291.464-.767.464-1.283 0-.648-.374-1.011-1.135-.974zm6.284-1.283c-.838 0-1.135.363-1.135 1.011 0 .516.173.992.464 1.283.31.269.736.391 1.292.391h.838l-.515-2.648h-.944v-.037zm6.292-.767c0-.648-.374-1.011-1.135-.974h-.944l-.515 2.648h.838c.556 0 .982-.122 1.292-.391.291-.291.464-.767.464-1.283z"/>
                            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">PHP Desktop</h3>
                    <p class="text-slate-600 mb-4">Solusi desktop berbasis PHP untuk sistem yang terintegrasi dengan web application.</p>
                    <ul class="text-sm text-slate-600 space-y-2">
                        <li>• Web-desktop integration</li>
                        <li>• Database connectivity</li>
                        <li>• Server-side processing</li>
                        <li>• Scalable architecture</li>
                    </ul>
                </div>
            </div>

            {{-- Additional Technologies --}}
            <div class="bg-gradient-to-r from-gray-50 to-white rounded-2xl p-8">
                <h3 class="text-2xl font-bold text-slate-900 mb-6 text-center">Framework & Tools Pendukung</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="bg-white p-4 rounded-xl shadow-sm mb-3">
                            <span class="font-semibold text-slate-800">Qt/PyQt</span>
                        </div>
                        <p class="text-sm text-slate-600">Native desktop UI</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-white p-4 rounded-xl shadow-sm mb-3">
                            <span class="font-semibold text-slate-800">Tkinter</span>
                        </div>
                        <p class="text-sm text-slate-600">Python GUI toolkit</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-white p-4 rounded-xl shadow-sm mb-3">
                            <span class="font-semibold text-slate-800">SQLite</span>
                        </div>
                        <p class="text-sm text-slate-600">Local database</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-white p-4 rounded-xl shadow-sm mb-3">
                            <span class="font-semibold text-slate-800">MySQL</span>
                        </div>
                        <p class="text-sm text-slate-600">Database server</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Proses Pengembangan --}}
    <section class="py-24 bg-gradient-to-br from-slate-50 to-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Proses Pengembangan Aplikasi Desktop</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto">
                    Metodologi pengembangan yang terstruktur untuk memastikan aplikasi desktop berkualitas tinggi
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Step 1 --}}
                <div class="relative">
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 h-full">
                        <div class="text-center">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-blue-600">1</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Analisis Kebutuhan</h3>
                            <p class="text-slate-600 text-sm">Memahami requirement bisnis, workflow, dan spesifikasi teknis yang dibutuhkan untuk aplikasi desktop.</p>
                        </div>
                    </div>
                    {{-- Connector Arrow --}}
                    <div class="hidden lg:block absolute top-1/2 -right-4 transform -translate-y-1/2">
                        <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="relative">
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 h-full">
                        <div class="text-center">
                            <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-green-600">2</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Design & Prototype</h3>
                            <p class="text-slate-600 text-sm">Membuat wireframe, mockup UI/UX, dan prototype interaktif untuk memvalidasi desain sebelum development.</p>
                        </div>
                    </div>
                    <div class="hidden lg:block absolute top-1/2 -right-4 transform -translate-y-1/2">
                        <svg class="w-8 h-8 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="relative">
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 h-full">
                        <div class="text-center">
                            <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-purple-600">3</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Development</h3>
                            <p class="text-slate-600 text-sm">Coding aplikasi dengan teknologi yang sesuai, implementasi fitur, dan integrasi database serta sistem eksternal.</p>
                        </div>
                    </div>
                    <div class="hidden lg:block absolute top-1/2 -right-4 transform -translate-y-1/2">
                        <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="relative">
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 h-full">
                        <div class="text-center">
                            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold text-orange-600">4</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Testing & Deploy</h3>
                            <p class="text-slate-600 text-sm">Quality assurance, testing di berbagai skenario, deployment, training user, dan ongoing support.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Timeline --}}
            <div class="mt-16 bg-white rounded-2xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-slate-900 mb-6 text-center">Estimasi Timeline Pengembangan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <h4 class="font-bold text-blue-800 mb-2">Aplikasi Sederhana</h4>
                        <p class="text-2xl font-bold text-blue-600 mb-1">2-4 Minggu</p>
                        <p class="text-sm text-blue-700">Basic CRUD, simple UI</p>
                    </div>
                    <div class="text-center p-4 bg-green-50 rounded-xl">
                        <h4 class="font-bold text-green-800 mb-2">Aplikasi Menengah</h4>
                        <p class="text-2xl font-bold text-green-600 mb-1">1-3 Bulan</p>
                        <p class="text-sm text-green-700">Kompleks features, integrations</p>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-xl">
                        <h4 class="font-bold text-purple-800 mb-2">Aplikasi Enterprise</h4>
                        <p class="text-2xl font-bold text-purple-600 mb-1">3-6 Bulan</p>
                        <p class="text-sm text-purple-700">Advanced systems, scalability</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Solusi Aplikasi Desktop --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Solusi Aplikasi Desktop</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto">
                    Berbagai jenis aplikasi desktop yang dapat kami kembangkan sesuai kebutuhan bisnis Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">Point of Sale (POS)</h3>
                            <p class="text-slate-600 mb-4">Sistem kasir modern dengan manajemen inventori dan laporan penjualan terintegrasi.</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Kasir multi-user</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Manajemen stok real-time</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Laporan penjualan detail</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Integrasi printer receipt</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M9 5l7.681 3.841M13 3v4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">Manajemen Inventori</h3>
                            <p class="text-slate-600 mb-4">Kontrol stok, tracking barang, dan analisis inventory yang akurat.</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Tracking barang masuk/keluar</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Alert stok minimum</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Barcode scanner support</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Multi-gudang management</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-purple-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">Sistem Internal</h3>
                            <p class="text-slate-600 mb-4">Aplikasi custom untuk kebutuhan internal seperti HR, accounting, dan manajemen proyek.</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Employee management</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Payroll system</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Project tracking</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Document management</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-orange-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">Data Processing Tools</h3>
                            <p class="text-slate-600 mb-4">Tools untuk pengolahan dan analisis data secara efisien.</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Data import/export</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Advanced reporting</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Data visualization</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Automated workflows</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-24 bg-gradient-to-br from-slate-50 to-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Frequently Asked Questions</h2>
                <p class="text-xl text-slate-700">
                    Pertanyaan yang sering diajukan tentang layanan pengembangan aplikasi desktop
                </p>
            </div>

            <div x-data="{ openFaq: null }" class="space-y-4">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 1 ? null : 1"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-slate-900">Apa perbedaan aplikasi desktop dengan web application?</span>
                        <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-200" 
                             :class="{ 'rotate-180': openFaq === 1 }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 pb-4">
                        <p class="text-slate-600">Aplikasi desktop berjalan langsung di komputer dan dapat bekerja offline, memiliki performa lebih cepat, dan akses penuh ke sistem operasi. Sedangkan web application membutuhkan browser dan koneksi internet, namun lebih mudah diakses dari mana saja.</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 2 ? null : 2"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-slate-900">Berapa lama waktu pengembangan aplikasi desktop?</span>
                        <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-200" 
                             :class="{ 'rotate-180': openFaq === 2 }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 pb-4">
                        <p class="text-slate-600">Waktu pengembangan bervariasi tergantung kompleksitas: aplikasi sederhana 2-4 minggu, menengah 1-3 bulan, dan enterprise 3-6 bulan. Kami akan memberikan timeline yang jelas setelah analisis kebutuhan.</p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 3 ? null : 3"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-slate-900">Apakah aplikasi desktop bisa berjalan di Windows, Mac, dan Linux?</span>
                        <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-200" 
                             :class="{ 'rotate-180': openFaq === 3 }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 pb-4">
                        <p class="text-slate-600">Ya, dengan menggunakan teknologi cross-platform seperti Electron atau Qt, aplikasi dapat berjalan di berbagai sistem operasi. Kami akan menyesuaikan dengan kebutuhan target platform Anda.</p>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 4 ? null : 4"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-slate-900">Apakah aplikasi desktop memerlukan maintenance berkelanjutan?</span>
                        <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-200" 
                             :class="{ 'rotate-180': openFaq === 4 }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 pb-4">
                        <p class="text-slate-600">Ya, seperti software pada umumnya, aplikasi desktop memerlukan update berkala untuk bug fixes, security patches, dan penambahan fitur. Kami menyediakan paket maintenance dengan berbagai pilihan sesuai kebutuhan.</p>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <button 
                        @click="openFaq = openFaq === 5 ? null : 5"
                        class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-slate-900">Bagaimana dengan keamanan data pada aplikasi desktop?</span>
                        <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-200" 
                             :class="{ 'rotate-180': openFaq === 5 }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openFaq === 5" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 pb-4">
                        <p class="text-slate-600">Kami menerapkan enkripsi data, sistem autentikasi yang kuat, backup otomatis, dan best practices security lainnya. Data disimpan secara lokal di komputer sehingga lebih aman dari serangan online, plus ada kontrol akses yang ketat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Call-to-Action Section --}}
    <section class="py-24 bg-gradient-to-r from-[#128AEB] to-[#0F76C6]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Mengembangkan Aplikasi Desktop Anda?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Konsultasikan kebutuhan aplikasi desktop bisnis Anda dengan tim expert kami. Gratis konsultasi dan estimasi proyek.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-white text-[#128AEB] rounded-xl font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Konsultasi Gratis
                </a>
                <a href="#" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white rounded-xl font-semibold hover:bg-white hover:text-[#128AEB] transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Lihat Portfolio
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-3xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">50+</div>
                    <div class="text-white/80">Aplikasi Desktop</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">100%</div>
                    <div class="text-white/80">Client Satisfaction</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">24/7</div>
                    <div class="text-white/80">Support</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">3+</div>
                    <div class="text-white/80">Years Experience</div>
                </div>
            </div>
        </div>
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
