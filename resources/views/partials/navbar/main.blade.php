
<style>
    [x-cloak] {
        display: none !important;
    }
    
    /* Apple-style hamburger animation */
    .hamburger {
        cursor: pointer;
        width: 24px;
        height: 24px;
        transition: all 0.25s;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hamburger-container {
        position: relative;
        width: 20px;
        height: 16px;
    }
    
    .hamburger-top,
    .hamburger-middle,
    .hamburger-bottom {
        position: absolute;
        left: 0;
        width: 20px;
        height: 2px;
        background: currentColor;
        border-radius: 1px;
        transform: rotate(0);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .hamburger-top {
        top: 0;
    }
    
    .hamburger-middle {
        top: 7px;
    }
    
    .hamburger-bottom {
        top: 14px;
    }
    
    /* Open state */
    .hamburger.open .hamburger-top {
        top: 7px;
        transform: rotate(45deg);
    }
    
    .hamburger.open .hamburger-middle {
        opacity: 0;
        transform: scale(0);
    }
    
    .hamburger.open .hamburger-bottom {
        top: 7px;
        transform: rotate(-45deg);
    }
    
    /* Apple-style backdrop */
    .apple-backdrop {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
</style>

{{-- Navbar Modern --}}
<div class="h-[60px] w-full"></div>
<nav class="bg-white/85 w-full backdrop-blur-lg h-[60px] fixed top-0 mx-auto left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">
            {{-- Hamburger Mobile --}}
            <div class="md:hidden flex justify-center items-center">
                <button id="menuToggle" class="hamburger text-[#128AEB]">
                    <div class="hamburger-container">
                        <div class="hamburger-top"></div>
                        <div class="hamburger-middle"></div>
                        <div class="hamburger-bottom"></div>
                    </div>
                </button>
            </div>
            {{-- Logo + Menu Desktop --}}
            <div class="flex items-center gap-x-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('/assets/brand/centrova-logo.svg') }}" class="h-[26px] w-auto" alt="Centrova Logo" draggable="false" />
                </a>
                <div class="hidden md:flex md:gap-x-2 text-base font-medium text-neutral-800 items-center text-sm text-left">
                    <a href="{{ route('home') }}" class="px-2 hover:text-black transition duration-500 hidden">Beranda</a>
                    <a href="{{ route('about') }}" class="px-2 hover:text-black transition duration-500 hidden">Tentang</a>
                    <a href="{{ route('home.products.index') }}" class="px-2 hover:text-black transition duration-500">Produk</a>
                    <div class="relative group"
                         x-data="{ open: false, timeout: null }"
                         @click.away="open = false; clearTimeout(timeout)">

                      {{-- Button --}}
                      <button type="button" @click="open = !open"
                        class="px-2 flex items-center gap-1 hover:text-black transition duration-500 focus:outline-none">
                        Layanan
                        <svg class="w-4 h-4 ml-1 text-gray-600 transition-transform duration-300"
                             :class="{ 'rotate-180': open }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                      </button>

                      {{-- Dropdown --}}
                      <div x-show="open" x-cloak
                           x-transition:enter="transition ease-out duration-200"
                           x-transition:enter-start="opacity-0 -translate-y-4"
                           x-transition:enter-end="opacity-100 translate-y-0"
                           x-transition:leave="transition ease-in duration-150"
                           x-transition:leave-start="opacity-100 translate-y-0"
                           x-transition:leave-end="opacity-0 -translate-y-4"
                           class="absolute left-0 top-full mt-[26.3px] w-auto bg-white rounded-xl shadow-xl border border-neutral-100 overflow-hidden z-50 font-medium"
                           @mouseenter="clearTimeout(timeout)"
                           @mouseleave="timeout = setTimeout(() => open = false, 2000)">
                           
                        <div class="max-h-[40vh] overflow-y-auto whitespace-nowrap">
                          <a href="{{ localizedRoute('services.web.index') }}" class="block px-4 pr-12 py-2 text-sm transition">Pengembangan Web</a>
                          <a href="{{ localizedRoute('services.app.index') }}" class="block px-4 pr-12 py-2 text-sm transition">Pengembangan Aplikasi</a>
                          <a href="{{ localizedRoute('services.uiux.index') }}" class="block px-4 pr-12 py-2 text-sm transition">Desain UI/UX</a>
                          <a href="{{ localizedRoute('services.mobile-app.index') }}" class="block px-4 pr-12 py-2 text-sm transition">Pengembangan Aplikasi Mobile</a>
                          <a href="{{ localizedRoute('services.index') }}" class="block px-4 pr-12 py-2 text-sm transition">Lihat Semua Layanan</a>
                        </div>
                      </div>
                    </div>
                    <a href="{{ localizedRoute('contact') }}" class="px-2 hover:text-black transition duration-500 hidden">Kontak</a>
                    <a href="{{ route('support.home') }}" class="px-2 hover:text-black transition duration-500">Dukungan</a>
                </div>
            </div>
            {{-- Aksi Desktop --}}
            <div class="hidden md:flex md:items-center gap-2">
                @include('partials.navbar.components.account')
            </div>
            {{-- Aksi Mobile --}}
            <div class="md:hidden">
                @include('partials.navbar.components.account')
            </div>
        </div>
    </div>
</nav>

{{-- Apple-style backdrop --}}
<div id="mobileBackdrop" class="fixed inset-0 bg-white apple-backdrop z-30 opacity-0 pointer-events-none transition-all duration-700 ease-in-out"></div>

{{-- Mobile Menu: Apple-style slide from top --}}
<div id="mobileMenu" class="fixed left-0 right-0 bg-white z-40 border-b border-gray-200 -translate-y-full opacity-0 pointer-events-none transition-all duration-700 ease-in-out">
    <div class="px-12 py-8 h-[100vh] overflow-y-auto">
        <div class="space-y-1">
            <a href="{{ route('home') }}" class="mobile-link block py-3 text-3xl font-semibold text-gray-700 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Beranda</a>
            <a href="{{ localizedRoute('home.products.index') }}" class="mobile-link block py-3 text-3xl font-semibold text-gray-700 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Produk</a>
            <a href="{{ localizedRoute('services.index') }}" class="mobile-link block py-3 text-3xl font-semibold text-gray-700 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Layanan</a>
            <a href="{{ route('support.home') }}" class="mobile-link block py-3 text-3xl font-semibold text-gray-700 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Dukungan</a>
            <a href="{{ route('contact') }}" class="mobile-link block py-3 text-3xl font-semibold text-gray-700 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Hubungi Kami</a>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/mobile-menu.js') }}"></script>
@endpush
