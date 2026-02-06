<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'buy_price', 'stock', 'image', 'tenant_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getProfitAttribute()
    {
        return $this->price - $this->buy_price;
    }
}
