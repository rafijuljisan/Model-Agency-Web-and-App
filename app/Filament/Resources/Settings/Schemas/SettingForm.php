<?php

namespace App\Filament\Resources\Settings\Schemas;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Global Settings')
                    ->columnSpanFull()
                    ->tabs([
                        // TAB 1: BRANDING
                        Tabs\Tab::make('Branding')
                            ->icon('heroicon-o-paint-brush')
                            ->columns(2)
                            ->schema([
                                TextInput::make('site_name')->required(),
                                Textarea::make('site_description')->columnSpanFull(),
                                FileUpload::make('logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                                FileUpload::make('favicon')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                            ]),

                        // TAB 2: CONTACT & SOCIALS
                        Tabs\Tab::make('Contact & Socials')
                            ->icon('heroicon-o-globe-alt')
                            ->columns(2)
                            ->schema([
                                TextInput::make('contact_email')->email(),
                                TextInput::make('contact_phone')->tel(),
                                TextInput::make('facebook_url')->url(),
                                TextInput::make('instagram_url')->url(),
                            ]),

                        // TAB 3: PAYMENT METHODS
                        Tabs\Tab::make('Payment Gateways')
                            ->icon('heroicon-o-banknotes')
                            ->columns(2)
                            ->schema([
                                // bKash
                                TextInput::make('bkash_number')->label('bKash Number'),
                                Select::make('bkash_type')->label('bKash Account Type')->options([
                                    'Send Money' => 'Personal (Send Money)',
                                    'Payment' => 'Merchant (Payment)',
                                ]),
                                
                                // Nagad
                                TextInput::make('nagad_number')->label('Nagad Number'),
                                Select::make('nagad_type')->label('Nagad Account Type')->options([
                                    'Send Money' => 'Personal (Send Money)',
                                    'Payment' => 'Merchant (Payment)',
                                ]),

                                // Rocket
                                TextInput::make('rocket_number')->label('Rocket Number'),
                                Select::make('rocket_type')->label('Rocket Account Type')->options([
                                    'Send Money' => 'Personal (Send Money)',
                                    'Payment' => 'Merchant (Payment)',
                                ]),
                            ]),
                    ]),
            ]);
    }
}
