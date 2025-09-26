<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OAuth\OAuthScope;

class OAuthScopesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scopes = [
            [
                'scope' => 'openid',
                'name' => 'OpenID Connect',
                'description' => 'Allows the application to identify you',
                'is_default' => true
            ],
            [
                'scope' => 'profile',
                'name' => 'Profile Information',
                'description' => 'Access to your basic profile information (name, username, avatar)',
                'is_default' => true
            ],
            [
                'scope' => 'email',
                'name' => 'Email Address',
                'description' => 'Access to your email address',
                'is_default' => true
            ],
            [
                'scope' => 'phone',
                'name' => 'Phone Number',
                'description' => 'Access to your phone number',
                'is_default' => false
            ],
            [
                'scope' => 'address',
                'name' => 'Address Information',
                'description' => 'Access to your address information',
                'is_default' => false
            ],
            [
                'scope' => 'offline_access',
                'name' => 'Offline Access',
                'description' => 'Allows the application to access your account when you are not actively using it',
                'is_default' => false
            ],
            [
                'scope' => 'read',
                'name' => 'Read Access',
                'description' => 'Read access to your account data',
                'is_default' => false
            ],
            [
                'scope' => 'write',
                'name' => 'Write Access',
                'description' => 'Write access to your account data (limited scope)',
                'is_default' => false
            ]
        ];

        foreach ($scopes as $scope) {
            OAuthScope::updateOrCreate(
                ['scope' => $scope['scope']],
                $scope
            );
        }
    }
}
