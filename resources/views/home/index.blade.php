@extends('partials.layouts.main')

@section('content')
<!-- Hero Section -->
<div class="relative">
    <!-- Main Hero -->
    <div class="relative">
        <!-- Background image with overlay -->
        <div class="absolute inset-0">
            <img src="https://cdn-dynmedia-1.microsoft.com/is/image/microsoftcorp/Highlight-M365-Icon-Bounce:VP4-1399x600" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-white/40 to-transparent"></div>
        </div>
        
        <!-- Content -->
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

    <!-- Featured Products Grid -->
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

    <!-- Features Showcase Section -->
    <div class="bg-white py-16 hidden">
        <div class="w-full">
            <h2 class="text-4xl font-bold text-[#004E8D] text-center mb-4">Kenali Centrova POS</h2>
            <p class="text-gray-600 text-center mb-12 text-lg">Fitur lengkap untuk kebutuhan bisnis Anda</p>
            
            <div class="relative">
                <!-- Slider Container -->
                <div class="features-slider overflow-hidden">
                    <div class="flex transition-transform duration-300 ease-out" id="features-track">
                        <!-- Feature Card 1 - AI -->
                        <div class="flex-none w-[280px] md:w-[320px] px-2">
                            <a href="#ai-features" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#1a1a1a] to-[#2a2a2a] hover:shadow-lg transition duration-300">
                                <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/apple_intelligence__gbh77cvflkia_large.jpg" alt="AI Assistant" class="w-full h-full object-cover">
                                <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                    <span class="text-sm font-semibold text-white mb-2">AI Assistant</span>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Bisnis lebih pintar dengan AI.</h3>
                                </div>
                            </a>
                        </div>

                        <!-- Feature Card 2 - Interface -->
                        <div class="flex-none w-[280px] md:w-[320px] px-2">
                            <a href="#interface" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#003B6F] to-[#004E8D] hover:shadow-lg transition duration-300">
                                <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/camera__exi2qfijti0y_large.jpg" alt="Modern Interface" class="w-full h-full object-cover">
                                <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                    <span class="text-sm font-semibold text-white mb-2">Interface</span>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Design yang intuitif.</h3>
                                </div>
                            </a>
                        </div>

                        <!-- Feature Card 3 - Performance -->
                        <div class="flex-none w-[280px] md:w-[320px] px-2">
                            <a href="#performance" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#2a2a2a] to-[#1a1a1a] hover:shadow-lg transition duration-300">
                                <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/battery__2v7w6kmztvm2_large.jpg" alt="Performance" class="w-full h-full object-cover">
                                <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                    <span class="text-sm font-semibold text-white mb-2">Performance</span>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Cepat dan handal.</h3>
                                </div>
                            </a>
                        </div>

                        <!-- Feature Card 4 - Security -->
                        <div class="flex-none w-[280px] md:w-[320px] px-2">
                            <a href="#security" class="group block relative aspect-[4/7] rounded-3xl overflow-hidden bg-gradient-to-b from-[#004E8D] to-[#003B6F] hover:shadow-lg transition duration-300">
                                <img src="https://www.apple.com/v/iphone/home/cb/images/overview/consider/innovation__os9bmmo3mjee_large.jpg" alt="Security" class="w-full h-full object-cover">
                                <div class="absolute inset-0 flex flex-col justify-end px-6 py-4 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                                    <span class="text-sm font-semibold text-white mb-2">Security</span>
                                    <h3 class="text-2xl font-semibold text-white mb-3">Data selalu aman.</h3>
                                </div>
                            </a>
                        </div>

                        <!-- Feature Card 5 - Support -->
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

                <!-- Navigation Buttons -->
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

            <!-- Navigation Dots -->
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

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-[#004E8D] to-[#128AEB] py-16 hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Mulai Digitalisasi Bisnis Anda Sekarang</h2>
            <p class="text-white/90 mb-8 text-lg">Bergabung dengan ribuan bisnis yang telah menggunakan Centrova</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-bold rounded-full text-[#128AEB] bg-white hover:bg-[#E3F2FD] shadow transition">
                    Daftar Gratis
                </a>
                <a href="/contact" class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-base font-bold rounded-full text-white hover:bg-white/10 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</div>

@endsection