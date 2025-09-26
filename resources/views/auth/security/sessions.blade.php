@extends('partials.layouts.account')

@include('partials.navbar.mainAccount')

@section('title', 'Manajemen Sesi')

@section('content')

{{-- Header Section --}}
<section class="w-full md:px-6 py-8 max-md:pb-4 bg-gradient-to-b from-[#128AEB] to-[#0F76C6] text-white">
    <div class="w-full md:max-w-7xl max-md:px-4 px-8 mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('security.index') }}" class="p-2 hover:bg-white/10 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-3xl max-md:text-2xl font-semibold">Manajemen Sesi</h1>
        </div>
        <p class="text-white/80 max-w-2xl">Kelola semua sesi login aktif di berbagai perangkat</p>
    </div>
</section>

{{-- Main Content --}}
<div class="bg-gray-50 min-h-screen">
    <div class="w-full md:max-w-7xl mx-auto px-4 md:px-8 py-8">
        
        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Suspicious Sessions Alert --}}
        @if(!empty($suspiciousSessions))
        <div class="mb-6 p-4 bg-orange-50 border border-orange-200 rounded-lg">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <h3 class="font-semibold text-orange-800">Aktivitas Mencurigakan Terdeteksi</h3>
            </div>
            <p class="text-orange-700 mb-4">
                Terdapat {{ count($suspiciousSessions) }} pola sesi yang mencurigakan. Disarankan untuk logout dari semua perangkat dan ganti password.
            </p>
            <div class="space-y-2">
                @foreach($suspiciousSessions as $alert)
                <div class="text-sm text-orange-600">
                    • {{ $alert['message'] }} ({{ ucfirst($alert['severity']) }})
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Action Buttons --}}
        <div class="mb-6 flex flex-wrap gap-4">
            <button onclick="showLogoutOtherDevicesModal()" 
                    class="flex items-center gap-2 px-4 py-2 bg-[#128AEB] text-white rounded-lg hover:bg-[#0F76C6] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Logout Perangkat Lain
            </button>
            
            <button onclick="showLogoutAllDevicesModal()" 
                    class="flex items-center gap-2 px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout Semua Perangkat
            </button>
        </div>

        {{-- Sessions List --}}
        <div class="bg-white rounded-xl border border-neutral-200 p-6">
            <h3 class="text-xl font-semibold text-slate-900 mb-6">Sesi Aktif ({{ count($activeSessions) }})</h3>
            
            @if(count($activeSessions) > 0)
                <div class="space-y-4">
                    @foreach($activeSessions as $session)
                    <div class="border border-gray-200 rounded-lg p-4 {{ $session['is_current'] ? 'bg-blue-50 border-blue-200' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-4">
                                <div class="p-3 {{ $session['is_current'] ? 'bg-blue-100' : 'bg-gray-100' }} rounded-lg">
                                    @if($session['device_info']['is_mobile'])
                                        <svg class="w-6 h-6 {{ $session['is_current'] ? 'text-blue-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z"/>
                                        </svg>
                                    @elseif($session['device_info']['is_tablet'])
                                        <svg class="w-6 h-6 {{ $session['is_current'] ? 'text-blue-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 {{ $session['is_current'] ? 'text-blue-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    @endif
                                </div>
                                
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-semibold text-slate-900">
                                            {{ $session['device_info']['platform'] ?? 'Unknown Platform' }} - {{ $session['device_info']['browser'] ?? 'Unknown Browser' }}
                                        </h4>
                                        @if($session['is_current'])
                                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Perangkat Ini</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">{{ $session['location'] }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        IP: {{ $session['ip_address'] }} • 
                                        Terakhir aktif: {{ \Carbon\Carbon::createFromTimestamp($session['last_activity'])->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            @if(!$session['is_current'])
                            <form action="{{ route('security.revoke-session', $session['id']) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Apakah Anda yakin ingin mencabut sesi ini?')"
                                        class="px-3 py-1 text-sm text-red-600 border border-red-300 rounded hover:bg-red-50 transition">
                                    Cabut Sesi
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <p>Tidak ada sesi aktif yang ditemukan</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Password Confirmation Modal --}}
<div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
        <h3 id="modalTitle" class="text-lg font-semibold text-slate-900 mb-4">Konfirmasi Password</h3>
        
        <p id="modalMessage" class="text-gray-600 mb-6">Masukkan password untuk melanjutkan.</p>
        
        <form id="modalForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#128AEB] focus:border-transparent"
                       required>
            </div>
            
            <div class="flex justify-end gap-3">
                <button type="button" 
                        onclick="closePasswordModal()" 
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-[#128AEB] text-white rounded-lg hover:bg-[#0F76C6] transition">
                    Konfirmasi
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showLogoutOtherDevicesModal() {
    confirmPasswordModal(
        '{{ route('security.logout-other-devices') }}',
        'Logout Perangkat Lain',
        'Masukkan password untuk logout dari semua perangkat lain kecuali perangkat ini.'
    );
}

function showLogoutAllDevicesModal() {
    confirmPasswordModal(
        '{{ route('security.logout-all-devices') }}',
        'Logout Semua Perangkat',
        'Masukkan password untuk logout dari semua perangkat. Anda akan dialihkan ke halaman login.'
    );
}

function confirmPasswordModal(action, title, message) {
    const modal = document.getElementById('passwordModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalForm = document.getElementById('modalForm');
    
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    modalForm.action = action;
    
    modal.classList.remove('hidden');
}

function closePasswordModal() {
    const modal = document.getElementById('passwordModal');
    modal.classList.add('hidden');
    document.getElementById('password').value = '';
}
</script>
@endpush

@endsection
