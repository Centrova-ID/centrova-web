@extends('partials.layouts.legal')

@section('title', 'Ketentuan Retail')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Retail Terms</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-gray-600 text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="space-y-8">
            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Retail Purchase Terms</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>These terms govern all retail purchases made through Centrova's platform or physical locations. By making a purchase, you agree to these terms.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Pricing and Payment</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <ul class="list-disc list-inside space-y-2">
                        <li>All prices are in the displayed currency and include applicable taxes</li>
                        <li>We accept major credit cards, debit cards, and other payment methods as specified</li>
                        <li>Prices are subject to change without notice</li>
                        <li>Payment must be received in full before products are shipped</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Shipping and Delivery</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <ul class="list-disc list-inside space-y-2">
                        <li>Standard shipping times apply unless otherwise specified</li>
                        <li>Shipping costs are calculated at checkout</li>
                        <li>Risk of loss transfers upon delivery</li>
                        <li>International shipping may incur additional fees</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Returns and Refunds</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Our return policy includes:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>30-day return window for most items</li>
                        <li>Items must be in original condition</li>
                        <li>Return shipping costs may apply</li>
                        <li>Refunds processed within 5-7 business days</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Warranty Information</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <ul class="list-disc list-inside space-y-2">
                        <li>Standard manufacturer warranties apply</li>
                        <li>Extended warranty options available</li>
                        <li>Warranty claims must be submitted with proof of purchase</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Customer Service</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>For retail-related inquiries, please contact our customer service team:</p>
                    <div class="mt-4 space-y-2">
                        <p><strong>Email:</strong> retail@centrova.com</p>
                        <p><strong>Phone:</strong> [Retail Support Phone Number]</p>
                        <p><strong>Hours:</strong> Monday-Friday, 9:00 AM - 6:00 PM EST</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
