<?php

namespace App\Filament\Resources\Packages\Schemas;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->placeholder('e.g. Pro Artist Plan'),
                TextInput::make('price')->numeric()->required()->prefix('৳'),
                TextInput::make('duration_months')->numeric()->required()->label('Duration (Months)')->default(12),
                TagsInput::make('features')->label('Features (Press Enter after each)'),
                TextInput::make('max_portfolio_photos')
                    ->numeric()
                    ->required()
                    ->label('Max Portfolio Photos')
                    ->default(12)
                    ->minValue(1)
                    ->maxValue(50),
                Toggle::make('is_active')->default(true),
            ]);
    }
}
