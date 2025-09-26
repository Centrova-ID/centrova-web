@extends('partials.layouts.account')

@include('partials.navbar.account')

@section('title', 'Pembatalan Layanan')

@section('content')
<div class="min-h-[calc(100vh-4rem)]">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-[#128AEB] rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">Pembatalan Layanan</h1>
                    <p class="text-slate-600 mt-1">Kelola dan batalkan layanan yang sedang berlangsung</p>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 rounded-xl border border-green-100">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <p class="text-green-600 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 rounded-xl border border-red-100">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <p class="text-red-600 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Service Status Check -->
        @if($activeOrders->isEmpty() && $serviceOrders->isEmpty())
            <!-- No Services State -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-3">Tidak Ada Layanan Aktif</h3>
                <p class="text-slate-600 mb-6 max-w-md mx-auto">
                    Anda belum memiliki layanan yang sedang berlangsung atau pernah memesan layanan dari kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('services.index') }}" class="inline-flex items-center px-6 py-3 bg-[#128AEB] text-white rounded-full hover:bg-[#0F76C6] transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Pesan Layanan
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-white text-slate-700 rounded-full border border-slate-300 hover:bg-slate-50 transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>

        @else
            <!-- Active Services Section -->
            @if($activeOrders->isNotEmpty())
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Layanan Aktif (Dapat Dibatalkan)</h2>
                    <div class="grid gap-6">
                        @foreach($activeOrders as $order)
                            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h3 class="text-lg font-semibold text-slate-900 mb-1">{{ $order->service_name }}</h3>
                                                <p class="text-slate-600 text-sm mb-2">{{ $order->description ?? 'Tidak ada deskripsi' }}</p>
                                                <div class="flex items-center space-x-4 text-sm text-slate-500">
                                                    <span>Order ID: #{{ $order->id }}</span>
                                                    <span>•</span>
                                                    <span>{{ $order->created_at->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $order->status_badge }}">
                                                    {{ $order->status_text }}
                                                </span>
                                                <span class="text-lg font-semibold text-slate-900 mt-2">
                                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        @if($order->details)
                                            <div class="bg-slate-50 rounded-lg p-4 mb-4">
                                                <h4 class="font-medium text-slate-900 mb-2">Detail Layanan:</h4>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-slate-600">
                                                    @foreach($order->details as $key => $value)
                                                        <div>
                                                            <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                            <span>{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row gap-3 lg:ml-6">
                                        <a href="{{ route('services.cancellation.show', $order->id) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition font-medium text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Lihat Detail
                                        </a>
                                        @if($order->canBeCancelled())
                                            <button onclick="showCancelModal({{ $order->id }}, '{{ $order->service_name }}')" 
                                                    class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-medium text-sm">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Batalkan
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Completed Services Section -->
            @if($completedOrders->isNotEmpty())
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-slate-900 mb-4">Riwayat Layanan</h2>
                    <div class="grid gap-4">
                        @foreach($completedOrders as $order)
                            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h3 class="text-lg font-semibold text-slate-900 mb-1">{{ $order->service_name }}</h3>
                                                <p class="text-slate-600 text-sm mb-2">{{ $order->description ?? 'Tidak ada deskripsi' }}</p>
                                                <div class="flex items-center space-x-4 text-sm text-slate-500">
                                                    <span>Order ID: #{{ $order->id }}</span>
                                                    <span>•</span>
                                                    <span>{{ $order->created_at->format('d M Y') }}</span>
                                                    @if($order->completed_at)
                                                        <span>•</span>
                                                        <span>Selesai: {{ $order->completed_at->format('d M Y') }}</span>
                                                    @endif
                                                    @if($order->cancelled_at)
                                                        <span>•</span>
                                                        <span>Dibatalkan: {{ $order->cancelled_at->format('d M Y') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium {{ $order->status_badge }}">
                                                    {{ $order->status_text }}
                                                </span>
                                                <span class="text-lg font-semibold text-slate-900 mt-2">
                                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        @if($order->cancellation_reason)
                                            <div class="mt-4 p-3 bg-red-50 rounded-lg">
                                                <p class="text-sm text-red-700">
                                                    <span class="font-medium">Alasan Pembatalan:</span> {{ $order->cancellation_reason }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="lg:ml-6 mt-4 lg:mt-0">
                                        <a href="{{ route('services.cancellation.show', $order->id) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition font-medium text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <!-- Info Section -->
        <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Informasi Pembatalan Layanan</h3>
                    <ul class="text-blue-800 text-sm space-y-1">
                        <li>• Layanan hanya dapat dibatalkan jika masih dalam status "Menunggu Konfirmasi" atau "Sedang Dikerjakan"</li>
                        <li>• Pembatalan akan diproses dalam 1-2 hari kerja setelah ajuan diterima</li>
                        <li>• Pengembalian dana akan mengikuti kebijakan refund yang berlaku</li>
                        <li>• Tim kami akan menghubungi Anda untuk konfirmasi pembatalan</li>
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('contact') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Butuh bantuan? Hubungi customer service
                        </a>
                    </div>
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
