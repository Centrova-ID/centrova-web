<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Services\MultiAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MultiAccountController extends Controller
{
    protected MultiAccountService $multiAccountService;

    public function __construct(MultiAccountService $multiAccountService)
    {
        $this->middleware('auth');
        $this->multiAccountService = $multiAccountService;
    }

    /**
     * Get current account switching data
     */
    public function index()
    {
        $data = $this->multiAccountService->getAccountSwitchingData();
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Switch to different account
     */
    public function switch(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);

        try {
            $user = $this->multiAccountService->switchAccount($request->user_id);
            
            return response()->json([
                'success' => true,
                'message' => 'Successfully switched to account: ' . $user->name,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                    'profile_picture' => $user->profile_picture,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Add new account to session
     */
    public function addAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Nama pengguna atau email harus diisi',
            'password.required' => 'Kata sandi harus diisi',
        ]);

        if ($validator->fails()) {
            // If this is a form submission (not AJAX), redirect back with errors
            if ($request->has('add_account')) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Determine login field (email or username)
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $credentials = [
            $loginField => $request->login,
            'password' => $request->password
        ];

        try {
            $result = $this->multiAccountService->loginAdditionalAccount($credentials, false);
            
            if ($result['success']) {
                // If this is a form submission (not AJAX), redirect to dashboard with success
                if ($request->has('add_account')) {
                    return redirect()->route('account')
                        ->with('success', $result['message']);
                }
                
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'type' => $result['type'],
                    'user' => [
                        'id' => $result['user']->id,
                        'name' => $result['user']->name,
                        'email' => $result['user']->email,
                        'username' => $result['user']->username,
                        'profile_picture' => $result['user']->profile_picture,
                    ],
                    'data' => $this->multiAccountService->getAccountSwitchingData()
                ]);
            } else {
                // If this is a form submission (not AJAX), redirect back with error
                if ($request->has('add_account')) {
                    return redirect()->back()
                        ->withErrors(['login' => $result['message']])
                        ->withInput();
                }
                
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 401);
            }
        } catch (\Exception $e) {
            // If this is a form submission (not AJAX), redirect back with error
            if ($request->has('add_account')) {
                return redirect()->back()
                    ->withErrors(['login' => 'An error occurred while adding account'])
                    ->withInput();
            }
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding account'
            ], 500);
        }
    }

    /**
     * Remove account from session
     */
    public function removeAccount(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id'
        ]);

        try {
            // Prevent removing the last account
            $linkedAccounts = $this->multiAccountService->getLinkedAccounts();
            if ($linkedAccounts->count() <= 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot remove the last linked account. Use logout instead.'
                ], 400);
            }

            $this->multiAccountService->removeAccount($request->user_id);
            
            return response()->json([
                'success' => true,
                'message' => 'Account removed successfully',
                'data' => $this->multiAccountService->getAccountSwitchingData()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Logout from current account only
     */
    public function logoutCurrent()
    {
        try {
            $this->multiAccountService->logoutCurrent();
            
            return response()->json([
                'success' => true,
                'message' => 'Logged out from current account',
                'data' => $this->multiAccountService->getAccountSwitchingData()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Logout from all accounts
     */
    public function logoutAll()
    {
        try {
            $this->multiAccountService->logoutAll();
            
            return response()->json([
                'success' => true,
                'message' => 'Logged out from all accounts',
                'redirect' => route('login')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show account switching modal view
     */
    public function showSwitcher()
    {
        $data = $this->multiAccountService->getAccountSwitchingData();
        
        return view('auth.components.account-switcher', $data);
    }

    /**
     * Show add account form for authenticated users
     */
    public function showAddAccount()
    {
        // This endpoint allows authenticated users to add new accounts
        // without being blocked by guest middleware
        return view('auth.login', [
            'isAddingAccount' => true,
            'returnUrl' => route('account')
        ]);
    }
}
