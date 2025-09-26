@extends('partials.layouts.main')

@section('title', 'Access Denied - Staff Area')

@section('navbar')
    @include('partials.navbar.main')
@endsection

@section('seoMetaTags')
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="description" content="Access denied to staff area. This area is restricted to staff members only."/>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="text-center">
        <div class="mb-6">
            <svg class="mx-auto h-20 w-20 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.768 0L3.146 16.5c2.376 18.333 3.334 20 4.876 20z" />
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Access Denied</h1>
        
        <div class="max-w-md mx-auto">
            <p class="text-lg text-gray-600 mb-6">
                {{ $message ?? 'You do not have permission to access this area.' }}
            </p>
            
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.768 0L3.146 16.5c2.376 18.333 3.334 20 4.876 20z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Access Strictly Forbidden</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p><strong>Customer accounts are not permitted to access the office area.</strong></p>
                            <p>This area is exclusively reserved for verified staff members only.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-3">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Return to Homepage
                </a>
                
                @if(Auth::check())
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout Current Account
                        </button>
                    </form>
                    
                    <div class="text-sm text-gray-500 mt-2">
                        Currently logged in as: <strong>{{ Auth::user()->email }}</strong>
                        <br>
                        Role: <span class="font-medium text-red-600">{{ ucfirst(Auth::user()->role ?? 'Customer') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
