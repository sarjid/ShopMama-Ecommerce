<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'division_id', 'district_name',
    ];

    public function div(){
        return $this->belongsTo(Division::Class,'division_id');
    }
}
