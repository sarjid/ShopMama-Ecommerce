<?php

namespace App\Http\Controllers\Fontend;

use App\Contact;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactPage(){
        return view('pages.contact');
    }

    // ----------- send message in database ------------------
    public function sendMessage(Request $request){
     
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Message Successfully Send',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
