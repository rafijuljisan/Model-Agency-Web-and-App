<?php

namespace App\Filament\Resources\Editorials\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Contracts\Set; // ✅ Correct import

class EditorialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Post Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn(string $operation, $state, callable $set) =>
                                $operation === 'create'
                                ? $set('slug', Str::slug($state))
                                : null
                            ),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Textarea::make('excerpt')
                            ->columnSpanFull()
                            ->rows(3)
                            ->helperText('A brief summary for the editorial feed.'),

                        DateTimePicker::make('published_at')
                            ->default(now())
                            ->required(),

                        Toggle::make('is_published')
                            ->default(true)
                            ->inline(false),
                    ]),

                Section::make('Media & Content')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->image()
                            ->preserveFilenames()
                            ->imageEditor()
                            ->maxSize(20480) // Allow up to 20MB per image
                            ->disk('public')
                            ->directory('editorials/covers'),

                        FileUpload::make('gallery')
                            ->label('HD Image Gallery')
                            ->multiple()
                            ->image()
                            ->preserveFilenames()
                            ->reorderable()
                            ->panelLayout('grid')
                            ->maxSize(20480) // Allow up to 20MB per image
                            ->maxFiles(20) // Limit to 20 HD images per post to prevent browser crashing
                            ->disk('public')
                            ->directory('editorials/gallery')
                            ->columnSpanFull(),

                        Textarea::make('embed_code')
                            ->label('Video Embed Code (Optional)')
                            ->helperText('Paste the <iframe> code from YouTube or Facebook here.')
                            ->rows(3),

                        RichEditor::make('content')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('editorials/inline')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}