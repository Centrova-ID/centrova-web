@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.index') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Pemberitahuan Login</h1>
            <p class="text-base text-slate-600">Pantau aktivitas login yang mencurigakan di akun Anda</p>
        </div>
    </div>
@endpush

@section('section')

    <!-- Alerts List -->
    <div class="bg-white rounded-2xl overflow-hidden border border-neutral-200">
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-neutral-200">
            <h3 class="text-lg font-medium text-slate-900">Daftar Pemberitahuan</h3>
        </div>

        {{-- Alerts List --}}
        @if($alerts->count() > 0)
            <div class="divide-y divide-neutral-200">
                @foreach($alerts as $alert)
                    <button type="button" class="w-full" onclick="window.location.href='{{ route('security.login-alerts.detail') }}?id={{ $alert->id }}'">
                        <div class="p-4 hover:bg-neutral-50">
                            <div class="flex items-center gap-4">
                                {{-- Severity Icon --}}
                                <div class="flex-shrink-0">
                                    @if($alert->severity === 'critical')
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>
                                        </div>
                                    @elseif($alert->severity === 'high')
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Alert Info --}}
                                <div class="flex-1 min-w-0 flex flex-col items-start">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="text-base font-medium text-gray-900">{{ $alert->message }}</h4>
                                        
                                        {{-- Status Badge --}}
                                        @if($alert->status === 'unread')
                                            <span class="inline-flex items-center px-2 py-0.5 text-sm text-blue-600 font-medium">
                                                Belum Dibaca
                                            </span>
                                        @elseif($alert->status === 'dismissed')
                                            <span class="inline-flex items-center px-2 py-0.5 text-sm text-green-600 font-medium">
                                                Aman
                                            </span>
                                        @elseif($alert->status === 'reported')
                                            <span class="inline-flex items-center px-2 py-0.5 text-sm text-red-600 font-medium">
                                                Dilaporkan
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex flex-col text-left">
                                        <div class="flex items-center text-sm text-gray-500 gap-3">
                                            <span>{{ $alert->alert_time->diffForHumans() }}</span>
                                            @if($alert->metadata && isset($alert->metadata['ip_address']))
                                                <span>{{ $alert->metadata['ip_address'] }}</span>
                                            @endif
                                            @if($alert->metadata && isset($alert->metadata['location']))
                                                <span>{{ $alert->metadata['location'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <img src="/assets/icons/ui/arrow/right-gray.svg">
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        @else
            <div class="px-6 py-8 text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="text-sm font-medium text-gray-900 mb-1">Tidak ada pemberitahuan</h4>
                <p class="text-xs text-gray-500">Anda belum memiliki pemberitahuan login.</p>
            </div>
        @endif
    </div>

@endsection
