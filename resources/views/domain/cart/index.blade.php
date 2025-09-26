@extends('partials.layouts.main')

@section('title', 'Keranjang Domain - Centrova')

@push('styles')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')

<div class="min-h-screen bg-gray-50 py-12" x-data="domainCart()">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-[#0B3C70] mb-4">Keranjang Domain</h1>
            <p class="text-gray-600">Review domain yang akan didaftarkan dan lanjutkan ke pembayaran</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                
                <!-- Empty Cart -->
                <div x-show="cartItems.length === 0" x-cloak class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l1.5-6M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Keranjang Kosong</h3>
                    <p class="text-gray-600 mb-6">Anda belum menambahkan domain ke keranjang.</p>
                    <a href="{{ route('domain.search.index') }}" 
                       class="inline-flex items-center bg-[#128AEB] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#0f7bc4] transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Domain
                    </a>
                </div>

                <!-- Cart Items List -->
                <div x-show="cartItems.length > 0" x-cloak class="space-y-4">
                    <template x-for="(item, index) in cartItems" :key="item.domain">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            
                            <!-- Item Header -->
                            <div class="p-6 border-b border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900" x-text="item.domain"></h3>
                                        <p class="text-sm text-gray-500" x-text="item.tld.toUpperCase() + ' Domain'"></p>
                                    </div>
                                    <button @click="removeFromCart(item.domain)" 
                                            class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-full transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Item Details -->
                            <div class="p-6 space-y-6">
                                
                                <!-- Duration Selection -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Registrasi</label>
                                        <select @change="updateCartItem(item.domain, { years: $event.target.value })"
                                                x-model="item.years"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-[#128AEB] focus:ring-0">
                                            <template x-for="year in Array.from({length: 10}, (_, i) => i + 1)" :key="year">
                                                <option :value="year" x-text="year + ' tahun'"></option>
                                            </template>
                                        </select>
                                    </div>

                                    <!-- Privacy Protection -->
                                    <div class="flex items-center space-x-3 pt-6">
                                        <input 
                                            type="checkbox" 
                                            :id="'privacy-' + index"
                                            x-model="item.privacy_protection"
                                            @change="updateCartItem(item.domain, { privacy_protection: $event.target.checked })"
                                            class="w-4 h-4 text-[#128AEB] border-gray-300 rounded focus:ring-[#128AEB]"
                                        >
                                        <label :for="'privacy-' + index" class="text-sm text-gray-700">
                                            Privacy Protection
                                            <span class="text-gray-500" x-text="'(+Rp ' + formatNumber(item.privacy_price) + '/tahun)'"></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Price Breakdown -->
                                <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Harga registrasi</span>
                                        <span x-text="'Rp ' + formatNumber(item.registration_price) + ' x ' + item.years + ' tahun'"></span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Subtotal registrasi</span>
                                        <span x-text="'Rp ' + formatNumber(item.total_registration_price)"></span>
                                    </div>
                                    <div x-show="item.privacy_protection && item.total_privacy_price > 0" class="flex justify-between text-sm">
                                        <span class="text-gray-600">Privacy protection</span>
                                        <span x-text="'Rp ' + formatNumber(item.total_privacy_price)"></span>
                                    </div>
                                    <div class="border-t border-gray-200 pt-3">
                                        <div class="flex justify-between font-semibold">
                                            <span>Total</span>
                                            <span class="text-[#128AEB]" x-text="'Rp ' + formatNumber(item.total_price)"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Order Summary -->
            <div x-show="cartItems.length > 0" x-cloak class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Domain (<span x-text="totals.item_count"></span> item)</span>
                            <span x-text="totals.formatted.subtotal"></span>
                        </div>
                        
                        <div x-show="totals.privacy_total > 0" class="flex justify-between">
                            <span class="text-gray-600">Privacy Protection</span>
                            <span x-text="totals.formatted.privacy_total"></span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-600">PPN (11%)</span>
                            <span x-text="totals.formatted.tax_amount"></span>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between text-xl font-bold">
                                <span>Total</span>
                                <span class="text-[#128AEB]" x-text="totals.formatted.total"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <button @click="proceedToCheckout()" 
                                :disabled="processingCheckout"
                                class="w-full bg-[#128AEB] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#0f7bc4] disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                            <span x-show="!processingCheckout">Lanjutkan ke Pembayaran</span>
                            <span x-show="processingCheckout" class="flex items-center justify-center">
                                <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                        
                        <a href="{{ route('domain.search.index') }}" 
                           class="w-full bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg hover:bg-gray-200 transition-all text-center block">
                            Tambah Domain Lain
                        </a>
                        
                        <button @click="clearCart()" 
                                class="w-full text-red-600 font-medium py-2 hover:text-red-800 transition-all">
                            Kosongkan Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function domainCart() {
    return {
        cartItems: @json(array_values($cart)),
        totals: @json($totals),
        processingCheckout: false,

        init() {
            // Watch for cart updates
            this.$watch('cartItems', () => {
                this.updateTotals();
            });
        },

        async updateCartItem(domain, updates) {
            try {
                const response = await fetch('/domain/cart/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        domain: domain,
                        ...updates
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Update the specific cart item
                    const itemIndex = this.cartItems.findIndex(item => item.domain === domain);
                    if (itemIndex !== -1) {
                        this.cartItems[itemIndex] = data.cart_item;
                    }
                    this.totals = data.totals;
                } else {
                    this.showError(data.message);
                }
            } catch (error) {
                console.error('Update cart error:', error);
                this.showError('Terjadi kesalahan saat memperbarui keranjang');
            }
        },

        async removeFromCart(domain) {
            if (!confirm('Apakah Anda yakin ingin menghapus domain ini dari keranjang?')) {
                return;
            }

            try {
                const response = await fetch('/domain/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ domain: domain })
                });

                const data = await response.json();

                if (data.success) {
                    this.cartItems = this.cartItems.filter(item => item.domain !== domain);
                    this.totals = data.totals;
                    this.showSuccess(data.message);
                } else {
                    this.showError(data.message);
                }
            } catch (error) {
                console.error('Remove from cart error:', error);
                this.showError('Terjadi kesalahan saat menghapus domain');
            }
        },

        async clearCart() {
            if (!confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
                return;
            }

            try {
                const response = await fetch('/domain/cart/clear', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    this.cartItems = [];
                    this.totals = data.totals;
                    this.showSuccess(data.message);
                } else {
                    this.showError(data.message);
                }
            } catch (error) {
                console.error('Clear cart error:', error);
                this.showError('Terjadi kesalahan saat mengosongkan keranjang');
            }
        },

        async proceedToCheckout() {
            if (this.cartItems.length === 0) {
                this.showError('Keranjang kosong');
                return;
            }

            this.processingCheckout = true;

            try {
                // Redirect to checkout page
                window.location.href = '{{ route("domain.checkout.index") }}';
            } catch (error) {
                console.error('Checkout error:', error);
                this.showError('Terjadi kesalahan saat memproses checkout');
                this.processingCheckout = false;
            }
        },

        updateTotals() {
            // This will be called when cartItems change
            // In a real implementation, you might want to recalculate totals here
        },

        formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        },

        showSuccess(message) {
            // Implement toast notification
            alert(message);
        },

        showError(message) {
            // Implement toast notification
            alert(message);
        }
    }
}
</script>
@endpush
