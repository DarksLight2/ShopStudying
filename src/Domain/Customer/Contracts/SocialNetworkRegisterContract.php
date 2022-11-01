<?php

namespace Domain\Customer\Contracts;

use Laravel\Socialite\Contracts\User;

interface SocialNetworkRegisterContract
{
    public function __invoke(string $driver, User $socialUser): \Domain\Customer\Models\User;
}