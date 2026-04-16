<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Grouping\Group; // <-- Add this import
use Illuminate\Database\Eloquent\Builder; // <-- Add this import
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
            // Replace the simple string with a Group object for custom sorting
            ->defaultGroup(
                Group::make('group')
                    ->orderQueryUsing(fn (Builder $query, string $direction) => $query->orderByRaw(
                        "FIELD(`group`, 'Artist', 'Model', 'Brand Promoter', 'Content Creator', 'Director', 'Creative Crew') $direction"
                    ))
            )
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}