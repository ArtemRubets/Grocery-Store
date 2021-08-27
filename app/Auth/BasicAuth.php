<?php

namespace App\Auth;

use Illuminate\Support\Facades\Auth;

class BasicAuth
{
    public function login($data)
    {
        if (!Auth::attempt($data)) {
            return back()->withErrors(['login' => "Not correct login or password"]);
        }
    }
}
