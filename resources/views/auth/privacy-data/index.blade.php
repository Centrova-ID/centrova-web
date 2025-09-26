@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <h1 class="text-slate-800 text-2xl font-medium mb-1 tracking-tight">Data dan Privasi</h1>
    <p class="text-base text-slate-600">Kelola data pribadi Anda dan kontrol pengaturan privasi untuk menjaga keamanan informasi</p>
@endpush

@section('section')

    {{-- Keamanan Data --}}
    <section>
        <div class="mb-3">
            <h1 class="text-slate-800 text-lg font-medium mb-1 tracking-tight">Keamanan Data</h1>
            <p class="text-sm text-slate-600">Kelola akses data pribadi dan kontrol siapa yang dapat melihat informasi Anda</p>
        </div>

        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            <div class="divide-y divide-neutral-200">
                <button type="button" class="w-full" onclick="window.location.href='{{ route('privacy-data.visibility') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <div class="text-left">
                                <h1 class="text-gray-900 font-medium">Visibilitas Profil</h1>
                                <p class="text-sm text-gray-600 mt-1">Kontrol siapa yang dapat melihat informasi profil Anda</p>
                            </div>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full" onclick="window.location.href='{{ route('privacy-data.data-sharing') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <div class="text-left">
                                <h1 class="text-gray-900 font-medium">Berbagi Data</h1>
                                <p class="text-sm text-gray-600 mt-1">Atur pengaturan berbagi data dengan aplikasi dan layanan pihak ketiga</p>
                            </div>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full" onclick="window.location.href='{{ route('privacy-data.tracking') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <div class="text-left">
                                <h1 class="text-gray-900 font-medium">Pelacakan Aktivitas</h1>
                                <p class="text-sm text-gray-600 mt-1">Kontrol bagaimana aktivitas dan lokasi Anda dilacak</p>
                            </div>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </section>

    {{-- Manajemen Data --}}
    <section>
        <div class="mb-3">
            <h1 class="text-slate-800 text-lg font-medium mb-1 tracking-tight">Manajemen Data</h1>
            <p class="text-sm text-slate-600">Ekspor, koreksi, atau hapus data pribadi Anda sesuai dengan hak privasi</p>
        </div>

        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            <div class="divide-y divide-neutral-200">
                <button type="button" class="w-full" onclick="window.location.href='{{ route('privacy-data.download') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <div class="text-left">
                                <h1 class="text-gray-900 font-medium">Unduh Data Saya</h1>
                                <p class="text-sm text-gray-600 mt-1">Ekspor semua data pribadi yang kami simpan tentang Anda</p>
                            </div>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full" onclick="window.location.href='{{ route('privacy-data.data-access') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <div class="text-left">
                                <h1 class="text-gray-900 font-medium">Riwayat Akses Data</h1>
                                <p class="text-sm text-gray-600 mt-1">Lihat siapa yang mengakses data Anda dan kapan</p>
                            </div>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full" onclick="window.location.href='{{ route('privacy-data.consent-management') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <div class="text-left">
                                <h1 class="text-gray-900 font-medium">Manajemen Persetujuan</h1>
                                <p class="text-sm text-gray-600 mt-1">Kelola persetujuan untuk pemrosesan data dan layanan</p>
                            </div>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </section>

@endsection
