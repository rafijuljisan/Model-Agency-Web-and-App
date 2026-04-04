<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Core User Account Details
                Section::make('Account Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(20)
                            ->unique(ignoreRecord: true),

                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),

                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create'),

                        Toggle::make('is_verified')
                            ->label('Verified Artist Badge')
                            ->columnSpanFull(),
                    ]),

                // 2. Profile Details (Linked to the 'profiles' table automatically!)
                Section::make('Public Profile Information')
                    ->relationship('profile') // Links directly to the profile table
                    ->columns(2)
                    ->schema([
                        Select::make('category')
                            ->options([
                                'Model' => 'Model',
                                'Photographer' => 'Photographer',
                                'Video Editor' => 'Video Editor',
                                'Cinematographer' => 'Cinematographer',
                                'Actor' => 'Actor',
                            ]),

                        Select::make('gender')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                                'Other' => 'Other',
                            ]),

                        DatePicker::make('date_of_birth')
                            ->label('Date of Birth'),

                        TextInput::make('height_cm')
                            ->label('Height (cm)')
                            ->numeric(),

                        TextInput::make('hourly_rate')
                            ->label('Starting Rate (BDT)')
                            ->numeric()
                            ->prefix('৳'),

                        TagsInput::make('languages')
                            ->label('Languages Spoken'),

                        TextInput::make('country')
                            ->default('Bangladesh'),

                        TextInput::make('district')
                            ->label('District'),

                        TextInput::make('upazila')
                            ->label('Thana / Upazila'),

                        Textarea::make('bio')
                            ->label('About Me (Bio)')
                            ->columnSpanFull()
                            ->rows(4),
                    ]),
                    // 3. Media & Portfolio (Attached directly to User Model!)
                Section::make('Artist Portfolio Gallery')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('portfolio')
                            ->label('Manage Portfolio Images')
                            ->collection('portfolio') 
                            ->multiple()
                            ->disk('public')
                            ->reorderable()
                            ->maxFiles(10)
                            ->image()
                            ->imageEditor(), 
                    ]),
            ]);
    }
}