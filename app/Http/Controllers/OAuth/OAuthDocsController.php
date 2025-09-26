<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;

class OAuthDocsController extends Controller
{
    /**
     * Show OAuth documentation.
     */
    public function index()
    {
        return view('oauth.docs.index');
    }

    /**
     * Show developer guide.
     */
    public function developerGuide()
    {
        $markdownPath = base_path('docs/OAUTH_DEVELOPER_GUIDE.md');
        
        if (!File::exists($markdownPath)) {
            abort(404, 'Developer guide not found');
        }
        
        $markdown = File::get($markdownPath);
        $converter = new CommonMarkConverter();
        $html = $converter->convertToHtml($markdown);
        
        return view('oauth.docs.guide', [
            'title' => 'OAuth 2.0 Developer Guide',
            'content' => $html
        ]);
    }

    /**
     * Show API endpoints documentation.
     */
    public function apiReference()
    {
        return view('oauth.docs.api-reference');
    }

    /**
     * Show code examples.
     */
    public function examples()
    {
        return view('oauth.docs.examples');
    }

    /**
     * Generate OpenAPI specification.
     */
    public function openApiSpec()
    {
        $spec = [
            'openapi' => '3.0.0',
            'info' => [
                'title' => 'Centrova OAuth 2.0 API',
                'description' => 'OAuth 2.0 and OpenID Connect implementation for Centrova',
                'version' => '1.0.0',
                'contact' => [
                    'email' => 'developer@centrova.com'
                ]
            ],
            'servers' => [
                [
                    'url' => config('app.url'),
                    'description' => 'Production server'
                ]
            ],
            'paths' => [
                '/oauth/authorize' => [
                    'get' => [
                        'summary' => 'Authorization endpoint',
                        'description' => 'OAuth 2.0 authorization endpoint',
                        'parameters' => [
                            [
                                'name' => 'response_type',
                                'in' => 'query',
                                'required' => true,
                                'schema' => ['type' => 'string', 'enum' => ['code']]
                            ],
                            [
                                'name' => 'client_id',
                                'in' => 'query',
                                'required' => true,
                                'schema' => ['type' => 'string']
                            ],
                            [
                                'name' => 'redirect_uri',
                                'in' => 'query',
                                'required' => true,
                                'schema' => ['type' => 'string', 'format' => 'uri']
                            ],
                            [
                                'name' => 'scope',
                                'in' => 'query',
                                'required' => false,
                                'schema' => ['type' => 'string']
                            ],
                            [
                                'name' => 'state',
                                'in' => 'query',
                                'required' => false,
                                'schema' => ['type' => 'string']
                            ],
                            [
                                'name' => 'code_challenge',
                                'in' => 'query',
                                'required' => false,
                                'schema' => ['type' => 'string']
                            ],
                            [
                                'name' => 'code_challenge_method',
                                'in' => 'query',
                                'required' => false,
                                'schema' => ['type' => 'string', 'enum' => ['S256', 'plain']]
                            ]
                        ],
                        'responses' => [
                            '302' => [
                                'description' => 'Redirect to redirect_uri with authorization code or error'
                            ]
                        ]
                    ]
                ],
                '/oauth/token' => [
                    'post' => [
                        'summary' => 'Token endpoint',
                        'description' => 'Exchange authorization code for access token',
                        'requestBody' => [
                            'required' => true,
                            'content' => [
                                'application/x-www-form-urlencoded' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'required' => ['grant_type', 'client_id'],
                                        'properties' => [
                                            'grant_type' => [
                                                'type' => 'string',
                                                'enum' => ['authorization_code', 'refresh_token']
                                            ],
                                            'code' => ['type' => 'string'],
                                            'redirect_uri' => ['type' => 'string'],
                                            'client_id' => ['type' => 'string'],
                                            'client_secret' => ['type' => 'string'],
                                            'code_verifier' => ['type' => 'string'],
                                            'refresh_token' => ['type' => 'string'],
                                            'scope' => ['type' => 'string']
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Token response',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'access_token' => ['type' => 'string'],
                                                'token_type' => ['type' => 'string'],
                                                'expires_in' => ['type' => 'integer'],
                                                'refresh_token' => ['type' => 'string'],
                                                'scope' => ['type' => 'string']
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                '/oauth/userinfo' => [
                    'get' => [
                        'summary' => 'UserInfo endpoint',
                        'description' => 'Get user information based on granted scopes',
                        'security' => [
                            ['BearerAuth' => []]
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'User information',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'sub' => ['type' => 'string'],
                                                'name' => ['type' => 'string'],
                                                'preferred_username' => ['type' => 'string'],
                                                'email' => ['type' => 'string'],
                                                'email_verified' => ['type' => 'boolean'],
                                                'picture' => ['type' => 'string'],
                                                'phone_number' => ['type' => 'string'],
                                                'address' => ['type' => 'object']
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                '/oauth/revoke' => [
                    'post' => [
                        'summary' => 'Token revocation endpoint',
                        'description' => 'Revoke access or refresh token',
                        'requestBody' => [
                            'required' => true,
                            'content' => [
                                'application/x-www-form-urlencoded' => [
                                    'schema' => [
                                        'type' => 'object',
                                        'required' => ['token', 'client_id'],
                                        'properties' => [
                                            'token' => ['type' => 'string'],
                                            'client_id' => ['type' => 'string'],
                                            'client_secret' => ['type' => 'string'],
                                            'token_type_hint' => [
                                                'type' => 'string',
                                                'enum' => ['access_token', 'refresh_token']
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Token revoked successfully'
                            ]
                        ]
                    ]
                ]
            ],
            'components' => [
                'securitySchemes' => [
                    'BearerAuth' => [
                        'type' => 'http',
                        'scheme' => 'bearer'
                    ]
                ]
            ]
        ];

        return response()->json($spec);
    }
}
