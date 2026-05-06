<?php

namespace App\Filament\Resources\GroomingBatches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class GroomingBatchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('title')
                ->required()
                ->placeholder('e.g. Basic Grooming Course')
                ->columnSpanFull(),

            RichEditor::make('description')
                ->label('Course Overview / Description')
                ->columnSpanFull()
                ->nullable(),

            Repeater::make('benefits')
                ->label('What You Will Learn (Benefits)')
                ->schema([
                    TextInput::make('title')->required()->placeholder('e.g. Camera Confidence'),
                    Textarea::make('description')->required()->placeholder('Learn how to face the camera naturally...'),
                ])
                ->columns(2)
                ->columnSpanFull()
                ->nullable(),

            Repeater::make('course_modules')
                ->label('Course Modules / Syllabus')
                ->schema([
                    TextInput::make('module_name')->required()->placeholder('e.g. Class 1: Introduction to Modeling'),
                    Textarea::make('topics')->required()->placeholder('Posture, Diet, Industry Basics...'),
                ])
                ->columns(2)
                ->columnSpanFull()
                ->nullable(),

            Repeater::make('eligibility')
                ->label('Eligibility / Requirements')
                ->schema([
                    TextInput::make('requirement')
                        ->required()
                        ->placeholder('e.g. Minimum height 5\'4" for females'),
                ])
                ->columnSpanFull()
                ->nullable(),

            Repeater::make('faqs')
                ->label('FAQ')
                ->schema([
                    TextInput::make('question')->required()->placeholder('e.g. Do I need prior experience?'),
                    Textarea::make('answer')->required()->placeholder('No prior experience needed...')->rows(2),
                ])
                ->columns(2)
                ->columnSpanFull()
                ->nullable(),

            DatePicker::make('start_date')->required(),
            DatePicker::make('end_date')->nullable(),

            TextInput::make('trainer')
                ->placeholder('e.g. Nusrat Jahan')
                ->nullable(),

            FileUpload::make('trainer_image')
                ->label('Trainer Photo')
                ->image()
                ->disk('public')
                ->directory('trainers')
                ->nullable(),

            TextInput::make('trainer_designation')
                ->label('Trainer Designation')
                ->placeholder('e.g. Senior Grooming Expert, 10+ years experience')
                ->nullable(),

            Textarea::make('trainer_bio')
                ->label('Trainer Bio')
                ->placeholder('Short biography of the trainer...')
                ->rows(3)
                ->nullable()
                ->columnSpanFull(),

            TextInput::make('venue')
                ->placeholder('e.g. House 12, Road 5, Dhanmondi, Dhaka')
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

            Toggle::make('show_seats_public')
                ->label('Show seat availability to public')
                ->default(true),

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
