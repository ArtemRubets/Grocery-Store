<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('j M Y H:i');
    }

    public function scopeNotMainCurrencies($query)
    {
        return $query->where('status', 0);
    }
}
