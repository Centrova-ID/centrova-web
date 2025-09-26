<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataRetentionPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policies = [
            [
                'data_type' => 'login_activities',
                'table_name' => 'user_login_activities',
                'retention_days' => 365, // 1 year
                'date_column' => 'login_at',
                'conditions' => json_encode(['login_status' => ['success', 'failed']]),
                'is_active' => true,
                'legal_basis' => 'Legitimate interest for security monitoring',
                'description' => 'Login activities for security monitoring and fraud detection',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_type' => 'suspicious_login_activities',
                'table_name' => 'user_login_activities',
                'retention_days' => 2555, // 7 years for suspicious activities
                'date_column' => 'login_at',
                'conditions' => json_encode(['is_suspicious' => true]),
                'is_active' => true,
                'legal_basis' => 'Legal obligation for security incident records',
                'description' => 'Suspicious login activities for legal compliance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_type' => 'chat_messages',
                'table_name' => 'chat_messages',
                'retention_days' => 2555, // 7 years for business records
                'date_column' => 'created_at',
                'conditions' => null,
                'is_active' => true,
                'legal_basis' => 'Contract and legal obligation for business records',
                'description' => 'Chat messages for customer service records',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_type' => 'inactive_user_accounts',
                'table_name' => 'users',
                'retention_days' => 1095, // 3 years of inactivity
                'date_column' => 'last_login_at',
                'conditions' => json_encode(['status' => 'active']),
                'is_active' => true,
                'legal_basis' => 'Data minimization principle',
                'description' => 'Inactive user accounts cleanup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_type' => 'recovery_codes',
                'table_name' => 'user_recovery_codes',
                'retention_days' => 90, // 3 months for unused codes
                'date_column' => 'created_at',
                'conditions' => json_encode(['is_used' => false]),
                'is_active' => true,
                'legal_basis' => 'Security best practices',
                'description' => 'Unused recovery codes cleanup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'data_type' => 'email_verification_tokens',
                'table_name' => 'password_reset_tokens',
                'retention_days' => 7, // 1 week for expired tokens
                'date_column' => 'created_at',
                'conditions' => null,
                'is_active' => true,
                'legal_basis' => 'Security best practices',
                'description' => 'Expired password reset tokens',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('data_retention_policies')->insert($policies);
    }
}
