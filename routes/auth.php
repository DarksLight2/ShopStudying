<?php

use Illuminate\Support\Facades\Route;

//Route::middleware(['guest'])->group(function () {

    Route::get('register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register.index');
    Route::post('register', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register.store');

    Route::get('auth', [\App\Http\Controllers\AuthController::class, 'index'])->name('auth.index');
    Route::post('auth', [\App\Http\Controllers\AuthController::class, 'store'])->name('auth.store');

    Route::get('forget_password', [])->name('forget.password.index');
//});
