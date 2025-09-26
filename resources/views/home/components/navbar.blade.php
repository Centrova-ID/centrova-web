<!-- Navbar Modern -->
<div class="h-[60px]"></div>
<nav class="bg-white/95 backdrop-blur-lg shadow-xl shadow-black/[3%] h-[60px] fixed top-0 inset-x-0 z-50 border-b border-[#128AEB]/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">
            <!-- Logo + Menu Desktop -->
            <div class="flex items-center gap-x-4">
                <a href="{{ route('home') }}">
                    <img src="/assets/brand/centrova-logo.svg" class="h-[26px] w-auto" alt="Centrova Logo" draggable="false" />
                </a>
                <div class="hidden md:flex md:space-x-2 text-base font-medium text-neutral-800 items-center text-sm">
                    <a href="{{ route('home') }}" class="px-2 hover:text-black transition duration-500 hidden">Home</a>
                    <a href="#tentang" class="px-2 hover:text-black transition duration-500">Tentang</a>
                    <a href="#fitur" class="px-2 hover:text-black transition duration-500">Produk</a>
                    <a href="#testimoni" class="px-2 hover:text-black transition duration-500 hidden">Testimoni</a>
                    <a href="{{ route('support.home') }}" class="px-2 hover:text-black transition duration-500">Dukungan</a>
                    <a href="{{ url('/team') }}" class="px-2 hover:text-black transition duration-500 hidden">Tim Kami</a>
                </div>
            </div>
            <!-- Aksi Desktop -->
            <div class="hidden md:flex md:items-center gap-2">
                <a href="{{ route('contact') }}" class="bg-[#128AEB] text-white px-5 py-2 rounded-full font-bold shadow hover:bg-[#0d6bb8] transition hidden">Hubungi Kami</a>
                <a href="{{ route('contact') }}" class="bg-[#128AEB] text-white px-5 py-2 rounded-full font-bold shadow hover:bg-[#2d8ad6] transition">Sign In</a>
            </div>
            <!-- Hamburger Mobile -->
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

<!-- Mobile Menu: Fullscreen dari bawah navbar -->
<div id="mobileMenu" class="fixed top-0 inset-x-0 bottom-0 bg-white/95 z-40 flex flex-col items-start py-5 px-11 pt-[70px] justify-start -translate-y-[100vh] pointer-events-none transition-all duration-700 ease-in-out shadow-2xl">
    <a href="{{ route('home') }}" class="mobile-link text-3xl font-bold text-[#128AEB] mb-6 opacity-0 translate-y-2 transition duration-200 delay-500">Home</a>
    <a href="#fitur" class="mobile-link text-2xl font-semibold text-[#004E8D] mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Fitur</a>
    <a href="#testimoni" class="mobile-link text-2xl font-semibold text-[#004E8D] mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Testimoni</a>
    <a href="#tentang" class="mobile-link text-2xl font-semibold text-[#004E8D] mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Tentang</a>
    <a href="#daftar" class="mobile-link text-2xl font-semibold text-[#004E8D] mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Daftar</a>
    <a href="{{ url('/team') }}" class="mobile-link text-2xl font-semibold text-[#128AEB] mt-2 opacity-0 translate-y-2 transition duration-200 delay-500">Our Tim</a>
    <a href="{{ route('contact') }}" class="mobile-link text-2xl font-semibold text-[#128AEB] mt-8 opacity-0 translate-y-2 transition duration-200 delay-500">Hubungi Kami</a>
    <a href="{{ route('contact') }}" class="mobile-link text-2xl font-semibold text-[#128AEB] mt-2 opacity-0 translate-y-2 transition duration-200 delay-500">Sign In</a>
</div>

@push('scripts')
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
@endpush
