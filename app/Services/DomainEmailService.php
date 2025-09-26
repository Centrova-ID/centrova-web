<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\DomainOrder;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DomainEmailService
{
    /**
     * Send domain registration success email
     */
    public function sendRegistrationSuccess(User $user, array $domains)
    {
        try {
            $data = [
                'user' => $user,
                'domains' => $domains,
                'dashboard_url' => route('domains.index')
            ];

            // For now, we'll log the email instead of actually sending it
            // In a real implementation, you would use Mail::send() with proper templates
            Log::info('Domain registration success email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'domains' => collect($domains)->pluck('full_domain')->toArray(),
                'template' => 'registration_success'
            ]);

            // Uncomment for actual email sending:
            // Mail::send('emails.domain.registration-success', $data, function ($message) use ($user) {
            //     $message->to($user->email, $user->name)
            //             ->subject('Domain Anda Berhasil Didaftarkan - Centrova');
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send registration success email', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send domain renewal success email
     */
    public function sendRenewalSuccess(User $user, Domain $domain)
    {
        try {
            $data = [
                'user' => $user,
                'domain' => $domain,
                'new_expiry_date' => $domain->expiry_date,
                'dashboard_url' => route('domains.show', $domain->id)
            ];

            Log::info('Domain renewal success email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'domain' => $domain->full_domain,
                'new_expiry_date' => $domain->expiry_date,
                'template' => 'renewal_success'
            ]);

            // Mail::send('emails.domain.renewal-success', $data, function ($message) use ($user, $domain) {
            //     $message->to($user->email, $user->name)
            //             ->subject("Domain {$domain->full_domain} Berhasil Diperpanjang - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send renewal success email', [
                'user_id' => $user->id,
                'domain_id' => $domain->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send domain expiry warning email
     */
    public function sendExpiryWarning(User $user, Domain $domain)
    {
        try {
            $data = [
                'user' => $user,
                'domain' => $domain,
                'days_until_expiry' => $domain->days_until_expiry,
                'renewal_url' => route('domains.renew', $domain->id),
                'dashboard_url' => route('domains.show', $domain->id)
            ];

            Log::info('Domain expiry warning email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'domain' => $domain->full_domain,
                'days_until_expiry' => $domain->days_until_expiry,
                'expiry_date' => $domain->expiry_date,
                'template' => 'expiry_warning'
            ]);

            // Mail::send('emails.domain.expiry-warning', $data, function ($message) use ($user, $domain) {
            //     $message->to($user->email, $user->name)
            //             ->subject("Peringatan: Domain {$domain->full_domain} Akan Expired - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send expiry warning email', [
                'user_id' => $user->id,
                'domain_id' => $domain->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send domain renewal reminder email
     */
    public function sendRenewalReminder(User $user, Domain $domain)
    {
        try {
            $data = [
                'user' => $user,
                'domain' => $domain,
                'days_until_expiry' => $domain->days_until_expiry,
                'renewal_url' => route('domains.renew', $domain->id),
                'auto_renew_url' => route('domains.auto-renew', $domain->id)
            ];

            Log::info('Domain renewal reminder email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'domain' => $domain->full_domain,
                'days_until_expiry' => $domain->days_until_expiry,
                'template' => 'renewal_reminder'
            ]);

            // Mail::send('emails.domain.renewal-reminder', $data, function ($message) use ($user, $domain) {
            //     $message->to($user->email, $user->name)
            //             ->subject("Pengingat: Perpanjang Domain {$domain->full_domain} - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send renewal reminder email', [
                'user_id' => $user->id,
                'domain_id' => $domain->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send order confirmation email
     */
    public function sendOrderConfirmation(User $user, DomainOrder $order)
    {
        try {
            $data = [
                'user' => $user,
                'order' => $order,
                'domains' => $order->domains,
                'payment_url' => route('domains.payment', $order->id),
                'order_url' => route('domains.orders.show', $order->id)
            ];

            Log::info('Domain order confirmation email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'order_number' => $order->order_number,
                'domains' => $order->domains,
                'total_amount' => $order->total_amount,
                'template' => 'order_confirmation'
            ]);

            // Mail::send('emails.domain.order-confirmation', $data, function ($message) use ($user, $order) {
            //     $message->to($user->email, $user->name)
            //             ->subject("Konfirmasi Pesanan Domain #{$order->order_number} - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send order confirmation email', [
                'user_id' => $user->id,
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send payment confirmation email
     */
    public function sendPaymentConfirmation(User $user, DomainOrder $order)
    {
        try {
            $data = [
                'user' => $user,
                'order' => $order,
                'domains' => $order->domains,
                'payment_method' => $order->payment_method,
                'payment_reference' => $order->payment_reference,
                'dashboard_url' => route('domains.index')
            ];

            Log::info('Domain payment confirmation email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'order_number' => $order->order_number,
                'payment_method' => $order->payment_method,
                'payment_reference' => $order->payment_reference,
                'template' => 'payment_confirmation'
            ]);

            // Mail::send('emails.domain.payment-confirmation', $data, function ($message) use ($user, $order) {
            //     $message->to($user->email, $user->name)
            //             ->subject("Pembayaran Domain Dikonfirmasi #{$order->order_number} - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send payment confirmation email', [
                'user_id' => $user->id,
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send domain transfer success email
     */
    public function sendTransferSuccess(User $user, Domain $domain)
    {
        try {
            $data = [
                'user' => $user,
                'domain' => $domain,
                'dashboard_url' => route('domains.show', $domain->id)
            ];

            Log::info('Domain transfer success email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'domain' => $domain->full_domain,
                'template' => 'transfer_success'
            ]);

            // Mail::send('emails.domain.transfer-success', $data, function ($message) use ($user, $domain) {
            //     $message->to($user->email, $user->name)
            //             ->subject("Domain {$domain->full_domain} Berhasil Ditransfer - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send transfer success email', [
                'user_id' => $user->id,
                'domain_id' => $domain->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send nameserver update confirmation email
     */
    public function sendNameserverUpdateConfirmation(User $user, Domain $domain, array $oldNameservers, array $newNameservers)
    {
        try {
            $data = [
                'user' => $user,
                'domain' => $domain,
                'old_nameservers' => $oldNameservers,
                'new_nameservers' => $newNameservers,
                'dashboard_url' => route('domains.show', $domain->id)
            ];

            Log::info('Domain nameserver update confirmation email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'domain' => $domain->full_domain,
                'old_nameservers' => $oldNameservers,
                'new_nameservers' => $newNameservers,
                'template' => 'nameserver_update'
            ]);

            // Mail::send('emails.domain.nameserver-update', $data, function ($message) use ($user, $domain) {
            //     $message->to($user->email, $user->name)
            //             ->subject("Nameserver Domain {$domain->full_domain} Diperbarui - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send nameserver update confirmation email', [
                'user_id' => $user->id,
                'domain_id' => $domain->id,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send bulk domain operation summary email
     */
    public function sendBulkOperationSummary(User $user, array $results, $operation = 'bulk_renewal')
    {
        try {
            $successful = collect($results)->where('success', true)->count();
            $failed = collect($results)->where('success', false)->count();

            $data = [
                'user' => $user,
                'operation' => $operation,
                'total' => count($results),
                'successful' => $successful,
                'failed' => $failed,
                'results' => $results,
                'dashboard_url' => route('domains.index')
            ];

            Log::info('Bulk domain operation summary email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'operation' => $operation,
                'total' => count($results),
                'successful' => $successful,
                'failed' => $failed,
                'template' => 'bulk_operation_summary'
            ]);

            // Mail::send('emails.domain.bulk-operation-summary', $data, function ($message) use ($user, $operation) {
            //     $message->to($user->email, $user->name)
            //             ->subject("Ringkasan Operasi Domain {$operation} - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send bulk operation summary email', [
                'user_id' => $user->id,
                'operation' => $operation,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Send admin notification for failed domain operation
     */
    public function sendAdminFailureNotification($operation, $details)
    {
        try {
            $adminEmail = config('domain.admin_email', 'admin@centrova.com');

            $data = [
                'operation' => $operation,
                'details' => $details,
                'timestamp' => now()->toDateTimeString()
            ];

            Log::info('Admin domain failure notification', [
                'operation' => $operation,
                'details' => $details,
                'admin_email' => $adminEmail,
                'template' => 'admin_failure_notification'
            ]);

            // Mail::send('emails.domain.admin-failure-notification', $data, function ($message) use ($adminEmail, $operation) {
            //     $message->to($adminEmail)
            //             ->subject("Domain Operation Failed: {$operation} - Centrova");
            // });

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send admin failure notification', [
                'operation' => $operation,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }
}