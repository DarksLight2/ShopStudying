<?php

namespace App\Providers;

use App\Events\LinkingAccountEvent;
use App\Events\RegistrationEvent;
use App\Listeners\LinkAccountListener;
use App\Listeners\SendEmailNewUserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            //SendEmailVerificationNotification::class,
        ],
        RegistrationEvent::class => [
            SendEmailNewUserListener::class,
        ],
        LinkingAccountEvent::class => [
            LinkAccountListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
