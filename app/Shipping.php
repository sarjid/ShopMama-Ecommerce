<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{

    protected $fillable = [
        'order_id','shipping_name','shipping_email','shipping_phone','division_id', 'district_id', 'state_id','post_code','notes',
    ];

    public function division(){
        return $this->belongsTo(Division::class,'division_id');
    }

    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
}
