<?php

namespace App\Observers;

use App\Classes\SendSubscribe;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    public function creating(Product $product)
    {
        //TODO same as updating
        $productSlug = Str::slug($product->product_name);

        if (request()->hasFile('product_image')) {

            $extension = request()->file('product_image')->extension();
            $imagePath = request()->file('product_image')->storeAs('products', $productSlug . '.' . $extension);

            $product->product_image = $imagePath;
        }

        $product->rating = 1;
        $product->product_slug = $productSlug;
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    public function updating(Product $product)
    {
        SendSubscribe::send($product);

        $productSlug = Str::slug($product->product_name);

        if (request()->hasFile('product_image')) {

            $extension = request()->file('product_image')->extension();
            $imagePath = request()->file('product_image')->storeAs('products', $productSlug . '.' . $extension);

            $product->product_image = $imagePath;
        }

        $product->product_slug = $productSlug;

    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
