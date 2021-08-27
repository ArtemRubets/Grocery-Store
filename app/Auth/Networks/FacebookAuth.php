<?php

namespace App\Auth\Networks;

use App\Interfaces\IUserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuth implements ILogin
{
    public function login(IUserRepositoryInterface $userRepository)
    {
        $user = $userRepository->firstOrCreateUser($this->getUserData());
        Auth::login($user);
    }

    public function loginRequest()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function getUserData(){
        try {
            return Socialite::driver('facebook')->user();

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
