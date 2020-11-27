<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\ProductComment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function productComment(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'rating' => 'required',
            'review' => 'required',
        ]);
    
        ProductComment::insert([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->review,
            'created_at' => Carbon::now(),
        ]);

        $notification=array(
            'message'=>'Your Review Submit Done',
            'alert-type'=>'success'
        );
    return Redirect()->back()->with($notification);


    }
}
