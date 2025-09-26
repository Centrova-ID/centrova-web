<style>
    [x-cloak] {
        display: none !important;
    }
</style>

{{-- Navbar Modern --}}
<div class="h-[60px]"></div>
<nav class="bg-[#004E8D] text-white shadow-xl shadow-black/[3%] h-[50px] fixed top-0 inset-x-0 z-50 border-b border-black/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-full items-center">
            {{-- Logo + Menu Desktop --}}
            <div class="flex items-center h-full gap-x-2">
                <a href="{{ route('home') }}">
                    <img src="/assets/brand/centrova-white.svg" class="h-[20px] w-auto mb-[0.5px]" alt="Centrova Logo" draggable="false" />
                </a>
                <a href="{{ route('account') }}" class="font-normal text-[19.5px] mb-[1px]">account</a>
                <div class="hidden md:flex md:space-x-2 text-[14px] h-full ml-4 font-normal text-white items-center">
                    <a href="{{ route('profile.index') }}" class="px-2 h-full flex items-center hover:bg-black/10 {{ request()->routeIs('profile.*') ? 'bg-black/10' : '' }}">Info Saya</a>
                    <a href="{{ route('account.privacy') }}" class="px-2 h-full flex items-center hover:bg-black/10 {{ request()->routeIs('account.privacy') ? 'bg-black/10' : '' }}">Privasi</a>
                    <a href="{{ route('security.index') }}" class="px-2 h-full flex items-center hover:bg-black/10 {{ request()->routeIs('security.*') ? 'bg-black/10' : '' }}">Keamanan</a>
                    <a href="{{ route('account.subscription') }}" class="px-2 h-full flex items-center hover:bg-black/10 {{ request()->routeIs('account.subscription') ? 'bg-black/10' : '' }}">Langganan</a>
                    <a href="{{ route('services.cancellation.index') }}" class="px-2 h-full flex items-center hover:bg-black/10 {{ request()->routeIs('services.cancellation.*') ? 'bg-black/10' : '' }}">Layanan</a>
                    <a href="{{ route('support.home') }}" class="px-2 h-full flex items-center hover:bg-black/10 {{ request()->routeIs('support.home') ? 'bg-black/10' : '' }}">Dukungan</a>
                </div>
            </div>
            {{-- Aksi Desktop --}}
            <div class="hidden md:flex md:items-center gap-2">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button 
                            @click="open = !open" 
                            class="flex items-center gap-1 px-4 py-2" title="Manajemen akun untuk {{ Auth::user()->full_name }}" 
                        >
                            <span class="px-2 text-sm">{{ auth()->user()->name }}</span>
                            <div class="w-8 h-8 border-[2px] border-white rounded-full overflow-hidden flex justify-center items-center">
                                <img 
                                    src="/assets/icons/ui/account/profile-white.svg" 
                                    class="w-5 h-5 object-cover" 
                                    alt="{{ auth()->user()->name }}'s Profile"
                                >
                            </div>
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                class="h-4 w-4 text-white transition-transform duration-300" 
                                :class="{ 'rotate-180': open }"
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        {{-- Dropdown menu --}}
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
                                <a href="{{ route('profile.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Info Saya</span>
                                </a>
                                <a href="{{ route('account.privacy') }}" class="flex items-center space-x-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <span>Privasi</span>
                                </a>
                                <a href="{{ route('security.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                    <span>Keamanan</span>
                                </a>
                                <a href="{{ route('account.subscription') }}" class="flex items-center space-x-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    <span>Langganan</span>
                                </a>
                                <a href="{{ route('services.cancellation.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span>Layanan Saya</span>
                                </a>
                            </div>
                            <div class="border-t border-neutral-200 mt-2 px-2 py-2 space-y-1">
                                <form method="POST" action="{{ route('logout') }}">
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
                    <a href="{{ route('login') }}" class="w-8 h-8 border-[2px] border-[#128AEB] rounded-full overflow-hidden flex justify-center items-center">
                        <img src="/assets/icons/ui/account/sign-in.svg" 
                            class="w-5.5 h-5.5 ml-0.5 object-cover">
                    </a>
                @endauth
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
    <a href="{{ url('/team') }}" class="mobile-link text-2xl font-semibold text-[#128AEB] mt-2 opacity-0 translate-y-2 transition duration-200 delay-500">Our Tim</a>
    <a href="{{ route('contact') }}" class="mobile-link text-2xl font-semibold text-[#128AEB] mt-8 opacity-0 translate-y-2 transition duration-200 delay-500">Hubungi Kami</a>
    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mobile-link text-2xl font-semibold text-red-600 mt-2 opacity-0 translate-y-2 transition duration-200 delay-500">Sign Out</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="mobile-link text-2xl font-semibold text-[#128AEB] mt-2 opacity-0 translate-y-2 transition duration-200 delay-500">Sign In</a>
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
