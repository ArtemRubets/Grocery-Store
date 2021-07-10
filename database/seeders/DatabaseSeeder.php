<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       Category::factory()->count(10)->create();
       Product::factory()->count(100)->create();

       $this->call([
          CurrencySeeder::class
       ]);
    }
}
