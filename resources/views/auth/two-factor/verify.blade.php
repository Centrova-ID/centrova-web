@extends('partials.layouts.auth')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{-- Header --}}
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800">Verifikasi Keamanan</h2>
            <p class="text-slate-600 mt-2">Masukkan PIN 6 angka untuk melanjutkan</p>
        </div>

        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('warning'))
            <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-yellow-700">{{ session('warning') }}</p>
            </div>
        @endif

        {{-- PIN Verification Form --}}
        <form method="POST" action="{{ route('two-factor.verify.post') }}" id="pinForm">
            @csrf
            
            <div class="mb-6">
                <label for="pin" class="block text-sm font-medium text-slate-700 mb-2">PIN 6 Angka</label>
                <div class="flex gap-2 justify-center">
                    <input type="password" 
                           name="pin" 
                           id="pin"
                           maxlength="6" 
                           class="w-full px-4 py-3 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('pin') border-red-500 @enderror" 
                           placeholder="••••••"
                           autocomplete="off"
                           required>
                </div>
                @error('pin')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trust Device Option (only show if allowed) --}}
            @if($twoFactorAuth->allowsDeviceTrust())
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="trust_device" value="1" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="ml-2 text-sm text-slate-600">Percayai perangkat ini selama 30 hari</span>
                </label>
                <p class="mt-1 text-xs text-slate-500">Anda tidak akan diminta PIN pada perangkat ini selama 30 hari ke depan</p>
            </div>
            @else
            <div class="mb-6 p-3 bg-orange-50 border border-orange-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <span class="text-sm text-orange-800">Mode keamanan maksimum aktif - verifikasi diperlukan setiap login</span>
                </div>
            </div>
            @endif

            {{-- Submit Button --}}
            <div class="mb-6">
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Verifikasi PIN
                </button>
            </div>
        </form>

        {{-- Recovery Option --}}
        <div class="text-center">
            <p class="text-sm text-slate-600 mb-3">Tidak dapat mengakses PIN Anda?</p>
            <button onclick="showRecoveryForm()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Gunakan Kode Pemulihan
            </button>
        </div>

        {{-- Recovery Code Form (Hidden by default) --}}
        <div id="recoveryForm" class="hidden mt-6 p-4 bg-slate-50 rounded-lg">
            <form method="POST" action="{{ route('two-factor.recovery') }}">
                @csrf
                <div class="mb-4">
                    <label for="recovery_code" class="block text-sm font-medium text-slate-700 mb-2">Kode Pemulihan</label>
                    <input type="text" 
                           name="recovery_code" 
                           id="recovery_code"
                           maxlength="8" 
                           class="w-full px-3 py-2 text-center font-mono border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('recovery_code') border-red-500 @enderror" 
                           placeholder="Masukkan kode 8 karakter"
                           autocomplete="off">
                    @error('recovery_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-2">
                    <button type="button" onclick="hideRecoveryForm()" class="flex-1 px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Gunakan Kode
                    </button>
                </div>
            </form>
        </div>

        {{-- Back to Login --}}
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-800 text-sm">
                ← Kembali ke Login
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Only allow numbers in PIN input
document.getElementById('pin').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/[^0-9]/g, '');
});

// Auto-submit when PIN is complete
document.getElementById('pin').addEventListener('input', function(e) {
    if (e.target.value.length === 6) {
        // Add small delay for better UX
        setTimeout(() => {
            document.getElementById('pinForm').submit();
        }, 200);
    }
});

// Only allow alphanumeric for recovery code
document.getElementById('recovery_code').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();
});

function showRecoveryForm() {
    document.getElementById('recoveryForm').classList.remove('hidden');
}

function hideRecoveryForm() {
    document.getElementById('recoveryForm').classList.add('hidden');
    document.getElementById('recovery_code').value = '';
}

// Focus on PIN input when page loads
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('pin').focus();
});
</script>
@endpush
