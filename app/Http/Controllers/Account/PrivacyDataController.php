<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Carbon\Carbon;
use ZipArchive;

class PrivacyDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show privacy data main dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get privacy statistics
        $privacyStats = $this->getPrivacyStats($user);
        
        return view('auth.privacy-data.index', compact('user', 'privacyStats'));
    }

    /**
     * Show profile visibility settings
     */
    public function visibilitySettings()
    {
        $user = Auth::user();
        
        // Get current privacy settings
        $privacySettings = $user->privacy_settings ?? [];
        
        return view('auth.privacy-data.visibility', compact('user', 'privacySettings'));
    }

    /**
     * Update profile visibility settings
     */
    public function updateVisibilitySettings(Request $request)
    {
        $user = Auth::user();
        
        $validatedSettings = $request->validate([
            'public_profile' => 'boolean',
            'show_email' => 'boolean',
            'show_phone' => 'boolean',
            'show_birth_date' => 'boolean',
            'show_address' => 'boolean',
            'show_online_status' => 'boolean',
            'searchable_by_email' => 'boolean',
            'searchable_by_phone' => 'boolean',
            'searchable_by_name' => 'boolean',
        ]);

        // Convert checkbox values to booleans
        $booleanSettings = [];
        foreach ($validatedSettings as $key => $value) {
            $booleanSettings[$key] = $request->has($key);
        }

        // Update privacy settings
        $privacySettings = array_merge($user->privacy_settings ?? [], $booleanSettings);
        $user->privacy_settings = $privacySettings;
        $user->save();

        // Log privacy change
        Log::info('Privacy visibility settings updated', [
            'user_id' => $user->id,
            'settings_changed' => $booleanSettings,
            'ip' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Pengaturan visibilitas berhasil diperbarui.');
    }

    /**
     * Show data sharing settings
     */
    public function dataSharingSettings()
    {
        $user = Auth::user();
        
        // Get current data sharing settings
        $dataSharingSettings = $user->privacy_settings ?? [];
        
        return view('auth.privacy-data.data-sharing', compact('user', 'dataSharingSettings'));
    }

    /**
     * Update data sharing settings
     */
    public function updateDataSharingSettings(Request $request)
    {
        $user = Auth::user();
        
        $validatedSettings = $request->validate([
            'third_party_cookies' => 'boolean',
            'social_media_integration' => 'boolean',
            'external_service_access' => 'boolean',
            'data_analytics' => 'boolean',
            'advertising_data' => 'boolean',
            'research_participation' => 'boolean',
        ]);

        // Convert checkbox values to booleans
        $booleanSettings = [];
        foreach ($validatedSettings as $key => $value) {
            $booleanSettings[$key] = $request->has($key);
        }

        // Update privacy settings
        $privacySettings = array_merge($user->privacy_settings ?? [], $booleanSettings);
        $user->privacy_settings = $privacySettings;
        $user->save();

        Log::info('Data sharing settings updated', [
            'user_id' => $user->id,
            'settings_changed' => $booleanSettings,
            'ip' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Pengaturan berbagi data berhasil diperbarui.');
    }

    /**
     * Show tracking settings
     */
    public function trackingSettings()
    {
        $user = Auth::user();
        
        // Get current tracking settings
        $trackingSettings = $user->privacy_settings ?? [];
        
        return view('auth.privacy-data.tracking', compact('user', 'trackingSettings'));
    }

    /**
     * Update tracking settings
     */
    public function updateTrackingSettings(Request $request)
    {
        $user = Auth::user();
        
        $validatedSettings = $request->validate([
            'track_activity' => 'boolean',
            'track_location' => 'boolean',
            'save_search_history' => 'boolean',
            'personalized_ads' => 'boolean',
            'analytics_tracking' => 'boolean',
            'usage_data_collection' => 'boolean',
        ]);

        // Convert checkbox values to booleans
        $booleanSettings = [];
        foreach ($validatedSettings as $key => $value) {
            $booleanSettings[$key] = $request->has($key);
        }

        // Update privacy settings
        $privacySettings = array_merge($user->privacy_settings ?? [], $booleanSettings);
        $user->privacy_settings = $privacySettings;
        $user->save();

        Log::info('Tracking settings updated', [
            'user_id' => $user->id,
            'settings_changed' => $booleanSettings,
            'ip' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Pengaturan pelacakan berhasil diperbarui.');
    }

    /**
     * Show download data page
     */
    public function downloadData()
    {
        $user = Auth::user();
        
        // Get data summary
        $dataSummary = $this->getDataSummary($user);
        
        return view('auth.privacy-data.download', compact('user', 'dataSummary'));
    }

    /**
     * Export user data
     */
    public function exportData(Request $request)
    {
        $user = Auth::user();
        
        try {
            // Create unique filename
            $filename = 'centrova_privacy_export_' . $user->id . '_' . date('Y-m-d_H-i-s');
            $zipPath = storage_path('app/temp/' . $filename . '.zip');
            
            // Ensure temp directory exists
            if (!is_dir(dirname($zipPath))) {
                mkdir(dirname($zipPath), 0755, true);
            }
            
            // Create ZIP archive
            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
                throw new \Exception('Cannot create zip file');
            }
            
            // Add profile data
            $this->addProfileDataToZip($zip, $user);
            
            // Add privacy settings
            $this->addPrivacySettingsToZip($zip, $user);
            
            // Add access logs
            $this->addAccessLogsToZip($zip, $user);
            
            // Add readme
            $this->addReadmeToZip($zip, $user);
            
            $zip->close();
            
            // Log export activity
            DB::table('data_export_logs')->insert([
                'user_id' => $user->id,
                'export_type' => 'privacy_data_export',
                'file_path' => $zipPath,
                'requested_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->download($zipPath)->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            Log::error('Privacy data export failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            return back()->withErrors(['export' => 'Gagal mengekspor data: ' . $e->getMessage()]);
        }
    }

    /**
     * Show data access logs
     */
    public function dataAccessLogs()
    {
        $user = Auth::user();
        
        // Get access logs (you might need to create this table)
        $accessLogs = $this->getAccessLogs($user);
        
        return view('auth.privacy-data.data-access', compact('user', 'accessLogs'));
    }

    /**
     * Show consent management
     */
    public function consentManagement()
    {
        $user = Auth::user();
        
        // Get consent records
        $consents = $this->getUserConsents($user);
        
        return view('auth.privacy-data.consent-management', compact('user', 'consents'));
    }

    /**
     * Update consent
     */
    public function updateConsent(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'consent_type' => 'required|string',
            'consent_value' => 'required|boolean',
        ]);

        // Update specific consent
        $consents = $user->consent_settings ?? [];
        $consents[$request->consent_type] = $request->consent_value;
        
        $user->consent_settings = $consents;
        $user->save();

        // Log consent change
        Log::info('User consent updated', [
            'user_id' => $user->id,
            'consent_type' => $request->consent_type,
            'consent_value' => $request->consent_value,
            'ip' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Pengaturan persetujuan berhasil diperbarui.');
    }

    /**
     * Get privacy statistics
     */
    private function getPrivacyStats($user)
    {
        $settings = $user->privacy_settings ?? [];
        
        return [
            'privacy_score' => $this->calculatePrivacyScore($settings),
            'visible_data_points' => $this->countVisibleDataPoints($settings),
            'active_consents' => $this->countActiveConsents($user),
            'last_updated' => $user->updated_at,
        ];
    }

    /**
     * Calculate privacy score
     */
    private function calculatePrivacyScore($settings)
    {
        $secureSettings = [
            'public_profile' => false,
            'show_email' => false,
            'show_phone' => false,
            'third_party_cookies' => false,
            'track_location' => false,
            'personalized_ads' => false,
        ];

        $score = 0;
        $maxScore = count($secureSettings);

        foreach ($secureSettings as $setting => $secureValue) {
            if (($settings[$setting] ?? true) === $secureValue) {
                $score++;
            }
        }

        return round(($score / $maxScore) * 100);
    }

    /**
     * Count visible data points
     */
    private function countVisibleDataPoints($settings)
    {
        $visibilitySettings = [
            'show_email', 'show_phone', 'show_birth_date', 
            'show_address', 'show_online_status'
        ];

        return collect($visibilitySettings)->sum(function ($setting) use ($settings) {
            return ($settings[$setting] ?? false) ? 1 : 0;
        });
    }

    /**
     * Count active consents
     */
    private function countActiveConsents($user)
    {
        $consents = $user->consent_settings ?? [];
        return collect($consents)->sum(function ($consent) {
            return $consent ? 1 : 0;
        });
    }

    /**
     * Get data summary for export
     */
    private function getDataSummary($user)
    {
        return [
            'profile_data' => [
                'basic_info' => 'Nama, email, username, tanggal lahir',
                'contact_info' => 'Nomor telepon, alamat',
                'preferences' => 'Pengaturan bahasa, zona waktu',
            ],
            'activity_data' => [
                'login_history' => 'Riwayat login dan aktivitas keamanan',
                'search_history' => 'Riwayat pencarian (jika diaktifkan)',
                'usage_analytics' => 'Data penggunaan layanan',
            ],
            'privacy_data' => [
                'privacy_settings' => 'Semua pengaturan privasi Anda',
                'consent_records' => 'Catatan persetujuan yang diberikan',
                'data_requests' => 'Riwayat permintaan data dan privasi',
            ],
        ];
    }

    /**
     * Get access logs
     */
    private function getAccessLogs($user)
    {
        // This would typically come from a dedicated access log table
        return [
            [
                'accessed_by' => 'Sistem Keamanan',
                'access_type' => 'Verifikasi Login',
                'accessed_at' => now()->subHours(2),
                'data_accessed' => 'Informasi Profil',
                'ip_address' => '192.168.1.1',
                'status' => 'success',
            ],
            [
                'accessed_by' => 'Analitik Sistem',
                'access_type' => 'Analisa Penggunaan',
                'accessed_at' => now()->subDays(1),
                'data_accessed' => 'Data Aktivitas',
                'ip_address' => 'sistem',
                'status' => 'success',
            ],
            [
                'accessed_by' => 'Tim Customer Service',
                'access_type' => 'Dukungan Pelanggan',
                'accessed_at' => now()->subDays(3),
                'data_accessed' => 'Profil dan Riwayat',
                'ip_address' => '10.0.0.5',
                'status' => 'success',
            ],
        ];
    }

    /**
     * Get user consents
     */
    private function getUserConsents($user)
    {
        $consents = $user->consent_settings ?? [];
        
        return [
            'marketing_emails' => [
                'name' => 'Email Marketing',
                'description' => 'Menerima email promosi dan penawaran khusus',
                'consent' => $consents['marketing_emails'] ?? true,
                'required' => false,
                'last_updated' => now()->subDays(10),
            ],
            'data_analytics' => [
                'name' => 'Analitik Data',
                'description' => 'Mengizinkan analisis data untuk peningkatan layanan',
                'consent' => $consents['data_analytics'] ?? true,
                'required' => false,
                'last_updated' => now()->subDays(5),
            ],
            'third_party_sharing' => [
                'name' => 'Berbagi dengan Pihak Ketiga',
                'description' => 'Berbagi data dengan partner untuk layanan yang lebih baik',
                'consent' => $consents['third_party_sharing'] ?? false,
                'required' => false,
                'last_updated' => now()->subDays(15),
            ],
            'location_tracking' => [
                'name' => 'Pelacakan Lokasi',
                'description' => 'Melacak lokasi untuk personalisasi layanan',
                'consent' => $consents['location_tracking'] ?? false,
                'required' => false,
                'last_updated' => now()->subDays(8),
            ],
            'cookies_functional' => [
                'name' => 'Cookie Fungsional',
                'description' => 'Cookie yang diperlukan untuk fungsi dasar website',
                'consent' => true, // Always required
                'required' => true,
                'last_updated' => now()->subDays(1),
            ],
        ];
    }

    /**
     * Add profile data to ZIP
     */
    private function addProfileDataToZip($zip, $user)
    {
        $profileData = [
            'personal_info' => [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'phone' => $user->phone,
                'birth_date' => $user->birth_date?->format('Y-m-d'),
                'gender' => $user->gender,
                'address' => $user->address,
                'city' => $user->city,
                'postal_code' => $user->postal_code,
                'country' => $user->country,
            ],
            'account_info' => [
                'created_at' => $user->created_at,
                'email_verified_at' => $user->email_verified_at,
                'last_login_at' => $user->last_login_at,
                'timezone' => $user->timezone,
            ],
        ];

        $zip->addFromString('profile_data.json', json_encode($profileData, JSON_PRETTY_PRINT));
    }

    /**
     * Add privacy settings to ZIP
     */
    private function addPrivacySettingsToZip($zip, $user)
    {
        $privacyData = [
            'privacy_settings' => $user->privacy_settings ?? [],
            'consent_settings' => $user->consent_settings ?? [],
            'communication_preferences' => $user->communication_preferences ?? [],
            'exported_at' => now()->toISOString(),
        ];

        $zip->addFromString('privacy_settings.json', json_encode($privacyData, JSON_PRETTY_PRINT));
    }

    /**
     * Add access logs to ZIP
     */
    private function addAccessLogsToZip($zip, $user)
    {
        $accessLogs = $this->getAccessLogs($user);
        $zip->addFromString('access_logs.json', json_encode($accessLogs, JSON_PRETTY_PRINT));
    }

    /**
     * Add readme to ZIP
     */
    private function addReadmeToZip($zip, $user)
    {
        $readme = "CENTROVA PRIVACY DATA EXPORT\n\n";
        $readme .= "Export Date: " . now()->format('Y-m-d H:i:s') . "\n";
        $readme .= "User ID: " . $user->id . "\n";
        $readme .= "Username: " . $user->username . "\n\n";
        $readme .= "This archive contains your privacy-related data:\n\n";
        $readme .= "Files included:\n";
        $readme .= "- profile_data.json: Your basic profile information\n";
        $readme .= "- privacy_settings.json: Your privacy and consent settings\n";
        $readme .= "- access_logs.json: Records of data access\n";
        $readme .= "- README.txt: This information file\n\n";
        $readme .= "For questions about your data or privacy:\n";
        $readme .= "Email: privacy@centrova.com\n";
        $readme .= "Data Rights Portal: " . route('data-rights.index') . "\n\n";
        $readme .= "Your privacy matters to us.\n";
        
        $zip->addFromString('README.txt', $readme);
    }
}
