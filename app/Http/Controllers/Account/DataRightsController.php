<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Carbon\Carbon;
use ZipArchive;

class DataRightsController extends Controller
{
    /**
     * Show data rights page
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get data summary
        $dataSummary = $this->getDataSummary($user);
        
        return view('auth.data-rights.index', compact('user', 'dataSummary'));
    }

    /**
     * Export all user data (GDPR Right to Data Portability)
     */
    public function exportData(Request $request)
    {
        $user = Auth::user();
        
        try {
            // Create unique filename
            $filename = 'centrova_data_export_' . $user->id . '_' . date('Y-m-d_H-i-s');
            $zipPath = storage_path('app/temp/' . $filename . '.zip');
            
            // Ensure temp directory exists
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
                throw new \Exception('Cannot create zip file');
            }

            // Export profile data
            $this->addProfileDataToZip($zip, $user);
            
            // Export login activities
            $this->addLoginActivitiesToZip($zip, $user);
            
            // Export chat data
            $this->addChatDataToZip($zip, $user);
            
            // Export preferences
            $this->addPreferencesToZip($zip, $user);
            
            // Add data export info
            $this->addExportInfoToZip($zip, $user);

            $zip->close();

            // Log the export request
            DB::table('user_data_exports')->insert([
                'user_id' => $user->id,
                'export_type' => 'full_export',
                'file_path' => $zipPath,
                'requested_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->download($zipPath)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return back()->withErrors(['export' => 'Gagal mengekspor data: ' . $e->getMessage()]);
        }
    }

    /**
     * Request account deletion (GDPR Right to be Forgotten)
     */
    public function requestDeletion(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'deletion_reason' => 'required|string|max:500',
            'confirm_deletion' => 'required|accepted',
        ]);

        $user = Auth::user();

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak sesuai']);
        }

        try {
            // Create deletion request
            DB::table('user_deletion_requests')->insert([
                'user_id' => $user->id,
                'reason' => $request->deletion_reason,
                'requested_at' => now(),
                'status' => 'pending',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Mark user as pending deletion
            User::where('id', $user->id)->update([
                'status' => 'pending_deletion',
                'deletion_requested_at' => now(),
            ]);

            // Log out user
            Auth::logout();

            return redirect()->route('login')->with('success', 
                'Permintaan penghapusan akun telah diterima. Tim kami akan memproses dalam 30 hari kerja sesuai dengan kebijakan privasi.');

        } catch (\Exception $e) {
            return back()->withErrors(['deletion' => 'Gagal mengajukan penghapusan: ' . $e->getMessage()]);
        }
    }

    /**
     * Download specific data category
     */
    public function downloadDataCategory(Request $request, $category)
    {
        $user = Auth::user();
        $allowedCategories = ['profile', 'login_activities', 'chat_data', 'preferences'];

        if (!in_array($category, $allowedCategories)) {
            return back()->withErrors(['category' => 'Kategori data tidak valid']);
        }

        try {
            $data = $this->getDataByCategory($user, $category);
            $filename = "centrova_{$category}_" . date('Y-m-d_H-i-s') . '.json';

            return response()->json($data, 200, [
                'Content-Type' => 'application/json',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);

        } catch (\Exception $e) {
            return back()->withErrors(['download' => 'Gagal mendownload data: ' . $e->getMessage()]);
        }
    }

    /**
     * Update data rectification (GDPR Right to Rectification)
     */
    public function rectifyData(Request $request)
    {
        $request->validate([
            'field' => 'required|string',
            'current_value' => 'required|string',
            'new_value' => 'required|string',
            'reason' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        try {
            // Create rectification request
            DB::table('user_data_rectifications')->insert([
                'user_id' => $user->id,
                'field_name' => $request->field,
                'current_value' => $request->current_value,
                'requested_value' => $request->new_value,
                'reason' => $request->reason,
                'status' => 'pending',
                'requested_at' => now(),
                'ip_address' => $request->ip(),
            ]);

            return back()->with('success', 'Permintaan perbaikan data telah dikirim dan akan diproses dalam 3 hari kerja.');

        } catch (\Exception $e) {
            return back()->withErrors(['rectification' => 'Gagal mengajukan perbaikan: ' . $e->getMessage()]);
        }
    }

    /**
     * Get data summary for user
     */
    private function getDataSummary($user)
    {
        return [
            'profile_data' => [
                'count' => 1,
                'last_updated' => $user->updated_at,
                'includes' => ['Basic info', 'Contact details', 'Preferences']
            ],
            'login_activities' => [
                'count' => DB::connection('account')->table('user_login_activities')
                    ->where('user_id', $user->id)->count(),
                'last_updated' => DB::connection('account')->table('user_login_activities')
                    ->where('user_id', $user->id)->max('login_at'),
                'includes' => ['Login times', 'IP addresses', 'Device info']
            ],
            'chat_data' => [
                'count' => ChatMessage::whereHas('conversation', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->count(),
                'last_updated' => ChatMessage::whereHas('conversation', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->max('created_at'),
                'includes' => ['Messages', 'Conversation history']
            ],
        ];
    }

    /**
     * Add profile data to zip
     */
    private function addProfileDataToZip($zip, $user)
    {
        $profileData = [
            'basic_info' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
            'additional_info' => [
                'phone' => $user->phone,
                'address' => $user->address,
                'city' => $user->city,
                'country' => $user->country,
                'birth_date' => $user->birth_date,
                'gender' => $user->gender,
            ],
            'account_settings' => [
                'status' => $user->status,
                'role' => $user->role,
                'last_login_at' => $user->last_login_at,
                'email_verified_at' => $user->email_verified_at,
            ]
        ];

        $zip->addFromString('profile_data.json', json_encode($profileData, JSON_PRETTY_PRINT));
    }

    /**
     * Add login activities to zip
     */
    private function addLoginActivitiesToZip($zip, $user)
    {
        $activities = DB::connection('account')->table('user_login_activities')
            ->where('user_id', $user->id)
            ->orderBy('login_at', 'desc')
            ->get()
            ->toArray();

        $zip->addFromString('login_activities.json', json_encode($activities, JSON_PRETTY_PRINT));
    }

    /**
     * Add chat data to zip
     */
    private function addChatDataToZip($zip, $user)
    {
        $conversations = ChatConversation::where('user_id', $user->id)
            ->with('messages')
            ->get()
            ->toArray();

        $zip->addFromString('chat_conversations.json', json_encode($conversations, JSON_PRETTY_PRINT));
    }

    /**
     * Add preferences to zip
     */
    private function addPreferencesToZip($zip, $user)
    {
        $preferences = [
            'privacy_settings' => $user->privacy_settings ?? [],
            'notification_settings' => $user->notification_settings ?? [],
            'language' => $user->language,
            'timezone' => $user->timezone,
        ];

        $zip->addFromString('preferences.json', json_encode($preferences, JSON_PRETTY_PRINT));
    }

    /**
     * Add export information to zip
     */
    private function addExportInfoToZip($zip, $user)
    {
        $exportInfo = [
            'export_date' => now()->toISOString(),
            'user_id' => $user->id,
            'export_version' => '1.0',
            'gdpr_notice' => 'This data export contains all personal data stored by Centrova for this user account as of the export date.',
            'data_categories' => [
                'profile_data.json' => 'Basic profile and account information',
                'login_activities.json' => 'Login history and security activities',
                'chat_conversations.json' => 'Customer service chat history',
                'preferences.json' => 'User preferences and settings',
            ],
            'retention_policy' => 'Data will be retained according to our Privacy Policy. You can request deletion at any time.',
            'contact_info' => [
                'data_protection_officer' => 'privacy@centrova.com',
                'support' => 'support@centrova.com',
            ]
        ];

        $zip->addFromString('export_info.json', json_encode($exportInfo, JSON_PRETTY_PRINT));
        
        // Add readme file
        $readme = "CENTROVA DATA EXPORT\n\n";
        $readme .= "Export Date: " . now()->format('Y-m-d H:i:s') . "\n";
        $readme .= "User ID: " . $user->id . "\n\n";
        $readme .= "This archive contains all personal data we have stored for your account.\n\n";
        $readme .= "Files included:\n";
        $readme .= "- profile_data.json: Your profile and account information\n";
        $readme .= "- login_activities.json: Your login history\n";
        $readme .= "- chat_conversations.json: Your customer service conversations\n";
        $readme .= "- preferences.json: Your preferences and settings\n";
        $readme .= "- export_info.json: Information about this export\n\n";
        $readme .= "For questions about your data, contact: privacy@centrova.com\n";

        $zip->addFromString('README.txt', $readme);
    }

    /**
     * Get data by specific category
     */
    private function getDataByCategory($user, $category)
    {
        switch ($category) {
            case 'profile':
                return [
                    'basic_info' => [
                        'name' => $user->name,
                        'username' => $user->username,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'created_at' => $user->created_at,
                    ]
                ];

            case 'login_activities':
                return DB::connection('account')->table('user_login_activities')
                    ->where('user_id', $user->id)
                    ->orderBy('login_at', 'desc')
                    ->limit(100)
                    ->get();

            case 'chat_data':
                return ChatConversation::where('user_id', $user->id)
                    ->with('messages')
                    ->get();

            case 'preferences':
                return [
                    'privacy_settings' => $user->privacy_settings ?? [],
                    'notification_settings' => $user->notification_settings ?? [],
                    'language' => $user->language,
                ];

            default:
                return [];
        }
    }
}
