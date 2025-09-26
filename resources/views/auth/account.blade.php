@extends('partials.layouts.account')

{{-- Styles --}}
@push('styles')
    <style>
        .security-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        /* Avatar responsive fixes */
        .avatar-container {
            position: relative;
            overflow: hidden;
        }
        
        .avatar-container img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Mobile specific adjustments */
        @media (max-width: 768px) {
            .profile-section {
                gap: 1rem;
            }
            
            .avatar-container {
                flex-shrink: 0;
            }
        }

        @media (max-width: 640px) {
            .profile-section {
                gap: 0.75rem;
            }
        }
    </style>
@endpush

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
    <div id="success-notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            const notification = document.getElementById('success-notification');
            if (notification) {
                notification.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }, 3000);
    </script>
@endif

@if(session('error'))
    <div id="error-notification" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300">
        {{ session('error') }}
    </div>
    <script>
        setTimeout(() => {
            const notification = document.getElementById('error-notification');
            if (notification) {
                notification.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }, 3000);
    </script>
@endif

    {{-- Hero Section with User Info --}}
    <section class="w-full md:px-6 py-8 max-md:pb-4 bg-gradient-to-b from-[#128AEB] to-[#0F76C6] text-white">
        <div class="w-full md:max-w-7xl max-md:px-0 px-8 mx-auto flex flex-col xl:flex-row justify-between items-start lg:items-center gap-y-8 lg:gap-y-0">
            {{-- Profile Section --}}
            <div class="flex items-center max-md:px-4 gap-x-5 max-md:gap-x-3 gap-y-4 profile-section">
                <x-user-avatar 
                    :user="$user" 
                    size="3xl-responsive" 
                    class="avatar-container" 
                    clickable 
                    :href="route('profile.index')"
                    showEditIcon
                />
                <div>
                    <h1 class="text-white font-semibold text-3xl max-md:text-2xl">{{ $user->name }}</h1>
                    <h2 class="mb-3 px-[1px] text-white/90 font-medium max-md:text-sm">{{ $user->email }}</h2>
                    <a href="{{ route('profile.index') }}" class="px-6 font-medium py-2 hover:bg-white/10 transition border border-white/80 rounded-full inline-block max-md:hidden">
                        Kelola Akun Anda
                    </a>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="w-full xl:max-w-[55%] flex flex-col sm:flex-row flex-wrap max-xl:gap-x-10 justify-center xl:justify-between">
                {{-- Security Score Card --}}
                <div class="max-w-full sm:max-w-[350px] rounded-lg p-4">
                    <div class="flex xl:flex-col items-start max-xl:items-center gap-x-4 gap-y-2">
                        <div class="flex items-center gap-2">
                            <img src="assets/icons/ui/account/keamanan.svg" class="h-10">
                            <div class="flex items-center gap-1 max-xl:hidden">
                                <span class="text-xs font-medium px-2 py-1 rounded-full security-badge {{ $securityScore >= 80 ? 'bg-green-500/20 text-green-100' : ($securityScore >= 60 ? 'bg-yellow-500/20 text-yellow-100' : 'bg-red-500/20 text-red-100') }}">
                                    {{ $securityScore }}/100
                                </span>
                            </div>
                        </div>
                        <div>
                            <h3 onclick="window.location.href='{{ route('security.index') }}'" class="text-base font-semibold cursor-pointer">Keamanan & Privasi</h3>
                            <p onclick="window.location.href='{{ route('security.index') }}'" class="text-sm text-white/70 cursor-pointer security-status">
                                {{ $securityScore >= 80 ? 'Sangat Aman' : ($securityScore >= 60 ? 'Cukup Aman' : 'Perlu Ditingkatkan') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Payments Card --}}
                <div class="max-w-full sm:max-w-[350px] rounded-lg p-4">
                    <div class="flex xl:flex-col items-start max-xl:items-center gap-x-4 gap-y-2">
                        <img src="assets/icons/ui/account/card.svg" class="h-10">
                        <div>
                            <h3 onclick="window.location.href='{{ route('account.subscription') }}'" class="text-base font-semibold cursor-pointer">Pembayaran & Langganan</h3>
                            @if($subscription)
                                <p onclick="window.location.href='{{ route('account.subscription') }}'" class="text-sm text-white/70 cursor-pointer">{{ ucfirst($subscription->plan ?? 'basic') }} - {{ ucfirst($subscription->status ?? 'inactive') }}</p>
                            @else
                                <p onclick="window.location.href='{{ route('account.subscription') }}'" class="text-sm text-white/70 cursor-pointer">Tidak ada langganan aktif</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Devices Card --}}
                <div class="max-w-full sm:max-w-[350px] rounded-lg p-4">
                    <div class="flex xl:flex-col items-start max-xl:items-center gap-x-4 gap-y-2">
                        <img src="assets/icons/ui/account/perangkat.svg" class="h-10">
                        <div>
                            <h3 onclick="window.location.href='{{ route('security.devices') }}'" class="text-base font-semibold cursor-pointer">Perangkat: <span class="device-count">{{ $deviceCount }}</span></h3>
                            <p onclick="window.location.href='{{ route('security.devices') }}'" class="text-sm text-white/70 cursor-pointer">Perangkat Terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <div class="bg-white min-h-screen">
        <div class="w-full md:max-w-7xl mx-auto px-4 md:px-8 py-8">
            {{-- Account Overview --}}
            <section class="mb-8">
                <h2 class="text-2xl font-semibold text-slate-800 mb-6">Informasi Akun</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Account Security --}}
                    <div class="bg-white rounded-2xl px-6 py-5 border border-neutral-200 transition-shadow duration-150">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-green-50 rounded-xl">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Keamanan Akun</h3>
                                <p class="text-sm text-gray-500">Skor keamanan: <span class="overview-security-score">{{ $securityScore }}</span>/100</p>
                            </div>
                        </div>
                        <a href="{{ route('security.index') }}" class="text-[#128AEB] text-sm font-medium hover:underline flex items-center">Periksa pengaturan keamanan 
                            <svg class="w-4 h-4 ml-1 mt-[1px] transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg></a>
                    </div>

                    {{-- Subscription Status --}}
                    <div class="bg-white rounded-2xl px-6 py-5 border border-neutral-200 transition-shadow duration-150">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 {{ $subscription && $subscription->status === 'active' ? 'bg-blue-50' : 'bg-gray-50' }} rounded-xl">
                                <svg class="w-6 h-6 {{ $subscription && $subscription->status === 'active' ? 'text-blue-600' : 'text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Status Langganan</h3>
                                @if($subscription)
                                    <p class="text-sm text-gray-500">{{ ucfirst($subscription->plan) }} - {{ ucfirst($subscription->status) }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Tidak ada langganan aktif</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('account.subscription') }}" class="text-[#128AEB] text-sm font-medium hover:underline flex items-center">Kelola langganan 
                            <svg class="w-4 h-4 ml-1 mt-[1px] transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg></a>
                    </div>

                    {{-- Service Orders --}}
                    <div class="bg-white rounded-2xl px-6 py-5 border border-neutral-200 transition-shadow duration-150">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-purple-50 rounded-xl">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Pesanan Layanan</h3>
                                <p class="text-sm text-gray-500">{{ $activeOrders }} aktif dari {{ $totalOrders }} total</p>
                            </div>
                        </div>
                        <a href="{{ route('services.index') }}" class="text-[#128AEB] text-sm font-medium hover:underline flex items-center">Lihat semua pesanan 
                            <svg class="w-4 h-4 ml-1 mt-[1px] transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg></a>
                    </div>

                    {{-- Service Cancellation --}}
                    <div class="bg-white rounded-2xl px-6 py-5 border border-neutral-200 transition-shadow duration-150">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-red-50 rounded-xl">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Pembatalan Layanan</h3>
                                <p class="text-sm text-gray-500">Kelola status dan pembatalan layanan</p>
                            </div>
                        </div>
                        <a href="{{ route('services.cancellation.index') }}" class="text-[#128AEB] text-sm font-medium hover:underline flex items-center">Kelola pembatalan layanan 
                            <svg class="w-4 h-4 ml-1 mt-[1px] transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg></a>
                    </div>

                    {{-- Profile Completeness --}}
                    <div class="bg-white rounded-2xl px-6 py-5 border border-neutral-200 transition-shadow duration-150">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-yellow-50 rounded-xl">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Kelengkapan Profil</h3>
                                @php
                                    $completeness = 0;
                                    if($user->name) $completeness += 20;
                                    if($user->email) $completeness += 20;
                                    if($user->phone) $completeness += 20;
                                    if($user->profile_picture) $completeness += 20;
                                    if($user->birth_date) $completeness += 20;
                                @endphp
                                <p class="text-sm text-gray-500">{{ $completeness }}% lengkap</p>
                            </div>
                        </div>
                        <a href="{{ route('profile.index') }}" class="text-[#128AEB] text-sm font-medium hover:underline flex items-center">Lengkapi profil 
                            <svg class="w-4 h-4 ml-1 mt-[1px] transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg></a>
                    </div>

                    {{-- Activity Log --}}
                    <div class="bg-white rounded-2xl px-6 py-5 border border-neutral-200 transition-shadow duration-150">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-indigo-50 rounded-xl">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">Aktivitas Login</h3>
                                <p class="text-sm text-gray-500"><span class="device-count">{{ $deviceCount }}</span> perangkat aktif</p>
                            </div>
                        </div>
                        <a href="{{ route('security.index') }}" class="text-[#128AEB] text-sm font-medium hover:underline flex items-center">Lihat riwayat aktivitas 
                            <svg class="w-4 h-4 ml-1 mt-[1px] transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg></a>
                    </div>
                </div>
            </section>

            {{-- Recent Activity --}}
            <section class="mb-8">
                <h2 class="text-2xl font-semibold text-slate-800 mb-6">Perangkat Aktif</h2>
                <div class="bg-white rounded-xl border border-neutral-200 divide-y divide-neutral-200">
                    @if($devices && count($devices) > 0)
                        @foreach($devices as $device)
                            <div class="p-4 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <span class="p-2 bg-blue-50 rounded-lg">
                                        @if($device->device_type == 'Desktop' || $device->device_type == 'desktop')
                                            <svg class="w-5 h-5 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        @elseif($device->device_type == 'Mobile' || $device->device_type == 'mobile')
                                            <svg class="w-5 h-5 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        @elseif($device->device_type == 'Tablet' || $device->device_type == 'tablet')
                                            <svg class="w-5 h-5 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-[#128AEB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        @endif
                                    </span>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">{{ $device->device_name ?? 'Perangkat Tidak Dikenal' }}</p>
                                        <div class="flex items-center gap-2 text-sm text-gray-500">
                                            <span>{{ ucfirst($device->device_type ?? 'Unknown') }}</span>
                                            @if($device->ip_address)
                                                <span>•</span>
                                                <span>{{ $device->ip_address }}</span>
                                            @endif
                                            @if($device->location)
                                                <span>•</span>
                                                <span>{{ $device->location }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm text-gray-500">
                                        @if($device->last_active_at)
                                            {{ \Carbon\Carbon::parse($device->last_active_at)->diffForHumans() }}
                                        @else
                                            Tidak diketahui
                                        @endif
                                    </span>
                                    @if($device->last_active_at && \Carbon\Carbon::parse($device->last_active_at)->gt(\Carbon\Carbon::now()->subHour()))
                                        <span class="block text-xs text-green-600 font-medium">● Aktif sekarang</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-8 text-center text-gray-500">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-lg font-medium text-gray-900 mb-1">Tidak ada perangkat aktif</p>
                            <p class="text-sm">Perangkat akan muncul saat Anda login</p>
                        </div>
                    @endif
                </div>
                @if($devices && count($devices) > 0)
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('security.index') }}" class="text-[#128AEB] text-sm font-medium hover:underline">Lihat semua aktivitas →</a>
                        <span class="text-xs text-gray-500 last-updated">Terakhir diperbarui: {{ now()->diffForHumans() }}</span>
                    </div>
                @endif
            </section>

            {{-- Recent Login Activities --}}
            <section class="mb-8">
                <h2 class="text-2xl font-semibold text-slate-800 mb-6">Aktivitas Login Terbaru</h2>
                <div class="bg-white rounded-xl border border-neutral-200 divide-y divide-neutral-200">
                    @if($recentActivities && count($recentActivities) > 0)
                        @foreach($recentActivities as $activity)
                            <div class="p-4 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <span class="p-2 {{ $activity->login_status === 'success' ? 'bg-green-50' : 'bg-red-50' }} rounded-lg">
                                        @if($activity->login_status === 'success')
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @endif
                                    </span>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">
                                            {{ $activity->login_status === 'success' ? 'Login Berhasil' : 'Login Gagal' }}
                                        </p>
                                        <div class="flex items-center gap-2 text-sm text-gray-500">
                                            @if($activity->ip_address)
                                                <span>{{ $activity->ip_address }}</span>
                                            @endif
                                            @if($activity->device_type)
                                                <span>•</span>
                                                <span>{{ ucfirst($activity->device_type) }}</span>
                                            @endif
                                            @if($activity->browser)
                                                <span>•</span>
                                                <span>{{ $activity->browser }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($activity->login_at)->format('d M Y, H:i') }}
                                    </span>
                                    @if($activity->is_suspicious)
                                        <span class="block text-xs text-orange-600 font-medium">⚠ Mencurigakan</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="p-8 text-center text-gray-500">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-lg font-medium text-gray-900 mb-1">Tidak ada aktivitas login</p>
                            <p class="text-sm">Aktivitas login Anda akan muncul di sini</p>
                        </div>
                    @endif
                </div>
                @if($recentActivities && count($recentActivities) > 0)
                    <div class="mt-4">
                        <a href="{{ route('security.index') }}" class="text-[#128AEB] text-sm font-medium hover:underline">Lihat semua aktivitas login →</a>
                    </div>
                @endif
            </section>

            {{-- Preferences --}}
            <section>
                <h2 class="text-2xl font-semibold text-slate-800 mb-6">Preferensi</h2>
                <div class="bg-white rounded-xl border border-neutral-200 p-6">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-medium text-slate-900">Notifikasi Email</h3>
                                <p class="text-sm text-gray-500">Terima update dan informasi penting via email</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" {{ ($user->communication_preferences['marketing_emails'] ?? true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#128AEB]"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-medium text-slate-900">Notifikasi Produk</h3>
                                <p class="text-sm text-gray-500">Terima informasi tentang produk dan layanan baru</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" {{ ($user->communication_preferences['product_notifications'] ?? true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#128AEB]"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-medium text-slate-900">Profil Publik</h3>
                                <p class="text-sm text-gray-500">Tampilkan profil Anda di direktori publik</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" {{ ($user->privacy_settings['public_profile'] ?? false) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#128AEB]"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-medium text-slate-900">Status Online</h3>
                                <p class="text-sm text-gray-500">Tampilkan status online Anda kepada pengguna lain</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" {{ ($user->privacy_settings['show_online_status'] ?? true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#128AEB]"></div>
                            </label>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('profile.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-[#128AEB] bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Kelola Semua Preferensi
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Scripts --}}
    @push('scripts')
        <script>
            let refreshInterval;
            let isPageVisible = true;
            let fastRefreshMode = false;
            let fastRefreshCount = 0;

            {{-- Handle page visibility for efficient refreshing --}}
            document.addEventListener('visibilitychange', function() {
                isPageVisible = !document.hidden;
                if (isPageVisible) {
                    refreshAccountData();
                    startAutoRefresh();
                } else {
                    stopAutoRefresh();
                }
            });

            {{-- Handle preference toggles --}}
            document.addEventListener('DOMContentLoaded', function() {
                const toggles = document.querySelectorAll('input[type="checkbox"]');
                
                toggles.forEach(toggle => {
                    toggle.addEventListener('change', function() {
                        {{-- Visual feedback --}}
                        const label = this.closest('label');
                        const toggleDiv = label.querySelector('div');
                        
                        if (this.checked) {
                            toggleDiv.classList.add('peer-checked:bg-[#128AEB]');
                            {{-- Show success message --}}
                            showToast('Pengaturan berhasil disimpan', 'success');
                        } else {
                            showToast('Pengaturan berhasil diperbarui', 'info');
                        }
                    });
                });

                {{-- Add loading states to cards --}}
                const cards = document.querySelectorAll('.card-hover');
                cards.forEach(card => {
                    card.addEventListener('click', function(e) {
                        const link = this.querySelector('a');
                        if (link && e.target.closest('a')) {
                            {{-- Add loading state --}}
                            const loadingSpinner = document.createElement('div');
                            loadingSpinner.className = 'inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full animate-spin ml-2';
                            link.appendChild(loadingSpinner);
                        }
                    });
                });

                {{-- Initialize tooltips for security score --}}
                const securityBadge = document.querySelector('.security-badge');
                if (securityBadge) {
                    securityBadge.setAttribute('title', 'Skor keamanan dihitung berdasarkan profil, langganan, dan aktivitas Anda');
                }

                {{-- Start auto-refresh --}}
                startAutoRefresh();
                
                {{-- Initial data refresh --}}
                setTimeout(refreshAccountData, 1000);

                {{-- Force refresh if URL has refresh parameter --}}
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('refresh') || urlParams.has('force_refresh')) {
                    enableFastRefresh();
                    forceRefreshAll();
                }
            });

            {{-- Enable fast refresh mode for detecting changes --}}
            function enableFastRefresh() {
                fastRefreshMode = true;
                fastRefreshCount = 0;
                stopAutoRefresh();
                startFastRefresh();
            }

            {{-- Start fast refresh (every 5 seconds for 1 minute) --}}
            function startFastRefresh() {
                if (refreshInterval) clearInterval(refreshInterval);
                
                refreshInterval = setInterval(function() {
                    if (isPageVisible) {
                        refreshAccountData();
                        fastRefreshCount++;
                        
                        {{-- Switch back to normal refresh after 12 attempts (1 minute) --}}
                        if (fastRefreshCount >= 12) {
                            fastRefreshMode = false;
                            stopAutoRefresh();
                            startAutoRefresh();
                        }
                    }
                }, 5000); // Refresh every 5 seconds
            }

            {{-- Auto-refresh account data --}}
            function startAutoRefresh() {
                if (refreshInterval) clearInterval(refreshInterval);
                
                {{-- Normal refresh every 30 seconds when page is visible --}}
                refreshInterval = setInterval(function() {
                    if (isPageVisible) {
                        refreshAccountData();
                    }
                }, 30000);
            }

            function stopAutoRefresh() {
                if (refreshInterval) {
                    clearInterval(refreshInterval);
                    refreshInterval = null;
                }
            }

            {{-- Force refresh all data with cache busting --}}
            function forceRefreshAll() {
                const timestamp = Date.now();
                Promise.all([
                    fetch('{{ route("api.security-score") }}?_t=' + timestamp).then(response => response.json()),
                    fetch('{{ route("api.device-data") }}?_t=' + timestamp).then(response => response.json()),
                    fetch('{{ route("api.recent-activities") }}?_t=' + timestamp).then(response => response.json())
                ]).then(results => {
                    console.log('Force refresh completed:', results);
                    updateUIWithFreshData(results);
                    showToast('Data berhasil diperbarui', 'success');
                }).catch(error => {
                    console.error('Force refresh error:', error);
                    showToast('Gagal memperbarui data', 'error');
                });
            }

            {{-- Update UI with fresh data --}}
            function updateUIWithFreshData(results) {
                const [securityData, deviceData, activityData] = results;

                // Update security score
                if (securityData.success) {
                    updateSecurityScore(securityData.data);
                }

                // Update device data
                if (deviceData.success) {
                    updateDeviceCount(deviceData.data);
                }

                // Update recent activities
                if (activityData.success) {
                    updateActivityTimestamps(activityData.data.activities);
                }
            }

            {{-- Update device count in UI --}}
            function updateDeviceCount(deviceData) {
                const deviceCountElements = document.querySelectorAll('.device-count');
                deviceCountElements.forEach(element => {
                    const oldCount = element.textContent;
                    const newCount = deviceData.stats.total_devices;
                    
                    if (oldCount !== newCount.toString()) {
                        element.textContent = newCount;
                        // Add visual feedback for changes
                        element.style.color = '#ef4444'; // Red color
                        setTimeout(() => {
                            element.style.color = '';
                        }, 2000);
                    }
                });
            }

            {{-- Update security score in UI --}}
            function updateSecurityScore(securityData) {
                const scoreElement = document.querySelector('.security-badge');
                const statusElement = document.querySelector('.security-status');
                
                if (scoreElement) {
                    scoreElement.textContent = securityData.score + '/100';
                    
                    // Update badge color based on score
                    scoreElement.className = scoreElement.className.replace(/bg-(green|yellow|red)-500\/20 text-(green|yellow|red)-100/g, '');
                    if (securityData.score >= 80) {
                        scoreElement.classList.add('bg-green-500/20', 'text-green-100');
                    } else if (securityData.score >= 60) {
                        scoreElement.classList.add('bg-yellow-500/20', 'text-yellow-100');
                    } else {
                        scoreElement.classList.add('bg-red-500/20', 'text-red-100');
                    }
                }
                
                if (statusElement) {
                    statusElement.textContent = securityData.level;
                }

                const overviewScoreElement = document.querySelector('.overview-security-score');
                if (overviewScoreElement) {
                    overviewScoreElement.textContent = securityData.score + '/100';
                }
            }

            {{-- Refresh account data function --}}
            function refreshAccountData() {
                Promise.all([
                    refreshSecurityScore(),
                    refreshDeviceData(),
                    refreshRecentActivities()
                ]).catch(error => {
                    console.error('Error refreshing account data:', error);
                });
            }

            {{-- Refresh security score --}}
            function refreshSecurityScore() {
                return fetch('{{ route("api.security-score") }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const scoreElement = document.querySelector('.security-badge');
                            const statusElement = document.querySelector('.security-status');
                            
                            if (scoreElement) {
                                scoreElement.textContent = data.data.score + '/100';
                                
                                {{-- Update badge color based on score --}}
                                scoreElement.className = scoreElement.className.replace(/bg-(green|yellow|red)-500\/20 text-(green|yellow|red)-100/g, '');
                                if (data.data.score >= 80) {
                                    scoreElement.classList.add('bg-green-500/20', 'text-green-100');
                                } else if (data.data.score >= 60) {
                                    scoreElement.classList.add('bg-yellow-500/20', 'text-yellow-100');
                                } else {
                                    scoreElement.classList.add('bg-red-500/20', 'text-red-100');
                                }
                            }
                            
                            if (statusElement) {
                                statusElement.textContent = data.data.level;
                            }

                            {{-- Update security score in overview section --}}
                            const overviewScoreElement = document.querySelector('.overview-security-score');
                            if (overviewScoreElement) {
                                overviewScoreElement.textContent = data.data.score + '/100';
                            }
                        }
                    });
            }

            {{-- Refresh device data --}}
            function refreshDeviceData() {
                return fetch('{{ route("api.device-data") }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            {{-- Update device count --}}
                            const deviceCountElements = document.querySelectorAll('.device-count');
                            deviceCountElements.forEach(element => {
                                element.textContent = data.data.stats.total_devices;
                            });

                            {{-- Update active devices count --}}
                            const activeDevicesElement = document.querySelector('.active-devices-count');
                            if (activeDevicesElement) {
                                activeDevicesElement.textContent = data.data.stats.active_now;
                            }

                            {{-- Update last activity timestamp --}}
                            updateTimestamps();
                        }
                    });
            }

            {{-- Refresh recent activities --}}
            function refreshRecentActivities() {
                return fetch('{{ route("api.recent-activities") }}?limit=5')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.data.activities.length > 0) {
                            {{-- Update recent activities section if needed --}}
                            updateActivityTimestamps(data.data.activities);
                        }
                    });
            }

            {{-- Update timestamps to be more current --}}
            function updateTimestamps() {
                const timestampElements = document.querySelectorAll('[data-timestamp]');
                timestampElements.forEach(element => {
                    const timestamp = element.getAttribute('data-timestamp');
                    if (timestamp) {
                        element.textContent = timeAgo(new Date(timestamp));
                    }
                });

                {{-- Update "last updated" text --}}
                const lastUpdatedElements = document.querySelectorAll('.last-updated');
                lastUpdatedElements.forEach(element => {
                    element.textContent = 'Terakhir diperbarui: Baru saja';
                });
            }

            {{-- Update activity timestamps --}}
            function updateActivityTimestamps(activities) {
                activities.forEach((activity, index) => {
                    const timeElement = document.querySelector(`.activity-time-${index}`);
                    if (timeElement) {
                        timeElement.textContent = activity.time_ago;
                    }
                });
            }

            {{-- Time ago helper function --}}
            function timeAgo(date) {
                const now = new Date();
                const diffInSeconds = Math.floor((now - date) / 1000);
                
                if (diffInSeconds < 60) return 'Baru saja';
                if (diffInSeconds < 3600) return Math.floor(diffInSeconds / 60) + ' menit yang lalu';
                if (diffInSeconds < 86400) return Math.floor(diffInSeconds / 3600) + ' jam yang lalu';
                return Math.floor(diffInSeconds / 86400) + ' hari yang lalu';
            }

            {{-- Toast notification function --}}
            function showToast(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 transform transition-all duration-300 translate-x-full`;
                
                switch(type) {
                    case 'success':
                        toast.classList.add('bg-green-500');
                        break;
                    case 'error':
                        toast.classList.add('bg-red-500');
                        break;
                    default:
                        toast.classList.add('bg-blue-500');
                }
                
                toast.textContent = message;
                document.body.appendChild(toast);
                
                {{-- Animate in --}}
                setTimeout(() => {
                    toast.classList.remove('translate-x-full');
                }, 100);
                
                {{-- Remove after 3 seconds --}}
                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                    setTimeout(() => {
                        if (document.body.contains(toast)) {
                            document.body.removeChild(toast);
                        }
                    }, 300);
                }, 3000);
            }

            {{-- Cleanup on page unload --}}
            window.addEventListener('beforeunload', function() {
                stopAutoRefresh();
            });
        </script>
    @endpush

@endsection
