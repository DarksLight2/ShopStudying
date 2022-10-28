<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        dd($notifiable);
        return (new MailMessage())
            ->line('Добро пожаловать на наш сайт.')
            ->line('Мы очень рады что вы с нами.')
            ->action('Перейти на сайт', url('/'));
    }
}
