@extends('partials.layouts.settingsAccount')

{{-- Intro --}}
@push('intro-section')
    <h1 class="text-slate-800 text-2xl font-medium mb-1 tracking-tight">Kata Sandi dan Keamanan</h1>
    <p class="text-base text-slate-600">Setelan dan rekomendasi untuk membantu menjaga keamanan akun Anda</p>
@endpush

@section('section')

    {{-- Login dan Pemulihan --}}
    <section>
        <div class="mb-3">
            <h1 class="text-slate-800 text-lg font-medium mb-1 tracking-tight">Login dan Pemulihan</h1>
            <p class="text-sm text-slate-600">Kelola kata sandi, preferensi login, dan metode pemulihan Anda</p>
        </div>

        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            <div class="divide-y divide-neutral-200">
                <button type="button" class="w-full" onclick="window.location.href='{{ route('security.password.edit') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <h1>Ganti Kata Sandi</h1>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full" onclick="window.location.href='{{ route('security.two-factor.index') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <h1>Autentikasi Dua Faktor</h1>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full" onclick="window.location.href='#'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <h1>Login yang Tersimpan</h1>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </section>

    {{-- Cek Keamanan --}}
    <section>
        <div class="mb-3">
            <h1 class="text-slate-800 text-lg font-medium mb-1 tracking-tight">Cek Keamanan</h1>
            <p class="text-sm text-slate-600">Tinjau Masalah Keamanan dengan Memeriksa Perangkat dan Email yang Dikirim</p>
        </div>

        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            <div class="divide-y divide-neutral-200">
                <button type="button" class="w-full" onclick="window.location.href='{{ route('security.devices') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <h1>Perangkat tempat Anda login</h1>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full relative" onclick="window.location.href='{{ route('security.login-alerts') }}'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <h1>Pemberitahuan Login</h1>
                            <div class="flex items-center gap-2">
                                @php
                                    $unreadCount = app(\App\Services\LoginAlertService::class)->getUnreadCount(Auth::id());
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">{{ $unreadCount }}</span>
                                @endif
                                <img src="/assets/icons/ui/arrow/right-gray.svg">
                            </div>
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full" onclick="window.location.href='#'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <h1>Email Terbaru</h1>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
                <button type="button" class="w-full" onclick="window.location.href='#'">
                    <div class="px-6 py-3.5 hover:bg-neutral-50">
                        <div class="flex justify-between items-center gap-4">
                            <h1>Pemeriksaan Keamanan</h1>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </section>

@endsection
