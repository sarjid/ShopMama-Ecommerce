<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{

    protected $fillable = [
        'category_id','subcategory_name_en', 'subcategory_slug_en','subcategory_name_bn', 'subcategory_slug_bn','status',
    ];

    public function category(){
        return $this->belongsTo(category::class,'category_id');
    }

    public function subsubcategory(){
        return $this->hasMany(Subsubcategory::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
