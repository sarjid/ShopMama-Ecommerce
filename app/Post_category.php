<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_category extends Model
{
    protected $fillable = [
        'category_name_en', 'category_name_bn','category_slug_en','category_slug_bn','status',
    ];

}
