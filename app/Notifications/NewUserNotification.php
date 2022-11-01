<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        if ($notifiable->provider === 'github') {
            return (new MailMessage())
                ->view('emails.github-registered');
        } else {
            return (new MailMessage())
                ->line('Добро пожаловать на наш сайт.')
                ->line('Мы очень рады что вы с нами.')
                ->action('Перейти на сайт', url('/'));
        }
    }
}
