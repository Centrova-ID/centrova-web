@extends('partials.layouts.account')

{{-- Styles --}}
@push('styles')
    {{-- Add CSS for smooth scrolling with offset --}}
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 40px;
        }

        {{-- Alternative method for older browsers --}}
        .profile-section {
            scroll-margin-top: 40px;
        }
    </style>
@endpush

@section('content')

    {{-- Main Content --}}
    <div class="bg-white min-h-screen">
        <div class="w-full md:max-w-7xl mx-auto px-4 md:px-8 py-8 flex-1">
            
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 flex-1">
                {{-- Sidebar Navigation --}}
                @include('auth.components.sidebarNavigation')

                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Intro Konten --}}
                    <div>
                        @stack('intro-section')
                    </div>
                    
                    <div class="space-y-6">
                        @yield('section')
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
