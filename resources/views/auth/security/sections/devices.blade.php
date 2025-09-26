{{-- Devices Section --}}
<div id="devices-section" class="profile-section bg-white rounded-xl border border-neutral-200">
    {{-- Header --}}
    <div class="flex justify-between items-center px-6 py-3">
        <h3 class="text-lg font-medium text-slate-900">Perangkat Anda</h3>
        <a href="{{ route('security.devices') }}" class="text-[#128AEB] text-base font-medium">
            Kelola Semua Perangkat
        </a>
    </div>
    
    {{-- Content --}}
    <div class="border-t border-neutral-200/80">
        @if(isset($deviceSessionSummary) && $deviceSessionSummary['recent_sessions']->isNotEmpty())
            @foreach($deviceSessionSummary['recent_sessions'] as $session)
                <div class="flex items-center gap-4 px-6 py-4 hover:bg-neutral-50 {{ !$loop->last ? 'border-b border-neutral-200/80' : '' }}">
                    {{-- Device Icon --}}
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $session['device_icon'] }}"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Device Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $session['browser'] }} di {{ $session['operating_system'] }}
                            </p>
                            @if($session['is_current'])
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Perangkat Ini
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 mt-1">
                            <p class="text-xs text-gray-500">{{ $session['location'] }}</p>
                            <p class="text-xs text-gray-500">{{ $session['time_ago'] }}</p>
                        </div>
                    </div>

                    {{-- Status Indicator --}}
                    <div class="flex-shrink-0">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                    </div>
                </div>
            @endforeach

            {{-- Summary Footer --}}
            @if(isset($deviceSessionSummary) && $deviceSessionSummary['active_sessions_count'] > 3)
                <div class="px-6 py-3 bg-gray-50 border-t border-neutral-200/80">
                    <p class="text-sm text-gray-600 text-center">
                        Dan {{ $deviceSessionSummary['active_sessions_count'] - 3 }} perangkat aktif lainnya. 
                        <a href="{{ route('security.devices') }}" class="text-[#128AEB] hover:text-blue-600 font-medium">
                            Lihat semua
                        </a>
                    </p>
                </div>
            @endif
        @else
            {{-- No Devices Found --}}
            <div class="px-6 py-8 text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                </div>
                <h4 class="text-sm font-medium text-gray-900 mb-1">Tidak ada perangkat aktif</h4>
                <p class="text-xs text-gray-500">Anda belum login dari perangkat lain.</p>
            </div>
        @endif
    </div>
</div>
