<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blogcomment;
use Carbon\Carbon;

class BlogcommentController extends Controller
{
   public function StoreComment(Request $request,$post_id){
       $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'comment' => 'required',
       ]);
       
      $insert = Blogcomment::insert([
        'post_id' => $post_id,
        'name' => $request->name,
        'email' => $request->email,
        'title' => $request->title,
        'comment' => $request->comment,
        'created_at' => Carbon::now(),
       ]);
        if ($insert) {
            $notification=array(
                'message'=>'Comment Submitted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            
            $notification=array(
                'message'=>'Comment not Submitted',
                'alert-type'=>'error'
            );
        return Redirect()->back()->with($notification);

        }
      
   }
}
