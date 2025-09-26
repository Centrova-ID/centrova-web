<?php

namespace App\Services;

use App\Models\Account\User;
use App\Models\Account\MultiAccountSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class MultiAccountService
{
    /**
     * Get current session ID for multi-account management
     */
    private function getMultiAccountSessionId()
    {
        $sessionId = Session::get('multi_account_session_id');
        
        if (!$sessionId) {
            $sessionId = Session::getId() . '_' . uniqid();
            Session::put('multi_account_session_id', $sessionId);
        }
        
        return $sessionId;
    }

    /**
     * Add account to current session
     */
    public function addAccount($user, $makeActive = true)
    {
        $sessionId = $this->getMultiAccountSessionId();
        
        return MultiAccountSession::addAccountToSession($sessionId, $user->id, $makeActive);
    }

    /**
     * Switch to different account
     */
    public function switchAccount($userId)
    {
        $sessionId = $this->getMultiAccountSessionId();
        
        // Check if user has access to this account
        $accountSession = MultiAccountSession::forSession($sessionId)
            ->where('user_id', $userId)
            ->first();
            
        if (!$accountSession) {
            throw new \Exception('Account not found in current session');
        }

        // Switch the active account
        MultiAccountSession::switchActiveAccount($sessionId, $userId);
        
        // Update Laravel's auth
        $user = User::find($userId);
        Auth::login($user, true);
        
        // Update session data
        Session::put('current_account_id', $userId);
        
        return $user;
    }

    /**
     * Remove account from session
     */
    public function removeAccount($userId)
    {
        $sessionId = $this->getMultiAccountSessionId();
        
        $removed = MultiAccountSession::removeAccountFromSession($sessionId, $userId);
        
        // If we removed the current active account, switch to another one
        $currentActiveAccount = $this->getCurrentActiveAccount();
        if (!$currentActiveAccount || $currentActiveAccount->user_id == $userId) {
            $remainingAccounts = $this->getLinkedAccounts();
            if ($remainingAccounts->isNotEmpty()) {
                $this->switchAccount($remainingAccounts->first()->user_id);
            } else {
                // No accounts left, logout completely
                $this->logoutAll();
            }
        }
        
        return $removed;
    }

    /**
     * Get all linked accounts for current session
     */
    public function getLinkedAccounts()
    {
        $sessionId = $this->getMultiAccountSessionId();
        
        return MultiAccountSession::getActiveAccountsForSession($sessionId);
    }

    /**
     * Get current active account
     */
    public function getCurrentActiveAccount()
    {
        $sessionId = $this->getMultiAccountSessionId();
        
        return MultiAccountSession::getCurrentActiveAccount($sessionId);
    }

    /**
     * Check if user has multiple accounts linked
     */
    public function hasMultipleAccounts()
    {
        return $this->getLinkedAccounts()->count() > 1;
    }

    /**
     * Login with additional account
     */
    public function loginAdditionalAccount($credentials, $remember = false)
    {
        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            
            // Check if this account is already linked
            $sessionId = $this->getMultiAccountSessionId();
            $existingSession = MultiAccountSession::forSession($sessionId)
                ->where('user_id', $user->id)
                ->first();
                
            if ($existingSession) {
                // Account already linked, just switch to it
                $this->switchAccount($user->id);
                return [
                    'success' => true,
                    'message' => 'Switched to existing linked account',
                    'user' => $user,
                    'type' => 'switch'
                ];
            }
            
            // Add new account to session
            $this->addAccount($user, true);
            
            return [
                'success' => true,
                'message' => 'Account added successfully',
                'user' => $user,
                'type' => 'add'
            ];
        }
        
        return [
            'success' => false,
            'message' => 'Invalid credentials'
        ];
    }

    /**
     * Logout from all accounts
     */
    public function logoutAll()
    {
        $sessionId = $this->getMultiAccountSessionId();
        $userId = auth()->id(); // Get current user ID before logout
        
        // Remove all account sessions
        MultiAccountSession::forSession($sessionId)->delete();
        
        // Clear device cache for real-time updates
        if ($userId) {
            $realTimeDeviceService = app(RealTimeDeviceService::class);
            $realTimeDeviceService->clearCache($userId);
            
            // Also clear account data cache
            \Illuminate\Support\Facades\Cache::forget("account_overview_user_{$userId}");
            
            // Fire event for cache clearing
            event(new \App\Events\SessionUpdated($userId, 'logout'));
        }
        
        // Clear Laravel session
        Auth::logout();
        Session::flush();
        Session::regenerate();
    }

    /**
     * Logout from current account only
     */
    public function logoutCurrent()
    {
        $currentAccount = $this->getCurrentActiveAccount();
        
        if ($currentAccount) {
            $this->removeAccount($currentAccount->user_id);
        }
    }

    /**
     * Get account switching data for frontend
     */
    public function getAccountSwitchingData()
    {
        $linkedAccounts = $this->getLinkedAccounts();
        $currentAccount = $this->getCurrentActiveAccount();
        
        return [
            'current_account' => $currentAccount ? $currentAccount->user : null,
            'linked_accounts' => $linkedAccounts->map(function ($session) use ($currentAccount) {
                return [
                    'id' => $session->user->id,
                    'name' => $session->user->name,
                    'email' => $session->user->email,
                    'username' => $session->user->username,
                    'profile_picture' => $session->user->profile_picture,
                    'is_active' => $currentAccount && $currentAccount->user_id == $session->user->id,
                    'last_activity' => $session->last_activity,
                ];
            }),
            'has_multiple' => $linkedAccounts->count() > 1
        ];
    }

    /**
     * Initialize multi-account session for existing auth
     */
    public function initializeForExistingAuth()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionId = $this->getMultiAccountSessionId();
            
            // Check if user is already in multi-account session
            $existingSession = MultiAccountSession::forSession($sessionId)
                ->where('user_id', $user->id)
                ->first();
                
            if (!$existingSession) {
                $this->addAccount($user, true);
            }
        }
    }

    /**
     * Clean up old sessions
     */
    public function cleanup()
    {
        return MultiAccountSession::cleanupExpiredSessions(24);
    }
}
