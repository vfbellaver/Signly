<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(RegisterRequest $request)
    {
        $data = $request->all();

        return view('auth.register');
    }

    public function invitation($token)
    {
        return view('auth.invitation');
    }

    public function termsOfService()
    {
        return view('auth.terms-of-service');
    }

}
