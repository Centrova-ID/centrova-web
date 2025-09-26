{{-- Address Section --}}
@if($user->address || $user->city || $user->postal_code || $user->country)
    {{-- User has address data - show full section --}}
    <div id="address-section" class="profile-section bg-white rounded-2xl border border-neutral-200">
        {{-- View Mode --}}
        <div id="address-view">
            <div class="flex justify-between items-center px-6 py-3">
                <h3 class="text-lg font-medium text-slate-900">Informasi Alamat</h3>
                <button onclick="toggleEditMode('address')" class="text-[#128AEB] text-base font-medium">
                    Edit Alamat
                </button>
            </div>
        
        <div>
            <div onclick="toggleEditMode('address')" class="divide-y divide-neutral-200/80 border-t border-neutral-200/80">
                <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                    <span class="block text-sm font-normal text-gray-700 w-[35%]">Alamat Lengkap</span>
                    <p class="text-gray-900 w-full">{{ $user->address ?? '-' }}</p>
                    <img src="/assets/icons/ui/arrow/right-gray.svg">
                </div>
                
                <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                    <span class="block text-sm font-normal text-gray-700 w-[35%]">Kota</span>
                    <p class="text-gray-900 w-full">{{ $user->city ?? '-' }}</p>
                    <img src="/assets/icons/ui/arrow/right-gray.svg">
                </div>

                <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                    <span class="block text-sm font-normal text-gray-700 w-[35%]">Kode Pos</span>
                    <p class="text-gray-900 w-full">{{ $user->postal_code ?? '-' }}</p>
                    <img src="/assets/icons/ui/arrow/right-gray.svg">
                </div>

                <div class="flex cursor-pointer items-start text-left gap-6 hover:bg-neutral-100 px-6 py-3">
                    <span class="block text-sm font-normal text-gray-700 w-[35%]">Negara</span>
                    <p class="text-gray-900 w-full">
                        @switch($user->country)
                            @case('Indonesia') Indonesia @break
                            @case('Malaysia') Malaysia @break
                            @case('Singapore') Singapore @break
                            @case('Thailand') Thailand @break
                            @case('Philippines') Philippines @break
                            @case('Vietnam') Vietnam @break
                            @case('United States') United States @break
                            @case('United Kingdom') United Kingdom @break
                            @case('Australia') Australia @break
                            @case('Japan') Japan @break
                            @case('South Korea') South Korea @break
                            @case('China') China @break
                            @default -
                        @endswitch
                    </p>
                    <img src="/assets/icons/ui/arrow/right-gray.svg">
                </div>
            </div>
        </div>
    </div>
    
    {{-- Edit Mode (Hidden by default) --}}
    <div id="address-edit" class="hidden px-6 py-3">
        <h3 class="text-lg font-medium text-slate-900 mb-6">Informasi Alamat</h3>
        
        <form action="{{ route('profile.update-address') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                <div class="relative">
                    <textarea id="address" name="address" rows="3" 
                              placeholder="Masukkan alamat lengkap Anda"
                              class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent resize-none
                                     {{ $errors->has('address') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">{{ old('address', $user->address) }}</textarea>
                    <div class="absolute left-3 top-2.5">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                @error('address')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                    <div class="relative">
                        <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}" 
                               placeholder="Nama kota"
                               class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                      {{ $errors->has('city') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                        <div class="absolute left-3 top-2.5">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    @error('city')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                    <div class="relative">
                        <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" 
                               placeholder="12345"
                               class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                      {{ $errors->has('postal_code') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                        <div class="absolute left-3 top-2.5">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('postal_code')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                <div class="relative">
                    <select id="country" name="country" class="w-full pl-10 pr-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent appearance-none bg-white
                                   {{ $errors->has('country') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}"
                            onchange="handleCountryChange(this)">
                        @if(old('country', $user->country))
                            <option value="Indonesia" {{ old('country', $user->country) == 'Indonesia' ? 'selected' : '' }}>🇮🇩 Indonesia</option>
                            <option value="Malaysia" {{ old('country', $user->country) == 'Malaysia' ? 'selected' : '' }}>🇲🇾 Malaysia</option>
                            <option value="Singapore" {{ old('country', $user->country) == 'Singapore' ? 'selected' : '' }}>🇸🇬 Singapore</option>
                            <option value="Thailand" {{ old('country', $user->country) == 'Thailand' ? 'selected' : '' }}>🇹🇭 Thailand</option>
                            <option value="Philippines" {{ old('country', $user->country) == 'Philippines' ? 'selected' : '' }}>🇵🇭 Philippines</option>
                            <option value="Vietnam" {{ old('country', $user->country) == 'Vietnam' ? 'selected' : '' }}>🇻🇳 Vietnam</option>
                            <option value="United States" {{ old('country', $user->country) == 'United States' ? 'selected' : '' }}>🇺🇸 United States</option>
                            <option value="United Kingdom" {{ old('country', $user->country) == 'United Kingdom' ? 'selected' : '' }}>🇬🇧 United Kingdom</option>
                            <option value="Australia" {{ old('country', $user->country) == 'Australia' ? 'selected' : '' }}>🇦🇺 Australia</option>
                            <option value="Japan" {{ old('country', $user->country) == 'Japan' ? 'selected' : '' }}>🇯🇵 Japan</option>
                            <option value="South Korea" {{ old('country', $user->country) == 'South Korea' ? 'selected' : '' }}>🇰🇷 South Korea</option>
                            <option value="China" {{ old('country', $user->country) == 'China' ? 'selected' : '' }}>🇨🇳 China</option>
                        @else
                            <option value="">Pilih negara</option>
                            <option value="Indonesia">🇮🇩 Indonesia</option>
                            <option value="Malaysia">🇲🇾 Malaysia</option>
                            <option value="Singapore">🇸🇬 Singapore</option>
                            <option value="Thailand">🇹🇭 Thailand</option>
                            <option value="Philippines">🇵🇭 Philippines</option>
                            <option value="Vietnam">🇻🇳 Vietnam</option>
                            <option value="United States">🇺🇸 United States</option>
                            <option value="United Kingdom">🇬🇧 United Kingdom</option>
                            <option value="Australia">🇦🇺 Australia</option>
                            <option value="Japan">🇯🇵 Japan</option>
                            <option value="South Korea">🇰🇷 South Korea</option>
                            <option value="China">🇨🇳 China</option>
                        @endif
                    </select>
                    <div class="absolute left-3 top-2.5">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="absolute right-3 top-2.5">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
                @error('country')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4 pt-2">
                <button type="button" onclick="toggleEditMode('address')" class="text-gray-700 hover:text-gray-900 font-medium px-6 py-2 rounded-full transition flex items-center gap-2 border border-gray-300 hover:border-gray-400">
                    Batal
                </button>
                <button type="submit" class="bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium px-6 py-2 rounded-full transition flex items-center gap-2">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@else
    {{-- User doesn't have address data - show add address button --}}
    <button type="button" onclick="showAddressModal()" class="profile-section bg-white rounded-2xl hover:bg-neutral-100 cursor-pointer border border-neutral-200 w-full text-left">
        <div class="flex justify-between items-center px-6 py-3">
            <div>
                <h3 class="text-base font-medium text-slate-900">Tambahkan Informasi Alamat</h3>
                <p class="text-[15px] text-neutral-700">Gunakan alamat ini jika Anda ingin melakukan konsultasi secara langsung.</p>
            </div>
            <img src="/assets/icons/ui/arrow/right-gray.svg">
        </div>
    </button>
@endif

<div>
    {{-- Modal Konfirmasi Alamat --}}
    <div id="address-modal" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-50 flex items-center justify-center min-h-screen w-full">
        <div class="bg-white rounded-[32px] p-6 m-4 max-w-md w-full shadow-xl">
            <div class="text-center">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-[#128AEB] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                
                <h3 class="text-lg font-medium text-slate-900 mb-2">Tambahkan Informasi Alamat</h3>
                
                <p class="text-base text-neutral-900 mb-6 leading-relaxed">
                    Informasi alamat ini hanya akan digunakan untuk keperluan apabila ingin konsultasi secara langsung. Data alamat Anda akan disimpan dengan aman dan tidak akan dibagikan kepada pihak ketiga tanpa persetujuan Anda. <a href="{{ route('legal.privacy') }}" class="text-blue-600 hover:underline outline-none" target="_blank">Pelajari lebih lanjut.</a>
                </p>
                
                <div class="flex gap-3">
                    <button type="button" onclick="hideAddressModal()" class="flex-1 text-gray-900 font-medium px-6 py-2 rounded-full border border-gray-400 hover:bg-neutral-100">
                        Batal
                    </button>
                    <button type="button" onclick="proceedToAddAddress()" class="flex-1 bg-[#128AEB] hover:bg-[#1184e1] text-white font-medium px-6 py-2 rounded-full">
                        Setuju
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showAddressModal() {
    document.getElementById('address-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideAddressModal() {
    document.getElementById('address-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function proceedToAddAddress() {
    hideAddressModal();
    // Show the address form directly
    showAddAddressForm();
}

function showAddAddressForm() {
    // Create the address section dynamically if it doesn't exist
    const existingSection = document.getElementById('address-section');
    if (!existingSection) {
        const buttonElement = document.querySelector('button[onclick="showAddressModal()"]');
        const addressSection = `
            <div id="address-section" class="profile-section bg-white rounded-2xl border border-neutral-200">
                <div id="address-edit" class="px-6 py-3">
                    <h3 class="text-lg font-medium text-slate-900 mb-6">Informasi Alamat</h3>
                    
                    <form action="{{ route('profile.update-address') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                            <div class="relative">
                                <textarea id="address" name="address" rows="3" 
                                          placeholder="Masukkan alamat lengkap Anda"
                                          class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent resize-none"></textarea>
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                                <div class="relative">
                                    <input type="text" id="city" name="city" placeholder="Nama kota"
                                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                    <div class="absolute left-3 top-2.5">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                <div class="relative">
                                    <input type="text" id="postal_code" name="postal_code" placeholder="12345"
                                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                                    <div class="absolute left-3 top-2.5">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                            <div class="relative">
                                <select id="country" name="country" class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent appearance-none bg-white">
                                    <option value="">Pilih negara</option>
                                    <option value="Indonesia">🇮🇩 Indonesia</option>
                                    <option value="Malaysia">🇲🇾 Malaysia</option>
                                    <option value="Singapore">🇸🇬 Singapore</option>
                                    <option value="Thailand">🇹🇭 Thailand</option>
                                    <option value="Philippines">🇵🇭 Philippines</option>
                                    <option value="Vietnam">🇻🇳 Vietnam</option>
                                    <option value="United States">🇺🇸 United States</option>
                                    <option value="United Kingdom">🇬🇧 United Kingdom</option>
                                    <option value="Australia">🇦🇺 Australia</option>
                                    <option value="Japan">🇯🇵 Japan</option>
                                    <option value="South Korea">🇰🇷 South Korea</option>
                                    <option value="China">🇨🇳 China</option>
                                </select>
                                <div class="absolute left-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="absolute right-3 top-2.5">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 pt-2">
                            <button type="button" onclick="cancelAddAddress()" class="text-gray-700 hover:text-gray-900 font-medium px-6 py-2 rounded-full transition flex items-center gap-2 border border-gray-300 hover:border-gray-400">
                                Batal
                            </button>
                            <button type="submit" class="bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium px-6 py-2 rounded-full transition flex items-center gap-2">
                                Simpan Alamat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        buttonElement.outerHTML = addressSection;
    }
}

function cancelAddAddress() {
    // Hide the form and show the add button again
    const addressSection = document.getElementById('address-section');
    if (addressSection) {
        const addButton = `
            <button type="button" onclick="showAddressModal()" class="profile-section bg-white rounded-2xl hover:bg-neutral-100 cursor-pointer border border-neutral-200 w-full text-left">
                <div class="flex justify-between items-center px-6 py-3">
                    <div>
                        <h3 class="text-base font-medium text-slate-900">Tambahkan Informasi Alamat</h3>
                        <p class="text-[15px] text-neutral-700">Gunakan alamat ini jika Anda ingin melakukan konsultasi secara langsung.</p>
                    </div>
                    <img src="/assets/icons/ui/arrow/right-gray.svg">
                </div>
            </button>
        `;
        addressSection.outerHTML = addButton;
    }
}

// Close modal when clicking outside
document.getElementById('address-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideAddressModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideAddressModal();
    }
});
</script>