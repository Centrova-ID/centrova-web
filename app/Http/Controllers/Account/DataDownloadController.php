<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DataDownloadController extends Controller
{
    public function downloadAccountData(Request $request)
    {
        // Get user data - check if user is authenticated or get from session/request
        $user = null;
        
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            // If not authenticated, try to get user data from request parameters
            $email = $request->get('email');
            $username = $request->get('username');
            
            if ($email) {
                $user = \App\Models\User::where('email', $email)->first();
            } elseif ($username) {
                $user = \App\Models\User::where('username', $username)->first();
            }
            
            // If still no user found, try to get from session
            if (!$user && session('suspended_user_email')) {
                $user = \App\Models\User::where('email', session('suspended_user_email'))->first();
            }
        }
        
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Data pengguna tidak ditemukan. Silakan hubungi administrator.']);
        }
        
        // Prepare data for PDF
        $userData = [
            'full_name' => $user->name ?? 'Tidak tersedia',
            'username' => $user->username ?? 'Tidak tersedia',
            'email' => $user->email ?? 'Tidak tersedia',
            'phone' => $user->phone ?? 'Tidak tersedia',
            'status' => $user->status === 'suspended' ? 'Suspended' : 'Ditangguhkan',
            'created_at' => $user->created_at ? $user->created_at->format('d M Y H:i') : 'Tidak tersedia',
            'last_login' => $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : 'Tidak tersedia',
            'last_device' => $user->last_device ?? 'Tidak tersedia',
            'address' => $user->address ?? 'Tidak tersedia',
            'emergency_contact' => $user->emergency_contact ?? 'Tidak tersedia',
            'language_preference' => $user->language ?? 'Indonesia',
            'suspended_at' => $user->suspended_at ? $user->suspended_at->format('d M Y H:i') : ($user->updated_at && $user->status === 'suspended' ? $user->updated_at->format('d M Y H:i') : 'Tidak tersedia'),
            'suspension_reason' => $user->suspension_reason ?? 'Aktivitas yang melanggar ketentuan penggunaan atau berisiko terhadap keamanan akun',
            'download_date' => Carbon::now()->format('d M Y H:i'),
        ];
        
        // Generate PDF
        $pdf = Pdf::loadView('account.data-download.pdf', [
            'userData' => $userData,
            'downloadDate' => Carbon::now()->format('d M Y H:i')
        ]);
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Generate filename
        $filename = 'Data_Akun_' . ($user->username ?? str_replace('@', '_', $user->email)) . '_' . Carbon::now()->format('YmdHis') . '.pdf';
        
        return $pdf->download($filename);
    }
}
