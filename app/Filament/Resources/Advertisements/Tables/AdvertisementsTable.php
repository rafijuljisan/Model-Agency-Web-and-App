<?php

namespace App\Filament\Resources\Advertisements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class AdvertisementsTable
{
    // Needs to be defined here for the formatStateUsing closure
    public const POSITIONS = [
        'homepage_hero' => 'Homepage Hero',
        'sidebar_top' => 'Sidebar Top',
        'sidebar_bottom' => 'Sidebar Bottom',
        'footer_banner' => 'Footer Banner',
    ];

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Preview'),
                    
                TextColumn::make('title')
                    ->searchable(),
                    
                TextColumn::make('position')
                    ->formatStateUsing(fn (string $state): string => self::POSITIONS[$state] ?? $state)
                    ->badge(),
                    
                ToggleColumn::make('is_active'),
                
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}