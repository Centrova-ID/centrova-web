{{-- Linked Accounts Section --}}
<div id="linked-accounts-section" class="profile-section bg-white rounded-2xl border border-neutral-200">
    {{-- Header --}}
    <div class="flex justify-between items-center px-6 py-3">
        <h3 class="text-lg font-medium text-slate-900">Akun Terkait</h3>
        <button onclick="showAccountSwitcher()" class="text-[#128AEB] text-base font-medium">
            Kelola Akun
        </button>
    </div>
    
    {{-- Content --}}
    <div class="border-t border-neutral-200/80">
        <div class="px-6 py-4">
            <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h4 class="text-sm font-medium text-blue-900">Fitur Multi-Account</h4>
                </div>
                <p class="text-sm text-blue-700">
                    Anda dapat login ke beberapa akun Centrova secara bersamaan dan beralih antar akun dengan mudah tanpa perlu logout.
                </p>
            </div>

            {{-- Current Account Info --}}
            <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100">
                            @if($user->profile_picture)
                                @if(str_starts_with($user->profile_picture, 'assets/illustrations/'))
                                    <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                                @endif
                            @else
                                @php
                                    $colors = [
                                        '#3B82F6', '#8B5CF6', '#EF4444', '#10B981', '#F59E0B',
                                        '#EC4899', '#6366F1', '#84CC16', '#F97316', '#06B6D4',
                                        '#8B5A2B', '#DC2626', '#7C3AED', '#059669', '#D97706',
                                        '#BE185D', '#4F46E5', '#65A30D', '#EA580C', '#0891B2'
                                    ];
                                    $colorIndex = $user->id % count($colors);
                                    $bgColor = $colors[$colorIndex];
                                    $initials = substr(collect(explode(' ', $user->name))->map(fn($word) => substr($word, 0, 1))->implode(''), 0, 2);
                                    $svgAvatar = "data:image/svg+xml;base64," . base64_encode('
                                        <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="40" height="40" fill="' . $bgColor . '"/>
                                            <text x="20" y="20" font-family="Arial, sans-serif" font-size="16" font-weight="400" text-anchor="middle" dominant-baseline="central" fill="white">' . $initials . '</text>
                                        </svg>
                                    ');
                                @endphp
                                <img src="{{ $svgAvatar }}" alt="Profile Avatar" class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                            Akun Aktif
                        </span>
                    </div>
                </div>
            </div>

            {{-- Linked Accounts List (will be populated by JavaScript) --}}
            <div id="profile-linked-accounts-list" class="space-y-3">
                {{-- Will be populated by JavaScript --}}
            </div>

            {{-- Add Account Button --}}
            <div class="mt-4">
                <button 
                    onclick="showAccountSwitcher()" 
                    class="w-full flex items-center justify-center space-x-2 px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-[#128AEB] hover:text-[#128AEB] transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span class="text-sm font-medium">Tambah Akun Lain</span>
                </button>
            </div>

            {{-- Info Text --}}
            <div class="mt-4 text-xs text-gray-500">
                <p>• Anda dapat login hingga 5 akun secara bersamaan</p>
                <p>• Beralih antar akun tanpa perlu memasukkan password ulang</p>
                <p>• Logout dari salah satu akun tidak mempengaruhi akun lainnya</p>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript untuk update linked accounts di profile --}}
<script>
// Update linked accounts list in profile page
function updateProfileLinkedAccounts() {
    if (!accountSwitcherData || !accountSwitcherData.linked_accounts) return;

    const linkedAccountsList = document.getElementById('profile-linked-accounts-list');
    if (!linkedAccountsList) return;

    linkedAccountsList.innerHTML = '';

    // Show other linked accounts (not the current active one)
    const otherAccounts = accountSwitcherData.linked_accounts.filter(account => !account.is_active);
    
    if (otherAccounts.length === 0) {
        linkedAccountsList.innerHTML = `
            <div class="text-center py-4 text-gray-500">
                <p class="text-sm">Belum ada akun lain yang terhubung</p>
            </div>
        `;
        return;
    }

    otherAccounts.forEach(account => {
        const accountDiv = document.createElement('div');
        accountDiv.className = 'p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors';
        
        accountDiv.innerHTML = `
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-600 font-medium text-xs">${getInitials(account.name)}</span>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">${account.name}</p>
                    <p class="text-xs text-gray-500">${account.email}</p>
                </div>
                <div class="flex-shrink-0 flex space-x-2">
                    <button onclick="switchToAccount(${account.id})" class="text-xs text-[#128AEB] hover:text-[#0F76C6] font-medium">
                        Switch
                    </button>
                    <button onclick="removeAccount(${account.id})" class="text-xs text-red-500 hover:text-red-700 font-medium">
                        Remove
                    </button>
                </div>
            </div>
        `;
        
        linkedAccountsList.appendChild(accountDiv);
    });
}

// Override the existing updateAccountSwitcherUI function to also update profile
const originalUpdateAccountSwitcherUI = updateAccountSwitcherUI;
updateAccountSwitcherUI = function() {
    if (originalUpdateAccountSwitcherUI) {
        originalUpdateAccountSwitcherUI();
    }
    updateProfileLinkedAccounts();
};

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Wait a bit for the main account switcher to initialize
    setTimeout(updateProfileLinkedAccounts, 1000);
});
</script>
