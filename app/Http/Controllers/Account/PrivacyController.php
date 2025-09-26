<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class PrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show privacy settings dashboard
     */
    public function index()
    {
        $user = User::find(Auth::id());
        
        // Get current privacy settings with defaults
        $privacySettings = array_merge([
            // Profile Visibility
            'public_profile' => false,
            'show_email' => false,
            'show_phone' => false,
            'show_birth_date' => false,
            'show_address' => false,
            'show_online_status' => true,
            'show_last_seen' => true,
            
            // Search & Discovery
            'searchable_by_email' => true,
            'searchable_by_phone' => false,
            'searchable_by_name' => true,
            'suggest_to_friends' => true,
            
            // Activity Tracking
            'track_activity' => true,
            'track_location' => true,
            'save_search_history' => true,
            'personalized_ads' => true,
            
            // Communication
            'allow_messages_from_strangers' => false,
            'allow_friend_requests' => true,
            'show_read_receipts' => true,
            'auto_save_photos' => false,
            
            // Data Collection
            'analytics_tracking' => true,
            'usage_data_collection' => true,
            'crash_reports' => true,
            'performance_data' => true,
            
            // Third Party
            'social_media_integration' => false,
            'third_party_cookies' => false,
            'external_service_access' => false,
        ], $user->privacy_settings ?? []);

        // Get communication preferences with defaults
        $communicationPreferences = array_merge([
            'marketing_emails' => true,
            'product_notifications' => true,
            'security_alerts' => true,
            'account_updates' => true,
            'newsletter' => false,
            'promotional_sms' => false,
            'push_notifications' => true,
            'email_frequency' => 'weekly', // daily, weekly, monthly
        ], $user->communication_preferences ?? []);

        // Calculate privacy score
        $privacyScore = $this->calculatePrivacyScore($privacySettings, $communicationPreferences);
        
        // Get privacy insights
        $insights = $this->getPrivacyInsights($user, $privacySettings);

        return view('auth.privacy.index', compact(
            'user',
            'privacySettings',
            'communicationPreferences',
            'privacyScore',
            'insights'
        ));
    }

    /**
     * Update privacy settings
     */
    public function updatePrivacySettings(Request $request)
    {
        $user = User::find(Auth::id());
        
        // Validate boolean settings
        $validatedSettings = $this->validatePrivacySettings($request);
        
        // Update privacy settings
        $user->privacy_settings = array_merge($user->privacy_settings ?? [], $validatedSettings);
        $user->save();

        // Log privacy change
        Log::info('Privacy settings updated', [
            'user_id' => $user->id,
            'changes' => $validatedSettings,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return back()->with('success', 'Pengaturan privasi berhasil diperbarui.');
    }

    /**
     * Update communication preferences
     */
    public function updateCommunicationPreferences(Request $request)
    {
        $user = User::find(Auth::id());
        
        $validated = $request->validate([
            'marketing_emails' => 'boolean',
            'product_notifications' => 'boolean',
            'security_alerts' => 'boolean',
            'account_updates' => 'boolean',
            'newsletter' => 'boolean',
            'promotional_sms' => 'boolean',
            'push_notifications' => 'boolean',
            'email_frequency' => 'in:daily,weekly,monthly',
        ]);

        // Security alerts cannot be disabled for security reasons
        if (isset($validated['security_alerts']) && !$validated['security_alerts']) {
            return back()->withErrors(['security_alerts' => 'Notifikasi keamanan tidak dapat dinonaktifkan untuk melindungi akun Anda.']);
        }

        // Update communication preferences
        $user->communication_preferences = array_merge($user->communication_preferences ?? [], $validated);
        $user->save();

        return back()->with('success', 'Preferensi komunikasi berhasil diperbarui.');
    }

    /**
     * Quick privacy setup for new users
     */
    public function quickSetup(Request $request)
    {
        $user = User::find(Auth::id());
        
        $presetType = $request->input('preset', 'balanced');
        
        $presets = [
            'strict' => [
                'public_profile' => false,
                'show_email' => false,
                'show_phone' => false,
                'show_birth_date' => false,
                'show_address' => false,
                'show_online_status' => false,
                'show_last_seen' => false,
                'searchable_by_email' => false,
                'searchable_by_phone' => false,
                'searchable_by_name' => false,
                'suggest_to_friends' => false,
                'track_activity' => false,
                'track_location' => false,
                'save_search_history' => false,
                'personalized_ads' => false,
                'allow_messages_from_strangers' => false,
                'analytics_tracking' => false,
                'usage_data_collection' => false,
                'social_media_integration' => false,
                'third_party_cookies' => false,
                'external_service_access' => false,
            ],
            'balanced' => [
                'public_profile' => false,
                'show_email' => false,
                'show_phone' => false,
                'show_birth_date' => false,
                'show_address' => false,
                'show_online_status' => true,
                'show_last_seen' => false,
                'searchable_by_email' => true,
                'searchable_by_phone' => false,
                'searchable_by_name' => true,
                'suggest_to_friends' => true,
                'track_activity' => true,
                'track_location' => false,
                'save_search_history' => true,
                'personalized_ads' => true,
                'allow_messages_from_strangers' => false,
                'analytics_tracking' => true,
                'usage_data_collection' => true,
                'social_media_integration' => false,
                'third_party_cookies' => false,
                'external_service_access' => false,
            ],
            'open' => [
                'public_profile' => true,
                'show_email' => false,
                'show_phone' => false,
                'show_birth_date' => true,
                'show_address' => false,
                'show_online_status' => true,
                'show_last_seen' => true,
                'searchable_by_email' => true,
                'searchable_by_phone' => true,
                'searchable_by_name' => true,
                'suggest_to_friends' => true,
                'track_activity' => true,
                'track_location' => true,
                'save_search_history' => true,
                'personalized_ads' => true,
                'allow_messages_from_strangers' => true,
                'analytics_tracking' => true,
                'usage_data_collection' => true,
                'social_media_integration' => true,
                'third_party_cookies' => true,
                'external_service_access' => true,
            ]
        ];

        if (isset($presets[$presetType])) {
            $user->privacy_settings = array_merge($user->privacy_settings ?? [], $presets[$presetType]);
            $user->save();

            Log::info('Privacy quick setup applied', [
                'user_id' => $user->id,
                'preset' => $presetType,
                'ip' => $request->ip()
            ]);

            return redirect()->route('privacy.index')->with('success', 
                'Pengaturan privasi berhasil dikonfigurasi dengan preset ' . ucfirst($presetType) . '.');
        }

        return back()->withErrors(['preset' => 'Preset tidak valid.']);
    }

    /**
     * Download user's privacy report
     */
    public function downloadPrivacyReport()
    {
        $user = User::find(Auth::id());
        
        $reportData = [
            'user_info' => [
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'join_date' => $user->created_at,
                'last_login' => $user->last_login_at,
            ],
            'privacy_settings' => $user->privacy_settings ?? [],
            'communication_preferences' => $user->communication_preferences ?? [],
            'generated_at' => now(),
            'privacy_score' => $this->calculatePrivacyScore($user->privacy_settings ?? [], $user->communication_preferences ?? [])
        ];

        $fileName = 'privacy_report_' . $user->username . '_' . now()->format('Y-m-d') . '.json';
        
        Log::info('Privacy report downloaded', [
            'user_id' => $user->id,
            'file_name' => $fileName
        ]);

        return response()->json($reportData)
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->header('Content-Type', 'application/json');
    }

    /**
     * Validate privacy settings input
     */
    private function validatePrivacySettings(Request $request)
    {
        $booleanSettings = [
            'public_profile', 'show_email', 'show_phone', 'show_birth_date', 'show_address',
            'show_online_status', 'show_last_seen', 'searchable_by_email', 'searchable_by_phone',
            'searchable_by_name', 'suggest_to_friends', 'track_activity', 'track_location',
            'save_search_history', 'personalized_ads', 'allow_messages_from_strangers',
            'allow_friend_requests', 'show_read_receipts', 'auto_save_photos',
            'analytics_tracking', 'usage_data_collection', 'crash_reports', 'performance_data',
            'social_media_integration', 'third_party_cookies', 'external_service_access'
        ];

        $validated = [];
        foreach ($booleanSettings as $setting) {
            if ($request->has($setting)) {
                $validated[$setting] = $request->boolean($setting);
            }
        }

        return $validated;
    }

    /**
     * Calculate privacy score based on settings
     */
    private function calculatePrivacyScore($privacySettings, $communicationPreferences)
    {
        $score = 0;
        $maxScore = 100;

        // Profile visibility (20 points)
        if (!($privacySettings['public_profile'] ?? false)) $score += 5;
        if (!($privacySettings['show_email'] ?? false)) $score += 5;
        if (!($privacySettings['show_phone'] ?? false)) $score += 5;
        if (!($privacySettings['show_address'] ?? false)) $score += 5;

        // Search restrictions (20 points)
        if (!($privacySettings['searchable_by_email'] ?? true)) $score += 5;
        if (!($privacySettings['searchable_by_phone'] ?? false)) $score += 5;
        if (!($privacySettings['searchable_by_name'] ?? true)) $score += 5;
        if (!($privacySettings['suggest_to_friends'] ?? true)) $score += 5;

        // Activity tracking (25 points)
        if (!($privacySettings['track_activity'] ?? true)) $score += 8;
        if (!($privacySettings['track_location'] ?? true)) $score += 9;
        if (!($privacySettings['save_search_history'] ?? true)) $score += 8;

        // Data collection (20 points)
        if (!($privacySettings['analytics_tracking'] ?? true)) $score += 5;
        if (!($privacySettings['usage_data_collection'] ?? true)) $score += 5;
        if (!($privacySettings['personalized_ads'] ?? true)) $score += 5;
        if (!($privacySettings['crash_reports'] ?? true)) $score += 5;

        // Third party access (15 points)
        if (!($privacySettings['social_media_integration'] ?? false)) $score += 5;
        if (!($privacySettings['third_party_cookies'] ?? false)) $score += 5;
        if (!($privacySettings['external_service_access'] ?? false)) $score += 5;

        return min($score, $maxScore);
    }

    /**
     * Get privacy insights for user
     */
    private function getPrivacyInsights($user, $privacySettings)
    {
        $insights = [];

        // Check for high-risk settings
        if ($privacySettings['public_profile'] ?? false) {
            $insights[] = [
                'type' => 'warning',
                'title' => 'Profil Publik Aktif',
                'message' => 'Profil Anda dapat dilihat oleh publik. Pertimbangkan untuk membatasi visibilitas.'
            ];
        }

        if ($privacySettings['track_location'] ?? true) {
            $insights[] = [
                'type' => 'info',
                'title' => 'Pelacakan Lokasi',
                'message' => 'Lokasi Anda dilacak untuk memberikan layanan yang lebih baik. Anda dapat menonaktifkannya kapan saja.'
            ];
        }

        if ($privacySettings['third_party_cookies'] ?? false) {
            $insights[] = [
                'type' => 'warning',
                'title' => 'Cookie Pihak Ketiga',
                'message' => 'Anda mengizinkan cookie dari pihak ketiga. Ini dapat digunakan untuk pelacakan lintas situs.'
            ];
        }

        // Privacy recommendations
        $privacyScore = $this->calculatePrivacyScore($privacySettings, $user->communication_preferences ?? []);
        
        if ($privacyScore < 50) {
            $insights[] = [
                'type' => 'recommendation',
                'title' => 'Tingkatkan Privasi',
                'message' => 'Skor privasi Anda rendah. Pertimbangkan untuk menggunakan preset "Ketat" atau sesuaikan pengaturan manual.'
            ];
        }

        return $insights;
    }
}
