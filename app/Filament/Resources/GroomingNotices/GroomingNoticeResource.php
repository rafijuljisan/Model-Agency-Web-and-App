<?php

namespace App\Filament\Resources\GroomingNotices;

use App\Filament\Resources\GroomingNotices\Pages\CreateGroomingNotice;
use App\Filament\Resources\GroomingNotices\Pages\EditGroomingNotice;
use App\Filament\Resources\GroomingNotices\Pages\ListGroomingNotices;
use App\Filament\Resources\GroomingNotices\Schemas\GroomingNoticeForm;
use App\Filament\Resources\GroomingNotices\Tables\GroomingNoticesTable;
use App\Models\GroomingNotice;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GroomingNoticeResource extends Resource
{
    protected static ?string $model = GroomingNotice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BellAlert;

    // Tip: Change this to 'title' or the main string column in your grooming_notices table
    protected static ?string $recordTitleAttribute = 'title'; 

    public static function form(Schema $schema): Schema
    {
        return GroomingNoticeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GroomingNoticesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGroomingNotices::route('/'),
            'create' => CreateGroomingNotice::route('/create'),
            'edit' => EditGroomingNotice::route('/{record}/edit'),
        ];
    }
}