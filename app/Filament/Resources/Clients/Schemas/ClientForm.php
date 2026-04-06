<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Brand/Company Name')
                    ->helperText('Used for alt text and internal reference.'),
                TextInput::make('website_url')->url(),
                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('clients')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_active')->default(true),
            ]);
    }
}
