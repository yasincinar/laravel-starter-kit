<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Request;
use Sentinel;

class LoginController extends Controller
{
    /**
     * @return mixed
     */
    public function login()
    {
        if (Sentinel::check())
            return redirect()->route('admin.dashboard');
        else
            return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @param $request
     */
    public function loginPost(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = Sentinel::authenticate($credentials, $request->remember);

        if (!$user) {
            return back()
                ->withInput(Request::except('password'))
                ->with(['login_err' => 'Bilgileriniz hatalı. Lütfen tekrar deneyiniz']);

        } else {
            return \Redirect::intended("admin/dashboard");
        }


    }

    public function logout()
    {
        Sentinel::logout();
        return redirect()->route('login');
    }
}


