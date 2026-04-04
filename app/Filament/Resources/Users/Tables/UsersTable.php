<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn; // Add this import!
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('email')
                    ->searchable(),
                
                TextColumn::make('phone')
                    ->searchable(),
                
                TextColumn::make('roles.name')
                    ->badge()
                    ->searchable(),
                
                // NEW: This displays the NID image in the admin table
                SpatieMediaLibraryImageColumn::make('verification_documents')
                    ->label('NID Document')
                    ->collection('verification_documents')
                    ->circular()
                    ->defaultImageUrl(url('/placeholder.png')), // Optional fallback if they haven't uploaded one
                
                ToggleColumn::make('is_verified')
                    ->label('Verified Badge')
                    ->beforeStateUpdated(function ($record, $state) {
                        if ($state === true) {
                            $record->assignRole('Verified-Artist');
                        } else {
                            $record->removeRole('Verified-Artist');
                        }
                    }),
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