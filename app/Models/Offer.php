<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Offer extends Model
{
    protected $table = "offers";
    protected $fillable=['*'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_offer','offer_id','product_id');
    }
}
