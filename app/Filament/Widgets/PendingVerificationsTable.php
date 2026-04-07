<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class PendingVerificationsTable extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    // FIX 1: Added 'static' keyword to prevent FatalError
    protected static ?string $heading = '⏳ Pending NID Verifications';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->where('is_verified', false)
                    ->whereHas('media', fn (Builder $q) =>
                        $q->where('collection_name', 'verification_documents')
                    )
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered')
                    ->since(),
            ])
            // FIX 2: Changed 'recordActions' to 'actions' for modern Filament syntax
            ->actions([
                Action::make('review')
                    ->label('Review & Verify')
                    ->icon('heroicon-o-shield-check')
                    ->url(fn (User $record) =>
                        route('filament.admin.resources.users.edit', $record)
                    )
                    ->color('warning'),
            ]);
    }
}