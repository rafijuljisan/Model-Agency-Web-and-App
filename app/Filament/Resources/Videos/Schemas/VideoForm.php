<?php

namespace App\Filament\Resources\Videos\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Video Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('url')
                            ->label('Video Link (YouTube or Facebook)')
                            ->url()
                            ->required()
                            ->helperText('Paste the raw link (e.g. https://www.youtube.com/watch?v=XYZ)'),
                            
                        FileUpload::make('thumbnail')
                            ->label('Custom Cover Image (Required for Facebook)')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('videos/thumbnails')
                            ->helperText('YouTube thumbnails auto-generate. Upload a screenshot here for Facebook videos.'),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Publish to Public Gallery')
                            ->default(true),
                    ]),
            ]);
    }
}