<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'icon', 'tenant_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
