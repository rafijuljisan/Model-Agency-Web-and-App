<?php

namespace App\Filament\Resources\CastingCalls\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;

class CastingCallForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Casting Overview')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->placeholder('e.g. Nationwide TV Commercial')
                            ->columnSpanFull(),

                        TextInput::make('type')
                            ->label('Project Type')
                            ->placeholder('e.g. TVC & Print'),

                        Select::make('status')
                            ->options([
                                'Open' => 'Open',
                                'Urgent' => 'Urgent Requirement',
                                'Closed' => 'Closed',
                            ])
                            ->default('Open')
                            ->required(),
                    ]),

                Section::make('Talent Requirements')
                    ->columns(2)
                    ->schema([
                        TextInput::make('age_range')
                            ->placeholder('e.g. 18 - 25 Years'),

                        TextInput::make('gender')
                            ->label('Gender')
                            ->placeholder('Male/Female/Other')
                            ->required(),


                        TextInput::make('experience')
                            ->placeholder('e.g. Fresh faces welcome'),

                        TextInput::make('deadline')
                            ->placeholder('e.g. Next Friday (Limited Slots)'),
                    ]),

                Section::make('Details & Visibility')
                    ->schema([
                        Textarea::make('description')
                            ->required()
                            ->rows(5)
                            ->placeholder('Describe the project and what kind of talent you are looking for...'),

                        Toggle::make('is_active')
                            ->label('Publish to Public Board')
                            ->default(true),
                    ]),
            ]);
    }
}
