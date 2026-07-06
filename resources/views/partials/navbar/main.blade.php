{{-- HEADER / NAVBAR CONTAINER --}}
<div x-data="{ activeMegaMenu: null, hoverTimeout: null }">
<header class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-start h-16">
            
            {{-- Logo & Desktop Main Nav --}}
            <div class="flex items-center flex-1">
                {{-- Mobile Menu Button (Hamburger) --}}
                <button 
                    @click="window.dispatchEvent(new CustomEvent('toggle-menu'))"
                    type="button" 
                    class="inline-flex items-center justify-center p-2 rounded-md text-neutral-700 hover:bg-gray-100 hover:text-neutral-900 focus:outline-none md:hidden transition duration-150"
                    aria-label="Buka menu"
                >
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- Google Logo Style --}}
                <a href="{{ route('home') }}" class="px-3 h-12 hover:bg-gray-50 rounded-md flex items-center ml-2 md:ml-0 mr-8 select-none">
                    <img src="{{ asset('/assets/brand/centrova-logo.svg') }}" 
                         class="h-[24px] w-auto transition-all duration-300" 
                         alt="Centrova Logo" 
                         draggable="false" />
                </a>

                {{-- DESKTOP NAVIGATION --}}
                <nav class="hidden md:flex space-x-1 h-16 items-center py-2">

                    {{-- Layanan --}}
                    <div 
                        class="relative h-full flex items-center"
                        @mouseenter="clearTimeout(hoverTimeout); activeMegaMenu = 'layanan'"
                        @mouseleave="hoverTimeout = setTimeout(() => { activeMegaMenu = null }, 150)">
                        <button class="px-3 h-full flex items-center text-[15px] font-semibold transition hover:bg-gray-50 rounded-md text-neutral-600 hover:text-neutral-900"
                        >
                            Layanan
                            <svg :class="activeMegaMenu === 'layanan' ? 'rotate-180 text-primary-500' : 'text-neutral-700'" class="ml-1.5 h-4 w-4 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>

                    {{-- Tentang Kami --}}
                    <a href="{{ route('about') }}" class="px-3 h-full flex items-center text-[15px] font-semibold transition hover:bg-gray-50 rounded-md text-neutral-600 hover:text-neutral-900">
                        Tentang Kami
                    </a>

                    {{-- Brand --}}
                    <a href="{{ route('brands.index') }}" class="px-3 h-full flex items-center text-[15px] font-semibold transition hover:bg-gray-50 rounded-md text-neutral-600 hover:text-neutral-900">
                        Brand
                    </a>
                </nav>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- DESKTOP MEGA MENUS (FULL WIDTH) --}}
    {{-- ========================================== --}}

    {{-- Mega Menu: Layanan --}}
    <div 
        x-show="activeMegaMenu === 'layanan'"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="absolute left-0 right-0 w-full bg-white border-b border-gray-200 shadow-lg z-40 hidden md:block"
        @mouseenter="clearTimeout(hoverTimeout); activeMegaMenu = 'layanan'"
        @mouseleave="hoverTimeout = setTimeout(() => { activeMegaMenu = null }, 150)"
        style="display: none;"
    >
        <div class="max-w-[1440px] mx-auto px-8 py-10 grid grid-cols-4 gap-8">
            {{-- Col 1 --}}
            <div>
                <h3 class="text-base font-semibold text-neutral-900 font-semibold mb-4">Berkembang bersama AI</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('services.ai-strategy') }}" class="text-base font-medium text-neutral-700 hover:text-neutral-900 block transition">AI Strategy</a></li>
                    <li><a href="{{ route('services.ai-agents') }}" class="text-base font-medium text-neutral-700 hover:text-neutral-900 block transition">AI Agents</a></li>
                    <li><a href="{{ route('services.ai-automation') }}" class="text-base font-medium text-neutral-700 hover:text-neutral-900 block transition">AI Automation</a></li>
                </ul>
            </div>
            {{-- Col 2 --}}
            <div>
                <h3 class="text-base font-semibold text-neutral-900 font-semibold mb-4">Pengembangan Perangkat Lunak</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('services.custom-solution.index') }}" class="text-base font-medium text-neutral-700 hover:text-neutral-900 block transition">Custom Software Development</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-base font-medium text-neutral-700 hover:text-neutral-900 block transition">Web & Mobile App Development</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-base font-medium text-neutral-700 hover:text-neutral-900 block transition">Business Systems</a></li>
                </ul>
            </div>
            {{-- Col 4 Banner --}}
            <div class="col-span-2 bg-neutral-50 p-6 rounded-xl w-full flex flex-col justify-center">
                <ul class="space-y-3">
                    <li><a href="{{ route('service.consult') }}" class="text-base font-semibold text-neutral-900 hover:text-primary-600 hover:underline">Mulai konsultasi</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-base font-semibold text-neutral-900 hover:text-primary-600 hover:underline">Jelajahi layanan</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

{{-- ========================================== --}}
{{-- MOBILE SIDEBAR (DRAWER) --}}
{{-- ========================================== --}}
<div 
    x-show="mobileMenuOpen" 
    x-effect="document.body.classList.toggle('overflow-hidden', mobileMenuOpen)"
    class="fixed inset-0 z-50 md:hidden" 
    style="display: none;">
    {{-- Backdrop --}}
    <div 
        x-show="mobileMenuOpen"
        x-transition:enter="transition-opacity ease-linear duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/80" 
        @click="mobileMenuOpen = false"
    ></div>

    {{-- Sidebar Container --}}
    <div 
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-in-out duration-150 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-150 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 flex flex-col w-full max-w-[80vw] bg-white shadow-2xl h-full"
    >
        {{-- Header Sidebar --}}
        <div class="flex items-center justify-between px-4 h-16 border-b border-neutral-300">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('/assets/brand/centrova-logo.svg') }}" 
                     class="h-[24px] w-auto transition-all duration-300" 
                     alt="Centrova Logo" 
                     draggable="false" />
            </a>
            <button 
                @click="mobileMenuOpen = false"
                type="button" 
                class="p-2 rounded-md text-neutral-700 hover:bg-gray-100 focus:outline-none"
            >
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Scrollable Nav Links --}}
        {{-- Mengubah state manajemen menjadi spesifik per section --}}
        <div class="flex-1 overflow-y-auto px-2 py-4" x-data="{ layananOpen: false, aiOpen: false, softwareOpen: false }">
            <nav>
                
                {{-- Accordion Item: Layanan --}}
                <div>
                    <button 
                        @click="layananOpen = !layananOpen"
                        class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">
                        <span>Layanan</span>
                        <svg :class="layananOpen ? 'rotate-180' : ''" class="h-5 w-5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    {{-- Submenu Layanan Container --}}
                    <div 
                        x-show="layananOpen" 
                        x-collapse
                        class="mt-1 pl-2 space-y-1 ml-2"
                        style="display: none;">
                        
                        {{-- Kategori 1: Berkembang bersama AI --}}
                        <div>
                            <button 
                                @click="aiOpen = !aiOpen"
                                class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">
                                <span>Berkembang bersama AI</span>
                                <svg :class="aiOpen ? 'rotate-180' : ''" class="h-5 w-5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div x-show="aiOpen" x-collapse class="pl-4 space-y-1" style="display: none;">
                                <a href="{{ route('services.ai-strategy') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">AI Strategy</a>
                                <a href="{{ route('services.ai-agents') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">AI Agents</a>
                                <a href="{{ route('services.ai-automation') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">AI Automation</a>
                            </div>
                        </div>
                        
                        {{-- Kategori 2: Pengembangan Perangkat Lunak --}}
                        <div>
                            <button 
                                @click="softwareOpen = !softwareOpen"
                                class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">
                                <span>Pengembangan Perangkat Lunak</span>
                                <svg :class="softwareOpen ? 'rotate-180' : ''" class="h-5 w-5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div x-show="softwareOpen" x-collapse class="pl-4 space-y-1" style="display: none;">
                                <a href="{{ route('services.custom-solution.index') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">Custom Software Development</a>
                                <a href="{{ route('services.index') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">Web & Mobile App Development</a>
                                <a href="{{ route('services.index') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">Business Systems</a>
                            </div>
                        </div>

                        {{-- Action Links --}}
                        <div>
                            <a href="{{ route('service.consult') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-blue-600 underline active:bg-gray-100 rounded-full">Mulai konsultasi</a>
                            <a href="{{ route('services.index') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-blue-600 underline active:bg-gray-100 rounded-full">Jelajahi layanan</a>
                        </div>
                    </div>
                </div>

                {{-- Regular Item: Tentang Kami --}}
                <a href="{{ route('about') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">
                    Tentang Kami
                </a>

                {{-- Regular Item: Brand --}}
                <a href="{{ route('brands.index') }}" class="w-full flex items-center justify-between px-5 py-3 text-base font-medium text-neutral-900 active:bg-gray-100 rounded-full text-left">
                    Brand
                </a>
            </nav>
        </div>
    </div>
</div>
{{-- END: Mobile Sidebar (Drawer) --}}
{{-- END: Navbar wrapper (activeMegaMenu scope) --}}