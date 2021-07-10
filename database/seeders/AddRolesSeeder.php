<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class AddRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['role' => 'admin']);
        Role::create(['role' => 'guest']);
        Role::create(['role' => 'manager']);
    }
}
