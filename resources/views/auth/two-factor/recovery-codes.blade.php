@extends('partials.layouts.settingsAccount')

{{-- Intro --}}
@push('intro-section')
    <h1 class="text-slate-800 text-2xl font-medium mb-1 tracking-tight">Kode Pemulihan</h1>
    <p class="text-base text-slate-600">Simpan kode-kode ini di tempat yang aman</p>
@endpush

@section('section')

    <section>
        <div class="w-full bg-white rounded-2xl border border-neutral-200 overflow-hidden">
            <div class="p-6">
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800">Autentikasi Dua Faktor Berhasil Dikonfigurasi!</h3>
                            <p class="text-sm text-slate-600">Berikut adalah kode pemulihan Anda</p>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-medium text-yellow-800 mb-1">Penting untuk Diingat</h4>
                                <ul class="text-sm text-yellow-700 space-y-1">
                                    <li>• Setiap kode hanya dapat digunakan sekali</li>
                                    <li>• Simpan kode-kode ini di tempat yang aman dan dapat diakses</li>
                                    <li>• Jangan bagikan kode ini kepada siapa pun</li>
                                    <li>• Anda dapat menggunakan kode ini jika lupa PIN atau tidak dapat mengaksesnya</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-lg p-4 mb-6">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-medium text-slate-800">Kode Pemulihan</h4>
                            <button onclick="copyRecoveryCodes()" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                Salin Semua
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3" id="recoveryCodes">
                            @foreach($recoveryCodes as $code)
                            <div class="bg-white border border-slate-200 rounded p-3 text-center font-mono text-sm">
                                {{ $code }}
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button onclick="downloadRecoveryCodes()" class="flex-1 px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download
                        </button>
                        <button onclick="printRecoveryCodes()" class="flex-1 px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Print
                        </button>
                        <a href="{{ route('security.two-factor.index') }}" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center">
                            Selesai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
function copyRecoveryCodes() {
    const codes = @json($recoveryCodes);
    const codesText = codes.join('\n');
    
    navigator.clipboard.writeText(codesText).then(function() {
        // Show success notification
        showNotification('Kode pemulihan berhasil disalin ke clipboard', 'success');
    }, function(err) {
        console.error('Could not copy text: ', err);
        showNotification('Gagal menyalin kode pemulihan', 'error');
    });
}

function downloadRecoveryCodes() {
    const codes = @json($recoveryCodes);
    const userName = '{{ auth()->user()->name }}';
    const currentDate = new Date().toLocaleDateString('id-ID');
    
    let content = `Kode Pemulihan Autentikasi Dua Faktor\n`;
    content += `Akun: ${userName}\n`;
    content += `Tanggal: ${currentDate}\n\n`;
    content += `PENTING: Simpan kode-kode ini di tempat yang aman!\n`;
    content += `Setiap kode hanya dapat digunakan sekali.\n\n`;
    content += `Kode Pemulihan:\n`;
    content += codes.map((code, index) => `${index + 1}. ${code}`).join('\n');
    content += `\n\nJangan bagikan kode ini kepada siapa pun.`;
    
    const blob = new Blob([content], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `recovery-codes-${new Date().getTime()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showNotification('Kode pemulihan berhasil didownload', 'success');
}

function printRecoveryCodes() {
    const codes = @json($recoveryCodes);
    const userName = '{{ auth()->user()->name }}';
    const currentDate = new Date().toLocaleDateString('id-ID');
    
    const printWindow = window.open('', '', 'width=600,height=400');
    printWindow.document.write(`
        <html>
        <head>
            <title>Kode Pemulihan Autentikasi Dua Faktor</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .header { border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
                .warning { background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; margin: 20px 0; border-radius: 5px; }
                .codes { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 20px 0; }
                .code { border: 1px solid #ddd; padding: 10px; text-align: center; font-family: monospace; background: #f8f9fa; }
                @media print { body { margin: 0; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Kode Pemulihan Autentikasi Dua Faktor</h1>
                <p><strong>Akun:</strong> ${userName}</p>
                <p><strong>Tanggal:</strong> ${currentDate}</p>
            </div>
            
            <div class="warning">
                <h3>⚠️ PENTING UNTUK DIINGAT</h3>
                <ul>
                    <li>Setiap kode hanya dapat digunakan sekali</li>
                    <li>Simpan kode-kode ini di tempat yang aman dan dapat diakses</li>
                    <li>Jangan bagikan kode ini kepada siapa pun</li>
                    <li>Anda dapat menggunakan kode ini jika lupa PIN atau tidak dapat mengaksesnya</li>
                </ul>
            </div>
            
            <h3>Kode Pemulihan:</h3>
            <div class="codes">
                ${codes.map(code => `<div class="code">${code}</div>`).join('')}
            </div>
            
            <p style="text-align: center; margin-top: 30px; font-size: 12px; color: #666;">
                Jangan bagikan kode ini kepada siapa pun. Simpan di tempat yang aman.
            </p>
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

function showNotification(message, type) {
    // Simple notification function
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        document.body.removeChild(notification);
    }, 3000);
}
</script>
@endpush
