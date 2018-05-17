<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (\Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return \Redirect::intended('/');
        }

        return \Redirect::back()
            ->withInput()
            ->withErrors('That email/password does not exist.');
    }
}
