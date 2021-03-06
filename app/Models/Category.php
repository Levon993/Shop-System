<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    public function children()
    {
      return  $this->hasMany(Category::class, 'parent_id') ;
    }

    public function parent(){
        return  $this->belongsTo(Category::class, 'parent_id') ;
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }



}
