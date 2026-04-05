<?php

namespace App\Filament\Resources\CastingCalls\Pages;

use App\Filament\Resources\CastingCalls\CastingCallResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCastingCall extends EditRecord
{
    protected static string $resource = CastingCallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
