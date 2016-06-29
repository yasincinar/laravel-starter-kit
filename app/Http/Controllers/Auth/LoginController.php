<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Request;

class LoginController extends Controller
{
    /**
     * @return mixed
     */
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(LoginRequest $request)
    {

    }

    public function logout()
    {
        \Sentinel::logout();
    }
}


