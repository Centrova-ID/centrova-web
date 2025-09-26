@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <h1 class="text-slate-800 text-2xl font-medium mb-1 tracking-tight">Profil</h1>
    <p class="text-base text-slate-600">Kelola informasi pribadi Anda seperti nama, foto, dan alamat</p>
@endpush

@section('section')

    {{-- Profile Picture --}}
    @include('auth.profile.sections.profile-picture')

    {{-- Basic Information Section --}}
    <div id="basic-info-section" class="profile-section bg-white rounded-2xl border border-neutral-200">
        {{-- View Mode --}}
        <div id="basic-info-view">
            <div class="flex justify-between items-center px-6 py-3">
                <h3 class="text-lg font-medium text-slate-900">Informasi Profil</h3>
                <button onclick="toggleEditMode('basic-info')" class="text-[#128AEB] text-base font-medium">
                    Edit Informasi Profil
                </button>
            </div>
            
            <div>
                <div onclick="toggleEditMode('basic-info')" class="divide-y divide-neutral-200/80 border-t border-neutral-200/80">
                    <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                        <span class="block text-sm font-normal text-gray-700 w-[35%]">Nama Lengkap</span>
                        <p class="text-gray-900 w-full">{{ $user->name ?? '-' }}</p>
                        <img src="/assets/icons/ui/arrow/right-gray.svg">
                    </div>
                    
                    <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                        <span class="block text-sm font-normal text-gray-700 w-[35%]">Username</span>
                        <p class="text-gray-900 w-full">{{ $user->username ?? '-' }}</p>
                        <img src="/assets/icons/ui/arrow/right-gray.svg">
                    </div>

                    <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                        <span class="block text-sm font-normal text-gray-700 w-[35%]">Email</span>
                        <p class="text-gray-900 w-full">{{ $user->email ?? '-' }}</p>
                        <img src="/assets/icons/ui/arrow/right-gray.svg">
                    </div>

                    <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3 {{ empty($user->phone) ? 'bg-yellow-50 border-l-4 border-yellow-400' : '' }}">
                        <span class="block text-sm font-normal text-gray-700 w-[35%]">Nomor Telepon</span>
                        <div class="w-full">
                            <p class="text-gray-900">{{ $user->phone ?? '-' }}</p>
                            @if(empty($user->phone))
                                <p class="text-xs text-yellow-700 mt-1">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.232 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    Diperlukan untuk 2FA via WhatsApp
                                </p>
                            @endif
                        </div>
                        <img src="/assets/icons/ui/arrow/right-gray.svg">
                    </div>

                    <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                        <span class="block text-sm font-normal text-gray-700 w-[35%]">Tanggal Lahir</span>
                        <p class="text-gray-900 w-full">{{ $user->birth_date?->format('d/m/Y') ?? '-' }}</p>
                        <img src="/assets/icons/ui/arrow/right-gray.svg">
                    </div>

                    <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                        <span class="block text-sm font-normal text-gray-700 w-[35%]">Jenis Kelamin</span>
                        <p class="text-gray-900 w-full">
                            @switch($user->gender)
                                @case('male') Laki-laki @break
                                @case('female') Perempuan @break
                                @case('other') Lainnya @break
                                @case('prefer_not_to_say') Lebih suka tidak menyebutkan @break
                                @default -
                            @endswitch
                        </p>
                        <img src="/assets/icons/ui/arrow/right-gray.svg">
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Mode (Hidden by default) --}}
        <div id="basic-info-edit" class="hidden px-6 py-3">
            <h3 class="text-lg font-medium text-slate-900">Informasi Profil</h3>
            
            <form action="{{ route('profile.update-basic') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                               placeholder="Masukkan nama lengkap"
                               pattern="[A-Za-z0-9\s]+"
                               title="Hanya boleh menggunakan huruf, angka, dan spasi"
                               oninput="this.value = this.value.replace(/[^A-Za-z0-9\s]/g, '')"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                      {{ $errors->has('name') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" 
                               placeholder="Masukkan username"
                               pattern="[a-z0-9]+"
                               title="Hanya boleh menggunakan huruf kecil dan angka (tidak boleh spasi)"
                               oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9]/g, '')"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                      {{ $errors->has('username') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                        @error('username')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                               placeholder="Masukkan alamat email"
                               class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                      {{ $errors->has('email') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                        <div class="absolute left-3 top-2.5">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <div class="relative">
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                                   placeholder="+62 812 3456 7890"
                                   class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                          {{ $errors->has('phone') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                            <div class="absolute left-3 top-2.5">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('phone')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                        <div class="relative">
                            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date?->format('Y-m-d')) }}" 
                                   class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                          {{ $errors->has('birth_date') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                            <div class="absolute left-3 top-2.5">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('birth_date')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="relative">
                        <select id="gender" name="gender" class="w-full pl-10 pr-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent appearance-none bg-white
                                       {{ $errors->has('gender') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}"
                                onchange="handleGenderChange(this)">
                            @if(old('gender', $user->gender))
                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Lainnya</option>
                                <option value="prefer_not_to_say" {{ old('gender', $user->gender) == 'prefer_not_to_say' ? 'selected' : '' }}>Lebih suka tidak menyebutkan</option>
                            @else
                                <option value="">Pilih jenis kelamin</option>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                                <option value="other">Lainnya</option>
                                <option value="prefer_not_to_say">Lebih suka tidak menyebutkan</option>
                            @endif
                        </select>
                        <div class="absolute left-3 top-2.5">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="absolute right-3 top-2.5">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    @error('gender')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-4 pt-2">
                    <button type="button" onclick="toggleEditMode('basic-info')" class="text-gray-700 hover:text-gray-900 font-medium px-6 py-2 rounded-full transition flex items-center gap-2 border border-gray-300 hover:border-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium px-6 py-2 rounded-full transition flex items-center gap-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <script>
            function toggleEditMode(section) {
                const viewElement = document.getElementById(`${section}-view`);
                const editElement = document.getElementById(`${section}-edit`);
                
                if (viewElement.classList.contains('hidden')) {
                    // Switching back to view mode
                    viewElement.classList.remove('hidden');
                    editElement.classList.add('hidden');
                } else {
                    // Switching to edit mode
                    viewElement.classList.add('hidden');
                    editElement.classList.remove('hidden');
                }
            }

            function handleGenderChange(selectElement) {
                // Jika user sudah memilih gender, hapus option "Pilih jenis kelamin"
                if (selectElement.value !== '') {
                    const defaultOption = selectElement.querySelector('option[value=""]');
                    if (defaultOption) {
                        defaultOption.remove();
                    }
                }
            }

            // Validasi input untuk nama lengkap dan username
            document.addEventListener('DOMContentLoaded', function() {
                // Validasi nama lengkap (huruf, angka, dan spasi)
                const nameInput = document.getElementById('name');
                if (nameInput) {
                    nameInput.addEventListener('input', function() {
                        this.value = this.value.replace(/[^A-Za-z0-9\s]/g, '');
                    });
                }

                // Validasi username (huruf dan angka saja)
                const usernameInput = document.getElementById('username');
                if (usernameInput) {
                    usernameInput.addEventListener('input', function() {
                        this.value = this.value.replace(/[^A-Za-z0-9]/g, '');
                    });
                }
            });

            // Auto-open change photo modal if URL parameter is present
            document.addEventListener('DOMContentLoaded', function() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('modal') === 'change-photo') {
                    // Wait a bit for the page to fully load
                    setTimeout(function() {
                        if (typeof openUploadModal === 'function') {
                            openUploadModal();
                        }
                    }, 500);
                    
                    // Clean up URL parameter without reloading
                    const newUrl = window.location.pathname + window.location.hash;
                    window.history.replaceState({}, document.title, newUrl);
                }
            });
        </script>
    </div>

    {{-- Address --}}
    @include('auth.profile.sections.address')

@endsection
