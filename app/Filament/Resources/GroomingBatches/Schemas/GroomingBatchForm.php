<?php

namespace App\Filament\Resources\GroomingBatches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;


class GroomingBatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('title')
                ->required()
                ->placeholder('e.g. Batch 12 — Summer 2025')
                ->columnSpanFull(),

            DatePicker::make('start_date')->required(),
            DatePicker::make('end_date')->nullable(),

            TextInput::make('trainer')
                ->placeholder('e.g. Nusrat Jahan')
                ->nullable(),

            TextInput::make('fee')
                ->numeric()
                ->required()
                ->prefix('৳')
                ->default(5000),

            TextInput::make('seat_limit')
                ->numeric()
                ->required()
                ->default(20)
                ->label('Total Seats'),

            TextInput::make('filled_seats')
                ->numeric()
                ->default(0)
                ->label('Filled Seats (auto-managed)'),

            Select::make('status')
                ->options([
                    'open'         => 'Open',
                    'filling_fast' => 'Filling Fast',
                    'full'         => 'Full',
                    'closed'       => 'Closed',
                ])
                ->default('open')
                ->required(),

            Toggle::make('is_active')->default(true)->columnSpanFull(),

            Repeater::make('schedule_json')
                ->label('Class Schedule')
                ->schema([
                    TextInput::make('day')->placeholder('e.g. Friday'),
                    TextInput::make('time')->placeholder('e.g. 10:00 AM – 1:00 PM'),
                ])
                ->columns(2)
                ->columnSpanFull()
                ->nullable(),
        ])->columns(2);
    }
}