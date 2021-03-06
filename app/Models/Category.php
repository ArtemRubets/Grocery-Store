<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class , 'category_id');
    }

    public function child()
    {
        return $this->hasMany(Category::class , 'parent_category')
            ->select(['id', 'category_name', 'category_slug', 'parent_category']);
    }

    public function scopeExcerptWithoutCategory($query)
    {
        return $query->where('category_slug', '<>', 'without-category');
    }

}
