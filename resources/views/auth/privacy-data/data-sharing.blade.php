@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <h1 class="text-slate-800 text-2xl font-medium mb-1 tracking-tight">Berbagi Data</h1>
    <p class="text-base text-slate-600">Atur pengaturan berbagi data dengan aplikasi dan layanan pihak ketiga</p>
@endpush

@section('section')

    {{-- Data Sharing Settings --}}
    <div class="bg-white rounded-2xl border border-neutral-200">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Pengaturan Berbagi Data</h3>
            <p class="text-sm text-slate-600 mt-1">Kontrol bagaimana data Anda dibagikan dengan layanan eksternal</p>
        </div>

        <form action="{{ route('privacy-data.data-sharing.update') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- Third Party Cookies --}}
            <div class="flex items-start justify-between">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Cookie Pihak Ketiga</h4>
                    <p class="text-sm text-gray-600 mt-1">Mengizinkan website pihak ketiga menyimpan cookie di browser Anda</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                            Dapat mempengaruhi pengalaman pengguna
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="third_party_cookies" value="0">
                    <input type="checkbox" name="third_party_cookies" id="third_party_cookies" 
                           {{ ($dataSharingSettings['third_party_cookies'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Social Media Integration --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Integrasi Media Sosial</h4>
                    <p class="text-sm text-gray-600 mt-1">Memungkinkan berbagi informasi dengan platform media sosial untuk fitur login dan berbagi</p>
                    <div class="mt-2 space-x-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            Facebook
                        </span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            Google
                        </span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            LinkedIn
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="social_media_integration" value="0">
                    <input type="checkbox" name="social_media_integration" id="social_media_integration" 
                           {{ ($dataSharingSettings['social_media_integration'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- External Service Access --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Akses Layanan Eksternal</h4>
                    <p class="text-sm text-gray-600 mt-1">Mengizinkan aplikasi pihak ketiga mengakses data Anda melalui API</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                            Berpotensi berisiko
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="external_service_access" value="0">
                    <input type="checkbox" name="external_service_access" id="external_service_access" 
                           {{ ($dataSharingSettings['external_service_access'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Data Analytics --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Analitik Data</h4>
                    <p class="text-sm text-gray-600 mt-1">Berbagi data anonim untuk analisis dan peningkatan layanan</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            Data dianonimkan
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="data_analytics" value="0">
                    <input type="checkbox" name="data_analytics" id="data_analytics" 
                           {{ ($dataSharingSettings['data_analytics'] ?? true) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Advertising Data --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Data Periklanan</h4>
                    <p class="text-sm text-gray-600 mt-1">Berbagi informasi dengan partner periklanan untuk menampilkan iklan yang lebih relevan</p>
                    <div class="mt-2 space-x-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                            Google Ads
                        </span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                            Facebook Ads
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="advertising_data" value="0">
                    <input type="checkbox" name="advertising_data" id="advertising_data" 
                           {{ ($dataSharingSettings['advertising_data'] ?? false) ? 'checked' : '' }}
                           class="h-5 w-5 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                </div>
            </div>

            {{-- Research Participation --}}
            <div class="flex items-start justify-between border-t border-gray-200 pt-6">
                <div class="flex-1 pr-4">
                    <h4 class="text-base font-medium text-gray-900">Partisipasi Riset</h4>
                    <p class="text-sm text-gray-600 mt-1">Berbagi data untuk keperluan riset akademik dan pengembangan teknologi</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">
                            Data dianonimkan
                        </span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">
                            Opsional
                        </span>
                    </div>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="research_participation" value="0">
                    <input type="checkbox" name="research_participation" id="research_participation" 
                           {{ ($dataSharingSettings['research_participation'] ?? false) ? 'checked' : '' }}
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

    {{-- Connected Services --}}
    <div class="bg-white rounded-2xl border border-neutral-200 mt-6">
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Layanan yang Terhubung</h3>
            <p class="text-sm text-slate-600 mt-1">Kelola akses aplikasi dan layanan yang terhubung dengan akun Anda</p>
        </div>

        <div class="p-6 space-y-4">
            {{-- Google Services --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center border">
                        <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-medium text-gray-900">Google Analytics</h4>
                        <p class="text-sm text-gray-600">Menganalisis penggunaan website dan perilaku pengguna</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                        Aktif
                    </span>
                    <button type="button" class="text-red-600 hover:text-red-800 text-sm font-medium">
                        Putuskan
                    </button>
                </div>
            </div>

            {{-- Mailchimp --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-medium text-gray-900">Mailchimp</h4>
                        <p class="text-sm text-gray-600">Mengelola email marketing dan newsletter</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                        Tidak Aktif
                    </span>
                    <button type="button" class="text-[#128AEB] hover:text-[#0F76C6] text-sm font-medium">
                        Hubungkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Sharing Information --}}
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mt-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-amber-800">Informasi Penting tentang Berbagi Data</h3>
                <div class="mt-2 text-sm text-amber-700">
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Data yang dibagikan dapat membantu meningkatkan layanan dan pengalaman Anda</li>
                        <li>Kami hanya berbagi data dengan mitra tepercaya yang memiliki standar privasi tinggi</li>
                        <li>Anda dapat mencabut izin berbagi data kapan saja tanpa mempengaruhi akun utama</li>
                        <li>Data sensitif seperti password dan informasi keuangan tidak pernah dibagikan</li>
                        <li>Semua aktivitas berbagi data dicatat dalam log audit yang dapat Anda akses</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
