<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\FileUpload;

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
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->collection('avatar')
                            ->disk('public')
                            ->image()
                            ->imageEditor()
                            ->imageAspectRatio('1:1')                    // ← replaces imageCropAspectRatio
                            ->automaticallyCropImagesToAspectRatio()      // ← new required companion
                            ->automaticallyResizeImagesToWidth(400)       // ← replaces imageResizeTargetWidth
                            ->automaticallyResizeImagesToHeight(400)      // ← replaces imageResizeTargetHeight
                            ->columnSpanFull()
                            ->helperText('Square image recommended. Max 3MB.'),

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

                // 2. Public Profile Information
                Section::make('Public Profile Information')
                    ->schema([
                        Group::make()
                            ->relationship('profile')
                            ->columns(2)
                            ->schema([
                                Select::make('categories')
    ->label('Talent Categories & Skills')
    ->options(function (?\Illuminate\Database\Eloquent\Model $record) {
        // 1. Get ALL categories (active and inactive)
        $options = \App\Models\Category::orderBy('group')
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();

        // 2. Determine the saved categories. 
        // Inside relationship('profile'), $record IS the Profile model.
        $savedCategories = [];
        
        if ($record) {
            // Check if we are interacting with the Profile model directly
            if (isset($record->categories) && is_array($record->categories)) {
                $savedCategories = $record->categories;
            } 
            // Fallback just in case Filament passes the User model
            elseif (isset($record->profile->categories) && is_array($record->profile->categories)) {
                $savedCategories = $record->profile->categories;
            }
        }

        // 3. Inject any missing legacy categories into the options list
        foreach ($savedCategories as $category) {
            if (!array_key_exists($category, $options)) {
                $options[$category] = $category . ' (Archived/Deleted)';
            }
        }

        return $options;
    })
    ->multiple()
    ->searchable()
    ->preload()
    ->columnSpanFull()
    ->helperText('Select all areas where this talent has professional experience.'),

                                Select::make('gender')
                                    ->options([
                                        'Male'   => 'Male',
                                        'Female' => 'Female',
                                        'Other'  => 'Other',
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
                    ]),

                // 3. Portfolio Gallery — 2 column grid
                Section::make('Artist Portfolio Gallery')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('portfolio')
                            ->label('Portfolio Images')
                            ->collection('portfolio')
                            ->multiple()
                            ->disk('public')
                            ->reorderable()
                            ->maxFiles(10)
                            ->image()
                            ->imageEditor()
                            ->panelLayout('grid')        // ← Makes it a grid
                            ->columnSpanFull(),
                    ]),

                // 4. Verification Documents
                Section::make('Verification Documents')
                    ->description('Private documents used for user verification.')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('nid_path')
                            ->label('National ID (NID)')
                            ->disk('public')
                            ->directory('nids')
                            ->visibility('private')
                            ->downloadable()
                            ->image()
                            ->imageEditor()
                            ->deletable(false),

                        FileUpload::make('academic_certificate_path')
                            ->label('Academic Certificate')
                            ->disk('public')
                            ->directory('academic_certificates')
                            ->visibility('private')
                            ->downloadable()
                            ->image()
                            ->imageEditor()
                            ->deletable(false),

                        Select::make('verification_status')
                            ->label('NID Verification Status')
                            ->options([
                                'unverified' => 'Unverified',
                                'pending'    => 'Pending Review',
                                'verified'   => 'Verified',
                                'rejected'   => 'Rejected',
                            ])
                            ->default('unverified')
                            ->native(false),

                        Select::make('academic_verification_status')
                            ->label('Academic Verification Status')
                            ->options([
                                'unverified' => 'Unverified',
                                'pending'    => 'Pending Review',
                                'verified'   => 'Verified',
                                'rejected'   => 'Rejected',
                            ])
                            ->default('unverified')
                            ->native(false),
                    ]),

            ]);
    }
}