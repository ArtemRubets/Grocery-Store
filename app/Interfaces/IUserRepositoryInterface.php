<?php

namespace App\Interfaces;

interface IUserRepositoryInterface
{
    public function firstOrCreateUser($serviceUserData);
}
