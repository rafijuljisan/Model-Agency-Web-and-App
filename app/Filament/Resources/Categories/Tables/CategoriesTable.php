<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->searchable(),

                ToggleColumn::make('is_active'),
            ])

            ->defaultGroup('group')

            ->filters([
                //
            ])

            // ✅ v4/v5
            ->actions([
                EditAction::make(),
            ])

            // ✅ v4/v5
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}