<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Newsletter;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

   public function subPage(){
       $subscribers = Newsletter::latest()->get();
       return view('admin.newsletter.index',compact('subscribers'));
   }

//    delete subsribers 
   public function destroy($subs_id){
       Newsletter::findOrFail($subs_id)->delete();
       $notification=array(
        'message'=>'Deleted Done',
        'alert-type'=>'success'
    );
    return Redirect()->back()->with($notification);
   }
}
