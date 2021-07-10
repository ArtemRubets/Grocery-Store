<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    public function creating(Category $category){
        $category->category_slug = Str::slug($category->category_name);
    }

    public function updating(Category $category){

        $categorySlug = Str::slug($category->category_name);
        $category->category_slug = $categorySlug;

        if (request()->hasFile('category_image')) {
            $extension = request()->file('category_image')->extension();
            $imagePath = request()->file('category_image')->storeAs('categories', $categorySlug . '.' . $extension);

            $category->category_image = $imagePath;
        }

    }
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
