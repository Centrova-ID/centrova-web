@php
use Illuminate\Support\Facades\Auth;
$isAuthenticated = Auth::check();
$userId = Auth::id();
$sessionId = session()->getId();
@endphp
<!-- Debug Info -->
@if(config('app.debug'))
    <div class="hidden">
        Auth Check: {{ $isAuthenticated ? 'true' : 'false' }}
        User ID: {{ $userId }}
        Session ID: {{ $sessionId }}
    </div>
@endif

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<!-- Navbar Modern -->
<div class="h-[60px]"></div>
<nav class="bg-black backdrop-blur-lg shadow-xl shadow-black/[3%] h-[60px] fixed top-0 inset-x-0 z-50 border-b border-black/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">
            <!-- Logo + Menu Desktop -->
            <div class="flex items-center gap-x-4">
                <a href="{{ route('home') }}">
                    <img src="/assets/brand/centrova-logo.svg" class="h-[26px] w-auto" alt="Centrova Logo" draggable="false" />
                </a>
                <div class="hidden ml-8 md:flex md:space-x-2 text-base font-medium text-neutral-800 items-center text-sm">
                    <a href="{{ route('services.index') }}" class="px-2 hover:text-black transition duration-500">Overview</a>
                    <a href="{{ route('services.web-development') }}" class="px-2 hover:text-black transition duration-500">Website</a>
                    <a href="{{ route('services.app-development') }}" class="px-2 hover:text-black transition duration-500">Aplikasi</a>
                    <a href="{{ route('services.uiux-design') }}" class="px-2 hover:text-black transition duration-500">Desain UI/UX</a>
                </div>
            </div>
            <!-- Aksi Desktop -->
            <div class="hidden md:flex md:items-center gap-2">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button 
                            @click="open = !open" 
                            class="flex items-center gap-1 px-4 py-2" title="Manajemen akun untuk {{ Auth::user()->full_name }}" 
                        >
                            <span class="px-2 text-sm">{{ Auth::user()->full_name }}</span>
                            <div class="w-8 h-8 border-[2px] border-[#128AEB] rounded-full overflow-hidden flex justify-center items-center">
                                <img 
                                    src="/assets/icons/ui/account/profile.svg" 
                                    class="w-5 h-5 object-cover" 
                                    alt="{{ Auth::user()->full_name }}'s Profile"
                                >
                            </div>
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                class="h-4 w-4 text-gray-600 transition-transform duration-300" 
                                :class="{ 'rotate-180': open }"
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown menu -->
                        <div 
                            x-show="open" 
                            x-cloak
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-4"
                            class="absolute right-2 mt-2 w-72 bg-white rounded-xl shadow-lg border border-neutral-100/50 py-2 pb-0 z-50"
                        >
                            <div class="px-4 py-3 border-b border-neutral-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 rounded-full bg-[#128AEB] overflow-hidden">
                                        <img src="/assets/icons/ui/account/profile.svg" class="w-full h-full object-cover" alt="Profile">
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->full_name }}</p>
                                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2 py-2 space-y-1">
                                <a href="https://account.centrova.id/account" class="flex items-center space-x-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span>Profil Saya</span>
                                </a>
                                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Settings</span>
                                </a>
                            </div>
                            <div class="border-t border-neutral-200 mt-2 px-2 py-2 space-y-1">
                                <form method="POST" action="{{ '#' }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center space-x-3 px-3 py-2 rounded-md text-sm text-red-700 hover:bg-red-100 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <span>Sign out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ '#' }}" class="w-8 h-8 border-[2px] border-[#128AEB] rounded-full overflow-hidden flex justify-center items-center">
                        <img src="/assets/icons/ui/account/sign-in.svg" 
                            class="w-5.5 h-5.5 ml-0.5 object-cover">
                    </a>
                @endauth
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
