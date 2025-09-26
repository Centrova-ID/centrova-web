@auth
    {{-- Dropdown Menu Account - Container utama untuk menu akun user --}}
    <div class="relative" x-data="{ open: false }" x-ref="dropdown">
        {{-- Tombol untuk membuka/menutup dropdown menu --}}
        <button 
            @click="open = !open" 
            class="flex items-center gap-1 p-2 w-full hover:bg-neutral-200 rounded-lg focus:bg-neutral-200" title="Manajemen akun untuk {{ auth()->user()->name }} ({{ auth()->user()->role_display_name }})" 
        >
            <x-user-avatar 
                :user="auth()->user()" 
                size="sm" 
                class="avatar-container" 
            />
            <div class="text-left ml-2">
                <h2 class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</h2>
                <h3 class="text-xs text-neutral-500 font-medium">{{ auth()->user()->role_display_name }}</h3>
            </div>
        </button>
        
        {{-- Dropdown menu content dengan animasi slide ke atas --}}
        <div 
            x-show="open" 
            x-cloak
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="absolute w-72 bg-white rounded-xl shadow-lg border border-neutral-150 py-2 z-50 max-h-[60vh] overflow-auto"
            x-ref="dropdownMenu"
            x-init="
                $watch('open', value => {
                    if (value) {
                        $nextTick(() => {
                            const rect = $refs.dropdown.getBoundingClientRect();
                            const menuRect = $refs.dropdownMenu.getBoundingClientRect();
                            const viewportHeight = window.innerHeight;
                            const viewportWidth = window.innerWidth;
                            
                            // Reset positioning
                            $refs.dropdownMenu.style.bottom = '';
                            $refs.dropdownMenu.style.top = '';
                            $refs.dropdownMenu.style.left = '';
                            $refs.dropdownMenu.style.right = '';
                            
                            // Determine vertical position
                            const spaceAbove = rect.top;
                            const spaceBelow = viewportHeight - rect.bottom;
                            const menuHeight = 288; // approximate height
                            
                            if (spaceAbove >= menuHeight || spaceAbove > spaceBelow) {
                                // Show above
                                $refs.dropdownMenu.style.bottom = '100%';
                                $refs.dropdownMenu.style.marginBottom = '8px';
                                $refs.dropdownMenu.style.transformOrigin = 'bottom left';
                            } else {
                                // Show below
                                $refs.dropdownMenu.style.top = '100%';
                                $refs.dropdownMenu.style.marginTop = '8px';
                                $refs.dropdownMenu.style.transformOrigin = 'top left';
                            }
                            
                            // Determine horizontal position
                            const spaceRight = viewportWidth - rect.left;
                            const menuWidth = 288; // 18rem = 288px
                            
                            if (spaceRight >= menuWidth) {
                                // Align to left edge of button
                                $refs.dropdownMenu.style.left = '0';
                            } else {
                                // Align to left edge of button
                                $refs.dropdownMenu.style.left = '0';
                            }
                        });
                    }
                })
            "
        >
            {{-- Header section dengan info user --}}
            <div class="px-2 pb-1 pt-0 border-b border-neutral-100">
                <a href="{{ route('account') }}" class="flex items-center py-2 px-3 space-x-3 hover:bg-neutral-100 rounded-md">
                    {{-- Profile picture yang lebih besar di dropdown --}}
                    <div class="w-12 h-12 rounded-full bg-white overflow-hidden flex justify-center items-center">
                        <x-user-avatar 
                            :user="auth()->user()" 
                            size="md" 
                            class="avatar-container" 
                        />
                    </div>
                    {{-- Info user: nama, role, dan email --}}
                    <div>
                        <p class="text-base font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </a>
            </div>
            {{-- Menu items section --}}
            <div class="px-2 py-1 space-y-1 hidden">
                {{-- Menu items bisa ditambahkan di sini jika diperlukan --}}
            </div>
            {{-- Logout section dengan border atas --}}
            <div class="border-t border-neutral-100 px-2 pt-1 space-y-1">
                {{-- Form logout dengan CSRF token --}}
                <form method="POST" action="{{ route('logout') }}" class="m-0">
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
    <a href="{{ route('login') }}" class="w-8 h-8 border-[2px] border-[#128AEB] rounded-full overflow-hidden flex justify-center items-center">
        <img src="/assets/icons/ui/account/sign-in.svg" 
            class="w-5.5 h-5.5 ml-0.5 object-cover">
    </a>
@endauth