@extends('partials.layouts.settingsAccount')

{{-- Favicon --}}
<link rel="website icon" href="{{ asset('/assets/brand/favicon.svg') }}">

{{-- Title --}}
@section('title', 'Autentikasi 2 Faktor - Akun Centrova')

{{-- Intro --}}
@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.index') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Autentikasi Dua Faktor</h1>
            <p class="text-base text-slate-600">Tingkatkan keamanan akun Anda dengan PIN 6 angka</p>
        </div>
    </div>
@endpush

@section('section')

    {{-- Status 2FA --}}
    <section class="max-w-xl space-y-3">
        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            @if($twoFactorAuth->is_enabled)
                {{-- 2FA is enabled --}}
                <div>
                    <div class="flex items-center gap-4 p-4 border-b border-neutral-200/80">
                        <div>
                            <h3 class="text-lg font-medium text-slate-800">Autentikasi Dua Faktor Aktif</h3>
                            <p class="text-sm text-slate-600">PIN dibuat pada {{ $twoFactorAuth->pin_created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    {{-- 2FA Settings --}}
                    <div class="divide-y divide-neutral-200/80">
                        {{-- WhatsApp 2FA Setting --}}
                        <a href="{{ route('security.two-factor.whatsapp.index') }}" class="flex cursor-pointer items-center text-left gap-6 hover:bg-neutral-100 px-4 py-2">
                            <div class="text-gray-900 w-full">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-gray-900 font-medium">Menggunakan WhatsApp</h2>
                                        <p class="text-gray-900 -mt-0.5">
                                            @if($twoFactorAuth->whatsapp_enabled && !empty(Auth::user()->phone))
                                                {{ substr(Auth::user()->phone, 0, 3) }}xxxx{{ substr(Auth::user()->phone, -4) }}
                                            @elseif(!empty(Auth::user()->phone))
                                                Tidak Aktif
                                            @else
                                                Tidak Tersedia
                                            @endif
                                        </p>
                                        @if($twoFactorAuth->whatsapp_enabled)
                                        <span class="text-base font-normal text-[#147b29] -mt-0.5">
                                            Aktif
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </a>
                    </div>

                    <div class="space-y-3 p-4 border-t border-neutral-200/80">
                        {{-- Disable 2FA --}}
                        <a href="{{ route('security.two-factor.disable.form') }}" class="w-full p-3 bg-transparent text-red-600 rounded-full font-medium hover:bg-neutral-100 border border-neutral-300 flex justify-center items-center relative">
                            Nonaktifkan Autentikasi Dua Faktor
                            <svg class="w-5 h-5 text-red-600 absolute right-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @else
                {{-- 2FA is not enabled --}}
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div>
                            <h3 class="text-lg font-medium text-slate-800">Autentikasi Dua Faktor Tidak Aktif</h3>
                            <p class="text-sm text-slate-600">
                                Cegah peretas mengakses akun Anda dengan menambah perlindungan ekstra, memastikan akun tetap aman meskipun kata sandi Anda diketahui pihak lain. <a href="#" class="text-blue-600 hover:underline">Pelajari lebih lanjut.</a>
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('security.two-factor.enable.form') }}" class="w-full p-3 bg-[#128AEB] text-white rounded-full font-medium hover:bg-[#0F76C6] transition-colors block text-center">
                        Aktifkan Autentikasi Dua Faktor
                    </a>
                </div>
            @endif
        </div>

        {{-- Advanced 2FA Settings --}}
        <div class="divide-y divide-neutral-200/80">
            {{-- Require 2FA Every Login --}}
            <div class="flex items-center gap-6 py-2">
                <div class="w-full">
                    <div class="flex items-center justify-between">
                        <div class="max-w-md">
                            <p class="text-sm text-gray-800">
                                {{ $twoFactorAuth->require_2fa_every_login 
                                    ? 'Setiap login memerlukan verifikasi 2FA untuk keamanan maksimum' 
                                    : 'Anda dapat mencentang "Percayai perangkat ini" saat login untuk melewati 2FA' }}
                            </p>
                        </div>
                        <form method="POST" action="{{ route('security.two-factor.toggle-device-trust') }}" class="inline pt-3.5">
                            @csrf
                            <label class="relative inline-flex justify-center items-center cursor-pointer">
                                <input type="checkbox" 
                                       onchange="if(confirm('{{ $twoFactorAuth->require_2fa_every_login ? 'Izinkan perangkat terpercaya untuk melewati 2FA?' : 'Hapus semua perangkat terpercaya dan wajibkan verifikasi setiap login?' }}')) { this.form.submit(); } else { this.checked = !this.checked; }"
                                       {{ $twoFactorAuth->require_2fa_every_login ? 'checked' : '' }} 
                                       class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#128AEB]"></div>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Trusted Devices --}}
    @if($twoFactorAuth->is_enabled && $trustedDevices->count() > 0)
    <section>
        <div class="mb-3">
            <h1 class="text-slate-800 text-lg font-medium mb-1 tracking-tight">Perangkat Terpercaya</h1>
            <p class="text-sm text-slate-600">Perangkat yang tidak memerlukan verifikasi PIN saat login</p>
        </div>

        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            <div class="divide-y divide-neutral-200">
                @foreach($trustedDevices as $device)
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="font-medium text-slate-800">{{ $device->device_name }}</h4>
                            <p class="text-sm text-slate-600">{{ $device->ip_address }} • Terakhir digunakan {{ $device->last_used_at->diffForHumans() }}</p>
                            <p class="text-xs text-slate-500">Berlaku hingga {{ $device->expires_at->format('d M Y') }}</p>
                        </div>
                        <form method="POST" action="{{ route('security.two-factor.device.revoke', $device->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus perangkat terpercaya ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection

@push('scripts')
<script>
// Only allow numbers in PIN fields if there are any remaining PIN inputs
document.addEventListener('DOMContentLoaded', function() {
    const pinInputs = document.querySelectorAll('input[name="pin"], input[name="pin_confirmation"], input[name="current_pin"]');
    pinInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });
    });
});
</script>
@endpush
