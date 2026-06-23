<nav class="bg-neutral-50/60 backdrop-blur-xl h-[60px] relative z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">
            {{-- Logo + Menu Desktop --}}
            <div class="flex items-center gap-x-6">
                <a href="{{ route('home') }}">
                    <img src="/assets/brand/centrova-logo.svg" class="h-[26px] w-auto" alt="Centrova Logo" draggable="false" />
                </a>
                <div class="hidden md:flex md:gap-x-2 text-base font-medium text-neutral-800 items-center text-sm text-left">
                    <a href="{{ route('services.index') }}" class="px-2 hover:text-black transition duration-500">Overview</a>
                    <a href="{{ route('services.web-development') }}" class="px-2 hover:text-black transition duration-500">Website</a>
                    <a href="{{ route('services.app-development') }}" class="px-2 hover:text-black transition duration-500">Aplikasi</a>
                    <a href="{{ route('services.uiux-design') }}" class="px-2 hover:text-black transition duration-500">Desain UI/UX</a>
                </div>
            </div>
            <div class="flex items-center max-md:hidden gap-x-2 hidden">
                <img src="{{ asset('assets/image/customer-profile/frisca.png') }}" srcset="{{ asset('assets/image/customer-profile/frisca.png') }}" class="h-[28px] aspect-square rounded-full">
                <div class="flex flex-col items-center">
                    <span class="text-xs">Butuh Bantuan Kami?</span>
                    <button type="button" class="text-xs text-blue-600 text-left w-full">Hubungi Spesialis</button>
                </div>
            </div>
            {{-- Hamburger Mobile --}}
            <div class="md:hidden">
                <button id="menuToggle" class="p-2 text-[#128AEB] hover:bg-[#E3F2FD] rounded-full focus:outline-none focus:ring-2 focus:ring-[#128AEB]">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- Mobile Menu: Fullscreen dari bawah navbar --}}
<div id="mobileMenu" class="fixed top-0 inset-x-0 bottom-0 bg-white/95 z-[50] flex flex-col items-start py-5 px-11 pt-[70px] justify-start -translate-y-[100vh] pointer-events-none transition-all duration-700 ease-in-out">
    @auth
        <div class="w-full flex items-center mb-8">
            <img src="/assets/icons/ui/account/profile.svg" class="w-12 h-12 rounded-full border-2 border-[#128AEB]" alt="Profile">
        </div>
    @endauth
    <a href="{{ route('home') }}" class="mobile-link text-3xl font-bold text-[#128AEB] mb-6 opacity-0 translate-y-2 transition duration-200 delay-500">Home</a>
    <a href="#fitur" class="mobile-link text-2xl font-semibold text-[#004E8D] mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Fitur</a>
    <a href="#testimoni" class="mobile-link text-2xl font-semibold text-[#004E8D] mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Testimoni</a>
    <a href="#tentang" class="mobile-link text-2xl font-semibold text-[#004E8D] mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Tentang</a>
    <a href="#daftar" class="mobile-link text-2xl font-semibold text-[#004E8D] mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Daftar</a>
    {{-- Team link removed --}}
    <a href="{{ route('contact') }}" class="mobile-link text-2xl font-semibold text-[#128AEB] mt-8 opacity-0 translate-y-2 transition duration-200 delay-500">Hubungi Kami</a>
    @auth
        <form method="POST" action="{{ '#' }}">
            @csrf
            <button type="submit" class="mobile-link text-2xl font-semibold text-red-600 mt-2 opacity-0 translate-y-2 transition duration-200 delay-500">Sign Out</button>
        </form>
    @else
        <a href="{{ '#' }}" class="mobile-link text-2xl font-semibold text-[#128AEB] mt-2 opacity-0 translate-y-2 transition duration-200 delay-500">Sign In</a>
    @endauth
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('menuToggle');
        const menu = document.getElementById('mobileMenu');
        const links = document.querySelectorAll('.mobile-link');
        let open = false;

        toggle.addEventListener('click', function () {
            open = !open;

            if (open) {
                menu.classList.remove('opacity-0', '-translate-y-[100vh]', 'pointer-events-none');
                menu.classList.add('opacity-100', 'translate-y-0');

                links.forEach((link, i) => {
                    setTimeout(() => {
                        link.classList.remove('translate-y-2');
                        link.classList.add('opacity-100', 'translate-y-0');
                    }, 100 * i);
                });
            } else {
                menu.classList.add('-translate-y-[100vh]', 'pointer-events-none');
                menu.classList.remove('opacity-100', 'translate-y-0');

                links.forEach(link => {
                    link.classList.remove('opacity-100', 'translate-y-0');
                    link.classList.add('opacity-0', 'translate-y-2');
                });
            }
        });
    });
</script>
