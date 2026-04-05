<?php

namespace App\Filament\Artist\Pages;

use App\Models\Subscription;
use App\Models\Package; // Make sure to import this!
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class SubscriptionPayment extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Get Verified (Payment)';
    
    protected string $view = 'filament.artist.pages.subscription-payment';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. ADDED PACKAGE SELECTION
                Select::make('package_id')
                    ->label('Select Package')
                    ->options(Package::pluck('name', 'id')) // Pulls packages from your DB
                    ->required(),

                Select::make('payment_method')
                    ->options([
                        'bKash' => 'bKash',
                        'Nagad' => 'Nagad',
                        'Rocket' => 'Rocket',
                    ])
                    ->required(),

                // 2. ADDED SENDER NUMBER FIELD
                TextInput::make('sender_number')
                    ->label('Sender Mobile Number')
                    ->tel()
                    ->placeholder('e.g. 01XXXXXXXXX')
                    ->required(),

                TextInput::make('trx_id')
                    ->label('Transaction ID (TrxID)')
                    ->required()
                    ->unique('subscriptions', 'trx_id'),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        // 3. Optional Bonus: Make the amount dynamic based on the package selected!
        $package = Package::find($data['package_id']);
        $amount = $package ? $package->price : 1200; 

        Subscription::create([
            'user_id' => Auth::id(), 
            'trx_id' => $data['trx_id'],
            'sender_number' => $data['sender_number'], // Now this works!
            'package_id' => $data['package_id'],       // Now this works!
            'amount' => $amount,                       // Dynamic amount based on package
            'payment_method' => $data['payment_method'],
            'status' => 'pending',
        ]);

        Notification::make()
            ->title('Payment Submitted')
            ->body('We will verify your transaction shortly. Your badge will appear once approved.')
            ->success()
            ->send();

        $this->form->fill();
    }
}