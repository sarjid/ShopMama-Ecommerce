<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   
    protected $fillable = [
        'category_name_en', 'category_slug_en','category_name_bn', 'category_slug_bn','category_icon','status',
    ];

    public function subcategory(){
        return $this->hasMany(Subcategory::class);
    }

    public function subsubcategory(){
        return $this->hasMany(Subsubcategory::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
