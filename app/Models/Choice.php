<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Choice extends Model
{
    public $timestamps = false;
    protected $table ='choices';
    protected $fillable =['product_id'];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
