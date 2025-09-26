@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <h1 class="text-slate-800 text-2xl font-medium mb-1 tracking-tight">Unduh Data Saya</h1>
    <p class="text-base text-slate-600">Ekspor semua data pribadi yang kami simpan tentang Anda dalam format yang dapat dibaca</p>
@endpush

@section('section')

    {{-- Data Export Overview --}}
    <div class="bg-white rounded-2xl border border-neutral-200">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Ringkasan Data Anda</h3>
            <p class="text-sm text-slate-600 mt-1">Gambaran data yang dapat Anda unduh dari akun Anda</p>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Profile Data --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-base font-medium text-gray-900">Data Profil</h4>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        @foreach($dataSummary['profile_data'] as $category => $description)
                            <div>• {{ $description }}</div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            ~2-5 KB
                        </span>
                    </div>
                </div>

                {{-- Activity Data --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-base font-medium text-gray-900">Data Aktivitas</h4>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        @foreach($dataSummary['activity_data'] as $category => $description)
                            <div>• {{ $description }}</div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            ~10-50 KB
                        </span>
                    </div>
                </div>

                {{-- Privacy Data --}}
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-base font-medium text-gray-900">Data Privasi</h4>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        @foreach($dataSummary['privacy_data'] as $category => $description)
                            <div>• {{ $description }}</div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                            ~1-3 KB
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Export Options --}}
    <div class="bg-white rounded-2xl border border-neutral-200 mt-6">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Pilihan Ekspor Data</h3>
            <p class="text-sm text-slate-600 mt-1">Pilih jenis data yang ingin Anda unduh</p>
        </div>

        <form action="{{ route('privacy-data.export') }}" method="POST" class="p-6">
            @csrf

            <div class="space-y-6">
                {{-- Complete Export --}}
                <div class="relative">
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-[#128AEB] rounded-lg p-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="complete_export" name="export_type" type="radio" value="complete" 
                                       class="focus:ring-[#128AEB] h-4 w-4 text-[#128AEB] border-gray-300" checked>
                            </div>
                            <div class="ml-3">
                                <label for="complete_export" class="text-base font-medium text-gray-900">
                                    Ekspor Lengkap (Disarankan)
                                </label>
                                <p class="text-sm text-gray-600 mt-1">
                                    Unduh semua data yang terkait dengan akun Anda dalam satu file ZIP terkompresi. 
                                    Termasuk profil, aktivitas, pengaturan privasi, dan log akses.
                                </p>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                        Format ZIP
                                    </span>
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        File JSON
                                    </span>
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                        Mudah dibaca
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Custom Export --}}
                <div class="border border-gray-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="custom_export" name="export_type" type="radio" value="custom" 
                                   class="focus:ring-[#128AEB] h-4 w-4 text-[#128AEB] border-gray-300">
                        </div>
                        <div class="ml-3 flex-1">
                            <label for="custom_export" class="text-base font-medium text-gray-900">
                                Ekspor Kustom
                            </label>
                            <p class="text-sm text-gray-600 mt-1">
                                Pilih kategori data tertentu yang ingin Anda unduh.
                            </p>
                            
                            <div id="custom_options" class="mt-4 space-y-3 opacity-50 pointer-events-none">
                                <label class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="profile" 
                                           class="focus:ring-[#128AEB] h-4 w-4 text-[#128AEB] border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Data Profil dan Akun</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="activity" 
                                           class="focus:ring-[#128AEB] h-4 w-4 text-[#128AEB] border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Riwayat Aktivitas dan Login</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="privacy" 
                                           class="focus:ring-[#128AEB] h-4 w-4 text-[#128AEB] border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Pengaturan Privasi dan Persetujuan</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="communications" 
                                           class="focus:ring-[#128AEB] h-4 w-4 text-[#128AEB] border-gray-300 rounded">
                                    <span class="ml-2 text-sm text-gray-700">Riwayat Komunikasi dan Support</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Button --}}
            <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-6">
                <div class="text-sm text-gray-600">
                    <p>⏱️ Waktu pemrosesan: 2-10 menit</p>
                    <p>📧 Hasil akan dikirim ke email Anda</p>
                </div>
                <button type="submit" 
                        class="bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium px-8 py-3 rounded-full transition flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                    </svg>
                    Mulai Ekspor Data
                </button>
            </div>
        </form>
    </div>

    {{-- Export History --}}
    <div class="bg-white rounded-2xl border border-neutral-200 mt-6">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Riwayat Ekspor</h3>
            <p class="text-sm text-slate-600 mt-1">File ekspor yang pernah Anda buat sebelumnya</p>
        </div>

        <div class="p-6">
            <div class="space-y-4">
                {{-- Sample Export History --}}
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-medium text-gray-900">Ekspor Lengkap</h4>
                            <p class="text-sm text-gray-600">Dibuat pada 28 Agustus 2024, 14:30</p>
                            <p class="text-xs text-gray-500">Ukuran file: 2.3 MB • Format: ZIP</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                            Kadaluarsa
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2-2H5a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-base font-medium text-gray-900">Ekspor Data Profil</h4>
                            <p class="text-sm text-gray-600">Dibuat pada 15 Agustus 2024, 09:15</p>
                            <p class="text-xs text-gray-500">Ukuran file: 156 KB • Format: JSON</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            Tersedia
                        </span>
                        <button type="button" class="text-[#128AEB] hover:text-[#0F76C6] text-sm font-medium">
                            Unduh
                        </button>
                    </div>
                </div>

                {{-- Empty State if no history --}}
                <div class="text-center py-8 text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="mt-2 text-sm">Belum ada riwayat ekspor data</p>
                    <p class="text-xs text-gray-400">File ekspor akan disimpan selama 30 hari</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Important Information --}}
    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mt-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">Informasi Penting tentang Ekspor Data</h3>
                <div class="mt-2 text-sm text-yellow-700">
                    <ul class="list-disc pl-5 space-y-1">
                        <li><strong>Keamanan:</strong> File ekspor dilindungi dan hanya dapat diakses oleh Anda</li>
                        <li><strong>Waktu Kedaluwarsa:</strong> Link unduhan berlaku selama 7 hari setelah dibuat</li>
                        <li><strong>Format File:</strong> Data diekspor dalam format JSON yang dapat dibaca manusia</li>
                        <li><strong>Ukuran File:</strong> File ZIP terkompresi biasanya berukuran 1-10 MB tergantung aktivitas</li>
                        <li><strong>Notifikasi:</strong> Anda akan menerima email ketika ekspor selesai diproses</li>
                        <li><strong>Frekuensi:</strong> Anda dapat mengekspor data maksimal 3 kali per bulan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enable/disable custom export options based on radio selection
        document.addEventListener('DOMContentLoaded', function() {
            const customRadio = document.getElementById('custom_export');
            const completeRadio = document.getElementById('complete_export');
            const customOptions = document.getElementById('custom_options');
            
            customRadio.addEventListener('change', function() {
                if (this.checked) {
                    customOptions.classList.remove('opacity-50', 'pointer-events-none');
                }
            });
            
            completeRadio.addEventListener('change', function() {
                if (this.checked) {
                    customOptions.classList.add('opacity-50', 'pointer-events-none');
                }
            });
        });
    </script>

@endsection
