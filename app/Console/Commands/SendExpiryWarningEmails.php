<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Notifications\SubscriptionExpiryNotification;
use Illuminate\Console\Command;

class SendExpiryWarningEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:warn-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptions = Subscription::with(['user', 'package'])
            ->where('status', 'active')
            ->whereBetween('expires_at', [now()->addDays(9), now()->addDays(11)])
            ->get();

        foreach ($subscriptions as $subscription) {
            $subscription->user->notify(new SubscriptionExpiryNotification($subscription, 'warning'));
        }
    }
}
