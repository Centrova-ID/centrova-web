@extends('layouts.app')

@section('title', $client->name . ' - OAuth Application')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('oauth.clients.index') }}" class="text-gray-400 hover:text-gray-500">
                        OAuth Applications
                    </a>
                </li>
                <li>
                    <svg class="flex-shrink-0 h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </li>
                <li class="text-gray-900 font-medium">
                    {{ $client->name }}
                </li>
            </ol>
        </nav>
        
        <div class="mt-4 sm:flex sm:items-center sm:justify-between">
            <div class="flex items-center">
                @if($client->logo_url)
                    <img src="{{ $client->logo_url }}" alt="{{ $client->name }}" class="w-16 h-16 rounded-lg mr-4">
                @else
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-white font-bold text-xl">{{ substr($client->name, 0, 2) }}</span>
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $client->name }}</h1>
                    @if($client->description)
                        <p class="mt-2 text-gray-600">{{ $client->description }}</p>
                    @endif
                    <div class="mt-2 flex items-center space-x-4">
                        @if($client->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-1.5 h-1.5 mr-1.5 fill-current" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"/>
                                </svg>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <svg class="w-1.5 h-1.5 mr-1.5 fill-current" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"/>
                                </svg>
                                Inactive
                            </span>
                        @endif
                        <span class="text-sm text-gray-500">
                            Created {{ $client->created_at->format('M j, Y') }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <a href="{{ route('oauth.clients.edit', $client) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form method="POST" action="{{ route('oauth.clients.toggle-status', $client) }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 {{ $client->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} font-medium rounded-md transition">
                        {{ $client->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Client Credentials -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Credentials -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Client Credentials</h3>
                    
                    <div class="space-y-4">
                        <!-- Client ID -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Client ID</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" 
                                       value="{{ $client->client_id }}" 
                                       readonly
                                       class="flex-1 min-w-0 block w-full px-3 py-2 border-gray-300 rounded-l-md bg-gray-50 text-sm">
                                <button onclick="copyToClipboard('{{ $client->client_id }}')" 
                                        class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 text-gray-500 hover:bg-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Use this in your OAuth requests</p>
                        </div>

                        <!-- Client Secret -->
                        @if($client->is_confidential)
                            <div>
                                <div class="flex items-center justify-between">
                                    <label class="block text-sm font-medium text-gray-700">Client Secret</label>
                                    <form method="POST" action="{{ route('oauth.clients.regenerate-secret', $client) }}" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure? This will invalidate all existing tokens.')"
                                                class="text-xs text-blue-600 hover:text-blue-500">
                                            Regenerate
                                        </button>
                                    </form>
                                </div>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="password" 
                                           id="clientSecret"
                                           value="{{ session('show_secret') ? $client->client_secret : '••••••••••••••••••••' }}" 
                                           readonly
                                           class="flex-1 min-w-0 block w-full px-3 py-2 border-gray-300 rounded-l-md bg-gray-50 text-sm">
                                    <button onclick="toggleSecretVisibility()" 
                                            class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 hover:bg-gray-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eyeIcon">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button onclick="copyToClipboard('{{ $client->client_secret }}')" 
                                            class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 rounded-r-md bg-gray-50 text-gray-500 hover:bg-gray-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="mt-1 text-sm text-red-600">Keep this secret! Don't share it publicly.</p>
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-3">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            This is a public client. No client secret is required for authentication.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Configuration -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Configuration</h3>
                    
                    <!-- Redirect URIs -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Authorized Redirect URIs</h4>
                        <div class="space-y-2">
                            @foreach($client->redirect_uris as $uri)
                                <div class="flex items-center p-2 bg-gray-50 rounded-md">
                                    <code class="flex-1 text-sm text-gray-800">{{ $uri }}</code>
                                    <button onclick="copyToClipboard('{{ $uri }}')" 
                                            class="ml-2 text-gray-400 hover:text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Scopes -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Granted Permissions</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($scopes as $scope)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $scope->is_default ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $scope->name }}
                                    @if($scope->is_default)
                                        <svg class="ml-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('oauth.clients.tokens', $client) }}" 
                           class="block w-full text-left px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-md transition">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-3a1 1 0 011-1h2.586l6.243-6.243A6 6 0 1121 9z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">View Active Tokens</span>
                            </div>
                        </a>
                        
                        <form method="POST" action="{{ route('oauth.clients.destroy', $client) }}" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure? This will permanently delete the application and revoke all tokens.')"
                                    class="block w-full text-left px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-md transition">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="text-sm font-medium">Delete Application</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Integration Guide -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Integration Guide</h3>
                    
                    <div class="space-y-4 text-sm">
                        <div>
                            <h4 class="font-medium text-gray-900">1. Authorization URL</h4>
                            <code class="block mt-1 p-2 bg-gray-100 rounded text-xs break-all">
                                {{ route('oauth.authorize') }}?response_type=code&client_id={{ $client->client_id }}&redirect_uri=YOUR_REDIRECT_URI&scope=openid+profile+email
                            </code>
                        </div>
                        
                        <div>
                            <h4 class="font-medium text-gray-900">2. Token Exchange URL</h4>
                            <code class="block mt-1 p-2 bg-gray-100 rounded text-xs">
                                POST {{ route('oauth.token') }}
                            </code>
                        </div>
                        
                        <div>
                            <h4 class="font-medium text-gray-900">3. User Info URL</h4>
                            <code class="block mt-1 p-2 bg-gray-100 rounded text-xs">
                                GET {{ route('oauth.userinfo') }}
                            </code>
                        </div>
                        
                        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-500 text-sm">
                            View Full Documentation
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success feedback
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded-md shadow-lg z-50';
        toast.textContent = 'Copied to clipboard!';
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2000);
    });
}

function toggleSecretVisibility() {
    const input = document.getElementById('clientSecret');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (input.type === 'password') {
        input.type = 'text';
        input.value = '{{ $client->client_secret }}';
    } else {
        input.type = 'password';
        input.value = '••••••••••••••••••••';
    }
}
</script>
@endsection
