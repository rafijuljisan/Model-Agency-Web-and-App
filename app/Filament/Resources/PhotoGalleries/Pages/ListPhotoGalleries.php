<?php

namespace App\Filament\Resources\PhotoGalleries\Pages;

use App\Filament\Resources\PhotoGalleries\PhotoGalleriesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPhotoGalleries extends ListRecords
{
    protected static string $resource = PhotoGalleriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
