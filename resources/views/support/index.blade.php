@extends('partials.layouts.main')

@section('style-css')
    <style type="text/tailwindcss">
        .help-menu-main div {
            @apply w-44 aspect-[2/1.4] rounded-xl ring-1 ring-neutral-300 hover:ring-[#128aeb] p-2 flex flex-col justify-between items-center transition;
        }

        .help-menu-main span {
            @apply w-full h-full flex justify-center items-center;
        }

        .help-menu-main img {
            @apply h-20;
        }

        .help-menu-main h3 {
            @apply w-full text-center;
        }
    </style>
@endsection

@section('content')
<section class="w-full h-[400px] bg-black relative flex justify-center items-center">
    <img src="{{ asset('assets/image/support/hero-banner-support-home_image_large_2x.jpg') }}" class="w-full object-cover bottom-0 absolute">
    <div class="flex flex-col z-10 text-center">
        <h2 class="text-4xl font-medium text-slate-800 mb-3">Selamat Datang di Dukungan Centrova</h2>
        <h5 class="text-2xl font-normal text-slate-800">Ada yang bisa kami bantu?</h5>
        <input type="text" name="search" class="w-full mt-5 outline-none p-3 hover:ring-[#128aeb] hover:ring-2 transition-all bg-white ring-1 ring-neutral-300 rounded-xl h-12" placeholder="Jelaskan masalah Anda">
    </div>
</section>

{{-- Centrova Help --}}
<div class="w-full flex justify-center items-center gap-5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 lg:py-8">
    <a href="#" class="help-menu-main">
        <div>
            <span>
                <img src="https://lh3.googleusercontent.com/o9U8AvPuX9gkIYtYfNmH-_wBdTfOJ7jb0VwbLWWbERzml7oTPngODhKv2Br7A64=w64">
            </span>
            <h3>Akun Centrova</h3>
        </div>
    </a>
    <a href="#" class="help-menu-main">
        <div>
            <span>
                <img src="https://lh3.googleusercontent.com/o9U8AvPuX9gkIYtYfNmH-_wBdTfOJ7jb0VwbLWWbERzml7oTPngODhKv2Br7A64=w64">
            </span>
            <h3>Akun Centrova</h3>
        </div>
    </a>
    <a href="#" class="help-menu-main">
        <div>
            <span>
                <img src="https://lh3.googleusercontent.com/o9U8AvPuX9gkIYtYfNmH-_wBdTfOJ7jb0VwbLWWbERzml7oTPngODhKv2Br7A64=w64">
            </span>
            <h3>Akun Centrova</h3>
        </div>
    </a>
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