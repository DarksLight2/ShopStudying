<?php

namespace App\Listeners;

use App\Events\LogEvent;
use App\Notifications\Logs\Telegram;
use Illuminate\Support\Facades\Notification;

class SendLogNotification
{
    /**
     * Sending notifications to messengers
     *
     * @param  \App\Events\LogEvent  $event
     * @return void
     */
    public function handle(LogEvent $event): void
    {
        // Send to telegram
        Notification::send([$event->message], app(Telegram::class));
    }
}
