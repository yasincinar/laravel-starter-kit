<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function loginPost(Request $request)
    {
        
    }
}


