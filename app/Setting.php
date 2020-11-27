<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
     protected $fillable = [
        'logo', 'address', 'email','phone_no_one','phone_no_two','facebook_link','instagram_link','linkedin_link','twitter_link',
    ];
            

}
