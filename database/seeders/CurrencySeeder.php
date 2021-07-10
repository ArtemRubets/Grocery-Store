<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('currencies')->insert([
            [
                'code' => 'UAH',
                'symbol' => '₴',
                'rate' => 1,
                'status' => 1
            ],
            [
                'code' => 'USD',
                'symbol' => '$',
                'rate' => 27.34,
                'status' => 0
            ],
            [
                'code' => 'EUR',
                'symbol' => '€',
                'rate' => 32.63,
                'status' => 0
            ],
        ]);
    }
}
