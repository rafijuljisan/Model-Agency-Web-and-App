<?php

namespace App\Filament\Resources\PhotoGalleries\Pages;

use App\Filament\Resources\PhotoGalleries\PhotoGalleriesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPhotoGalleries extends EditRecord
{
    protected static string $resource = PhotoGalleriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
