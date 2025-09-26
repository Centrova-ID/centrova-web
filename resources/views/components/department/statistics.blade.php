{{-- Department Statistics Component --}}
@props(['department', 'subDepartments'])

<div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-6 mt-6 border border-gray-200">
    <div class="text-sm font-medium text-gray-700 mb-4 text-center">Department Statistics</div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        {{-- Total Staff --}}
        <div class="text-center p-3 bg-white rounded-lg shadow-sm border border-blue-100">
            <div class="flex justify-center mb-2">
                <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-blue-600">{{ $department->staff_count }}</div>
            <div class="text-xs text-gray-500">Total Staff</div>
        </div>

        {{-- Sub-departments --}}
        <div class="text-center p-3 bg-white rounded-lg shadow-sm border border-green-100">
            <div class="flex justify-center mb-2">
                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-green-600">{{ $subDepartments->count() }}</div>
            <div class="text-xs text-gray-500">Sub-departments</div>
        </div>

        {{-- Active Staff --}}
        <div class="text-center p-3 bg-white rounded-lg shadow-sm border border-purple-100">
            <div class="flex justify-center mb-2">
                <svg class="h-6 w-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-purple-600">
                {{ $department->staff->where('status', 'active')->count() }}
            </div>
            <div class="text-xs text-gray-500">Active Staff</div>
        </div>

        {{-- Role Types --}}
        <div class="text-center p-3 bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="flex justify-center mb-2">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="text-2xl font-bold text-gray-600">
                {{ $department->staff->groupBy('role')->count() }}
            </div>
            <div class="text-xs text-gray-500">Role Types</div>
        </div>
    </div>

    {{-- Additional Statistics Row --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 pt-4 border-t border-gray-200">
        {{-- Department Age --}}
        @if($department->established_date)
        <div class="text-center">
            <div class="text-sm text-gray-500">Department Age</div>
            <div class="text-lg font-semibold text-gray-700">
                {{ $department->established_date->diffForHumans(null, true) }}
            </div>
        </div>
        @endif

        {{-- Budget Information --}}
        @if($department->budget)
        <div class="text-center">
            <div class="text-sm text-gray-500">Annual Budget</div>
            <div class="text-lg font-semibold text-gray-700">
                ${{ number_format($department->budget, 0) }}
            </div>
        </div>
        @endif

        {{-- Performance Indicator --}}
        <div class="text-center">
            <div class="text-sm text-gray-500">Staff Efficiency</div>
            <div class="text-lg font-semibold text-gray-700">
                @php
                    $efficiency = $department->staff_count > 0 ? 
                        round(($department->staff->where('status', 'active')->count() / $department->staff_count) * 100) : 0;
                @endphp
                <span class="
                    @if($efficiency >= 90) text-green-600
                    @elseif($efficiency >= 70) text-yellow-600
                    @else text-red-600
                    @endif
                ">{{ $efficiency }}%</span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Statistics animation */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .text-2xl {
        animation: countUp 0.8s ease-out;
    }
</style>
