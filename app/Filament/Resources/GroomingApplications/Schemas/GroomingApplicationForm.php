<?php

namespace App\Filament\Resources\GroomingApplications\Schemas;

use App\Models\GroomingBatch;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GroomingApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Select::make('batch_id')
                ->label('Batch')
                ->options(GroomingBatch::where('is_active', true)->pluck('title', 'id'))
                ->required()
                ->searchable(),

            TextInput::make('full_name')->required(),
            TextInput::make('phone')->required()->tel(),
            TextInput::make('whatsapp')->nullable()->tel(),
            TextInput::make('email')->nullable()->email(),

            TextInput::make('age')->numeric()->nullable(),
            Select::make('gender')
                ->options(['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'])
                ->nullable(),

            TextInput::make('height')->nullable()->placeholder('e.g. 5\'6"'),
            TextInput::make('weight')->nullable()->placeholder('e.g. 55 kg'),
            TextInput::make('address')->nullable()->columnSpanFull(),

            TagsInput::make('career_interests')
                ->label('Career Interests')
                ->placeholder('e.g. Modeling, Acting')
                ->columnSpanFull(),

            Select::make('experience_level')
                ->options([
                    'Beginner'     => 'Beginner',
                    'Intermediate' => 'Intermediate',
                    'Experienced'  => 'Experienced',
                ])
                ->nullable(),

            Select::make('payment_method')
                ->options([
                    'bKash'  => 'bKash',
                    'Nagad'  => 'Nagad',
                    'Rocket' => 'Rocket',
                    'Cash'   => 'Cash',
                ])
                ->nullable(),

            TextInput::make('sender_number')
                ->label('Sender Number')
                ->required()
                ->tel(),
                
            TextInput::make('transaction_id')
                ->label('Transaction ID')
                ->nullable()
                ->unique(ignoreRecord: true),

            FileUpload::make('payment_screenshot')
                ->label('Payment Screenshot')
                ->image()
                ->disk('public')
                ->directory('grooming/payments')
                ->nullable()
                ->columnSpanFull(),

            Select::make('status')
                ->options([
                    'pending'  => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])
                ->default('pending')
                ->required(),

            Select::make('payment_status')
                ->options([
                    'unpaid'   => 'Unpaid',
                    'paid'     => 'Paid',
                    'verified' => 'Verified',
                ])
                ->default('unpaid')
                ->required(),

            Textarea::make('admin_note')
                ->label('Admin Note')
                ->nullable()
                ->columnSpanFull(),

        ])->columns(2);
    }
}