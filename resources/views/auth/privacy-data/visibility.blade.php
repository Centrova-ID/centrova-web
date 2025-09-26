@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <h1 class="text-slate-800 text-2xl font-medium mb-1 tracking-tight">Visibilitas Profil</h1>
    <p class="text-base text-slate-600">Kontrol siapa yang dapat melihat informasi profil dan data pribadi Anda</p>
@endpush

@section('section')

    {{-- Profile Visibility Settings --}}
    <div class="bg-white rounded-2xl border border-neutral-200">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Pengaturan Visibilitas</h3>
            <p class="text-sm text-slate-600 mt-1">Pilih informasi apa yang ingin Anda tampilkan kepada pengguna lain</p>
        </div>

        <form action="{{ route('privacy-data.visibility.update') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- Public Profile --}}
            <div class="flex items-start justify-between">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Profil Publik</h4>
                    <p class="text-sm text-gray-600 mt-1">Membuat profil Anda dapat ditemukan dan dilihat oleh siapa saja</p>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="public_profile" value="0">
                    <input type="checkbox" name="public_profile" id="public_profile" 
                           {{ ($privacySettings['public_profile'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Email Visibility --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Tampilkan Email</h4>
                    <p class="text-sm text-gray-600 mt-1">Memungkinkan orang lain melihat alamat email Anda</p>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="show_email" value="0">
                    <input type="checkbox" name="show_email" id="show_email" 
                           {{ ($privacySettings['show_email'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Phone Visibility --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Tampilkan Nomor Telepon</h4>
                    <p class="text-sm text-gray-600 mt-1">Memungkinkan orang lain melihat nomor telepon Anda</p>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="show_phone" value="0">
                    <input type="checkbox" name="show_phone" id="show_phone" 
                           {{ ($privacySettings['show_phone'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Birth Date Visibility --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Tampilkan Tanggal Lahir</h4>
                    <p class="text-sm text-gray-600 mt-1">Memungkinkan orang lain melihat tanggal lahir Anda</p>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="show_birth_date" value="0">
                    <input type="checkbox" name="show_birth_date" id="show_birth_date" 
                           {{ ($privacySettings['show_birth_date'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Address Visibility --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Tampilkan Alamat</h4>
                    <p class="text-sm text-gray-600 mt-1">Memungkinkan orang lain melihat informasi alamat Anda</p>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="show_address" value="0">
                    <input type="checkbox" name="show_address" id="show_address" 
                           {{ ($privacySettings['show_address'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Online Status --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Status Online</h4>
                    <p class="text-sm text-gray-600 mt-1">Menampilkan apakah Anda sedang online atau tidak</p>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="show_online_status" value="0">
                    <input type="checkbox" name="show_online_status" id="show_online_status" 
                           {{ ($privacySettings['show_online_status'] ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-slate-900 mb-4">Pengaturan Pencarian</h3>
                <p class="text-sm text-gray-600 mb-6">Kontrol bagaimana orang lain dapat menemukan profil Anda</p>

                {{-- Searchable by Email --}}
                <div class="flex items-start justify-between mb-6">
                    <div class="flex-1 pr-4">
                        <h4 class="text-base font-medium text-gray-900">Dapat Dicari Melalui Email</h4>
                        <p class="text-sm text-gray-600 mt-1">Memungkinkan orang menemukan profil Anda menggunakan alamat email</p>
                    </div>
                    <div class="flex items-center">
                        <input type="hidden" name="searchable_by_email" value="0">
                        <input type="checkbox" name="searchable_by_email" id="searchable_by_email" 
                               {{ ($privacySettings['searchable_by_email'] ?? true) ? 'checked' : '' }}
                               class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                    </div>
                </div>

                {{-- Searchable by Phone --}}
                <div class="flex items-start justify-between mb-6">
                    <div class="flex-1 pr-4">
                        <h4 class="text-base font-medium text-gray-900">Dapat Dicari Melalui Telepon</h4>
                        <p class="text-sm text-gray-600 mt-1">Memungkinkan orang menemukan profil Anda menggunakan nomor telepon</p>
                    </div>
                    <div class="flex items-center">
                        <input type="hidden" name="searchable_by_phone" value="0">
                        <input type="checkbox" name="searchable_by_phone" id="searchable_by_phone" 
                               {{ ($privacySettings['searchable_by_phone'] ?? false) ? 'checked' : '' }}
                               class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                    </div>
                </div>

                {{-- Searchable by Name --}}
                <div class="flex items-start justify-between">
                    <div class="flex-1 pr-4">
                        <h4 class="text-base font-medium text-gray-900">Dapat Dicari Melalui Nama</h4>
                        <p class="text-sm text-gray-600 mt-1">Memungkinkan orang menemukan profil Anda menggunakan nama lengkap</p>
                    </div>
                    <div class="flex items-center">
                        <input type="hidden" name="searchable_by_name" value="0">
                        <input type="checkbox" name="searchable_by_name" id="searchable_by_name" 
                               {{ ($privacySettings['searchable_by_name'] ?? true) ? 'checked' : '' }}
                               class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('privacy-data.index') }}" 
                   class="text-gray-700 hover:text-gray-900 font-medium px-6 py-2 rounded-full transition flex items-center gap-2 border border-gray-300 hover:border-gray-400">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium px-6 py-2 rounded-full transition flex items-center gap-2">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    {{-- Privacy Tips --}}
    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mt-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Tips Privasi</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Semakin sedikit informasi yang Anda tampilkan, semakin aman privasi Anda</li>
                        <li>Profil publik memungkinkan mesin pencari mengindex informasi Anda</li>
                        <li>Anda dapat mengubah pengaturan ini kapan saja</li>
                        <li>Beberapa fitur mungkin memerlukan informasi tertentu untuk berfungsi optimal</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
