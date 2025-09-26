{{-- Password Section --}}
<div id="password-section" class="profile-section bg-white rounded-2xl border border-neutral-200 py-4 px-6">
    {{-- View Mode --}}
    <div id="password-view">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-medium text-slate-900">Ganti Password</h3>
            <button onclick="toggleEditMode('password')" class="text-[#128AEB] text-base font-medium">
                Edit
            </button>
        </div>
        
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                <div class="relative">
                    <div class="w-full pl-10 pr-3 py-2 bg-gray-50 rounded-md border border-gray-200">
                        <p class="text-gray-900">••••••••••••••••</p>
                    </div>
                    <div class="absolute left-3 top-2.5">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h4 class="text-sm font-medium text-green-800">Password Status</h4>
                </div>
                <p class="text-sm text-green-700">
                    Password Anda saat ini aman. Klik tombol "Edit" untuk mengubah password.
                </p>
            </div>
        </div>
    </div>

    {{-- Edit Mode (Hidden by default) --}}
    <div id="password-edit" class="hidden">
        <h3 class="text-xl font-medium text-slate-900 mb-6">Ganti Password</h3>
        
        <div class="mb-4 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <h4 class="text-sm font-medium text-yellow-800">Tips Keamanan Password</h4>
            </div>
            <ul class="text-sm text-yellow-700 space-y-1">
                <li>• Gunakan minimal 8 karakter</li>
                <li>• Kombinasi huruf besar, huruf kecil, angka, dan simbol</li>
                <li>• Jangan gunakan informasi pribadi yang mudah ditebak</li>
                <li>• Gunakan password yang unik dan tidak digunakan di tempat lain</li>
            </ul>
        </div>
        
        <form action="{{ route('profile.update-password') }}" method="POST" class="space-y-6">
        <form action="{{ route('profile.update-password') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                <div class="relative">
                    <input type="password" id="current_password" name="current_password" 
                           placeholder="Masukkan password saat ini"
                           class="w-full pl-10 pr-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                  {{ $errors->has('current_password') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                    <div class="absolute left-3 top-2.5">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600" onclick="togglePassword('current_password')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('current_password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                <div class="relative">
                    <input type="password" id="password" name="password" 
                           placeholder="Masukkan password baru"
                           class="w-full pl-10 pr-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                  {{ $errors->has('password') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                    <div class="absolute left-3 top-2.5">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600" onclick="togglePassword('password')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                
                {{-- Password Strength Indicator --}}
                <div class="mt-2">
                    <div class="flex items-center gap-2">
                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                            <div id="passwordStrength" class="h-2 rounded-full transition-all duration-300 bg-red-500" style="width: 0%"></div>
                        </div>
                        <span id="passwordStrengthText" class="text-sm text-gray-500">Lemah</span>
                    </div>
                </div>
                
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           placeholder="Ulangi password baru"
                           class="w-full pl-10 pr-10 py-2 border rounded-md focus:outline-none focus:ring-2 focus:border-transparent
                                  {{ $errors->has('password_confirmation') ? 'border-red-300 bg-red-50 focus:ring-red-500' : 'border-gray-300 focus:ring-[#128AEB]' }}">
                    <div class="absolute left-3 top-2.5">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600" onclick="togglePassword('password_confirmation')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Requirements Checklist --}}
            <div class="p-4 bg-gray-50 rounded-lg">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Persyaratan Password:</h4>
                <div class="space-y-1 text-sm">
                    <div id="req-length" class="flex items-center gap-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Minimal 8 karakter</span>
                    </div>
                    <div id="req-uppercase" class="flex items-center gap-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Mengandung huruf besar</span>
                    </div>
                    <div id="req-lowercase" class="flex items-center gap-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Mengandung huruf kecil</span>
                    </div>
                    <div id="req-number" class="flex items-center gap-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Mengandung angka</span>
                    </div>
                    <div id="req-special" class="flex items-center gap-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Mengandung karakter khusus (!@#$%^&*)</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-2">
                <button type="button" onclick="toggleEditMode('password')" class="text-gray-700 hover:text-gray-900 font-medium px-6 py-2 rounded-full transition flex items-center gap-2 border border-gray-300 hover:border-gray-400">
                    Batal
                </button>
                <button type="submit" class="bg-[#128AEB] hover:bg-[#0F76C6] text-white font-medium px-6 py-2 rounded-full transition flex items-center gap-2">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
    field.setAttribute('type', type);
}

document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const strengthBar = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('passwordStrengthText');
    
    if (passwordField && strengthBar && strengthText) {
        passwordField.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            
            // Update strength bar
            strengthBar.style.width = strength.percentage + '%';
            strengthBar.className = `h-2 rounded-full transition-all duration-300 ${strength.color}`;
            strengthText.textContent = strength.text;
            
            // Update requirements checklist
            updateRequirements(password);
        });
    }
    
    function calculatePasswordStrength(password) {
        let score = 0;
        let checks = 0;
        
        if (password.length >= 8) { score += 20; checks++; }
        if (password.match(/[a-z]/)) { score += 20; checks++; }
        if (password.match(/[A-Z]/)) { score += 20; checks++; }
        if (password.match(/[0-9]/)) { score += 20; checks++; }
        if (password.match(/[^A-Za-z0-9]/)) { score += 20; checks++; }
        
        let strength = {
            percentage: score,
            color: 'bg-red-500',
            text: 'Sangat Lemah'
        };
        
        if (checks >= 2) {
            strength.color = 'bg-orange-500';
            strength.text = 'Lemah';
        }
        if (checks >= 3) {
            strength.color = 'bg-yellow-500';
            strength.text = 'Sedang';
        }
        if (checks >= 4) {
            strength.color = 'bg-blue-500';
            strength.text = 'Kuat';
        }
        if (checks >= 5) {
            strength.color = 'bg-green-500';
            strength.text = 'Sangat Kuat';
        }
        
        return strength;
    }
    
    function updateRequirements(password) {
        const requirements = [
            { id: 'req-length', check: password.length >= 8 },
            { id: 'req-uppercase', check: password.match(/[A-Z]/) },
            { id: 'req-lowercase', check: password.match(/[a-z]/) },
            { id: 'req-number', check: password.match(/[0-9]/) },
            { id: 'req-special', check: password.match(/[^A-Za-z0-9]/) }
        ];
        
        requirements.forEach(req => {
            const element = document.getElementById(req.id);
            if (element) {
                if (req.check) {
                    element.classList.remove('text-gray-500');
                    element.classList.add('text-green-600');
                    element.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>';
                } else {
                    element.classList.remove('text-green-600');
                    element.classList.add('text-gray-500');
                    element.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
                }
            }
        });
    }
});
</script>
