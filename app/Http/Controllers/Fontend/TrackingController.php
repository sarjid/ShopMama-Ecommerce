<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Order;
use App\Orderdetail;
use App\Shipping;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
   public function oderTrack(Request $request){
       $order = Order::where('invoice_no',$request->invoice_no)->first();
       if ($order) {          
           $order_details = Orderdetail::with('product')->where('order_id',$order->id)->latest()->get();
           $shipping = Shipping::with('division','district','state')->where('order_id',$order->id)->first();
        return view('pages.order-track',compact('order','order_details','shipping'));
       }else{
            $notification=array(
                'message'=>'Order Not Found',
                'alert-type'=>'error'
            );
            return Redirect()->to('/')->with($notification);

       }
       
   }
}
