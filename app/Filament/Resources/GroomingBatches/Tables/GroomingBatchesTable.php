<?php

namespace App\Filament\Resources\GroomingBatches\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class GroomingBatchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('start_date')->date()->sortable(),
                TextColumn::make('trainer')->default('—'),
                TextColumn::make('fee')->money('bdt'),
                TextColumn::make('filled_seats')
                    ->label('Seats')
                    ->formatStateUsing(fn ($state, $record) => "{$record->filled_seats} / {$record->seat_limit}"),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open'         => 'success',
                        'filling_fast' => 'warning',
                        'full'         => 'danger',
                        'closed'       => 'gray',
                    }),
                ToggleColumn::make('is_active'),
            ])
            ->defaultSort('start_date', 'desc')
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}