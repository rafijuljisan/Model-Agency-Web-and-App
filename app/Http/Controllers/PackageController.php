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
use Filament\Notifications\Notification as FilamentNotification;

class PackageController extends Controller
{
    public function index()
    {
        return view('packages', [
            'packages' => Package::where('is_active', true)->get(),
            'settings' => Setting::first(),
        ]);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'package_id'     => 'required|exists:packages,id',
            'trx_id'         => 'required|string|unique:subscriptions,trx_id',
            'sender_number'  => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        $package = Package::findOrFail($request->package_id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        Subscription::create([
            'user_id'        => $user->id,
            'package_id'     => $package->id,
            'trx_id'         => $request->trx_id,
            'sender_number'  => $request->sender_number,
            'amount'         => $package->price,
            'status'         => 'pending',
            'payment_method' => $request->payment_method,
            'starts_at'      => now(),
            'expires_at'     => now()->addMonths((int) $package->duration_months), // ← cast fix
        ]);

        $admins = User::role('Super-Admin')->get();
        $formattedPrice = number_format($package->price);
        $userName = $user->name;

        // Email notification
        Notification::send($admins, new AdminAlertNotification(
            'New Payment Submitted',
            "{$userName} ({$request->sender_number}) has submitted a payment of {$formattedPrice} BDT (TrxID: {$request->trx_id}).",
            'Review Payment',
            url('/admin/subscriptions')
        ));

        // Filament bell notification — no ->actions() here, just title + body + url
        FilamentNotification::make()
            ->title('New Payment Submitted 💰')
            ->body("{$userName} submitted {$formattedPrice} BDT from {$request->sender_number}. TrxID: {$request->trx_id}. [Review](/admin/subscriptions)")
            ->success()
            ->sendToDatabase($admins);

        return redirect()->route('account.dashboard')->with('message', 'Payment submitted! Waiting for Admin approval.');
    }
}