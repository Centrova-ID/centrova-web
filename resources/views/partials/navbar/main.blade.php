
<style>
    [x-cloak] {
        display: none !important;
    }
    
    /* Apple-style navbar with dynamic height */
    .apple-navbar {
        transition: height 600ms cubic-bezier(0.4, 0, 0.2, 1), background-color 400ms ease;
        will-change: height, background-color;
        overflow: hidden;
    }
    
    /* Apple-style backdrop blur */
    .apple-backdrop {
        backdrop-filter: saturate(180%) blur(20px);
        -webkit-backdrop-filter: saturate(180%) blur(20px);
        background-color: rgba(255, 255, 255, 0.90);
    }
    
    /* Mega menu animations */
    .mega-menu {
        transition: all 400ms cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Mega menu item hover effect */
    .mega-menu-item {
        transition: all 200ms cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .mega-menu-item:hover {
        transform: scale(1.02);
    }
    
    /* Staggered animation for mega menu items */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .mega-menu-item.animate {
        animation: fadeInUp 300ms cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    
    .mega-menu-item:nth-child(1) { animation-delay: 0ms; }
    .mega-menu-item:nth-child(2) { animation-delay: 50ms; }
    .mega-menu-item:nth-child(3) { animation-delay: 100ms; }
    .mega-menu-item:nth-child(4) { animation-delay: 150ms; }
    .mega-menu-item:nth-child(5) { animation-delay: 200ms; }
    .mega-menu-item:nth-child(6) { animation-delay: 250ms; }
    
    /* Apple-style hamburger for mobile */
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
    
    .hamburger-top { top: 0; }
    .hamburger-middle { top: 7px; }
    .hamburger-bottom { top: 14px; }
    
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
    
    /* Menu overlay background */
    .menu-overlay {
        backdrop-filter: saturate(180%) blur(20px);
        -webkit-backdrop-filter: saturate(180%) blur(20px);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .navbar-transparent {
        background-color: transparent !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
        border-color: transparent !important;
    }

    .navbar-transparent .nav-link {
        color: white !important;
    }

    .navbar-transparent .nav-logo,
    .navbar-transparent svg,
    .navbar-transparent img:not(.nav-logo) {
        filter: brightness(0) invert(1) !important;
    }

    .navbar-transparent .border-\[#128AEB\],
    .navbar-transparent .text-\[#128AEB\] {
        border-color: white !important;
        color: white !important;
    }
</style>

<style type="text/tailwindcss">
    .mega-menu-item {
        @apply block text-slate-800 hover:text-slate-900 font-semibold text-xl opacity-0;
    }
</style>

{{-- Navbar Modern Apple Style --}}
@unless(request()->routeIs('home'))
<div class="h-[60px] w-full"></div>
@endunless

<div x-data="navbarMenu()" 
     @scroll.window="handleScroll"
     class="fixed top-0 left-0 right-0 z-50 overflow-hidden">
     
    {{-- Main Navbar --}}
    <nav class="apple-navbar apple-backdrop border-b border-gray-200/50"
         :class="{ 'navbar-transparent': isTransparent && activeMenu === null }"
         :style="'height: ' + navHeight + 'px'">
         
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-[60px] items-center gap-x-10">
                
                {{-- Hamburger Mobile --}}
                <div class="md:hidden flex justify-center items-center">
                    <button @click="toggleMobileMenu" 
                            class="hamburger"
                            :class="{ 'open': mobileMenuOpen, 'text-white': isTransparent && activeMenu === null, 'text-[#1d1d1f]': !(isTransparent && activeMenu === null) }">
                        <div class="hamburger-container">
                            <div class="hamburger-top"></div>
                            <div class="hamburger-middle"></div>
                            <div class="hamburger-bottom"></div>
                        </div>
                    </button>
                </div>
                
                {{-- Logo --}}
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('home') }}" class="select-none">
                        <img src="{{ asset('/assets/brand/centrova-logo.svg') }}" 
                             class="h-[26px] w-auto transition-all duration-300 nav-logo" 
                             alt="Centrova Logo" 
                             draggable="false" />
                    </a>
                </div>
                
                {{-- Desktop Menu --}}
                <div class="hidden md:flex md:items-center w-full md:gap-x-8">
                    <div class="flex items-center gap-x-8 text-base font-normal transition-colors duration-300"
                         :class="(isTransparent && activeMenu === null) ? 'text-white' : 'text-[#1d1d1f]'">
                        
                        {{-- Menu Item: Bisnis --}}
                        <div class="relative"
                             @mouseenter="openMenu('bisnis')"
                             @mouseleave="scheduleClose">
                            <button class="py-2 hover:opacity-85 transition-opacity duration-200">
                                Bisnis
                            </button>
                        </div>
                        
                        {{-- Menu Item: Layanan --}}
                        <div class="relative"
                             @mouseenter="openMenu('layanan')"
                             @mouseleave="scheduleClose">
                            <button class="py-2 hover:opacity-85 transition-opacity duration-200">
                                Layanan
                            </button>
                        </div>
                        
                        {{-- Menu Item: Produk --}}
                        <div class="relative"
                             @mouseenter="openMenu('produk')"
                             @mouseleave="scheduleClose">
                            <button class="py-2 hover:opacity-85 transition-opacity duration-200">
                                Produk
                            </button>
                        </div>
                        
                        <a href="{{ route('support.home') }}" 
                           data-turbo-prefetch
                           class="py-2 hover:opacity-85 transition-opacity duration-200">
                            Dukungan
                        </a>
                    </div>
                </div>
                
                {{-- Account Actions (Disabled) --}}
                {{-- <div class="flex items-center transition-colors duration-300" 
                     :class="(isTransparent && activeMenu === null) ? 'text-white' : 'text-[#1d1d1f]'">
                    @include('partials.navbar.components.account')
                </div> --}}
            </div>
        </div>
        
        {{-- Mega Menu Container --}}
        <div class="relative"
             @mouseenter="cancelClose"
             @mouseleave="scheduleClose">
             
              {{-- Mega Menu: Bisnis --}}
              <div data-menu="bisnis" x-show="activeMenu === 'bisnis'" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-600 delay-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                 
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-4 gap-8">
                        
                        {{-- Column 1: Featured Product --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Unggulan
                            </h3>
                            <a href="{{ route('products.business.index') }}" 
                               data-turbo-prefetch
                               class="mega-menu-item">Centrova Enterprise</a>
                        </div>
                        
                        {{-- Column 2: Categories --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Aplikasi
                            </h3>
                            <div class="space-y-2">
                                <a href="{{ route('products.business.crm') }}" 
                                   data-turbo-prefetch
                                   class="mega-menu-item">CRM</a>
                                <a href="{{ route('products.business.sales') }}" 
                                   data-turbo-prefetch
                                   class="mega-menu-item">Sales</a>
                                <a href="{{ route('products.business.erp') }}" 
                                   data-turbo-prefetch
                                   class="mega-menu-item">ERP</a>
                            </div>
                        </div>
                        
                        {{-- Column 3: More Apps --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Lainnya
                            </h3>
                            <div class="space-y-2">
                                <a href="{{ route('products.business.pos') }}" 
                                   class="mega-menu-item">POS</a>
                                <a href="{{ route('products.business.rental') }}" 
                                   class="mega-menu-item">Rental</a>
                            </div>
                        </div>
                        
                        {{-- Column 4: Resources --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Sumber Daya
                            </h3>
                            <div class="space-y-2">
                                <a href="#" class="mega-menu-item">Dokumentasi</a>
                                <a href="#" class="mega-menu-item">Demo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
              {{-- Mega Menu: Layanan --}}
              <div data-menu="layanan" x-show="activeMenu === 'layanan'" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-600 delay-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                 
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-5 gap-8">
                        {{-- All Services --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Jelajahi
                            </h3>
                            <a href="{{ localizedRoute('services.index') }}" 
                               data-turbo-prefetch
                               class="mega-menu-item">Semua Layanan</a>
                        </div>
                        
                        {{-- Development Services --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Pengembangan
                            </h3>
                            <div class="space-y-2">
                                <a href="{{ localizedRoute('services.web.index') }}" 
                                   data-turbo-prefetch
                                   class="mega-menu-item">Pengembangan Web</a>
                                <a href="{{ localizedRoute('services.app.index') }}" 
                                   data-turbo-prefetch
                                   class="mega-menu-item">Aplikasi Desktop</a>
                                <a href="{{ localizedRoute('services.mobile-app.index') }}" 
                                   data-turbo-prefetch
                                   class="mega-menu-item">iOS & Android native</a>
                            </div>
                        </div>
                        
                        {{-- Design Services --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Desain
                            </h3>
                            <div class="space-y-2">
                                <a href="{{ localizedRoute('services.uiux.index') }}" 
                                   data-turbo-prefetch
                                   class="mega-menu-item">UI/UX Design</a>
                            </div>
                        </div>

                        {{-- Lainnya --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Layanan Lainnya
                            </h3>
                            <div class="space-y-0">
                                <a href="{{ route('auditorlab') }}" class="mega-menu-item" style="font-size: 16px !important; font-weight: 500;">AuditorLab</a>
                                <a href="{{ localizedRoute('services.web-company-profile') }}" class="mega-menu-item" style="font-size: 16px !important; font-weight: 500;">Company Profile</a>
                                <a href="{{ localizedRoute('services.uiux.index') }}" class="mega-menu-item" style="font-size: 16px !important; font-weight: 500;">Toko Online</a>
                                <a href="{{ localizedRoute('services.uiux.index') }}" class="mega-menu-item" style="font-size: 16px !important; font-weight: 500;">Portfolio</a>
                            </div>
                        </div>

                        {{-- Lainnya --}}
                        <div class="col-span-1">
                            <h3 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-4">
                                Add-Ons
                            </h3>
                            <div class="space-y-0">
                                <a href="{{ localizedRoute('services.web-company-profile') }}" class="mega-menu-item" style="font-size: 16px !important; font-weight: 500;">Domain</a>
                                <a href="{{ localizedRoute('services.uiux.index') }}" class="mega-menu-item" style="font-size: 16px !important; font-weight: 500;">Hosting</a>
                                <a href="{{ localizedRoute('services.uiux.index') }}" class="mega-menu-item" style="font-size: 16px !important; font-weight: 500;">Cloud</a>
                                <a href="{{ localizedRoute('services.uiux.index') }}" class="mega-menu-item" style="font-size: 16px !important; font-weight: 500;">Solusi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
              {{-- Mega Menu: Produk --}}
              <div data-menu="produk" x-show="activeMenu === 'produk'" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-600 delay-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                 
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-3 gap-8">
                        <div class="col-span-3">
                            <a href="{{ localizedRoute('home.products.index') }}" 
                               class="mega-menu-item block rounded-lg p-6 opacity-0">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-lg font-semibold text-[#1d1d1f] mb-1">Jelajahi Semua Produk</div>
                                        <p class="text-sm text-gray-600">Temukan solusi yang tepat untuk bisnis Anda</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

{{-- Apple-style backdrop for mobile --}}
<div x-show="mobileMenuOpen" 
     x-cloak
     @click="closeMobileMenu"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 menu-overlay z-30"></div>

{{-- Mobile Menu: Apple-style slide from top --}}
<div x-show="mobileMenuOpen"
     x-cloak
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="-translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="-translate-y-full opacity-0"
     class="fixed left-0 right-0 bg-white z-40 border-b border-gray-200"
     style="top: 60px;">
     
    <div class="px-8 py-8 max-h-[calc(100vh-60px)] overflow-y-auto">
        <div class="space-y-2">
            <a href="{{ route('home') }}" 
               class="block py-3 text-2xl font-semibold text-gray-700 border-b border-gray-100 hover:text-black transition">
                Beranda
            </a>
            <a href="{{ localizedRoute('home.products.index') }}" 
               class="block py-3 text-2xl font-semibold text-gray-700 border-b border-gray-100 hover:text-black transition">
                Produk
            </a>
            
            {{-- Aplikasi Bisnis Section --}}
            <div class="py-3 border-b border-gray-100">
                <div class="text-xl font-semibold text-gray-700 mb-3">Aplikasi Bisnis</div>
                <div class="ml-4 space-y-2">
                    <a href="{{ route('products.business.index') }}" 
                       class="block py-2 text-base text-gray-600 hover:text-[#128AEB] transition">
                        Centrova Enterprise
                    </a>
                    <a href="{{ route('products.business.crm') }}" 
                       class="block py-2 text-base text-gray-600 hover:text-[#128AEB] transition">
                        CRM
                    </a>
                    <a href="{{ route('products.business.sales') }}" 
                       class="block py-2 text-base text-gray-600 hover:text-[#128AEB] transition">
                        Sales
                    </a>
                    <a href="{{ route('products.business.erp') }}" 
                       class="block py-2 text-base text-gray-600 hover:text-[#128AEB] transition">
                        ERP
                    </a>
                    <a href="{{ route('products.business.pos') }}" 
                       class="block py-2 text-base text-gray-600 hover:text-[#128AEB] transition">
                        POS
                    </a>
                    <a href="{{ route('products.business.rental') }}" 
                       class="block py-2 text-base text-gray-600 hover:text-[#128AEB] transition">
                        Rental
                    </a>
                </div>
            </div>
            
            <a href="{{ localizedRoute('services.index') }}" 
               class="block py-3 text-2xl font-semibold text-gray-700 border-b border-gray-100 hover:text-black transition">
                Layanan
            </a>
            <a href="{{ route('support.home') }}" 
               class="block py-3 text-2xl font-semibold text-gray-700 border-b border-gray-100 hover:text-black transition">
                Dukungan
            </a>
            <a href="{{ route('contact') }}" 
               class="block py-3 text-2xl font-semibold text-gray-700 border-b border-gray-100 hover:text-black transition">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function navbarMenu() {
    return {
        activeMenu: null,
        mobileMenuOpen: false,
        navHeight: 60,
        closeTimeout: null,
        lastScrollY: 0,
        isHome: {{ request()->routeIs('home') ? 'true' : 'false' }},
        isTransparent: {{ request()->routeIs('home') ? 'true' : 'false' }},
        
        init() {
            // Initial scroll check
            this.handleScroll();
            // Trigger staggered animation for mega menu items
            this.$watch('activeMenu', (value) => {
                    if (value !== null) {
                        // measure the menu container and set navHeight dynamically
                        this.calculateNavHeight(value).then(h => {
                            this.navHeight = h;

                            // trigger staggered animations for visible items
                            this.$nextTick(() => {
                                const items = document.querySelectorAll(`[data-menu="${value}"] .mega-menu-item`);
                                items.forEach((item, index) => {
                                    item.classList.remove('animate');
                                    setTimeout(() => item.classList.add('animate'), 40 * index);
                                });
                            });
                        });
                    } else {
                        // Delay collapsing the height to allow content to fade out
                        setTimeout(() => {
                            if (this.activeMenu === null) {
                                this.navHeight = 60;
                            }
                        }, 200);
                        
                        document.querySelectorAll('.mega-menu-item').forEach(item => {
                            item.classList.remove('animate');
                        });
                    }
                
                // Update CSS variable for overlay positioning
                document.documentElement.style.setProperty('--navbar-height', this.navHeight + 'px');
            });
        },
        
        async calculateNavHeight(menuName) {
            // Calculate navbar height dynamically by measuring the menu DOM node
            const baseHeight = 60;
            await this.$nextTick();
            const el = document.querySelector(`[data-menu="${menuName}"]`);
            if (!el) return baseHeight;

            // When x-show transition is in progress, the element may still be rendered
            // but with transitions. Use scrollHeight to get full content height.
            const contentHeight = el.scrollHeight || el.offsetHeight || 0;
            return baseHeight + contentHeight;
        },
        
        openMenu(menuName) {
            this.cancelClose();
            this.activeMenu = menuName;
        },
        
        closeMenu() {
            this.activeMenu = null;
        },
        
        scheduleClose() {
            this.closeTimeout = setTimeout(() => {
                this.closeMenu();
            }, 300);
        },
        
        cancelClose() {
            if (this.closeTimeout) {
                clearTimeout(this.closeTimeout);
                this.closeTimeout = null;
            }
        },
        
        toggleMobileMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
            
            // Prevent body scroll when menu is open
            if (this.mobileMenuOpen) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        },
        
        closeMobileMenu() {
            this.mobileMenuOpen = false;
            document.body.style.overflow = '';
        },
        
        handleScroll() {
            const currentScrollY = window.scrollY;
            
            // Toggle transparency for home page hero
            if (this.isHome) {
                // Threshold matches hero min-height (550) - some buffer (100)
                this.isTransparent = currentScrollY < 600;
            } else {
                this.isTransparent = false;
            }

            // Close mega menu on scroll
            if (this.activeMenu !== null && Math.abs(currentScrollY - this.lastScrollY) > 50) {
                this.closeMenu();
            }
            
            this.lastScrollY = currentScrollY;
        }
    }
}
</script>
@endpush
