<?php

namespace App\Filament\Artist\Pages;

use App\Models\Subscription;
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

    // Fixed type hint to accept BackedEnum
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Get Verified (Payment)';
    
    // Updated view path to match your 'artist' panel
    protected string $view = 'filament.artist.pages.subscription-payment';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    // Changed Form to Schema for v5 compatibility
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('payment_method')
                    ->options([
                        'bKash' => 'bKash',
                        'Nagad' => 'Nagad',
                        'Rocket' => 'Rocket',
                    ])
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

        Subscription::create([
            'user_id' => Auth::id(), // Fixed the 'id' method warning
            'trx_id' => $data['trx_id'],
            'amount' => 1200,
            'payment_method' => $data['payment_method'],
            'status' => 'pending',
        ]);

        Notification::make()
            ->title('Payment Submitted')
            ->body('We will verify your transaction shortly. Your badge will appear once approved.')
            ->success()
            ->send();

        // Clear the form
        $this->form->fill();
    }
}