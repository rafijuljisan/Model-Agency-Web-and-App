<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Setting;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show()
    {
        return view('packages', [
            'packages' => Package::where('is_active', true)->get(), // ← active only
            'settings' => \App\Models\Setting::first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'trx_id' => 'required|string|unique:subscriptions,trx_id',
            'sender_number'  => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        $package = Package::findOrFail($request->package_id);

        Subscription::create([
            'user_id' => Auth::id(),
            'trx_id' => $request->trx_id,
            'sender_number'  => $request->sender_number,
            'amount' => $package->price,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'starts_at' => now(),
            'expires_at' => now()->addMonths($package->duration_months),
        ]);

        return redirect()
            ->route('account.dashboard')
            ->with('success', 'Payment submitted! Waiting for Admin approval.');
    }
}