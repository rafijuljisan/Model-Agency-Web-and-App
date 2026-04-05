<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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

    public function via(object $notifiable): array
    {
        return ['mail'];
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
}