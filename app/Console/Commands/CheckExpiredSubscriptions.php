<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckExpiredSubscriptions extends Command
{
    // The command you will type in the terminal to run this manually
    protected $signature = 'subscriptions:check-expired';

    // A description of what this does
    protected $description = 'Check for expired subscriptions and revoke the Verified-Artist role.';

    public function handle()
    {
        $this->info('Checking for expired subscriptions...');

        // Find all active subscriptions that have passed their expiration date
        $expiredSubscriptions = Subscription::where('status', 'active')
            ->where('expires_at', '<', Carbon::now())
            ->with('user')
            ->get();

        $count = 0;

        foreach ($expiredSubscriptions as $subscription) {
            // 1. Mark the subscription as expired
            $subscription->update(['status' => 'expired']);

            // 2. Revoke the Verified Badge and Role from the Artist
            if ($subscription->user) {
                $subscription->user->update(['is_verified' => false]);
                $subscription->user->removeRole('Verified-Artist');
                $count++;
            }
        }

        $this->info("Successfully expired {$count} subscriptions and revoked badges.");
    }
}