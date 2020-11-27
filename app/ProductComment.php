<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    protected $fillable = [
        'product_id', 'name','email','review'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
