<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Account\UserLoginActivity;
use App\Services\LoginActivityService;
use App\Services\RecoveryCodeService;
use App\Services\SessionManagerService;
use App\Services\DeviceSessionService;
use App\Services\LoginAlertService;
use App\Models\Account\LoginAlert;

class SecurityController extends Controller
{
    protected LoginActivityService $loginActivityService;
    protected RecoveryCodeService $recoveryCodeService;
    protected SessionManagerService $sessionManagerService;
    protected DeviceSessionService $deviceSessionService;
    protected LoginAlertService $loginAlertService;

    public function __construct(
        LoginActivityService $loginActivityService, 
        RecoveryCodeService $recoveryCodeService,
        SessionManagerService $sessionManagerService,
        DeviceSessionService $deviceSessionService,
        LoginAlertService $loginAlertService
    ) {
        $this->middleware('auth');
        $this->loginActivityService = $loginActivityService;
        $this->recoveryCodeService = $recoveryCodeService;
        $this->sessionManagerService = $sessionManagerService;
        $this->deviceSessionService = $deviceSessionService;
        $this->loginAlertService = $loginAlertService;
    }

    /**
     * Show the security page
     */
    public function index()
    {
        $user = User::find(Auth::id());
        
        // Get login activities
        $recentActivities = $this->loginActivityService->getRecentActivities($user->id, 10);
        $suspiciousActivities = $this->loginActivityService->getSuspiciousActivities($user->id);
        $loginStats = $this->loginActivityService->getLoginStats($user->id);
        
        // Get recovery code statistics
        $codeStats = $this->recoveryCodeService->getCodeStatistics($user->id);
        $usedCodes = $this->recoveryCodeService->getUsedCodes($user->id);
        
        // Get session information
        $activeSessions = $this->sessionManagerService->getActiveSessions($user->id);
        $sessionCount = $this->sessionManagerService->getSessionCount($user->id);
        $suspiciousSessions = $this->sessionManagerService->detectSuspiciousSessions($user->id);
        
        // Get device session summary
        $deviceSessionSummary = $this->deviceSessionService->getSessionSummary($user->id);
        
        // Get security notifications
        $this->checkAndNotifySuspiciousActivity($user->id);
        $notifications = $this->getNotificationsForUser($user->id);
        $securitySummary = $this->getSecuritySummary($user->id);
        
        return view('auth.security.index', compact(
            'user',
            'recentActivities',
            'suspiciousActivities',
            'loginStats',
            'codeStats',
            'usedCodes',
            'activeSessions',
            'sessionCount',
            'suspiciousSessions',
            'deviceSessionSummary',
            'notifications',
            'securitySummary'
        ));
    }

    /**
     * Generate new recovery codes
     */
    public function generateRecoveryCodes(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        $user = User::find(Auth::id());

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password yang Anda masukkan salah.']);
        }

        // Generate new codes
        $result = $this->recoveryCodeService->generateRecoveryCodes($user->id);

        return back()->with([
            'success' => 'Recovery codes berhasil dibuat. Simpan kode-kode ini dengan aman!',
            'recovery_codes' => $result['plain_codes']
        ]);
    }

    /**
     * Show recovery codes generation page
     */
    public function showRecoveryCodesGeneration()
    {
        $user = User::find(Auth::id());
        $codeStats = $this->recoveryCodeService->getCodeStatistics($user->id);
        
        return view('auth.security.recovery-codes', compact('user', 'codeStats'));
    }

    /**
     * Revoke all unused recovery codes
     */
    public function revokeRecoveryCodes(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        $user = User::find(Auth::id());

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password yang Anda masukkan salah.']);
        }

        $revokedCount = $this->recoveryCodeService->revokeAllUnusedCodes($user->id);

        return back()->with('success', "Berhasil mencabut {$revokedCount} recovery codes yang belum digunakan.");
    }

    /**
     * Show login activities page
     */
    public function loginActivities()
    {
        $user = User::find(Auth::id());
        
        $recentActivities = $this->loginActivityService->getRecentActivities($user->id, 50);
        $suspiciousActivities = $this->loginActivityService->getSuspiciousActivities($user->id);
        $loginStats = $this->loginActivityService->getLoginStats($user->id);
        
        return view('auth.security.login-activities', compact(
            'user',
            'recentActivities',
            'suspiciousActivities',
            'loginStats'
        ));
    }

    /**
     * Download login activities as CSV
     */
    public function downloadLoginActivities()
    {
        $user = User::find(Auth::id());
        $activities = $this->loginActivityService->getRecentActivities($user->id, 1000);

        $csvData = [];
        $csvData[] = ['Tanggal & Waktu', 'IP Address', 'Lokasi', 'Perangkat', 'Browser', 'OS', 'Status', 'Keterangan'];

        foreach ($activities as $activity) {
            $csvData[] = [
                $activity->login_at->format('Y-m-d H:i:s'),
                $activity->ip_address,
                $activity->location_display,
                ucfirst($activity->device_type),
                $activity->browser,
                $activity->operating_system,
                $activity->status_text,
                $activity->failure_reason ?? ''
            ];
        }

        $filename = 'login_activities_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Mark suspicious activity as safe
     */
    public function markActivityAsSafe(Request $request, $activityId)
    {
        $user = User::find(Auth::id());
        
        $activity = UserLoginActivity::where('id', $activityId)
            ->where('user_id', $user->id)
            ->first();

        if (!$activity) {
            return back()->withErrors(['error' => 'Aktivitas tidak ditemukan.']);
        }

        $activity->update(['is_suspicious' => false]);

        return back()->with('success', 'Aktivitas telah ditandai sebagai aman.');
    }

    /**
     * Show active sessions page
     */
    public function sessions()
    {
        $user = User::find(Auth::id());
        $activeSessions = $this->sessionManagerService->getActiveSessions($user->id);
        $suspiciousSessions = $this->sessionManagerService->detectSuspiciousSessions($user->id);
        
        return view('auth.security.sessions', compact('user', 'activeSessions', 'suspiciousSessions'));
    }

    /**
     * Logout from all other devices
     */
    public function logoutOtherDevices(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak sesuai.']);
        }

        $revokedCount = $this->sessionManagerService->revokeOtherSessions($user->id);

        // Log this security action
        $this->loginActivityService->logActivity(
            $user->id,
            $request,
            'success',
            "Logout from {$revokedCount} other devices",
            false
        );

        return back()->with('success', "Berhasil logout dari {$revokedCount} perangkat lain.");
    }

    /**
     * Logout from all devices
     */
    public function logoutAllDevices(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password tidak sesuai.']);
        }

        $revokedCount = $this->sessionManagerService->revokeAllSessions($user->id);

        // Log this security action before logout
        $this->loginActivityService->logActivity(
            $user->id,
            $request,
            'success',
            "Logout from all {$revokedCount} devices",
            false
        );

        // Logout current user
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', "Berhasil logout dari semua perangkat. Silakan login kembali.");
    }

    /**
     * Revoke specific session
     */
    public function revokeSession(Request $request, $sessionId)
    {
        $user = User::find(Auth::id());
        
        if ($this->sessionManagerService->revokeSession($sessionId)) {
            return back()->with('success', 'Sesi berhasil dicabut.');
        }

        return back()->withErrors(['error' => 'Gagal mencabut sesi.']);
    }

    /**
     * Get security notifications
     */
    public function getNotifications()
    {
        $user = User::find(Auth::id());
        $notifications = $this->getNotificationsForUser($user->id);
        
        return response()->json($notifications);
    }

    /**
     * Mark notification as read
     */
    public function markNotificationAsRead(Request $request, $notificationId)
    {
        $user = User::find(Auth::id());
        $this->markAsRead($user->id, $notificationId);
        
        return response()->json(['success' => true]);
    }

    /**
     * Delete a specific notification
     */
    public function deleteNotification(Request $request, $notificationId)
    {
        $user = User::find(Auth::id());
        
        // Get current notifications
        $notifications = $this->getNotificationsForUser($user->id);
        $originalCount = count($notifications);
        
        // Find and remove the notification
        $notifications = array_filter($notifications, function($notification) use ($notificationId) {
            return $notification['id'] !== $notificationId;
        });
        
        $newCount = count($notifications);
        $deleted = $originalCount > $newCount;
        
        if ($deleted) {
            // Save updated notifications
            $cacheKey = "security_notifications_user_{$user->id}";
            Cache::put($cacheKey, array_values($notifications), now()->addDays(7));
            
            return response()->json([
                'success' => true, 
                'message' => 'Notifikasi berhasil dihapus',
                'remaining_count' => $newCount
            ]);
        }
        
        return response()->json([
            'success' => false, 
            'message' => 'Notifikasi tidak ditemukan'
        ], 404);
    }

    /**
     * Clear all notifications
     */
    public function clearNotifications()
    {
        $user = User::find(Auth::id());
        $cacheKey = "security_notifications_user_{$user->id}";
        
        // Get current count before clearing
        $notifications = $this->getNotificationsForUser($user->id);
        $count = count($notifications);
        
        // Clear notifications
        Cache::forget($cacheKey);
        
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true, 
                'message' => "Berhasil menghapus {$count} notifikasi"
            ]);
        }
        
        return back()->with('success', 'Semua notifikasi telah dihapus.');
    }

    /**
     * Get session count for real-time updates
     */
    public function getSessionCount()
    {
        $user = User::find(Auth::id());
        $sessionCount = $this->sessionManagerService->getSessionCount($user->id);
        
        return response()->json(['count' => $sessionCount]);
    }

    /**
     * Get security score for real-time updates
     */
    public function getSecurityScore()
    {
        $user = User::find(Auth::id());
        
        // Get latest stats
        $loginStats = $this->loginActivityService->getLoginStats($user->id);
        $codeStats = $this->recoveryCodeService->getCodeStatistics($user->id);
        
        // Calculate security score
        $securityScore = 60; // Base score
        if($codeStats['has_codes']) $securityScore += 40;
        if($loginStats['success_rate'] > 90) $securityScore += 10;
        if($loginStats['suspicious_logins'] == 0) $securityScore += 10;
        $securityScore = min(100, $securityScore);
        
        return response()->json([
            'score' => $securityScore,
            'has_codes' => $codeStats['has_codes'],
            'success_rate' => $loginStats['success_rate'],
            'suspicious_logins' => $loginStats['suspicious_logins']
        ]);
    }

    /**
     * Get security stats for real-time updates
     */
    public function getSecurityStats()
    {
        $user = User::find(Auth::id());
        
        $loginStats = $this->loginActivityService->getLoginStats($user->id);
        $codeStats = $this->recoveryCodeService->getCodeStatistics($user->id);
        $sessionCount = $this->sessionManagerService->getSessionCount($user->id);
        $notificationCount = $this->getUnreadCount($user->id);
        
        return response()->json([
            'login_stats' => $loginStats,
            'code_stats' => $codeStats,
            'session_count' => $sessionCount,
            'notification_count' => $notificationCount
        ]);
    }

    /**
     * Check and notify suspicious activity
     */
    private function checkAndNotifySuspiciousActivity($userId)
    {
        // For now, just create some sample notifications for testing
        $notifications = $this->getNotificationsForUser($userId);
        
        // If no notifications exist, create some sample ones
        if (empty($notifications)) {
            $this->createSampleNotifications($userId);
        }
    }

    /**
     * Get notifications for user from cache
     */
    private function getNotificationsForUser($userId)
    {
        $cacheKey = "security_notifications_user_{$userId}";
        $notifications = Cache::get($cacheKey, []);
        
        // Update relative times
        foreach ($notifications as &$notification) {
            if (isset($notification['timestamp'])) {
                $timestamp = \Carbon\Carbon::parse($notification['timestamp']);
                $notification['time'] = $timestamp->diffForHumans();
            }
        }
        
        return $notifications;
    }

    /**
     * Mark notification as read
     */
    private function markAsRead($userId, $notificationId)
    {
        $cacheKey = "security_notifications_user_{$userId}";
        $notifications = Cache::get($cacheKey, []);
        
        foreach ($notifications as &$notification) {
            if ($notification['id'] === $notificationId) {
                $notification['read'] = true;
                break;
            }
        }
        
        Cache::put($cacheKey, $notifications, now()->addDays(7));
        
        return true;
    }

    /**
     * Delete a notification
     */
    private function deleteNotificationForUser($userId, $notificationId)
    {
        $cacheKey = "security_notifications_user_{$userId}";
        $notifications = Cache::get($cacheKey, []);
        
        $notifications = array_filter($notifications, function($notification) use ($notificationId) {
            return $notification['id'] !== $notificationId;
        });
        
        Cache::put($cacheKey, array_values($notifications), now()->addDays(7));
        
        return true;
    }

    /**
     * Clear all notifications for a user
     */
    private function clearNotificationsForUser($userId)
    {
        $cacheKey = "security_notifications_user_{$userId}";
        Cache::forget($cacheKey);
        
        return true;
    }

    /**
     * Get unread notifications count
     */
    private function getUnreadCount($userId)
    {
        $notifications = $this->getNotificationsForUser($userId);
        return collect($notifications)->where('read', false)->count();
    }

    /**
     * Get security summary (placeholder)
     */
    private function getSecuritySummary($userId)
    {
        return [
            'total_notifications' => count($this->getNotificationsForUser($userId)),
            'unread_notifications' => $this->getUnreadCount($userId)
        ];
    }

    /**
     * Create sample notifications for testing
     */
    private function createSampleNotifications($userId)
    {
        $sampleNotifications = [
            [
                'id' => uniqid('notif_'),
                'user_id' => $userId,
                'type' => 'new_device',
                'title' => 'Login dari Perangkat Baru',
                'message' => 'Anda berhasil login dari perangkat baru menggunakan Chrome di Windows.',
                'severity' => 'low',
                'data' => [],
                'timestamp' => now()->subMinutes(5)->toISOString(),
                'time' => '5 menit yang lalu',
                'read' => false,
                'created_at' => now()->subMinutes(5)
            ],
            [
                'id' => uniqid('notif_'),
                'user_id' => $userId,
                'type' => 'suspicious_location',
                'title' => 'Login dari Lokasi Baru',
                'message' => 'Terdeteksi login dari Jakarta, Indonesia. Jika ini bukan Anda, segera ubah password.',
                'severity' => 'medium',
                'data' => [],
                'timestamp' => now()->subHours(2)->toISOString(),
                'time' => '2 jam yang lalu',
                'read' => false,
                'created_at' => now()->subHours(2)
            ]
        ];

        $cacheKey = "security_notifications_user_{$userId}";
        Cache::put($cacheKey, $sampleNotifications, now()->addDays(7));
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]).+$/',
                'confirmed'
            ],
        ], [
            'password.regex' => 'Sandi harus mengandung setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu simbol.',
            'password.min' => 'Sandi harus minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi sandi tidak cocok.'
        ]);

        $user = User::find(Auth::id());

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Sandi saat ini yang Anda masukkan salah.']);
        }

        try {
            // Update password
            $user->password = Hash::make($request->password);
            $user->password_updated_at = now();
            $user->save();

            return redirect()->route('security.index')->with('success', 'Sandi berhasil diperbarui. Pastikan untuk menggunakan sandi baru saat login di perangkat lain.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui sandi.');
        }
    }

    /**
     * Show devices overview page
     */
    public function devices()
    {
        $user = User::find(Auth::id());
        $sessions = $this->deviceSessionService->getUserSessions($user->id);
        $deviceStats = $this->deviceSessionService->getDeviceStats($user->id);
        
        return view('auth.security.devices.index', compact(
            'user',
            'sessions',
            'deviceStats'
        ));
    }

    /**
     * Show device detail page
     */
    public function deviceDetail($sessionId)
    {
        $user = User::find(Auth::id());
        $session = $this->deviceSessionService->getSessionById($sessionId, $user->id);
        
        if (!$session) {
            return redirect()->route('security.devices')->with('error', 'Perangkat tidak ditemukan.');
        }
        
        return view('auth.security.devices.detail', compact(
            'user',
            'session'
        ));
    }

    /**
     * Revoke a specific device session
     */
    public function revokeDevice(Request $request, $sessionId)
    {
        $user = User::find(Auth::id());
        
        $result = $this->deviceSessionService->revokeSession($sessionId, $user->id);
        
        if ($result) {
            return redirect()->route('security.devices')->with('success', 'Perangkat berhasil dikeluarkan.');
        }
        
        return back()->with('error', 'Gagal mengeluarkan perangkat. Anda tidak dapat mengeluarkan perangkat yang sedang aktif.');
    }

    /**
     * Revoke all other device sessions
     */
    public function revokeAllDevices(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
            'force_logout' => 'sometimes|boolean'
        ]);

        $user = User::find(Auth::id());

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password yang Anda masukkan salah.']);
        }

        // Check if force logout is requested
        if ($request->boolean('force_logout')) {
            $revokedCount = $this->deviceSessionService->forceRevokeAllSessions($user->id);
            
            // Log out current user and redirect to login
            Auth::logout();
            return redirect()->route('login')->with('success', "Berhasil mengeluarkan semua {$revokedCount} perangkat dari akun Anda. Silakan login kembali.");
        } else {
            $revokedCount = $this->deviceSessionService->revokeAllOtherSessions($user->id);
            return back()->with('success', "Berhasil mengeluarkan {$revokedCount} perangkat lain dari akun Anda.");
        }
    }

    /**
     * Force revoke all sessions including current session (emergency logout)
     */
    public function forceRevokeAllDevices(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        $user = User::find(Auth::id());

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password yang Anda masukkan salah.']);
        }

        $revokedCount = $this->deviceSessionService->forceRevokeAllSessions($user->id);
        
        // Log out current user and redirect to login
        Auth::logout();
        return redirect()->route('login')->with('success', "Darurat! Berhasil mengeluarkan semua {$revokedCount} perangkat dari akun Anda. Silakan login kembali untuk keamanan.");
    }

    /**
     * Show password change form
     */
    public function editPassword()
    {
        $user = User::find(Auth::id());
        
        return view('auth.security.password.edit', compact('user'));
    }

    /**
     * Show login alerts page
     */
    public function loginAlerts()
    {
        $user = User::find(Auth::id());
        
        // Get login alerts with pagination
        $alerts = $this->loginAlertService->getUserAlerts($user->id, 20);
        
        // Get alert statistics
        $alertStats = $this->loginAlertService->getAlertStats($user->id);
        
        return view('auth.security.login-alerts.index', compact('user', 'alerts', 'alertStats'));
    }

    /**
     * Show login alert detail
     */
    public function loginAlertDetail(Request $request)
    {
        $user = User::find(Auth::id());
        $alertId = $request->query('id');
        
        if (!$alertId) {
            return redirect()->route('security.login-alerts')
                ->with('error', 'Alert ID tidak ditemukan.');
        }
        
        $alert = LoginAlert::with('loginActivity')
            ->where('user_id', $user->id)
            ->where('id', $alertId)
            ->firstOrFail();
        
        // Mark as read if not already read
        if ($alert->status === 'unread') {
            $alert->markAsRead();
            $this->loginAlertService->clearUserAlertCache($user->id);
        }
        
        return view('auth.security.login-alerts.detail', compact('user', 'alert'));
    }

    /**
     * Mark login alert as safe
     */
    public function markLoginAlertSafe(Request $request)
    {
        $user = User::find(Auth::id());
        $alertId = $request->input('id') ?? $request->query('id');
        
        if (!$alertId) {
            return response()->json([
                'success' => false,
                'message' => 'Alert ID tidak ditemukan'
            ], 400);
        }
        
        $result = $this->loginAlertService->markAlertSafe($alertId, $user->id);
        
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Alert telah ditandai sebagai aman'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal menandai alert sebagai aman'
        ], 400);
    }

    /**
     * Report suspicious login
     */
    public function reportSuspiciousLogin(Request $request)
    {
        $user = User::find(Auth::id());
        $alertId = $request->input('id') ?? $request->query('id');
        
        if (!$alertId) {
            return response()->json([
                'success' => false,
                'message' => 'Alert ID tidak ditemukan'
            ], 400);
        }
        
        $result = $this->loginAlertService->reportSuspiciousLogin($alertId, $user->id);
        
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Login mencurigakan telah dilaporkan'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal melaporkan login mencurigakan'
        ], 400);
    }

    /**
     * Show signin options page (alias to edit password)
     */
    public function signinOption()
    {
        $user = User::find(Auth::id());
        
        return view('auth.security.password.edit', compact('user'));
    }
}

