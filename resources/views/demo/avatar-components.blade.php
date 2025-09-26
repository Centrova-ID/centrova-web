@extends('partials.layouts.account')

@section('content')
<div class="bg-white min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Avatar Components Demo</h1>
        
        {{-- User Avatar Component --}}
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">User Avatar Component</h2>
            
            {{-- Sizes --}}
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Ukuran Avatar</h3>
                <div class="flex items-center gap-4 flex-wrap">
                    <div class="text-center">
                        <x-user-avatar :user="auth()->user()" size="xs" />
                        <p class="text-xs text-gray-500 mt-2">XS (24px)</p>
                    </div>
                    <div class="text-center">
                        <x-user-avatar :user="auth()->user()" size="sm" />
                        <p class="text-xs text-gray-500 mt-2">SM (32px)</p>
                    </div>
                    <div class="text-center">
                        <x-user-avatar :user="auth()->user()" size="md" />
                        <p class="text-xs text-gray-500 mt-2">MD (48px)</p>
                    </div>
                    <div class="text-center">
                        <x-user-avatar :user="auth()->user()" size="lg" />
                        <p class="text-xs text-gray-500 mt-2">LG (64px)</p>
                    </div>
                    <div class="text-center">
                        <x-user-avatar :user="auth()->user()" size="xl" />
                        <p class="text-xs text-gray-500 mt-2">XL (80px)</p>
                    </div>
                    <div class="text-center">
                        <x-user-avatar :user="auth()->user()" size="2xl" />
                        <p class="text-xs text-gray-500 mt-2">2XL (96px)</p>
                    </div>
                    <div class="text-center">
                        <x-user-avatar :user="auth()->user()" size="3xl" />
                        <p class="text-xs text-gray-500 mt-2">3XL (128px)</p>
                    </div>
                </div>
            </div>
            
            {{-- With Name and Email --}}
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Avatar dengan Nama dan Email</h3>
                <div class="space-y-4">
                    <x-user-avatar 
                        :user="auth()->user()" 
                        size="md" 
                        :showName="true" 
                        class="p-4 bg-gray-50 rounded-lg"
                    />
                    <x-user-avatar 
                        :user="auth()->user()" 
                        size="lg" 
                        :showName="true" 
                        :showEmail="true" 
                        class="p-4 bg-gray-50 rounded-lg"
                    />
                </div>
            </div>
            
            {{-- Clickable --}}
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Avatar yang Bisa Diklik</h3>
                <x-user-avatar 
                    :user="auth()->user()" 
                    size="lg" 
                    :showName="true" 
                    clickable 
                    :href="route('profile.index')" 
                    class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors"
                />
            </div>
        </section>
        
        {{-- Chat Avatar Component --}}
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Chat Avatar Component</h2>
            
            {{-- Status Indicators --}}
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Status Indicators</h3>
                <div class="flex items-center gap-6 flex-wrap">
                    <div class="text-center">
                        <x-chat-avatar 
                            :user="auth()->user()" 
                            size="lg" 
                            :showStatus="true" 
                            status="online"
                        />
                        <p class="text-xs text-gray-500 mt-2">Online</p>
                    </div>
                    <div class="text-center">
                        <x-chat-avatar 
                            :user="auth()->user()" 
                            size="lg" 
                            :showStatus="true" 
                            status="away"
                        />
                        <p class="text-xs text-gray-500 mt-2">Away</p>
                    </div>
                    <div class="text-center">
                        <x-chat-avatar 
                            :user="auth()->user()" 
                            size="lg" 
                            :showStatus="true" 
                            status="busy"
                        />
                        <p class="text-xs text-gray-500 mt-2">Busy</p>
                    </div>
                    <div class="text-center">
                        <x-chat-avatar 
                            :user="auth()->user()" 
                            size="lg" 
                            :showStatus="true" 
                            status="offline"
                        />
                        <p class="text-xs text-gray-500 mt-2">Offline</p>
                    </div>
                </div>
            </div>
            
            {{-- Chat Sizes --}}
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Ukuran Chat Avatar</h3>
                <div class="flex items-center gap-4 flex-wrap">
                    <div class="text-center">
                        <x-chat-avatar :user="auth()->user()" size="xs" :showStatus="true" status="online" />
                        <p class="text-xs text-gray-500 mt-2">XS</p>
                    </div>
                    <div class="text-center">
                        <x-chat-avatar :user="auth()->user()" size="sm" :showStatus="true" status="online" />
                        <p class="text-xs text-gray-500 mt-2">SM</p>
                    </div>
                    <div class="text-center">
                        <x-chat-avatar :user="auth()->user()" size="md" :showStatus="true" status="online" />
                        <p class="text-xs text-gray-500 mt-2">MD</p>
                    </div>
                    <div class="text-center">
                        <x-chat-avatar :user="auth()->user()" size="lg" :showStatus="true" status="online" />
                        <p class="text-xs text-gray-500 mt-2">LG</p>
                    </div>
                    <div class="text-center">
                        <x-chat-avatar :user="auth()->user()" size="xl" :showStatus="true" status="online" />
                        <p class="text-xs text-gray-500 mt-2">XL</p>
                    </div>
                </div>
            </div>
        </section>
        
        {{-- Chat Message Component --}}
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Chat Message Component</h2>
            
            <div class="bg-gray-50 rounded-lg p-6 space-y-4">
                {{-- Message from other user --}}
                @php
                    $dummyMessage1 = (object) [
                        'message' => 'Halo! Bagaimana kabar Anda hari ini?',
                        'created_at' => now()->subMinutes(10)
                    ];
                    
                    $dummyUser = (object) [
                        'id' => 2,
                        'name' => 'Customer Service',
                        'email' => 'cs@centrova.com',
                        'profile_picture' => null
                    ];
                @endphp
                
                <x-chat-message 
                    :message="$dummyMessage1" 
                    :user="$dummyUser" 
                    :isOwn="false"
                />
                
                {{-- Message from current user --}}
                @php
                    $dummyMessage2 = (object) [
                        'message' => 'Baik sekali, terima kasih! Saya ingin menanyakan tentang layanan website development.',
                        'created_at' => now()->subMinutes(8)
                    ];
                @endphp
                
                <x-chat-message 
                    :message="$dummyMessage2" 
                    :user="auth()->user()" 
                    :isOwn="true"
                />
                
                {{-- Another message --}}
                @php
                    $dummyMessage3 = (object) [
                        'message' => 'Tentu saja! Kami akan senang membantu Anda. Mari kita diskusikan kebutuhan website Anda.',
                        'created_at' => now()->subMinutes(5)
                    ];
                @endphp
                
                <x-chat-message 
                    :message="$dummyMessage3" 
                    :user="$dummyUser" 
                    :isOwn="false"
                />
            </div>
        </section>
        
        {{-- Code Examples --}}
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Contoh Kode</h2>
            
            <div class="bg-gray-900 text-gray-100 rounded-lg p-4 overflow-x-auto">
                <pre><code>{{-- User Avatar --}}
&lt;x-user-avatar :user="$user" size="lg" :showName="true" /&gt;

{{-- Chat Avatar dengan Status --}}
&lt;x-chat-avatar :user="$user" size="md" :showStatus="true" status="online" /&gt;

{{-- Chat Message --}}
&lt;x-chat-message :message="$message" :user="$user" :isOwn="false" /&gt;</code></pre>
            </div>
        </section>
        
        {{-- Generated Avatars with Different IDs --}}
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Generated Avatars (Berbeda User ID)</h2>
            <div class="flex items-center gap-4 flex-wrap">
                @for($i = 1; $i <= 10; $i++)
                    <div class="text-center">
                        <x-user-avatar :userId="$i" size="lg" />
                        <p class="text-xs text-gray-500 mt-2">ID {{ $i }}</p>
                    </div>
                @endfor
            </div>
        </section>
    </div>
</div>
@endsection
