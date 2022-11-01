<?php

namespace Domain\Customer\Actions;

use App\Events\RegistrationEvent;
use Domain\Customer\Contracts\RegisterNewUserContract;
use Domain\Customer\Models\User;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(string $name, string $email, string $password): void
    {
        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        
        auth()->login($user);

        event(new RegistrationEvent($user));
    }
}