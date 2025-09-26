<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceCancellationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Get all service orders for the authenticated user
        $serviceOrders = ServiceOrder::where('user_id', $user->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get active (cancellable) orders
        $activeOrders = $serviceOrders->filter(function ($order) {
            return $order->canBeCancelled();
        });

        // Get completed/cancelled orders
        $completedOrders = $serviceOrders->filter(function ($order) {
            return in_array($order->status, ['completed', 'cancelled']);
        });

        return view('services.cancellation.index', compact('activeOrders', 'completedOrders', 'serviceOrders'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $serviceOrder = ServiceOrder::where('user_id', $user->id)->findOrFail($id);

        return view('services.cancellation.show', compact('serviceOrder'));
    }

    public function cancel(Request $request, $id)
    {
        $user = Auth::user();
        $serviceOrder = ServiceOrder::where('user_id', $user->id)->findOrFail($id);

        if (!$serviceOrder->canBeCancelled()) {
            return back()->with('error', 'Layanan ini tidak dapat dibatalkan karena sudah dalam tahap lanjutan atau telah selesai.');
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:1000',
        ]);

        $serviceOrder->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => $request->cancellation_reason,
        ]);

        return redirect()->route('services.cancellation.index')
            ->with('success', 'Layanan berhasil dibatalkan. Tim kami akan menghubungi Anda dalam 1-2 hari kerja untuk proses selanjutnya.');
    }
}
