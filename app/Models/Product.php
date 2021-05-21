<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Choice;

class Product extends Model
{
    protected $fillable =['title','alias','offer_id'];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function offer()
    {
        return $this->belongsToMany(Offer::class,'products_offer','product_id', 'offer_id');
    }

    public function choices()
    {
        return $this->hasOne(Choice::class,'product_id');
    }

}
