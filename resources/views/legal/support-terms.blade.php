@extends('partials.layouts.legal')

@section('title', 'Syarat Dukungan Teknis')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Support Terms</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-gray-600 text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="space-y-8">
            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Support Services</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Centrova provides technical support services according to the following terms and conditions. These services may include:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Technical assistance via email, phone, or chat</li>
                        <li>Bug fixes and issue resolution</li>
                        <li>Product documentation and resources</li>
                        <li>Software updates and maintenance</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Support Hours</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Our support team is available during the following hours:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Monday to Friday: 9:00 AM - 6:00 PM (EST)</li>
                        <li>Extended support hours for premium customers</li>
                        <li>Emergency support available 24/7 for critical issues</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Service Level Agreements</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Response times vary based on issue severity and support plan:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Critical Issues: 1-2 hours</li>
                        <li>High Priority: 4-8 hours</li>
                        <li>Medium Priority: 1-2 business days</li>
                        <li>Low Priority: 3-5 business days</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Customer Responsibilities</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>To receive support, customers must:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Maintain active subscription or support contract</li>
                        <li>Provide accurate and complete information</li>
                        <li>Follow recommended troubleshooting steps</li>
                        <li>Maintain current software versions</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Exclusions</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Support services do not include:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Custom development work</li>
                        <li>Training services</li>
                        <li>Third-party software support</li>
                        <li>Hardware issues</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Contact Information</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>For support inquiries, please contact:</p>
                    <div class="mt-4 space-y-2">
                        <p><strong>Email:</strong> support@centrova.com</p>
                        <p><strong>Phone:</strong> [Support Phone Number]</p>
                        <p><strong>Support Portal:</strong> support.centrova.com</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
