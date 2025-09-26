@extends('partials.layouts.account')

@section('title', 'Domain Saya - Centrova')

@push('styles')
<style>
    [x-cloak] { display: none !important; }
    .domain-card:hover { transform: translateY(-2px); }
    .status-badge { @apply px-3 py-1 rounded-full text-sm font-medium; }
    .status-active { @apply bg-green-100 text-green-800; }
    .status-pending { @apply bg-yellow-100 text-yellow-800; }
    .status-expired { @apply bg-red-100 text-red-800; }
    .status-cancelled { @apply bg-gray-100 text-gray-800; }
</style>
@endpush

@section('content')

<div class="min-h-screen bg-gray-50 py-8" x-data="domainDashboard()">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-[#0B3C70]">Domain Saya</h1>
                    <p class="text-gray-600 mt-2">Kelola domain dan pengaturan DNS Anda</p>
                </div>
                <a href="{{ route('domain.search.index') }}" 
                   class="bg-[#128AEB] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#0f7bc4] transition-all inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Daftarkan Domain Baru
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-[#128AEB] rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Domain</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_domains'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Domain Aktif</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['active_domains'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Akan Expired</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['expiring_soon'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Domain Expired</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['expired_domains'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Notifications -->
        @if($recentNotifications->count() > 0)
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Notifikasi Terbaru</h3>
            <div class="space-y-3">
                @foreach($recentNotifications as $notification)
                <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                    <div class="flex-shrink-0">
                        @if($notification->type === 'expiry_reminder')
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        @elseif($notification->type === 'renewal_success')
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        @else
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM12 8v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">{{ $notification->title }}</p>
                        <p class="text-sm text-gray-500">{{ $notification->message }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Domain List -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Daftar Domain</h3>
                    <div class="flex items-center space-x-3">
                        <select x-model="statusFilter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-[#128AEB] focus:ring-0">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="pending">Pending</option>
                            <option value="expired">Expired</option>
                        </select>
                        <input 
                            type="text" 
                            x-model="searchTerm" 
                            placeholder="Cari domain..." 
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-[#128AEB] focus:ring-0"
                        >
                    </div>
                </div>
            </div>

            @if($domains->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($domains as $domain)
                <div class="p-6 hover:bg-gray-50 transition-colors domain-item" 
                     data-domain="{{ $domain->domain_name }}" 
                     data-status="{{ $domain->status }}">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $domain->domain_name }}</h4>
                                <span class="status-badge status-{{ $domain->status }}">
                                    {{ ucfirst($domain->status) }}
                                </span>
                                @if($domain->isExpiringSoon())
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                    Akan Expired
                                </span>
                                @endif
                                @if($domain->auto_renew)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                    Auto-Renew
                                </span>
                                @endif
                                @if($domain->privacy_protection)
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">
                                    Privacy Protected
                                </span>
                                @endif
                            </div>
                            <div class="mt-2 text-sm text-gray-500 space-y-1">
                                <p>Terdaftar: {{ $domain->registration_date->format('d M Y') }}</p>
                                <p>Expired: {{ $domain->formatted_expiry }} 
                                   @if(!$domain->isExpired())
                                   <span class="text-gray-400">({{ $domain->days_until_expiry }} hari lagi)</span>
                                   @endif
                                </p>
                                @if($domain->nameservers)
                                <p>Nameservers: {{ implode(', ', $domain->nameservers) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            @if($domain->isExpiringSoon() || $domain->isExpired())
                            <button @click="showRenewModal('{{ $domain->id }}')" 
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                                Perpanjang
                            </button>
                            @endif
                            <a href="{{ route('account.domains.show', $domain) }}" 
                               class="bg-[#128AEB] text-white px-4 py-2 rounded-lg hover:bg-[#0f7bc4] transition-colors text-sm font-medium">
                                Kelola
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Domain</h3>
                <p class="text-gray-500 mb-6">Anda belum memiliki domain yang terdaftar.</p>
                <a href="{{ route('domain.search.index') }}" 
                   class="inline-flex items-center bg-[#128AEB] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#0f7bc4] transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari Domain Sekarang
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Renewal Modal -->
    <div x-show="showRenewalModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-md w-full p-6" @click.away="showRenewalModal = false">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Perpanjang Domain</h3>
            <form @submit.prevent="renewDomain()">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Domain</label>
                        <p class="text-gray-900 font-medium" x-text="selectedDomain?.domain_name"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Perpanjangan</label>
                        <select x-model="renewalYears" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-[#128AEB] focus:ring-0">
                            <option value="1">1 tahun</option>
                            <option value="2">2 tahun</option>
                            <option value="3">3 tahun</option>
                            <option value="5">5 tahun</option>
                        </select>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between text-sm">
                            <span>Harga perpanjangan</span>
                            <span x-text="formatPrice(selectedDomain?.pricing?.renewal_price || 0)"></span>
                        </div>
                        <div class="flex justify-between font-medium">
                            <span>Total</span>
                            <span x-text="formatPrice((selectedDomain?.pricing?.renewal_price || 0) * renewalYears)"></span>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6">
                    <button type="button" @click="showRenewalModal = false" 
                            class="flex-1 bg-gray-100 text-gray-700 font-medium py-3 px-4 rounded-lg hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-[#128AEB] text-white font-medium py-3 px-4 rounded-lg hover:bg-[#0f7bc4] transition-colors">
                        Perpanjang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function domainDashboard() {
    return {
        statusFilter: '',
        searchTerm: '',
        showRenewalModal: false,
        selectedDomain: null,
        renewalYears: 1,

        init() {
            this.filterDomains();
            this.$watch('statusFilter', () => this.filterDomains());
            this.$watch('searchTerm', () => this.filterDomains());
        },

        filterDomains() {
            const items = document.querySelectorAll('.domain-item');
            
            items.forEach(item => {
                const domain = item.dataset.domain.toLowerCase();
                const status = item.dataset.status;
                
                const matchesSearch = domain.includes(this.searchTerm.toLowerCase());
                const matchesStatus = !this.statusFilter || status === this.statusFilter;
                
                if (matchesSearch && matchesStatus) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        },

        showRenewModal(domainId) {
            // In a real implementation, you would fetch domain details by ID
            // For now, we'll use placeholder data
            this.selectedDomain = {
                id: domainId,
                domain_name: 'example.com',
                pricing: {
                    renewal_price: 150000
                }
            };
            this.showRenewalModal = true;
        },

        async renewDomain() {
            try {
                const response = await fetch(`/account/domains/${this.selectedDomain.id}/renew`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        years: this.renewalYears
                    })
                });

                const data = await response.json();

                if (data.success) {
                    this.showRenewalModal = false;
                    location.reload(); // Refresh to show updated data
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                console.error('Renewal error:', error);
                alert('Terjadi kesalahan saat memperpanjang domain');
            }
        },

        formatPrice(amount) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
        }
    }
}
</script>
@endpush
