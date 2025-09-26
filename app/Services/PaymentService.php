<?php

namespace App\Services;

use App\Models\DomainOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    /**
     * Process domain order payment
     */
    public function processPayment(DomainOrder $order, array $paymentData)
    {
        try {
            DB::beginTransaction();

            // Validate payment data
            $this->validatePaymentData($paymentData);

            // Process payment based on method
            $result = match($paymentData['method']) {
                'bank_transfer' => $this->processBankTransfer($order, $paymentData),
                'virtual_account' => $this->processVirtualAccount($order, $paymentData),
                'credit_card' => $this->processCreditCard($order, $paymentData),
                'ewallet' => $this->processEwallet($order, $paymentData),
                default => throw new \Exception('Payment method not supported')
            };

            if ($result['success']) {
                $order->update([
                    'payment_status' => 'paid',
                    'payment_method' => $paymentData['method'],
                    'payment_reference' => $result['reference'],
                    'payment_data' => $result['data'] ?? null,
                    'paid_at' => now()
                ]);

                DB::commit();
                
                // Trigger domain registration after successful payment
                $this->triggerDomainRegistration($order);
                
                return [
                    'success' => true,
                    'message' => 'Payment processed successfully',
                    'order' => $order,
                    'payment_reference' => $result['reference']
                ];
            }

            throw new \Exception($result['message'] ?? 'Payment failed');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Domain payment failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'payment_data' => $paymentData
            ]);

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Generate payment invoice for domain order
     */
    public function generateInvoice(DomainOrder $order)
    {
        $invoiceData = [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'customer' => [
                'name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone ?? '-'
            ],
            'items' => [],
            'subtotal' => 0,
            'tax' => 0,
            'total' => $order->total_amount,
            'currency' => 'IDR',
            'due_date' => now()->addDays(7),
            'created_at' => $order->created_at
        ];

        // Add domain items
        foreach ($order->domains as $domain) {
            $pricing = $domain['pricing'] ?? [];
            $invoiceData['items'][] = [
                'name' => "Domain Registration - {$domain['domain']}",
                'description' => "Registration for {$domain['years']} year(s)",
                'quantity' => 1,
                'price' => $domain['price'],
                'total' => $domain['price']
            ];

            // Add privacy protection if included
            if ($domain['privacy'] ?? false) {
                $invoiceData['items'][] = [
                    'name' => "Privacy Protection - {$domain['domain']}",
                    'description' => "Domain privacy protection service",
                    'quantity' => 1,
                    'price' => $pricing['privacy_price'] ?? 0,
                    'total' => $pricing['privacy_price'] ?? 0
                ];
            }
        }

        $invoiceData['subtotal'] = collect($invoiceData['items'])->sum('total');

        return $invoiceData;
    }

    /**
     * Process bank transfer payment
     */
    private function processBankTransfer(DomainOrder $order, array $paymentData)
    {
        // Generate virtual account or manual transfer instructions
        $bankAccounts = [
            'bca' => [
                'bank_name' => 'Bank Central Asia',
                'account_number' => '1234567890',
                'account_name' => 'PT Centrova Teknologi'
            ],
            'mandiri' => [
                'bank_name' => 'Bank Mandiri',
                'account_number' => '0987654321',
                'account_name' => 'PT Centrova Teknologi'
            ],
            'bni' => [
                'bank_name' => 'Bank Negara Indonesia',
                'account_number' => '5678901234',
                'account_name' => 'PT Centrova Teknologi'
            ]
        ];

        $selectedBank = $paymentData['bank'] ?? 'bca';
        $bankInfo = $bankAccounts[$selectedBank] ?? $bankAccounts['bca'];

        return [
            'success' => true,
            'reference' => 'TRF-' . strtoupper(uniqid()),
            'message' => 'Please transfer to the provided bank account',
            'data' => [
                'bank_info' => $bankInfo,
                'amount' => $order->total_amount,
                'unique_code' => rand(100, 999), // Add unique amount for verification
                'instructions' => 'Transfer the exact amount including unique code to the bank account above'
            ]
        ];
    }

    /**
     * Process virtual account payment
     */
    private function processVirtualAccount(DomainOrder $order, array $paymentData)
    {
        // Integrate with payment gateway for VA
        $vaNumber = $this->generateVirtualAccount($order, $paymentData['bank']);

        return [
            'success' => true,
            'reference' => 'VA-' . $vaNumber,
            'message' => 'Virtual account created successfully',
            'data' => [
                'va_number' => $vaNumber,
                'bank' => $paymentData['bank'],
                'amount' => $order->total_amount,
                'expired_at' => now()->addHours(24)
            ]
        ];
    }

    /**
     * Process credit card payment
     */
    private function processCreditCard(DomainOrder $order, array $paymentData)
    {
        // Integrate with payment processor (e.g., Midtrans, Xendit)
        // This is a simplified implementation
        
        if (!$this->validateCreditCard($paymentData)) {
            throw new \Exception('Invalid credit card information');
        }

        // Process with payment gateway
        $result = $this->processWithPaymentGateway($order, $paymentData);

        return [
            'success' => $result['success'],
            'reference' => $result['transaction_id'] ?? 'CC-' . uniqid(),
            'message' => $result['message'] ?? 'Credit card payment processed',
            'data' => $result
        ];
    }

    /**
     * Process e-wallet payment
     */
    private function processEwallet(DomainOrder $order, array $paymentData)
    {
        $ewalletProviders = ['ovo', 'gopay', 'dana', 'linkaja'];
        
        if (!in_array($paymentData['provider'], $ewalletProviders)) {
            throw new \Exception('E-wallet provider not supported');
        }

        // Generate e-wallet payment request
        $paymentUrl = $this->generateEwalletPaymentUrl($order, $paymentData);

        return [
            'success' => true,
            'reference' => 'EW-' . strtoupper(uniqid()),
            'message' => 'E-wallet payment initiated',
            'data' => [
                'provider' => $paymentData['provider'],
                'payment_url' => $paymentUrl,
                'qr_code' => $this->generateQRCode($paymentUrl),
                'expired_at' => now()->addMinutes(15)
            ]
        ];
    }

    /**
     * Validate payment data
     */
    private function validatePaymentData(array $paymentData)
    {
        if (!isset($paymentData['method'])) {
            throw new \Exception('Payment method is required');
        }

        $allowedMethods = ['bank_transfer', 'virtual_account', 'credit_card', 'ewallet'];
        
        if (!in_array($paymentData['method'], $allowedMethods)) {
            throw new \Exception('Invalid payment method');
        }

        // Method-specific validations
        switch ($paymentData['method']) {
            case 'credit_card':
                if (!isset($paymentData['card_number'], $paymentData['exp_month'], $paymentData['exp_year'], $paymentData['cvv'])) {
                    throw new \Exception('Credit card information is incomplete');
                }
                break;
                
            case 'virtual_account':
                if (!isset($paymentData['bank'])) {
                    throw new \Exception('Bank selection is required for virtual account');
                }
                break;
                
            case 'ewallet':
                if (!isset($paymentData['provider'])) {
                    throw new \Exception('E-wallet provider is required');
                }
                break;
        }
    }

    /**
     * Validate credit card information
     */
    private function validateCreditCard(array $cardData)
    {
        // Basic credit card validation
        $cardNumber = preg_replace('/\D/', '', $cardData['card_number']);
        
        // Luhn algorithm check
        $sum = 0;
        $length = strlen($cardNumber);
        
        for ($i = $length - 2; $i >= 0; $i -= 2) {
            $doubled = intval($cardNumber[$i]) * 2;
            $sum += ($doubled > 9) ? ($doubled - 9) : $doubled;
        }
        
        for ($i = $length - 1; $i >= 0; $i -= 2) {
            $sum += intval($cardNumber[$i]);
        }
        
        return ($sum % 10) === 0;
    }

    /**
     * Generate virtual account number
     */
    private function generateVirtualAccount(DomainOrder $order, string $bank)
    {
        // Generate unique VA number based on bank and order
        $prefix = match($bank) {
            'bca' => '12345',
            'mandiri' => '88008',
            'bni' => '98765',
            'bri' => '56789',
            default => '99999'
        };

        return $prefix . str_pad($order->id, 10, '0', STR_PAD_LEFT);
    }

    /**
     * Generate e-wallet payment URL
     */
    private function generateEwalletPaymentUrl(DomainOrder $order, array $paymentData)
    {
        // This would integrate with actual e-wallet APIs
        return "https://payment.centrova.test/ewallet/{$paymentData['provider']}/{$order->order_number}";
    }

    /**
     * Generate QR code for payment
     */
    private function generateQRCode(string $paymentUrl)
    {
        // This would generate actual QR code
        return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==";
    }

    /**
     * Process with payment gateway
     */
    private function processWithPaymentGateway(DomainOrder $order, array $paymentData)
    {
        // This would integrate with actual payment gateway
        return [
            'success' => true,
            'transaction_id' => 'TXN-' . uniqid(),
            'message' => 'Payment processed successfully'
        ];
    }

    /**
     * Trigger domain registration after payment
     */
    private function triggerDomainRegistration(DomainOrder $order)
    {
        // This would trigger the domain registration process
        // For now, we'll just update the order status
        $order->update(['status' => 'processing']);
        
        // In a real implementation, this would:
        // 1. Send API request to domain registrar
        // 2. Create domain records in database
        // 3. Send confirmation emails
        // 4. Update order status to completed
    }
}
