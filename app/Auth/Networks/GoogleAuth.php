<?php

namespace App\Auth\Networks;

use App\Interfaces\IUserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuth implements ILogin
{
    public function login(IUserRepositoryInterface $userRepository)
    {
        $user = $userRepository->firstOrCreateUser($this->getUserData());
        Auth::login($user);
    }

    public function loginRequest()
    {
        return Socialite::driver('google')->redirect();
    }

   public function getUserData(){
       try {
           return Socialite::driver('google')->user();

       } catch (\Exception $exception) {
           return $exception->getMessage();
       }
   }
}
