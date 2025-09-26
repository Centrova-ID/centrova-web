@extends('partials.layouts.legal')

@section('title', 'Kebijakan Cookie')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Cookie Policy</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-gray-600 text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="space-y-8">
            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. What Are Cookies</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Cookies are small text files that are stored on your computer or mobile device when you visit our website. They help us make the site work better for you and allow us to improve our services.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Types of Cookies We Use</h2>
                <div class="prose prose-lg max-w-none text-gray-700 space-y-6">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2.1 Essential Cookies</h3>
                        <p>These cookies are necessary for the website to function properly. They enable core functionality such as security, network management, and accessibility.</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2.2 Performance Cookies</h3>
                        <p>These cookies collect information about how you use our website, helping us understand which pages are most popular and how visitors move around the site.</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2.3 Functionality Cookies</h3>
                        <p>These cookies allow the website to remember choices you make and provide enhanced features.</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">2.4 Targeting Cookies</h3>
                        <p>These cookies are used to deliver advertisements more relevant to you and your interests.</p>
                    </div>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Managing Cookies</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>You can control and/or delete cookies as you wish. You can delete all cookies that are already on your computer and you can set most browsers to prevent them from being placed.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Your Choices</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>When you first visit our website, you will be presented with a cookie banner that allows you to:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Accept all cookies</li>
                        <li>Reject non-essential cookies</li>
                        <li>Manage cookie preferences</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Updates to This Policy</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>We may update this Cookie Policy from time to time. Any changes will be posted on this page with an updated revision date.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Contact Information</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>If you have any questions about our Cookie Policy, please contact us at:</p>
                    <div class="mt-4 space-y-2">
                        <p><strong>Email:</strong> privacy@centrova.com</p>
                        <p><strong>Address:</strong> [Your Company Address]</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
