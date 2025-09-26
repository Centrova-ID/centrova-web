@extends('partials.layouts.settingsAccount')

@push('intro-section')
    <div class="flex items-start gap-3 mb-1">
        <a href="{{ route('security.login-alerts') }}" class="text-slate-600 hover:text-slate-800 h-[36px] flex justify-center items-center aspect-square hover:bg-neutral-100 rounded-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-slate-800 text-xl font-medium">Detail Pemberitahuan Login</h1>
            <p class="text-base text-slate-600">Informasi lengkap tentang aktivitas login ini</p>
        </div>
    </div>
@endpush

@section('section')

    <!-- Alert Header -->
    <div class="bg-white rounded-2xl border border-neutral-200 mb-6">
        <div class="px-6 py-4">
            <div class="flex items-start justify-between">
                <div class="flex items-start gap-4">
                    <!-- Alert Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-semibold text-slate-900">{{ $alert->title }}</h3>
                        </div>
                        
                        <p class="text-gray-600 mb-3">
                            @if($alert->alert_type === 'new_login')
                                @if(isset($alert->metadata['browser']) && isset($alert->metadata['operating_system']))
                                    {{ $alert->metadata['browser'] }} di {{ $alert->metadata['operating_system'] }}
                                @else
                                    {{ $alert->message }}
                                @endif
                            @elseif($alert->alert_type === 'suspicious_login' && str_contains($alert->message, 'lokasi'))
                                @if(isset($alert->metadata['location']))
                                    {{ $alert->metadata['location'] }}
                                @else
                                    {{ $alert->message }}
                                @endif
                            @else
                                {{ $alert->message }}
                            @endif
                        </p>
                        
                        <div class="flex items-center text-[15px] text-neutral-900 gap-4">
                            <span class="flex items-center gap-1">
                                <span>Waktu Login:</span> 
                                {{ $alert->alert_time->format('d M Y, H:i') }} WIB
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex-shrink-0">
                @if($alert->status !== 'dismissed' && $alert->status !== 'reported')
                    <button type="button" 
                            onclick="markAsSafe({{ $alert->id }})"
                            class="w-full text-center mt-2 text-neutral-900 hover:bg-neutral-100 border border-neutral-300 px-4 py-1.5 rounded-lg text-base font-semibold transition">
                        Tandai Aman
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Technical Details -->
    @if($alert->metadata)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Device Information -->
            <div class="bg-white rounded-2xl border border-neutral-200">
                <div class="px-6 py-4 border-b border-neutral-200">
                    <h4 class="text-lg font-medium text-slate-900">Informasi Perangkat</h4>
                </div>
                <div class="p-6 space-y-4">
                    @if(isset($alert->metadata['browser']))
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Browser</span>
                            <span class="text-sm text-slate-900">{{ $alert->metadata['browser'] }}</span>
                        </div>
                    @endif
                    
                    @if(isset($alert->metadata['operating_system']))
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Sistem Operasi</span>
                            <span class="text-sm text-slate-900">{{ $alert->metadata['operating_system'] }}</span>
                        </div>
                    @endif
                    
                    @if(isset($alert->metadata['device_type']))
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Tipe Perangkat</span>
                            <span class="text-sm text-slate-900">{{ ucfirst($alert->metadata['device_type']) }}</span>
                        </div>
                    @endif
                    
                    @if(isset($alert->metadata['user_agent']))
                        <div>
                            <span class="text-sm font-medium text-gray-500">User Agent</span>
                            <p class="text-xs text-gray-600 mt-1 break-all">{{ $alert->metadata['user_agent'] }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Network Information -->
            <div class="bg-white rounded-2xl border border-neutral-200">
                <div class="px-6 py-4 border-b border-neutral-200">
                    <h4 class="text-lg font-medium text-slate-900">Informasi Jaringan</h4>
                </div>
                <div class="p-6 space-y-4">
                    @if(isset($alert->metadata['ip_address']))
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Alamat IP</span>
                            <span class="text-sm text-slate-900 font-mono">{{ $alert->metadata['ip_address'] }}</span>
                        </div>
                    @endif
                    
                    @if(isset($alert->metadata['location']))
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Lokasi</span>
                            <span class="text-sm text-slate-900">{{ $alert->metadata['location'] }}</span>
                        </div>
                    @endif
                    
                    @if(isset($alert->metadata['country_code']))
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Kode Negara</span>
                            <span class="text-sm text-slate-900">{{ strtoupper($alert->metadata['country_code']) }}</span>
                        </div>
                    @endif
                    
                    @if(isset($alert->metadata['failed_attempts_count']))
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-500">Percobaan Gagal</span>
                            <span class="text-sm text-red-600 font-semibold">{{ $alert->metadata['failed_attempts_count'] }} kali</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Related Login Activity -->
    @if($alert->loginActivity)
        <div class="bg-white rounded-2xl border border-neutral-200">
            <div class="px-6 py-4 border-b border-neutral-200">
                <h4 class="text-lg font-medium text-slate-900">Aktivitas Login Terkait</h4>
            </div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        @if($alert->loginActivity->login_status === 'success')
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        @else
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-medium text-slate-900">
                                Login {{ $alert->loginActivity->login_status === 'success' ? 'Berhasil' : 'Gagal' }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $alert->loginActivity->login_at->format('d M Y, H:i') }} WIB
                            </span>
                        </div>
                        <p class="text-sm text-gray-600">
                            dari {{ $alert->loginActivity->ip_address }}
                            @if($alert->loginActivity->location)
                                ({{ $alert->loginActivity->location }})
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

<script>
function markAsSafe(alertId) {
    if (!confirm('Apakah Anda yakin login ini aman?')) {
        return;
    }
    
    fetch(`/account/security/login-alerts/detail/mark-safe`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: alertId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses permintaan');
    });
}

function reportSuspicious(alertId) {
    if (!confirm('Apakah Anda yakin login ini mencurigakan? Ini akan dilaporkan ke admin untuk ditindaklanjuti.')) {
        return;
    }
    
    fetch(`/account/security/login-alerts/detail/report-suspicious`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: alertId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses permintaan');
    });
}
</script>
