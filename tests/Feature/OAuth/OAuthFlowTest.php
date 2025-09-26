<?php

namespace Tests\Feature\OAuth;

use Tests\TestCase;
use App\Models\User;
use App\Models\OAuth\OAuthClient;
use App\Models\OAuth\OAuthScope;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class OAuthFlowTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test user
        $this->user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Seed OAuth scopes
        $scopes = [
            ['scope' => 'openid', 'name' => 'OpenID', 'description' => 'OpenID Connect', 'is_default' => true],
            ['scope' => 'profile', 'name' => 'Profile', 'description' => 'Profile info', 'is_default' => true],
            ['scope' => 'email', 'name' => 'Email', 'description' => 'Email address', 'is_default' => true],
        ];

        foreach ($scopes as $scope) {
            OAuthScope::create($scope);
        }

        // Create test OAuth client
        $this->client = OAuthClient::create([
            'name' => 'Test Application',
            'description' => 'Test OAuth application',
            'redirect_uris' => ['http://localhost:3000/callback'],
            'scopes' => ['openid', 'profile', 'email'],
            'user_id' => $this->user->id,
        ]);
    }

    public function test_authorization_request_shows_consent_form()
    {
        $this->actingAs($this->user);

        $response = $this->get('/oauth/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id' => $this->client->client_id,
            'redirect_uri' => 'http://localhost:3000/callback',
            'scope' => 'openid profile email',
            'state' => 'test-state'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('oauth.authorize');
        $response->assertSee($this->client->name);
        $response->assertSee('OpenID');
        $response->assertSee('Profile');
        $response->assertSee('Email');
    }

    public function test_authorization_request_redirects_to_login_when_unauthenticated()
    {
        $response = $this->get('/oauth/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id' => $this->client->client_id,
            'redirect_uri' => 'http://localhost:3000/callback',
            'scope' => 'openid profile email',
            'state' => 'test-state'
        ]));

        $response->assertRedirect(route('login'));
    }

    public function test_authorization_approval_generates_code()
    {
        $this->actingAs($this->user);

        $response = $this->post('/oauth/authorize', [
            'client_id' => $this->client->client_id,
            'redirect_uri' => 'http://localhost:3000/callback',
            'scope' => 'openid profile email',
            'state' => 'test-state',
            'action' => 'approve'
        ]);

        $response->assertStatus(302);
        $redirectUrl = $response->getTargetUrl();
        
        $this->assertStringStartsWith('http://localhost:3000/callback', $redirectUrl);
        $this->assertStringContainsString('code=', $redirectUrl);
        $this->assertStringContainsString('state=test-state', $redirectUrl);
    }

    public function test_authorization_denial_returns_error()
    {
        $this->actingAs($this->user);

        $response = $this->post('/oauth/authorize', [
            'client_id' => $this->client->client_id,
            'redirect_uri' => 'http://localhost:3000/callback',
            'scope' => 'openid profile email',
            'state' => 'test-state',
            'action' => 'deny'
        ]);

        $response->assertStatus(302);
        $redirectUrl = $response->getTargetUrl();
        
        $this->assertStringStartsWith('http://localhost:3000/callback', $redirectUrl);
        $this->assertStringContainsString('error=access_denied', $redirectUrl);
        $this->assertStringContainsString('state=test-state', $redirectUrl);
    }

    public function test_token_exchange_with_authorization_code()
    {
        // First get authorization code
        $this->actingAs($this->user);
        
        $response = $this->post('/oauth/authorize', [
            'client_id' => $this->client->client_id,
            'redirect_uri' => 'http://localhost:3000/callback',
            'scope' => 'openid profile email',
            'action' => 'approve'
        ]);

        $redirectUrl = $response->getTargetUrl();
        parse_str(parse_url($redirectUrl, PHP_URL_QUERY), $query);
        $authCode = $query['code'];

        // Exchange code for token
        $tokenResponse = $this->post('/oauth/token', [
            'grant_type' => 'authorization_code',
            'code' => $authCode,
            'redirect_uri' => 'http://localhost:3000/callback',
            'client_id' => $this->client->client_id,
            'client_secret' => $this->client->client_secret,
        ]);

        $tokenResponse->assertStatus(200);
        $token = $tokenResponse->json();

        $this->assertArrayHasKey('access_token', $token);
        $this->assertArrayHasKey('token_type', $token);
        $this->assertArrayHasKey('expires_in', $token);
        $this->assertEquals('Bearer', $token['token_type']);
        $this->assertStringContainsString('openid', $token['scope']);
    }

    public function test_userinfo_endpoint_with_valid_token()
    {
        // Get access token first
        $this->actingAs($this->user);
        
        $response = $this->post('/oauth/authorize', [
            'client_id' => $this->client->client_id,
            'redirect_uri' => 'http://localhost:3000/callback',
            'scope' => 'openid profile email',
            'action' => 'approve'
        ]);

        $redirectUrl = $response->getTargetUrl();
        parse_str(parse_url($redirectUrl, PHP_URL_QUERY), $query);
        $authCode = $query['code'];

        $tokenResponse = $this->post('/oauth/token', [
            'grant_type' => 'authorization_code',
            'code' => $authCode,
            'redirect_uri' => 'http://localhost:3000/callback',
            'client_id' => $this->client->client_id,
            'client_secret' => $this->client->client_secret,
        ]);

        $token = $tokenResponse->json();
        $accessToken = $token['access_token'];

        // Test userinfo endpoint
        $userInfoResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('/oauth/userinfo');

        $userInfoResponse->assertStatus(200);
        $userInfo = $userInfoResponse->json();

        $this->assertArrayHasKey('sub', $userInfo);
        $this->assertArrayHasKey('name', $userInfo);
        $this->assertArrayHasKey('preferred_username', $userInfo);
        $this->assertArrayHasKey('email', $userInfo);
        $this->assertEquals($this->user->id, $userInfo['sub']);
        $this->assertEquals($this->user->name, $userInfo['name']);
        $this->assertEquals($this->user->email, $userInfo['email']);
    }

    public function test_token_revocation()
    {
        // Get access token first
        $this->actingAs($this->user);
        
        $response = $this->post('/oauth/authorize', [
            'client_id' => $this->client->client_id,
            'redirect_uri' => 'http://localhost:3000/callback',
            'scope' => 'openid profile email',
            'action' => 'approve'
        ]);

        $redirectUrl = $response->getTargetUrl();
        parse_str(parse_url($redirectUrl, PHP_URL_QUERY), $query);
        $authCode = $query['code'];

        $tokenResponse = $this->post('/oauth/token', [
            'grant_type' => 'authorization_code',
            'code' => $authCode,
            'redirect_uri' => 'http://localhost:3000/callback',
            'client_id' => $this->client->client_id,
            'client_secret' => $this->client->client_secret,
        ]);

        $token = $tokenResponse->json();
        $accessToken = $token['access_token'];

        // Revoke token
        $revokeResponse = $this->post('/oauth/revoke', [
            'token' => $accessToken,
            'client_id' => $this->client->client_id,
            'client_secret' => $this->client->client_secret,
        ]);

        $revokeResponse->assertStatus(200);

        // Try to use revoked token
        $userInfoResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('/oauth/userinfo');

        $userInfoResponse->assertStatus(401);
    }

    public function test_discovery_endpoint()
    {
        $response = $this->get('/.well-known/openid_configuration');
        
        $response->assertStatus(200);
        $discovery = $response->json();
        
        $this->assertArrayHasKey('issuer', $discovery);
        $this->assertArrayHasKey('authorization_endpoint', $discovery);
        $this->assertArrayHasKey('token_endpoint', $discovery);
        $this->assertArrayHasKey('userinfo_endpoint', $discovery);
        $this->assertArrayHasKey('scopes_supported', $discovery);
        $this->assertContains('openid', $discovery['scopes_supported']);
        $this->assertContains('profile', $discovery['scopes_supported']);
        $this->assertContains('email', $discovery['scopes_supported']);
    }
}
