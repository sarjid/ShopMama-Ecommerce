<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    // public function getAllMsgAjax(){
    //     $message = Contact::where('status',0)->latest()->get();
    //     $totalMsg = count($message);
    //     return response()->json(array(
    //         'message' => $message,
    //         'totalMsg' => $totalMsg,
    //     ));
    // }

    // -------------------- show all message in table ---------------- 
    public function allMessage(){
        $messages = Contact::where('status',0)->latest()->get();
        return view('admin.message.index',compact('messages'));
    }

    public function viewMsg($msg_id){
        $message = Contact::findOrFail($msg_id)->update(['status' => '1']);
        $message = Contact::where('id',$msg_id)->first();
        return view('admin.message.view',compact('message'));
    }  


    public function trashMessage(){
        $messages = Contact::where('status',1)->latest()->get();
         return view('admin.message.trash',compact('messages'));
    }

    public function trashMsgDel($msg_id){
        Contact::findOrFail($msg_id)->delete();
        $notification=array(
            'message'=>'Message Deleted Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

   
}
