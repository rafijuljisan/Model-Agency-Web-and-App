<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestSubscriptionsTable extends BaseWidget
{
    // FIX 1: Added 'static' keyword to match parent class
    protected static ?int $sort = 4;
    
    protected int|string|array $columnSpan = 'full';
    
    protected static ?string $heading = 'Recent Subscriptions';

    public function table(Table $table): Table
    {
        return $table
            ->query(Subscription::latest()->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Member')->searchable(),
                Tables\Columns\TextColumn::make('package.name')->label('Package'),
                Tables\Columns\TextColumn::make('amount')->prefix('৳')->numeric(),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('trx_id')->label('Trx ID'),
                
                // FIX 2: Replaced deprecated BadgeColumn with TextColumn::badge()
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'failed', 'expired' => 'danger',
                        default => 'gray',
                    }),
                    
                Tables\Columns\TextColumn::make('expires_at')->date()->label('Expires'),
            ]);
    }
}