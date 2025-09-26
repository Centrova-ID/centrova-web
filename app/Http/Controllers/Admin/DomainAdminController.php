<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domain\Domain;
use App\Models\Domain\DomainOrder;
use App\Models\Domain\DomainPricing;
use App\Models\Domain\DomainNotification;
use Carbon\Carbon;

class DomainAdminController extends Controller
{
    /**
     * Domain administration dashboard
     */
    public function index()
    {
        $stats = [
            'total_domains' => Domain::count(),
            'active_domains' => Domain::where('status', 'active')->count(),
            'expiring_soon' => Domain::expiringSoon(30)->count(),
            'expired_domains' => Domain::where('status', 'expired')->count(),
            'pending_orders' => DomainOrder::where('status', 'pending')->count(),
            'monthly_revenue' => DomainOrder::where('status', 'completed')
                ->whereMonth('created_at', now()->month)
                ->sum('total_amount')
        ];

        $recentDomains = Domain::with('user')
            ->latest()
            ->limit(10)
            ->get();

        $expiringDomains = Domain::with('user')
            ->expiringSoon(30)
            ->orderBy('expiry_date')
            ->limit(10)
            ->get();

        $recentOrders = DomainOrder::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.domains.index', compact(
            'stats',
            'recentDomains', 
            'expiringDomains',
            'recentOrders'
        ));
    }

    /**
     * Show domain pricing management
     */
    public function pricing()
    {
        $pricing = DomainPricing::ordered()->get();
        
        return view('admin.domains.pricing', compact('pricing'));
    }

    /**
     * Store or update domain pricing
     */
    public function storePricing(Request $request)
    {
        $request->validate([
            'tld' => 'required|string|max:10',
            'tld_display' => 'nullable|string|max:20',
            'registration_price' => 'required|numeric|min:0',
            'renewal_price' => 'required|numeric|min:0',
            'transfer_price' => 'required|numeric|min:0',
            'privacy_price' => 'numeric|min:0',
            'min_years' => 'integer|min:1|max:10',
            'max_years' => 'integer|min:1|max:10',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
            'registrar' => 'required|string',
            'description' => 'nullable|string'
        ]);

        DomainPricing::updateOrCreate(
            ['tld' => $request->input('tld')],
            $request->all()
        );

        return back()->with('success', 'Pricing berhasil disimpan.');
    }

    /**
     * Update domain pricing
     */
    public function updatePricing(Request $request, DomainPricing $pricing)
    {
        $request->validate([
            'registration_price' => 'required|numeric|min:0',
            'renewal_price' => 'required|numeric|min:0',
            'transfer_price' => 'required|numeric|min:0',
            'privacy_price' => 'numeric|min:0',
            'min_years' => 'integer|min:1|max:10',
            'max_years' => 'integer|min:1|max:10',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $pricing->update($request->all());

        return back()->with('success', 'Pricing berhasil diperbarui.');
    }

    /**
     * Show domain orders
     */
    public function orders(Request $request)
    {
        $query = DomainOrder::with('user');

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('payment_status') && $request->payment_status !== '') {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereJsonContains('domains', $search)
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.domains.orders', compact('orders'));
    }

    /**
     * Show single domain order
     */
    public function showOrder(DomainOrder $order)
    {
        $order->load('user');
        
        return view('admin.domains.order-detail', compact('order'));
    }

    /**
     * Show all domains
     */
    public function domains(Request $request)
    {
        $query = Domain::with(['user', 'pricing']);

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('tld') && $request->tld !== '') {
            $query->where('tld', $request->tld);
        }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('domain_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('expiring') && $request->expiring === '1') {
            $query->expiringSoon(30);
        }

        $domains = $query->orderBy('created_at', 'desc')->paginate(20);
        $tlds = DomainPricing::active()->pluck('tld', 'tld');

        return view('admin.domains.list', compact('domains', 'tlds'));
    }

    /**
     * Show domain details
     */
    public function show(Domain $domain)
    {
        $domain->load(['user', 'pricing', 'notifications']);
        
        return view('admin.domains.show', compact('domain'));
    }

    /**
     * Bulk renew domains
     */
    public function bulkRenew(Request $request)
    {
        $request->validate([
            'domain_ids' => 'required|array',
            'domain_ids.*' => 'exists:domains,id',
            'years' => 'required|integer|min:1|max:10'
        ]);

        $years = $request->input('years');
        $domainIds = $request->input('domain_ids');

        $domains = Domain::whereIn('id', $domainIds)->get();

        foreach ($domains as $domain) {
            $domain->update([
                'expiry_date' => $domain->expiry_date->addYears($years),
                'status' => 'active'
            ]);

            // Create notification
            DomainNotification::create([
                'domain_id' => $domain->id,
                'user_id' => $domain->user_id,
                'type' => 'renewal_success',
                'title' => "Domain {$domain->domain_name} diperpanjang",
                'message' => "Domain {$domain->domain_name} telah diperpanjang selama {$years} tahun oleh admin.",
                'data' => [
                    'years' => $years,
                    'renewed_by' => 'admin',
                    'new_expiry_date' => $domain->expiry_date->format('Y-m-d')
                ]
            ]);
        }

        return back()->with('success', count($domains) . " domain berhasil diperpanjang.");
    }

    /**
     * Bulk update domain status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'domain_ids' => 'required|array',
            'domain_ids.*' => 'exists:domains,id',
            'status' => 'required|in:active,pending,expired,cancelled'
        ]);

        $status = $request->input('status');
        $domainIds = $request->input('domain_ids');

        Domain::whereIn('id', $domainIds)->update(['status' => $status]);

        return back()->with('success', count($domainIds) . " domain berhasil diperbarui statusnya ke {$status}.");
    }

    /**
     * Generate reports
     */
    public function reports(Request $request)
    {
        $dateFrom = $request->input('date_from', now()->subMonth()->format('Y-m-d'));
        $dateTo = $request->input('date_to', now()->format('Y-m-d'));

        $registrations = Domain::whereBetween('registration_date', [$dateFrom, $dateTo])
            ->selectRaw('DATE(registration_date) as date, COUNT(*) as count, tld')
            ->groupBy('date', 'tld')
            ->orderBy('date')
            ->get();

        $revenue = DomainOrder::where('status', 'completed')
            ->whereBetween('created_at', [$dateFrom, $dateTo])
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $topTlds = Domain::whereBetween('registration_date', [$dateFrom, $dateTo])
            ->selectRaw('tld, COUNT(*) as count')
            ->groupBy('tld')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        return view('admin.domains.reports', compact(
            'registrations',
            'revenue', 
            'topTlds',
            'dateFrom',
            'dateTo'
        ));
    }
}
