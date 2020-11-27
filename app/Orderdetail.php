<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'color',
        'size', 
        'quantity',
        'single_price', 
        'total_price',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
