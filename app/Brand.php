<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name_en', 'brand_slug_en','brand_name_bn','brand_slug_bn','brand_image','status'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
