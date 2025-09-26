<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrivacyTemplate;
use App\Models\Staff;

class PrivacyTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first staff member for created_by field
        $staff = Staff::first();
        
        $templates = [
            [
                'name' => 'Data Access Request - Automatic Response',
                'type' => 'data_access_request',
                'subject' => 'Your Data Access Request - Reference #{request_id}',
                'content' => 'Dear {customer_name},

Thank you for submitting your data access request on {request_date}. We have received your request and are processing it according to applicable data protection regulations.

Your request reference number is #{request_id}.

We will provide you with a copy of your personal data within {response_timeframe} business days. If we need any additional information to process your request, we will contact you at {customer_email}.

If you have any questions about your request, please contact our Privacy Officer at privacy@centrova.com.

Best regards,
Centrova Privacy Team',
                'variables' => json_encode([
                    'customer_name' => 'Customer full name',
                    'request_id' => 'Unique request identifier',
                    'request_date' => 'Date request was submitted',
                    'response_timeframe' => 'Number of business days for response',
                    'customer_email' => 'Customer email address'
                ]),
                'is_active' => true,
                'created_by' => $staff?->id,
                'updated_by' => $staff?->id,
            ],
            [
                'name' => 'Data Deletion Request - Confirmation',
                'type' => 'data_deletion_request',
                'subject' => 'Data Deletion Request Confirmation - #{request_id}',
                'content' => 'Dear {customer_name},

We have successfully processed your data deletion request submitted on {request_date}.

The following data has been permanently deleted from our systems:
- Personal account information
- Transaction history
- Communication preferences
- System logs containing your personal data

Please note that some data may be retained for legal compliance purposes as outlined in our Privacy Policy.

If you have any questions about this deletion or need further assistance, please contact us at privacy@centrova.com.

Best regards,
Centrova Privacy Team

Reference: #{request_id}',
                'variables' => json_encode([
                    'customer_name' => 'Customer full name',
                    'request_id' => 'Unique request identifier',
                    'request_date' => 'Date request was submitted'
                ]),
                'is_active' => true,
                'created_by' => $staff?->id,
                'updated_by' => $staff?->id,
            ],
            [
                'name' => 'Data Portability Response',
                'type' => 'data_portability_request',
                'subject' => 'Your Data Export is Ready - #{request_id}',
                'content' => 'Dear {customer_name},

Your data portability request has been processed. Your personal data export is now ready for download.

Download Details:
- File format: JSON/CSV
- File size: {file_size}
- Download expires: {expiry_date}
- Secure download link: {download_link}

For security reasons, this download link will expire in 7 days. Please download your data as soon as possible.

The exported data includes all personal information we have stored about you in a structured, commonly used format that can be used with other services.

If you experience any issues with the download or have questions, please contact privacy@centrova.com.

Best regards,
Centrova Privacy Team',
                'variables' => json_encode([
                    'customer_name' => 'Customer full name',
                    'request_id' => 'Unique request identifier',
                    'file_size' => 'Size of the export file',
                    'expiry_date' => 'When download link expires',
                    'download_link' => 'Secure link to download data'
                ]),
                'is_active' => true,
                'created_by' => $staff?->id,
                'updated_by' => $staff?->id,
            ],
            [
                'name' => 'Consent Withdrawal Confirmation',
                'type' => 'consent_withdrawal',
                'subject' => 'Consent Withdrawal Processed - #{request_id}',
                'content' => 'Dear {customer_name},

We have processed your request to withdraw consent for data processing submitted on {request_date}.

Your consent has been withdrawn for:
{consent_types}

As a result:
- Marketing communications have been stopped
- Data processing for non-essential services has ceased
- Your preferences have been updated in our systems

Please note that we may still process some of your data where we have a legal basis other than consent, such as for contractual obligations or legitimate business interests as outlined in our Privacy Policy.

If you wish to provide consent again in the future, you can do so through your account settings or by contacting us.

Reference: #{request_id}

Best regards,
Centrova Privacy Team',
                'variables' => json_encode([
                    'customer_name' => 'Customer full name',
                    'request_id' => 'Unique request identifier',
                    'request_date' => 'Date request was submitted',
                    'consent_types' => 'Types of consent being withdrawn'
                ]),
                'is_active' => true,
                'created_by' => $staff?->id,
                'updated_by' => $staff?->id,
            ],
            [
                'name' => 'Data Correction Confirmation',
                'type' => 'data_correction',
                'subject' => 'Data Correction Completed - #{request_id}',
                'content' => 'Dear {customer_name},

We have successfully updated your personal information as requested on {request_date}.

The following information has been corrected in our systems:
{corrected_fields}

Your updated information is now active across all our services. Changes may take up to 24 hours to reflect in all systems.

If you notice any remaining inaccuracies or have additional corrections needed, please contact us at privacy@centrova.com.

Reference: #{request_id}

Best regards,
Centrova Privacy Team',
                'variables' => json_encode([
                    'customer_name' => 'Customer full name',
                    'request_id' => 'Unique request identifier',
                    'request_date' => 'Date request was submitted',
                    'corrected_fields' => 'List of fields that were corrected'
                ]),
                'is_active' => true,
                'created_by' => $staff?->id,
                'updated_by' => $staff?->id,
            ],
            [
                'name' => 'Privacy Complaint Acknowledgment',
                'type' => 'complaint',
                'subject' => 'Privacy Complaint Received - #{request_id}',
                'content' => 'Dear {customer_name},

Thank you for bringing your privacy concern to our attention. We take all privacy matters seriously and are committed to resolving your complaint promptly.

Complaint Details:
- Submitted: {request_date}
- Reference: #{request_id}
- Assigned Officer: {assigned_officer}

We will investigate your complaint thoroughly and provide a detailed response within {investigation_timeframe} business days. During our investigation, we may need to contact you for additional information.

You also have the right to lodge a complaint with the relevant data protection authority if you believe your data protection rights have been violated.

We appreciate your patience as we work to resolve this matter.

Best regards,
{assigned_officer}
Centrova Privacy Team',
                'variables' => json_encode([
                    'customer_name' => 'Customer full name',
                    'request_id' => 'Unique request identifier',
                    'request_date' => 'Date complaint was submitted',
                    'assigned_officer' => 'Name of assigned privacy officer',
                    'investigation_timeframe' => 'Days to investigate and respond'
                ]),
                'is_active' => true,
                'created_by' => $staff?->id,
                'updated_by' => $staff?->id,
            ]
        ];

        foreach ($templates as $template) {
            PrivacyTemplate::create($template);
        }
    }
}
