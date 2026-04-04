<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsOverview extends BaseWidget
{
    // Determines the order the widgets appear on the dashboard
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // 1. Count how many users have the Verified role
        $verifiedCount = User::role('Verified-Artist')->count();

        // 2. Count total revenue from active subscriptions
        $totalRevenue = Subscription::where('status', 'active')->sum('amount');

        // 3. Count how many people uploaded NIDs but aren't verified yet
        $pendingCount = User::whereHas('media', function ($query) {
                $query->where('collection_name', 'verification_documents');
            })
            ->where('is_verified', false)
            ->count();

        return [
            Stat::make('Verified Professionals', $verifiedCount)
                ->description('Active on the directory')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Little sparkline chart

            Stat::make('Pending NID Verifications', $pendingCount)
                ->description('Awaiting your approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Total Revenue', '৳ ' . number_format($totalRevenue))
                ->description('From 1200 BDT subscriptions')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary')
                ->chart([1000, 2400, 1200, 3600, 4800, 6000]),
        ];
    }
}