<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;


class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Details')->columns(2)->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('designation')->required(),
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('team-members')
                        ->columnSpanFull(),
                    Toggle::make('is_active')->default(true)->columnSpanFull(),
                ]),
                Section::make('Social Links')->columns(2)->schema([
                    TextInput::make('facebook_url')->url()->label('Facebook URL'),
                    TextInput::make('twitter_url')->url()->label('Twitter URL'),
                    TextInput::make('instagram_url')->url()->label('Instagram URL'),
                    TextInput::make('linkedin_url')->url()->label('LinkedIn URL'),
                ])->collapsed(),
            ]);
    }
}
