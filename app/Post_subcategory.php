<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_subcategory extends Model
{

    protected $fillable = [
        'category_id', 'subcategory_name_en','subcategory_name_bn','subcategory_slug_en','subcategory_slug_bn','status',
    ];
   
    public function PostCategory(){
        return $this->belongsTo(Post_category::class,'category_id');
    }
}
