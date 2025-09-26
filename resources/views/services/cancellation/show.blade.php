@extends('partials.layouts.account')

@include('partials.navbar.account')

@section('title', 'Detail Layanan - ' . $serviceOrder->service_name)

@section('content')
<div class="min-h-[calc(100vh-4rem)]">
    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-6">
                <a href="{{ route('services.cancellation.index') }}" class="mr-4 p-2 hover:bg-slate-100 rounded-lg transition">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Detail Layanan</h1>
                    <p class="text-slate-600 mt-1">Informasi lengkap tentang layanan Anda</p>
                </div>
            </div>
        </div>

        <!-- Service Details Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-[#128AEB] to-[#0F76C6] p-6 text-white">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">{{ $serviceOrder->service_name }}</h2>
                        <p class="text-blue-100 mb-4">{{ $serviceOrder->description ?? 'Tidak ada deskripsi' }}</p>
                        <div class="flex items-center space-x-4 text-sm text-blue-100">
                            <span>Order ID: #{{ $serviceOrder->id }}</span>
                            <span>•</span>
                            <span>Dibuat: {{ $serviceOrder->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 text-right">
                        <div class="mb-3">
                            <span class="inline-flex px-4 py-2 rounded-full text-sm font-medium bg-white/20 text-white">
                                {{ $serviceOrder->status_text }}
                            </span>
                        </div>
                        <div class="text-3xl font-bold">
                            Rp {{ number_format($serviceOrder->total_amount, 0, ',', '.') }}
                        </div>
                        <div class="text-blue-100 text-sm">
                            Pembayaran: {{ ucfirst($serviceOrder->payment_status) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6">
                
                <!-- Timeline Status -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Status Progress</h3>
                    <div class="relative">
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-slate-200"></div>
                        
                        <!-- Timeline Items -->
                        <div class="space-y-6">
                            <!-- Created -->
                            <div class="relative flex items-start">
                                <div class="flex items-center justify-center w-8 h-8 bg-green-500 rounded-full ring-4 ring-white relative z-10">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-slate-900">Pesanan Dibuat</h4>
                                    <p class="text-slate-600 text-sm">{{ $serviceOrder->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <!-- Started -->
                            @if($serviceOrder->started_at)
                                <div class="relative flex items-start">
                                    <div class="flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full ring-4 ring-white relative z-10">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-medium text-slate-900">Pengerjaan Dimulai</h4>
                                        <p class="text-slate-600 text-sm">{{ $serviceOrder->started_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="relative flex items-start">
                                    <div class="flex items-center justify-center w-8 h-8 bg-slate-300 rounded-full ring-4 ring-white relative z-10">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-medium text-slate-500">Menunggu Pengerjaan</h4>
                                        <p class="text-slate-400 text-sm">Belum dimulai</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Completed or Cancelled -->
                            @if($serviceOrder->completed_at)
                                <div class="relative flex items-start">
                                    <div class="flex items-center justify-center w-8 h-8 bg-green-500 rounded-full ring-4 ring-white relative z-10">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-medium text-slate-900">Layanan Selesai</h4>
                                        <p class="text-slate-600 text-sm">{{ $serviceOrder->completed_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            @elseif($serviceOrder->cancelled_at)
                                <div class="relative flex items-start">
                                    <div class="flex items-center justify-center w-8 h-8 bg-red-500 rounded-full ring-4 ring-white relative z-10">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-medium text-slate-900">Layanan Dibatalkan</h4>
                                        <p class="text-slate-600 text-sm">{{ $serviceOrder->cancelled_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="relative flex items-start">
                                    <div class="flex items-center justify-center w-8 h-8 bg-slate-300 rounded-full ring-4 ring-white relative z-10">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-medium text-slate-500">Menunggu Penyelesaian</h4>
                                        <p class="text-slate-400 text-sm">Dalam proses</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Service Details -->
                @if($serviceOrder->details)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Detail Spesifikasi</h3>
                        <div class="bg-slate-50 rounded-xl p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($serviceOrder->details as $key => $value)
                                    <div>
                                        <dt class="text-sm font-medium text-slate-600 mb-1">{{ ucfirst(str_replace('_', ' ', $key)) }}</dt>
                                        <dd class="text-sm text-slate-900">
                                            @if(is_array($value))
                                                <ul class="list-disc list-inside space-y-1">
                                                    @foreach($value as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{ $value }}
                                            @endif
                                        </dd>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Cancellation Info -->
                @if($serviceOrder->cancellation_reason)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Informasi Pembatalan</h3>
                        <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <div>
                                    <h4 class="font-medium text-red-900 mb-2">Alasan Pembatalan</h4>
                                    <p class="text-red-700">{{ $serviceOrder->cancellation_reason }}</p>
                                    <p class="text-red-600 text-sm mt-2">Dibatalkan pada: {{ $serviceOrder->cancelled_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-slate-200">
                    @if($serviceOrder->canBeCancelled())
                        <button onclick="showCancelModal({{ $serviceOrder->id }}, '{{ $serviceOrder->service_name }}')" 
                                class="inline-flex items-center justify-center px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batalkan Layanan
                        </button>
                    @endif
                    
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-[#128AEB] text-white rounded-lg hover:bg-[#0F76C6] transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Hubungi Customer Service
                    </a>
                    
                    <a href="{{ route('services.cancellation.index') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 bg-blue-50 rounded-xl p-6 border border-blue-100">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Butuh Bantuan?</h3>
                    <p class="text-blue-800 text-sm mb-3">
                        Jika Anda memiliki pertanyaan tentang layanan ini atau butuh bantuan lainnya, jangan ragu untuk menghubungi tim customer service kami.
                    </p>
                    <ul class="text-blue-800 text-sm space-y-1">
                        <li>• Email: support@centrova.id</li>
                        <li>• WhatsApp: +62 812-3456-7890</li>
                        <li>• Jam operasional: Senin-Jumat, 09:00-17:00 WIB</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancellation Modal -->
<div id="cancelModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="cancelForm" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Batalkan Layanan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500" id="cancelMessage">
                                    Apakah Anda yakin ingin membatalkan layanan ini? Tindakan ini tidak dapat dibatalkan.
                                </p>
                                <div class="mt-4">
                                    <label for="cancellation_reason" class="block text-sm font-medium text-gray-700">Alasan Pembatalan</label>
                                    <textarea 
                                        name="cancellation_reason" 
                                        id="cancellation_reason" 
                                        rows="4" 
                                        required
                                        placeholder="Jelaskan alasan Anda membatalkan layanan ini..."
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#128AEB] focus:border-[#128AEB] sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Batalkan Layanan
                    </button>
                    <button type="button" onclick="hideCancelModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showCancelModal(orderId, serviceName) {
    document.getElementById('cancelMessage').textContent = `Apakah Anda yakin ingin membatalkan layanan "${serviceName}"? Tindakan ini tidak dapat dibatalkan.`;
    document.getElementById('cancelForm').action = `/services/cancellation/${orderId}/cancel`;
    document.getElementById('cancelModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideCancelModal() {
    document.getElementById('cancelModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    document.getElementById('cancellation_reason').value = '';
}

// Close modal when clicking outside
document.getElementById('cancelModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideCancelModal();
    }
});
</script>

@endsection
