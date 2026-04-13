<?php

namespace App\Filament\Resources\GroomingGalleries\Pages;

use App\Filament\Resources\GroomingGalleries\GroomingGalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroomingGalleries extends ListRecords
{
    protected static string $resource = GroomingGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
