<?php

namespace App\Filament\Resources\GroomingGalleries\Pages;

use App\Filament\Resources\GroomingGalleries\GroomingGalleryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGroomingGallery extends EditRecord
{
    protected static string $resource = GroomingGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
