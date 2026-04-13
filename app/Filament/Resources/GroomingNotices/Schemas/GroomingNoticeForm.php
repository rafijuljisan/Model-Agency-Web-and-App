<?php

namespace App\Filament\Resources\GroomingNotices\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GroomingNoticeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('title')->required()->columnSpanFull(),

            Textarea::make('message')
                ->required()
                ->rows(3)
                ->columnSpanFull()
                ->placeholder('Notice in Bangla or English...'),

            Select::make('priority')
                ->options([
                    'critical' => 'Critical',
                    'normal'   => 'Normal',
                    'low'      => 'Low',
                ])
                ->default('normal')
                ->required(),

            DateTimePicker::make('expires_at')
                ->label('Expires At')
                ->nullable(),

            Toggle::make('show_on_grooming')->default(true)->label('Show on Grooming Page'),
            Toggle::make('show_on_homepage')->default(false)->label('Show on Homepage'),
            Toggle::make('is_active')->default(true),

        ])->columns(2);
    }
}