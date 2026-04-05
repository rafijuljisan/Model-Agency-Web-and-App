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
use Filament\Forms\Components\RichEditor;

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
                                TextInput::make('facebook_url')->url()->label('Facebook URL'),
                                TextInput::make('instagram_url')->url()->label('Instagram URL'),
                                TextInput::make('youtube_url')->url()->label('YouTube URL'),   // <-- ADDED
                                TextInput::make('linkedin_url')->url()->label('LinkedIn URL'), // <-- ADDED
                            ]),
                        Tabs\Tab::make('About Page')
                            ->icon('heroicon-o-identification')
                            ->columns(2)
                            ->schema([
                                Textarea::make('mission_text')
                                    ->label('Our Mission')
                                    ->rows(4)
                                    ->columnSpan(1),

                                Textarea::make('vision_text')
                                    ->label('Our Vision')
                                    ->rows(4)
                                    ->columnSpan(1),

                                RichEditor::make('about_text')
                                    ->label('About Dhaka Model Agency')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'h3']),

                                FileUpload::make('about_image')
                                    ->label('About Page Featured Image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull(),

                                RichEditor::make('what_we_offer')
                                    ->label('What We Offer')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList']),

                                RichEditor::make('our_experience')
                                    ->label('Our Experience')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList']),

                                RichEditor::make('models_advice')
                                    ->label('Models Advice')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList']),
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
