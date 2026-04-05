<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminAlertNotification;

class PackageController extends Controller
{
    // Shows the package selection and payment form
    public function index()
    {
        return view('packages', [
            'packages' => Package::where('is_active', true)->get(), // Only show active packages
            'settings' => Setting::first(),
        ]);
    }

    // Handles the form submission
    public function pay(Request $request)
    {
        $request->validate([
            'package_id'     => 'required|exists:packages,id',
            'trx_id'         => 'required|string|unique:subscriptions,trx_id',
            'sender_number'  => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        $package = Package::findOrFail($request->package_id);

        // Create the subscription record
        Subscription::create([
            'user_id'        => Auth::id(),
            'package_id'     => $package->id,
            'trx_id'         => $request->trx_id,
            'sender_number'  => $request->sender_number,
            'amount'         => $package->price,
            'status'         => 'pending',
            'payment_method' => $request->payment_method,
            'starts_at'      => now(),
            'expires_at'     => now()->addMonths($package->duration_months),
        ]);

        $admins = User::role('Super-Admin')->get();
        Notification::send($admins, new AdminAlertNotification(
            'New Payment Submitted',
            "{$request->sender_number} has submitted a payment of {$package->price} BDT (TrxID: {$request->trx_id}).",
            'Review Payment',
            url('/admin/subscriptions') // Link to your Filament subscriptions page
        ));

        return redirect()->route('account.dashboard')->with('message', 'Payment submitted! Waiting for Admin approval.');
    }
}