<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function setIsOfferAttribute($value)
    {
        $this->attributes['is_offer'] = $value === 'on' ? true : false;
    }

    public function price()
    {
        return $this->hasMany(ProductPrice::class);
    }

    //TODO opportunity to fix
    public function productPrices()
    {
        return $this->belongsToMany(ProductPrice::class, 'product_prices', null, 'product_id');
    }

    public function isEvaluable()
    {
        return $this->product_count > 0;
    }

    public function scopeProductTrashed($query, $id)
    {
        return $query->onlyTrashed()->where('id', $id);
    }
}
