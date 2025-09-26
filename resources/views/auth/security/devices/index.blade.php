@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.index') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Perangkat Anda</h1>
            <p class="text-base text-slate-600">Kelola perangkat yang terhubung dengan akun Anda</p>
        </div>
    </div>
@endpush

@section('section')

    {{-- Revoke All Devices Section --}}
    <div class="bg-white rounded-2xl border border-neutral-200 p-6 mb-6 hidden">
        <div class="flex justify-between items-start">
            <div class="flex-1">
                <h3 class="text-lg font-medium text-slate-900 mb-2">Keluarkan Semua Perangkat</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Keluarkan semua perangkat lain dari akun Anda. Ini akan memaksa mereka untuk login ulang.
                </p>
            </div>
            <div class="flex gap-3">
                <button onclick="showRevokeAllModal()" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    Keluarkan Perangkat Lain
                </button>
                <button onclick="showForceRevokeAllModal()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    Darurat: Keluarkan Semua
                </button>
            </div>
        </div>
        
        <div class="mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
            <div class="flex items-start gap-2">
                <svg class="w-4 h-4 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div class="text-xs text-yellow-800">
                    <p class="font-medium mb-1">Perbedaan opsi:</p>
                    <p><strong>Keluarkan Perangkat Lain:</strong> Mengeluarkan semua perangkat kecuali yang Anda gunakan saat ini.</p>
                    <p><strong>Darurat - Keluarkan Semua:</strong> Mengeluarkan SEMUA perangkat termasuk yang Anda gunakan saat ini. Anda akan dipaksa logout dan harus login ulang.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Devices List --}}
    <div class="bg-white rounded-2xl overflow-hidden border border-neutral-200">
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Semua Perangkat</h3>
        </div>

        {{-- Devices List --}}
        <div class="divide-y divide-neutral-200">
            @forelse($sessions as $session)
                <button type="button" class="w-full" onclick="window.location.href='{{ route('security.device.detail', $session['id']) }}'">
                    <div class="px-6 py-3 hover:bg-neutral-50">
                        <div class="flex items-center gap-4">
                            {{-- Device Icon --}}
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $session['device_icon'] }}"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Device Info --}}
                            <div class="flex-1 min-w-0 flex flex-col items-start">
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-medium text-gray-900">
                                        {{ $session['browser'] }} di {{ $session['operating_system'] }}
                                    </h4>
                                    @if($session['is_current'])
                                        <span class="inline-flex items-center px-2 py-0.5 text-sm text-[#147b29] font-medium">
                                            Perangkat Ini
                                        </span>
                                    @endif
                                </div>
                                <div class="flex flex-col text-left">
                                    <span class="text-sm">{{ $session['location'] }}</span>
                                    <span class="text-sm text-gray-500">{{ $session['time_ago'] }}</span>
                                </div>
                            </div>

                            <img src="/assets/icons/ui/arrow/right-gray.svg">
                        </div>
                    </div>
                </button>
            @empty
                <div class="px-6 py-8 text-center">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                    </div>
                    <h4 class="text-sm font-medium text-gray-900 mb-1">Tidak ada perangkat ditemukan</h4>
                    <p class="text-xs text-gray-500">Anda belum memiliki session login aktif.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Revoke All Modal --}}
    <div id="revokeAllModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-md w-full p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Keluarkan Perangkat Lain</h3>
                </div>
                
                <p class="text-sm text-gray-600 mb-4">
                    Ini akan mengeluarkan semua perangkat lain dari akun Anda kecuali perangkat yang sedang Anda gunakan saat ini. Mereka harus login ulang untuk mengakses akun.
                </p>
                
                <form action="{{ route('security.device.revoke-all') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi dengan Password
                        </label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#128AEB] focus:border-transparent">
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="hideRevokeAllModal()" 
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium">
                            Keluarkan Perangkat Lain
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Force Revoke All Modal --}}
    <div id="forceRevokeAllModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-md w-full p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">⚠️ Darurat: Keluarkan SEMUA Perangkat</h3>
                </div>
                
                <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-4">
                    <p class="text-sm text-red-800 font-medium mb-2">PERINGATAN KEAMANAN:</p>
                    <p class="text-sm text-red-700">
                        Ini akan mengeluarkan SEMUA perangkat termasuk yang Anda gunakan saat ini. Anda akan dipaksa logout dan harus login ulang.
                        Gunakan fitur ini hanya jika akun Anda diretas atau dalam situasi darurat.
                    </p>
                </div>
                
                <form action="{{ route('security.device.force-revoke-all') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="force_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi dengan Password
                        </label>
                        <input type="password" id="force_password" name="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="hideForceRevokeAllModal()" 
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium">
                            🚨 DARURAT: Keluarkan SEMUA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Single Device Revoke Modal --}}
    <div id="revokeDeviceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-md w-full p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Keluarkan Perangkat</h3>
                </div>
                
                <p class="text-sm text-gray-600 mb-4">
                    Apakah Anda yakin ingin mengeluarkan perangkat ini? Perangkat tersebut harus login ulang untuk mengakses akun.
                </p>
                
                <form id="revokeDeviceForm" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="hideRevokeDeviceModal()" 
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium">
                            Keluarkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
        function showRevokeAllModal() {
            document.getElementById('revokeAllModal').classList.remove('hidden');
        }

        function hideRevokeAllModal() {
            document.getElementById('revokeAllModal').classList.add('hidden');
        }

        function showForceRevokeAllModal() {
            document.getElementById('forceRevokeAllModal').classList.remove('hidden');
        }

        function hideForceRevokeAllModal() {
            document.getElementById('forceRevokeAllModal').classList.add('hidden');
        }

        function revokeDevice(sessionId) {
            const form = document.getElementById('revokeDeviceForm');
            form.action = `{{ url('/account/security/device') }}/${sessionId}`;
            document.getElementById('revokeDeviceModal').classList.remove('hidden');
        }

        function hideRevokeDeviceModal() {
            document.getElementById('revokeDeviceModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        document.getElementById('revokeAllModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideRevokeAllModal();
            }
        });

        document.getElementById('forceRevokeAllModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideForceRevokeAllModal();
            }
        });

        document.getElementById('revokeDeviceModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideRevokeDeviceModal();
            }
        });
        </script>
    @endpush

@endsection
