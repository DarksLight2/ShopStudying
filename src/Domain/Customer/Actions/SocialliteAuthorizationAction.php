<?php

namespace Domain\Customer\Actions;

use Domain\Customer\Contracts\SocialNetworkAuthorizationContract;
use Domain\Customer\Contracts\SocialNetworkRegisterContract;
use Domain\Customer\Models\User;
use DomainException;
use Laravel\Socialite\Facades\Socialite;

class SocialliteAuthorizationAction implements SocialNetworkAuthorizationContract
{
    public function __invoke(string $driver, SocialNetworkRegisterContract $registerer): void
    {
        if ($driver !== 'github') {
            throw new DomainException('Драйвер не поддерживается.');
        }

        $socialiteUser = Socialite::driver($driver)->user();

        if (isset($socialiteUser)) {
            // Create an account or login
            $user = User::query()
                ->where([
                    'provider' => $driver,
                    'provider_id' => $socialiteUser->getId()
                ])->first();

            if (!$user) {
                $user = $registerer($driver, $socialiteUser);
            }

            auth()->login($user);
        } else {
            flash()->alert('Failure! You GitHub account can`t be linked with you`r account.');
        }
    }
}