<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\CastingCall; // adjust namespace if needed
use App\Models\Editorial;
use App\Models\Video;


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
            // In UserStatsOverview.php — add these inside getStats()

            Stat::make('Total Members', User::count())
                ->description('All registered accounts')
                ->descriptionIcon('heroicon-m-users')
                ->color('gray'),

            Stat::make('Active Subscriptions', Subscription::where('status', 'active')->count())
                ->description('Currently paying members')
                ->descriptionIcon('heroicon-m-credit-card')
                ->color('success'),

            Stat::make('Expiring Soon', Subscription::where('status', 'active')
                ->where('expires_at', '<=', now()->addDays(7))->count())
                ->description('Expire within 7 days')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
                            Stat::make('Open Casting Calls', CastingCall::where('status', 'Open')->where('is_active', true)->count())
                ->description('Live on the public board')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('success'),

            Stat::make('Published Editorials', Editorial::where('is_published', true)->count())
                ->description('Blog & news posts')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),

            Stat::make('Published Videos', Video::where('is_active', true)->count())
                ->description('In the video gallery')
                ->descriptionIcon('heroicon-m-video-camera')
                ->color('info'),
        ];
    }
}