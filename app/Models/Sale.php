<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'tenant_id',
        'user_id',
        'sale_number',
        'subtotal',
        'tax',
        'total_amount',
        'payment_method',
        'status',
    ];

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function getBuyPriceAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * ($item->product->buy_price ?? 0);
        });
    }

    public function getProfitAttribute()
    {
        return $this->total_amount - $this->buy_price;
    }
}
