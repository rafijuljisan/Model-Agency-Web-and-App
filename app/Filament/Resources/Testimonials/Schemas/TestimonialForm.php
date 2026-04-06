<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('designation')
                    ->label('Role/Designation')
                    ->placeholder('e.g. Model, Actor, Client'),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('testimonials')
                    ->label('Avatar / Profile Picture'),
                Textarea::make('quote')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                Toggle::make('is_active')->default(true),
            ]);
    }
}
