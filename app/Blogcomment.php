<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogcomment extends Model
{

    protected $fillable = [
        'name', 'email','title','comments','status',
    ];

    public function blog(){
        return $this->belongsTo(Blog::class,'post_id');
    }
}
