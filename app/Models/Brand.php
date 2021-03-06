<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Brand extends Model
{
    public function product()
    {
        return $this->hasMany(Product::class,'brand_id');
    }
}
