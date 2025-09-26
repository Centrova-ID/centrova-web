@extends('partials.layouts.account')

@section('title', 'Hak Data Pribadi')

@section('content')
<section class="relative bg-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pb-10">
        <h1 class="text-4xl sm:text-5xl font-semibold text-slate-800 mb-6">Hak <span class="text-[#128AEB]">Data Pribadi</span></h1>
        <div class="max-w-3xl mx-auto">
            <p class="text-lg text-neutral-900 leading-relaxed mb-6">
                Kelola hak privasi dan data pribadi Anda sesuai dengan peraturan perlindungan data yang berlaku. 
                Anda memiliki kontrol penuh terhadap data pribadi yang kami simpan.
            </p>
            
            <div class="bg-neutral-50 rounded-2xl p-6 mb-8">
                <p class="text-slate-900 text-base leading-relaxed text-left">
                    Sesuai dengan undang-undang perlindungan data, Anda memiliki hak untuk mengakses, memperbaiki, 
                    memindahkan, atau menghapus data pribadi Anda. Semua permintaan akan diproses sesuai dengan 
                    kerangka waktu hukum yang berlaku.
                </p>
            </div>
        </div>
    </div>

    <!-- Data Summary Cards -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Ringkasan Data Anda</h2>
            <p class="text-lg text-gray-600">Gambaran umum data pribadi yang kami simpan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Data -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="text-center">
                    <div class="mx-auto h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Data Profil</h3>
                    <p class="text-gray-600 text-sm mb-4">Informasi pribadi dan preferensi</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $dataSummary['profile_data']['count'] }}</p>
                    <p class="text-xs text-gray-500 mt-2">Terakhir diupdate: {{ $dataSummary['profile_data']['last_updated']->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Login Activities -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="text-center">
                    <div class="mx-auto h-12 w-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Aktivitas Login</h3>
                    <p class="text-gray-600 text-sm mb-4">Riwayat akses akun</p>
                    <p class="text-2xl font-bold text-green-600">{{ $dataSummary['login_activities']['count'] }}</p>
                    <p class="text-xs text-gray-500 mt-2">Terakhir: {{ $dataSummary['login_activities']['last_updated'] ? \Carbon\Carbon::parse($dataSummary['login_activities']['last_updated'])->format('d M Y') : 'Tidak ada' }}</p>
                </div>
            </div>

            <!-- Chat Data -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="text-center">
                    <div class="mx-auto h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Data Chat</h3>
                    <p class="text-gray-600 text-sm mb-4">Komunikasi dengan support</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $dataSummary['chat_data']['count'] }}</p>
                    <p class="text-xs text-gray-500 mt-2">Terakhir: {{ $dataSummary['chat_data']['last_updated'] ? \Carbon\Carbon::parse($dataSummary['chat_data']['last_updated'])->format('d M Y') : 'Tidak ada' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Rights Information -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Hak Data Anda Berdasarkan Undang-Undang Privasi</h2>
            <p class="text-lg text-gray-600">Gunakan hak-hak Anda untuk mengelola data pribadi sesuai ketentuan hukum</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Access Right -->
            <div class="bg-blue-50 rounded-lg p-8 border border-blue-200">
                <div class="flex items-center mb-6">
                    <div class="h-12 w-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Hak Akses Data</h3>
                </div>
                <p class="text-gray-700 mb-6">Download semua data pribadi yang kami simpan tentang Anda dalam format yang dapat dibaca mesin.</p>
                
                <form action="{{ route('data-rights.export') }}" method="POST" class="mb-4">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Download Semua Data (ZIP)
                    </button>
                </form>
                
                <div class="text-sm text-gray-600 space-y-1">
                    <p><strong>Format:</strong> JSON dalam file ZIP</p>
                    <p><strong>Termasuk:</strong> Profil, aktivitas login, chat, preferensi</p>
                    <p><strong>Waktu pemrosesan:</strong> Instant</p>
                </div>
            </div>

            <!-- Rectification Right -->
            <div class="bg-green-50 rounded-lg p-8 border border-green-200">
                <div class="flex items-center mb-6">
                    <div class="h-12 w-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Hak Perbaikan Data</h3>
                </div>
                <p class="text-gray-700 mb-6">Minta koreksi atau perbaikan data pribadi yang tidak akurat atau tidak lengkap.</p>
                
                <button onclick="openRectificationModal()" class="w-full bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors mb-4">
                    Ajukan Perbaikan Data
                </button>
                
                <div class="text-sm text-gray-600 space-y-1">
                    <p><strong>Waktu respon:</strong> Maksimal 3 hari kerja</p>
                    <p><strong>Verifikasi:</strong> Identitas diperlukan untuk keamanan</p>
                </div>
            </div>

            <!-- Portability Right -->
            <div class="bg-purple-50 rounded-lg p-8 border border-purple-200">
                <div class="flex items-center mb-6">
                    <div class="h-12 w-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Hak Portabilitas Data</h3>
                </div>
                <p class="text-gray-700 mb-6">Download kategori data tertentu dalam format terstruktur untuk dipindahkan ke layanan lain.</p>
                
                <div class="space-y-3 mb-4">
                    <a href="{{ route('data-rights.download-category', 'profile') }}" 
                       class="block text-center bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                        Download Data Profil
                    </a>
                    <a href="{{ route('data-rights.download-category', 'login_activities') }}" 
                       class="block text-center bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                        Download Aktivitas Login
                    </a>
                    <a href="{{ route('data-rights.download-category', 'chat_data') }}" 
                       class="block text-center bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                        Download Data Chat
                    </a>
                </div>
                
                <div class="text-sm text-gray-600">
                    <p><strong>Format:</strong> JSON, CSV, atau XML</p>
                </div>
            </div>

            <!-- Erasure Right -->
            <div class="bg-red-50 rounded-lg p-8 border border-red-200">
                <div class="flex items-center mb-6">
                    <div class="h-12 w-12 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Hak untuk Dilupakan</h3>
                </div>
                <p class="text-gray-700 mb-6">Minta penghapusan permanen akun dan semua data pribadi Anda dari sistem kami.</p>
                
                <button onclick="openDeletionModal()" class="w-full bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition-colors mb-4">
                    Ajukan Penghapusan Akun
                </button>
                
                <div class="text-sm text-red-700 space-y-1">
                    <p><strong>⚠️ Peringatan:</strong> Tindakan ini tidak dapat dibatalkan</p>
                    <p><strong>Waktu pemrosesan:</strong> Maksimal 30 hari kerja</p>
                    <p><strong>Catatan:</strong> Beberapa data mungkin disimpan untuk kewajiban hukum</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-8">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Butuh Bantuan dengan Hak Data Anda?</h2>
                <p class="text-gray-700">Tim Privacy Officer kami siap membantu Anda dengan pertanyaan terkait data pribadi</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-center">
                    <div class="bg-blue-600 text-white rounded-full h-12 w-12 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Email Privacy Officer</h3>
                    <p class="text-gray-600 text-sm mb-3">Untuk pertanyaan kompleks atau bantuan khusus</p>
                    <a href="mailto:privacy@centrova.com" class="text-blue-600 hover:text-blue-700 font-medium">
                        privacy@centrova.com
                    </a>
                </div>
                
                <div class="text-center">
                    <div class="bg-blue-600 text-white rounded-full h-12 w-12 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Form Kontak Privacy</h3>
                    <p class="text-gray-600 text-sm mb-3">Untuk permintaan formal dengan tracking</p>
                    <a href="{{ route('legal.privacy.contact') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Kirim Permintaan
                    </a>
                </div>
            </div>
        </div>
    </section>
</section>
<!-- Rectification Modal -->
<div id="rectificationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full">
            <form action="{{ route('data-rights.rectify') }}" method="POST">
                @csrf
                <!-- Modal Header -->
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="h-10 w-10 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Ajukan Perbaikan Data</h3>
                            <p class="text-sm text-gray-600 mt-1">Permintaan koreksi data pribadi yang tidak akurat</p>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Body -->
                <div class="px-8 py-6">
                    <div class="space-y-6">
                        <div>
                            <label for="field" class="block text-sm font-medium text-gray-700 mb-2">Field yang Perlu Diperbaiki</label>
                            <select name="field" id="field" required class="w-full border border-gray-300 rounded-lg px-3 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Pilih field yang perlu diperbaiki</option>
                                <option value="name">Nama Lengkap</option>
                                <option value="email">Alamat Email</option>
                                <option value="phone">Nomor Telepon</option>
                                <option value="address">Alamat Rumah</option>
                                <option value="birth_date">Tanggal Lahir</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="current_value" class="block text-sm font-medium text-gray-700 mb-2">Nilai Saat Ini (Yang Salah)</label>
                            <input type="text" name="current_value" id="current_value" required 
                                   class="w-full border border-gray-300 rounded-lg px-3 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Masukkan data yang saat ini salah">
                        </div>
                        
                        <div>
                            <label for="new_value" class="block text-sm font-medium text-gray-700 mb-2">Nilai yang Benar</label>
                            <input type="text" name="new_value" id="new_value" required 
                                   class="w-full border border-gray-300 rounded-lg px-3 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Masukkan data yang benar">
                        </div>
                        
                        <div>
                            <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Perbaikan</label>
                            <textarea name="reason" id="reason" rows="4" required 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                      placeholder="Jelaskan secara detail mengapa data perlu diperbaiki dan bagaimana kesalahan tersebut terjadi"></textarea>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex">
                                <svg class="h-5 w-5 text-green-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <div class="text-sm text-green-700">
                                    <p class="font-medium">Informasi Pemrosesan:</p>
                                    <ul class="mt-1 space-y-1">
                                        <li>• Permintaan akan diverifikasi dalam 3 hari kerja</li>
                                        <li>• Konfirmasi identitas mungkin diperlukan</li>
                                        <li>• Anda akan menerima notifikasi setelah perbaikan selesai</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="px-8 py-6 bg-gray-50 rounded-b-xl flex justify-end gap-4">
                    <button type="button" onclick="closeRectificationModal()" 
                            class="px-6 py-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                        Kirim Permintaan Perbaikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Deletion Modal -->
<div id="deletionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full">
            <form action="{{ route('data-rights.delete') }}" method="POST">
                @csrf
                <!-- Modal Header -->
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="h-10 w-10 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Hapus Akun Permanen</h3>
                            <p class="text-sm text-gray-600 mt-1">Penghapusan data pribadi sesuai hak untuk dilupakan</p>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Body -->
                <div class="px-8 py-6">
                    <!-- Warning Box -->
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
                        <div class="flex">
                            <svg class="h-6 w-6 text-red-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <div class="text-sm text-red-700">
                                <h4 class="font-semibold text-red-800 mb-2">⚠️ Peringatan Penting - Tindakan Tidak Dapat Dibatalkan</h4>
                                <ul class="space-y-1">
                                    <li>• <strong>Akun Anda akan dihapus permanen</strong> dari semua sistem</li>
                                    <li>• <strong>Semua data pribadi akan dihapus</strong> sesuai kebijakan retensi</li>
                                    <li>• <strong>Riwayat transaksi dan komunikasi</strong> akan dihapus</li>
                                    <li>• <strong>Proses memakan waktu hingga 30 hari kerja</strong></li>
                                    <li>• <strong>Beberapa data mungkin disimpan</strong> untuk kewajiban hukum</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Anda</label>
                            <input type="password" name="password" id="password" required 
                                   class="w-full border border-gray-300 rounded-lg px-3 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Masukkan password untuk konfirmasi">
                        </div>
                        
                        <div>
                            <label for="deletion_reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penghapusan</label>
                            <textarea name="deletion_reason" id="deletion_reason" rows="4" required 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent" 
                                      placeholder="Mohon jelaskan alasan Anda ingin menghapus akun. Informasi ini membantu kami meningkatkan layanan."></textarea>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <input type="checkbox" name="confirm_deletion" id="confirm_deletion" required 
                                       class="mt-1 h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="confirm_deletion" class="ml-3 text-sm text-gray-700">
                                    Saya memahami bahwa <strong>tindakan ini akan menghapus akun saya secara permanen</strong> dan tidak dapat dibatalkan.
                                </label>
                            </div>
                            
                            <div class="flex items-start">
                                <input type="checkbox" name="confirm_data_loss" id="confirm_data_loss" required 
                                       class="mt-1 h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="confirm_data_loss" class="ml-3 text-sm text-gray-700">
                                    Saya memahami bahwa <strong>semua data pribadi dan riwayat akan hilang</strong> setelah penghapusan.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="px-8 py-6 bg-gray-50 rounded-b-xl flex justify-end gap-4">
                    <button type="button" onclick="closeDeletionModal()" 
                            class="px-6 py-3 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        Hapus Akun Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openRectificationModal() {
    document.getElementById('rectificationModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeRectificationModal() {
    document.getElementById('rectificationModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function openDeletionModal() {
    document.getElementById('deletionModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDeletionModal() {
    document.getElementById('deletionModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modals when clicking outside
document.getElementById('rectificationModal').addEventListener('click', function(e) {
    if (e.target === this) closeRectificationModal();
});

document.getElementById('deletionModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeletionModal();
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeRectificationModal();
        closeDeletionModal();
    }
});
</script>

@endsection
