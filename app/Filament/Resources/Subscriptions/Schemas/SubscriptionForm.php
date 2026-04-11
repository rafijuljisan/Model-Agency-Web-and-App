<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),

                Select::make('package_id')
                    ->relationship('package', 'name') // Assumes you have a package() relationship on Subscription
                    ->required()
                    ->preload(),

                TextInput::make('trx_id')
                    ->label('Transaction ID')
                    ->required()
                    ->maxLength(255)
                    ->unique(
                        table: 'subscriptions',
                        column: 'trx_id',
                        ignoreRecord: true, // allows editing existing records without false conflicts
                    ),
                TextInput::make('sender_number')       // ← add after trx_id
                    ->label('Sender Mobile Number')
                    ->required()
                    ->tel()
                    ->placeholder('e.g. 01XXXXXXXXX')
                    ->maxLength(20),

                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->default(1200),

                Select::make('payment_method')
                    ->options([
                        'bKash' => 'bKash',
                        'Nagad' => 'Nagad',
                        'Rocket' => 'Rocket',
                    ])
                    ->required(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'failed' => 'Failed',
                        'expired' => 'Expired',
                    ])
                    ->required()
                    ->default('pending'),

                DateTimePicker::make('starts_at')
                    ->label('Subscription Start Date'),

                DateTimePicker::make('expires_at')
                    ->label('Subscription Expiry Date'),
            ]);
    }
}