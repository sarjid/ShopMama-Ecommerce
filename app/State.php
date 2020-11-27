<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  

    protected $fillable = [
        'division_id', 'district_id', 'state_name',
    ];

    public function dis(){
        return $this->belongsTo(District::Class,'district_id');
    }

     public function divs(){
        return $this->belongsTo(Division::Class,'division_id');
    }
}
