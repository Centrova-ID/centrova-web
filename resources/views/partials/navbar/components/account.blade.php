@auth

    {{-- Tombol Chat Support - ditampilkan hanya untuk user yang sudah login --}}
    <a href="{{ route('chat.index') }}" class="overflow-hidden max-md:hidden flex justify-center items-center" title="Chat Support">
        <svg class="h-[20px] text-[#128AEB]" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.99999 9C6.80221 9 6.60887 9.05865 6.44442 9.16853C6.27997 9.27841 6.1518 9.43459 6.07611 9.61732C6.00042 9.80004 5.98062 10.0011 6.0192 10.1951C6.05779 10.3891 6.15303 10.5673 6.29288 10.7071C6.43273 10.847 6.61092 10.9422 6.8049 10.9808C6.99888 11.0194 7.19995 10.9996 7.38267 10.9239C7.5654 10.8482 7.72158 10.72 7.83146 10.5556C7.94134 10.3911 7.99999 10.1978 7.99999 10C7.99999 9.73478 7.89463 9.48043 7.70709 9.29289C7.51956 9.10536 7.2652 9 6.99999 9ZM11 9C10.8022 9 10.6089 9.05865 10.4444 9.16853C10.28 9.27841 10.1518 9.43459 10.0761 9.61732C10.0004 9.80004 9.98062 10.0011 10.0192 10.1951C10.0578 10.3891 10.153 10.5673 10.2929 10.7071C10.4327 10.847 10.6109 10.9422 10.8049 10.9808C10.9989 11.0194 11.1999 10.9996 11.3827 10.9239C11.5654 10.8482 11.7216 10.72 11.8315 10.5556C11.9413 10.3911 12 10.1978 12 10C12 9.73478 11.8946 9.48043 11.7071 9.29289C11.5196 9.10536 11.2652 9 11 9ZM15 9C14.8022 9 14.6089 9.05865 14.4444 9.16853C14.28 9.27841 14.1518 9.43459 14.0761 9.61732C14.0004 9.80004 13.9806 10.0011 14.0192 10.1951C14.0578 10.3891 14.153 10.5673 14.2929 10.7071C14.4327 10.847 14.6109 10.9422 14.8049 10.9808C14.9989 11.0194 15.1999 10.9996 15.3827 10.9239C15.5654 10.8482 15.7216 10.72 15.8315 10.5556C15.9413 10.3911 16 10.1978 16 10C16 9.73478 15.8946 9.48043 15.7071 9.29289C15.5196 9.10536 15.2652 9 15 9ZM11 0C9.68677 0 8.38641 0.258658 7.17315 0.761205C5.9599 1.26375 4.85751 2.00035 3.92892 2.92893C2.05356 4.8043 0.999988 7.34784 0.999988 10C0.991246 12.3091 1.79078 14.5485 3.25999 16.33L1.25999 18.33C1.12123 18.4706 1.02723 18.6492 0.98986 18.8432C0.952486 19.0372 0.973409 19.2379 1.04999 19.42C1.13305 19.5999 1.26769 19.7511 1.43683 19.8544C1.60598 19.9577 1.80199 20.0083 1.99999 20H11C13.6522 20 16.1957 18.9464 18.0711 17.0711C19.9464 15.1957 21 12.6522 21 10C21 7.34784 19.9464 4.8043 18.0711 2.92893C16.1957 1.05357 13.6522 0 11 0ZM11 18H4.40999L5.33999 17.07C5.43448 16.9774 5.50965 16.8669 5.56114 16.7451C5.61264 16.6232 5.63944 16.4923 5.63999 16.36C5.63623 16.0962 5.5284 15.8446 5.33999 15.66C4.03057 14.352 3.21516 12.6305 3.03268 10.7888C2.8502 8.94705 3.31193 7.09901 4.33922 5.55952C5.3665 4.02004 6.89578 2.88436 8.6665 2.34597C10.4372 1.80759 12.3398 1.8998 14.0502 2.60691C15.7606 3.31402 17.1728 4.59227 18.0464 6.22389C18.92 7.85551 19.2009 9.73954 18.8411 11.555C18.4814 13.3705 17.5033 15.005 16.0735 16.1802C14.6438 17.3554 12.8508 17.9985 11 18Z" fill="#128AEB"/>
        </svg>
    </a>
    
    {{-- Dropdown Menu Account - Container utama untuk menu akun user --}}
    <div class="relative" x-data="{ open: false }">
        {{-- Tombol untuk membuka/menutup dropdown menu --}}
        <button 
            @click="open = !open" 
            class="flex items-center gap-1 md:px-4 py-2" title="Manajemen akun untuk {{ auth()->user()->name }}" 
        >
            {{-- Profile picture user yang sudah login --}}
            <div class="w-8 h-8 rounded-full overflow-hidden flex justify-center items-center">
                <x-user-avatar 
                    :user="auth()->user()" 
                    size="sm" 
                    class="avatar-container" 
                />
            </div>
            {{-- Dropdown arrow icon dengan animasi rotate --}}
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="h-4 w-4 text-gray-600 transition-transform duration-300 max-md:hidden" 
                :class="{ 'rotate-180': open }"
                fill="none" 
                viewBox="0 0 24 24" 
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        
        {{-- Dropdown menu content dengan animasi slide --}}
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
            class="absolute right-2 mt-3 w-72 bg-white rounded-xl shadow-lg border border-neutral-150 py-2 z-50"
        >
            {{-- Header section dengan info user --}}
            <div class="px-2 pb-1 pt-0 border-b border-neutral-100">
                <a href="{{ route('account') }}" class="flex items-center py-2 px-3 space-x-3 hover:bg-neutral-100 rounded-md">
                    {{-- Profile picture yang lebih besar di dropdown --}}
                    <div class="w-12 h-12 flex-shrink-0 aspect-square rounded-full bg-white overflow-hidden flex justify-center items-center">
                        <x-user-avatar 
                            :user="auth()->user()" 
                            size="lg-responsive" 
                            class="avatar-container" 
                        />
                    </div>
                    {{-- Info user: nama dan email --}}
                    <div>
                        <p class="text-base font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </a>
            </div>
            {{-- Menu items section --}}
            <div class="px-2 py-1 space-y-1">
                {{-- Link ke tombol beralih akun --}}
                <button type="button" id="account-switcher-btn" onclick="handleAccountSwitch();" class="flex items-center space-x-3 px-3 py-3 rounded-md text-sm text-gray-700 hover:bg-neutral-100 transition-colors w-full">
                    <svg class="h-4 text-gray-500" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.32 7.55L17.43 6.92L18.32 5.14C18.4102 4.95369 18.4404 4.74397 18.4064 4.53978C18.3723 4.33558 18.2758 4.14699 18.13 4L16 1.87C15.8522 1.72209 15.6618 1.62421 15.4555 1.59013C15.2493 1.55605 15.0375 1.58748 14.85 1.68L13.07 2.57L12.44 0.680003C12.3735 0.482996 12.2472 0.311629 12.0787 0.189751C11.9102 0.0678737 11.7079 0.00154767 11.5 3.33354e-06H8.5C8.29036 -0.000537828 8.08585 0.0648223 7.91537 0.186845C7.7449 0.308868 7.61709 0.481382 7.55 0.680003L6.92 2.57L5.14 1.68C4.95369 1.58978 4.74397 1.55961 4.53978 1.59364C4.33558 1.62767 4.14699 1.72423 4 1.87L1.87 4C1.72209 4.14777 1.62421 4.33818 1.59013 4.54446C1.55605 4.75074 1.58748 4.96251 1.68 5.15L2.57 6.93L0.680003 7.56C0.482996 7.62654 0.311629 7.75283 0.189751 7.92131C0.0678737 8.08979 0.00154767 8.29207 3.33354e-06 8.5V11.5C-0.000537828 11.7096 0.0648223 11.9142 0.186845 12.0846C0.308868 12.2551 0.481382 12.3829 0.680003 12.45L2.57 13.08L1.68 14.86C1.58978 15.0463 1.55961 15.256 1.59364 15.4602C1.62767 15.6644 1.72423 15.853 1.87 16L4 18.13C4.14777 18.2779 4.33818 18.3758 4.54446 18.4099C4.75074 18.444 4.96251 18.4125 5.15 18.32L6.93 17.43L7.56 19.32C7.62709 19.5186 7.7549 19.6911 7.92537 19.8132C8.09585 19.9352 8.30036 20.0005 8.51 20H11.51C11.7196 20.0005 11.9242 19.9352 12.0946 19.8132C12.2651 19.6911 12.3929 19.5186 12.46 19.32L13.09 17.43L14.87 18.32C15.0551 18.4079 15.2628 18.4369 15.4649 18.4029C15.667 18.3689 15.8538 18.2737 16 18.13L18.13 16C18.2779 15.8522 18.3758 15.6618 18.4099 15.4555C18.444 15.2493 18.4125 15.0375 18.32 14.85L17.43 13.07L19.32 12.44C19.517 12.3735 19.6884 12.2472 19.8103 12.0787C19.9321 11.9102 19.9985 11.7079 20 11.5V8.5C20.0005 8.29036 19.9352 8.08585 19.8132 7.91537C19.6911 7.7449 19.5186 7.61709 19.32 7.55ZM18 10.78L16.8 11.18C16.5241 11.2695 16.2709 11.418 16.0581 11.6151C15.8452 11.8122 15.6778 12.0533 15.5675 12.3216C15.4571 12.5899 15.4064 12.879 15.419 13.1688C15.4315 13.4586 15.5069 13.7422 15.64 14L16.21 15.14L15.11 16.24L14 15.64C13.7436 15.5122 13.4627 15.4411 13.1763 15.4313C12.89 15.4215 12.6049 15.4734 12.3403 15.5834C12.0758 15.6934 11.8379 15.8589 11.6429 16.0688C11.4479 16.2787 11.3003 16.5281 11.21 16.8L10.81 18H9.22L8.82 16.8C8.73049 16.5241 8.58203 16.2709 8.3849 16.0581C8.18778 15.8452 7.94671 15.6778 7.67842 15.5675C7.41014 15.4571 7.12105 15.4064 6.83123 15.419C6.5414 15.4315 6.25777 15.5069 6 15.64L4.86 16.21L3.76 15.11L4.36 14C4.4931 13.7422 4.56852 13.4586 4.58105 13.1688C4.59358 12.879 4.5429 12.5899 4.43254 12.3216C4.32218 12.0533 4.15478 11.8122 3.94195 11.6151C3.72912 11.418 3.47595 11.2695 3.2 11.18L2 10.78V9.22L3.2 8.82C3.47595 8.73049 3.72912 8.58203 3.94195 8.3849C4.15478 8.18778 4.32218 7.94671 4.43254 7.67842C4.5429 7.41014 4.59358 7.12105 4.58105 6.83123C4.56852 6.5414 4.4931 6.25777 4.36 6L3.79 4.89L4.89 3.79L6 4.36C6.25777 4.4931 6.5414 4.56852 6.83123 4.58105C7.12105 4.59358 7.41014 4.5429 7.67842 4.43254C7.94671 4.32218 8.18778 4.15478 8.3849 3.94195C8.58203 3.72912 8.73049 3.47595 8.82 3.2L9.22 2H10.78L11.18 3.2C11.2695 3.47595 11.418 3.72912 11.6151 3.94195C11.8122 4.15478 12.0533 4.32218 12.3216 4.43254C12.5899 4.5429 12.879 4.59358 13.1688 4.58105C13.4586 4.56852 13.7422 4.4931 14 4.36L15.14 3.79L16.24 4.89L15.64 6C15.5122 6.25645 15.4411 6.53735 15.4313 6.82369C15.4215 7.11003 15.4734 7.39513 15.5834 7.65969C15.6934 7.92424 15.8589 8.16207 16.0688 8.35708C16.2787 8.5521 16.5281 8.69973 16.8 8.79L18 9.19V10.78ZM10 6C9.20888 6 8.43552 6.2346 7.77772 6.67413C7.11993 7.11365 6.60724 7.73836 6.30448 8.46927C6.00173 9.20017 5.92252 10.0044 6.07686 10.7804C6.2312 11.5563 6.61217 12.269 7.17158 12.8284C7.73099 13.3878 8.44372 13.7688 9.21964 13.9231C9.99557 14.0775 10.7998 13.9983 11.5307 13.6955C12.2616 13.3928 12.8864 12.8801 13.3259 12.2223C13.7654 11.5645 14 10.7911 14 10C14 8.93914 13.5786 7.92172 12.8284 7.17158C12.0783 6.42143 11.0609 6 10 6ZM10 12C9.60444 12 9.21776 11.8827 8.88886 11.6629C8.55996 11.4432 8.30362 11.1308 8.15224 10.7654C8.00087 10.3999 7.96126 9.99778 8.03843 9.60982C8.1156 9.22186 8.30608 8.86549 8.58579 8.58579C8.86549 8.30608 9.22186 8.1156 9.60982 8.03843C9.99778 7.96126 10.3999 8.00087 10.7654 8.15224C11.1308 8.30362 11.4432 8.55996 11.6629 8.88886C11.8827 9.21776 12 9.60444 12 10C12 10.5304 11.7893 11.0391 11.4142 11.4142C11.0391 11.7893 10.5304 12 10 12Z" fill="currentColor"/>
                    </svg>
                    <span id="account-switch-text">Beralih Akun</span>
                </button>
            </div>
            {{-- Logout section dengan border atas --}}
            <div class="border-t border-neutral-100 px-2 pt-1 space-y-1">
                {{-- Form logout dengan CSRF token --}}
                <form method="POST" action="{{ '#' }}" class="m-0">
                    @csrf
                    <button type="submit" class="flex w-full items-center space-x-3 px-3 py-3 rounded-md text-sm text-red-700 hover:bg-red-100 transition-colors">
                        <svg class="h-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5947 11.0001L8.2947 13.2901C8.20097 13.3831 8.12658 13.4937 8.07581 13.6155C8.02504 13.7374 7.9989 13.8681 7.9989 14.0001C7.9989 14.1321 8.02504 14.2628 8.07581 14.3847C8.12658 14.5065 8.20097 14.6171 8.2947 14.7101C8.38766 14.8038 8.49826 14.8782 8.62012 14.929C8.74198 14.9798 8.87269 15.0059 9.0047 15.0059C9.13671 15.0059 9.26742 14.9798 9.38928 14.929C9.51114 14.8782 9.62174 14.8038 9.7147 14.7101L13.7147 10.7101C13.8057 10.615 13.8771 10.5029 13.9247 10.3801C14.0247 10.1366 14.0247 9.86356 13.9247 9.6201C13.8771 9.49735 13.8057 9.3852 13.7147 9.2901L9.7147 5.2901C9.62146 5.19686 9.51077 5.1229 9.38895 5.07244C9.26713 5.02198 9.13656 4.99601 9.0047 4.99601C8.87284 4.99601 8.74227 5.02198 8.62045 5.07244C8.49863 5.1229 8.38794 5.19686 8.2947 5.2901C8.20146 5.38334 8.1275 5.49403 8.07704 5.61585C8.02658 5.73767 8.00061 5.86824 8.00061 6.0001C8.00061 6.13196 8.02658 6.26253 8.07704 6.38435C8.1275 6.50617 8.20146 6.61686 8.2947 6.7101L10.5947 9.0001H1.0047C0.739483 9.0001 0.485129 9.10546 0.297593 9.29299C0.110057 9.48053 0.00469971 9.73488 0.00469971 10.0001C0.00469971 10.2653 0.110057 10.5197 0.297593 10.7072C0.485129 10.8947 0.739483 11.0001 1.0047 11.0001H10.5947ZM10.0047 9.96937e-05C8.13579 -0.00824409 6.30194 0.507313 4.71117 1.48829C3.12039 2.46927 1.83635 3.87641 1.0047 5.5501C0.885352 5.78879 0.865714 6.06512 0.950106 6.3183C1.0345 6.57147 1.216 6.78075 1.4547 6.9001C1.69339 7.01945 1.96972 7.03909 2.2229 6.95469C2.47607 6.8703 2.68535 6.68879 2.8047 6.4501C3.43689 5.17342 4.39853 4.08872 5.59025 3.30809C6.78197 2.52746 8.16052 2.07922 9.58346 2.00969C11.0064 1.94017 12.4221 2.25188 13.6842 2.91261C14.9464 3.57334 16.0092 4.55913 16.7628 5.7681C17.5165 6.97706 17.9336 8.36535 17.9711 9.78948C18.0086 11.2136 17.6652 12.6219 16.9762 13.8689C16.2873 15.1159 15.2778 16.1563 14.0522 16.8825C12.8266 17.6088 11.4293 17.9946 10.0047 18.0001C8.51358 18.0066 7.05085 17.5925 5.78439 16.8053C4.51793 16.0182 3.49905 14.89 2.8447 13.5501C2.72535 13.3114 2.51607 13.1299 2.2629 13.0455C2.00972 12.9611 1.73339 12.9808 1.4947 13.1001C1.256 13.2194 1.0745 13.4287 0.990106 13.6819C0.905714 13.9351 0.925352 14.2114 1.0447 14.4501C1.83753 16.0456 3.04222 17.4003 4.53417 18.3741C6.02612 19.348 7.75115 19.9055 9.53082 19.9891C11.3105 20.0727 13.0802 19.6793 14.6568 18.8496C16.2335 18.0199 17.5599 16.7841 18.4988 15.2699C19.4377 13.7558 19.955 12.0182 19.9972 10.2371C20.0394 8.45597 19.605 6.69589 18.7389 5.13893C17.8729 3.58197 16.6065 2.28467 15.071 1.38121C13.5354 0.477745 11.7863 0.000936146 10.0047 9.96937e-05Z" fill="currentColor"/>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@else
    {{-- Tombol login untuk user yang belum login --}}
    <a href="{{ '#' }}" class="w-8 h-8 border-[2px] border-[#128AEB] rounded-full overflow-hidden flex justify-center items-center">
        <img src="/assets/icons/ui/account/sign-in.svg" 
            class="w-5.5 h-5.5 ml-0.5 object-cover" alt="Sign In Icon">
    </a>
@endauth

{{-- JavaScript untuk Account Switcher hanya dijalankan sekali --}}
@once
<script>
    // Pastikan variabel global hanya didefinisikan sekali
    if (typeof window.navbarAccountDataNav === 'undefined') {
        window.navbarAccountDataNav = @json($multiAccountData ?? null);
    }

    // Fungsi untuk menangani klik tombol beralih akun
    if (typeof window.handleAccountSwitch === 'undefined') {
        window.handleAccountSwitch = function() {
            // Jika tidak ada data atau hanya 1 akun, arahkan ke add account endpoint
            if (!window.navbarAccountDataNav || !window.navbarAccountDataNav.has_multiple) {
                // Redirect ke endpoint login dengan mode add-different-account
                window.location.href = '{{ '#' }}?mode=add-different-account';
                return;
            }
            
            // Jika sudah ada beberapa akun, tampilkan modal
            showAccountSwitcher();
        };
    }

    // Fungsi untuk menampilkan modal account switcher
    if (typeof window.showAccountSwitcher === 'undefined') {
        window.showAccountSwitcher = function() {
            const modal = document.getElementById('account-switcher-modal');
            if (modal) {
                modal.classList.remove('hidden');
                // Inisialisasi modal dengan data yang sudah tersedia
                if (typeof initializeAccountSwitcher === 'function') {
                    initializeAccountSwitcher();
                }
            } else {
                console.error('Account switcher modal not found');
            }
        };
    }

    // Update teks tombol berdasarkan jumlah akun
    if (typeof window.updateAccountSwitchButton === 'undefined') {
        window.updateAccountSwitchButton = function() {
            const switchText = document.getElementById('account-switch-text');
            
            if (switchText && window.navbarAccountDataNav) {
                if (window.navbarAccountDataNav.has_multiple) {
                    switchText.textContent = 'Beralih Akun';
                } else {
                    switchText.textContent = 'Tambah Akun';
                }
            }
        };
    }

    // Inisialisasi saat halaman dimuat (hanya sekali)
    if (typeof window.navbarAccountInitialized === 'undefined') {
        window.navbarAccountInitialized = true;
        document.addEventListener('DOMContentLoaded', function() {
            @auth
                window.updateAccountSwitchButton();
            @endauth
        });
    }
</script>
@endonce