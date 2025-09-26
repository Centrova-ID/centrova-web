<script src="https://cdn.jsdelivr.net/npm/alpinejs@3" defer></script>

<div x-data="navbar()" x-init="init" class="z-20 sticky top-0">
    <nav id="subNavbar"
         :style="'height: ' + height"
         class="w-full border-b border-black/15 transition-all duration-500 overflow-hidden absolute md:py-1.5"
         :class="subOpen ? 'bg-white/80 backdrop-blur-lg' : 'bg-transparent backdrop-blur-0'">
        <div x-ref="wrapper" class="max-w-7xl mx-auto flex flex-col px-4 sm:px-6 lg:px-8 transition-all duration-500">
            <!-- Header -->
            <div class="flex w-full justify-between items-center h-full py-2">
                <a href="{{ url('legal') }}" class="text-xl font-semibold">Legal</a>
                <div class="hidden md:flex md:space-x-2 text-base font-normal text-neutral-800 items-center">
                    <a href="{{ route('legal.privacy') }}" class="px-2 hover:text-black transition duration-500">Kebijakan Privasi</a>
                    <a href="{{ route('legal.terms') }}" class="px-2 hover:text-black transition duration-500">Syarat & Ketentuan</a>
                    <a href="{{ route('legal.disclaimer') }}" class="px-2 hover:text-black transition duration-500">Disclaimer</a>
                    <a href="{{ route('legal.copyright') }}" class="px-2 hover:text-black transition duration-500">Hak Cipta</a>
                </div>
                <!-- Hamburger -->
                <div class="md:hidden">
                    <button @click="toggle" class="p-1.5 w-10 h-10 text-neutral-600 rounded-full focus:outline-none focus:ring-2 focus:ring-[#128AEB] flex justify-center items-center">
                        <svg class="w-7 h-6 md:hidden transition-transform duration-200"
                             :class="open2 ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="subOpen" x-transition:enter="transition-all duration-500" x-transition:enter-start="opacity-0 -translate-y-8 duration-300" x-transition:enter-end="opacity-100 translate-y-0 duration-300" x-transition:leave="transition-all duration-300" x-transition:leave-start="opacity-100 translate-y-0 duration-300" x-transition:leave-end="opacity-0 -translate-y-8 duration-300" class="flex flex-col gap-1 md:hidden mt-2 px-6 pb-4">
                <a href="{{ route('legal.privacy') }}" class="block py-2 border-b border-neutral-200 text-base font-normal text-slate-800">Kebijakan Privasi</a>
                <a href="{{ route('legal.terms') }}" class="block py-2 border-b border-neutral-200 text-base font-normal text-slate-800">Syarat & Ketentuan</a>
                <a href="{{ route('legal.disclaimer') }}" class="block py-2 border-b border-neutral-200 text-base font-normal text-slate-800">Disclaimer</a>
                <a href="{{ route('legal.copyright') }}" class="block py-2 text-base font-normal text-slate-800">Hak Cipta</a>
            </div>
        </div>
    </nav>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('subNavbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 0) {
                navbar.classList.remove('bg-transparent', 'backdrop-blur-0');
                navbar.classList.add('bg-white/70', 'backdrop-blur-lg');
            } else {
                navbar.classList.remove('bg-white/70', 'backdrop-blur-lg');
                navbar.classList.add('bg-transparent', 'backdrop-blur-0');
            }
        });
    });
</script>
@endpush

<script>
    function navbar() {
        return {
            subOpen: false,
            open2: false, // Tambahkan ini
            height: '56px',
            init() {
                this.setHeight();
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 768 && this.subOpen) {
                        this.subOpen = false;
                        this.open2 = false; // Reset ikon saat resize
                        document.body.classList.remove('overflow-hidden');
                        this.setHeight();
                    }
                });
            },
            toggle() {
                this.subOpen = !this.subOpen;
                this.open2 = this.subOpen; // Sinkronkan icon dengan menu
                if (this.subOpen) {
                    document.body.classList.add('overflow-hidden');
                } else {
                    document.body.classList.remove('overflow-hidden');
                }
                this.$nextTick(() => this.setHeight());
            },
            setHeight() {
                const wrapper = this.$refs.wrapper;
                this.height = this.subOpen ? wrapper.scrollHeight + 'px' : '56px';
            }
        }
    }
</script>

