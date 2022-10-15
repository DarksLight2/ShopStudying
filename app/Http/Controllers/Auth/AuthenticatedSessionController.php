<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    public function email()
    {
        return view('auth.login-email');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function github()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $socialiteUser = Socialite::driver('github')->user();

        $user = \App\Models\User::where([
            'provider' => 'github',
            'provider_id' => $socialiteUser->getId()
        ])->first();

        if (!$user) {
            $avatar_name = str_replace(' ', '', $socialiteUser->getName() ?? $socialiteUser->getNickname()) . '.png';

            Storage::disk('public')->put(
                'avatars/' . $avatar_name,
                file_get_contents($socialiteUser->getAvatar())
            );

            $name = $socialiteUser->getName() !== null ? explode(
                ' ',
                $socialiteUser->getName()
            )[0] : $socialiteUser->getNickname();

            $surname = $socialiteUser->getName() !== null ? explode(
                ' ',
                $socialiteUser->getName()
            )[1] : '';

            $user = \App\Models\User::create([
                'name' => $name,
                'surname' => $surname,
                'email' => $socialiteUser->getEmail(),
                'email_verified_at' => now(),
                'avatar' => 'avatars/' . $avatar_name,
                'provider' => 'github',
                'provider_id' => $socialiteUser->getId(),
                'password' => Hash::make(Str::random(8)),
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
