@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <h1 class="text-slate-800 text-2xl font-medium mb-1 tracking-tight">Pelacakan Aktivitas</h1>
    <p class="text-base text-slate-600">Kontrol bagaimana aktivitas dan lokasi Anda dilacak untuk meningkatkan pengalaman</p>
@endpush

@section('section')

    {{-- Activity Tracking Settings --}}
    <div class="bg-white rounded-2xl border border-neutral-200">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Pengaturan Pelacakan</h3>
            <p class="text-sm text-slate-600 mt-1">Pilih jenis aktivitas yang ingin Anda lacak untuk personalisasi layanan</p>
        </div>

        <form action="{{ route('privacy-data.tracking.update') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- Activity Tracking --}}
            <div class="flex items-start justify-between">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Pelacakan Aktivitas</h4>
                    <p class="text-sm text-gray-600 mt-1">Melacak interaksi Anda dengan platform untuk memberikan rekomendasi yang lebih baik</p>
                    <div class="mt-2 space-y-1 text-xs text-gray-500">
                        <div>• Halaman yang dikunjungi</div>
                        <div>• Waktu yang dihabiskan di setiap halaman</div>
                        <div>• Klik dan interaksi dengan elemen</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="track_activity" value="0">
                    <input type="checkbox" name="track_activity" id="track_activity" 
                           {{ ($trackingSettings['track_activity'] ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Location Tracking --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Pelacakan Lokasi</h4>
                    <p class="text-sm text-gray-600 mt-1">Menggunakan informasi lokasi untuk memberikan konten dan layanan yang relevan dengan wilayah Anda</p>
                    <div class="mt-2 space-y-1 text-xs text-gray-500">
                        <div>• Lokasi berdasarkan IP address</div>
                        <div>• Zona waktu dan pengaturan regional</div>
                        <div>• Konten yang disesuaikan dengan lokasi</div>
                    </div>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                            Dapat mempengaruhi layanan lokal
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="track_location" value="0">
                    <input type="checkbox" name="track_location" id="track_location" 
                           {{ ($trackingSettings['track_location'] ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Search History --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Riwayat Pencarian</h4>
                    <p class="text-sm text-gray-600 mt-1">Menyimpan riwayat pencarian Anda untuk memberikan saran pencarian dan hasil yang lebih relevan</p>
                    <div class="mt-2 space-y-1 text-xs text-gray-500">
                        <div>• Kata kunci pencarian</div>
                        <div>• Waktu dan frekuensi pencarian</div>
                        <div>• Hasil yang diklik dari pencarian</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="save_search_history" value="0">
                    <input type="checkbox" name="save_search_history" id="save_search_history" 
                           {{ ($trackingSettings['save_search_history'] ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Personalized Ads --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Iklan yang Dipersonalisasi</h4>
                    <p class="text-sm text-gray-600 mt-1">Menggunakan data aktivitas untuk menampilkan iklan yang lebih relevan dengan minat Anda</p>
                    <div class="mt-2 space-y-1 text-xs text-gray-500">
                        <div>• Preferensi berdasarkan aktivitas</div>
                        <div>• Demografis dan minat</div>
                        <div>• Riwayat interaksi dengan iklan</div>
                    </div>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            Iklan tetap ditampilkan, namun kurang relevan jika dinonaktifkan
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="personalized_ads" value="0">
                    <input type="checkbox" name="personalized_ads" id="personalized_ads" 
                           {{ ($trackingSettings['personalized_ads'] ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Analytics Tracking --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Pelacakan Analitik</h4>
                    <p class="text-sm text-gray-600 mt-1">Mengumpulkan data anonim untuk analisis performa website dan peningkatan layanan</p>
                    <div class="mt-2 space-y-1 text-xs text-gray-500">
                        <div>• Statistik penggunaan website</div>
                        <div>• Performa halaman dan fitur</div>
                        <div>• Data demografis agregat</div>
                    </div>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            Data dianonimkan
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="analytics_tracking" value="0">
                    <input type="checkbox" name="analytics_tracking" id="analytics_tracking" 
                           {{ ($trackingSettings['analytics_tracking'] ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Usage Data Collection --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Pengumpulan Data Penggunaan</h4>
                    <p class="text-sm text-gray-600 mt-1">Mengumpulkan informasi tentang bagaimana Anda menggunakan fitur untuk pengembangan produk</p>
                    <div class="mt-2 space-y-1 text-xs text-gray-500">
                        <div>• Fitur yang paling sering digunakan</div>
                        <div>• Waktu penggunaan aplikasi</div>
                        <div>• Error dan crash reports</div>
                        <div>• Feedback dan rating</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="usage_data_collection" value="0">
                    <input type="checkbox" name="usage_data_collection" id="usage_data_collection" 
                           {{ ($trackingSettings['usage_data_collection'] ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
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

    {{-- Tracking Summary --}}
    <div class="bg-white rounded-2xl border border-neutral-200 mt-6">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Ringkasan Pelacakan Anda</h3>
            <p class="text-sm text-slate-600 mt-1">Gambaran data yang sedang dilacak dari akun Anda</p>
        </div>

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Activities Tracked --}}
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-blue-800">Aktivitas Dilacak</h4>
                            <p class="text-2xl font-bold text-blue-900">{{ ($trackingSettings['track_activity'] ?? true) ? '1,247' : '0' }}</p>
                            <p class="text-xs text-blue-600">interaksi bulan ini</p>
                        </div>
                    </div>
                </div>

                {{-- Search Queries --}}
                <div class="bg-green-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-green-800">Pencarian Tersimpan</h4>
                            <p class="text-2xl font-bold text-green-900">{{ ($trackingSettings['save_search_history'] ?? true) ? '89' : '0' }}</p>
                            <p class="text-xs text-green-600">query pencarian</p>
                        </div>
                    </div>
                </div>

                {{-- Location Data --}}
                <div class="bg-yellow-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-yellow-800">Data Lokasi</h4>
                            <p class="text-2xl font-bold text-yellow-900">{{ ($trackingSettings['track_location'] ?? true) ? 'Aktif' : 'Nonaktif' }}</p>
                            <p class="text-xs text-yellow-600">status pelacakan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Retention Information --}}
    <div class="bg-gray-50 rounded-2xl border border-gray-200 mt-6 p-6">
        <h3 class="text-lg font-medium text-slate-900 mb-4">Kebijakan Retensi Data Pelacakan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-medium text-gray-900 mb-2">Data Aktivitas</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Riwayat browsing: 12 bulan</li>
                    <li>• Data interaksi: 6 bulan</li>
                    <li>• Preferensi: Hingga akun dihapus</li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-gray-900 mb-2">Data Analitik</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Data anonim: 24 bulan</li>
                    <li>• Laporan agregat: 36 bulan</li>
                    <li>• Metrics performa: 12 bulan</li>
                </ul>
            </div>
        </div>
        <div class="mt-4 p-4 bg-blue-100 rounded-lg">
            <p class="text-sm text-blue-800">
                <strong>Catatan:</strong> Semua data pelacakan dapat dihapus kapan saja melalui halaman 
                <a href="{{ route('privacy-data.download') }}" class="text-blue-600 hover:text-blue-800 underline">Unduh Data Saya</a> 
                atau dengan menghubungi tim privasi kami.
            </p>
        </div>
    </div>

@endsection
