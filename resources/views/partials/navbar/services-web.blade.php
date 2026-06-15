
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
                    <a href="{{ route('services.web.index') }}" class="px-2 hover:text-black transition duration-500">Buat Website</a>
                    <a href="{{ route('services.web.index') }}" class="px-2 hover:text-black transition duration-500">Keamanan</a>
                    <a href="{{ route('services.app.index') }}" class="px-2 hover:text-black transition duration-500">Showcase</a>
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
    <div class="px-6 py-8 h-[100vh] overflow-y-auto">
        <div class="space-y-1">
            @auth
                <div class="flex items-center mb-6 pb-6 border-b border-gray-100 hidden">
                    <img src="/assets/icons/ui/account/profile.svg" class="w-10 h-10 rounded-full border-2 border-[#128AEB] mr-3" alt="Profile">
                    <div>
                        <div class="font-medium text-gray-900">Welcome</div>
                    </div>
                </div>
            @endauth
            
            <a href="{{ route('home') }}" class="mobile-link block py-3 text-xl font-medium text-gray-900 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Beranda</a>
            <a href="{{ localizedRoute('home.products.index') }}" class="mobile-link block py-3 text-xl font-medium text-gray-900 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Produk</a>
            <a href="{{ localizedRoute('services.index') }}" class="mobile-link block py-3 text-xl font-medium text-gray-900 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Layanan</a>
            <a href="{{ route('support.home') }}" class="mobile-link block py-3 text-xl font-medium text-gray-900 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Dukungan</a>
            <a href="{{ route('contact') }}" class="mobile-link block py-3 text-xl font-medium text-gray-900 border-b border-gray-100 opacity-0 translate-y-4 transition-all duration-300">Hubungi Kami</a>
            
            @auth
                <form method="POST" action="{{ '#' }}" class="mt-6 pt-6 border-t border-gray-100">
                    @csrf
                    <button type="submit" class="mobile-link block py-3 text-xl font-medium text-red-600 opacity-0 translate-y-4 transition-all duration-300">Keluar</button>
                </form>
            @else
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <a href="{{ '#' }}" class="mobile-link block py-3 text-xl font-medium text-[#128AEB] opacity-0 translate-y-4 transition-all duration-300">Masuk</a>
                </div>
            @endauth
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/mobile-menu.js') }}"></script>
@endpush
