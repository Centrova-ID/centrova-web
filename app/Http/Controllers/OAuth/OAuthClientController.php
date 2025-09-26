<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Models\OAuth\OAuthClient;
use App\Models\OAuth\OAuthScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OAuthClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's OAuth applications.
     */
    public function index()
    {
        $clients = OAuthClient::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        
        return view('oauth.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new OAuth application.
     */
    public function create()
    {
        $scopes = OAuthScope::all();
        
        return view('oauth.clients.create', compact('scopes'));
    }

    /**
     * Store a newly created OAuth application.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'redirect_uris' => 'required|array|min:1',
            'redirect_uris.*' => 'required|url',
            'website_url' => 'nullable|url',
            'privacy_policy_url' => 'nullable|url',
            'terms_of_service_url' => 'nullable|url',
            'scopes' => 'required|array|min:1',
            'scopes.*' => 'required|exists:oauth_scopes,scope',
            'is_confidential' => 'boolean'
        ]);

        try {
            $client = OAuthClient::create([
                'name' => $request->name,
                'description' => $request->description,
                'redirect_uris' => $request->redirect_uris,
                'scopes' => $request->scopes,
                'is_confidential' => $request->boolean('is_confidential', true),
                'user_id' => Auth::id(),
                'website_url' => $request->website_url,
                'privacy_policy_url' => $request->privacy_policy_url,
                'terms_of_service_url' => $request->terms_of_service_url,
            ]);

            return redirect()->route('oauth.clients.show', $client)
                ->with('success', 'OAuth application created successfully!');

        } catch (\Exception $e) {
            Log::error('OAuth Client Creation Error: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'An error occurred while creating the application.');
        }
    }

    /**
     * Display the specified OAuth application.
     */
    public function show(OAuthClient $client)
    {
        $this->authorize('view', $client);
        
        $scopes = OAuthScope::whereIn('scope', $client->scopes ?? [])->get();
        
        return view('oauth.clients.show', compact('client', 'scopes'));
    }

    /**
     * Show the form for editing the specified OAuth application.
     */
    public function edit(OAuthClient $client)
    {
        $this->authorize('update', $client);
        
        $scopes = OAuthScope::all();
        
        return view('oauth.clients.edit', compact('client', 'scopes'));
    }

    /**
     * Update the specified OAuth application.
     */
    public function update(Request $request, OAuthClient $client)
    {
        $this->authorize('update', $client);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'redirect_uris' => 'required|array|min:1',
            'redirect_uris.*' => 'required|url',
            'website_url' => 'nullable|url',
            'privacy_policy_url' => 'nullable|url',
            'terms_of_service_url' => 'nullable|url',
            'scopes' => 'required|array|min:1',
            'scopes.*' => 'required|exists:oauth_scopes,scope',
        ]);

        try {
            $client->update([
                'name' => $request->name,
                'description' => $request->description,
                'redirect_uris' => $request->redirect_uris,
                'scopes' => $request->scopes,
                'website_url' => $request->website_url,
                'privacy_policy_url' => $request->privacy_policy_url,
                'terms_of_service_url' => $request->terms_of_service_url,
            ]);

            return redirect()->route('oauth.clients.show', $client)
                ->with('success', 'OAuth application updated successfully!');

        } catch (\Exception $e) {
            Log::error('OAuth Client Update Error: ' . $e->getMessage());
            
            return back()->withInput()
                ->with('error', 'An error occurred while updating the application.');
        }
    }

    /**
     * Remove the specified OAuth application.
     */
    public function destroy(OAuthClient $client)
    {
        $this->authorize('delete', $client);

        try {
            $client->delete();
            
            return redirect()->route('oauth.clients.index')
                ->with('success', 'OAuth application deleted successfully!');

        } catch (\Exception $e) {
            Log::error('OAuth Client Deletion Error: ' . $e->getMessage());
            
            return back()->with('error', 'An error occurred while deleting the application.');
        }
    }

    /**
     * Regenerate client secret.
     */
    public function regenerateSecret(OAuthClient $client)
    {
        $this->authorize('update', $client);

        try {
            $client->update([
                'client_secret' => \Illuminate\Support\Str::random(40)
            ]);

            return redirect()->route('oauth.clients.show', $client)
                ->with('success', 'Client secret regenerated successfully!')
                ->with('show_secret', true);

        } catch (\Exception $e) {
            Log::error('OAuth Client Secret Regeneration Error: ' . $e->getMessage());
            
            return back()->with('error', 'An error occurred while regenerating the client secret.');
        }
    }

    /**
     * Toggle client active status.
     */
    public function toggleStatus(OAuthClient $client)
    {
        $this->authorize('update', $client);

        try {
            $client->update([
                'is_active' => !$client->is_active
            ]);

            $status = $client->is_active ? 'activated' : 'deactivated';
            
            return redirect()->route('oauth.clients.show', $client)
                ->with('success', "OAuth application {$status} successfully!");

        } catch (\Exception $e) {
            Log::error('OAuth Client Status Toggle Error: ' . $e->getMessage());
            
            return back()->with('error', 'An error occurred while updating the application status.');
        }
    }

    /**
     * Show OAuth application tokens and analytics.
     */
    public function tokens(OAuthClient $client)
    {
        $this->authorize('view', $client);

        $activeTokens = $client->accessTokens()
            ->where('revoked', false)
            ->where('expires_at', '>', now())
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('oauth.clients.tokens', compact('client', 'activeTokens'));
    }
}
