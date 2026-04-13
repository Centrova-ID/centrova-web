@extends('partials.layouts.main')

@section('title', 'Centrova - Solusi Digital untuk Bisnis Anda')

@section('seoMetaTags')
        <meta name="description" content="Centrova adalah startup teknologi Indonesia yang menyediakan solusi digital terintegrasi untuk bisnis. Kami menghadirkan layanan pengembangan website, aplikasi, dan sistem bisnis seperti POS, CRM, dan ERP untuk mendukung transformasi digital yang efisien dan berkelanjutan.">
        <meta name="keywords" content="Centrova, web service, layanan digital, pengembangan website, pengembangan aplikasi, sistem POS, CRM, ERP, transformasi digital, teknologi Indonesia, software bisnis">
        <meta name="robots" content="index, follow">
        <meta name="language" content="Indonesian">
        <meta name="author" content="Centrova Indonesia">

        {{-- Open Graph / Facebook --}}
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="Centrova - Solusi Digital untuk Bisnis Anda">
        <meta property="og:description" content="Centrova adalah startup teknologi Indonesia yang menyediakan solusi digital terintegrasi untuk bisnis. Kami menghadirkan layanan pengembangan website, aplikasi, dan sistem bisnis seperti POS, CRM, dan ERP untuk mendukung transformasi digital yang efisien dan berkelanjutan.">
        <meta property="og:image" content="{{ asset('images/centrova-og-image.jpg') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:site_name" content="Centrova Indonesia">
        <meta property="og:locale" content="id_ID">

        {{-- Twitter --}}
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="Centrova - Solusi Digital untuk Bisnis Anda">
        <meta property="twitter:description" content="Centrova adalah startup teknologi Indonesia yang menyediakan solusi digital terintegrasi untuk bisnis. Kami menghadirkan layanan pengembangan website, aplikasi, dan sistem bisnis seperti POS, CRM, dan ERP untuk mendukung transformasi digital yang efisien dan berkelanjutan.">
        <meta property="twitter:image" content="{{ asset('images/centrova-og-image.jpg') }}">
        <meta property="twitter:site" content="@centrova_id">
        <meta property="twitter:creator" content="@centrova_id">
@endsection

@section('link-head')
    {{-- Preconnect to common external image hosts --}}
    <link rel="preconnect" href="https://plus.unsplash.com">
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preconnect" href="https://lookaside.fbsbx.com">
@endsection

@section('content')

    <div class="relative">
        {{-- Main Hero --}}
        <div class="relative overflow-hidden">
            {{-- Background Video with overlay --}}
            <div class="absolute inset-0">
                <video autoplay muted loop playsinline class="w-full h-full object-cover">
                    <source src="https://www.mitrais.com/wp-content/uploads/2025/06/Homepage-Video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="absolute inset-0 w-full h-full bg-black/20"></div>
            </div>
            
            {{-- Content --}}
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 min-h-[650px] flex justify-center items-center text-white text-center">
                <div class="max-w-5xl space-y-6">
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                        Develop Today, Lead Tomorrow
                    </h1>
                    <p class="text-base sm:text-lg tracking-wide">
                        Membangun Masa Depan Digital Bisnis Anda Bersama Kami.
                    </p>
                </div>
            </div>
        </div>

        {{-- More Info --}}
        <div class="py-20">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-16 text-slate-900">
                <h1 class="text-4xl font-normal">Kami hadir untuk membantu mengonsep ulang bisnis Anda <br>di era digital.</h1>
                <p class="text-xl tracking-tight text-gray-700">Our brain-computer interface translates neural signals into actions. In our clinical trials, people are using Neuralink devices to control computers and robotic arms with their thoughts.
                    <br><br>
                This technology will restore autonomy to those with unmet medical needs and unlock new dimensions of human potential.</p>
            </div>
        </div>

        {{-- Layanan Kami --}}
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <h2 class="text-4xl font-semibold tracking-tight text-gray-900 leading-tight">
                            Sejumlah perusahaan memilih kami berkat rangkaian layanan komprehensif kami.
                        </h2>
                        <p class="text-lg text-gray-600 tracking-tight md:pt-2">
                            Rekam jejak yang terbukti dalam meningkatkan efisiensi, produktivitas, inovasi, dan pertumbuhan bisnis.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Custom Software Development --}}
                    <div class="group rounded-xl overflow-hidden bg-white border border-neutral-200 hover:shadow-md transition-shadow duration-200 p-8 flex flex-col gap-5">
                        <div class="w-12 h-12 rounded-xl bg-sky-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Custom Software Development</h3>
                            <p class="text-base text-gray-600 font-normal leading-relaxed">Membangun perangkat lunak khusus yang dirancang sesuai kebutuhan unik bisnis Anda — skalabel, andal, dan siap tumbuh bersama Anda.</p>
                        </div>
                        <a href="{{ localizedRoute('services.index') }}?utm_source=layanan_csd" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition mt-auto">
                            <span>Pelajari selengkapnya</span>
                            <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    {{-- Digital Transformation --}}
                    <div class="group rounded-xl overflow-hidden bg-white border border-neutral-200 hover:shadow-md transition-shadow duration-200 p-8 flex flex-col gap-5">
                        <div class="w-12 h-12 rounded-xl bg-sky-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Digital Transformation</h3>
                            <p class="text-base text-gray-600 font-normal leading-relaxed">Memandu bisnis Anda bertransisi ke era digital dengan strategi yang terencana, teknologi tepat guna, dan implementasi yang terukur.</p>
                        </div>
                        <a href="{{ localizedRoute('services.index') }}?utm_source=layanan_dt" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition mt-auto">
                            <span>Pelajari selengkapnya</span>
                            <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    {{-- System Integration --}}
                    <div class="group rounded-xl overflow-hidden bg-white border border-neutral-200 hover:shadow-md transition-shadow duration-200 p-8 flex flex-col gap-5">
                        <div class="w-12 h-12 rounded-xl bg-sky-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">System Integration</h3>
                            <p class="text-base text-gray-600 font-normal leading-relaxed">Menyatukan berbagai sistem dan platform yang Anda gunakan agar data mengalir mulus dan operasional bisnis berjalan tanpa hambatan.</p>
                        </div>
                        <a href="{{ localizedRoute('services.index') }}?utm_source=layanan_si" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition mt-auto">
                            <span>Pelajari selengkapnya</span>
                            <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    {{-- On-Demand Expertise --}}
                    <div class="group rounded-xl overflow-hidden bg-white border border-neutral-200 hover:shadow-md transition-shadow duration-200 p-8 flex flex-col gap-5">
                        <div class="w-12 h-12 rounded-xl bg-sky-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">On-Demand Expertise</h3>
                            <p class="text-base text-gray-600 font-normal leading-relaxed">Akses talenta teknologi terbaik kapan pun Anda butuhkan — dari developer hingga konsultan IT — tanpa biaya rekrutmen jangka panjang.</p>
                        </div>
                        <a href="{{ localizedRoute('services.index') }}?utm_source=layanan_ode" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition mt-auto">
                            <span>Pelajari selengkapnya</span>
                            <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mengapa Memilih Kami --}}
        <div class="py-16 bg-neutral-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14">
                    <h2 class="text-4xl font-semibold tracking-tight text-gray-900">Lebih dari Sekadar Vendor Teknologi</h2>
                </div>

                <div class="grid grid-cols-1 gap-8">
                    {{-- Alasan 1: Lebih dari Sekadar Pengembang --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden border border-neutral-100">
                        <div class="w-full h-full px-6 py-10 lg:py-16 lg:px-16 flex justify-center items-center">
                            <div class="w-full text-base lg:text-lg font-normal tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-4xl font-light mb-4">Lebih dari Sekadar Pengembang Perangkat Lunak</h3>
                                <p class="text-neutral-600 leading-relaxed">Kami adalah tempat terlengkap untuk semua yang Anda butuhkan dalam menghadirkan dan menumbuhkan bisnis Anda ke tingkat yang lebih tinggi secara online — mulai dari strategi, pengembangan, hingga dukungan purna jual.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=why_us_1"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Lihat Layanan Kami
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-100 aspect-video lg:aspect-auto">
                            <img src="{{ asset('assets/image/home/cs_20251017_17282871894827354.webp') }}" class="w-full h-full object-cover" alt="Tim Centrova - Lebih dari Pengembang" loading="lazy" decoding="async">
                        </div>
                    </div>

                    {{-- Alasan 2: Layanan dan Produk Terbaru --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden border border-neutral-100">
                        <div class="bg-neutral-100 aspect-video lg:aspect-auto order-2 lg:order-1">
                            <img src="{{ asset('assets/image/home/industri_software.jpg') }}" class="w-full h-full object-cover" alt="Solusi digital terbaru Centrova" loading="lazy" decoding="async">
                        </div>
                        <div class="w-full h-full px-6 py-10 lg:py-16 lg:px-16 flex justify-center items-center order-1 lg:order-2">
                            <div class="w-full text-base lg:text-lg font-normal tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-4xl font-light mb-4">Layanan dan Produk Terbaru yang Andal</h3>
                                <p class="text-neutral-600 leading-relaxed">Kami dilengkapi dengan solusi digital terbaru setiap saat dan paling sesuai untuk kebutuhan dan kinerja bisnis Anda — teknologi mutakhir yang terus kami perbarui agar Anda selalu selangkah lebih maju.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=why_us_2"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Lihat Produk Kami
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Alasan 3: Terbukti --}}
                    <div class="w-full bg-[#128AEB] rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-6 py-10 lg:py-16 lg:px-16 flex justify-center items-center">
                            <div class="w-full text-base lg:text-lg font-normal tracking-tight max-lg:text-center">
                                <h3 class="text-3xl lg:text-4xl font-light mb-4 text-white">Terbukti — Kepuasan Pelanggan 100%</h3>
                                <p class="text-sky-100 leading-relaxed">Produk dan layanan yang kami tawarkan telah terpercaya dan berhasil mencapai kepuasan pelanggan. Setiap proyek kami selesaikan dengan standar kualitas tertinggi dan komitmen penuh terhadap hasil yang melampaui ekspektasi.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=why_us_3"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-white text-base font-medium rounded-full text-white hover:bg-white hover:text-[#128AEB] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                        <div class="bg-[#0F76C6] aspect-video lg:aspect-auto flex items-center justify-center p-12">
                            <div class="text-center">
                                <p class="text-8xl lg:text-9xl font-bold text-white leading-none">100%</p>
                                <p class="text-xl font-medium text-sky-100 mt-4 tracking-wide">Kepuasan Pelanggan</p>
                                <p class="text-sky-200 mt-2 text-base">Berdasarkan survei kepuasan klien kami</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Industies --}}
        <div class="py-16 bg-neutral-100 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-semibold tracking-tight text-gray-900 mb-4">Mengembangkan Masa Depan Industri Anda</h2>
                </div>
                
                {{-- Industries List --}}
                <div class="grid grid-cols-1 gap-8">
                    {{-- Industri Software --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h1 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Industri Software</h1>
                                <p class="text-neutral-800">Berfokus pada kecepatan siklus pengembangan melalui metodologi Agile dan DevOps untuk menghasilkan produk yang stabil namun adaptif. Kuncinya adalah kolaborasi tim yang lancar dan otomatisasi sistem (CI/CD) agar peluncuran fitur baru bisa dilakukan secara instan tanpa hambatan teknis bagi pengguna.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_software"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-200 aspect-square">
                            <img src="{{ asset('assets/image/home/industri_software.jpg') }}" class="w-full h-full object-cover" alt="Industri Software">
                        </div>
                    </div>

                    {{-- Teknologi Keuangan --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="bg-neutral-200 aspect-square order-2 lg:order-1">
                            <img src="{{ asset('assets/image/home/industri_keuangan.jpg') }}" class="w-full h-full object-cover" alt="Teknologi Keuangan">
                        </div>
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center order-1 lg:order-2">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h1 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Teknologi Keuangan</h1>
                                <p class="text-neutral-800">Memberikan solusi transaksi digital yang aman, cepat, dan terintegrasi. Kami membantu membangun ekosistem pembayaran, manajemen aset, dan sistem perbankan digital untuk meningkatkan inklusi keuangan dan efisiensi operasional bisnis Anda.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_fintech"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Transportasi & Logistik --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h1 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Transportasi & Logistik</h1>
                                <p class="text-neutral-800">Optimalkan pergerakan barang dan orang dengan sistem pelacakan real-time, manajemen armada, dan integrasi rantai pasokan. Solusi kami dirancang untuk mengurangi biaya operasional dan mempercepat waktu pengiriman melalui efisiensi berbasis data.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_logistics"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-200 aspect-square">
                            <img src="{{ asset('assets/image/home/industri_transportasi_logistik.jpg') }}" class="w-full h-full object-cover" alt="Transportasi & Logistik">
                        </div>
                    </div>

                    {{-- Sektor Pendidikan --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="bg-neutral-200 aspect-square order-2 lg:order-1">
                            <img src="{{ asset('assets/image/home/sektor_pendidikan.jpg') }}" class="w-full h-full object-cover" alt="Sektor Pendidikan">
                        </div>
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center order-1 lg:order-2">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h1 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Sektor Pendidikan</h1>
                                <p class="text-neutral-800">Mendigitalisasi proses belajar mengajar dengan Learning Management Systems (LMS), platform ujian online, dan sistem administrasi sekolah yang terpadu untuk menciptakan pengalaman belajar yang lebih interaktif, inklusif, dan aksesibel bagi semua.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_education"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Medical System --}}
                    <div class="w-full bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
                        <div class="w-full h-full px-6 py-8 lg:py-20 lg:px-16 flex justify-center items-center">
                            <div class="w-full text-base lg:text-xl font-normal tracking-tight max-lg:text-center">
                                <h1 class="text-3xl lg:text-5xl font-light mb-3 lg:mb-10">Medical System</h1>
                                <p class="text-neutral-800">Solusi teknologi kesehatan profesional untuk manajemen data pasien (EMR), sistem janji temu, dan telemedis. Kami memprioritaskan privasi data, kepatuhan regulasi, dan kemudahan akses layanan kesehatan bagi masyarakat melalui inovasi digital.</p>
                                <a href="{{ localizedRoute('services.index') }}?utm_source=learn_medical"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                    Pelajari Lebih
                                </a>
                            </div>
                        </div>
                        <div class="bg-neutral-200 aspect-square">
                            <img src="{{ asset('assets/image/home/medical_system.jpg') }}" class="w-full h-full object-cover" alt="Medical System">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Featured Products Grid --}}
        <div class="pt-16 pb-10" id="produk">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="rounded-lg overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Tim mengembangkan layanan web - Centrova"
                        loading="lazy"
                        decoding="async"
                        width="870"
                        height="489"
                        class="w-full aspect-video object-cover">
                        <div class="px-6 py-6 flex flex-col justify-between text-gray-950">
                            <div>
                                <h3 class="text-xl font-semibold mb-3">Pengembangan Perangkat Lunak</h3>
                                <p class="text-base font-normal">Kami ahli dalam merancang solusi perangkat lunak berkualitas sesuai kebutuhan Anda.</p>
                            </div>
                            <a href="{{ route('services.index') }}" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition h-11">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-lg overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <img src="https://images.unsplash.com/photo-1667984390553-7f439e6ae401?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Infrastruktur dan arsitektur server"
                        loading="lazy"
                        decoding="async"
                        width="1032"
                        height="579"
                        class="w-full aspect-video object-cover">
                        <div class="px-6 py-6 flex flex-col justify-between text-gray-950">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-950 mb-1">Infrastruktur</h3>
                                <p class="text-base font-normal">Membangun infrastruktur TI yang kuat dan skalabel untuk mendukung bisnis Anda.</p>
                            </div>
                            <a href="/layanan/app-development" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition h-11">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-lg overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <img src="{{ asset('assets/image/home/cs_20251017_17282871894827354.webp') }}"
                        alt="Dukungan teknis tim Centrova"
                        loading="lazy"
                        decoding="async"
                        width="870"
                        height="489"
                        class="w-full aspect-video object-cover">
                        <div class="px-6 py-6 flex flex-col justify-between text-gray-950">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-950 mb-1">Dukungan</h3>
                                <p class="text-base font-normal mb-2">Memberikan dukungan terbaik untuk memastikan operasional TI Anda berjalan dengan lancar.</p>
                            </div>
                            <a href="{{ route('support.home') }}" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition h-11">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-lg overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                    <img src="{{ asset('assets/image/home/data_security_x7a3m2q9t0l5c1z8n6r4y3b9v1p7f0d5g2s6j8w4k9h1.webp') }}"
                        alt="Keamanan data dan privasi"
                        loading="lazy"
                        decoding="async"
                        width="870"
                        height="489"
                        class="w-full aspect-video object-cover">
                        <div class="px-6 py-6 flex flex-col justify-between text-gray-950">
                            <h3 class="text-xl font-semibold text-gray-950 mb-1">Keamanan Data</h3>
                            <p class="text-base text-gray-900 font-normal mb-2">Menjaga keamanan dan kerahasiaan data bisnis penting Anda.</p>
                            <a href="{{ route('legal.privacy') }}" class="inline-flex items-center text-[#128AEB] font-medium hover:underline transition h-11">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Penawaran Section --}}
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Hero Box -->
                <div class="w-full bg-sky-100 rounded-xl min-h-[400px] lg:h-[540px] flex items-center justify-center lg:justify-start relative overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="w-full flex justify-center items-center h-full z-10 px-24 py-10">
                            <div class="flex flex-col max-md:items-center max-md:text-center">
                                <h2 class="font-semibold text-gray-900 text-3xl sm:text-4xl mt-2 leading-snug">
                                    Ubah Ide Anda Menjadi Kenyataan
                                </h2>
                                <p class="text-gray-900 mt-4 text-base sm:text-lg">
                                    Mulailah bangun rumah online Anda dengan memiliki website untuk merek Anda.
                                </p>
                                <div>
                                    <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                                        Dapatkan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute w-full h-full">
                        <img src="{{ asset('assets/image/home/a2d67684-5efc-6ad8-2cb3-6034d420e88cba88d902848fa4415ffca75da09a257e0c938ac6.webp') }}" class="h-full object-cover w-full" alt="Ilustrasi pembuatan website - Centrova" loading="lazy" decoding="async">
                    </div>
                </div>

                {{-- Cards Section --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-12">
                    {{-- Card 1 --}}
                    <div class="w-full px-4 sm:px-8 lg:px-16">
                        <img src="https://www.exabytes.co.id/wp-content/uploads/product-icon-ecommerce-1-1.svg" alt="E-commerce Icon" class="h-[79px] mb-5 mx-0">
                        <span class="text-base text-slate-900 block text-left">Jasa Pembuatan Toko Online</span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2 mb-3 text-left">
                            Segalanya Dimulai dari Toko Online
                        </h3>
                        <p class="text-slate-700 text-left">
                            Kami siap membantu Anda membangun toko online yang sesuai dengan kebutuhan Anda. Tingkatkan kehadiran digital bisnis Anda dan capai lebih banyak pelanggan secara online bersama kami!
                        </p>
                        <div class="flex justify-start">
                                     <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                                         class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-400 hover:border-[#128AEB] text-base font-semibold rounded-full text-sky-700 hover:text-[#128AEB] transition duration-150 mt-8 min-h-[44px]">
                                Coba Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 2 --}}
                    <div class="w-full px-4 sm:px-8 lg:px-16">
                        <img src="https://www.exabytes.co.id/wp-content/uploads/product-icon-hosting-2.svg" alt="Hosting Icon" class="h-[79px] mb-5 mx-0">
                        <span class="text-base text-slate-900 block text-left">Website Profil Perusahaan</span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2 mb-3 text-left">
                            Hosting Website di Tempat yang Tepat, Aman & Cepat
                        </h3>
                        <p class="text-slate-700 text-left">
                            Layanan kami menyertakan backup harian untuk file web Anda dan menggunakan server super cepat yang didedikasikan khusus untuk kebutuhan Anda. Percayakan keberhasilan online Anda pada layanan hosting terbaik kami!
                        </p>
                        <div class="flex justify-start">
                                     <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                                         class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-400 hover:border-[#128AEB] text-base font-semibold rounded-full text-sky-700 hover:text-[#128AEB] transition duration-150 mt-8 min-h-[44px]">
                                Coba Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Paket Lengkap Section --}}
        <div class="py-10 hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Hero Box -->
                <div class="w-full bg-sky-100 rounded-[36px] min-h-[400px] lg:h-[540px] flex items-center justify-center lg:justify-start relative overflow-hidden">
                    <div class="absolute w-full h-full">
                            <img src="{{ asset('assets/image/home/f416765167bbdf72.webp') }}" class="h-full bg-cover w-full" alt="Paket layanan Centrova" loading="lazy" decoding="async">
                        </div>
                    <div class="max-w-md h-full flex flex-col justify-center text-center lg:text-left z-10 p-8 sm:p-12 lg:p-16">
                        <span class="text-base font-medium text-slate-900">Jasa Desain Website</span>
                        <h2 class="font-bold text-slate-900 text-3xl sm:text-4xl mt-2 leading-snug">
                            Paket Design <br> Web Super Lengkap
                        </h2>
                        <p class="text-slate-800 mt-4 text-base sm:text-lg">
                            Dapatkan website profesional yang memperkuat brand dan meningkatkan penjualan.
                        </p>
                        <div>
                            <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                           class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8 min-h-[44px] tracking-normal">
                            Dapatkan Sekarang</a>
                        </div>
                    </div>
                </div>

                {{-- Cards Section. Reff: https://www.exabytes.co.id/design --}}
                <div class="grid grid-cols-4 gap-7 mt-12">
                    {{-- Feature: Gratis Nama Domain --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h3 class="text-xl font-medium mb-5">Gratis Nama Domain</h3>
                        <p class="text-base text-slate-800">Pilih nama domain .COM / .ID / .CO.ID gratis saat Anda membuat website bersama kami.</p>
                    </div>

                    {{-- Feature: Personalisasi Sesuai Keinginan --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h3 class="text-xl font-medium mb-5">Personalisasi Sesuai Keinginan</h3>
                        <p class="text-base text-slate-800">Desain profesional dan copywriting yang dibuat khusus untuk merek dan tujuan bisnis Anda.</p>
                    </div>

                    {{-- Feature: Dioptimalkan Untuk SEO & Mobile --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h3 class="text-xl font-medium mb-5">Dioptimalkan untuk SEO & Mobile</h3>
                        <p class="text-base text-slate-800">Website SEO-friendly dan responsif di semua perangkat untuk meningkatkan visibilitas dan konversi.</p>
                    </div>

                    {{-- Feature: Dasbor Ramah Pengguna --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h3 class="text-xl font-medium mb-5">Dasbor Ramah Pengguna</h3>
                        <p class="text-base text-slate-800">Kelola konten dan update website dengan mudah lewat dasbor intuitif tanpa perlu keahlian teknis.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Latest Insights Section --}}
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Terbaru dari Centrova</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <article class="overflow-hidden">
                        <a href="{{ route('news.home') }}">
                            <div class="aspect-video bg-neutral-200 overflow-hidden rounded-3xl relative">
                                <img src="https://lookaside.fbsbx.com/elementpath/media/?media_id=1320873176424839&version=1757543352&transcode_extension=webp" alt="Ilustrasi transformasi digital" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            </div>
                            <div class="pt-6">
                                <h3 class="text-xl text-slate-900">5 Tren Digital Transformation yang Harus Diketahui di 2024</h3>
                            </div>
                        </a>
                    </article>
                    
                    <article class="overflow-hidden">
                        <a href="{{ route('news.home') }}">
                            <div class="aspect-video bg-neutral-200 overflow-hidden rounded-3xl relative">
                                <img src="https://lookaside.fbsbx.com/elementpath/media/?media_id=1531311658047829&version=1757543328&transcode_extension=webp" alt="Ilustrasi business analytics dan data" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            </div>
                            <div class="pt-6">
                                <h3 class="text-xl text-slate-900">Mengoptimalkan Business Intelligence dengan Data Analytics</h3>
                            </div>
                        </a>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection