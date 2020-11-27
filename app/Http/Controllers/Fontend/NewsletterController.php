<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Newsletter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
   public function subscirbe(Request $request){
       $request->validate([
            'email' => 'required|unique:newsletters,email'
       ]);  
        
       Newsletter::insert([
            'email' => $request->email,
            'created_at' => Carbon::now(),
       ]);
       $notification=array(
        'message'=>'Subscribe Done',
        'alert-type'=>'success'
    );
return Redirect()->back()->with($notification);
   }
}
