<?php

namespace App\Auth\Networks;

use App\Interfaces\IUserRepositoryInterface;

interface ILogin
{
    public function login(IUserRepositoryInterface $userRepository);

    public function loginRequest();

    public function getUserData();
}
