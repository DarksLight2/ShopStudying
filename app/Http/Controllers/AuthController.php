<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizeRequest;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        // TODO return view(path to page)
    }

    public function store(AuthorizeRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        dd(Auth::user());
    }
}
