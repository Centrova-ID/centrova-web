@extends('partials.layouts.legal')

@section('title', 'Hak Cipta')

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Copyright Notice</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-gray-600 text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>

        <div class="space-y-8">
            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Copyright Protection</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>© {{ date('Y') }} Centrova. All rights reserved. All content on this website, including but not limited to text, graphics, logos, icons, images, audio clips, digital downloads, and software, is the property of Centrova or its content suppliers and is protected by international copyright laws.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Permitted Use</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>You may access, download, or print materials from this website for your personal, non-commercial use only. Any other use of materials on this website, including reproduction for purposes other than those noted above, modification, distribution, or republication, without the prior written permission of Centrova is strictly prohibited.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Copyright Claims</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>If you believe that your work has been copied in a way that constitutes copyright infringement, please provide our copyright agent with the following information:</p>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Description of the copyrighted work claimed to have been infringed</li>
                        <li>Description of where the claimed infringing material is located</li>
                        <li>Your contact information</li>
                        <li>A statement that you have a good faith belief that use of the material is not authorized</li>
                        <li>A statement that the information is accurate and that you are authorized to act on behalf of the copyright owner</li>
                    </ul>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">4. DMCA Notices</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>We respond to notices of alleged copyright infringement in accordance with the Digital Millennium Copyright Act (DMCA). If you believe that your copyrighted work is being infringed, please send your notification to our designated copyright agent.</p>
                </div>
            </section>

            <section class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Contact Information</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>For copyright matters, please contact:</p>
                    <div class="mt-4 space-y-2">
                        <p><strong>Email:</strong> copyright@centrova.com</p>
                        <p><strong>Address:</strong> [Your Company Address]</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
