@extends('partials.layouts.auth')

@section('title', 'Masuk - Akun Centrova')

@section('content')
@php
    use App\Helpers\SecurityHelper;
    
    $mode = request('mode', 'login');
    $isConfirmPassword = $mode === 'confirm-password';
    $isAddDifferentAccount = $mode === 'add-different-account';
    $is2FAVerification = $mode === '2fa-verify';
    $is2FAWhatsApp = $mode === '2fa-whatsapp';
    $isLocked = $mode === 'locked';
    
    // Check if there are any suspension-related errors
    $hasSuspensionError = false;
    if ($errors->any()) {
        foreach ($errors->all() as $error) {
            if (strpos(strtolower($error), 'suspend') !== false || 
                strpos(strtolower($error), 'disuspend') !== false || 
                strpos(strtolower($error), 'tangguh') !== false || 
                strpos(strtolower($error), 'nonaktif') !== false) {
                $hasSuspensionError = true;
                break;
            }
        }
    }
    
    // Check if account is suspended from various sources
    $isSuspended = $mode === 'suspended' || 
                   $hasSuspensionError ||
                   session('account_suspended') || 
                   request()->has('suspended') ||
                   request('suspended') == '1' ||
                   request('account_status') === 'suspended' ||
                   (auth()->check() && method_exists(auth()->user(), 'isSuspended') && auth()->user()->isSuspended()) ||
                   (auth()->check() && isset(auth()->user()->status) && auth()->user()->status === 'suspended');
    
    // Sanitize redirect parameter untuk mencegah open redirect attacks
    $redirectAfter = '';
    if (request('redirect')) {
        $redirect = request('redirect');
        // Hanya izinkan internal paths (dimulai dengan /)
        if (is_string($redirect) && str_starts_with($redirect, '/') && !str_starts_with($redirect, '//')) {
            $redirectAfter = $redirect;
        }
    }
    $isStaffLogin = isset($isStaffLogin) && $isStaffLogin;
    
    // Get 2FA user data if in 2FA mode
    $twoFactorUser = null;
    $twoFactorAuth = null;
    if (($is2FAVerification || $is2FAWhatsApp) && session('2fa_user_id')) {
        $twoFactorUser = \App\Models\User::find(session('2fa_user_id'));
        $twoFactorAuth = $twoFactorUser ? $twoFactorUser->twoFactorAuth : null;
    }
    
    // Get masked email for locked mode
    $maskedEmail = '';
    if ($isLocked && session('locked_identifier')) {
        $maskedEmail = SecurityHelper::maskEmail(session('locked_identifier'));
    }
@endphp

<div class="min-h-screen flex flex-col items-center justify-center max-sm:justify-between pt-8 pb-4 sm:px-8 z-10">
    <div class="sm:max-w-md w-full max-sm:min-h-screen relative flex justify-center items-start">
        <div class="bg-white sm:rounded-3xl sm:border px-6 sm:p-10 w-full">
            {{-- Header --}}
            <div class="text-center mb-6 flex flex-col justify-center items-center">
                @if($isLocked)
                    <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-4">
                    <h2 class="text-xl font-semibold text-slate-800">Akses Dibatasi Sementara</h2>
                    @if($maskedEmail)
                        <span class="my-4 text-slate-600 font-mono">{{ $maskedEmail }}</span>
                    @endif
                    <p class="text-slate-800 text-base mt-2 max-w-md text-center">
                        Kami mendeteksi terlalu banyak percobaan login yang gagal ke akun Anda. 
                        Untuk menjaga keamanan, akun Anda saat ini terkunci. Silakan coba lagi nanti atau lakukan reset kata sandi jika diperlukan.
                    </p>
                @elseif($isSuspended)
                    <h2 class="text-xl font-semibold text-slate-800 w-full text-left">Akun Anda ditangguhkan</h2>
                    <p class="text-slate-800 text-base mt-2 text-left max-w-md">Kami telah meninjau akun Anda dan menemukan bahwa akun ini tidak dapat digunakan sementara waktu karena terdeteksi adanya aktivitas yang melanggar ketentuan penggunaan atau berisiko terhadap keamanan akun.</p>
                @elseif($is2FAVerification)
                    <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-3">
                    <h2 class="text-xl font-semibold text-slate-800">Verifikasi Keamanan</h2>
                    <p class="text-slate-600 text-sm mt-2">Masukkan PIN 6 angka untuk melanjutkan</p>
                    @if($twoFactorUser)
                        <div class="bg-neutral-50 p-4 rounded-lg mt-4 ring-1 ring-neutral-100 w-full">
                            <div class="flex items-center space-x-3">
                                @if($twoFactorUser->profile_picture)
                                    <img src="{{ $twoFactorUser->profile_picture }}" alt="Profile" class="w-10 h-10 rounded-full">
                                @else
                                    <div class="w-10 h-10 bg-slate-300 rounded-full flex items-center justify-center">
                                        <span class="text-slate-600 font-medium">{{ substr($twoFactorUser->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-slate-800 text-left">{{ $twoFactorUser->name }}</p>
                                    <p class="text-sm text-slate-600">{{ $twoFactorUser->email }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @elseif($is2FAWhatsApp)
                    <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-3">
                    <h2 class="text-xl font-semibold text-slate-800">Verifikasi WhatsApp</h2>
                    <p class="text-slate-600 text-sm mt-2">Masukkan kode OTP 6 angka dari WhatsApp</p>
                    @if($twoFactorUser)
                        <div class="text-center mt-4 w-full">
                            <p class="text-sm text-slate-800">
                                <span class="font-medium">Kode OTP dikirim ke:</span><br>
                                {{ $twoFactorUser->phone ? substr($twoFactorUser->phone, 0, 3) . 'xxxx' . substr($twoFactorUser->phone, -4) : 'Nomor tidak tersedia' }}
                            </p>
                        </div>
                    @endif
                @elseif($isStaffLogin)
                    <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-3">
                    <h2 class="text-xl font-semibold text-slate-800">Masuk ke Centrova Office</h2>
                    <p class="text-slate-600 text-sm mt-2">Akses khusus untuk staff dan admin</p>
                @elseif($isConfirmPassword)
                    <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-3">
                    <p class="text-slate-600 text-sm mt-2">Untuk melanjutkan, verifikasi diri Anda terlebih dahulu</p>
                @elseif($isAddDifferentAccount)
                    <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-3">
                    <h2 class="text-2xl font-semibold text-slate-800">Tambah Akun Baru</h2>
                    <p class="text-slate-600 mt-2">Masuk dengan akun lain untuk menambahkannya</p>
                @elseif(isset($isAddingAccount) && $isAddingAccount)
                    <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-3">
                    <h2 class="text-2xl font-semibold text-slate-800">Tambah Akun Baru</h2>
                    <p class="text-slate-600 mt-2">Masuk dengan akun lain untuk menambahkannya</p>
                @else
                    <img src="/assets/brand/centrova-logo.svg" class="h-[34px] mb-3">
                    <h2 class="text-xl font-semibold text-slate-800">Masuk dengan akun Centrova</h2>
                @endif
            </div>

            {{-- Form --}}
            @if($isSuspended)
                {{-- Suspension Information --}}
                <div class="flex flex-col gap-y-4">
                    <div class="text-left">
                        <p class="text-slate-800 text-base mb-4">Anda tidak dapat mengajukan peninjauan ulang untuk keputusan ini.</p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="space-y-3">
                        <a href="{{ route('account.download.data', ['email' => request('email'), 'username' => request('username')]) }}" class="w-full bg-[#128AEB] text-white py-2 px-4 rounded-full font-medium hover:bg-[#0f75c6] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center duration-100 gap-2">
                            Unduh Informasi Anda
                        </a>
                        
                        <p class="text-center text-sm">
                            <a href="{{ route('support.help.home') }}" target="_blank" rel="noopener noreferrer" class="font-medium text-[#128AEB] hover:underline">
                            Pelajari lebih lanjut
                            </a>
                        </p>
                    </div>
                </div>
            @elseif($isLocked)
                {{-- Lockout Information --}}
                <div class="flex flex-col">
                    <div class="text-center text-base text-slate-800">
                        <p>Untuk keamanan akun Anda, silakan tunggu sebelum mencoba lagi.</p>
                    </div>
                </div>
            @elseif($is2FAVerification)
                {{-- PIN 2FA Form --}}
                <form class="flex flex-col gap-y-4" action="{{ route(\App\Helpers\RouteHelper::getContextRoute('login.2fa.pin', 'account.fallback.login.2fa.pin')) }}" method="POST" id="pinForm">
                    @csrf
                    
                    @if ($errors->any())
                    <div class="bg-red-50 text-red-500 p-4 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">PIN 6 Angka</label>
                        <div class="flex gap-2 justify-center">
                            <input type="password" 
                                   name="pin_1" 
                                   id="pin_1"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 appearance-none outline-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('pin') border-red-500 @enderror" 
                                   autocomplete="off"
                                   autofocus
                                   required>
                            <input type="password" 
                                   name="pin_2" 
                                   id="pin_2"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 appearance-none outline-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('pin') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                            <input type="password" 
                                   name="pin_3" 
                                   id="pin_3"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 appearance-none outline-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('pin') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                            <input type="password" 
                                   name="pin_4" 
                                   id="pin_4"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 appearance-none outline-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('pin') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                            <input type="password" 
                                   name="pin_5" 
                                   id="pin_5"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 appearance-none outline-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('pin') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                            <input type="password" 
                                   name="pin_6" 
                                   id="pin_6"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 appearance-none outline-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('pin') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                        </div>
                        <input type="hidden" name="pin" id="pin_hidden">
                    </div>

                    {{-- Trust Device Option (only show if allowed) --}}
                    @if($twoFactorAuth && $twoFactorAuth->allowsDeviceTrust())
                    <div class="mt-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="trust_device" value="1" class="rounded border-slate-300 text-[#128AEB] shadow-sm focus:ring-[#128AEB]">
                            <span class="ml-2 text-sm text-slate-600">Percayai perangkat ini selama 30 hari</span>
                        </label>
                        <p class="mt-1 text-xs text-slate-500">Anda tidak akan diminta PIN pada perangkat ini selama 30 hari ke depan</p>
                    </div>
                    @endif
                </form>

                {{-- Recovery Option --}}
                <div class="text-center mt-4">
                    <button onclick="showRecoveryForm()" class="text-[#128AEB] hover:text-[#1378C9] text-sm font-medium">
                        Gunakan Kode Pemulihan
                    </button>
                </div>

                {{-- Recovery Code Form (Hidden by default) --}}
                <div id="recoveryForm" class="hidden mt-4 p-4 bg-neutral-50 rounded-xl">
                    <form method="POST" action="{{ route(\App\Helpers\RouteHelper::getContextRoute('login.2fa.recovery', 'account.fallback.login.2fa.recovery')) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="recovery_code" class="block text-sm font-medium text-slate-700 mb-2">Kode Pemulihan</label>
                            <input type="text" 
                                   name="recovery_code" 
                                   id="recovery_code"
                                   maxlength="8" 
                                   class="w-full px-3 py-2 text-center font-mono border border-slate-300 rounded-lg focus:ring-1 outline-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('recovery_code') border-red-500 @enderror" 
                                   placeholder="Masukkan kode 8 karakter"
                                   autocomplete="off">
                            @error('recovery_code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex gap-2">
                            <button type="button" onclick="hideRecoveryForm()" class="flex-1 px-4 py-2 border border-slate-300 text-slate-700 rounded-full hover:bg-slate-50">
                                Batal
                            </button>
                            <button type="submit" class="flex-1 px-4 py-2 bg-[#128AEB] text-white rounded-full hover:bg-[#1378C9]">
                                Gunakan Kode
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Method Switch Options --}}
                @if($twoFactorAuth && $twoFactorAuth->whatsapp_enabled && $twoFactorUser && $twoFactorUser->phone)
                    <div class="text-center mt-4 space-y-2">
                        <a href="?mode=2fa-whatsapp" 
                           class="text-[#128AEB] hover:text-[#1378C9] text-sm font-medium flex items-center justify-center gap-1">
                            Gunakan WhatsApp
                        </a>
                    </div>
                @endif
            @elseif($is2FAWhatsApp)
                {{-- WhatsApp 2FA Form --}}
                <form class="flex flex-col gap-y-4" action="{{ route(\App\Helpers\RouteHelper::getContextRoute('login.2fa.whatsapp', 'account.fallback.login.2fa.whatsapp')) }}" method="POST" id="otpForm">
                    @csrf
                    
                    @if ($errors->any())
                    <div class="bg-red-50 text-red-500 p-4 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    {{-- OTP Input --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Kode OTP 6 Angka</label>
                        <div class="flex gap-2 justify-center">
                            <input type="text" 
                                   name="otp_1" 
                                   id="otp_1"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 outline-none appearance-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('otp_code') border-red-500 @enderror" 
                                   autocomplete="off"
                                   autofocus
                                   required>
                            <input type="text" 
                                   name="otp_2" 
                                   id="otp_2"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 outline-none appearance-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('otp_code') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                            <input type="text" 
                                   name="otp_3" 
                                   id="otp_3"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 outline-none appearance-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('otp_code') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                            <input type="text" 
                                   name="otp_4" 
                                   id="otp_4"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 outline-none appearance-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('otp_code') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                            <input type="text" 
                                   name="otp_5" 
                                   id="otp_5"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 outline-none appearance-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('otp_code') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                            <input type="text" 
                                   name="otp_6" 
                                   id="otp_6"
                                   maxlength="1" 
                                   class="w-full h-12 text-center text-lg font-mono border border-slate-300 rounded-lg focus:ring-1 outline-none appearance-none focus:ring-[#128AEB] focus:border-[#128AEB] @error('otp_code') border-red-500 @enderror" 
                                   autocomplete="off"
                                   required>
                        </div>
                        <input type="hidden" name="otp_code" id="otp_hidden">
                    </div>

                    {{-- Trust Device Option (only show if allowed) --}}
                    @if($twoFactorAuth && $twoFactorAuth->allowsDeviceTrust())
                    <div class="mt-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="trust_device" value="1" class="rounded border-slate-300 text-[#128AEB] shadow-sm focus:ring-[#128AEB]">
                            <span class="ml-2 text-sm text-slate-600">Percayai perangkat ini selama 30 hari</span>
                        </label>
                        <p class="mt-1 text-xs text-slate-500">Anda tidak akan diminta OTP pada perangkat ini selama 30 hari ke depan</p>
                    </div>
                    @endif
                </form>

                {{-- Resend OTP --}}
                <div class="text-center mt-4">
                    <button id="resendOtpBtn" onclick="resendOtp()" class="text-[#128AEB] hover:text-[#1378C9] text-sm font-medium disabled:text-gray-400 disabled:cursor-not-allowed">
                        <span id="resendText">Kirim Ulang OTP</span>
                        <span id="resendCountdown" class="hidden"></span>
                    </button>
                </div>

                {{-- Method Switch Options --}}
                <div class="text-center mt-4 space-y-2">
                    <a href="?mode=2fa-verify" 
                       class="text-[#128AEB] hover:text-[#1378C9] text-sm font-medium flex items-center justify-center gap-1">
                        Gunakan PIN 2FA
                    </a>
                </div>
            @else
            <form class="flex flex-col gap-y-4" action="@if($isStaffLogin){{ route('staff.login.submit') }}@else{{ route(\App\Helpers\RouteHelper::getContextRoute('login.post', 'account.fallback.login.post')) }}@endif" method="POST">
                @csrf

                @if($isAddDifferentAccount)
                    <input type="hidden" name="mode" value="add-different-account">
                @elseif(isset($isAddingAccount) && $isAddingAccount)
                    <input type="hidden" name="add_account" value="1">
                @endif

                @if($isConfirmPassword)
                    <input type="hidden" name="mode" value="confirm-password">
                    @if($redirectAfter)
                        <input type="hidden" name="redirect" value="{{ $redirectAfter }}">
                    @endif
                @endif

                @if ($errors->any() && !$isSuspended)
                <div class="bg-red-50 text-red-500 p-4 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                @if(!$isConfirmPassword)
                    <div>
                        <label for="login" class="block text-sm font-medium text-slate-700 mb-2">
                            @if($isStaffLogin)
                                Email Staff
                            @else
                                Nama Pengguna atau Email
                            @endif
                        </label>
                        <input id="login" name="{{ $isStaffLogin ? 'email' : 'login' }}" type="{{ $isStaffLogin ? 'email' : 'text' }}" required autocomplete="{{ $isStaffLogin ? 'email' : 'username' }}" autofocus
                               class="w-full px-3 py-2 ring-1 ring-neutral-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] outline-none"
                               placeholder="{{ $isStaffLogin ? 'Masukan email staff' : 'Masukan nama pengguna atau email' }}">
                    </div>
                @else
                    {{-- Show current user info for password confirmation --}}
                    @auth
                        <div class="bg-neutral-50 p-4 rounded-lg mb-2 ring-1 ring-neutral-100">
                            <div class="flex items-center space-x-3 text-left">
                                @if(auth()->user()->profile_picture)
                                    <img src="{{ auth()->user()->profile_picture }}" alt="Profile" class="w-10 h-10 rounded-full">
                                @else
                                    <div class="w-10 h-10 bg-slate-300 rounded-full flex items-center justify-center">
                                        <span class="text-slate-600 font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-slate-800 w-full text-left">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-slate-600">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    @endauth
                @endif

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Kata Sandi</label>
                    <input id="password" name="password" type="password" required {{ $isConfirmPassword ? 'autofocus' : '' }}
                           autocomplete="{{ $isConfirmPassword ? 'current-password' : 'current-password' }}"
                           class="w-full px-3 py-2 ring-1 ring-neutral-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] outline-none"
                           placeholder="Masukan kata sandi">
                </div>

                @if($isStaffLogin)
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" 
                           class="h-4 w-4 text-[#128AEB] focus:ring-[#128AEB] border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-slate-600">
                        Ingat saya
                    </label>
                </div>
                @endif

                <div class="hidden">
                    <a href="#" class="text-sm font-medium text-[#128AEB] hover:underline">Forgot password?</a>
                </div>

                <button type="submit" 
                        class="w-full bg-[#128AEB] text-white py-2 px-4 rounded-full font-medium hover:bg-[#1378C9] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-3">
                    @if($isStaffLogin)
                        Masuk ke Office
                    @elseif($isConfirmPassword)
                        Konfirmasi
                    @elseif($isAddDifferentAccount)
                        Tambah Akun
                    @elseif(isset($isAddingAccount) && $isAddingAccount)
                        Tambah Akun
                    @else
                        Berikutnya
                    @endif
                </button>
            </form>
            @endif

            {{-- Footer --}}
            <div class="text-center">
                @if($isSuspended)
                    {{-- No additional footer for suspended accounts --}}
                @elseif($isLocked)
                    {{-- No additional footer for locked accounts --}}
                @elseif($is2FAVerification || $is2FAWhatsApp)
                    {{-- No additional footer for 2FA modes --}}
                @elseif($isStaffLogin)
                    <div class="mt-6 space-y-2">
                        <p class="text-sm text-slate-600">
                            <a href="{{ route('staff.password.request') }}" class="font-medium text-[#128AEB] hover:underline">Lupa kata sandi?</a>
                        </p>
                        <p class="text-sm text-slate-600">
                            Bukan staff? 
                            <a href="{{ route(\App\Helpers\RouteHelper::getContextRoute('login', 'account.fallback.login')) }}" class="font-medium text-[#128AEB] hover:underline">Login sebagai pengguna biasa</a>
                        </p>
                    </div>
                @elseif($isConfirmPassword)
                    <p class="text-xs text-slate-500 mt-6 hidden">
                        Konfirmasi ini berlaku selama 1 menit untuk keamanan akun Anda
                    </p>
                @elseif($isAddDifferentAccount)
                    <p class="text-sm text-slate-600 mt-6">
                        <a href="{{ route(\App\Helpers\RouteHelper::getAccountRoute()) }}" class="font-medium text-[#128AEB] hover:underline">Kembali ke Dashboard</a>
                    </p>
                @elseif(isset($isAddingAccount) && $isAddingAccount)
                    <p class="text-sm text-slate-600 mt-6">
                        <a href="{{ isset($returnUrl) ? $returnUrl : route(\App\Helpers\RouteHelper::getAccountRoute()) }}" class="font-medium text-[#128AEB] hover:underline">Kembali ke Dashboard</a>
                    </p>
                @else
                    <p class="text-sm text-slate-600 mt-6">
                        Belum punya akun Centrova? 
                        <a href="{{ route(\App\Helpers\RouteHelper::getRegisterRoute()) }}" class="text-[#128AEB] hover:underline">Buat sekarang!</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
    <div class="flex flex-col justify-center items-center mt-2 gap-x-2 w-full">
        <span class="text-neutral-600 text-xs hidden">© Centrova 2025. Hak Cipta Dilindungi oleh undang-undang.</span>
        <div>
            <a href="{{ route('legal.privacy') }}" target="_blank" rel="noopener noreferrer" class="text-neutral-600 px-2 py-1 rounded-md hover:bg-neutral-500/10 text-xs">Privasi</a>
            <a href="{{ route('legal.terms') }}" target="_blank" rel="noopener noreferrer" class="text-neutral-600 px-2 py-1 rounded-md hover:bg-neutral-500/10 text-xs">Persyaratan</a>
            <a href="{{ route('support.help.home') }}" target="_blank" rel="noopener noreferrer" class="text-neutral-600 px-2 py-1 rounded-md hover:bg-neutral-500/10 text-xs">Bantuan</a>
        </div>
    </div>
</div>

@if($is2FAVerification || $is2FAWhatsApp)
@push('scripts')
    <script nonce="{{ request()->attributes->get('csp_nonce') }}">
        // Security: Prevent common attacks
        (function() {
            'use strict';
            
            // Prevent form manipulation
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                // Store original action to detect tampering
                const originalAction = form.action;
                
                form.addEventListener('submit', function(e) {
                    // Basic integrity check
                    if (this.action !== originalAction) {
                        console.warn('Form action has been modified');
                        e.preventDefault();
                        return false;
                    }
                    
                    // Rate limiting client-side (additional to server-side)
                    const submitKey = 'last_submit_' + this.id;
                    const lastSubmit = sessionStorage.getItem(submitKey);
                    const now = Date.now();
                    
                    if (lastSubmit && (now - parseInt(lastSubmit)) < 1000) {
                        e.preventDefault();
                        return false;
                    }
                    
                    sessionStorage.setItem(submitKey, now.toString());
                });
            });
            
            // Clear sensitive data on page unload
            window.addEventListener('beforeunload', function() {
                // Clear any sensitive input values
                const sensitiveInputs = document.querySelectorAll('input[type="password"], input[name*="pin"], input[name*="otp"], input[name*="recovery"]');
                sensitiveInputs.forEach(input => {
                    input.value = '';
                });
            });
        })();

        document.addEventListener('DOMContentLoaded', function() {
            @if($is2FAVerification)
            // PIN 2FA Scripts
            const pinInputs = [
                document.getElementById('pin_1'),
                document.getElementById('pin_2'),
                document.getElementById('pin_3'),
                document.getElementById('pin_4'),
                document.getElementById('pin_5'),
                document.getElementById('pin_6')
            ];
            const pinForm = document.getElementById('pinForm');
            const pinHidden = document.getElementById('pin_hidden');
            
            // Setup PIN inputs
            pinInputs.forEach((input, index) => {
                // Only allow numbers
                input.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');
                    
                    if (e.target.value.length === 1) {
                        // Move to next input
                        if (index < pinInputs.length - 1) {
                            pinInputs[index + 1].focus();
                        }
                        
                        // Check if all inputs are filled
                        updatePinHidden();
                        if (getAllPinValues().length === 6) {
                            setTimeout(() => {
                                pinForm.submit();
                            }, 100);
                        }
                    }
                });
                
                // Handle backspace
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && e.target.value === '') {
                        if (index > 0) {
                            pinInputs[index - 1].focus();
                        }
                    }
                });
                
                // Handle paste
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const paste = (e.clipboardData || window.clipboardData).getData('text');
                    const numbers = paste.replace(/[^0-9]/g, '').slice(0, 6);
                    
                    for (let i = 0; i < numbers.length && i < 6; i++) {
                        pinInputs[i].value = numbers[i];
                    }
                    
                    updatePinHidden();
                    if (numbers.length === 6) {
                        setTimeout(() => {
                            pinForm.submit();
                        }, 100);
                    } else if (numbers.length > 0) {
                        const nextIndex = Math.min(numbers.length, 5);
                        pinInputs[nextIndex].focus();
                    }
                });
            });
            
            function getAllPinValues() {
                return pinInputs.map(input => input.value).join('');
            }
            
            function updatePinHidden() {
                pinHidden.value = getAllPinValues();
            }
            
            // Focus on first PIN input
            pinInputs[0].focus();
            
            @elseif($is2FAWhatsApp)
            // WhatsApp OTP Scripts
            const otpInputs = [
                document.getElementById('otp_1'),
                document.getElementById('otp_2'),
                document.getElementById('otp_3'),
                document.getElementById('otp_4'),
                document.getElementById('otp_5'),
                document.getElementById('otp_6')
            ];
            const otpForm = document.getElementById('otpForm');
            const otpHidden = document.getElementById('otp_hidden');
            const resendBtn = document.getElementById('resendOtpBtn');
            const resendText = document.getElementById('resendText');
            const resendCountdown = document.getElementById('resendCountdown');
            
            // Setup OTP inputs
            otpInputs.forEach((input, index) => {
                // Only allow numbers
                input.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');
                    
                    if (e.target.value.length === 1) {
                        // Move to next input
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                        
                        // Check if all inputs are filled
                        updateOtpHidden();
                        if (getAllOtpValues().length === 6) {
                            setTimeout(() => {
                                otpForm.submit();
                            }, 100);
                        }
                    }
                });
                
                // Handle backspace
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && e.target.value === '') {
                        if (index > 0) {
                            otpInputs[index - 1].focus();
                        }
                    }
                });
                
                // Handle paste
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const paste = (e.clipboardData || window.clipboardData).getData('text');
                    const numbers = paste.replace(/[^0-9]/g, '').slice(0, 6);
                    
                    for (let i = 0; i < numbers.length && i < 6; i++) {
                        otpInputs[i].value = numbers[i];
                    }
                    
                    updateOtpHidden();
                    if (numbers.length === 6) {
                        setTimeout(() => {
                            otpForm.submit();
                        }, 100);
                    } else if (numbers.length > 0) {
                        const nextIndex = Math.min(numbers.length, 5);
                        otpInputs[nextIndex].focus();
                    }
                });
            });
            
            function getAllOtpValues() {
                return otpInputs.map(input => input.value).join('');
            }
            
            function updateOtpHidden() {
                otpHidden.value = getAllOtpValues();
            }
            
            // Focus on first OTP input
            otpInputs[0].focus();
            
            // Auto-send OTP on load
            sendInitialOtp();
            
            @endif
        });

        @if($is2FAVerification)
        // Recovery form functions
        function showRecoveryForm() {
            document.getElementById('recoveryForm').classList.remove('hidden');
            document.getElementById('recovery_code').focus();
        }

        function hideRecoveryForm() {
            document.getElementById('recoveryForm').classList.add('hidden');
            document.getElementById('recovery_code').value = '';
            document.getElementById('pin_1').focus();
        }

        // Only allow alphanumeric for recovery code
        document.addEventListener('DOMContentLoaded', function() {
            const recoveryInput = document.getElementById('recovery_code');
            if (recoveryInput) {
                recoveryInput.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();
                });
            }
        });

        @elseif($is2FAWhatsApp)
        // WhatsApp OTP functions
        let resendCooldown = 0;
        let cooldownInterval;

        function sendInitialOtp() {
            fetch('{{ route("two-factor.whatsapp.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('OTP sent successfully');
                    startResendCooldown(60); // 60 seconds cooldown
                } else {
                    console.error('Failed to send OTP:', data.message);
                }
            })
            .catch(error => {
                console.error('Error sending OTP:', error);
            });
        }

        function resendOtp() {
            if (resendCooldown > 0) return;
            
            const resendBtn = document.getElementById('resendOtpBtn');
            resendBtn.disabled = true;
            
            fetch('{{ route("two-factor.whatsapp.resend-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    startResendCooldown(data.wait_time || 60);
                } else {
                    alert(data.message || 'Gagal mengirim ulang OTP');
                    resendBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error resending OTP:', error);
                alert('Terjadi kesalahan saat mengirim ulang OTP');
                resendBtn.disabled = false;
            });
        }

        function startResendCooldown(seconds) {
            resendCooldown = seconds;
            const resendBtn = document.getElementById('resendOtpBtn');
            const resendText = document.getElementById('resendText');
            const resendCountdown = document.getElementById('resendCountdown');
            
            resendBtn.disabled = true;
            resendText.classList.add('hidden');
            resendCountdown.classList.remove('hidden');
            
            cooldownInterval = setInterval(() => {
                resendCountdown.textContent = `Kirim ulang dalam ${resendCooldown} detik`;
                resendCooldown--;
                
                if (resendCooldown < 0) {
                    clearInterval(cooldownInterval);
                    resendBtn.disabled = false;
                    resendText.classList.remove('hidden');
                    resendCountdown.classList.add('hidden');
                }
            }, 1000);
        }
        @endif
    </script>
@endpush
@endif

@endsection
