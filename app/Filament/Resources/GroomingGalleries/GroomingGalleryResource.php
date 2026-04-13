<?php

namespace App\Filament\Resources\GroomingGalleries;

use App\Filament\Resources\GroomingGalleries\Pages\CreateGroomingGallery;
use App\Filament\Resources\GroomingGalleries\Pages\EditGroomingGallery;
use App\Filament\Resources\GroomingGalleries\Pages\ListGroomingGalleries;
use App\Filament\Resources\GroomingGalleries\Schemas\GroomingGalleryForm;
use App\Filament\Resources\GroomingGalleries\Tables\GroomingGalleriesTable;
use App\Models\GroomingGallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GroomingGalleryResource extends Resource
{
    protected static ?string $model = GroomingGallery::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Camera;

    // Tip: Change this to 'title', 'name', or whatever the main identifying column is in your grooming_galleries table
    protected static ?string $recordTitleAttribute = 'title'; 

    public static function form(Schema $schema): Schema
    {
        return GroomingGalleryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GroomingGalleriesTable::configure($table);
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
            'index' => ListGroomingGalleries::route('/'),
            'create' => CreateGroomingGallery::route('/create'),
            'edit' => EditGroomingGallery::route('/{record}/edit'),
        ];
    }
}