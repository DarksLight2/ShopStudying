<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorizeRequest;
use App\Jobs\LogJob;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        // TODO return view(path to page)
        dispatch(new LogJob("Запрос выполняется очень долго!"));
    }

    public function store(AuthorizeRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        dd(Auth::user());
    }
}
