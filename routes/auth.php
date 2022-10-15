<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::prefix('register')->group(function () {
        Route::get('/', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register.index');
        Route::get('email', [\App\Http\Controllers\RegisterController::class, 'email'])->name('register.email');
        Route::get('github', [\App\Http\Controllers\RegisterController::class, 'github'])->name('register.github');
        Route::post('email/store', [\App\Http\Controllers\RegisterController::class, 'storeEmail'])->name(
            'register.store-email'
        );
    });

    Route::prefix('auth')->group(function () {
        Route::get('/', [\App\Http\Controllers\AuthController::class, 'index'])->name('auth.index');
        Route::get('email', [\App\Http\Controllers\AuthController::class, 'email'])->name('auth.email');
        Route::get('github', [\App\Http\Controllers\AuthController::class, 'github'])->name('auth.github');
        Route::post('email/store', [\App\Http\Controllers\AuthController::class, 'storeEmail'])->name(
            'auth.store-email'
        );
    });

    Route::get('forget-password', [])->name('forget.password.index');
});
