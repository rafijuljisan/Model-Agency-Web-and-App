<?php

namespace App\Filament\Resources\Subscriptions\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    ->searchable(),

                TextColumn::make('trx_id')
                    ->label('TrxID')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('sender_number')
                    ->label('Mobile Number')
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
                    ->dateTime()
                    ->sortable(),
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
                            'expires_at' => now()->addYear(),
                        ]);

                        $user = $record->user;
                        $user->update(['is_verified' => true]);
                        $user->assignRole('Verified-Artist');
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