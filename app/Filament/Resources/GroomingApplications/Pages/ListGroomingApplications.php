<?php

namespace App\Filament\Resources\GroomingApplications\Pages;

use App\Filament\Resources\GroomingApplications\GroomingApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroomingApplications extends ListRecords
{
    protected static string $resource = GroomingApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
