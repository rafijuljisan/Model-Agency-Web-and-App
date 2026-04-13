<?php

namespace App\Filament\Resources\GroomingNotices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class GroomingNoticesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('priority')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'critical' => 'danger',
                        'normal'   => 'warning',
                        'low'      => 'gray',
                    }),
                TextColumn::make('expires_at')->dateTime()->default('Never'),
                ToggleColumn::make('show_on_grooming'),
                ToggleColumn::make('show_on_homepage'),
                ToggleColumn::make('is_active'),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}