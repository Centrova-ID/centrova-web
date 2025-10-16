@extends('partials.layouts.main')

@section('content')

    <div class="relative">
        {{-- Main Hero --}}
        <div class="relative">
            {{-- Background image with overlay --}}
            <div class="absolute inset-0">
                <img src="https://cdn-dynmedia-1.microsoft.com/is/image/microsoftcorp/Highlight-M365-Icon-Bounce:VP4-1399x600" 
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-white/40 to-transparent"></div>
            </div>
            
            {{-- Content --}}
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 min-h-[550px] flex items-center text-slate-900">
                <div class="max-w-lg space-y-6">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-semibold leading-tight">
                        Solusi Digital untuk Bisnis Anda
                    </h1>
                    <p class="text-base sm:text-lg">
                        Centrova membantu Anda mengelola bisnis dengan lebih efisien melalui solusi software inovatif.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ localizedRoute('services.index') }}?utm_source=learn" 
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150">
                            Pelajari selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Featured Products Grid --}}
        <div class="py-16" id="produk">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <img src="https://plus.unsplash.com/premium_photo-1721080251127-76315300cc5c?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Layanan Web Development" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Pengembangan Perangkat Lunak</h3>
                            <p class="text-[18px] font-medium mb-2">Kami ahli dalam merancang solusi perangkat lunak berkualitas sesuai kebutuhan Anda.</p>
                            <a href="{{ route('services.index') }}" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <img src="https://images.unsplash.com/photo-1667984390553-7f439e6ae401?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Layanan App Development" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Infrastruktur</h3>
                            <p class="text-[18px] font-medium mb-2">Membangun infrastruktur TI yang kuat dan skalabel untuk mendukung bisnis Anda.</p>
                            <a href="/layanan/app-development" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <img src="https://plus.unsplash.com/premium_photo-1661429422690-f7dfe21d54c4?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Integrasi Sistem" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Dukungan</h3>
                            <p class="text-[18px] font-medium mb-2">Memberikan dukungan terbaik untuk memastikan operasional TI Anda berjalan dengan lancar.</p>
                            <a href="{{ route('support.home') }}" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
                                <span>Pelajari selengkapnya</span>
                                <svg class="w-[13.5px] h-[13.5px] ml-1 mt-[2.4px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="glass-card-news rounded-2xl overflow-hidden bg-white text-slate-800 border border-neutral-200 hover:shadow transition-shadow duration-150">
                        <img src="https://images.unsplash.com/photo-1667372283545-1261fb5c427a?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Integrasi Sistem" loading="lazy" class="w-full aspect-video object-cover">
                        <div class="px-6 py-4 pb-6">
                            <h3 class="text-xs font-medium text-neutral-500 uppercase tracking-widest mb-1">Keamanan Data</h3>
                            <p class="text-[18px] font-medium mb-2">Menjaga keamanan dan kerahasiaan data bisnis penting Anda.</p>
                            <a href="{{ route('legal.privacy') }}" class="flex items-center text-[#128AEB] font-medium hover:underline transition">
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
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="w-full h-[540px] bg-sky-100 rounded-[36px] p-16">
                    <div class="w-full h-full flex justify-start items-center">
                        <div class="w-auto flex-col max-w-[366.7px]">
                            <span class="text-base font-medium text-slate-900">Jasa Pembuatan Website</span>
                            <h1 class="font-bold text-slate-900 text-4xl mt-2">Ubah Ide Anda Menjadi Kenyataan</h1>
                            <p class="text-slate-800 mt-4">Mulailah bangun "rumah" online Anda dengan memiliki website untuk merek Anda.</p>
                            <a href="{{ localizedRoute('services.index') }}?utm_source=learn" 
                            class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-10">Dapatkan Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="flex grid grid-cols-2 mt-10">
                    <div class="w-full flex-col px-16">
                        <img src="https://www.exabytes.co.id/wp-content/uploads/product-icon-ecommerce-1-1.svg" class="h-[79px] mb-5">
                        <span class="text-base text-slate-900">Jasa Pembuatan Toko Online</span>
                        <h1 class="text-3xl font-bold text-slate-900 mt-2 mb-3">Segalanya Dimulai dari Toko Online</h1>
                        <p class="text-slate-700">Kami siap membantu Anda membangun toko online yang sesuai dengan kebutuhan Anda. Tingkatkan kehadiran digital bisnis Anda dan capai lebih banyak pelanggan secara online bersama kami!</p>
                        <a href="{{ localizedRoute('services.index') }}?utm_source=learn" class="inline-flex items-center justify-center px-5 py-2.5  border-2 border-neutral-400 hover:border-[#128AEB] text-base font-medium rounded-full text-sky-700 hover:text-[#128AEB] font-semibold transition duration-150 mt-8">Coba Sekarang</a>
                    </div>

                    <div class="w-full flex-col px-16">
                        <img src="https://www.exabytes.co.id/wp-content/uploads/product-icon-hosting-2.svg" class="h-[79px] mb-5">
                        <span class="text-base text-slate-900">Website Profil Perusahaan</span>
                        <h1 class="text-3xl font-bold text-slate-900 mt-2 mb-3">Hosting Website di Tempat yang Tepat, Aman & Cepat</h1>
                        <p class="text-slate-700">Layanan kami menyertakan backup harian untuk file web Anda dan menggunakan server super cepat yang didedikasikan khusus untuk kebutuhan Anda. Percayakan keberhasilan online Anda pada layanan hosting terbaik kami!.</p>
                        <a href="{{ localizedRoute('services.index') }}?utm_source=learn" class="inline-flex items-center justify-center px-5 py-2.5  border-2 border-neutral-400 hover:border-[#128AEB] text-base font-medium rounded-full text-sky-700 hover:text-[#128AEB] font-semibold transition duration-150 mt-8">Coba Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Features Showcase Section --}}
        <div class="bg-white py-16 hidden">
            <div class="w-full">
                <h2 class="text-4xl font-bold text-[#004E8D] text-center mb-4">Kenali Centrova POS</h2>
                <p class="text-gray-600 text-center mb-12 text-lg">Fitur lengkap untuk kebutuhan bisnis Anda</p>
                
                <div class="relative">
                    {{-- Slider Container --}}
                    <div class="features-slider overflow-hidden">
                        <div class="flex transition-transform duration-300 ease-out" id="features-track">
                            {{-- Feature Card 1 - AI --}}
                            <div class="flex-none w-[280px] md:w-[320px] px-2">
                                <a href="#ai-features" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#1a1a1a] to-[#2a2a2a] hover:shadow-lg transition duration-300">
                                    <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/apple_intelligence__gbh77cvflkia_large.jpg" alt="AI Assistant" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                        <span class="text-sm font-semibold text-white mb-2">AI Assistant</span>
                                        <h3 class="text-2xl font-semibold text-white mb-3">Bisnis lebih pintar dengan AI.</h3>
                                    </div>
                                </a>
                            </div>

                            {{-- Feature Card 2 - Interface --}}
                            <div class="flex-none w-[280px] md:w-[320px] px-2">
                                <a href="#interface" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#003B6F] to-[#004E8D] hover:shadow-lg transition duration-300">
                                    <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/camera__exi2qfijti0y_large.jpg" alt="Modern Interface" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                        <span class="text-sm font-semibold text-white mb-2">Interface</span>
                                        <h3 class="text-2xl font-semibold text-white mb-3">Design yang intuitif.</h3>
                                    </div>
                                </a>
                            </div>

                            {{-- Feature Card 3 - Performance --}}
                            <div class="flex-none w-[280px] md:w-[320px] px-2">
                                <a href="#performance" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#2a2a2a] to-[#1a1a1a] hover:shadow-lg transition duration-300">
                                    <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/battery__2v7w6kmztvm2_large.jpg" alt="Performance" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                        <span class="text-sm font-semibold text-white mb-2">Performance</span>
                                        <h3 class="text-2xl font-semibold text-white mb-3">Cepat dan handal.</h3>
                                    </div>
                                </a>
                            </div>

                            {{-- Feature Card 4 - Security --}}
                            <div class="flex-none w-[280px] md:w-[320px] px-2">
                                <a href="#security" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#004E8D] to-[#003B6F] hover:shadow-lg transition duration-300">
                                    <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/innovation__os9bmmo3mjee_large.jpg" alt="Security" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                        <span class="text-sm font-semibold text-white mb-2">Security</span>
                                        <h3 class="text-2xl font-semibold text-white mb-3">Data selalu aman.</h3>
                                    </div>
                                </a>
                            </div>

                            {{-- Feature Card 5 - Support --}}
                            <div class="flex-none w-[280px] md:w-[320px] px-2">
                                <a href="#support" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#1a1a1a] to-[#2a2a2a] hover:shadow-lg transition duration-300">
                                    <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/environment__e3v3gj88dl6q_large.jpg" alt="Support" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                        <span class="text-sm font-semibold text-white mb-2">Support</span>
                                        <h3 class="text-2xl font-semibold text-white mb-3">24/7 bantuan teknis.</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Navigation Buttons --}}
                    <button class="absolute left-16 max-md:left-6 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/80 shadow-lg flex items-center justify-center hover:bg-white transition-colors" id="prev-btn">
                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="absolute right-16 max-md:right-6 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/80 shadow-lg flex items-center justify-center hover:bg-white transition-colors" id="next-btn">
                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                {{-- Navigation Dots --}}
                <div class="flex justify-center items-center gap-2 mt-8" id="nav-dots">
                </div>

                <style>
                    .features-slider {
                        -webkit-overflow-scrolling: touch;
                        scroll-behavior: smooth;
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const track = document.getElementById('features-track');
                        const slides = track.children;
                        const dotsContainer = document.getElementById('nav-dots');
                        const prevButton = document.getElementById('prev-btn');
                        const nextButton = document.getElementById('next-btn');

                        let currentIndex = 0;
                        let startX;
                        let scrollLeft;
                        let isDragging = false;

                        // Create dots
                        for (let i = 0; i < slides.length; i++) {
                            const dot = document.createElement('button');
                            dot.classList.add('w-2', 'h-2', 'rounded-full', 'transition-colors');
                            dot.setAttribute('aria-label', `Slide ${i + 1}`);
                            dot.addEventListener('click', () => goToSlide(i));
                            dotsContainer.appendChild(dot);
                        }

                        const dots = dotsContainer.children;
                        updateDots();

                        // Navigation
                        prevButton.addEventListener('click', () => {
                            currentIndex = Math.max(currentIndex - 1, 0);
                            updateSlider();
                        });

                        nextButton.addEventListener('click', () => {
                            currentIndex = Math.min(currentIndex + 1, slides.length - 1);
                            updateSlider();
                        });

                        // Mouse drag functionality
                        track.addEventListener('mousedown', (e) => {
                            isDragging = true;
                            startX = e.pageX - track.offsetLeft;
                            scrollLeft = track.scrollLeft;
                        });

                        track.addEventListener('mouseleave', () => {
                            isDragging = false;
                        });

                        track.addEventListener('mouseup', () => {
                            isDragging = false;
                        });

                        track.addEventListener('mousemove', (e) => {
                            if (!isDragging) return;
                            e.preventDefault();
                            const x = e.pageX - track.offsetLeft;
                            const walk = (x - startX) * 2;
                            track.scrollLeft = scrollLeft - walk;
                        });

                        function goToSlide(index) {
                            currentIndex = index;
                            updateSlider();
                        }

                        function updateSlider() {
                            const slideWidth = slides[0].offsetWidth;
                            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
                            updateDots();
                            updateButtons();
                        }

                        function updateDots() {
                            [...dots].forEach((dot, index) => {
                                if (index === currentIndex) {
                                    dot.classList.add('bg-[#128AEB]');
                                    dot.classList.remove('bg-gray-300');
                                } else {
                                    dot.classList.add('bg-gray-300');
                                    dot.classList.remove('bg-[#128AEB]');
                                }
                            });
                        }

                        function updateButtons() {
                            prevButton.style.display = currentIndex === 0 ? 'none' : 'flex';
                            nextButton.style.display = currentIndex === slides.length - 1 ? 'none' : 'flex';
                        }

                        // Initial setup
                        updateButtons();
                    });
                </script>
            </div>
        </div>

        {{-- Why Choose Centrova Section --}}
        <div class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Mengapa Memilih Centrova?</h2>
                    <p class="text-lg text-slate-600 max-w-3xl mx-auto">Kami adalah mitra terpercaya untuk transformasi digital bisnis Anda dengan solusi teknologi yang inovatif dan terpercaya.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#128AEB]/20 transition-colors">
                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Terpercaya & Berpengalaman</h3>
                        <p class="text-slate-600">Lebih dari 5 tahun pengalaman melayani berbagai jenis bisnis dengan solusi teknologi yang handal dan terpercaya.</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#128AEB]/20 transition-colors">
                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Performa Tinggi</h3>
                        <p class="text-slate-600">Solusi yang kami kembangkan menggunakan teknologi terkini untuk memastikan performa optimal dan kecepatan akses yang maksimal.</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#128AEB]/20 transition-colors">
                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2v20M2 12h20" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Solusi Kustom</h3>
                        <p class="text-slate-600">Setiap solusi dirancang khusus sesuai kebutuhan spesifik bisnis Anda untuk hasil yang optimal dan efektif.</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#128AEB]/20 transition-colors">
                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Keamanan Data</h3>
                        <p class="text-slate-600">Sistem keamanan berlapis untuk melindungi data bisnis dan informasi pelanggan Anda dengan standar keamanan tinggi.</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#128AEB]/20 transition-colors">
                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Support 24/7</h3>
                        <p class="text-slate-600">Tim support profesional yang siap membantu Anda kapan saja untuk memastikan operasional bisnis berjalan lancar.</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#128AEB]/20 transition-colors">
                            <svg class="w-8 h-8 text-[#128AEB]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Skalabilitas Tinggi</h3>
                        <p class="text-slate-600">Solusi yang dapat berkembang seiring pertumbuhan bisnis Anda, dari skala kecil hingga enterprise level.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics Section --}}
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Dipercaya oleh Ribuan Bisnis</h2>
                    <p class="text-lg text-slate-600">Prestasi yang telah kami capai bersama klien-klien terpercaya</p>
                </div>
                
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#128AEB] mb-2">500+</div>
                        <div class="text-slate-600">Proyek Selesai</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#128AEB] mb-2">200+</div>
                        <div class="text-slate-600">Klien Puas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#128AEB] mb-2">99.9%</div>
                        <div class="text-slate-600">Uptime Server</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#128AEB] mb-2">24/7</div>
                        <div class="text-slate-600">Support</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Technology Stack Section --}}
        <div class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Teknologi yang Kami Gunakan</h2>
                    <p class="text-lg text-slate-600">Stack teknologi modern untuk membangun solusi yang handal dan skalabel</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center">
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-white rounded-xl shadow-sm flex items-center justify-center mb-3 group-hover:shadow-md transition-shadow">
                            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="#61DAFB">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-600 font-medium">React</span>
                    </div>
                    
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-white rounded-xl shadow-sm flex items-center justify-center mb-3 group-hover:shadow-md transition-shadow">
                            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="#38B2AC">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-600 font-medium">Vue.js</span>
                    </div>
                    
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-white rounded-xl shadow-sm flex items-center justify-center mb-3 group-hover:shadow-md transition-shadow">
                            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="#FF2D20">
                                <path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-600 font-medium">Laravel</span>
                    </div>
                    
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-white rounded-xl shadow-sm flex items-center justify-center mb-3 group-hover:shadow-md transition-shadow">
                            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="#336791">
                                <path d="M23.15 12.886c-.13-.41-.46-.82-.99-1.23l-.02-.01c-.53-.41-1.24-.67-2.07-.78-.38-.05-.78-.08-1.19-.08-.77 0-1.52.11-2.24.31-.35.1-.69.22-1.02.36-.66.28-1.26.66-1.79 1.12-.26.23-.5.47-.72.73-.11.13-.21.26-.3.4-.19.28-.35.58-.48.89-.26.62-.4 1.29-.4 1.98 0 .34.03.68.09 1.01.06.33.15.65.27.96.24.62.59 1.18 1.04 1.66.45.48.99.87 1.6 1.15.61.28 1.28.42 1.97.42.69 0 1.36-.14 1.97-.42.61-.28 1.15-.67 1.6-1.15.45-.48.8-1.04 1.04-1.66.12-.31.21-.63.27-.96.06-.33.09-.67.09-1.01 0-.69-.14-1.36-.4-1.98z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-600 font-medium">PostgreSQL</span>
                    </div>
                    
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-white rounded-xl shadow-sm flex items-center justify-center mb-3 group-hover:shadow-md transition-shadow">
                            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="#FF9900">
                                <path d="M14.7 15.5c2.2 1.6 5.7.9 7.1-1.6 1.4-2.5.5-5.7-1.9-7.1s-5.7-.9-7.1 1.6c-.7 1.3-.7 2.8-.1 4.1z"/>
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-600 font-medium">AWS</span>
                    </div>
                    
                    <div class="flex flex-col items-center group">
                        <div class="w-16 h-16 bg-white rounded-xl shadow-sm flex items-center justify-center mb-3 group-hover:shadow-md transition-shadow">
                            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="#2496ED">
                                <path d="M13.983 11.078h2.119a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.119a.185.185 0 00-.185.185v1.888c0 .102.083.185.185.185m-2.954-5.43h2.118a.186.186 0 00.186-.186V3.574a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.185"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-600 font-medium">Docker</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Industries We Serve Section --}}
        <div class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Industri yang Kami Layani</h2>
                    <p class="text-lg text-slate-600">Pengalaman lintas industri untuk memahami kebutuhan spesifik bisnis Anda</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-2xl p-6 text-center border border-slate-200 hover:shadow-lg transition-shadow group">
                        <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-2xl flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Retail & E-commerce</h3>
                        <p class="text-sm text-slate-600">Toko online, sistem POS, manajemen inventory, payment gateway</p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 text-center border border-slate-200 hover:shadow-lg transition-shadow group">
                        <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-2xl flex items-center justify-center group-hover:bg-green-200 transition-colors">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Pendidikan</h3>
                        <p class="text-sm text-slate-600">LMS, sistem akademik, e-learning, manajemen sekolah</p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 text-center border border-slate-200 hover:shadow-lg transition-shadow group">
                        <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-2xl flex items-center justify-center group-hover:bg-red-200 transition-colors">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Kesehatan</h3>
                        <p class="text-sm text-slate-600">Sistem rumah sakit, rekam medis, telemedicine, appointment</p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 text-center border border-slate-200 hover:shadow-lg transition-shadow group">
                        <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-2xl flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Fintech</h3>
                        <p class="text-sm text-slate-600">Payment system, lending platform, digital banking, wallet</p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 text-center border border-slate-200 hover:shadow-lg transition-shadow group">
                        <div class="w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-2xl flex items-center justify-center group-hover:bg-yellow-200 transition-colors">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M10.5 3L12 2l1.5 1H21l-3 6H6l-3-6h7.5z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Manufaktur</h3>
                        <p class="text-sm text-slate-600">ERP system, supply chain management, quality control</p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 text-center border border-slate-200 hover:shadow-lg transition-shadow group">
                        <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-2xl flex items-center justify-center group-hover:bg-indigo-200 transition-colors">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Logistik</h3>
                        <p class="text-sm text-slate-600">Tracking system, fleet management, warehouse management</p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 text-center border border-slate-200 hover:shadow-lg transition-shadow group">
                        <div class="w-16 h-16 mx-auto mb-4 bg-pink-100 rounded-2xl flex items-center justify-center group-hover:bg-pink-200 transition-colors">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">HR & Recruitment</h3>
                        <p class="text-sm text-slate-600">HRIS, recruitment platform, performance management</p>
                    </div>
                    
                    <div class="bg-white rounded-2xl p-6 text-center border border-slate-200 hover:shadow-lg transition-shadow group">
                        <div class="w-16 h-16 mx-auto mb-4 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Real Estate</h3>
                        <p class="text-sm text-slate-600">Property listing, CRM real estate, virtual tour platform</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Process Section --}}
        <div class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Proses Kerja Kami</h2>
                    <p class="text-lg text-slate-600">Metodologi yang terbukti untuk menghasilkan solusi terbaik bagi klien</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB] rounded-full flex items-center justify-center text-white font-bold text-xl">1</div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Analisis Kebutuhan</h3>
                        <p class="text-slate-600">Memahami secara mendalam kebutuhan dan tantangan bisnis yang Anda hadapi untuk merancang solusi yang tepat.</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB] rounded-full flex items-center justify-center text-white font-bold text-xl">2</div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Perencanaan & Design</h3>
                        <p class="text-slate-600">Membuat rencana detail dan prototype untuk memastikan solusi sesuai dengan ekspektasi dan kebutuhan Anda.</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB] rounded-full flex items-center justify-center text-white font-bold text-xl">3</div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Development & Testing</h3>
                        <p class="text-slate-600">Pengembangan dengan teknologi terkini dan testing menyeluruh untuk memastikan kualitas dan performa optimal.</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-6 bg-[#128AEB] rounded-full flex items-center justify-center text-white font-bold text-xl">4</div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Deploy & Support</h3>
                        <p class="text-slate-600">Implementasi ke production environment dan dukungan berkelanjutan untuk menjamin kelancaran operasional.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Partners & Certifications Section --}}
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Partner dan Sertifikasi</h2>
                    <p class="text-lg text-slate-600">Bekerja sama dengan technology leader untuk memberikan solusi terbaik</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-70">
                    {{-- AWS Partner --}}
                    <div class="flex items-center justify-center">
                        <div class="bg-slate-50 rounded-lg p-4 w-full h-20 flex items-center justify-center hover:bg-slate-100 transition-colors">
                            <span class="text-[#FF9900] font-bold text-lg">AWS</span>
                        </div>
                    </div>
                    
                    {{-- Google Cloud --}}
                    <div class="flex items-center justify-center">
                        <div class="bg-slate-50 rounded-lg p-4 w-full h-20 flex items-center justify-center hover:bg-slate-100 transition-colors">
                            <span class="text-[#4285F4] font-bold text-lg">Google Cloud</span>
                        </div>
                    </div>
                    
                    {{-- Microsoft --}}
                    <div class="flex items-center justify-center">
                        <div class="bg-slate-50 rounded-lg p-4 w-full h-20 flex items-center justify-center hover:bg-slate-100 transition-colors">
                            <span class="text-[#00BCF2] font-bold text-lg">Microsoft</span>
                        </div>
                    </div>
                    
                    {{-- Laravel Partner --}}
                    <div class="flex items-center justify-center">
                        <div class="bg-slate-50 rounded-lg p-4 w-full h-20 flex items-center justify-center hover:bg-slate-100 transition-colors">
                            <span class="text-[#FF2D20] font-bold text-lg">Laravel</span>
                        </div>
                    </div>
                    
                    {{-- React --}}
                    <div class="flex items-center justify-center">
                        <div class="bg-slate-50 rounded-lg p-4 w-full h-20 flex items-center justify-center hover:bg-slate-100 transition-colors">
                            <span class="text-[#61DAFB] font-bold text-lg">React</span>
                        </div>
                    </div>
                    
                    {{-- Docker --}}
                    <div class="flex items-center justify-center">
                        <div class="bg-slate-50 rounded-lg p-4 w-full h-20 flex items-center justify-center hover:bg-slate-100 transition-colors">
                            <span class="text-[#2496ED] font-bold text-lg">Docker</span>
                        </div>
                    </div>
                </div>

                {{-- Certifications --}}
                <div class="mt-12 text-center">
                    <h3 class="text-2xl font-semibold text-slate-900 mb-8">Sertifikasi & Standar</h3>
                    <div class="flex flex-wrap justify-center items-center gap-8">
                        <div class="flex items-center bg-slate-50 rounded-lg px-6 py-3">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-slate-700 font-medium">ISO 27001 Certified</span>
                        </div>
                        
                        <div class="flex items-center bg-slate-50 rounded-lg px-6 py-3">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-slate-700 font-medium">GDPR Compliant</span>
                        </div>
                        
                        <div class="flex items-center bg-slate-50 rounded-lg px-6 py-3">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-slate-700 font-medium">PCI DSS Level 1</span>
                        </div>
                        
                        <div class="flex items-center bg-slate-50 rounded-lg px-6 py-3">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-slate-700 font-medium">SOC 2 Type II</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Latest Insights Section --}}
        <div class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Insight Terbaru</h2>
                    <p class="text-lg text-slate-600">Artikel dan tips seputar teknologi dan transformasi digital</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 hover:shadow-lg transition-shadow">
                        <div class="aspect-video bg-slate-200 relative">
                            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=870&auto=format&fit=crop" alt="Digital Transformation" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-slate-500 mb-2">15 Oktober 2024</div>
                            <h3 class="text-xl font-semibold text-slate-900 mb-3 hover:text-[#128AEB] transition-colors">
                                <a href="#">5 Tren Digital Transformation yang Harus Diketahui di 2024</a>
                            </h3>
                            <p class="text-slate-600 mb-4">Pelajari tren teknologi terbaru yang akan mengubah landscape bisnis di tahun 2024 dan bagaimana...</p>
                            <a href="#" class="text-[#128AEB] font-medium hover:underline">Baca Selengkapnya →</a>
                        </div>
                    </article>
                    
                    <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 hover:shadow-lg transition-shadow">
                        <div class="aspect-video bg-slate-200 relative">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=815&auto=format&fit=crop" alt="Business Analytics" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-slate-500 mb-2">12 Oktober 2024</div>
                            <h3 class="text-xl font-semibold text-slate-900 mb-3 hover:text-[#128AEB] transition-colors">
                                <a href="#">Mengoptimalkan Business Intelligence dengan Data Analytics</a>
                            </h3>
                            <p class="text-slate-600 mb-4">Cara memanfaatkan data analytics untuk mengambil keputusan bisnis yang lebih baik dan akurat...</p>
                            <a href="#" class="text-[#128AEB] font-medium hover:underline">Baca Selengkapnya →</a>
                        </div>
                    </article>
                    
                    <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 hover:shadow-lg transition-shadow">
                        <div class="aspect-video bg-slate-200 relative">
                            <img src="https://images.unsplash.com/photo-1563986768494-4dee2763ff3f?q=80&w=870&auto=format&fit=crop" alt="Cloud Security" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-slate-500 mb-2">10 Oktober 2024</div>
                            <h3 class="text-xl font-semibold text-slate-900 mb-3 hover:text-[#128AEB] transition-colors">
                                <a href="#">Best Practices Keamanan Cloud untuk Bisnis</a>
                            </h3>
                            <p class="text-slate-600 mb-4">Panduan lengkap implementasi security measures untuk melindungi data dan sistem cloud...</p>
                            <a href="#" class="text-[#128AEB] font-medium hover:underline">Baca Selengkapnya →</a>
                        </div>
                    </article>
                </div>
                
                <div class="text-center mt-8">
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 border border-[#128AEB] text-base font-medium rounded-full text-[#128AEB] bg-white hover:bg-[#128AEB] hover:text-white transition">
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>
        </div>

        {{-- FAQ Section --}}
        <div class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Pertanyaan yang Sering Diajukan</h2>
                    <p class="text-lg text-slate-600">Temukan jawaban atas pertanyaan umum tentang layanan kami</p>
                </div>
                
                <div class="space-y-4">
                    <div x-data="{ open: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="open = !open" class="w-full px-6 py-4 text-left bg-white hover:bg-slate-50 transition-colors flex items-center justify-between">
                            <span class="font-medium text-slate-900">Berapa lama waktu pengembangan untuk sebuah proyek?</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                            <p class="text-slate-600">Waktu pengembangan bervariasi tergantung kompleksitas proyek. Untuk website sederhana: 2-4 minggu, aplikasi web kompleks: 2-6 bulan, dan aplikasi mobile: 3-8 bulan. Kami akan memberikan timeline yang detail setelah analisis kebutuhan.</p>
                        </div>
                    </div>
                    
                    <div x-data="{ open: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="open = !open" class="w-full px-6 py-4 text-left bg-white hover:bg-slate-50 transition-colors flex items-center justify-between">
                            <span class="font-medium text-slate-900">Apakah ada garansi untuk proyek yang dikembangkan?</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                            <p class="text-slate-600">Ya, kami memberikan garansi bug fixing selama 6 bulan setelah project selesai. Selain itu, kami juga menyediakan layanan maintenance dan support berkelanjutan dengan paket yang dapat disesuaikan dengan kebutuhan.</p>
                        </div>
                    </div>
                    
                    <div x-data="{ open: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="open = !open" class="w-full px-6 py-4 text-left bg-white hover:bg-slate-50 transition-colors flex items-center justify-between">
                            <span class="font-medium text-slate-900">Bagaimana proses konsultasi awal?</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                            <p class="text-slate-600">Konsultasi awal GRATIS! Kami akan mendengarkan kebutuhan Anda, melakukan analisis bisnis, dan memberikan rekomendasi solusi terbaik. Konsultasi bisa dilakukan via online meeting atau tatap muka di kantor kami.</p>
                        </div>
                    </div>
                    
                    <div x-data="{ open: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="open = !open" class="w-full px-6 py-4 text-left bg-white hover:bg-slate-50 transition-colors flex items-center justify-between">
                            <span class="font-medium text-slate-900">Apakah bisa integrasi dengan sistem yang sudah ada?</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                            <p class="text-slate-600">Tentu! Kami berpengalaman dalam mengintegrasikan sistem baru dengan infrastruktur yang sudah ada, seperti ERP, CRM, payment gateway, atau sistem internal lainnya. Kami akan melakukan assessment terlebih dahulu untuk memastikan kompatibilitas.</p>
                        </div>
                    </div>
                    
                    <div x-data="{ open: false }" class="border border-slate-200 rounded-xl overflow-hidden">
                        <button @click="open = !open" class="w-full px-6 py-4 text-left bg-white hover:bg-slate-50 transition-colors flex items-center justify-between">
                            <span class="font-medium text-slate-900">Bagaimana dengan keamanan data dan privacy?</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 text-slate-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                            <p class="text-slate-600">Keamanan data adalah prioritas utama kami. Kami menerapkan enkripsi end-to-end, SSL certificates, regular security updates, dan mengikuti standar keamanan industri. Semua data klien dijamin kerahasiaannya dengan NDA yang ketat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ready to Start Section --}}
        <div class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-slate-900 mb-6">Siap Memulai Proyek Anda?</h2>
                        <p class="text-lg text-slate-600 mb-8">Konsultasi gratis untuk mengetahui solusi terbaik bagi bisnis Anda. Tim expert kami siap membantu mewujudkan visi digital Anda.</p>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-slate-700">Konsultasi awal gratis tanpa komitmen</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-slate-700">Analisis kebutuhan mendalam</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-slate-700">Proposal solusi dalam 24 jam</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-slate-700">Timeline dan budget yang transparan</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('support.home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-bold rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition">
                                Jadwalkan Konsultasi
                            </a>
                            <a href="tel:+62-21-1234-5678" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#128AEB] text-base font-bold rounded-full text-[#128AEB] hover:bg-[#128AEB] hover:text-white transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Hubungi Langsung
                            </a>
                        </div>
                    </div>
                    
                    <div class="lg:pl-8">
                        <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm">
                            <h3 class="text-xl font-semibold text-slate-900 mb-6">Hubungi Kami</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-[#128AEB] mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-slate-900">Kantor Pusat</div>
                                        <div class="text-slate-600">Jl. Sudirman No. 123, Jakarta Selatan<br>Indonesia 12190</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-[#128AEB] mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-slate-900">Telepon</div>
                                        <div class="text-slate-600">+62 21 1234 5678<br>+62 811 1234 5678</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-[#128AEB] mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-slate-900">Email</div>
                                        <div class="text-slate-600">hello@centrova.id<br>support@centrova.id</div>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-[#128AEB] mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <div class="font-medium text-slate-900">Jam Operasional</div>
                                        <div class="text-slate-600">Senin - Jumat: 09:00 - 18:00<br>Sabtu: 09:00 - 15:00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Call to Action --}}
        <div class="bg-gradient-to-r from-[#004E8D] to-[#128AEB] py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-6">Mulai Digitalisasi Bisnis Anda Sekarang</h2>
                <p class="text-white/90 mb-8 text-lg">Bergabung dengan ribuan bisnis yang telah menggunakan Centrova untuk transformasi digital mereka</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-bold rounded-full text-[#128AEB] bg-white hover:bg-[#E3F2FD] shadow transition">
                        Lihat Layanan Kami
                    </a>
                    <a href="{{ route('support.home') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-base font-bold rounded-full text-white hover:bg-white/10 transition">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection