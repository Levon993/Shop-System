<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NonRegisterOrder extends Model
{

    protected $table = 'non_register_orders';
    public function address(){

        return $this->belongsTo(Address::class,'address_id', 'id');

    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'non_register_order_products', 'order_id', 'product_id');
    }
}
