<?php

namespace App\Filament\Resources\GroomingApplications;

use App\Filament\Resources\GroomingApplications\Pages\CreateGroomingApplication;
use App\Filament\Resources\GroomingApplications\Pages\EditGroomingApplication;
use App\Filament\Resources\GroomingApplications\Pages\ListGroomingApplications;
use App\Filament\Resources\GroomingApplications\Schemas\GroomingApplicationForm; // Fixed namespace path
use App\Filament\Resources\GroomingApplications\Tables\GroomingApplicationsTable; // Fixed namespace & class path
use App\Models\GroomingApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GroomingApplicationResource extends Resource
{
    protected static ?string $model = GroomingApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CursorArrowRipple;

    protected static ?string $recordTitleAttribute = 'GroomingApplication';

    public static function form(Schema $schema): Schema
    {
        return GroomingApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GroomingApplicationsTable::configure($table); // Now securely references the matching plural class
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
            'index' => ListGroomingApplications::route('/'),
            'create' => CreateGroomingApplication::route('/create'),
            'edit' => EditGroomingApplication::route('/{record}/edit'),
        ];
    }
}