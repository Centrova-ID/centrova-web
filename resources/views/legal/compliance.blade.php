@extends('partials.layouts.legal')

@section('title', 'Kepatuhan')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Compliance</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-gray-600 text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="space-y-8">
            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Regulatory Compliance</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Centrova is committed to maintaining compliance with all applicable laws and regulations, including:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>General Data Protection Regulation (GDPR)</li>
                        <li>California Consumer Privacy Act (CCPA)</li>
                        <li>Payment Card Industry Data Security Standard (PCI DSS)</li>
                        <li>Other applicable data protection and privacy laws</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Security Standards</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>We maintain high security standards through:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Regular security audits</li>
                        <li>Encryption of sensitive data</li>
                        <li>Secure data centers</li>
                        <li>Employee security training</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Data Protection</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Our data protection measures include:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Data encryption at rest and in transit</li>
                        <li>Regular backup procedures</li>
                        <li>Access control and authentication</li>
                        <li>Incident response procedures</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Certifications</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Centrova maintains the following certifications:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>ISO 27001</li>
                        <li>SOC 2 Type II</li>
                        <li>PCI DSS Level 1</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Reporting Concerns</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>If you have compliance concerns or want to report a violation, please contact our compliance team.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Contact Information</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>For compliance matters, please contact:</p>
                    <div class="mt-4 space-y-2">
                        <p><strong>Email:</strong> compliance@centrova.com</p>
                        <p><strong>Address:</strong> [Your Company Address]</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
