@extends('partials.layouts.main')

@section('content')
<section class="w-full h-[400px] bg-black relative flex justify-center items-center">
    <img src="{{ asset('assets/image/support/hero-banner-support-home_image_large_2x.jpg') }}" class="w-full object-cover bottom-0 absolute">
    <div class="flex flex-col z-10 text-center">
        <h2 class="text-5xl font-medium text-slate-800 mb-2">Selamat Datang di Dukungan Centrova</h2>
        <h5 class="text-2xl font-medium text-slate-800">Ada yang bisa kami bantu?</h5>
        <input type="text" name="search" class="w-full mt-4 outline-none p-3 hover:border-[#128aeb] hover:border-2 transition-all bg-white border border-neutral-300 rounded-xl h-12">
    </div>
</section>

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