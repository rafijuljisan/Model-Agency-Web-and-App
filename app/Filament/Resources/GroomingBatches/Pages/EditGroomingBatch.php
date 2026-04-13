<?php

namespace App\Filament\Resources\GroomingBatches\Pages;

use App\Filament\Resources\GroomingBatches\GroomingBatchResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGroomingBatch extends EditRecord
{
    protected static string $resource = GroomingBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
