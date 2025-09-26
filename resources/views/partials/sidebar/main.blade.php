{{-- Sidebar Navigation - Apple Business Manager Style --}}
<div class="flex flex-col h-full bg-neutral-100">
    {{-- Logo/Brand Section --}}
    <div class="flex items-center px-4 py-5">
        <a href="{{ route('staff.dashboard') }}" class="px-2.5">
            <img src="{{ asset('/favicon/centrova-office.svg') }}" class="h-[26px] w-auto" alt="Centrova Logo" draggable="false" />
        </a>
    </div>

    {{-- Navigation Sections --}}
    <div class="flex-1 px-3 py-5 space-y-8 text-[15px] overflow-y-auto text-slate-900">
        
        {{-- Organization Section --}}
        <div>
            <h3 class="px-3 text-xs font-bold text-neutral-500 uppercase tracking-wider mb-3 hidden">Organisasi</h3>
            
            <div class="space-y-1">
                <a href="{{ route('staff.list') }}" class="px-2.5 py-1.5 hover:bg-neutral-200/60 w-full text-left rounded-lg font-medium flex items-center justify-between {{ request()->routeIs('staff.list') ? 'bg-neutral-200' : '' }}">
                    <div class="flex items-center space-x-2">
                        <div class="h-[20px] aspect-square flex justify-center items-center">
                            <svg class="h-[18px]" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.225 9.54C9.62518 9.1936 9.94616 8.76516 10.1662 8.28377C10.3861 7.80237 10.5 7.27928 10.5 6.75C10.5 5.75544 10.1049 4.80161 9.40165 4.09835C8.69839 3.39509 7.74456 3 6.75 3C5.75544 3 4.80161 3.39509 4.09835 4.09835C3.39509 4.80161 3 5.75544 3 6.75C2.99999 7.27928 3.11385 7.80237 3.33384 8.28377C3.55384 8.76516 3.87482 9.1936 4.275 9.54C3.2251 10.0154 2.33435 10.7831 1.70924 11.7514C1.08412 12.7197 0.751104 13.8475 0.75 15C0.75 15.1989 0.829018 15.3897 0.96967 15.5303C1.11032 15.671 1.30109 15.75 1.5 15.75C1.69891 15.75 1.88968 15.671 2.03033 15.5303C2.17098 15.3897 2.25 15.1989 2.25 15C2.25 13.8065 2.72411 12.6619 3.56802 11.818C4.41193 10.9741 5.55653 10.5 6.75 10.5C7.94347 10.5 9.08807 10.9741 9.93198 11.818C10.7759 12.6619 11.25 13.8065 11.25 15C11.25 15.1989 11.329 15.3897 11.4697 15.5303C11.6103 15.671 11.8011 15.75 12 15.75C12.1989 15.75 12.3897 15.671 12.5303 15.5303C12.671 15.3897 12.75 15.1989 12.75 15C12.7489 13.8475 12.4159 12.7197 11.7908 11.7514C11.1657 10.7831 10.2749 10.0154 9.225 9.54ZM6.75 9C6.30499 9 5.86998 8.86804 5.49997 8.62081C5.12996 8.37357 4.84157 8.02217 4.67127 7.61104C4.50097 7.1999 4.45642 6.7475 4.54323 6.31105C4.63005 5.87459 4.84434 5.47368 5.15901 5.15901C5.47368 4.84434 5.87459 4.63005 6.31105 4.54323C6.7475 4.45642 7.1999 4.50097 7.61104 4.67127C8.02217 4.84157 8.37357 5.12996 8.62081 5.49997C8.86804 5.86998 9 6.30499 9 6.75C9 7.34674 8.76295 7.91903 8.34099 8.34099C7.91903 8.76295 7.34674 9 6.75 9ZM14.055 9.24C14.535 8.6995 14.8485 8.03179 14.9579 7.31725C15.0672 6.60272 14.9677 5.87181 14.6713 5.2125C14.375 4.55319 13.8943 3.9936 13.2874 3.60107C12.6804 3.20854 11.9729 2.99981 11.25 3C11.0511 3 10.8603 3.07902 10.7197 3.21967C10.579 3.36032 10.5 3.55109 10.5 3.75C10.5 3.94891 10.579 4.13968 10.7197 4.28033C10.8603 4.42098 11.0511 4.5 11.25 4.5C11.8467 4.5 12.419 4.73705 12.841 5.15901C13.2629 5.58097 13.5 6.15326 13.5 6.75C13.4989 7.14393 13.3945 7.53068 13.197 7.87157C12.9996 8.21245 12.7162 8.49554 12.375 8.6925C12.2638 8.75664 12.1709 8.84825 12.1053 8.95856C12.0396 9.06886 12.0034 9.19418 12 9.3225C11.9969 9.44982 12.0262 9.57585 12.0852 9.68869C12.1443 9.80154 12.2311 9.89749 12.3375 9.9675L12.63 10.1625L12.7275 10.215C13.6315 10.6438 14.3942 11.322 14.9257 12.1697C15.4572 13.0175 15.7354 13.9995 15.7275 15C15.7275 15.1989 15.8065 15.3897 15.9472 15.5303C16.0878 15.671 16.2786 15.75 16.4775 15.75C16.6764 15.75 16.8672 15.671 17.0078 15.5303C17.1485 15.3897 17.2275 15.1989 17.2275 15C17.2336 13.8491 16.9454 12.7157 16.3901 11.7075C15.8348 10.6994 15.031 9.84998 14.055 9.24Z" fill="#128AEB"/>
                            </svg>
                        </div>
                        <span class="mt-0.5">Staff</span>
                    </div>
                </a>
                <a href="{{ route('staff.departments.index') }}" class="px-2.5 py-1.5 hover:bg-neutral-200/60 w-full text-left rounded-lg font-medium flex items-center justify-between {{ request()->routeIs('staff.departments.*') ? 'bg-neutral-200' : '' }}">
                    <div class="flex items-center space-x-2">
                        <div class="h-[20px] aspect-square flex justify-center items-center">
                            <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 15H20V12C20 11.7348 19.8946 11.4804 19.7071 11.2929C19.5196 11.1054 19.2652 11 19 11H13V9H15C15.2652 9 15.5196 8.89464 15.7071 8.70711C15.8946 8.51957 16 8.26522 16 8V2C16 1.73478 15.8946 1.48043 15.7071 1.29289C15.5196 1.10536 15.2652 1 15 1H9C8.73478 1 8.48043 1.10536 8.29289 1.29289C8.10536 1.48043 8 1.73478 8 2V8C8 8.26522 8.10536 8.51957 8.29289 8.70711C8.48043 8.89464 8.73478 9 9 9H11V11H5C4.73478 11 4.48043 11.1054 4.29289 11.2929C4.10536 11.4804 4 11.7348 4 12V15H2C1.73478 15 1.48043 15.1054 1.29289 15.2929C1.10536 15.4804 1 15.7348 1 16V22C1 22.2652 1.10536 22.5196 1.29289 22.7071C1.48043 22.8946 1.73478 23 2 23H8C8.26522 23 8.51957 22.8946 8.70711 22.7071C8.89464 22.5196 9 22.2652 9 22V16C9 15.7348 8.89464 15.4804 8.70711 15.2929C8.51957 15.1054 8.26522 15 8 15H6V13H18V15H16C15.7348 15 15.4804 15.1054 15.2929 15.2929C15.1054 15.4804 15 15.7348 15 16V22C15 22.2652 15.1054 22.5196 15.2929 22.7071C15.4804 22.8946 15.7348 23 16 23H22C22.2652 23 22.5196 22.8946 22.7071 22.7071C22.8946 22.5196 23 22.2652 23 22V16C23 15.7348 22.8946 15.4804 22.7071 15.2929C22.5196 15.1054 22.2652 15 22 15ZM7 17V21H3V17H7ZM10 7V3H14V7H10ZM21 21H17V17H21V21Z" fill="#128AEB"/>
                            </svg>
                        </div>
                        <span class="mt-0.5">Departemen</span>
                    </div>
                </a>
                <a href="#" class="px-2.5 py-1.5 hover:bg-neutral-200/60 w-full text-left rounded-lg font-medium flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="h-[20px] aspect-square flex justify-center items-center">
                            <svg class="h-[18px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.0001 4.40994L21.7101 3.70994C21.8984 3.52164 22.0042 3.26624 22.0042 2.99994C22.0042 2.73364 21.8984 2.47824 21.7101 2.28994C21.5218 2.10164 21.2664 1.99585 21.0001 1.99585C20.7338 1.99585 20.4784 2.10164 20.2901 2.28994L18.8901 3.69994L16.0601 6.52994L9.7501 12.8299C8.71614 12.1478 7.46577 11.8737 6.24126 12.0608C5.01676 12.248 3.90532 12.883 3.12228 13.8428C2.33925 14.8026 1.94038 16.0189 2.00297 17.2561C2.06556 18.4932 2.58515 19.6631 3.46105 20.539C4.33696 21.4149 5.50682 21.9345 6.74395 21.9971C7.98109 22.0597 9.19741 21.6608 10.1572 20.8778C11.1171 20.0947 11.7521 18.9833 11.9392 17.7588C12.1263 16.5343 11.8523 15.2839 11.1701 14.2499L16.7601 8.64994L18.8801 10.7799C18.9733 10.8725 19.0839 10.9458 19.2055 10.9957C19.327 11.0455 19.4572 11.071 19.5886 11.0705C19.72 11.07 19.85 11.0437 19.9713 10.993C20.0925 10.9423 20.2025 10.8682 20.2951 10.7749C20.3877 10.6817 20.461 10.5711 20.5108 10.4496C20.5607 10.328 20.5861 10.1978 20.5857 10.0664C20.5852 9.93501 20.5588 9.80499 20.5081 9.68378C20.4574 9.56256 20.3833 9.45252 20.2901 9.35994L18.1701 7.23994L19.5901 5.82994L20.2901 6.52994C20.3827 6.62318 20.4927 6.69727 20.6139 6.74798C20.7352 6.79869 20.8652 6.82503 20.9966 6.8255C21.128 6.82596 21.2582 6.80054 21.3797 6.75069C21.5013 6.70083 21.6119 6.62752 21.7051 6.53494C21.7983 6.44236 21.8724 6.33232 21.9231 6.2111C21.9738 6.08989 22.0002 5.95987 22.0007 5.82848C22.0011 5.69708 21.9757 5.56688 21.9258 5.44531C21.876 5.32374 21.8027 5.21318 21.7101 5.11994L21.0001 4.40994ZM7.0001 19.9999C6.40675 19.9999 5.82673 19.824 5.33339 19.4944C4.84004 19.1647 4.45552 18.6962 4.22846 18.148C4.00139 17.5998 3.94199 16.9966 4.05774 16.4147C4.1735 15.8327 4.45922 15.2982 4.87878 14.8786C5.29833 14.4591 5.83288 14.1733 6.41483 14.0576C6.99677 13.9418 7.59997 14.0012 8.14815 14.2283C8.69632 14.4554 9.16486 14.8399 9.4945 15.3332C9.82415 15.8266 10.0001 16.4066 10.0001 16.9999C10.0001 17.7956 9.68403 18.5587 9.12142 19.1213C8.55881 19.6839 7.79575 19.9999 7.0001 19.9999Z" fill="#128AEB"/>
                            </svg>
                        </div>
                        <span class="mt-0.5">Role</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- Bottom Section - Current Account & Settings --}}
    <div>
        {{-- Current Account Section --}}
        <div class="p-3">
            @if(Auth::guard('staff')->check())
                @include('partials.navbar.components.officeAccount')
            @endif
        </div>
    </div>
</div>

<script>
function toggleSubmenu(submenuId) {
    const submenu = document.getElementById(submenuId);
    const arrowId = submenuId.replace('-submenu', '-arrow');
    const arrow = document.getElementById(arrowId);
    
    if (submenu.classList.contains('hidden')) {
        submenu.classList.remove('hidden');
        arrow.classList.remove('rotate-180');
        arrow.classList.add('rotate-0');
    } else {
        submenu.classList.add('hidden');
        arrow.classList.remove('rotate-0');
        arrow.classList.add('rotate-180');
    }
}
</script>

{{-- JavaScript untuk Account Switcher --}}
<script>
    // Data yang sudah tersedia dari server
    let navbarAccountDataSidebar = @json($multiAccountData ?? null);

    // Fungsi untuk menangani klik tombol beralih akun
    function handleAccountSwitch() {
        
        // Jika tidak ada data atau hanya 1 akun, arahkan ke add account endpoint
        if (!navbarAccountDataSidebar || !navbarAccountDataSidebar.has_multiple) {
            // Redirect ke endpoint login dengan mode add-different-account
            window.location.href = '{{ route('staff.login') }}?mode=add-different-account';
            return;
        }
        
        // Jika sudah ada beberapa akun, tampilkan modal
        showAccountSwitcher();
    }

    // Fungsi untuk menampilkan modal account switcher
    function showAccountSwitcher() {
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
    }

    // Update teks tombol berdasarkan jumlah akun
    function updateAccountSwitchButton() {
        const switchText = document.getElementById('account-switch-text');
        
        if (switchText && navbarAccountDataSidebar) {
            if (navbarAccountDataSidebar.has_multiple) {
                switchText.textContent = 'Beralih Akun';
            } else {
                switchText.textContent = 'Tambah Akun';
            }
        }
    }

    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        @if(Auth::guard('staff')->check())
            updateAccountSwitchButton();
        @endif
    });
</script>