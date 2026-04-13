<?php

namespace App\Filament\Resources\PhotoGalleries;

use App\Filament\Resources\PhotoGalleries\Pages\CreatePhotoGalleries;
use App\Filament\Resources\PhotoGalleries\Pages\EditPhotoGalleries;
use App\Filament\Resources\PhotoGalleries\Pages\ListPhotoGalleries;
use App\Filament\Resources\PhotoGalleries\Schemas\PhotoGalleriesForm;
use App\Filament\Resources\PhotoGalleries\Tables\PhotoGalleriesTable;
use App\Models\PhotoGallery; // 🔴 FIXED: Changed to singular PhotoGallery
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PhotoGalleriesResource extends Resource
{
    protected static ?string $model = PhotoGallery::class; // 🔴 FIXED: Changed to singular

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Photo;

    protected static ?string $recordTitleAttribute = 'caption'; // Better for titles

    public static function form(Schema $schema): Schema
    {
        return PhotoGalleriesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PhotoGalleriesTable::configure($table);
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
            'index' => ListPhotoGalleries::route('/'),
            'create' => CreatePhotoGalleries::route('/create'),
            'edit' => EditPhotoGalleries::route('/{record}/edit'),
        ];
    }
}