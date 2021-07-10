<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'email'];

    public function products(){
        return $this->belongsTo(Product::class);
    }

    public static function getInStockAlert(Product $product){
        return self::where('product_id', $product->id)->where('status', false)->get();
    }

}
