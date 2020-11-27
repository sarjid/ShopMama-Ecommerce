<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = [
        'user_id', 'post_title_en','post_title_bn','post_image', 'post_description_en','post_description_bn','status','category_id','sub_category_id','post_slug_en','post_slug_bn',
    ];

    public function post_category(){
        return $this->belongsTo(Post_category::class,'category_id');
    }

    public function post_subcategory(){
        return $this->belongsTo(Post_subcategory::class,'sub_category_id');
    }

    public function author(){
        return $this->belongsTo(Admin::class,'user_id');
    }

}
