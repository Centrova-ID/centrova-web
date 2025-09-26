@extends('layouts.app')

@section('title', 'Authorize Application')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <!-- Application Info -->
            <div class="text-center mb-6">
                @if($client->logo_url)
                    <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" class="mx-auto h-12 w-12 rounded-lg">
                @else
                    <div class="mx-auto h-12 w-12 bg-blue-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ substr($client->name, 0, 2) }}</span>
                    </div>
                @endif
                <h2 class="mt-4 text-xl font-bold text-gray-900">
                    Authorize {{ $client->name }}
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    This application is requesting access to your Centrova account
                </p>
            </div>

            <!-- User Info -->
            <div class="bg-gray-50 rounded-md p-4 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @if(auth()->user()->avatar_url)
                            <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="h-10 w-10 rounded-full">
                        @else
                            <div class="h-10 w-10 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-medium">{{ substr(auth()->user()->name, 0, 2) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Permissions -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-3">
                    {{ $client->name }} would like to:
                </h3>
                <ul class="space-y-2">
                    @foreach($scopes as $scope)
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 h-4 w-4 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ml-2 text-sm text-gray-700">{{ $scope->description }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Application Details -->
            @if($client->website_url || $client->privacy_policy_url || $client->terms_of_service_url)
                <div class="mb-6 text-sm text-gray-600">
                    <p class="mb-2">By authorizing this application, you agree to:</p>
                    <div class="space-y-1">
                        @if($client->website_url)
                            <p>• Visit <a href="{{ $client->website_url }}" target="_blank" class="text-blue-600 hover:underline">{{ $client->website_url }}</a></p>
                        @endif
                        @if($client->privacy_policy_url)
                            <p>• Read their <a href="{{ $client->privacy_policy_url }}" target="_blank" class="text-blue-600 hover:underline">Privacy Policy</a></p>
                        @endif
                        @if($client->terms_of_service_url)
                            <p>• Agree to their <a href="{{ $client->terms_of_service_url }}" target="_blank" class="text-blue-600 hover:underline">Terms of Service</a></p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <form method="POST" action="{{ route('oauth.approve') }}">
                @csrf
                <input type="hidden" name="client_id" value="{{ $params['client_id'] }}">
                <input type="hidden" name="redirect_uri" value="{{ $params['redirect_uri'] }}">
                <input type="hidden" name="scope" value="{{ $params['scope'] ?? '' }}">
                <input type="hidden" name="state" value="{{ $params['state'] ?? '' }}">
                <input type="hidden" name="code_challenge" value="{{ $params['code_challenge'] ?? '' }}">
                <input type="hidden" name="code_challenge_method" value="{{ $params['code_challenge_method'] ?? '' }}">

                <div class="flex space-x-4">
                    <button type="submit" name="action" value="approve" 
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md text-sm transition duration-150 ease-in-out">
                        Authorize
                    </button>
                    <button type="submit" name="action" value="deny" 
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md text-sm transition duration-150 ease-in-out">
                        Cancel
                    </button>
                </div>
            </form>

            <!-- Security Notice -->
            <div class="mt-6 text-xs text-gray-500 text-center">
                <p>This authorization is secured by Centrova OAuth 2.0</p>
                <p>You can revoke access anytime from your account settings</p>
            </div>
        </div>
    </div>
</div>
@endsection
