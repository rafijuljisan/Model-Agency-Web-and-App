<?php

namespace App\Filament\Resources\Advertisements\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Radio;

class AdvertisementForm
{
    public const POSITIONS = [
        'homepage_middle'  => 'Homepage Middle 1200x200px or 728x90px',
        'homepage_bottom'  => 'Homepage Bottom (728x90px)',
        'casting_top' => 'Casting Page Top (1200x200px)',
        'casting_in_feed' => 'Casting Page In-Feed (728x90px)',
        'casting_bottom' => 'Casting Page Bottom (728x90px)',
        'gallery_bottom' => 'Gallery Page Bottom (728x90px)',
        'video_in_feed' => 'Video Gallery In-Feed (1200x200px)',
        'video_bottom' => 'Video Page Bottom (728x90px)',
        // NEW: Editorial / Blog Ads
        'editorial_index_top' => 'Blog List Top (1200x200px)',
        'editorial_index_in_feed' => 'Blog List In-Feed (1200x200px)',
        'editorial_index_bottom' => 'Blog List Bottom (1200x200px)',
        
        'editorial_show_top' => 'Inside Article Top (728x90px)',
        'editorial_show_bottom' => 'Inside Article Bottom (728x90px)',
        'editorial_show_footer' => 'Article Footer (728x90px)',
        // NEW: Grooming Landing Page Ads
        'grooming_top' => 'Grooming Page Top (1200x200px)',
        'grooming_middle' => 'Grooming Page Middle (1200x200px)',
        'grooming_bottom' => 'Grooming Page Bottom (728x90px)',
        
        // NEW: Single Batch/Course Ads
        'batch_show_top' => 'Batch Page Top (728x90px)',
        'batch_show_middle' => 'Batch Page Middle (728x90px)',
        'batch_show_sidebar' => 'Batch Page Sticky Sidebar (300x250px or 300x600px)',
        'site_popup' => 'Website Initial Popup (Square 600x600px)',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ad Details')->schema([
                    TextInput::make('title')
                        ->label('Title')
                        ->required()
                        ->maxLength(255),

                    Select::make('position')
                        ->label('Position')
                        ->options(self::POSITIONS)
                        ->required()
                        ->live(),

                    Radio::make('image_source')
                        ->label('Image Source')
                        ->options([
                            'upload' => 'Direct Upload',
                            'url'    => 'External Image URL',
                        ])
                        ->default('upload')
                        ->inline()
                        ->live(),

                    // Upload field (visible when image_source === 'upload')
                    FileUpload::make('image_upload')
                        ->label('Upload Image')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('advertisements')
                        ->visible(fn ($get) => $get('image_source') === 'upload')
                        ->required(fn ($get) => $get('image_source') === 'upload')
                        ->helperText(fn ($get) => match ($get('position')) {
                            'homepage_hero'  => 'Required: 1200x400 pixels. Use a high-quality JPG or WEBP.',
                            'sidebar_top'    => 'Required: 300x250 pixels. Keep text minimal.',
                            'sidebar_bottom' => 'Required: 300x600 pixels (Half Page Ad).',
                            'footer_banner'  => 'Required: 728x90 pixels.',
                            default          => 'Select a position to see size requirements.',
                        }),

                    // URL field (visible when image_source === 'url')
                    TextInput::make('image_url')
                        ->label('Image URL')
                        ->url()
                        ->placeholder('https://example.com/banner.jpg')
                        ->visible(fn ($get) => $get('image_source') === 'url')
                        ->required(fn ($get) => $get('image_source') === 'url')
                        ->helperText(fn ($get) => match ($get('position')) {
                            'homepage_hero'  => 'Required: 1200x400 pixels. Use a high-quality JPG or WEBP.',
                            'sidebar_top'    => 'Required: 300x250 pixels. Keep text minimal.',
                            'sidebar_bottom' => 'Required: 300x600 pixels (Half Page Ad).',
                            'footer_banner'  => 'Required: 728x90 pixels.',
                            default          => 'Select a position to see size requirements.',
                        }),

                    TextInput::make('target_url')
                        ->label('Target Link URL')
                        ->url()
                        ->placeholder('https://example.com/promo')
                        ->nullable(),

                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true)
                        ->inline(false),
                ])->columns(1),
            ]);
    }
}
