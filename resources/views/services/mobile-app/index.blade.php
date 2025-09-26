@extends('partials.layouts.main')

@section('title', 'Layanan - Mobile App Development')

@section('navbar')
    @include('partials.navbar.services')
    @include('partials.navbar.subnavbar.services', [
        'servicesLinkText' => 'Mobile App Development',
        'servicesLinkUrl' => route('services.mobile-app.index'),
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
           style="background-image: url('/assets/image/services/mobile-app-development/hero-section/mobile-apps.jpg');"></div>
      <div class="absolute inset-0 z-5"></div>
      <div class="relative z-10 flex items-center justify-center h-screen">
        <div class="text-center parallax-content max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
          <h1 class="text-slate-900 text-4xl md:text-6xl font-bold mb-4">Aplikasi Mobile yang Memukau</h1>
        </div>
      </div>
      <div class="relative z-10 flex items-start justify-center min-h-screen">
        <div class="text-center parallax-content max-w-xl mx-auto font-semibold">
          <p class="text-slate-600/80 text-lg md:text-2xl max-w-2xl mx-auto px-4 mb-6" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
            Pembuatan <span class="text-slate-900">aplikasi mobile Android/iOS</span> menggunakan teknologi hybrid atau native untuk kebutuhan UMKM hingga startup.
          </p>
          <p class="text-slate-600/80 text-lg md:text-2xl max-w-2xl mx-auto px-4 mb-6" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
            Dengan <span class="text-slate-900">interface yang intuitif</span>, aplikasi yang ringan, dan <span class="text-slate-900">integrasi backend</span> yang seamless.
          </p>
          <p class="text-slate-600/80 text-lg md:text-2xl max-w-2xl mx-auto px-4" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
            Solusi <span class="text-slate-900">cross-platform</span> yang efisien untuk menjangkau lebih banyak pengguna.
          </p>
        </div>
      </div>
    </section>

    {{-- Parallax Section 2 --}}
    <section class="relative min-h-screen overflow-hidden parallax-section" data-parallax="0.3">
      <div class="absolute inset-0 bg-cover bg-center z-0 bg-fixed" 
           style="background-image: url('/assets/image/services/mobile-app-development/hero-section/app-store.jpg');"></div>
      <div class="absolute inset-0 z-5"></div>
      <div class="relative z-10 flex items-center justify-center h-full">
        <div class="text-center parallax-content" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
          <h1 class="text-white text-4xl md:text-6xl font-bold mb-4">Ready for App Store</h1>
          <p class="text-white/90 text-lg md:text-xl max-w-2xl mx-auto px-4">
            Aplikasi yang siap publish di Google Play Store dan Apple App Store
          </p>
        </div>
      </div>
    </section>

    {{-- Tentang Layanan --}}
    <div class="max-w-4xl mx-auto px-4 max-md:px-8 lg:px-8 text-center border-none border-neutral-300 py-32">
        <p class="mt-8 text-2xl max-lg:text-xl max-w-3xl mx-auto font-medium text-slate-900/60" data-aos="fade-up" data-aos-duration="700" data-aos-once="true">
            Kami menawarkan <span class="text-slate-900">layanan pengembangan aplikasi mobile</span> yang user-friendly, ringan, dan powerful—mulai dari aplikasi bisnis hingga e-commerce. Semua dikembangkan secara custom sesuai kebutuhan bisnismu, dengan desain modern, performa optimal, dan <span class="text-slate-900">siap publish</span> ke App Store dan Play Store.
        </p>
    </div>

    {{-- Fokus Layanan --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <section class="w-full bg-neutral-50 py-24 px-4 sm:px-6 lg:px-8" x-data="mobileAppAdvantagesSection">
        <div class="max-w-4xl mx-auto text-center mb-6">
            <h2 class="text-4xl font-bold text-slate-900 mb-3">Keunggulan Aplikasi Mobile Kami</h2>
            <p class="text-xl text-slate-700">Mengapa memilih Centrova untuk aplikasi mobile Anda?</p>
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
                Alpine.data('mobileAppAdvantagesSection', () => ({
                    advantages: [{
                            title: 'User-Friendly',
                            short: 'Interface yang intuitif dan mudah digunakan untuk semua pengguna.',
                            desc: 'Desain UI/UX yang mengutamakan kemudahan pengguna dengan navigasi yang intuitif dan user flow yang smooth. Cocok untuk semua kalangan dari yang tech-savvy hingga awam teknologi.'
                        },
                        {
                            title: 'Ringan & Efisien',
                            short: 'Aplikasi yang efisien dalam penggunaan memori dan baterai.',
                            desc: 'Optimasi code dan resource management yang baik menghasilkan aplikasi yang ringan, tidak boros baterai, dan dapat berjalan lancar di berbagai spesifikasi device.'
                        },
                        {
                            title: 'Integrasi Backend',
                            short: 'Koneksi seamless dengan sistem backend dan web service.',
                            desc: 'API integration yang robust dengan real-time data sync, offline capability, dan security layer yang kuat untuk melindungi data pengguna.'
                        },
                        {
                            title: 'Cross-Platform',
                            short: 'Satu kode untuk Android dan iOS dengan performa native.',
                            desc: 'Menggunakan teknologi hybrid modern seperti React Native atau Flutter yang memungkinkan development yang efisien tanpa mengorbankan performa dan user experience.'
                        },
                        {
                            title: 'App Store Ready',
                            short: 'Siap publish ke Google Play Store dan Apple App Store.',
                            desc: 'Mengikuti guidelines dan best practices dari kedua platform, termasuk app signing, privacy policy, dan compliance dengan store policies untuk proses approval yang smooth.'
                        },
                        {
                            title: 'Maintenance & Support',
                            short: 'Update berkala dan support teknis berkelanjutan.',
                            desc: 'Tim support siap membantu dengan bug fixes, feature updates, dan compatibility updates untuk OS terbaru. Termasuk analytics dan crash reporting untuk monitoring performa.'
                        },
                    ],
                    backgroundImages: [
                        '/assets/image/services/mobile-app-development/user-friendly.jpg',
                        '/assets/image/services/mobile-app-development/lightweight.jpg',
                        '/assets/image/services/mobile-app-development/backend-integration.jpg',
                        '/assets/image/services/mobile-app-development/cross-platform.jpg',
                        '/assets/image/services/mobile-app-development/app-store-ready.jpg',
                        '/assets/image/services/mobile-app-development/maintenance-support.jpg',
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

    {{-- Layanan Mobile App --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">Layanan Mobile App</h2>
                <p class="text-xl text-slate-700 max-w-3xl mx-auto">
                    Berbagai jenis aplikasi mobile yang dapat kami kembangkan sesuai kebutuhan bisnis Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gradient-to-br from-purple-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-purple-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">Native Apps</h3>
                            <p class="text-slate-600 mb-4">Aplikasi native Android dan iOS dengan performa optimal.</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Performa maksimal</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Akses penuh fitur device</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>User experience terbaik</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Optimasi platform-specific</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">Hybrid Apps</h3>
                            <p class="text-slate-600 mb-4">Solusi cross-platform yang efisien untuk Android dan iOS.</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Satu kode untuk dua platform</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Development time lebih cepat</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Cost-effective</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>Maintenance lebih mudah</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">E-commerce Apps</h3>
                            <p class="text-slate-600 mb-4">Aplikasi mobile untuk toko online dengan sistem pembayaran terintegrasi.</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Payment gateway integration</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Product catalog management</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Order tracking system</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Push notifications</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="bg-orange-100 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">Enterprise Apps</h3>
                            <p class="text-slate-600 mb-4">Aplikasi bisnis yang aman dan scalable untuk perusahaan.</p>
                            <ul class="space-y-2 text-sm text-slate-600">
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Enterprise-grade security</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Role-based access control</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Data analytics dashboard</li>
                                <li class="flex items-center"><span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>API integration</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Call-to-Action Section --}}
    <section class="py-24 bg-gradient-to-r from-[#128AEB] to-[#0F76C6]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Mengembangkan Aplikasi Mobile Anda?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Konsultasikan ide aplikasi mobile Anda dengan tim expert kami. Gratis konsultasi dan estimasi proyek.
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Lihat Portfolio
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-3xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">100+</div>
                    <div class="text-white/80">Mobile Apps</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">5M+</div>
                    <div class="text-white/80">Downloads</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">4.8★</div>
                    <div class="text-white/80">Average Rating</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-2">24/7</div>
                    <div class="text-white/80">Support</div>
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
