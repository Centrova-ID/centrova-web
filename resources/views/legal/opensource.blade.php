@extends('partials.layouts.legal')

@section('title', 'Lisensi Open Source')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Open Source Software</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-gray-600 text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="space-y-8">
            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Our Commitment to Open Source</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Centrova believes in the power of open source software and actively participates in the open source community. We use various open source components in our products and contribute back to the community when possible.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Open Source Components</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Our software includes the following major open source components:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Laravel (MIT License)</li>
                        <li>Vue.js (MIT License)</li>
                        <li>TailwindCSS (MIT License)</li>
                        <li>Node.js (MIT License)</li>
                        <li>And various other open source packages</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. License Compliance</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>We are committed to complying with the terms of all open source licenses. Complete license texts for the open source software we use can be found in our software distributions or upon request.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Our Open Source Projects</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Centrova maintains several open source projects, including:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>[Project Name 1] - [Brief Description]</li>
                        <li>[Project Name 2] - [Brief Description]</li>
                        <li>[Project Name 3] - [Brief Description]</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Contributing</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>We welcome contributions to our open source projects. Please visit our GitHub repositories for contribution guidelines and more information.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Contact Information</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>For open source inquiries, please contact:</p>
                    <div class="mt-4 space-y-2">
                        <p><strong>Email:</strong> opensource@centrova.com</p>
                        <p><strong>GitHub:</strong> github.com/centrova</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
