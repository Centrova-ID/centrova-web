@extends('partials.layouts.settingsAccount')

{{-- Favicon --}}
<link rel="website icon" href="{{ asset('/assets/brand/favicon.svg') }}">

{{-- Title --}}
@section('title', 'Nonaktifkan Autentikasi 2 Faktor - Akun Centrova')

{{-- Intro --}}
@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.two-factor.index') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Nonaktifkan Autentikasi Dua Faktor</h1>
            <p class="text-base text-slate-600">Masukkan PIN untuk menonaktifkan fitur keamanan ini</p>
        </div>
    </div>
@endpush

@section('section')
    <section>
        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            <div class="p-6">
                <div class="mb-6">
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <div>
                                <h3 class="text-amber-800 font-medium text-sm">Peringatan Keamanan</h3>
                                <p class="text-amber-700 text-sm mt-1">
                                    Menonaktifkan autentikasi 2 faktor akan mengurangi tingkat keamanan akun Anda. Pastikan Anda memiliki metode keamanan lain yang aktif.
                                </p>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-lg font-medium text-slate-800 mb-2">Konfirmasi Nonaktifkan 2FA</h3>
                    <p class="text-sm text-slate-600">
                        Masukkan PIN autentikasi 2 faktor Anda saat ini untuk mengonfirmasi bahwa Anda ingin menonaktifkan fitur ini.
                    </p>
                </div>

                <form method="POST" action="{{ route('security.two-factor.disable') }}" class="space-y-4">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            @foreach ($errors->all() as $error)
                                <p class="text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">PIN Saat Ini</label>
                        <input type="password" name="current_pin" maxlength="6" 
                               class="w-full px-3 py-3 ring-1 ring-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none text-center text-lg tracking-widest" 
                               placeholder="••••••" required>
                        <p class="text-xs text-slate-500 mt-1">Masukkan PIN 6 angka yang saat ini aktif</p>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <a href="{{ route('security.two-factor.index') }}" class="flex-1 px-4 py-3 border border-slate-300 text-slate-700 rounded-full hover:bg-slate-50 text-center font-medium">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 px-4 py-3 bg-red-600 text-white rounded-full hover:bg-red-700 font-medium">
                            Nonaktifkan 2FA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
// Only allow numbers in PIN field
document.addEventListener('DOMContentLoaded', function() {
    const pinInput = document.querySelector('input[name="current_pin"]');
    if (pinInput) {
        pinInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });
    }
});
</script>
@endpush
