<?php

namespace App\Listeners;

use App\Events\RegistrationEvent;
use App\Notifications\NewUserNotification;

class SendEmailNewUserListener
{
    public function handle(RegistrationEvent $event): void
    {
        $event->user->notify(new NewUserNotification());
    }
}
