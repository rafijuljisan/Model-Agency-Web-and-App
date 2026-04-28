<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\User;
use App\Notifications\SubscriptionExpiryNotification;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;

class SendExpiredEmails extends Command
{
    /**
     * Execute the console command.
     */
    protected $signature = 'subscriptions:notify-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        $subscriptions = Subscription::with(['user', 'package'])
            ->where('status', 'active')
            ->where('expires_at', '<=', now())
            ->get(); // Must be Eloquent collection, not DB::table()

        foreach ($subscriptions as $subscription) {
            $subscription->update(['status' => 'expired']);
            $subscription->user->notify(new SubscriptionExpiryNotification($subscription, 'expired'));

            // Filament DB notification for admins
            $admins = User::role('Super-Admin')->get();
            Notification::make()
                ->title('Subscription Expired')
                ->body("{$subscription->user->name}'s subscription has expired.")
                ->warning()
                ->sendToDatabase($admins);
        }
    }
}
