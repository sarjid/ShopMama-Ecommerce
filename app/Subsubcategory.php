<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsubcategory extends Model
{
    protected $fillable = [
        'subcategory_id','subsubcategory_name_en', 'subsubcategory_slug_en','subsubcategory_name_bn', 'subsubcategory_slug_bn','status',
    ];


    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
