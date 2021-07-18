<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $currencies = Currency::all();

        foreach ($products as $product) {
            foreach ($currencies as $currency){
                DB::table('product_prices')->insert([
                    'price' => random_int(5, 100),
                    'product_id' => $product->id,
                    'currency_id' => $currency->id
            ]);
            }

        }
    }
}
