<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class OAuthClient extends Model
{
    use HasFactory;

    protected $table = 'oauth_clients';

    protected $fillable = [
        'client_id',
        'client_secret',
        'name',
        'description',
        'redirect_uris',
        'scopes',
        'grant_types',
        'is_confidential',
        'is_active',
        'user_id',
        'website_url',
        'privacy_policy_url',
        'terms_of_service_url',
        'logo_url'
    ];

    protected $casts = [
        'redirect_uris' => 'array',
        'scopes' => 'array',
        'is_confidential' => 'boolean',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($client) {
            $client->client_id = (string) Str::uuid();
            $client->client_secret = Str::random(40);
        });
    }

    /**
     * Get the user that owns the OAuth client.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the authorization codes for this client.
     */
    public function authorizationCodes()
    {
        return $this->hasMany(OAuthAuthorizationCode::class, 'client_id', 'client_id');
    }

    /**
     * Get the access tokens for this client.
     */
    public function accessTokens()
    {
        return $this->hasMany(OAuthAccessToken::class, 'client_id', 'client_id');
    }

    /**
     * Check if the redirect URI is valid for this client.
     */
    public function isValidRedirectUri(string $redirectUri): bool
    {
        return in_array($redirectUri, $this->redirect_uris ?? []);
    }

    /**
     * Check if the client supports the given grant type.
     */
    public function supportsGrantType(string $grantType): bool
    {
        $grantTypes = explode(',', $this->grant_types);
        return in_array($grantType, $grantTypes);
    }

    /**
     * Check if the client can access the given scope.
     */
    public function canAccessScope(string $scope): bool
    {
        return in_array($scope, $this->scopes ?? []);
    }

    /**
     * Verify client secret.
     */
    public function verifySecret(string $secret): bool
    {
        return hash_equals($this->client_secret, $secret);
    }

    /**
     * Get allowed scopes as string.
     */
    public function getAllowedScopesString(): string
    {
        return implode(' ', $this->scopes ?? []);
    }
}
