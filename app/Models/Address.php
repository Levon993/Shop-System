<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Address extends Model
{
    protected $table ='address';

    public function orders()
    {
        return $this->belongsToMany(Order::class,'address_order','address_id', 'order_id');
    }

}
