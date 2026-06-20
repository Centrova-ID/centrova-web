{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Jasa Pembuatan Aplikasi Desktop Profesional - Centrova')

{{-- Navbar --}}
@section('navbar')
    @include('partials.navbar.services')
    @include('partials.navbar.subnavbar.services', [
        'servicesLinkText' => 'App Development',
        'servicesLinkUrl' => route('services.app.index'),
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
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="index, follow, max-image-preview:large"/>
    <meta property="og:description" content="Centrova menyediakan jasa pembuatan aplikasi desktop profesional untuk bisnis. Aplikasi POS, inventory, CRM, dan sistem internal yang handal dan efisien!"/>
    <meta name="twitter:site" content="@centrovaid"/>
    <meta property="og:title" content="Jasa Pembuatan Aplikasi Desktop Profesional | Centrova"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="og:site_name" content="Centrova Indonesia"/>
    <meta property="og:image" content="https://centrova.id/assets/image/services/app-development/og-image.jpg"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://centrova.id/services/app"/>
    <meta name="description" content="Jasa pembuatan aplikasi desktop profesional berbasis Electron, Python, atau PHP. Solusi POS, inventory management, dan sistem internal untuk bisnis Anda!"/>
    <link rel="canonical" href="https://centrova.id/services/app"/>
@endsection

{{-- Critical CSS --}}
@section('style-css')
    <style>
        [x-cloak]{display:none!important}
        .scrollbar-hide{scrollbar-width:none;-ms-overflow-style:none}
        .scrollbar-hide::-webkit-scrollbar{display:none}
        .lazy-bg{background-color:#f3f4f6}
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
    <section class="w-full bg-white py-16 pt-32">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="max-w-3xl">
                <h1 class="text-[3.6rem] max-lg:text-[3rem] max-md:text-[2.6rem] leading-snug font-bold mb-6 text-slate-900">Aplikasi Desktop untuk Bisnis Anda</h1>
                <p class="text-xl max-md:text-lg leading-snug text-neutral-700 mb-6">Solusi aplikasi desktop profesional berbasis Electron, Python, atau PHP untuk kebutuhan Point of Sale (POS), manajemen inventory, sistem kasir, atau operasional internal perusahaan yang efisien dan handal.</p>
                <a href="#konsultasi" 
                aria-label="Hubungi kami untuk konsultasi aplikasi desktop gratis"
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
                    Kenapa Memilih Aplikasi Desktop dari Centrova?
                </h2>
            </div>

            <div class="grid grid-cols-3 max-lg:grid-cols-1 text-slate-900 gap-12">
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Performa Tinggi & Efisien</h1>
                    <p class="text-gray-600 text-lg">Aplikasi desktop yang kami kembangkan dioptimalkan untuk performa maksimal. Berjalan lancar tanpa lag, bahkan dengan data yang kompleks dan volume transaksi tinggi.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Dapat Bekerja Offline</h1>
                    <p class="text-gray-600 text-lg">Tidak perlu khawatir koneksi internet bermasalah. Aplikasi dapat berfungsi penuh secara offline dengan sinkronisasi otomatis saat online kembali.</p>
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="font-medium text-xl mb-5">Keamanan Data Terjamin</h1>
                    <p class="text-gray-600 text-lg">Data bisnis Anda tersimpan aman dengan sistem enkripsi dan backup otomatis. Dilengkapi fitur autentikasi dan kontrol akses multi-level untuk keamanan maksimal.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Separator --}}
    <div class="w-full h-[6px] flex"><div class="w-full bg-[#128AEB] h-full"></div><div class="w-full bg-sky-500 h-full"></div><div class="w-[30%] bg-sky-300 h-full"></div></div>

    {{-- Jenis Aplikasi yang Tersedia --}}
    @push('styles')
        @once
        <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></noscript>
        @endonce
    @endpush
    <section id="layanan" class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-16" x-data="appServicesSection">
        {{-- Heading --}}
        <div class="text-left mb-8">
            <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-neutral-900 mb-3 leading-snug">
                Jenis Aplikasi Desktop yang Kami Kembangkan
            </h2>
            <p class="text-base text-lg text-slate-700 md:max-w-4xl">
                Berbagai solusi aplikasi desktop yang dapat disesuaikan dengan kebutuhan bisnis Anda
            </p>
        </div>
        
        <div class="w-full max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="(item, idx) in services" :key="idx">
                <div class="bg-white rounded-2xl border border-neutral-200 shadow hover:shadow-md transition-all duration-300 p-6">
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-[#128AEB]/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x-html="item.icon"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2" x-text="item.title"></h3>
                    <p class="text-gray-600 text-base" x-text="item.description"></p>
                </div>
            </template>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('appServicesSection', () => ({
                    services: [
                        {
                            title: 'Aplikasi Point of Sale (POS)',
                            description: 'Sistem kasir lengkap dengan manajemen transaksi, inventory terintegrasi, laporan penjualan real-time, dan support untuk hardware kasir seperti barcode scanner dan printer thermal.',
                            icon: 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'
                        },
                        {
                            title: 'Sistem Inventory Management',
                            description: 'Kelola stok barang dengan mudah. Fitur tracking real-time, notifikasi stok minimum, multi-warehouse, barcode scanning, dan laporan pergerakan barang yang detail.',
                            icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'
                        },
                        {
                            title: 'CRM & Customer Management',
                            description: 'Aplikasi manajemen pelanggan untuk mengelola data customer, tracking interaksi, follow-up activities, sales pipeline, dan analisis performance sales team.',
                            icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
                        },
                        {
                            title: 'HR & Payroll System',
                            description: 'Sistem manajemen kepegawaian lengkap dengan absensi, pengelolaan cuti, perhitungan gaji otomatis, slip gaji digital, dan tracking performance karyawan.',
                            icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'
                        },
                        {
                            title: 'Accounting & Finance System',
                            description: 'Aplikasi akuntansi untuk pengelolaan keuangan bisnis. Jurnal otomatis, laporan keuangan lengkap, pembukuan multi-currency, dan budget planning.',
                            icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
                        },
                        {
                            title: 'Custom Business Application',
                            description: 'Solusi aplikasi desktop custom yang dikembangkan khusus sesuai workflow dan kebutuhan spesifik bisnis Anda. Dari konsep hingga implementasi.',
                            icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
                        }
                    ]
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    {{-- Sudah Saatnya --}}
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Digitalisasi Operasional Bisnis Anda
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Tingkatkan efisiensi, kurangi human error, dan optimalkan proses bisnis dengan aplikasi desktop yang tepat.
                </p>
            </div>

            <div class="w-full mt-10 md:mt-16 flex flex-col-reverse md:flex-row items-center justify-between gap-10 md:gap-16">
                <div class="text-center md:text-left max-w-xl">
                    <h2 class="text-slate-900 font-medium text-2xl sm:text-3xl mb-4 sm:mb-6 leading-snug">Aplikasi yang Memahami Alur Kerja Bisnis Anda</h2>
                    <p class="text-base sm:text-lg text-slate-600">Centrova mengembangkan aplikasi desktop yang tidak hanya powerful secara teknis, tetapi juga intuitif dan mudah digunakan oleh tim Anda. Kami memahami bahwa setiap bisnis memiliki alur kerja yang unik, sehingga aplikasi kami dirancang dengan fleksibilitas tinggi untuk menyesuaikan kebutuhan operasional spesifik Anda. Dengan fitur offline-first, data Anda tetap aman dan dapat diakses kapan saja tanpa bergantung pada koneksi internet.</p>
                </div>

                <img src="{{ asset('/assets/image/services/app-development/section_1.png') }}"
                    alt="Ilustrasi aplikasi desktop profesional"
                    class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-lg flex-shrink-0" loading="lazy"
                    decoding="async" />
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Proses Pengembangan --}}
    <section class="w-full overflow-hidden py-32 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 flex flex-col items-center">
            <div class="max-w-4xl mx-auto text-center mb-12 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-neutral-900 mb-3 leading-snug">
                    Proses Pengembangan Aplikasi
                </h2>
                <p class="text-base sm:text-lg md:text-xl text-slate-700 max-w-2xl mx-auto">
                    Dari konsultasi awal hingga deployment dan maintenance, kami dampingi setiap langkah proyek Anda.
                </p>
            </div>

            <div class="w-fill mt-10 md:mt-16 flex flex-col md:flex-row items-center justify-between gap-10 md:gap-16">
                <img src="https://teleporthq.io/Website%20dev%20service/website-development-service-how-it-works-1200w.png"
                    alt="Proses pengembangan aplikasi desktop"
                    class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-lg flex-shrink-0" loading="lazy"
                    decoding="async" />

                <div class="text-center text-left max-w-xl">
                    <div class="flex items-start gap-4 mb-6 text-left">
                        <div class="flex-shrink-0 w-8 h-8 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-sm">1</div>
                        <div>
                            <h4 class="text-slate-900 font-semibold text-lg mb-2">Analisis Kebutuhan & Konsultasi</h4>
                            <p class="text-slate-600 text-base">Kami mendengarkan kebutuhan bisnis Anda secara detail. Memahami workflow existing, pain points, dan requirement fitur yang diinginkan untuk merancang solusi yang tepat sasaran.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 mb-6 text-left">
                        <div class="flex-shrink-0 w-8 h-8 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-sm">2</div>
                        <div>
                            <h4 class="text-slate-900 font-semibold text-lg mb-2">Design & Development</h4>
                            <p class="text-slate-600 text-base">Tim kami merancang UI/UX yang intuitif, kemudian membangun aplikasi dengan teknologi modern. Anda akan mendapat progress report berkala dan kesempatan untuk testing di setiap tahap development.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 text-left">
                        <div class="flex-shrink-0 w-8 h-8 bg-[#128AEB] text-white rounded-full flex items-center justify-center font-semibold text-sm">3</div>
                        <div>
                            <h4 class="text-slate-900 font-semibold text-lg mb-2">Testing, Deployment & Training</h4>
                            <p class="text-slate-600 text-base">Setelah QA testing menyeluruh, kami deploy aplikasi ke device Anda dan memberikan training komprehensif kepada tim. After-sales support dan maintenance juga tersedia untuk memastikan aplikasi berjalan optimal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Paket & Harga --}}
    <section id="harga" x-data="pricingSection" class="py-32 max-md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Paket & Estimasi Harga</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto">
                    Pilih paket yang sesuai dengan kebutuhan dan kompleksitas aplikasi bisnis Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="(plan, index) in plans" :key="index">
                    <div class="relative bg-white text-slate-900 border border-slate-200 rounded-3xl p-8 hover:shadow-sm transition-all duration-500">
                        <div class="text-center mb-4">
                            <h3 class="text-3xl font-bold mb-4" x-text="plan.name"></h3>
                            <div class="mb-4">
                                <span class="text-3xl font-semibold" x-text="plan.price"></span>
                            </div>
                            <p class="text-slate-600" x-text="plan.description"></p>
                        </div>

                        <button @click="selectPlan(plan)" 
                            class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-2 rounded-full transition flex items-center w-full justify-center text-center mb-8">
                            Pilih Paket
                        </button>

                        <ul class="space-y-3">
                            <template x-for="feature in plan.features" :key="feature">
                                <li class="flex items-start text-sm">
                                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0 text-[#128AEB]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span x-text="feature"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </template>
            </div>
        </div>

        @push('scripts')
        @once
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('pricingSection', () => ({
                    plans: [
                        {
                            name: 'Basic POS',
                            price: 'Rp 5.000.000',
                            description: 'Solusi kasir sederhana untuk usaha kecil dengan fitur dasar yang lengkap.',
                            features: [
                                'Sistem kasir & transaksi',
                                'Manajemen produk & stok basic',
                                'Laporan penjualan harian',
                                'Backup otomatis',
                                '1 user/kasir',
                                'Support barcode scanner & printer',
                                '3 bulan support teknis'
                            ]
                        },
                        {
                            name: 'Professional',
                            price: 'Rp 12.000.000',
                            description: 'Aplikasi bisnis lengkap untuk operasional skala menengah dengan fitur advanced.',
                            features: [
                                'Semua fitur Basic',
                                'Multi-user & role management',
                                'Inventory management lengkap',
                                'Customer management (CRM)',
                                'Laporan analytics & dashboard',
                                'Integrasi API eksternal',
                                '6 bulan support & maintenance'
                            ],
                            featured: true
                        },
                        {
                            name: 'Enterprise Custom',
                            price: 'Mulai Rp 25jt',
                            description: 'Solusi aplikasi custom yang dikembangkan sepenuhnya sesuai kebutuhan bisnis Anda.',
                            features: [
                                'Custom development sesuai requirement',
                                'Unlimited users & devices',
                                'Multi-branch/warehouse support',
                                'Advanced reporting & BI dashboard',
                                'API integration penuh',
                                'Cloud sync & mobile companion app',
                                '12 bulan premium support',
                                'Training & documentation lengkap'
                            ]
                        }
                    ],
                    selectPlan(plan) {
                        const phoneNumber = '6285817909560';
                        let message = `Halo, saya tertarik dengan paket *${plan.name}* untuk layanan App Development.\n\n`;
                        message += `Detail Paket:\n`;
                        message += `• Harga: ${plan.price}\n`;
                        message += `• Deskripsi: ${plan.description}\n\n`;
                        message += `Mohon informasi lebih lanjut. Terima kasih!`;
                        const encodedMessage = encodeURIComponent(message);
                        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
                        window.open(whatsappUrl, '_blank');
                    }
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

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
                        <button @click="toggleFaq(index)" class="w-full py-4 text-left flex items-center justify-between focus:z-20 my-0.5 transition-colors gap-2">
                            <span class="font-semibold text-sky-700 text-xl sm:text-2xl leading-snug sm:leading-normal flex-wrap sm:flex-nowrap max-w-[80%]" x-text="faq.question"></span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-300 flex-shrink-0" :class="{ 'rotate-180': openFaq === index }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="openFaq === index"
                            x-transition:enter="transition-[max-height] duration-[600ms] ease-in"
                            x-transition:leave="transition-[max-height] duration-[600ms] ease-out"
                            x-transition:enter-start="max-h-0" x-transition:enter-end="max-h-[300px]"
                            x-transition:leave-start="max-h-[300px]" x-transition:leave-end="max-h-0"
                            class="overflow-hidden will-change-transform will-change-opacity will-change-scroll-position">
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
                            question: 'Teknologi apa yang digunakan untuk pengembangan aplikasi?',
                            answer: 'Kami menggunakan teknologi modern seperti Electron (JavaScript), Python dengan PyQt/Kivy, atau PHP desktop dengan framework seperti Laravel. Pilihan teknologi disesuaikan dengan requirement dan preferensi teknis klien.'
                        },
                        {
                            question: 'Apakah aplikasi dapat berjalan di Windows, Mac, dan Linux?',
                            answer: 'Ya, aplikasi berbasis Electron atau Python dapat di-compile untuk ketiga platform. Untuk aplikasi PHP desktop, support multi-platform juga tersedia dengan konfigurasi yang sesuai.'
                        },
                        {
                            question: 'Berapa lama waktu pengembangan aplikasi desktop?',
                            answer: 'Tergantung kompleksitas. Aplikasi sederhana seperti POS basic: 4-6 minggu. Aplikasi dengan fitur lengkap: 2-3 bulan. Enterprise custom: 3-6 bulan. Timeline lengkap akan dijelaskan di tahap konsultasi.'
                        },
                        {
                            question: 'Apakah data aman jika aplikasi bekerja offline?',
                            answer: 'Sangat aman. Data tersimpan lokal dengan enkripsi, dilengkapi backup otomatis. Ketika online, ada opsi sinkronisasi ke cloud server dengan protokol keamanan tinggi.'
                        },
                        {
                            question: 'Apakah aplikasi bisa di-update di kemudian hari?',
                            answer: 'Ya, aplikasi dirancang modular sehingga mudah untuk update dan penambahan fitur. Kami juga menyediakan layanan maintenance dan development berkelanjutan untuk kebutuhan upgrade.'
                        },
                        {
                            question: 'Apakah bisa integrasi dengan hardware seperti printer thermal atau barcode scanner?',
                            answer: 'Tentu. Kami support integrasi dengan berbagai hardware kasir: printer thermal, barcode scanner, cash drawer, card reader, dan perangkat lainnya yang umum digunakan di bisnis retail/F&B.'
                        },
                        {
                            question: 'Bagaimana sistem pembayaran pengembangan aplikasi?',
                            answer: 'Pembayaran dibagi dalam termin: 30% DP saat project dimulai, 40% saat prototype selesai dan disetujui, 30% saat aplikasi final delivery. Detail payment terms ada di proposal project.'
                        },
                        {
                            question: 'Apakah ada demo atau trial sebelum pembelian?',
                            answer: 'Ya, kami akan membuat prototype/demo sesuai requirement Anda untuk di-review sebelum lanjut ke development penuh. Ini memastikan aplikasi sesuai ekspektasi sebelum investasi besar dilakukan.'
                        }
                    ],
                    toggleFaq(index) {
                        this.openFaq = this.openFaq === index ? null : index;
                    }
                }));
            });
        </script>
        @endonce
        @endpush
    </section>

    {{-- CTA Konsultasi --}}
    <div id="konsultasi" class="text-center py-32 max-md:py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-semibold text-slate-900 mb-4">
                Konsultasi Gratis Kebutuhan Aplikasi Desktop Anda
            </h3>
            <p class="text-slate-600 text-base sm:text-lg mb-6">
                Diskusikan kebutuhan bisnis Anda dengan tim expert kami. Dapatkan solusi aplikasi desktop yang tepat.
            </p>
            <button onclick="window.open('{{ route('support.web.consult') }}', '_blank')"
                class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-semibold px-6 py-3 rounded-full transition flex items-center justify-center mx-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Hubungi Kami
            </button>
        </div>
    </div>

    {{-- Quick Links --}}
    <section class="w-full pt-10 bg-neutral-100" x-data="quickLinksSection">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <h1 class="font-semibold text-2xl mb-4">Quick Links</h1>
            <div class="flex justify-start gap-3 items-center w-full border-b border-neutral-300 pb-10 flex-wrap">
                <template x-for="(link, index) in quickLinks" :key="index">
                    <a :href="link.url" :target="link.target || '_self'"
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
                        { text: "Konsultasi Gratis", url: "{{ route('support.web.consult') }}", target: "_blank" },
                        { text: "Pusat Bantuan", url: "{{ route('support.services.home') }}", target: "_self" },
                        { text: "Pembatalan Layanan", url: "{{ route('services.cancellation.index') }}", target: "_self" },
                    ]
                }));
            });
        </script>
        @endonce
        @endpush
    </section>
@endsection
