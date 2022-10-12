<?php

namespace App\Notifications\Logs;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class Telegram extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Create message for telegram
     *
     * @param string $message
     * @return TelegramMessage
     */
    public function toTelegram(string $message): TelegramMessage
    {
        return TelegramMessage::create()
            ->to(config('services.telegram-bot-api.chatID'))
            ->content($message);
    }
}
