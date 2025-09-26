@extends('partials.layouts.main')

@section('content')
<section class="w-full h-[400px] bg-black">
    <img src="https://images.pexels.com/photos/7477693/pexels-photo-7477693.jpeg?cs=srgb&dl=pexels-kampus-production-7477693.jpg&fm=jpg" class="w-full h-full object-cover opacity-80">
</section>

<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-6xl font-bold text-center text-neutral-800">Centrova Support</h1>
    </div>
</div>

<div class="w-full grid grid-cols-3 gap-5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 lg:py-8">
    <button class="flex-col px-6 py-4 text-left group">
        <h1 class="font-semibold mb-3 text-xl group-hover:underline">Forgot your Centrova Account password?</h1>
        <p>Reset your password to regain access to your Centrova Account.</p>
    </button>
    <button class="flex-col px-6 py-4 text-left group">
        <h1 class="font-semibold mb-3 text-xl group-hover:underline">Reinstall Centrova Retail</h1>
        <p>You can use C-Retail Recovery to reinstall the Windows operating system without removing your personal data.</p>
    </button>
    <button class="flex-col px-6 py-4 text-left group">
        <h1 class="font-semibold mb-3 text-xl group-hover:underline">Back up your Centrova</h1>
        <p>Connect an external storage device to your Cenntrova and you can use Time Machine to automatically back up your data.</p>
    </button>
</div>
@endsection