<?php

namespace App\Auth\Factories;

use App\Auth\BasicAuth;

class BasicAuthFactory implements IFactory
{
    public function build($company = null)
    {
        return new BasicAuth();
    }
}
