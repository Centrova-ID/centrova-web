@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.devices') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Detail Perangkat</h1>
            <p class="text-base text-slate-600">Informasi lengkap perangkat yang terhubung</p>
        </div>
    </div>
@endpush

@section('section')

    {{-- Device Overview Card --}}
    <div class="bg-white rounded-2xl border border-neutral-200 px-6 py-4 mb-6">
        <div class="flex items-start gap-4">

            {{-- Device Info --}}
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-xl font-semibold text-gray-900">
                        {{ $session['browser'] }} di {{ $session['operating_system'] }}
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-[15px] text-neutral-900">
                    <div>
                        <span>Terakhir Aktif:</span> 
                        {{ $session['last_activity']->format('d M Y, H:i') }}
                    </div>
                </div>

                @if($session['is_current'])
                    <span class="text-base font-normal text-[#147b29]">
                        Perangkat Ini
                    </span>
                @else
                    @if(!$session['is_current'])
                    <div class="flex-shrink-0">
                        <button onclick="revokeDevice('{{ $session['id'] }}')" 
                                class="w-full text-center mt-2 text-neutral-900 hover:bg-neutral-100 border border-neutral-300 px-4 py-1.5 rounded-lg text-base font-semibold transition">
                            Keluarkan Perangkat
                        </button>
                    </div>
                    @endif
                @endif
            </div>

            {{-- Actions --}}
        </div>
    </div>

    {{-- Detailed Information --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Technical Details --}}
        <div class="bg-white rounded-2xl border border-neutral-200">
            <div class="px-6 py-4 border-b border-neutral-200">
                <h3 class="text-lg font-medium text-slate-900">Informasi Teknis</h3>
            </div>
            
            <div class="px-6 py-3 space-y-3">
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Browser</span>
                    <span class="text-sm text-gray-900">{{ $session['browser'] }}</span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Sistem Operasi</span>
                    <span class="text-sm text-gray-900">{{ $session['operating_system'] }}</span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Tipe Perangkat</span>
                    <span class="text-sm text-gray-900 capitalize">{{ $session['device_type'] }}</span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Alamat IP</span>
                    <span class="text-sm text-gray-900 font-mono">{{ $session['ip_address'] }}</span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">ID Sesi</span>
                    <span class="text-sm text-gray-900 font-mono">{{ substr($session['id'], 0, 8) }}...</span>
                </div>
            </div>
        </div>

        {{-- Activity Information --}}
        <div class="bg-white rounded-2xl border border-neutral-200">
            <div class="px-6 py-4 border-b border-neutral-200">
                <h3 class="text-lg font-medium text-slate-900">Informasi Aktivitas</h3>
            </div>
            
            <div class="px-6 py-3 space-y-3">
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Terakhir Login</span>
                    <span class="text-sm text-gray-900">
                        @if(isset($session['login_at']) && $session['login_at'])
                            {{ $session['login_at']->format('d M Y, H:i:s') }}
                        @elseif(isset($session['created_at']) && $session['created_at'])
                            {{ $session['created_at']->format('d M Y, H:i:s') }}
                        @else
                            <span class="text-gray-500 italic">Data login tidak tersedia</span>
                        @endif
                    </span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Terakhir Aktif</span>
                    <span class="text-sm text-gray-900">{{ $session['last_activity']->format('d M Y, H:i:s') }}</span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Waktu Berlalu</span>
                    <span class="text-sm text-gray-900" id="time-ago" data-last-activity="{{ $session['last_activity']->timestamp }}">{{ $session['time_ago'] }}</span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Status</span>
                    <span class="text-sm text-gray-900">
                        Aktif
                    </span>
                </div>
                
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Lokasi</span>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm text-gray-900">{{ is_array($session['location']) && !empty($session['location']) ? implode(', ', $session['location']) : (!empty($session['location']) && !is_array($session['location']) ? $session['location'] : 'Lokasi tidak diketahui') }}</span>
                    </div>
                </div>
                
                @if($session['is_current'])
                <div class="flex justify-between py-2">
                    <span class="text-sm font-medium text-gray-700">Sesi Saat Ini</span>
                    <span class="text-sm text-gray-900">
                        Ya
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>


    {{-- Security Notice --}}
    @if(!$session['is_current'])
    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mt-6 hidden">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-medium text-yellow-800 mb-1">Peringatan Keamanan</h4>
                <p class="text-sm text-yellow-700">
                    Jika Anda tidak mengenali perangkat ini atau mencurigai adanya akses yang tidak sah, 
                    segera keluarkan perangkat ini dan ubah password Anda.
                </p>
            </div>
        </div>
    </div>
    @endif

    <div>
        {{-- Revoke Device Modal --}}
        <div id="revokeDeviceModal" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-50 flex items-center justify-center min-h-screen w-full">
            <div class="bg-white rounded-[32px] p-6 m-4 max-w-md w-full shadow-xl">
                <div class="text-center">
                    <div class="mb-4">
                        <svg class="w-12 h-12 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-lg font-medium text-slate-900 mb-2">Keluarkan Perangkat</h3>
                    
                    <p class="text-base text-neutral-900 mb-6 leading-relaxed">
                        Apakah Anda yakin ingin mengeluarkan perangkat ini? Perangkat tersebut harus login ulang untuk mengakses akun.
                    </p>
                    
                    <form id="revokeDeviceForm" action="{{ route('security.device.revoke', $session['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <div class="flex gap-3">
                            <button type="button" onclick="hideRevokeDeviceModal()" 
                                    class="flex-1 text-gray-900 font-medium px-6 py-2 rounded-full border border-gray-400 hover:bg-neutral-100">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-2 rounded-full">
                                Keluarkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function revokeDevice(sessionId) {
                const modal = document.getElementById('revokeDeviceModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function hideRevokeDeviceModal() {
                const modal = document.getElementById('revokeDeviceModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Close modal when clicking outside
            document.getElementById('revokeDeviceModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideRevokeDeviceModal();
                }
            });

            // Real-time update for time ago
            function updateTimeAgo() {
                const timeAgoElements = [
                    document.getElementById('time-ago'),
                    document.getElementById('overview-time-ago')
                ];

                timeAgoElements.forEach(element => {
                    if (element) {
                        const lastActivityTimestamp = parseInt(element.getAttribute('data-last-activity'));
                        const now = Math.floor(Date.now() / 1000);
                        const secondsAgo = now - lastActivityTimestamp;

                        let timeAgoText = '';
                        if (secondsAgo <= 0) {
                            timeAgoText = 'Baru saja';
                        } else if (secondsAgo < 60) {
                            timeAgoText = secondsAgo + ' detik yang lalu';
                        } else if (secondsAgo < 3600) {
                            const minutes = Math.floor(secondsAgo / 60);
                            timeAgoText = minutes + ' menit yang lalu';
                        } else if (secondsAgo < 86400) {
                            const hours = Math.floor(secondsAgo / 3600);
                            timeAgoText = hours + ' jam yang lalu';
                        } else {
                            const days = Math.floor(secondsAgo / 86400);
                            timeAgoText = days + ' hari yang lalu';
                        }

                        // Update text based on element ID
                        if (element.id === 'overview-time-ago') {
                            element.textContent = '(' + timeAgoText + ')';
                        } else {
                            element.textContent = timeAgoText;
                        }
                    }
                });
            }

            // Update immediately on page load
            updateTimeAgo();

            // Update every 30 seconds
            setInterval(updateTimeAgo, 30000);
        </script>
    @endpush

@endsection
