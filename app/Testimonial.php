<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{  
    protected $fillable = [
        'image', 'client_name', 'review',
    ];

}
