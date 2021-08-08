<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WithoutCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_name = 'Without category';

        \DB::table('categories')->insert([
            'category_name' => $category_name,
            'category_slug' => Str::slug($category_name),
        ]);
    }
}
