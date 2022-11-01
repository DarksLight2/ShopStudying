<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Customer\Actions\SocialliteRegisterAction;
use Domain\Customer\Contracts\SocialNetworkAuthorizationContract;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{
    public function redirect(string $driver_name): RedirectResponse
    {
        try {
            return Socialite::driver($driver_name)
                ->redirect();
        } catch (Throwable $e) {
            throw new DomainException('Произошла ошибка.');
        }
    }

    public function callback(string $driver, SocialNetworkAuthorizationContract $action): RedirectResponse
    {
        $action($driver, app(SocialliteRegisterAction::class));
        return redirect()->route('home');
    }
}