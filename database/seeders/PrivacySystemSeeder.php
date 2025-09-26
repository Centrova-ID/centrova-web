<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrivacyTemplate;
use App\Models\StaffUser;
use Illuminate\Support\Facades\Hash;

class PrivacySystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Privacy Officer staff if not exists
        $privacyOfficer = StaffUser::firstOrCreate(
            ['email' => 'privacy@centrova.com'],
            [
                'name' => 'Privacy Officer',
                'role' => 'privacy_officer',
                'password' => Hash::make('password123'),
            ]
        );

        // Create default privacy templates
        $templates = [
            [
                'name' => 'Data Access Request Response',
                'type' => 'data_access_request',
                'subject' => 'Your Data Access Request - Reference: {request_id}',
                'content' => 'Dear {customer_name},

Thank you for your data access request submitted on {request_date}. 

We are processing your request and will provide you with a comprehensive report of your personal data within 30 days as required by applicable privacy laws.

Your request reference number is: {request_id}

If you have any questions, please contact us at privacy@centrova.com.

Best regards,
Centrova Privacy Team',
                'variables' => json_encode(['customer_name', 'request_date', 'request_id']),
                'is_active' => true,
            ],
            [
                'name' => 'Data Deletion Confirmation',
                'type' => 'data_deletion_request',
                'subject' => 'Data Deletion Request Confirmed - Reference: {request_id}',
                'content' => 'Dear {customer_name},

Your data deletion request has been successfully processed on {completion_date}.

All personal data associated with your account has been permanently deleted from our systems, except for data we are legally required to retain.

Request reference: {request_id}
Deletion completed: {completion_date}

Thank you for using our services.

Best regards,
Centrova Privacy Team',
                'variables' => json_encode(['customer_name', 'request_id', 'completion_date']),
                'is_active' => true,
            ],
            [
                'name' => 'Data Portability Response',
                'type' => 'data_portability_request',
                'subject' => 'Your Data Export - Reference: {request_id}',
                'content' => 'Dear {customer_name},

Your data portability request has been processed. Please find your personal data export attached to this email.

The export includes:
- Account information
- Transaction history
- Profile data
- Communication preferences

Request reference: {request_id}
Export generated: {export_date}

Please download and save your data within 30 days as the download link will expire.

Best regards,
Centrova Privacy Team',
                'variables' => json_encode(['customer_name', 'request_id', 'export_date']),
                'is_active' => true,
            ],
            [
                'name' => 'Privacy Policy Update Notification',
                'type' => 'privacy_policy_update',
                'subject' => 'Important Update to Our Privacy Policy',
                'content' => 'Dear {customer_name},

We are writing to inform you about important updates to our Privacy Policy, effective {effective_date}.

Key changes include:
{policy_changes}

You can review the complete updated Privacy Policy at: {policy_url}

If you have any questions about these changes, please contact us at privacy@centrova.com.

Best regards,
Centrova Privacy Team',
                'variables' => json_encode(['customer_name', 'effective_date', 'policy_changes', 'policy_url']),
                'is_active' => true,
            ],
            [
                'name' => 'Consent Confirmation',
                'type' => 'consent_confirmation',
                'subject' => 'Consent Update Confirmation',
                'content' => 'Dear {customer_name},

This email confirms that we have updated your consent preferences on {update_date}.

Current consent status:
{consent_details}

You can update your preferences at any time by visiting your account settings or contacting us at privacy@centrova.com.

Best regards,
Centrova Privacy Team',
                'variables' => json_encode(['customer_name', 'update_date', 'consent_details']),
                'is_active' => true,
            ],
            [
                'name' => 'Data Breach Notification',
                'type' => 'data_breach_notification',
                'subject' => 'Important Security Notice - Data Breach Notification',
                'content' => 'Dear {customer_name},

We are writing to inform you of a security incident that may have affected your personal information.

Incident details:
- Date of incident: {incident_date}
- Data potentially affected: {affected_data}
- Actions taken: {remedial_actions}

We take this matter seriously and have implemented additional security measures to prevent future incidents.

If you have any concerns, please contact us immediately at privacy@centrova.com.

Best regards,
Centrova Privacy Team',
                'variables' => json_encode(['customer_name', 'incident_date', 'affected_data', 'remedial_actions']),
                'is_active' => true,
            ]
        ];

        foreach ($templates as $template) {
            PrivacyTemplate::firstOrCreate(
                ['type' => $template['type'], 'name' => $template['name']],
                array_merge($template, [
                    'created_by' => $privacyOfficer->id,
                    'updated_by' => $privacyOfficer->id
                ])
            );
        }

        $this->command->info('Privacy system seeded successfully!');
        $this->command->info('Privacy Officer created: privacy@centrova.com / password123');
    }
}
