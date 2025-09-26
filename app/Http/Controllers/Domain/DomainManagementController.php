<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Domain\Domain;
use App\Models\Domain\DomainNotification;

class DomainManagementController extends Controller
{
    /**
     * Show customer domain dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        $domains = Domain::forUser($user->id)
            ->with(['pricing', 'notifications' => function($query) {
                $query->unread()->latest();
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total_domains' => $domains->count(),
            'active_domains' => $domains->where('status', 'active')->count(),
            'expiring_soon' => $domains->filter->isExpiringSoon()->count(),
            'expired_domains' => $domains->where('status', 'expired')->count()
        ];

        $recentNotifications = DomainNotification::forUser($user->id)
            ->with('domain')
            ->unread()
            ->latest()
            ->limit(5)
            ->get();

        return view('domain.manage.index', compact('domains', 'stats', 'recentNotifications'));
    }

    /**
     * Show domain details
     */
    public function show(Domain $domain)
    {
        if ($domain->user_id !== Auth::id()) {
            abort(404);
        }

        $domain->load(['pricing', 'notifications' => function($query) {
            $query->latest();
        }]);

        return view('domain.manage.show', compact('domain'));
    }

    /**
     * Renew domain
     */
    public function renew(Request $request, Domain $domain)
    {
        if ($domain->user_id !== Auth::id()) {
            abort(404);
        }

        $request->validate([
            'years' => 'required|integer|min:1|max:10'
        ]);

        $years = $request->input('years');
        $pricing = $domain->pricing;

        if (!$pricing) {
            return back()->with('error', 'Pricing tidak ditemukan untuk domain ini.');
        }

        $renewalPrice = $pricing->renewal_price * $years;

        // In a real implementation, you would process payment here
        // For now, we'll just simulate the renewal

        $domain->update([
            'expiry_date' => $domain->expiry_date->addYears($years),
            'status' => 'active'
        ]);

        // Create notification
        DomainNotification::create([
            'domain_id' => $domain->id,
            'user_id' => $domain->user_id,
            'type' => 'renewal_success',
            'title' => "Domain {$domain->domain_name} berhasil diperpanjang",
            'message' => "Domain {$domain->domain_name} telah diperpanjang selama {$years} tahun.",
            'data' => [
                'years' => $years,
                'new_expiry_date' => $domain->expiry_date->format('Y-m-d'),
                'amount_paid' => $renewalPrice
            ]
        ]);

        return back()->with('success', "Domain berhasil diperpanjang selama {$years} tahun.");
    }

    /**
     * Toggle auto-renewal
     */
    public function toggleAutoRenew(Domain $domain)
    {
        if ($domain->user_id !== Auth::id()) {
            abort(404);
        }

        $domain->update([
            'auto_renew' => !$domain->auto_renew
        ]);

        $status = $domain->auto_renew ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json([
            'success' => true,
            'message' => "Auto-renewal berhasil {$status}.",
            'auto_renew' => $domain->auto_renew
        ]);
    }

    /**
     * Update nameservers
     */
    public function updateNameservers(Request $request, Domain $domain)
    {
        if ($domain->user_id !== Auth::id()) {
            abort(404);
        }

        $request->validate([
            'nameservers' => 'required|array|min:2|max:4',
            'nameservers.*' => 'required|string|regex:/^[a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?(\.[a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?)*$/'
        ]);

        $nameservers = array_filter($request->input('nameservers'));

        if (count($nameservers) < 2) {
            return back()->with('error', 'Minimal 2 nameserver diperlukan.');
        }

        $domain->update([
            'nameservers' => array_values($nameservers)
        ]);

        // Create notification
        DomainNotification::create([
            'domain_id' => $domain->id,
            'user_id' => $domain->user_id,
            'type' => 'dns_updated',
            'title' => "Nameserver {$domain->domain_name} diperbarui",
            'message' => "Nameserver untuk domain {$domain->domain_name} telah diperbarui.",
            'data' => [
                'old_nameservers' => $domain->getOriginal('nameservers'),
                'new_nameservers' => $nameservers
            ]
        ]);

        return back()->with('success', 'Nameserver berhasil diperbarui.');
    }

    /**
     * Update DNS records
     */
    public function updateDns(Request $request, Domain $domain)
    {
        if ($domain->user_id !== Auth::id()) {
            abort(404);
        }

        $request->validate([
            'dns_records' => 'array',
            'dns_records.*.type' => 'required|in:A,AAAA,CNAME,MX,TXT',
            'dns_records.*.name' => 'required|string|max:255',
            'dns_records.*.value' => 'required|string|max:255',
            'dns_records.*.ttl' => 'integer|min:300|max:86400'
        ]);

        $dnsRecords = $request->input('dns_records', []);

        $domain->update([
            'dns_records' => $dnsRecords
        ]);

        return back()->with('success', 'DNS records berhasil diperbarui.');
    }

    /**
     * Toggle privacy protection
     */
    public function togglePrivacy(Domain $domain)
    {
        if ($domain->user_id !== Auth::id()) {
            abort(404);
        }

        $pricing = $domain->pricing;
        
        if (!$pricing || !$pricing->hasPrivacyProtection()) {
            return response()->json([
                'success' => false,
                'message' => 'Privacy protection tidak tersedia untuk domain ini.'
            ], 400);
        }

        // In a real implementation, you would process payment for enabling privacy protection
        
        $domain->update([
            'privacy_protection' => !$domain->privacy_protection
        ]);

        $status = $domain->privacy_protection ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json([
            'success' => true,
            'message' => "Privacy protection berhasil {$status}.",
            'privacy_protection' => $domain->privacy_protection
        ]);
    }
}
