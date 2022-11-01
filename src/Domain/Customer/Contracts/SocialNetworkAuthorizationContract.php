<?php

namespace Domain\Customer\Contracts;

interface SocialNetworkAuthorizationContract
{
    public function __invoke(string $driver, SocialNetworkRegisterContract $registerer): void;
}