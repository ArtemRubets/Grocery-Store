<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_name = $this->faker->unique()->words(2, true);
        $product_price = $this->faker->randomFloat(2 , 5 , 100);

        return [
            'category_id' => $this->faker->numberBetween(1 , 10),
            'product_name' => $product_name,
            'product_slug' => Str::slug($product_name),
            'product_image' => $this->faker->imageUrl(140 , 140 , 'product' ,true),
            'product_description' => $this->faker->paragraph(),
            'product_price' => $product_price,
            'rating' => $this->faker->numberBetween(1 , 5)
        ];
    }
}
