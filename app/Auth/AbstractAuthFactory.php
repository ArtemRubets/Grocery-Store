<?php

namespace App\Auth;

use App\Auth\Factories\BasicAuthFactory;
use App\Auth\Factories\SocialiteFactory;

class AbstractAuthFactory
{
    public function basicFactory()
    {
        return new BasicAuthFactory();
    }

    public function socialiteFactory()
    {
        return new SocialiteFactory();
    }
}
