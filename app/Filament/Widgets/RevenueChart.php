<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue (BDT)';
    
    // Put this right below the stats cards
    protected static ?int $sort = 2; 

    protected function getData(): array
    {
        // Initialize an array with 12 zeros for the months of the year
        $monthlyData = array_fill(0, 12, 0);

        // Fetch all active subscriptions from the current year
        $subscriptions = Subscription::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->where('status', 'active')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        // Populate the months that actually have revenue
        foreach ($subscriptions as $sub) {
            // Arrays are 0-indexed, so January (1) is index 0
            $monthlyData[$sub->month - 1] = $sub->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Subscription Revenue',
                    'data' => $monthlyData,
                    'borderColor' => '#4f46e5', // Indigo color matching your brand
                    'backgroundColor' => '#c7d2fe', // Light indigo fill
                    'fill' => true,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // You can change this to 'bar' if you prefer bar charts!
    }
}