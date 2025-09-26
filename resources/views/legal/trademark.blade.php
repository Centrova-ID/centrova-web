@extends('partials.layouts.legal')

@section('title', 'Kebijakan Merek Dagang')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Trademark Policy</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-gray-600 text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="space-y-8">
            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Our Trademarks</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>Centrova™ and related marks, logos, and designs are trademarks or registered trademarks of Centrova and may not be used without permission.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Proper Use of Trademarks</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>When referring to our trademarks:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Use the appropriate trademark symbol (™ or ®)</li>
                        <li>Use trademarks as adjectives, not nouns</li>
                        <li>Do not alter or modify our trademarks</li>
                        <li>Do not incorporate our trademarks into your own</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Prohibited Uses</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>You may not use our trademarks:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>In a misleading or disparaging way</li>
                        <li>In a way that implies sponsorship or endorsement</li>
                        <li>As part of a domain name without permission</li>
                        <li>In advertising without proper authorization</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Reporting Violations</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>If you become aware of any improper use or infringement of our trademarks, please report it to our legal department.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Contact Information</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>For trademark inquiries, please contact:</p>
                    <div class="mt-4 space-y-2">
                        <p><strong>Email:</strong> trademarks@centrova.com</p>
                        <p><strong>Address:</strong> [Your Company Address]</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
