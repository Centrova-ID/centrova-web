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
        <div class="pt-16 pb-10" id="produk">
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
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Hero Box -->
                <div class="w-full bg-sky-100 rounded-[36px] p-8 sm:p-12 lg:p-16 min-h-[400px] lg:h-[540px] flex items-center justify-center lg:justify-start">
                    <div class="max-w-md text-center lg:text-left">
                        <span class="text-base font-medium text-slate-900">Jasa Pembuatan Website</span>
                        <h1 class="font-bold text-slate-900 text-3xl sm:text-4xl mt-2 leading-snug">
                            Ubah Ide Anda Menjadi Kenyataan
                        </h1>
                        <p class="text-slate-800 mt-4 text-base sm:text-lg">
                            Mulailah bangun "rumah" online Anda dengan memiliki website untuk merek Anda.
                        </p>
                        <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                           class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8">
                            Dapatkan Sekarang
                        </a>
                    </div>
                </div>

                {{-- Cards Section --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-12">
                    {{-- Card 1 --}}
                    <div class="w-full px-4 sm:px-8 lg:px-16">
                        <img src="https://www.exabytes.co.id/wp-content/uploads/product-icon-ecommerce-1-1.svg" alt="E-commerce Icon" class="h-[79px] mb-5 mx-0">
                        <span class="text-base text-slate-900 block text-left">Jasa Pembuatan Toko Online</span>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2 mb-3 text-left">
                            Segalanya Dimulai dari Toko Online
                        </h1>
                        <p class="text-slate-700 text-left">
                            Kami siap membantu Anda membangun toko online yang sesuai dengan kebutuhan Anda. Tingkatkan kehadiran digital bisnis Anda dan capai lebih banyak pelanggan secara online bersama kami!
                        </p>
                        <div class="flex justify-start">
                            <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                               class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-400 hover:border-[#128AEB] text-base font-semibold rounded-full text-sky-700 hover:text-[#128AEB] transition duration-150 mt-8">
                                Coba Sekarang
                            </a>
                        </div>
                    </div>

                    {{-- Card 2 --}}
                    <div class="w-full px-4 sm:px-8 lg:px-16">
                        <img src="https://www.exabytes.co.id/wp-content/uploads/product-icon-hosting-2.svg" alt="Hosting Icon" class="h-[79px] mb-5 mx-0">
                        <span class="text-base text-slate-900 block text-left">Website Profil Perusahaan</span>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2 mb-3 text-left">
                            Hosting Website di Tempat yang Tepat, Aman & Cepat
                        </h1>
                        <p class="text-slate-700 text-left">
                            Layanan kami menyertakan backup harian untuk file web Anda dan menggunakan server super cepat yang didedikasikan khusus untuk kebutuhan Anda. Percayakan keberhasilan online Anda pada layanan hosting terbaik kami!
                        </p>
                        <div class="flex justify-start">
                            <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                               class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-400 hover:border-[#128AEB] text-base font-semibold rounded-full text-sky-700 hover:text-[#128AEB] transition duration-150 mt-8">
                                Coba Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Paket Lengkap Section --}}
        <div class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Hero Box -->
                <div class="w-full bg-sky-100 rounded-[36px] p-8 sm:p-12 lg:p-16 min-h-[400px] lg:h-[540px] flex items-center justify-center lg:justify-start">
                    <div class="max-w-md text-center lg:text-left">
                        <span class="text-base font-medium text-slate-900">Jasa Pembuatan Website</span>
                        <h1 class="font-bold text-slate-900 text-3xl sm:text-4xl mt-2 leading-snug">
                            Ubah Ide Anda Menjadi Kenyataan
                        </h1>
                        <p class="text-slate-800 mt-4 text-base sm:text-lg">
                            Mulailah bangun "rumah" online Anda dengan memiliki website untuk merek Anda.
                        </p>
                        <a href="{{ localizedRoute('services.index') }}?utm_source=learn"
                           class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-[#128AEB] hover:bg-[#0F76C6] transition duration-150 mt-8">
                            Dapatkan Sekarang
                        </a>
                    </div>
                </div>

                {{-- Cards Section. Reff: https://www.exabytes.co.id/design --}}
                <div class="grid grid-cols-4 gap-7 mt-12">
                    {{-- Card 1 --}}
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h1 class="text-xl font-medium mb-5">Pengelolaan Layanan</h1>
                        <p class="text-base text-slate-800">Kami akan melakukan segalanya untuk Anda, mulai dari pembuatan hingga peluncuran, dan memastikan website Anda bekerja secara optimal.</p>
                    </div>
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h1 class="text-xl font-medium mb-5">Pengelolaan Layanan</h1>
                        <p class="text-base text-slate-800">Kami akan melakukan segalanya untuk Anda, mulai dari pembuatan hingga peluncuran, dan memastikan website Anda bekerja secara optimal.</p>
                    </div>
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h1 class="text-xl font-medium mb-5">Pengelolaan Layanan</h1>
                        <p class="text-base text-slate-800">Kami akan melakukan segalanya untuk Anda, mulai dari pembuatan hingga peluncuran, dan memastikan website Anda bekerja secara optimal.</p>
                    </div>
                    <div class="w-full bg-slate-100 p-8 rounded-3xl">
                        <h1 class="text-xl font-medium mb-5">Pengelolaan Layanan</h1>
                        <p class="text-base text-slate-800">Kami akan melakukan segalanya untuk Anda, mulai dari pembuatan hingga peluncuran, dan memastikan website Anda bekerja secara optimal.</p>
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
                                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=870&auto=format&fit=crop" alt="Digital Transformation" class="w-full h-full object-cover" loading="lazy">
                            </div>
                            <div class="pt-6">
                                <h3 class="text-xl text-slate-900">5 Tren Digital Transformation yang Harus Diketahui di 2024</h3>
                            </div>
                        </a>
                    </article>
                    
                    <article class="overflow-hidden">
                        <a href="{{ route('news.home') }}">
                            <div class="aspect-video bg-neutral-200 overflow-hidden rounded-3xl relative">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=815&auto=format&fit=crop" alt="Business Analytics" class="w-full h-full object-cover" loading="lazy">
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