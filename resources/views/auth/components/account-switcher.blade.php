{{-- Account Switcher Modal --}}
<div id="account-switcher-modal" class="fixed inset-0 z-[9999] hidden overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="flex min-h-screen items-center justify-center px-4 py-6">
        <div class="relative w-full max-w-md transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all z-[10000]">
            {{-- Header --}}
            <div class="p-4 relative">
                <div class="flex items-center justify-start">
                    <h3 class="text-lg font-medium text-left">Akun Terkait</h3>
                    <button onclick="closeAccountSwitcher()" class="text-neutral-600 hover:bg-neutral-200 rounded-full aspect-square p-1 absolute right-[10px]">
                        <svg class="h-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Content --}}
            <div class="max-h-96 overflow-y-auto px-3 pb-3 space-y-1">
                {{-- Current Account --}}
                <div class="bg-neutral-100 rounded-lg p-3">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-[#128AEB] flex items-center justify-center">
                                <span class="text-white font-medium text-base" id="current-account-initials">--</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-medium text-gray-900" id="current-account-name">Loading...</p>
                            <p class="text-base text-gray-500" id="current-account-email">Loading...</p>
                        </div>
                    </div>
                </div>

                {{-- Linked Accounts --}}
                <div id="linked-accounts-list">
                    {{-- Will be populated by JavaScript --}}
                </div>

                {{-- Add Account Section --}}
                <a href="https://account.centrova.test/login?mode=add-different-account" id="show-add-account-btn" class="w-full flex items-center justify-start space-x-3 p-3 font-medium hover:bg-neutral-100 rounded-lg text-base" onclick="closeAccountSwitcher()"">>
                    <div class="w-[40px] flex justify-center">
                        <svg class="h-[24px] text-[#128AEB]" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5 11H13.5V5C13.5 4.73478 13.3946 4.48043 13.2071 4.29289C13.0196 4.10536 12.7652 4 12.5 4C12.2348 4 11.9804 4.10536 11.7929 4.29289C11.6054 4.48043 11.5 4.73478 11.5 5V11H5.5C5.23478 11 4.98043 11.1054 4.79289 11.2929C4.60536 11.4804 4.5 11.7348 4.5 12C4.5 12.2652 4.60536 12.5196 4.79289 12.7071C4.98043 12.8946 5.23478 13 5.5 13H11.5V19C11.5 19.2652 11.6054 19.5196 11.7929 19.7071C11.9804 19.8946 12.2348 20 12.5 20C12.7652 20 13.0196 19.8946 13.2071 19.7071C13.3946 19.5196 13.5 19.2652 13.5 19V13H19.5C19.7652 13 20.0196 12.8946 20.2071 12.7071C20.3946 12.5196 20.5 12.2652 20.5 12C20.5 11.7348 20.3946 11.4804 20.2071 11.2929C20.0196 11.1054 19.7652 11 19.5 11Z" fill="#128AEB"/>
                        </svg>
                    </div>
                    <span>Tambahkan akun lainnya</span>
                </a>

                {{-- Add Account Section --}}
                <button onclick="logoutAllAccounts()" class="w-full flex items-center justify-start space-x-3 p-3 font-medium hover:bg-neutral-100 rounded-lg text-base text-red-600">
                    <div class="w-[40px] flex justify-center">
                        <svg class="h-[24px]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5947 13.0001L10.2947 15.2901C10.201 15.3831 10.1266 15.4937 10.0758 15.6155C10.025 15.7374 9.9989 15.8681 9.9989 16.0001C9.9989 16.1321 10.025 16.2628 10.0758 16.3847C10.1266 16.5065 10.201 16.6171 10.2947 16.7101C10.3877 16.8038 10.4983 16.8782 10.6201 16.929C10.742 16.9798 10.8727 17.0059 11.0047 17.0059C11.1367 17.0059 11.2674 16.9798 11.3893 16.929C11.5111 16.8782 11.6217 16.8038 11.7147 16.7101L15.7147 12.7101C15.8057 12.615 15.8771 12.5029 15.9247 12.3801C16.0247 12.1366 16.0247 11.8636 15.9247 11.6201C15.8771 11.4973 15.8057 11.3852 15.7147 11.2901L11.7147 7.2901C11.6215 7.19686 11.5108 7.1229 11.3889 7.07244C11.2671 7.02198 11.1366 6.99601 11.0047 6.99601C10.8728 6.99601 10.7423 7.02198 10.6205 7.07244C10.4986 7.1229 10.3879 7.19686 10.2947 7.2901C10.2015 7.38334 10.1275 7.49403 10.077 7.61585C10.0266 7.73767 10.0006 7.86824 10.0006 8.0001C10.0006 8.13196 10.0266 8.26253 10.077 8.38435C10.1275 8.50617 10.2015 8.61686 10.2947 8.7101L12.5947 11.0001H3.0047C2.73948 11.0001 2.48513 11.1055 2.29759 11.293C2.11006 11.4805 2.0047 11.7349 2.0047 12.0001C2.0047 12.2653 2.11006 12.5197 2.29759 12.7072C2.48513 12.8947 2.73948 13.0001 3.0047 13.0001H12.5947ZM12.0047 2.0001C10.1358 1.99176 8.30194 2.50731 6.71117 3.48829C5.12039 4.46927 3.83635 5.87641 3.0047 7.5501C2.88535 7.78879 2.86571 8.06512 2.95011 8.3183C3.0345 8.57147 3.216 8.78075 3.4547 8.9001C3.69339 9.01945 3.96972 9.03909 4.2229 8.95469C4.47607 8.8703 4.68535 8.68879 4.8047 8.4501C5.43689 7.17342 6.39853 6.08872 7.59025 5.30809C8.78197 4.52746 10.1605 4.07922 11.5835 4.00969C13.0064 3.94017 14.4221 4.25188 15.6842 4.91261C16.9464 5.57334 18.0092 6.55913 18.7628 7.7681C19.5165 8.97706 19.9336 10.3653 19.9711 11.7895C20.0086 13.2136 19.6652 14.6219 18.9762 15.8689C18.2873 17.1159 17.2778 18.1563 16.0522 18.8825C14.8266 19.6088 13.4293 19.9946 12.0047 20.0001C10.5136 20.0066 9.05085 19.5925 7.78439 18.8053C6.51793 18.0182 5.49905 16.89 4.8447 15.5501C4.72535 15.3114 4.51607 15.1299 4.2629 15.0455C4.00972 14.9611 3.73339 14.9808 3.4947 15.1001C3.256 15.2194 3.0745 15.4287 2.99011 15.6819C2.90571 15.9351 2.92535 16.2114 3.0447 16.4501C3.83753 18.0456 5.04222 19.4003 6.53417 20.3741C8.02612 21.348 9.75115 21.9055 11.5308 21.9891C13.3105 22.0727 15.0802 21.6793 16.6568 20.8496C18.2335 20.0199 19.5599 18.7841 20.4988 17.2699C21.4377 15.7558 21.955 14.0182 21.9972 12.2371C22.0394 10.456 21.605 8.69589 20.7389 7.13893C19.8729 5.58197 18.6065 4.28467 17.071 3.38121C15.5354 2.47774 13.7863 2.00094 12.0047 2.0001Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <span>Logout dari semua akun</span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Account Switcher JavaScript --}}
<script>
    {{-- Data akun yang sudah tersedia dari server --}}
    let accountSwitcherData = @json($multiAccountData ?? null);

    {{-- Initialize account switcher --}}
    function initializeAccountSwitcher() {
        if (accountSwitcherData) {
            updateAccountSwitcherUI();
        } else {
            {{-- Jika tidak ada data, tampilkan pesan --}}
            const linkedAccountsList = document.getElementById('linked-accounts-list');
            if (linkedAccountsList) {
                linkedAccountsList.innerHTML = '<div class="px-6 py-4 text-center text-gray-500">Tidak ada data akun tersedia</div>';
            }
        }
    }

    {{-- Update UI with account data --}}
    function updateAccountSwitcherUI() {
        if (!accountSwitcherData) {
            {{-- Jika tidak ada data, sembunyikan elemen atau tampilkan pesan --}}
            const linkedAccountsList = document.getElementById('linked-accounts-list');
            if (linkedAccountsList) {
                linkedAccountsList.innerHTML = '<div class="px-6 py-4 text-center text-gray-500">Tidak ada data akun tersedia</div>';
            }
            return;
        }

        const { current_account, linked_accounts } = accountSwitcherData;

        {{-- Update current account info --}}
        if (current_account) {
            const nameElement = document.getElementById('current-account-name');
            const emailElement = document.getElementById('current-account-email');
            const initialsElement = document.getElementById('current-account-initials');
            
            if (nameElement) nameElement.textContent = current_account.name;
            if (emailElement) emailElement.textContent = current_account.email;
            if (initialsElement) initialsElement.textContent = getInitials(current_account.name);
        }

        {{-- Update linked accounts list --}}
        const linkedAccountsList = document.getElementById('linked-accounts-list');
        if (linkedAccountsList) {
            linkedAccountsList.innerHTML = '';

            if (linked_accounts && linked_accounts.length > 0) {
                linked_accounts.forEach(account => {
                    if (!account.is_active) {
                        const accountElement = createLinkedAccountElement(account);
                        linkedAccountsList.appendChild(accountElement);
                    }
                });
            }
        }

        {{-- Show/hide account switcher button in navbar based on multiple accounts --}}
        const switcherBtn = document.getElementById('account-switcher-btn');
        if (switcherBtn) {
            switcherBtn.style.display = 'flex';
        }
        
        {{-- Update button text --}}
        const switchText = document.getElementById('account-switch-text');
        if (switchText) {
            if (accountSwitcherData.has_multiple) {
                switchText.textContent = 'Beralih Akun';
            } else {
                switchText.textContent = 'Tambah Akun';
            }
        }
    }

    {{-- Create linked account element --}}
    function createLinkedAccountElement(account) {
        const div = document.createElement('div');
        div.className = 'p-3 hover:bg-gray-100 rounded-lg cursor-pointer';
        div.onclick = () => switchToAccount(account.id);
        
        div.innerHTML = `
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-600 font-medium text-sm">${getInitials(account.name)}</span>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-base font-medium text-gray-900">${account.name}</p>
                    <p class="text-base text-gray-500">${account.email}</p>
                </div>
            </div>
        `;
        
        return div;
    }

    {{-- Get initials from name --}}
    function getInitials(name) {
        return name.split(' ')
            .map(word => word.charAt(0))
            .join('')
            .substring(0, 2)
            .toUpperCase();
    }

    {{-- Show account switcher modal --}}
    function showAccountSwitcher() {
        document.getElementById('account-switcher-modal').classList.remove('hidden');
        initializeAccountSwitcher();
    }

    {{-- Close account switcher modal --}}
    function closeAccountSwitcher() {
        document.getElementById('account-switcher-modal').classList.add('hidden');
        cancelAddAccount();
    }

    {{-- Switch to account --}}
    async function switchToAccount(userId) {
        try {
            const response = await fetch('/accounts/switch', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ user_id: userId })
            });

            const result = await response.json();
            
            if (result.success) {
                showNotification(result.message, 'success');
                {{-- Reload page to update all content with new account context --}}
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showNotification(result.message, 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan saat beralih akun', 'error');
        }
    }

    {{-- Remove account --}}
    async function removeAccount(userId) {
        if (!confirm('Yakin ingin menghapus akun ini dari sesi?')) return;

        try {
            const response = await fetch('/accounts/remove', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ user_id: userId })
            });

            const result = await response.json();
            
            if (result.success) {
                showNotification(result.message, 'success');
                accountSwitcherData = result.data;
                updateAccountSwitcherUI();
            } else {
                showNotification(result.message, 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan saat menghapus akun', 'error');
        }
    }

    {{-- Show add account form --}}
    function showAddAccountForm() {
        document.getElementById('add-account-form').classList.remove('hidden');
        document.getElementById('show-add-account-btn').classList.add('hidden');
        document.getElementById('add-account-login').focus();
    }

    {{-- Cancel add account --}}
    function cancelAddAccount() {
        document.getElementById('add-account-form').classList.add('hidden');
        document.getElementById('show-add-account-btn').classList.remove('hidden');
        document.getElementById('add-account-login').value = '';
        document.getElementById('add-account-password').value = '';
    }

    {{-- Submit add account --}}
    async function submitAddAccount() {
        const login = document.getElementById('add-account-login').value;
        const password = document.getElementById('add-account-password').value;

        if (!login || !password) {
            showNotification('Harap isi email/username dan password', 'error');
            return;
        }

        try {
            const response = await fetch('/accounts/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ login, password })
            });

            const result = await response.json();
            
            if (result.success) {
                showNotification(result.message, 'success');
                cancelAddAccount();
                
                if (result.type === 'add') {
                    {{-- New account added, reload page --}}
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    {{-- Switched to existing account --}}
                    accountSwitcherData = result.data;
                    updateAccountSwitcherUI();
                }
            } else {
                showNotification(result.message, 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan saat menambah akun', 'error');
        }
    }

    {{-- Logout current account --}}
    async function logoutCurrentAccount() {
        if (!confirm('Yakin ingin logout dari akun yang sedang aktif?')) return;

        try {
            const response = await fetch('/accounts/logout-current', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();
            
            if (result.success) {
                showNotification(result.message, 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showNotification(result.message, 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan saat logout', 'error');
        }
    }

    {{-- Logout all accounts --}}
    async function logoutAllAccounts() {
        if (!confirm('Yakin ingin logout dari semua akun? Anda akan diarahkan ke halaman login.')) return;

        try {
            const response = await fetch('/accounts/logout-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();
            
            if (result.success) {
                showNotification(result.message, 'success');
                setTimeout(() => {
                    window.location.href = result.redirect || '/';
                }, 1000);
            } else {
                showNotification(result.message, 'error');
            }
        } catch (error) {
            showNotification('Terjadi kesalahan saat logout', 'error');
        }
    }

    {{-- Utility function to show notifications --}}
    function showNotification(message, type = 'info') {
        {{-- Create notification element --}}
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        {{-- Remove after 3 seconds --}}
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    {{-- Handle Enter key in add account form --}}
    document.addEventListener('DOMContentLoaded', function() {
        const loginInput = document.getElementById('add-account-login');
        const passwordInput = document.getElementById('add-account-password');
        
        if (loginInput && passwordInput) {
            [loginInput, passwordInput].forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        submitAddAccount();
                    }
                });
            });
        }
        
        {{-- Initialize account switcher when page loads --}}
        initializeAccountSwitcher();
    });

    {{-- Close modal when clicking outside --}}
    document.getElementById('account-switcher-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAccountSwitcher();
        }
    });
</script>
