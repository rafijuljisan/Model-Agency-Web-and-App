<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Filament\Notifications\Notification as FilamentNotification; // <-- Import Filament's Notification
use Filament\Actions\Action; // <-- Import Filament Actions

class AdminAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $title;
    public $message;
    public $actionText;
    public $actionUrl;

    public function __construct($title, $message, $actionText, $actionUrl)
    {
        $this->title = $title;
        $this->message = $message;
        $this->actionText = $actionText;
        $this->actionUrl = $actionUrl;
    }

    // 1. Add 'database' to the delivery channels
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; 
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Admin Alert: ' . $this->title)
                    ->greeting('Hello Admin,')
                    ->line($this->message)
                    ->action($this->actionText, $this->actionUrl)
                    ->line('Please review this in your Filament dashboard.');
    }

    // 2. Add the toDatabase method formatted for Filament
    public function toDatabase(object $notifiable): array
    {
        return FilamentNotification::make()
            ->title($this->title)
            ->body($this->message)
            ->success() // You can change this to ->warning() or ->danger() 
            ->actions([
                Action::make('view')
                    ->label($this->actionText)
                    ->url($this->actionUrl)
                    ->button()
                    ->markAsRead(), // Automatically marks the notification as read when clicked
            ])
            ->getDatabaseMessage();
    }
}