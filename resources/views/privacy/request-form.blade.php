<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Request Form - Centrova</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                    <span class="text-white font-semibold text-sm">C</span>
                </div>
                <h1 class="text-xl font-semibold text-gray-900">Centrova</h1>
            </div>
        </div>
    </header>

    <div class="min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Privacy Request Form</h1>
                <p class="text-lg text-gray-600">Submit a request regarding your personal data privacy</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
            <div class="mb-8 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Privacy Request Form -->
            <div class="bg-white rounded-lg border border-gray-200 p-8">
                <form method="POST" action="{{ route('privacy.request.submit') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                        
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                                <input type="text" 
                                       name="customer_name" 
                                       id="customer_name" 
                                       value="{{ old('customer_name') }}"
                                       required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500 @error('customer_name') border-red-300 @enderror">
                                @error('customer_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700">Email Address *</label>
                                <input type="email" 
                                       name="customer_email" 
                                       id="customer_email" 
                                       value="{{ old('customer_email') }}"
                                       required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500 @error('customer_email') border-red-300 @enderror">
                                @error('customer_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number (Optional)</label>
                                <input type="tel" 
                                       name="phone" 
                                       id="phone" 
                                       value="{{ old('phone') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            </div>
                            
                            <div>
                                <label for="account_reference" class="block text-sm font-medium text-gray-700">Account Reference (Optional)</label>
                                <input type="text" 
                                       name="account_reference" 
                                       id="account_reference" 
                                       value="{{ old('account_reference') }}"
                                       placeholder="Customer ID, Order Number, etc."
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Request Details -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Privacy Request Details</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="request_type" class="block text-sm font-medium text-gray-700">Type of Request *</label>
                                <select name="request_type" 
                                        id="request_type" 
                                        required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500 @error('request_type') border-red-300 @enderror">
                                    <option value="">Select a request type...</option>
                                    @foreach(App\Models\PrivacyRequest::getRequestTypes() as $key => $label)
                                        <option value="{{ $key }}" {{ old('request_type') === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('request_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Request Type Descriptions -->
                            <div id="request-descriptions" class="hidden">
                                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                                    <div id="data_access_desc" class="request-desc hidden">
                                        <h4 class="text-sm font-medium text-blue-900">Data Access Request</h4>
                                        <p class="text-sm text-blue-800 mt-1">Request a copy of all personal data we hold about you. We will provide this within 30 days.</p>
                                    </div>
                                    <div id="data_deletion_desc" class="request-desc hidden">
                                        <h4 class="text-sm font-medium text-blue-900">Data Deletion Request</h4>
                                        <p class="text-sm text-blue-800 mt-1">Request deletion of your personal data. Note that some data may need to be retained for legal purposes.</p>
                                    </div>
                                    <div id="data_portability_desc" class="request-desc hidden">
                                        <h4 class="text-sm font-medium text-blue-900">Data Portability Request</h4>
                                        <p class="text-sm text-blue-800 mt-1">Request your data in a structured, machine-readable format to transfer to another service.</p>
                                    </div>
                                    <div id="consent_withdrawal_desc" class="request-desc hidden">
                                        <h4 class="text-sm font-medium text-blue-900">Consent Withdrawal</h4>
                                        <p class="text-sm text-blue-800 mt-1">Withdraw your consent for specific data processing activities.</p>
                                    </div>
                                    <div id="data_correction_desc" class="request-desc hidden">
                                        <h4 class="text-sm font-medium text-blue-900">Data Correction</h4>
                                        <p class="text-sm text-blue-800 mt-1">Request correction of inaccurate or incomplete personal data.</p>
                                    </div>
                                    <div id="complaint_desc" class="request-desc hidden">
                                        <h4 class="text-sm font-medium text-blue-900">Privacy Complaint</h4>
                                        <p class="text-sm text-blue-800 mt-1">File a complaint about how your personal data has been handled.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Detailed Description *</label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="5" 
                                          required
                                          placeholder="Please provide a detailed description of your privacy request. Include any relevant information that will help us process your request efficiently."
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500 @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Minimum 10 characters required</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Legal Notice -->
                    <div class="bg-gray-50 border border-gray-200 rounded-md p-4">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Important Information</h4>
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li>• We will acknowledge your request within 24 hours</li>
                            <li>• Most requests are processed within 30 days as required by law</li>
                            <li>• We may need to verify your identity before processing your request</li>
                            <li>• You will receive updates via email throughout the process</li>
                        </ul>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">* Required fields</p>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Submit Privacy Request
                        </button>
                    </div>
                </form>
            </div>

            <!-- Status Check -->
            <div class="mt-12 bg-white rounded-lg border border-gray-200 p-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Check Request Status</h3>
                <p class="text-sm text-gray-600 mb-4">Already submitted a request? Check its status here using your reference ID and email.</p>
                
                <form method="POST" action="{{ route('privacy.request.status') }}" class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    @csrf
                    <div>
                        <label for="reference_id" class="block text-sm font-medium text-gray-700">Reference ID</label>
                        <input type="number" 
                               name="reference_id" 
                               id="reference_id" 
                               placeholder="e.g., 12345"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               placeholder="your.email@example.com"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring-purple-500">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Check Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Centrova. All rights reserved.</p>
                <p class="mt-1">Your privacy is important to us. This form is secure and encrypted.</p>
            </div>
        </div>
    </footer>

    <script>
        // Show/hide request type descriptions
        document.getElementById('request_type').addEventListener('change', function() {
            const descriptions = document.getElementById('request-descriptions');
            const allDescs = document.querySelectorAll('.request-desc');
            
            // Hide all descriptions
            allDescs.forEach(desc => desc.classList.add('hidden'));
            
            if (this.value) {
                descriptions.classList.remove('hidden');
                const targetDesc = document.getElementById(this.value + '_desc');
                if (targetDesc) {
                    targetDesc.classList.remove('hidden');
                }
            } else {
                descriptions.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
