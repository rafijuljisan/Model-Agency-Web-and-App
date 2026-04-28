<?php

namespace App\Filament\Resources\Subscriptions\Tables;

use App\Models\Subscription;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
// ✅ NEW IMPORTS REQUIRED FOR FILTERS
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Artist')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amount')
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label('Method')
                    ->searchable(),

                TextColumn::make('trx_id')
                    ->label('TrxID')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('sender_number')
                    ->label('Sender No')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'active' => 'success',
                        'failed' => 'danger',
                        'expired' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Submitted On')
                    ->date()
                    ->sortable(),

                TextColumn::make('expires_at')
                    ->label('Expires On')
                    ->date()
                    ->sortable()
                    ->color(fn ($record) => $record->expires_at?->isPast() ? 'danger' :
                        ($record->expires_at?->diffInDays(now()) <= 10 ? 'warning' : 'success')),

                TextColumn::make('days_left')
                    ->label('Days Left')
                    ->state(function ($record): string {
                        if (! $record->expires_at) {
                            return '—';
                        }
                        if ($record->expires_at->isPast()) {
                            return 'Expired';
                        }

                        return (int) now()->diffInDays($record->expires_at).' days';
                    })
                    ->badge()
                    ->color(fn ($record): string => ! $record->expires_at || $record->expires_at->isPast() ? 'danger' :
                        ((int) now()->diffInDays($record->expires_at) <= 10 ? 'warning' : 'success')
                    ),
            ])

            // =========================
            // ✅ ALL POSSIBLE FILTERS
            // =========================
            ->filters([
                // 1. Status Filter
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'failed' => 'Failed',
                        'expired' => 'Expired',
                    ]),

                // 2. Payment Method Filter (Dynamically grabs all unique methods from DB)
                SelectFilter::make('payment_method')
                    ->label('Payment Method')
                    ->options(function () {
                        return Subscription::query()
                            ->select('payment_method')
                            ->distinct()
                            ->whereNotNull('payment_method')
                            ->pluck('payment_method', 'payment_method')
                            ->toArray();
                    }),

                SelectFilter::make('package_id')
                    ->label('Package')
                    ->relationship('package', 'name'),

                // 3. Submission Date Range Filter
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label('Submitted From'),
                        DatePicker::make('created_until')->label('Submitted Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),

                // 4. Expiry Date Range Filter
                Filter::make('expires_at')
                    ->form([
                        DatePicker::make('expires_from')->label('Expires From'),
                        DatePicker::make('expires_until')->label('Expires Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['expires_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('expires_at', '>=', $date),
                            )
                            ->when(
                                $data['expires_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('expires_at', '<=', $date),
                            );
                    }),
            ])

            ->recordActions([
                Action::make('approve')
                    ->label('Approve & Verify')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalDescription('Are you sure you want to approve this payment? This will instantly verify the artist.')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'active',
                            'starts_at' => now(),
                            'expires_at' => now()->addMonths((int) $record->package?->duration_months ?? 12),
                        ]);

                        $user = $record->user;
                        $user->update(['is_verified' => true]);
                        if (! $user->hasRole('Verified-Artist')) {
                            $user->assignRole('Verified-Artist');
                        }
                    }),

                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }
}
