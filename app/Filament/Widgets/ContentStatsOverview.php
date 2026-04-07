<?php

namespace App\Filament\Widgets;

use App\Models\CastingCall; // adjust namespace if needed
use App\Models\Editorial;
use App\Models\Video;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStatsOverview extends BaseWidget
{
    protected static ?int $sort = 5;

    protected function getStats(): array
    {
        return [

        ];
    }
}