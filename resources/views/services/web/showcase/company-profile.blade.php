{{-- Layout --}}
@extends('partials.layouts.main')

{{-- Title --}}
@section('title', 'Jasa Pembuatan Website Company Profile Murah & Profesional | Centrova.id')

{{-- Navbar --}}
@section('navbar')
    {{-- Navbar --}}
    @include('partials.navbar.services-web')
@endsection

{{-- SEO & Meta Tags --}}
@section('seoMetaTags')
    @include('partials.seo.service-page', [
        'service_name' => 'Jasa Pembuatan Website Company Profile',
        'service_description' => 'Layanan pembuatan website company profile profesional dengan desain responsif, optimasi SEO, dan performa loading cepat',
        'service_price' => '699000',
        'service_category' => 'Website Development',
        'service_keywords' => 'jasa pembuatan website company profile, pembuatan website perusahaan, website company profile murah, jasa website profesional, pembuatan web company profile, desain website perusahaan, website bisnis murah, jasa web development, website responsive, centrova',
        'title' => 'Jasa Pembuatan Website Company Profile Murah & Profesional | Centrova.id',
        'description' => 'Jasa pembuatan website company profile murah & profesional. Desain responsif, SEO ready, loading cepat. Harga mulai 500rb. Konsultasi gratis! ☎️ 085817909560',
        'canonical_url' => 'https://centrova.id/services/web/showcase/company-profile',
        'og_image' => 'https://centrova.id/assets/image/services/web-development/og-image.jpg',
        'preload_data' => '/data/services-data.json',
        'prefetch_urls' => [
            'https://centrova.id/services',
            'https://centrova.id/contact'
        ],
        'breadcrumbs' => [
            ['name' => 'Home', 'url' => 'https://centrova.id'],
            ['name' => 'Services', 'url' => 'https://centrova.id/services'],
            ['name' => 'Web Development', 'url' => 'https://centrova.id/services/web'],
            ['name' => 'Company Profile Website', 'url' => 'https://centrova.id/services/web/showcase/company-profile']
        ],
        'faq_data' => [
            [
                'question' => 'Berapa harga jasa pembuatan website company profile?',
                'answer' => 'Harga jasa pembuatan website company profile mulai dari Rp 699.000 dengan fitur lengkap, desain responsif, dan optimasi SEO.'
            ],
            [
                'question' => 'Berapa lama proses pembuatan website company profile?',
                'answer' => 'Proses pembuatan website company profile membutuhkan waktu 3-7 hari kerja tergantung kompleksitas dan kebutuhan fitur.'
            ],
            [
                'question' => 'Apakah website yang dibuat sudah SEO friendly?',
                'answer' => 'Ya, semua website company profile yang kami buat sudah dioptimasi untuk SEO agar mudah ditemukan di mesin pencari Google.'
            ],
            [
                'question' => 'Apakah website sudah mobile-friendly dan responsive?',
                'answer' => 'Ya, semua website company profile yang kami buat sudah responsive dan mobile-friendly, optimal di semua perangkat.'
            ],
            [
                'question' => 'Apakah mendapat source code website setelah selesai?',
                'answer' => 'Ya, setelah project selesai dan pelunasan, Anda akan mendapat seluruh source code website beserta dokumentasinya.'
            ]
        ]
    ])
@endsection

{{-- External CSS --}}
@section('link-head')
    <link rel="stylesheet" href="{{ asset('css/company-profile.css') }}">
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="w-full bg-white pt-32 max-md:pt-16">
        <div class="w-full max-w-6xl mx-auto px-4">
            <div 
                class="w-full max-w-6xl mx-auto flex flex-col items-center justify-center text-center" 
                data-aos="fade-up" 
                data-aos-duration="700" 
                data-aos-once="true" 
                data-aos-offset="10"
            >
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold text-slate-900 leading-tight">
                  Jasa Website <span class="text-[#128AEB]">Murah dan Profesional</span> untuk Perusahaan Anda!
                </h1>
                <p class="text-sm sm:text-base md:text-lg max-w-3xl my-7 text-slate-700">
                    Buat website yang menarik, fungsional, dan sesuai kebutuhan bisnis Anda. Nikmati harga terjangkau dengan hasil cepat dan berkualitas dari tim ahli kami.
                </p>

                <div class="flex items-center gap-x-5 mt-5">
                    <a href="https://wa.me/6285817909560?text=Halo%20Centrova,%20saya%20tertarik%20dengan%20jasa%20pembuatan%20website%20company%20profile.%20Bisakah%20kita%20diskusi%20lebih%20lanjut?" target="_blank" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-medium px-7 py-3.5 rounded-full transition flex items-center text-base justify-center">Pesan Sekarang</a>
                    <a href="#packages" class="bg-transparent hover:bg-[#0f75c6] text-[#128AEB] hover:text-white font-medium px-7 py-3.5 rounded-full border-2 border-[#128AEB] hover:border-[#0f75c6] transition flex items-center text-base justify-center">Lihat Paket</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Showcase Frames Section --}}
    <section class="w-full bg-white overflow-x-hidden pt-32 pb-20 max-md:py-16">
        <div class="w-full max-w-7xl mx-auto">

            <!-- Animated Frames Container -->
            <div class="relative overflow-visible" x-data="showcaseFrames" x-init="init()">
                <!-- Desktop View -->
                <div class="hidden lg:flex gap-6 transition-transform duration-300 ease-out justify-center items-center min-h-[500px]" 
                     :style="'transform: translateX(' + scrollOffset + 'px)'">
                    
                    <!-- Frame 1 - Desktop -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-video w-auto rounded-xl">
                        <img src="{{ asset('assets/image/services/web-development/web-company-profile/CNs2eplv76z8jP-JwFcytnUDaAgVqXLuO0ZIYW9m3RfTE1h5S_GHMiB4dbkoKQxr.png') }}" class="w-full h-full object-cover object-top">
                    </div>

                    <!-- Frame 2 - Mobile -->
                    <div id="frame-2" class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-[9/16] w-auto rounded-xl transition-transform duration-500 ease-out"
                         :style="'transform: translateY(' + frame2Offset + 'px)'">
                        <img src="{{ asset('assets/image/services/web-development/web-company-profile/wMeFg842SPuEvAYz6ktjiXNbCOHa9Tfx73RB0symo_Ld-hI1rGZpVUc5lDqJWKQn.png') }}" class="w-full h-full object-cover object-top">
                    </div>

                    <!-- Frame 3 - Desktop -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-video w-auto rounded-xl">
                        <img src="{{ asset('assets/image/services/web-development/web-company-profile/FaYv6P52ixEIGtTqJe-wKClypumQHgz7NjAhb_ZSMX3Vc0fWUDO1dnLR9s8kr4Bo.png') }}" class="w-full h-full object-cover object-top">
                    </div>

                    <!-- Frame 4 - Mobile -->
                    <div id="frame-4" class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-[9/16] w-auto rounded-xl transition-transform duration-500 ease-out"
                         :style="'transform: translateY(' + frame4Offset + 'px)'">
                        <img src="{{ asset('assets/image/services/web-development/web-company-profile/3my1DrdUCksRK2I_xAGPvMu4pVFQTZNlX8athEbweW6gq7HBzjLS5ofiY0-cOnJ9.png') }}" class="w-full h-full object-cover object-top">
                    </div>

                    <!-- Frame 5 - Desktop -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[420px] aspect-video w-auto rounded-xl">
                        <img src="{{ asset('assets/image/services/web-development/web-company-profile/ulVnvQ6DkP1r4O3EBUJHSdCTm8yix_WqLwpAN5c72zhtMRos-FgZ0faKebIGjY9X.png') }}" class="w-full h-full object-cover object-top">
                    </div>

                </div>

                <!-- Mobile View - 3 frames: desktop, mobile (center), desktop -->
                <div class="lg:hidden flex justify-center items-center min-h-[500px] overflow-hidden">
                    <!-- Left Desktop Frame (partial view) -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[280px] aspect-video w-auto rounded-xl opacity-40 -translate-x-5">
                        <img src="{{ asset('assets/image/services/web-development/web-company-profile/ulVnvQ6DkP1r4O3EBUJHSdCTm8yix_WqLwpAN5c72zhtMRos-FgZ0faKebIGjY9X.png') }}" class="w-full h-full object-cover object-top">
                    </div>

                    <!-- Center Mobile Frame (main focus) -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[480px] aspect-[9/16] w-auto rounded-xl shadow-lg z-10">
                        <img src="{{ asset('assets/image/services/web-development/web-company-profile/vBFgNpCytRWLXqAoXMUEKJpOahY39dTNxtMJULC_fv7OwRgKXNMBTECpqloYMRJubCwaFnsXt93Pk18.png') }}" class="w-full h-full object-cover object-top">
                    </div>

                    <!-- Right Desktop Frame (partial view) -->
                    <div class="bg-white flex-shrink-0 border border-gray-200 overflow-hidden h-[280px] aspect-video w-auto rounded-xl opacity-40 translate-x-5">
                        <img src="{{ asset('assets/image/services/web-development/web-company-profile/CNs2eplv76z8jP-JwFcytnUDaAgVqXLuO0ZIYW9m3RfTE1h5S_GHMiB4dbkoKQxr.png') }}" class="w-full h-full object-cover object-top">
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        @once
        <script src="{{ asset('js/pages/services/web/showcase/company-profile/showcase-frames.js') }}"></script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Features Section with Educational Insights --}}
    <section class="w-full bg-white py-20 max-md:py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mx-auto">
            <div class="text-center mb-16 max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    Kenapa Memilih Jasa Website <span class="text-[#128AEB]">Centrova</span>?
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Lebih dari sekadar website, kami menciptakan digital presence yang mengubah bisnis Anda
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
                <!-- Feature 1 -->
                <div class="bg-[#128AEB] p-8 rounded-[32px] text-white relative overflow-hidden min-h-[640px] group" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-100 font-medium uppercase text-base mb-4">Tampilan Responsif</p>
                        <h3 class="text-4xl font-bold mb-6">Otomatis menyesuaikan tampilan desktop, tablet, hingga mobile.</h3>
                        
                        <!-- Responsive Illustration -->
                        <div class="mt-8 flex items-center justify-center">
                            <!-- Responsive Device Mockup -->
                            <div class="relative">
                                <!-- Device Container yang berubah bentuk -->
                                <div class="bg-white/10 backdrop-blur-sm border border-white/20 transition-all duration-700 ease-in-out overflow-hidden
                                            w-72 h-44 scale-[1.7] group-hover:scale-[2] rounded-lg p-4 translate-y-16 md:translate-y-32 group-hover:translate-y-36
                                            group-hover:w-32 group-hover:h-56 group-hover:rounded-2xl group-hover:p-3">
                                    
                                    <!-- Browser Chrome / Status Bar -->
                                    <div class="transition-all duration-700 ease-in-out
                                                flex items-center mb-3
                                                group-hover:justify-between group-hover:mb-2">
                                        <!-- Desktop: Browser buttons, Mobile: Time -->
                                        <div class="flex space-x-1 group-hover:hidden">
                                            <div class="w-2 h-2 bg-red-400 rounded-full"></div>
                                            <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                        </div>
                                        
                                        <!-- Mobile: Time (hidden by default) -->
                                        <div class="text-white text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                                            9:41
                                        </div>
                                        
                                        <!-- Desktop: Address bar, Mobile: Signal/Battery -->
                                        <div class="flex-1 ml-3 group-hover:ml-0 group-hover:flex-none">
                                            <div class="bg-white/20 rounded h-1.5 group-hover:hidden"></div>
                                            <div class="hidden group-hover:flex space-x-1">
                                                <div class="w-2 h-0.5 bg-white/60 rounded-full"></div>
                                                <div class="w-0.5 h-0.5 bg-white/60 rounded-full"></div>
                                                <div class="w-0.5 h-0.5 bg-white/60 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Content Area -->
                                    <div class="transition-all duration-700 ease-in-out overflow-hidden h-full">
                                        <!-- Desktop Content -->
                                        <div class="space-y-2 group-hover:hidden">
                                            <div class="bg-white/30 rounded h-3"></div>
                                            <div class="flex space-x-2">
                                                <div class="bg-white/20 rounded h-2 flex-1"></div>
                                                <div class="bg-white/20 rounded h-2 w-16"></div>
                                            </div>
                                            <div class="bg-white/20 rounded h-2 w-3/4"></div>
                                            <div class="grid grid-cols-3 gap-2 mt-3">
                                                <div class="bg-white/25 rounded h-8"></div>
                                                <div class="bg-white/25 rounded h-8"></div>
                                                <div class="bg-white/25 rounded h-8"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Mobile Content (hidden by default, shown on hover) -->
                                        <div class="hidden group-hover:block space-y-1.5 h-full overflow-hidden">
                                            <!-- Header content -->
                                            <div class="bg-white/30 rounded h-1.5"></div>
                                            <div class="bg-white/20 rounded h-1"></div>
                                            <div class="bg-white/20 rounded h-1 w-3/4"></div>
                                            
                                            <!-- Main content blocks -->
                                            <div class="space-y-1 mt-2">
                                                <div class="bg-white/25 rounded h-4"></div>
                                                <div class="bg-white/25 rounded h-4"></div>
                                                <div class="bg-white/25 rounded h-4"></div>
                                                <div class="bg-white/25 rounded h-4"></div>
                                                <div class="bg-white/25 rounded h-4"></div>
                                                <div class="bg-white/25 rounded h-4"></div>
                                                <div class="bg-white/25 rounded h-4"></div>
                                            </div>
                                            
                                            <!-- Bottom indicator -->
                                            <div class="flex justify-center pt-2">
                                                <div class="bg-white/40 rounded-full h-1 w-6"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-[#128AEB]/10 p-8 rounded-[32px] relative overflow-hidden min-h-[640px]" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-500 font-medium uppercase text-base mb-4">Memprioritaskan performa</p>
                        <h3 class="text-4xl font-bold text-gray-900 mb-6">Optimasi performa untuk loading super cepat di semua perangkat.</h3>
                        
                        <svg class="h-[24rem] mx-auto mt-20" viewBox="0 0 57 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_4331_472)">
                        <path d="M54.8502 37.33C54.2063 39.2054 53.3685 41.0085 52.3502 42.71H4.03023C3.0027 41.0121 2.16118 39.2083 1.52024 37.33C-0.388703 31.7591 -0.505072 25.7302 1.18747 20.0898C2.88001 14.4494 6.29646 9.48063 10.9572 5.88111C15.6179 2.28158 21.2889 0.232035 27.174 0.0202043C33.0591 -0.191627 38.8628 1.44489 43.7702 4.70001L39.6902 8.15003C35.4864 5.73818 30.6297 4.71152 25.8095 5.21576C20.9892 5.72001 16.4501 7.72953 12.8364 10.9592C9.22275 14.1888 6.71797 18.4745 5.67755 23.2081C4.63713 27.9417 5.1139 32.8827 7.04024 37.33H49.4202C51.7322 31.9795 51.9323 25.952 49.9802 20.46L54.1102 17.01C56.8705 23.4567 57.1342 30.6996 54.8502 37.33Z" fill="#0e63a8"/>
                        <path d="M24.1008 31.6C23.5416 30.9559 23.1375 30.1921 22.9195 29.3674C22.7016 28.5426 22.6757 27.6789 22.8437 26.8426C23.0117 26.0063 23.3693 25.2197 23.8889 24.5431C24.4084 23.8666 25.0762 23.3182 25.8408 22.94L49.7808 10.13L32.9308 31.42C32.421 32.102 31.7622 32.6588 31.0048 33.048C30.2474 33.4371 29.4112 33.6484 28.5598 33.6658C27.7084 33.6831 26.8643 33.5061 26.0916 33.1481C25.3189 32.7902 24.6381 32.2607 24.1008 31.6Z" fill="#128aeb"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_4331_472">
                        <rect width="56.37" height="42.71" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>

                        <div class="mt-6 text-center">
                            <p class="text-gray-600 text-lg">Dioptimalkan untuk website Anda</p>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#128AEB] bg-opacity-5 rounded-full"></div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-[32px] relative overflow-hidden min-h-[640px] border border-slate-300" data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-500 font-medium uppercase text-base mb-4">SEO Optimized</p>
                        <h3 class="text-4xl font-bold text-gray-900 mb-6">Mudah ditemukan di Google dengan optimasi SEO terbaik.</h3>
                        
                        <!-- SEO Illustration -->
                        <img src="{{ asset('/assets/image/services/web-development/web-company-profile/eFg842SPuEvAYz6ktjiXa9Tfx73RB0symo_Ld-hI1rGZpVUc5lDqJWKQn.png') }}" alt="">
                        
                        <div class="-mt-16 text-center">
                            <p class="text-gray-600 text-sm">Ranking #1 di hasil pencarian Google</p>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#128AEB] bg-opacity-5 rounded-full"></div>
                </div>

                <!-- Feature 4 -->
                <div class="bg-[#0e63a8] p-8 rounded-[32px] text-white relative overflow-hidden min-h-[640px]" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
                    <div class="relative z-10 md:p-8">
                        <p class="text-gray-100 font-medium uppercase text-base mb-4">Keamanan Tinggi</p>
                        <h3 class="text-4xl font-bold mb-6">SSL Certificate gratis dan perlindungan data terbaik untuk website Anda.</h3>
                        
                        <!-- Security Illustration -->
                        <div class="mt-8 flex items-center justify-center">
                            <div class="relative">
                                <!-- Security Shield -->
                                <div class="w-24 h-24 relative">
                                    <svg class="w-full h-full text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                                    </svg>
                                    <!-- Check mark -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-[#0e63a8]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                                
                                <!-- Security Features -->
                                <div class="mt-6 grid grid-cols-2 gap-4 text-center">
                                    <div class="bg-white/10 rounded-lg p-3">
                                        <div class="text-xs text-white/80">SSL</div>
                                        <div class="text-sm font-medium">HTTPS</div>
                                    </div>
                                    <div class="bg-white/10 rounded-lg p-3">
                                        <div class="text-xs text-white/80">Backup</div>
                                        <div class="text-sm font-medium">Daily</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 text-center">
                            <p class="text-white/80 text-sm">Data website Anda aman dan terlindungi</p>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-white bg-opacity-10 rounded-full"></div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Why Choose Us Section --}}
    <section class="w-full bg-white py-20 max-md:py-16">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="text-center mb-16 max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    Kenapa Perusahaan Wajib Punya Website?
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Jangan biarkan kompetitor unggul! Dapatkan website profesional yang akan membuat perusahaan tampil lebih credible dan menarik lebih banyak customer
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Problem Card -->
                <div class="bg-red-50 p-8 rounded-[32px]  relative overflow-hidden group" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
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
                <div class="bg-[#128AEB]/10 p-8 rounded-[32px] text-white relative overflow-hidden group" data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
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

            <div class="grid grid-cols-1 md:grid-cols-3 py-6 gap-8 max-w-5xl w-full mx-auto">
                <div class="px-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600">
                    <div class="text-5xl font-bold text-[#128AEB] mb-3 w-full flex md:justify-center flex-shrink-0">84%</div>
                    <div class="md:text-center">
                        <h4 class="text-xl font-semibold text-slate-900">Riset Online</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Mayoritas calon pelanggan mencari informasi perusahaan melalui mesin pencari sebelum memutuskan kerja sama
                        </p>
                    </div>
                </div>
                
                <div class="px-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700">
                    <div class="text-5xl font-bold text-[#128AEB] mb-3 w-full flex md:justify-center flex-shrink-0">5x</div>
                    <div class="md:text-center">
                        <h4 class="text-xl font-semibold text-slate-900">Lebih Terpercaya</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Website profesional memberikan kesan 5 kali lebih terpercaya dibanding hanya mengandalkan media sosial
                        </p>
                    </div>
                </div>
                
                <div class="px-4" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
                    <div class="text-5xl font-bold text-[#128AEB] mb-3 w-full flex md:justify-center flex-shrink-0">65%</div>
                    <div class="md:text-center">
                        <h4 class="text-xl font-semibold text-slate-900">Peningkatan Lead</h4>
                        <p class="text-slate-600 leading-relaxed">
                            Bisnis dengan website profesional mengalami peningkatan prospek pelanggan hingga 65% dibanding tanpa website
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Everything is Easy Section --}}
    <section class="w-full bg-white py-20 max-md:py-16" x-data="easySection">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="text-center mb-16 max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    Di Centrova <span class="text-[#128AEB]">Semua Serba Mudah!</span>
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Kami memahami bahwa tidak semua orang familiar dengan teknologi. Karena itu, kami membuat semua proses menjadi super mudah dan nyaman untuk Anda.
                </p>
            </div>

            <!-- Easy Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
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

            <!-- Simplicity Promise -->
            <div class="bg-[#128AEB]/10 rounded-[32px] p-8 md:p-12 relative overflow-hidden hidden" data-aos="fade-up" data-aos-duration="700" data-aos-delay="400">
                <div class="relative z-10">
                    <div class="text-center mb-16">
                        <p class="text-gray-500 font-medium uppercase text-base mb-4">Komitmen Kami</p>
                        <h3 class="text-4xl font-bold text-gray-900 mb-6">
                            Janji Kami: <span class="text-[#128AEB]">100% Mudah & Nyaman</span>
                        </h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <template x-for="promise in simplicityPromises" :key="promise.title">
                            <div class="bg-white p-8 rounded-2xl border border-neutral-200">
                                <div class="w-12 h-12 bg-[#128AEB]/10 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-[#128AEB]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-slate-900 mb-3" x-text="promise.title"></h4>
                                <p class="text-slate-600 text-sm leading-relaxed" x-text="promise.description"></p>
                            </div>
                        </template>
                    </div>
                    
                    <div class="text-center mt-12">
                        <a href="https://wa.me/6285817909560?text=Halo%20Centrova,%20saya%20ingin%20konsultasi%20tentang%20pembuatan%20website%20company%20profile.%20Proses%20seperti%20apa%20yang%20akan%20saya%20lalui?" target="_blank" class="bg-[#128AEB] hover:bg-[#0f75c6] text-white font-medium px-7 py-3.5 rounded-full transition flex items-center text-base justify-center mx-auto">
                            Mulai dengan Mudah Sekarang!
                        </a>
                    </div>
                </div>
                <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#128AEB] bg-opacity-5 rounded-full"></div>
            </div>
        </div>

        @push('scripts')
        @once
        <script src="{{ asset('js/pages/services/web/showcase/company-profile/easy-section.js') }}"></script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Centrova Technology Excellence Section --}}
    <section class="w-full bg-white py-20 max-md:py-16">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="text-center mb-16 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    <span class="text-[#128AEB]">Kecanggihan teknologi</span> Centrova<br>
                    untuk website perusahaan Anda
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center overflow-hidden">
                {{-- Left Content - Technical Illustration --}}
                <div class="relative" data-aos="fade-left" data-aos-duration="700" data-aos-delay="200">
                    
                    <img src="{{ asset('/assets/image/services/web-development/web-company-profile/KXoMLaUhgJCXMqNEypRdLsnTYJxOfA_CMUNwpbtXOyv7fgRzTQEMNKC9uAiqXjtlo7b84v.png') }}" class="w-[450px]">

                </div>

                {{-- Right Content --}}
                <div class="space-y-8" data-aos="fade-right" data-aos-duration="700" data-aos-delay="100">
                    <!-- Feature 1 -->
                    <div class="flex items-start gap-4">
                        <div>
                            <h3 class="text-xl font-medium text-slate-900 mb-2">Performa Loading Super Cepat</h3>
                            <p class="text-slate-600">
                                Teknologi optimasi canggih kami memastikan website perusahaan Anda loading dalam hitungan detik. Dengan kombinasi caching, CDN, dan optimasi kode, pengunjung tidak akan menunggu lama untuk melihat informasi perusahaan Anda.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start gap-4">
                        <div>
                            <h3 class="text-xl font-medium text-slate-900 mb-2">Lapisan Keamanan</h3>
                            <p class="text-slate-600">
                                Sistem keamanan berlapis dengan SSL certificate, firewall protection, dan monitoring 24/7. Data perusahaan dan informasi pengunjung website Anda selalu dijaga agar tetap aman dan terproteksi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Technology Section --}}
    <section class="w-full bg-white py-20 max-md:py-16 hidden" x-data="technologySection">
        <div class="w-full max-w-6xl mx-auto px-4">
            <div class="text-center mb-16 max-w-3xl mx-auto" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    Teknologi Modern yang Kami Gunakan
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Kami menggunakan stack teknologi terdepan untuk memastikan website Anda cepat, aman, dan scalable
                </p>
            </div>

            <!-- Technology Categories -->
            <div class="space-y-16">
                <!-- Frontend Technologies -->
                <div data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
                    <h3 class="text-2xl font-semibold text-slate-900 mb-8 text-center">Frontend Development</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        <template x-for="tech in frontendTech" :key="tech.name">
                            <div class="bg-neutral-50 p-6 rounded-2xl text-center transition-shadow group">
                                <div class="w-12 h-12 mx-auto mb-4 flex items-center justify-center">
                                    <img :src="tech.logo" :alt="tech.name" class="w-full h-full object-contain group-hover:scale-110 transition-transform">
                                </div>
                                <h4 class="font-medium text-slate-900 mb-2" x-text="tech.name"></h4>
                                <p class="text-slate-600 text-sm" x-text="tech.description"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Backend Technologies -->
                <div data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
                    <h3 class="text-2xl font-semibold text-slate-900 mb-8 text-center">Backend Development</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        <template x-for="tech in backendTech" :key="tech.name">
                            <div class="bg-neutral-50 p-6 rounded-2xl text-center transition-shadow group">
                                <div class="w-12 h-12 mx-auto mb-4 flex items-center justify-center">
                                    <img :src="tech.logo" :alt="tech.name" class="w-full h-full object-contain group-hover:scale-110 transition-transform">
                                </div>
                                <h4 class="font-medium text-slate-900 mb-2" x-text="tech.name"></h4>
                                <p class="text-slate-600 text-sm" x-text="tech.description"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Tools & Platforms -->
                <div data-aos="fade-up" data-aos-duration="700" data-aos-delay="300">
                    <h3 class="text-2xl font-semibold text-slate-900 mb-8 text-center">Tools & Platforms</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        <template x-for="tool in tools" :key="tool.name">
                            <div class="bg-neutral-50 p-6 rounded-2xl text-center transition-shadow group">
                                <div class="w-12 h-12 mx-auto mb-4 flex items-center justify-center">
                                    <img :src="tool.logo" :alt="tool.name" class="w-full h-full object-contain group-hover:scale-110 transition-transform">
                                </div>
                                <h4 class="font-medium text-slate-900 mb-2" x-text="tool.name"></h4>
                                <p class="text-slate-600 text-sm" x-text="tool.description"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        @once
        <script src="{{ asset('js/pages/services/web/showcase/company-profile/technology-section.js') }}"></script>
        @endonce
        @endpush
    </section>

    <hr class="w-[80%] max-w-4xl h-px bg-neutral-200 mx-auto border-0">

    {{-- Service Packages Section --}}
    <section class="w-full bg-white py-20 max-md:py-16" x-data="packagesSection" id="packages">
        <div class="w-full max-w-6xl mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
                <h2 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
                    Paket Jasa Website <span class="text-[#128AEB]">Perusahaan</span>
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-3xl mx-auto">
                    Pilih paket yang sesuai dengan kebutuhan bisnis Anda, mulai dari landing page hingga e-commerce lengkap
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <template x-for="(pkg, index) in packages" :key="index">
                    <div class="bg-white border-2 rounded-3xl p-8 transition-colors relative flex flex-col justify-between" :class="{'border-[#128AEB] shadow-lg shadow-sky-200': pkg.popular, 'border-neutral-200': !pkg.popular}" data-aos="fade-up" data-aos-duration="700" :data-aos-delay="(index + 1) * 100">
                        <div>
                            <!-- Popular Badge -->
                            <div x-show="pkg.popular" class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                <span class="bg-[#128AEB] text-white px-4 py-1 rounded-full text-sm font-medium">Paling Populer</span>
                            </div>

                            <div class="text-center mb-8">
                                <h3 class="text-2xl font-bold text-slate-900 mb-2" x-text="pkg.name"></h3>
                                <p class="text-slate-600 mb-4" x-text="pkg.description"></p>
                                <div class="mb-2">
                                    <span class="text-4xl font-bold text-slate-900" x-text="pkg.price"></span>
                                    <span class="text-slate-600 ml-1" x-text="pkg.period"></span>
                                </div>
                                <div class="mb-4">
                                    <span class="text-sm text-slate-600">Harga Renewal: </span>
                                    <span class="text-sm text-slate-900 font-medium" x-text="pkg.renewal"></span>
                                </div>
                                <p class="text-sm text-slate-500" x-text="pkg.duration"></p>
                            </div>

                            <ul class="space-y-3 mb-8">
                                <template x-for="feature in pkg.features" :key="feature">
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-[#128AEB] mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-slate-700" x-text="feature"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <button 
                            class="w-full py-3 rounded-full font-semibold transition duration-150"
                            :class="pkg.popular ? 'bg-gradient-to-br from-yellow-500 to-amber-500 hover:shadow-lg hover:shadow-yellow-200 text-white' : 'border-2 border-[#128AEB] text-[#128AEB] hover:bg-[#128AEB] hover:text-white'"
                            @click="selectPackage(pkg.name)"
                        >
                            Pilih Paket
                        </button>
                    </div>
                </template>
            </div>
        </div>

        @push('scripts')
        @once
        <script src="{{ asset('js/pages/services/web/showcase/company-profile/packages-section.js') }}"></script>
        @endonce
        @endpush
    </section>

    {{-- FAQ Section --}}
    <section class="py-20 max-md:py-16 bg-neutral-50" x-data="faqSection">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 max-w-3xl mx-auto">
          <h3 class="text-4xl lg:text-5xl font-semibold text-gray-900 max-md:px-3 mb-6">
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
      <script src="{{ asset('js/pages/services/web/showcase/company-profile/faq-section.js') }}"></script>
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
        <script src="{{ asset('js/pages/services/web/showcase/company-profile/quick-links-section.js') }}"></script>
        @endonce
        @endpush
    </section>

    {{-- Floating WhatsApp Button --}}
    <a href="https://wa.me/6285817909560?text=Halo%20Centrova,%20saya%20tertarik%20dengan%20jasa%20pembuatan%20website%20company%20profile.%20Bisa%20kita%20diskusi?" target="_blank" class="floating-wa" title="Chat WhatsApp">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.488" fill="white"/>
        </svg>
    </a>

    {{-- Alpine.js Components --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('contactSection', () => ({
                form: {
                    name: '',
                    email: '',
                    message: ''
                },
                isSubmitting: false,
                showSuccess: false,
                async submitForm() {
                    if (!this.form.name || !this.form.email || !this.form.message) {
                        alert('Mohon lengkapi semua field');
                        return;
                    }
                    
                    this.isSubmitting = true;
                    
                    try {
                        // Simulate form submission
                        await new Promise(resolve => setTimeout(resolve, 1000));
                        this.showSuccess = true;
                        this.form = { name: '', email: '', message: '' };
                    } catch (error) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    } finally {
                        this.isSubmitting = false;
                    }
                }
            }));
        });
    </script>

    {{-- Master JavaScript Loader --}}
    @push('scripts')
    @once
    <script src="{{ asset('js/pages/services/web/showcase/company-profile/company-profile-master.js') }}"></script>
    @endonce
    @endpush
@endsection
