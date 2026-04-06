<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('group')
                    ->options([
                        'Performance & Talent' => 'Performance & Talent',
                        'Production & Creative' => 'Production & Creative',
                        'Media & Content' => 'Media & Content',
                        'Entertainment & Events' => 'Entertainment & Events',
                        'Special Categories' => 'Special Categories',
                    ])
                    ->required(),

                TextInput::make('name')
                    ->required(),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}