<?php

namespace App\Repositories;

use App\Interfaces\IUserRepositoryInterface;
use App\Models\Role;
use App\Models\User;

class UserRepository extends CoreRepository implements IUserRepositoryInterface
{
    public function getModel(){
        return User::class;
    }

    public function firstOrCreateUser($serviceUserData)
    {
        $user = User::whereEmail($serviceUserData->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'email' => $serviceUserData->getEmail(),
                'name' => $serviceUserData->user['given_name'],
                //TODO phone is not required. Fix
                'phone' => '+380372888849'
            ]);

            $role = Role::where('role', 'guest')->first();
            $user->roles()->attach($role);
        }

        return $user;
    }
}
