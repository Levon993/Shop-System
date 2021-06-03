<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Product;
class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }



    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }
}
