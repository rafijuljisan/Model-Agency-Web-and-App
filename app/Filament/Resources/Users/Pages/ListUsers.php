<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Users'),
            
            'pending_verification' => Tab::make('Needs Verification ⚠️')
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_verified', false)
                    // Only show people who have actually uploaded an NID to review
                    ->whereHas('media', fn ($q) => $q->where('collection_name', 'verification_documents'))
                )
                ->badgeColor('warning'),
                
            'verified_artists' => Tab::make('Verified Artists')
                ->modifyQueryUsing(fn (Builder $query) => $query->role('Verified-Artist'))
                ->badgeColor('success'),
                
            'super_admins' => Tab::make('Admins')
                ->modifyQueryUsing(fn (Builder $query) => $query->role('Super-Admin')),
        ];
    }
}