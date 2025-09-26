# Centrova OAuth 2.0 Developer Guide

## Overview

Centrova OAuth 2.0 memungkinkan aplikasi pihak ketiga untuk mengakses data pengguna Centrova dengan aman menggunakan standar OAuth 2.0 dan OpenID Connect. Sistem ini memungkinkan pengguna untuk memberikan izin terbatas kepada aplikasi tanpa membagikan password mereka.

## Endpoints

### Authorization Server Endpoints

- **Discovery Endpoint**: `GET /.well-known/openid_configuration`
- **Authorization Endpoint**: `GET /oauth/authorize`  
- **Token Endpoint**: `POST /oauth/token`
- **UserInfo Endpoint**: `GET /oauth/userinfo`
- **Token Revocation**: `POST /oauth/revoke`
- **JWKS Endpoint**: `GET /.well-known/jwks.json`

### Base URL
```
Production: https://centrova.com
Development: http://localhost:8000
```

## Registering an Application

1. Login ke akun Centrova Anda
2. Pergi ke Developer Settings (`/developer/oauth/applications`)
3. Klik "Create New Application"
4. Isi informasi aplikasi:
   - **Name**: Nama aplikasi yang akan ditampilkan ke user
   - **Description**: Deskripsi singkat aplikasi
   - **Redirect URIs**: URL callback yang valid (satu per baris)
   - **Website URL**: URL website aplikasi (opsional)
   - **Scopes**: Permission yang dibutuhkan aplikasi
   - **Client Type**: Confidential (untuk server-side app) atau Public (untuk client-side app)

5. Simpan aplikasi dan catat `client_id` dan `client_secret`

## Available Scopes

| Scope | Description |
|-------|-------------|
| `openid` | OpenID Connect identifier |
| `profile` | Basic profile information (name, username, avatar) |
| `email` | Email address |
| `phone` | Phone number |
| `address` | Address information |
| `offline_access` | Refresh token untuk akses offline |
| `read` | Read access to account data |
| `write` | Limited write access to account data |

## Authorization Code Flow

### Step 1: Authorization Request

Redirect user ke authorization endpoint:

```
GET /oauth/authorize?response_type=code&client_id=CLIENT_ID&redirect_uri=REDIRECT_URI&scope=SCOPE&state=STATE&code_challenge=CODE_CHALLENGE&code_challenge_method=S256
```

**Parameters:**
- `response_type`: Harus `code`
- `client_id`: Client ID aplikasi Anda
- `redirect_uri`: Redirect URI yang terdaftar
- `scope`: Space-separated scopes yang diminta
- `state`: Random string untuk CSRF protection
- `code_challenge`: PKCE code challenge (recommended)
- `code_challenge_method`: `S256` atau `plain`

**Example:**
```
https://centrova.com/oauth/authorize?response_type=code&client_id=your-client-id&redirect_uri=https://yourapp.com/callback&scope=openid%20profile%20email&state=xyz&code_challenge=E9Melhoa2OwvFrEMTJguCHaoeK1t8URWbuGJSstw-cM&code_challenge_method=S256
```

### Step 2: Authorization Response

Setelah user memberikan izin, mereka akan di-redirect ke `redirect_uri`:

**Success:**
```
https://yourapp.com/callback?code=AUTHORIZATION_CODE&state=STATE
```

**Error:**
```
https://yourapp.com/callback?error=access_denied&error_description=User%20denied%20access&state=STATE
```

### Step 3: Token Exchange

Exchange authorization code untuk access token:

```http
POST /oauth/token
Content-Type: application/x-www-form-urlencoded

grant_type=authorization_code&
code=AUTHORIZATION_CODE&
redirect_uri=REDIRECT_URI&
client_id=CLIENT_ID&
client_secret=CLIENT_SECRET&
code_verifier=CODE_VERIFIER
```

**Response:**
```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
    "token_type": "Bearer",
    "expires_in": 3600,
    "refresh_token": "def50200...",
    "scope": "openid profile email"
}
```

## Refresh Token Flow

Untuk memperbarui access token yang expired:

```http
POST /oauth/token
Content-Type: application/x-www-form-urlencoded

grant_type=refresh_token&
refresh_token=REFRESH_TOKEN&
client_id=CLIENT_ID&
client_secret=CLIENT_SECRET&
scope=SCOPE
```

## Using Access Tokens

Gunakan access token untuk mengakses protected resources:

```http
GET /api/v1/me
Authorization: Bearer ACCESS_TOKEN
```

## UserInfo Endpoint

Mendapatkan informasi user berdasarkan scopes yang diberikan:

```http
GET /oauth/userinfo
Authorization: Bearer ACCESS_TOKEN
```

**Response example:**
```json
{
    "sub": "123456",
    "name": "John Doe",
    "preferred_username": "johndoe",
    "email": "john@example.com",
    "email_verified": true,
    "picture": "https://centrova.com/avatars/johndoe.jpg"
}
```

## Token Revocation

Untuk revoke access atau refresh token:

```http
POST /oauth/revoke
Content-Type: application/x-www-form-urlencoded

token=ACCESS_TOKEN_OR_REFRESH_TOKEN&
client_id=CLIENT_ID&
client_secret=CLIENT_SECRET&
token_type_hint=access_token
```

## PKCE (Proof Key for Code Exchange)

Untuk keamanan tambahan, gunakan PKCE:

### Generate Code Verifier dan Challenge

```javascript
// Generate code verifier
const codeVerifier = base64URLEncode(crypto.randomBytes(32));

// Generate code challenge  
const codeChallenge = base64URLEncode(crypto.createHash('sha256').update(codeVerifier).digest());
```

### Authorization Request dengan PKCE

```
https://centrova.com/oauth/authorize?response_type=code&client_id=CLIENT_ID&redirect_uri=REDIRECT_URI&scope=SCOPE&state=STATE&code_challenge=CODE_CHALLENGE&code_challenge_method=S256
```

### Token Request dengan Code Verifier

```http
POST /oauth/token
Content-Type: application/x-www-form-urlencoded

grant_type=authorization_code&
code=AUTHORIZATION_CODE&
redirect_uri=REDIRECT_URI&
client_id=CLIENT_ID&
code_verifier=CODE_VERIFIER
```

## Code Examples

### PHP Example

```php
<?php
// Step 1: Authorization URL
$params = [
    'response_type' => 'code',
    'client_id' => 'your-client-id',
    'redirect_uri' => 'https://yourapp.com/callback',
    'scope' => 'openid profile email',
    'state' => bin2hex(random_bytes(16))
];

$authUrl = 'https://centrova.com/oauth/authorize?' . http_build_query($params);
header('Location: ' . $authUrl);

// Step 2: Handle callback
if (isset($_GET['code'])) {
    $tokenData = [
        'grant_type' => 'authorization_code',
        'code' => $_GET['code'],
        'redirect_uri' => 'https://yourapp.com/callback',
        'client_id' => 'your-client-id',
        'client_secret' => 'your-client-secret'
    ];
    
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($tokenData)
        ]
    ]);
    
    $response = file_get_contents('https://centrova.com/oauth/token', false, $context);
    $token = json_decode($response, true);
    
    // Step 3: Use access token
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => 'Authorization: Bearer ' . $token['access_token']
        ]
    ]);
    
    $userInfo = file_get_contents('https://centrova.com/oauth/userinfo', false, $context);
    $user = json_decode($userInfo, true);
    
    echo "Welcome " . $user['name'];
}
?>
```

### JavaScript Example

```javascript
// Step 1: Authorization (client-side)
const authParams = new URLSearchParams({
    response_type: 'code',
    client_id: 'your-client-id',
    redirect_uri: 'https://yourapp.com/callback',
    scope: 'openid profile email',
    state: Math.random().toString(36).substring(7)
});

window.location.href = `https://centrova.com/oauth/authorize?${authParams}`;

// Step 2: Handle callback (server-side)
const tokenResponse = await fetch('https://centrova.com/oauth/token', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
        grant_type: 'authorization_code',
        code: authorizationCode,
        redirect_uri: 'https://yourapp.com/callback',
        client_id: 'your-client-id',
        client_secret: 'your-client-secret'
    })
});

const tokens = await tokenResponse.json();

// Step 3: Get user info
const userResponse = await fetch('https://centrova.com/oauth/userinfo', {
    headers: {
        'Authorization': `Bearer ${tokens.access_token}`
    }
});

const user = await userResponse.json();
console.log('User:', user);
```

### Python Example

```python
import requests
import secrets
import base64
import hashlib

# Step 1: Generate PKCE
code_verifier = base64.urlsafe_b64encode(secrets.token_bytes(32)).decode('utf-8').rstrip('=')
code_challenge = base64.urlsafe_b64encode(hashlib.sha256(code_verifier.encode()).digest()).decode('utf-8').rstrip('=')

# Authorization URL
auth_params = {
    'response_type': 'code',
    'client_id': 'your-client-id',
    'redirect_uri': 'https://yourapp.com/callback',
    'scope': 'openid profile email',
    'state': secrets.token_urlsafe(),
    'code_challenge': code_challenge,
    'code_challenge_method': 'S256'
}

auth_url = f"https://centrova.com/oauth/authorize?{requests.compat.urlencode(auth_params)}"
print(f"Go to: {auth_url}")

# Step 2: Exchange code for token
def exchange_code_for_token(authorization_code):
    token_data = {
        'grant_type': 'authorization_code',
        'code': authorization_code,
        'redirect_uri': 'https://yourapp.com/callback',
        'client_id': 'your-client-id',
        'client_secret': 'your-client-secret',
        'code_verifier': code_verifier
    }
    
    response = requests.post('https://centrova.com/oauth/token', data=token_data)
    return response.json()

# Step 3: Get user info
def get_user_info(access_token):
    headers = {'Authorization': f'Bearer {access_token}'}
    response = requests.get('https://centrova.com/oauth/userinfo', headers=headers)
    return response.json()
```

## Error Responses

### Authorization Errors

- `invalid_request`: Missing or invalid parameters
- `unauthorized_client`: Client not authorized
- `access_denied`: User denied access
- `unsupported_response_type`: Invalid response_type
- `invalid_scope`: Invalid scope
- `server_error`: Server error
- `temporarily_unavailable`: Service temporarily unavailable

### Token Errors

- `invalid_request`: Missing or invalid parameters
- `invalid_client`: Invalid client credentials
- `invalid_grant`: Invalid authorization code
- `unauthorized_client`: Client not authorized
- `unsupported_grant_type`: Grant type not supported
- `invalid_scope`: Invalid scope

## Security Considerations

1. **Always use HTTPS** in production
2. **Validate state parameter** untuk CSRF protection
3. **Use PKCE** untuk public clients
4. **Store client secrets securely** dan jangan expose di client-side code
5. **Implement proper token storage** (secure httpOnly cookies or secure storage)
6. **Set appropriate token expiration**
7. **Revoke tokens** when user logs out
8. **Validate redirect URIs** strictly

## Rate Limiting

- Authorization endpoint: 10 requests per minute per IP
- Token endpoint: 30 requests per minute per client
- UserInfo endpoint: 100 requests per minute per token

## Testing

Untuk testing di development environment:

1. Akses `/oauth/test/client` untuk mendapatkan test client credentials
2. Akses `/oauth/test/auth-url` untuk mendapatkan test authorization URL
3. Gunakan credentials ini hanya untuk development

## Support

Untuk bantuan dan pertanyaan:
- Email: developer@centrova.com
- Documentation: https://docs.centrova.com/oauth
- GitHub Issues: https://github.com/centrova/oauth-issues

## Changelog

- **v1.0.0**: Initial OAuth 2.0 implementation
- Support untuk Authorization Code flow dengan PKCE
- OpenID Connect compatibility
- Refresh token support
