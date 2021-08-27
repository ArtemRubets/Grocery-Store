<?php

namespace App\Auth\Factories;

use App\Auth\Networks\ILogin;
use Illuminate\Support\Str;

class SocialiteFactory implements IFactory
{
    public function build($company) : ILogin
    {
        $class = 'App\\Auth\\Networks\\' . Str::ucfirst($company) . 'Auth';
        return new $class;
    }
}
