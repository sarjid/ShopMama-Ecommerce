<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  
    protected $fillable = [
        'category_id',
        'subcategory_id', 
        'subsubcategory_id',
        'brand_id', 
        'product_name_en',
        'product_name_bn',
        'product_slug_en',
        'product_slug_bn', 
        'product_code',
        'product_quantity',
        'short_description_en',
        'short_description_bn',
        'long_description_en', 
        'long_description_bn',
        'product_size_en', 
        'product_size_bn',
        'product_color_en',
        'product_color_bn',
        'selling_price',
        'discount_price',
        'video_link',
        'main_slider',
        'hot_deals', 
        'featured',
        'special_offer', 
        'special_deals',
        'image_one',
        'image_two',
        'image_three',
        'status',
        'product_tags_en',
        'product_tags_bn',
    ];

    public function category(){
        return $this->belongsTo(category::class,'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function subsubcategory(){
        return $this->belongsTo(Subsubcategory::class,'subsubcategory_id');
    }
}
