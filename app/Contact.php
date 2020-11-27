<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $fillable = ([
        'name','email','subject','message','time','status'
    ]);

    public function getFormattedDateAttribute(){
        return $this->created_at->diffForhumans();
    }

    protected $appends = ['formattedDate'];


}
