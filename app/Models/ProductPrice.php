<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $table = 'product_prices';
    protected $with = 'currency';

    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id')
            ->select(['id', 'symbol', 'code']);
    }
}
