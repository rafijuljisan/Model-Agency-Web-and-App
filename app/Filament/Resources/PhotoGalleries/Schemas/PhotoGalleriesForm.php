<?php

namespace App\Filament\Resources\PhotoGalleries\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

class PhotoGalleriesForm // 🔴 FIXED: Renamed to match the file and Resource import
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Photo Details')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Upload Photo')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('gallery/photos')
                            ->required(),

                        TextInput::make('caption')
                            ->label('Photo Caption')
                            ->maxLength(255)
                            ->nullable()
                            ->helperText('Keep it brief. This will display on hover and in the preview modal.'),

                        Toggle::make('is_active')
                            ->label('Publish to Public Gallery')
                            ->default(true),
                    ]),
            ]);
    }
}