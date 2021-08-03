<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('social_networks')->insert([
           ['name' => 'Facebook'],
           ['name' => 'Twitter'],
           ['name' => 'Google+'],
           ['name' => 'Instagram'],
           ['name' => 'Dribbble'],
        ]);
    }
}
