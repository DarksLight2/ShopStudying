<?php

namespace Domain\Customer\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRegistrar implements RouteRegistrar
{

    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::middleware('guest')->group(function () {
                Route::controller(SignInController::class)->group(function () {
                    Route::get('/sign-in', 'page')
                        ->name('auth.login');
                    Route::post('/sign-in', 'handle')
                        ->name('auth.signIn');
                });

                Route::controller(SignUpController::class)->group(function () {
                    Route::get('/sign-up', 'page')
                        ->name('auth.signUp');
                    Route::post('/sign-up/store', 'handle')
                        ->name('auth.signUp.store');
                });

                Route::controller(ResetPasswordController::class)->group(function () {
                    Route::get('/reset-password/{token}', 'page')
                        ->name('password.reset');
                    Route::post('/password-update', 'handle')
                        ->name('auth.password-update');
                });

                Route::controller(ForgotPasswordController::class)->group(function () {
                    Route::get('/forgot-password', 'page')
                        ->name('auth.forgot-password');
                    Route::post('/forgot-password/store', 'handle')
                        ->name('auth.forgot-password.store');
                });

                Route::controller(SocialAuthController::class)->group(function () {
                    Route::get('/social-auth/{driver}', 'redirect')
                        ->name('auth.socialite');
                    Route::get('/social-auth/{driver}/callback', 'callback')
                        ->name('auth.socialite.callback');
                });
            });

            Route::middleware('auth')->controller(SignInController::class)->group(function () {
                Route::delete('/logout', 'logout')
                    ->name('auth.logout');
            });
        });
    }
}