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
                        'Artist' => 'Artist',
                        'Brand Promoter' => 'Brand Promoter',
                        'Model' => 'Model',
                        'Influencer & Content Creator' => 'Influencer & Content Creator',
                        'Director' => 'Director',
                        'Creative Crew' => 'Creative Crew',
                    ])
                    ->required(),

                TextInput::make('name')
                    ->required(),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}