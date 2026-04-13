<?php

namespace App\Filament\Resources\GroomingApplications\Pages;

use App\Filament\Resources\GroomingApplications\GroomingApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGroomingApplication extends EditRecord
{
    protected static string $resource = GroomingApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
