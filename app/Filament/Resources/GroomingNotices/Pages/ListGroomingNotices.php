<?php

namespace App\Filament\Resources\GroomingNotices\Pages;

use App\Filament\Resources\GroomingNotices\GroomingNoticeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroomingNotices extends ListRecords
{
    protected static string $resource = GroomingNoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
