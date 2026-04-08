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
use Filament\Actions\Action; // ← Correct v5 namespace!

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

        /** @var \App\Models\User $user */
        $user = Auth::user(); // ← PHPDoc fixes the "Undefined method 'user'" IDE error

        // Create the subscription record
        Subscription::create([
            'user_id'        => $user->id,
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
        $formattedPrice = number_format($package->price);
        $userName = $user->name; 

        // 1. Send Email Notification
        Notification::send($admins, new AdminAlertNotification(
            'New Payment Submitted',
            "{$userName} ({$request->sender_number}) has submitted a payment of {$formattedPrice} BDT (TrxID: {$request->trx_id}).",
            'Review Payment',
            url('/admin/subscriptions')
        ));

        // 2. Send Real-Time Filament Panel Notification (Bell Icon)
        FilamentNotification::make()
            ->title('New Payment Submitted 💰')
            ->body("{$userName} submitted {$formattedPrice} BDT from {$request->sender_number}. TrxID: {$request->trx_id}")
            ->success()
            ->actions([
                Action::make('view') // ← V5 Syntax
                    ->label('Review Payment')
                    ->button()
                    ->url('/admin/subscriptions')
            ])
            ->sendToDatabase($admins);

        return redirect()->route('account.dashboard')->with('message', 'Payment submitted! Waiting for Admin approval.');
    }
}