<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
 
    protected $fillable = [
        'product_id', 'color','size','quantity','ip_address','price',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
