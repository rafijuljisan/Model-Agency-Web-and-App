<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $title;
    public $message;
    public $isSuccess;

    public function __construct($title, $message, $isSuccess = true)
    {
        $this->title = $title;
        $this->message = $message;
        $this->isSuccess = $isSuccess; // Allows us to change the email tone (green vs red button)
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
                    ->subject('Profile Update: ' . $this->title)
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line($this->message);

        if ($this->isSuccess) {
            $mail->action('View My Dashboard', url('/account'));
        } else {
            $mail->error(); // Makes the button red
            $mail->action('Fix Issue Now', url('/account'));
        }

        return $mail;
    }
}