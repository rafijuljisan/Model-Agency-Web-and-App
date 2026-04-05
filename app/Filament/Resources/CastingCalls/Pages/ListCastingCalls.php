<?php

namespace App\Filament\Resources\CastingCalls\Pages;

use App\Filament\Resources\CastingCalls\CastingCallResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCastingCalls extends ListRecords
{
    protected static string $resource = CastingCallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
