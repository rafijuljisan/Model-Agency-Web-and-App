<?php

namespace App\Filament\Resources\Advertisements\Pages;

use App\Filament\Resources\Advertisements\AdvertisementResource;

use Filament\Resources\Pages\CreateRecord;

class CreateAdvertisement extends CreateRecord
{
    protected static string $resource = AdvertisementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['image_path'] = $data['image_source'] === 'upload' ? $data['image_upload'] : $data['image_url'];
        unset($data['image_source'], $data['image_upload'], $data['image_url']);
        return $data;
    }
}
