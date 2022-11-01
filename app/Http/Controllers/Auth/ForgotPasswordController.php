<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Password;

class ForgotPasswordController extends Controller
{
    public function page(): Factory|View|Application
    {
        return view('auth.forgot-password');
    }

    public function handle(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            flash()->info(__($status));
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}