<?php

namespace Domain\Customer\Actions;

use App\Events\RegistrationEvent;
use Domain\Customer\Contracts\SocialNetworkRegisterContract;
use Domain\Customer\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SocialliteRegisterAction implements SocialNetworkRegisterContract
{
    public function __invoke(string $driver, \Laravel\Socialite\Contracts\User $socialUser): User
    {
        $avatar_name = str($socialUser->getName() ?? $socialUser->getNickname())
                ->slug()
                ->value() . '.png';

        Storage::disk('public')
            ->put(
                'avatars/' . $avatar_name,
                file_get_contents($socialUser->getAvatar())
            );

        $password = Str::random(8);

        $user = User::factory()->create([
            'name' => $socialUser->getName() ?? $socialUser->getNickname(),
            'email' => $socialUser->getEmail(),
            'email_verified_at' => now(),
            'avatar' => 'avatars/' . $avatar_name,
            'provider' => $driver,
            'provider_id' => $socialUser->getId(),
            'password' => bcrypt($password),
        ]);

        flash()->info('Ваш аккаунт был зарегистрирован!');
        event(new RegistrationEvent($user));

        return $user;
    }
}