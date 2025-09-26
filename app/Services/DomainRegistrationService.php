<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\DomainOrder;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class DomainRegistrationService
{
    /**
     * Register domain after successful payment
     */
    public function registerDomain(DomainOrder $order)
    {
        try {
            // In a real implementation, this would connect to domain registrar API
            // For demo purposes, we'll simulate successful registration
            
            Log::info('Domain registration initiated', [
                'order_id' => $order->id,
                'domains' => $order->domains
            ]);

            // Update order status
            $order->update([
                'status' => 'completed',
                'completed_at' => now()
            ]);

            // Create domain records in database
            foreach ($order->domains as $domainData) {
                Domain::create([
                    'user_id' => $order->user_id,
                    'domain_name' => $domainData['domain'],
                    'tld' => $domainData['tld'],
                    'status' => 'active',
                    'registration_date' => now(),
                    'expiry_date' => now()->addYear($domainData['years'] ?? 1),
                    'nameservers' => ['ns1.centrova.com', 'ns2.centrova.com'],
                    'auto_renew' => false,
                    'registrar_order_id' => 'DEMO-' . uniqid(),
                    'domain_settings' => json_encode([
                        'whois_privacy' => true,
                        'dns_management' => true
                    ])
                ]);
            }

            return [
                'success' => true,
                'message' => 'Domain berhasil didaftarkan'
            ];

        } catch (\Exception $e) {
            Log::error('Domain registration failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal mendaftarkan domain: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Process domain renewal
     */
    public function processRenewal(Domain $domain, int $years)
    {
        try {
            // In a real implementation, this would connect to domain registrar API
            Log::info('Domain renewal initiated', [
                'domain_id' => $domain->id,
                'years' => $years
            ]);

            // Update domain expiry date
            $domain->update([
                'expiry_date' => $domain->expiry_date->addYears($years)
            ]);

            return [
                'success' => true,
                'message' => "Domain {$domain->domain_name} berhasil diperpanjang {$years} tahun"
            ];

        } catch (\Exception $e) {
            Log::error('Domain renewal failed', [
                'domain_id' => $domain->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal memperpanjang domain: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Update domain nameservers
     */
    public function updateNameservers(Domain $domain, array $nameservers)
    {
        try {
            // In a real implementation, this would connect to domain registrar API
            Log::info('Nameserver update initiated', [
                'domain_id' => $domain->id,
                'nameservers' => $nameservers
            ]);

            $domain->update([
                'nameservers' => $nameservers
            ]);

            return [
                'success' => true,
                'message' => 'Nameserver berhasil diperbarui'
            ];

        } catch (\Exception $e) {
            Log::error('Nameserver update failed', [
                'domain_id' => $domain->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal memperbarui nameserver: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Sync domain info with registrar
     */
    public function syncDomainInfo(Domain $domain)
    {
        try {
            // In a real implementation, this would fetch data from domain registrar API
            Log::info('Domain sync initiated', [
                'domain_id' => $domain->id
            ]);

            // For demo, we'll just update the sync timestamp
            $domain->update([
                'last_sync_at' => now()
            ]);

            return [
                'success' => true,
                'message' => 'Domain berhasil disinkronisasi'
            ];

        } catch (\Exception $e) {
            Log::error('Domain sync failed', [
                'domain_id' => $domain->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal sinkronisasi domain: ' . $e->getMessage()
            ];
        }
    }
}