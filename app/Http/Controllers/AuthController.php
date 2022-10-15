<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('auth.index');
    }

    public function email(): Factory|View|Application
    {
        return view('auth.email');
    }

    public function storeEmail(AuthorizeRequest $request): RedirectResponse
    {
        if ($request->authenticate()) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput($request->all())->withErrors(
                ['credentials' => 'Мы не смогли найти вашу учётную запись.']
            );
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
