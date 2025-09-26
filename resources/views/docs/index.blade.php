@extends('partials.layouts.docs')

@section('content')
<!-- Hero Section -->
    <div class="bg-neutral-100 relative z-0 overflow-hidden py-10 flex items-center">
        <div class="absolute inset-0 hidden">
            <img src="https://www.microsoft.com/en-us/powerplatformguide/images/h3.jpg"
                srcset="https://www.microsoft.com/en-us/powerplatformguide/images/h3.jpg"
                sizes="(max-width:768px) 600px, 1200px"
                width="1200" height="800"
                loading="lazy"
                alt="Digital Business Solutions"
                class="w-full h-full object-cover object-top opacity-70 max-md:opacity-30 max-md:object-right" />
        </div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 flex justify-center items-center">
            <div class="w-full text-left max-md:text-center z-10 text-slate-900">
                <h1 class="text-5xl leading-[54px] max-w-2xl font-medium max-md:text-3xl max-md:leading-snug mb-6">Kami menawarkan solusi terbaik untuk bisnis Anda</h1>
                <p class="text-xl text-neutral-700">Layanan pengembangan perangkat lunak yang efisien dan profesional.</p>
            </div>

            <div class="mr-10 flex-shrink-0">
               <div class="flex items-center max-md:hidden gap-x-2 flex-shrink-0">
                   <img src="{{ asset('assets/image/customer-profile/frisca.png') }}" srcset="{{ asset('assets/image/customer-profile/frisca.png') }}" class="h-[32px] aspect-square rounded-full">
                   <div class="flex flex-col items-center">
                       <span class="font-medium text-base -mb-1">Butuh Bantuan Kami?</span>
                       <button type="button" class="hover:underline text-[15px] text-blue-600 text-left w-full">Hubungi Spesialis</button>
                   </div>
               </div> 
            </div>
        </div>
    </div>
@endsection