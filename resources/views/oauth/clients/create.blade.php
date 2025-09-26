@extends('layouts.app')

@section('title', 'Create OAuth Application')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                    Create Application
                </li>
            </ol>
        </nav>
        
        <div class="mt-4">
            <h1 class="text-3xl font-bold text-gray-900">Create OAuth Application</h1>
            <p class="mt-2 text-gray-600">Create a new OAuth 2.0 application to access Centrova APIs</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow rounded-lg">
        <form method="POST" action="{{ route('oauth.clients.store') }}" class="space-y-6 p-6">
            @csrf

            <!-- Application Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Application Name</label>
                <div class="mt-1">
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           required
                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                           placeholder="My Awesome App">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">A descriptive name for your application</p>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="mt-1">
                    <textarea name="description" 
                              id="description" 
                              rows="3"
                              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                              placeholder="Briefly describe what your application does...">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">Optional. Help users understand what your application does</p>
            </div>

            <!-- Redirect URIs -->
            <div>
                <label for="redirect_uris" class="block text-sm font-medium text-gray-700">Authorized Redirect URIs</label>
                <div class="mt-1" id="redirect-uris-container">
                    <div class="flex items-center space-x-2 mb-2">
                        <input type="url" 
                               name="redirect_uris[]" 
                               value="{{ old('redirect_uris.0') }}"
                               required
                               class="flex-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                               placeholder="https://yourapp.com/oauth/callback">
                        <button type="button" 
                                onclick="addRedirectUri()" 
                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @error('redirect_uris')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('redirect_uris.*')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500">URLs where users will be redirected after authorization. HTTPS required for production.</p>
            </div>

            <!-- Application Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Application Type</label>
                <div class="mt-2 space-y-4">
                    <div class="flex items-center">
                        <input id="confidential" 
                               name="is_confidential" 
                               type="radio" 
                               value="1" 
                               {{ old('is_confidential', '1') == '1' ? 'checked' : '' }}
                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                        <label for="confidential" class="ml-3">
                            <span class="text-sm font-medium text-gray-700">Confidential (Server-side apps)</span>
                            <span class="text-sm text-gray-500 block">Can securely store client secrets. Recommended for web applications.</span>
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input id="public" 
                               name="is_confidential" 
                               type="radio" 
                               value="0" 
                               {{ old('is_confidential') == '0' ? 'checked' : '' }}
                               class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                        <label for="public" class="ml-3">
                            <span class="text-sm font-medium text-gray-700">Public (Client-side apps)</span>
                            <span class="text-sm text-gray-500 block">Cannot securely store secrets. Use for SPAs, mobile apps.</span>
                        </label>
                    </div>
                </div>
                @error('is_confidential')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Scopes -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Requested Permissions</label>
                <div class="mt-2 space-y-3">
                    @foreach($scopes as $scope)
                        <div class="flex items-start">
                            <input id="scope_{{ $scope->scope }}" 
                                   name="scopes[]" 
                                   type="checkbox" 
                                   value="{{ $scope->scope }}"
                                   {{ $scope->is_default || in_array($scope->scope, old('scopes', [])) ? 'checked' : '' }}
                                   class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded mt-1">
                            <label for="scope_{{ $scope->scope }}" class="ml-3">
                                <span class="text-sm font-medium text-gray-700">{{ $scope->name }}</span>
                                @if($scope->is_default)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 ml-2">
                                        Default
                                    </span>
                                @endif
                                <span class="text-sm text-gray-500 block">{{ $scope->description }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('scopes')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Optional URLs -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information (Optional)</h3>
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Website URL -->
                    <div>
                        <label for="website_url" class="block text-sm font-medium text-gray-700">Website URL</label>
                        <div class="mt-1">
                            <input type="url" 
                                   name="website_url" 
                                   id="website_url" 
                                   value="{{ old('website_url') }}"
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   placeholder="https://yourapp.com">
                        </div>
                        @error('website_url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Privacy Policy URL -->
                    <div>
                        <label for="privacy_policy_url" class="block text-sm font-medium text-gray-700">Privacy Policy URL</label>
                        <div class="mt-1">
                            <input type="url" 
                                   name="privacy_policy_url" 
                                   id="privacy_policy_url" 
                                   value="{{ old('privacy_policy_url') }}"
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   placeholder="https://yourapp.com/privacy">
                        </div>
                        @error('privacy_policy_url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms of Service URL -->
                    <div>
                        <label for="terms_of_service_url" class="block text-sm font-medium text-gray-700">Terms of Service URL</label>
                        <div class="mt-1">
                            <input type="url" 
                                   name="terms_of_service_url" 
                                   id="terms_of_service_url" 
                                   value="{{ old('terms_of_service_url') }}"
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   placeholder="https://yourapp.com/terms">
                        </div>
                        @error('terms_of_service_url')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('oauth.clients.index') }}" 
                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Application
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addRedirectUri() {
    const container = document.getElementById('redirect-uris-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2';
    div.innerHTML = `
        <input type="url" 
               name="redirect_uris[]" 
               class="flex-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
               placeholder="https://yourapp.com/oauth/callback">
        <button type="button" 
                onclick="removeRedirectUri(this)" 
                class="inline-flex items-center px-3 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeRedirectUri(button) {
    button.parentElement.remove();
}
</script>
@endsection
