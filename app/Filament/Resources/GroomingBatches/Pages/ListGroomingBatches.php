<?php

namespace App\Filament\Resources\GroomingBatches\Pages;

use App\Filament\Resources\GroomingBatches\GroomingBatchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroomingBatches extends ListRecords
{
    protected static string $resource = GroomingBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
