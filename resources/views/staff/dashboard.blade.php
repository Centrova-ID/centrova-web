@extends('partials.layouts.office')

@section('title', 'Dashboard')
@section('page-title', 'Activity')

@section('content')
<div class="h-full">
    {{-- Main Dashboard Content --}}
    <div class="px-8 py-6 space-y-6">

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @if($staff->isAdmin())
            {{-- Total Staff --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM9 9a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-600">Total Staff</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ \App\Models\User::whereNotNull('role')->where('role', '!=', 'customer')->count() }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Active Staff --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-r from-green-600 to-green-700 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-600">Active Staff</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ \App\Models\User::whereNotNull('role')->where('role', '!=', 'customer')->where('status', 'active')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Current Time --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-600">Local Time</p>
                        <p class="text-2xl font-bold text-gray-900" id="dashboard-time">
                            {{ now()->format('g:i A') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Account Status --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-gray-600">Account Status</p>
                        <p class="text-2xl font-bold text-emerald-600 capitalize">
                            {{ $staff->status }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $staff->name }} logged in</p>
                            <p class="text-sm text-gray-500">{{ optional($staff->last_login_at)->format('M d, Y g:i A') ?: 'First time login' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Dashboard accessed</p>
                            <p class="text-sm text-gray-500">{{ now()->format('M d, Y g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('rightPanel')
<div class="p-6 space-y-6">
    {{-- User Profile Card --}}
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
        <div class="text-center">
            <div class="h-20 w-20 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <span class="text-white font-bold text-2xl">
                    {{ substr($staff->name, 0, 1) }}
                </span>
            </div>
            <h3 class="text-lg font-bold text-gray-900">{{ $staff->name }}</h3>
            <p class="text-sm text-blue-600 font-medium">{{ ucfirst(str_replace('_', ' ', $staff->role)) }}</p>
        </div>
        
        <div class="mt-6 space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Status</span>
                <span class="text-sm font-medium text-emerald-600 capitalize">{{ $staff->status }}</span>
            </div>
            @if($staff->last_login_at)
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Last Login</span>
                <span class="text-sm font-medium text-gray-900">{{ optional($staff->last_login_at)->format('M d, g:i A') }}</span>
            </div>
            @endif
        </div>
    </div>

    {{-- Permissions --}}
    @if($staff->isAdmin())
    <div class="space-y-4">
        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Can act on accounts with these roles:</h4>
        <div class="space-y-2">
            <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                <div class="h-4 w-4 text-blue-600">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-blue-700">Administrator</span>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="h-4 w-4 text-gray-400">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="7" fill="currentColor"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">People Manager</span>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="h-4 w-4 text-gray-400">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="7" fill="currentColor"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">Device Enrollment Manager</span>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="h-4 w-4 text-gray-400">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="7" fill="currentColor"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">Content Manager</span>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="h-4 w-4 text-gray-400">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="7" fill="currentColor"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">Staff</span>
            </div>
        </div>
    </div>
    @endif

    {{-- Quick Actions --}}
    <div class="space-y-4">
        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Quick Actions</h4>
        <div class="space-y-2">
            <a href="{{ route('staff.profile.index') }}" 
               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="h-8 w-8 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">Edit Profile</span>
            </a>
            
            @if($staff->isAdmin())
            <a href="{{ route('staff.management') }}" 
               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="h-8 w-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">Manage Staff</span>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Update current time every minute
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString([], {hour: 'numeric', minute:'2-digit', hour12: true});
        const dashboardTimeEl = document.getElementById('dashboard-time');
        
        if (dashboardTimeEl) dashboardTimeEl.textContent = timeString;
    }
    
    // Update immediately and then every minute
    updateTime();
    setInterval(updateTime, 60000);
</script>
@endpush
@endsection
