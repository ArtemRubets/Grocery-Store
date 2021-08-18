<?php

namespace App\Auth;

use Laravel\Socialite\Facades\Socialite;

class SocialiteLogin
{
    private $company;

    public function __construct($company)
    {
        $this->company = $company;
    }

    public function loginRequest()
    {
        return Socialite::driver($this->company)->redirect();
    }

    public function getUserData()
    {
        try {
            $serviceUser = Socialite::driver($this->company)->user();

            return $serviceUser ?? $serviceUser;

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
