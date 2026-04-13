<?php

namespace App\Filament\Resources\GroomingGalleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GroomingGalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            FileUpload::make('image')
                ->required()
                ->image()
                ->disk('public')
                ->directory('grooming/gallery')
                ->columnSpanFull(),

            TextInput::make('title')->nullable()->columnSpanFull(),

            Select::make('category')
                ->options([
                    'training'   => 'Training',
                    'graduation' => 'Graduation',
                    'event'      => 'Event',
                ])
                ->default('training')
                ->required(),

            Select::make('batch_id')
                ->label('Related Batch')
                ->relationship('batch', 'title')
                ->nullable()
                ->searchable(),

            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_featured')->default(false),

        ])->columns(2);
    }
}