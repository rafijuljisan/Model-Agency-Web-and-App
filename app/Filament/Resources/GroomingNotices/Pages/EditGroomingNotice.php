<?php

namespace App\Filament\Resources\GroomingNotices\Pages;

use App\Filament\Resources\GroomingNotices\GroomingNoticeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGroomingNotice extends EditRecord
{
    protected static string $resource = GroomingNoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
