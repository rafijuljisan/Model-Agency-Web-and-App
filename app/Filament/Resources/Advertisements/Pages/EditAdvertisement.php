<?php

namespace App\Filament\Resources\Advertisements\Pages;

use App\Filament\Resources\Advertisements\AdvertisementResource;

use Filament\Resources\Pages\EditRecord;

class EditAdvertisement extends EditRecord
{
    protected static string $resource = AdvertisementResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $isUrl = str_starts_with($data['image_path'] ?? '', 'http');
        $data['image_source'] = $isUrl ? 'url' : 'upload';
        if ($isUrl) {
            $data['image_url'] = $data['image_path'];
        } else {
            $data['image_upload'] = $data['image_path'];
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['image_path'] = $data['image_source'] === 'upload' ? $data['image_upload'] : $data['image_url'];
        unset($data['image_source'], $data['image_upload'], $data['image_url']);
        return $data;
    }
}
