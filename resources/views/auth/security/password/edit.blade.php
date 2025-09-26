@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.index') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Ganti Sandi</h1>
            <p class="text-base text-slate-600">Perbarui kata sandi akun Anda untuk menjaga keamanan</p>
        </div>
    </div>
@endpush

@section('section')

{{-- Password Change Form --}}
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-neutral-200 p-6">
        <form action="{{ route('security.password.update') }}" method="POST" id="passwordForm">
            @csrf
            @method('PUT')

            {{-- Current Password --}}
            <div class="mb-6">
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Sandi Saat Ini
                </label>
                <div class="relative">
                    <input type="password" 
                           id="current_password" 
                           name="current_password" 
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent border-gray-300 focus:ring-[#128AEB] @error('current_password') border-red-300 bg-red-50 focus:ring-red-500 @enderror"
                           placeholder="Masukkan sandi saat ini"
                           required>
                    <button type="button" 
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 cursor-pointer"
                            onclick="togglePassword('current_password')"
                            aria-label="Toggle password visibility">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Sandi Baru
                </label>
                <div class="relative">
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent border-gray-300 focus:ring-[#128AEB] @error('password') border-red-300 bg-red-50 focus:ring-red-500 @enderror"
                           placeholder="Masukkan sandi baru"
                           oninput="checkPasswordStrength(this.value)"
                           required>
                    <button type="button" 
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 cursor-pointer"
                            onclick="togglePassword('password')"
                            aria-label="Toggle password visibility">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>

                {{-- Password Strength Indicator --}}
                <div class="mt-3">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-sm text-gray-600">Kekuatan sandi:</span>
                        <span id="strength-text" class="text-sm font-medium text-gray-400">-</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="strength-bar" class="h-2 rounded-full transition-all duration-300 bg-gray-300" style="width: 0%"></div>
                    </div>
                </div>

                {{-- Password Requirements --}}
                <div class="mt-4 space-y-2">
                    <p class="text-sm font-medium text-gray-700">Persyaratan sandi:</p>
                    <div class="space-y-1">
                        <div class="flex items-center gap-2" id="req-length">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Minimal 8 karakter</span>
                        </div>
                        <div class="flex items-center gap-2" id="req-uppercase">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Huruf besar (A-Z)</span>
                        </div>
                        <div class="flex items-center gap-2" id="req-lowercase">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Huruf kecil (a-z)</span>
                        </div>
                        <div class="flex items-center gap-2" id="req-number">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Angka (0-9)</span>
                        </div>
                        <div class="flex items-center gap-2" id="req-symbol">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Simbol (!@#$%^&*)</span>
                        </div>
                    </div>
                </div>

                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Sandi Baru
                </label>
                <div class="relative">
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent border-gray-300 focus:ring-[#128AEB] @error('current_confirmation') border-red-300 bg-red-50 focus:ring-red-500 @enderror"
                           placeholder="Konfirmasi sandi baru"
                           oninput="checkPasswordMatch()"
                           required>
                    <button type="button" 
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 cursor-pointer"
                            onclick="togglePassword('password_confirmation')"
                            aria-label="Toggle password visibility">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <div id="password-match" class="mt-1 text-sm" style="display: none;"></div>
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Form Actions --}}
            <div class="flex justify-end gap-4 pt-2">
                <a href="{{ route('security.index') }}" 
                   class="text-gray-700 hover:text-gray-900 font-medium px-6 py-2 rounded-full transition flex items-center gap-2 border border-gray-300 hover:border-gray-400 cursor-pointer">
                    Batal
                </a>
                <button type="submit" 
                        id="submit-btn"
                        class="bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium px-6 py-2 rounded-full transition flex items-center gap-2 cursor-pointer"
                        disabled>
                    Perbarui Sandi
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    
    // Add event listener for password confirmation
    const confirmationInput = document.getElementById('password_confirmation');
    if (confirmationInput) {
        confirmationInput.addEventListener('input', checkPasswordMatch);
    }
    
    // Add event listener for current password
    const currentPasswordInput = document.getElementById('current_password');
    if (currentPasswordInput) {
        currentPasswordInput.addEventListener('input', updateSubmitButton);
    }
});

function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling;
    const icon = button.querySelector('svg');
    
    if (field.getAttribute('type') === 'password') {
        field.setAttribute('type', 'text');
        // Change icon to "hide" icon
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
        `;
    } else {
        field.setAttribute('type', 'password');
        // Change icon to "show" icon
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
    }
}

function checkPasswordStrength(password) {
    
    const requirements = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        symbol: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
    };


    // Update requirement indicators
    updateRequirement('req-length', requirements.length);
    updateRequirement('req-uppercase', requirements.uppercase);
    updateRequirement('req-lowercase', requirements.lowercase);
    updateRequirement('req-number', requirements.number);
    updateRequirement('req-symbol', requirements.symbol);

    // Calculate strength
    const metRequirements = Object.values(requirements).filter(Boolean).length;
    let strength = 0;
    let strengthText = '';
    let strengthColor = '';

    if (password.length === 0) {
        strength = 0;
        strengthText = '-';
        strengthColor = 'bg-gray-300';
    } else if (metRequirements < 3) {
        strength = 25;
        strengthText = 'Lemah';
        strengthColor = 'bg-red-500';
    } else if (metRequirements < 4) {
        strength = 50;
        strengthText = 'Sedang';
        strengthColor = 'bg-yellow-500';
    } else if (metRequirements < 5) {
        strength = 75;
        strengthText = 'Kuat';
        strengthColor = 'bg-blue-500';
    } else {
        strength = 100;
        strengthText = 'Sangat Kuat';
        strengthColor = 'bg-green-500';
    }


    // Update strength indicator
    const strengthBar = document.getElementById('strength-bar');
    const strengthTextEl = document.getElementById('strength-text');
    
    if (strengthBar && strengthTextEl) {
        strengthBar.style.width = strength + '%';
        strengthBar.className = `h-2 rounded-full transition-all duration-300 ${strengthColor}`;
        strengthTextEl.textContent = strengthText;
        strengthTextEl.className = `text-sm font-medium ${getTextColor(strengthColor)}`;
    }

    // Enable/disable submit button
    updateSubmitButton();
}

function updateRequirement(elementId, met) {
    const element = document.getElementById(elementId);
    if (!element) return;
    
    const icon = element.querySelector('svg');
    const text = element.querySelector('span');
    
    if (met) {
        icon.className = 'w-4 h-4 text-green-500';
        text.className = 'text-sm text-green-600';
    } else {
        icon.className = 'w-4 h-4 text-gray-400';
        text.className = 'text-sm text-gray-600';
    }
}

function getTextColor(bgColor) {
    const colorMap = {
        'bg-red-500': 'text-red-600',
        'bg-yellow-500': 'text-yellow-600',
        'bg-blue-500': 'text-blue-600',
        'bg-green-500': 'text-green-600',
        'bg-gray-300': 'text-gray-400'
    };
    return colorMap[bgColor] || 'text-gray-400';
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmation = document.getElementById('password_confirmation').value;
    const matchDiv = document.getElementById('password-match');
    
    
    if (confirmation.length > 0) {
        matchDiv.style.display = 'block';
        if (password === confirmation) {
            matchDiv.className = 'mt-1 text-sm text-green-600';
            matchDiv.textContent = '✓ Sandi cocok';
        } else {
            matchDiv.className = 'mt-1 text-sm text-red-600';
            matchDiv.textContent = '✗ Sandi tidak cocok';
        }
    } else {
        matchDiv.style.display = 'none';
    }
    
    updateSubmitButton();
}

function updateSubmitButton() {
    const currentPassword = document.getElementById('current_password').value;
    const password = document.getElementById('password').value;
    const confirmation = document.getElementById('password_confirmation').value;
    const submitBtn = document.getElementById('submit-btn');
    
    // Check if all requirements are met
    const requirements = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        symbol: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
    };
    
    const allRequirementsMet = Object.values(requirements).every(Boolean);
    const passwordsMatch = password === confirmation && confirmation.length > 0;
    const hasCurrentPassword = currentPassword.length > 0;
    
    const canSubmit = allRequirementsMet && passwordsMatch && hasCurrentPassword;
    
    submitBtn.disabled = !canSubmit;
}
</script>
@endpush
