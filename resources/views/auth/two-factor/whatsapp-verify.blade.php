@extends('partials.layouts.auth')

@push('title')
    Verifikasi WhatsApp 2FA - Centrova
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#128AEB] to-[#0F76C6] flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8">
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-gradient-to-r from-[#128AEB] to-[#0F76C6] rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-800 mb-2">Verifikasi WhatsApp</h1>
            <p class="text-slate-600">Masukkan kode OTP yang dikirim ke WhatsApp Anda</p>
        </div>

        {{-- OTP Form --}}
        <form method="POST" action="{{ route('two-factor.whatsapp.verify') }}" id="otpForm" class="space-y-6">
            @csrf
            
            {{-- Phone Display --}}
            @if(session('2fa_user_id'))
                @php
                    $user = \App\Models\User::find(session('2fa_user_id'));
                    $maskedPhone = $user && $user->phone ? 
                        substr($user->phone, 0, 3) . 'xxxx' . substr($user->phone, -4) : 
                        'Nomor tidak tersedia';
                @endphp
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                    <p class="text-sm text-blue-800">
                        <span class="font-medium">Kode OTP dikirim ke:</span><br>
                        {{ $maskedPhone }}
                    </p>
                </div>
            @endif

            {{-- OTP Input --}}
            <div>
                <label for="otp_code" class="block text-sm font-medium text-gray-700 mb-2">Kode OTP</label>
                <input type="text" 
                       id="otp_code" 
                       name="otp_code" 
                       maxlength="6" 
                       placeholder="123456"
                       class="w-full px-4 py-3 text-center text-2xl font-mono border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent tracking-widest
                              {{ $errors->has('otp_code') ? 'border-red-300 bg-red-50' : 'border-gray-300' }}"
                       autofocus
                       autocomplete="one-time-code">
                @error('otp_code')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trust Device (only show if allowed) --}}
            @if($twoFactorAuth->allowsDeviceTrust())
            <div class="flex items-center">
                <input type="checkbox" 
                       id="trust_device" 
                       name="trust_device" 
                       value="1"
                       class="w-4 h-4 text-[#128AEB] bg-gray-100 border-gray-300 rounded focus:ring-[#128AEB] focus:ring-2">
                <label for="trust_device" class="ml-2 block text-sm text-gray-700">
                    Percayai perangkat ini selama 30 hari
                </label>
            </div>
            @else
            <div class="p-3 bg-orange-50 border border-orange-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <span class="text-sm text-orange-800">Mode keamanan maksimum aktif - verifikasi diperlukan setiap login</span>
                </div>
            </div>
            @endif

            {{-- Submit Button --}}
            <button type="submit" 
                    class="w-full bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium py-3 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Verifikasi Kode OTP
            </button>
        </form>

        {{-- Actions --}}
        <div class="mt-6 space-y-3">
            {{-- Send OTP Button --}}
            <button type="button" 
                    id="sendOtpBtn"
                    onclick="sendOtp()"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <span id="sendOtpText">Kirim Kode OTP</span>
            </button>

            {{-- Resend OTP Button (Initially Hidden) --}}
            <button type="button" 
                    id="resendOtpBtn"
                    onclick="resendOtp()"
                    style="display: none;"
                    class="w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span id="resendOtpText">Kirim Ulang Kode OTP</span>
            </button>
        </div>

        {{-- Alternative Methods --}}
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="text-center space-y-3">
                <p class="text-sm text-gray-600">Pilihan lain:</p>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('two-factor.verify') }}" 
                       class="text-[#128AEB] hover:text-[#0F76C6] text-sm font-medium flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-3.586l4.293-4.293A6 6 0 0115 7z"></path>
                        </svg>
                        Gunakan PIN 2FA
                    </a>
                    <a href="{{ route('login') }}" 
                       class="text-gray-600 hover:text-gray-800 text-sm">
                        ← Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Loading Overlay --}}
<div id="loadingOverlay" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 flex items-center gap-3">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#128AEB]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-gray-700">Mengirim kode OTP...</span>
    </div>
</div>
@endsection

@push('scripts')
<script>
let cooldownTimer = null;
let countdownInterval = null;

// Only allow numbers in OTP input
document.getElementById('otp_code').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/[^0-9]/g, '');
});

// Auto-submit when OTP is complete
document.getElementById('otp_code').addEventListener('input', function(e) {
    if (e.target.value.length === 6) {
        // Add small delay for better UX
        setTimeout(() => {
            document.getElementById('otpForm').submit();
        }, 200);
    }
});

// Send OTP function
async function sendOtp() {
    const sendBtn = document.getElementById('sendOtpBtn');
    const loadingOverlay = document.getElementById('loadingOverlay');
    
    // Show loading
    loadingOverlay.style.display = 'flex';
    sendBtn.disabled = true;
    
    try {
        const response = await fetch('{{ route("two-factor.whatsapp.send-otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showNotification(data.message, 'success');
            startCooldown();
            showResendButton();
        } else {
            showNotification(data.message, 'error');
            if (data.wait_time) {
                startCooldown(data.wait_time);
            }
        }
    } catch (error) {
        showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
    } finally {
        loadingOverlay.style.display = 'none';
        sendBtn.disabled = false;
    }
}

// Resend OTP function
async function resendOtp() {
    const resendBtn = document.getElementById('resendOtpBtn');
    const loadingOverlay = document.getElementById('loadingOverlay');
    
    // Show loading
    loadingOverlay.style.display = 'flex';
    resendBtn.disabled = true;
    
    try {
        const response = await fetch('{{ route("two-factor.whatsapp.resend-otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showNotification(data.message, 'success');
            startCooldown();
        } else {
            showNotification(data.message, 'error');
            if (data.wait_time) {
                startCooldown(data.wait_time);
            }
        }
    } catch (error) {
        showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
    } finally {
        loadingOverlay.style.display = 'none';
        resendBtn.disabled = false;
    }
}

// Start cooldown timer
function startCooldown(seconds = 60) {
    const sendBtn = document.getElementById('sendOtpBtn');
    const resendBtn = document.getElementById('resendOtpBtn');
    const sendText = document.getElementById('sendOtpText');
    const resendText = document.getElementById('resendOtpText');
    
    let timeLeft = seconds;
    
    // Clear existing intervals
    if (countdownInterval) {
        clearInterval(countdownInterval);
    }
    
    // Disable buttons and start countdown
    sendBtn.disabled = true;
    resendBtn.disabled = true;
    
    countdownInterval = setInterval(() => {
        sendText.textContent = `Tunggu ${timeLeft}s`;
        resendText.textContent = `Tunggu ${timeLeft}s`;
        
        timeLeft--;
        
        if (timeLeft < 0) {
            clearInterval(countdownInterval);
            sendBtn.disabled = false;
            resendBtn.disabled = false;
            sendText.textContent = 'Kirim Kode OTP';
            resendText.textContent = 'Kirim Ulang Kode OTP';
        }
    }, 1000);
}

// Show resend button after initial send
function showResendButton() {
    document.getElementById('sendOtpBtn').style.display = 'none';
    document.getElementById('resendOtpBtn').style.display = 'flex';
}

// Show notification
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification fixed top-4 right-4 z-50 max-w-sm p-4 rounded-lg shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' :
        type === 'error' ? 'bg-red-500 text-white' :
        'bg-blue-500 text-white'
    }`;
    
    notification.innerHTML = `
        <div class="flex items-center gap-3">
            <div class="flex-shrink-0">
                ${type === 'success' ? 
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' :
                type === 'error' ?
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' :
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                }
            </div>
            <div class="flex-1 text-sm">${message}</div>
            <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 ml-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Add CSRF token to meta tag if not exists
if (!document.querySelector('meta[name="csrf-token"]')) {
    const meta = document.createElement('meta');
    meta.name = 'csrf-token';
    meta.content = '{{ csrf_token() }}';
    document.getElementsByTagName('head')[0].appendChild(meta);
}
</script>
@endpush
