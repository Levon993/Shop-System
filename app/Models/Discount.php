<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Discount extends Model
{
    protected $fillable =['product_id'];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
