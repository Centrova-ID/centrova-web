@extends('partials.layouts.settingsAccount')

{{-- Favicon --}}
<link rel="website icon" href="{{ asset('/assets/brand/favicon.svg') }}">

{{-- Title --}}
@section('title', 'Aktifkan Autentikasi 2 Faktor - Akun Centrova')

{{-- Intro --}}
@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.two-factor.index') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Aktifkan Autentikasi Dua Faktor</h1>
            <p class="text-base text-slate-600">Buat PIN 6 angka untuk mengamankan akun Anda</p>
        </div>
    </div>
@endpush

@section('section')
    <section>
        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-slate-800 mb-2">Buat PIN Autentikasi 2 Faktor</h3>
                    <p class="text-sm text-slate-600">
                        PIN ini akan digunakan setiap kali Anda login dari perangkat baru atau melakukan tindakan sensitif pada akun Anda.
                    </p>
                </div>

                <form method="POST" action="{{ route('security.two-factor.enable') }}" class="space-y-4">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            @foreach ($errors->all() as $error)
                                <p class="text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">PIN 6 Angka</label>
                        <input type="password" name="pin" maxlength="6" 
                               class="w-full px-3 py-3 ring-1 ring-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-center text-lg tracking-widest" 
                               placeholder="••••••" required>
                        <p class="text-xs text-slate-500 mt-1">Gunakan kombinasi angka yang mudah diingat tetapi sulit ditebak</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi PIN</label>
                        <input type="password" name="pin_confirmation" maxlength="6" 
                               class="w-full px-3 py-3 ring-1 ring-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-center text-lg tracking-widest" 
                               placeholder="••••••" required>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <a href="{{ route('security.two-factor.index') }}" class="flex-1 px-4 py-3 border border-slate-300 text-slate-700 rounded-full hover:bg-slate-50 text-center font-medium">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 px-4 py-3 bg-[#128AEB] text-white rounded-full hover:bg-[#0F76C6] font-medium">
                            Aktifkan Autentikasi 2 Faktor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
// Only allow numbers in PIN fields
document.addEventListener('DOMContentLoaded', function() {
    const pinInputs = document.querySelectorAll('input[name="pin"], input[name="pin_confirmation"]');
    pinInputs.forEach(input => {
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });
        
        // Auto move to next field when 6 digits entered
        input.addEventListener('input', function(e) {
            if (e.target.value.length === 6 && e.target.name === 'pin') {
                const confirmInput = document.querySelector('input[name="pin_confirmation"]');
                if (confirmInput) {
                    confirmInput.focus();
                }
            }
        });
    });
});
</script>
@endpush
