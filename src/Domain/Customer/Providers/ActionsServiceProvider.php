<?php

namespace Domain\Customer\Providers;

use Domain\Customer\Actions\RegisterNewUserAction;
use Domain\Customer\Actions\SocialliteAuthorizationAction;
use Domain\Customer\Contracts\RegisterNewUserContract;
use Domain\Customer\Contracts\SocialNetworkAuthorizationContract;

class ActionsServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public array $bindings = [
        RegisterNewUserContract::class => RegisterNewUserAction::class,
        SocialNetworkAuthorizationContract::class => SocialliteAuthorizationAction::class
    ];
}