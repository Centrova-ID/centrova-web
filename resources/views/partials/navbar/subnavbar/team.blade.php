<div x-data="navbar()" x-init="init" class="z-20 sticky top-0">
    <nav id="subNavbar"
         :style="'height: ' + height"
         class="w-full border-b border-black/15 transition-all duration-500 overflow-hidden absolute md:py-1.5"
         :class="subOpen ? 'bg-white/80 backdrop-blur-lg' : 'bg-transparent backdrop-blur-0'">
        <div x-ref="wrapper" class="max-w-7xl mx-auto flex flex-col px-4 sm:px-6 lg:px-8 transition-all duration-500">
            {{-- Header --}}
            <div class="flex w-full justify-between items-center h-full py-2">
                <span class="text-xl font-semibold text-slate-900">Centrova</span>
            </div>

            {{-- Mobile Menu --}}
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
            open2: false,
            height: '56px',
            init() {
                this.setHeight();
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 768 && this.subOpen) {
                        this.subOpen = false;
                        this.open2 = false;
                        document.body.classList.remove('overflow-hidden');
                        this.setHeight();
                    }
                });
            },
            toggle() {
                this.subOpen = !this.subOpen;
                this.open2 = this.subOpen;
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

