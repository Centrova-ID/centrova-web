<!-- Navbar -->
<div class="h-[50px]"></div>
<nav class="bg-white/90 backdrop-blur-md h-[50px] fixed top-0 inset-x-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12 items-center">
            <!-- Logo + Menu Desktop -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="assets/brand/centrova-logo.svg" class="h-[24px] w-auto" alt="Centrova Logo" style="user-drag: none; user-select: none; -webkit-user-drag: none;">
                </a>
                <div class="hidden sm:flex sm:ml-6 sm:space-x-6 text-base font-medium text-slate-600 items-center">
                    <a href="#" class="px-2 hover:text-slate-800 transition">Home</a>
                    <a href="#" class="px-2 hover:text-slate-800 transition">Products</a>
                    <a href="#" class="px-2 hover:text-slate-800 transition">Support</a>
                </div>
            </div>

            <!-- Aksi Desktop -->
            <div class="hidden sm:flex sm:items-center sm:space-x-3">
                @auth
                    <!-- Chat Button for Logged in Users -->
                    <a href="{{ route('support.web.chat') }}" class="flex items-center space-x-2 px-3 py-1.5 text-blue-600 border border-blue-600 rounded hover:bg-blue-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span>Chat</span>
                    </a>
                    
                    <!-- Account Button -->
                    <a href="{{ route('profile.index') }}" class="flex items-center space-x-2 px-3 py-1.5 text-gray-600 border border-gray-300 rounded hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Akun</span>
                    </a>
                @else
                    <!-- Login Button for Guests -->
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Login</a>
                @endauth
            </div>

            <!-- Hamburger Mobile -->
            <div class="sm:hidden">
                <button id="menuToggle" class="p-1.5 text-gray-500 hover:text-gray-700 focus:outline-none rounded focus:ring-2 focus:ring-blue-500">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu: Fullscreen dari bawah navbar -->
<div id="mobileMenu" class="fixed top-0 inset-x-0 bottom-0 bg-white z-40 flex flex-col items-start py-5 px-11 pt-[60px] justify-start -translate-y-[100vh] pointer-events-none transition-all duration-700 ease-in-out">
    <a href="{{ route('home') }}" class="mobile-link text-3xl font-semibold text-gray-700 mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Home</a>
    <a href="{{ route('home.products.index') }}" class="mobile-link text-3xl font-semibold text-gray-700 mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Products</a>
    <a href="{{ route('support.home') }}" class="mobile-link text-3xl font-semibold text-gray-700 mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Support</a>
    
    @auth
        <a href="{{ route('support.web.chat') }}" class="mobile-link text-3xl font-semibold text-blue-600 mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Chat</a>
        <a href="{{ route('profile.index') }}" class="mobile-link text-3xl font-semibold text-gray-700 mb-4 opacity-0 translate-y-2 transition duration-200 delay-500">Akun</a>
    @else
        <a href="{{ route('login') }}" class="mobile-link text-3xl font-semibold text-blue-600 mt-6 opacity-0 translate-y-2 transition duration-200 delay-500">Login</a>
    @endauth
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
