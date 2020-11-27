<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\Division;
use App\District;
use App\State;
use App\Order;
use App\Shipping;
use App\Orderdetail;
use Session;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
      // ================== payment process =============== 
      public function paymentPage(Request $request){
      
        $request->validate([
             'shipping_name' => 'required|min:4|max:30',
             'shipping_phone' => 'required|min:4|max:30',
             'shipping_email' => 'required|email',
             'division_id' => 'required',
             'district_id' => 'required',
             'state_id' => 'required',
             'post_code' => 'required|max:255',
             'payment' => 'required',
         ],
         [
             'payment.required' => 'Select Any Payment Method',
             'division_id.required' => 'select division name',
             'district_id.required' => 'select district name',
             'state_id.required' => 'select state name',
         ]);
 
         $data =array();
         $data['shipping_name'] = $request->shipping_name;
         $data['shipping_phone'] = $request->shipping_phone;
         $data['shipping_email'] = $request->shipping_email;
         $data['division_id'] = $request->division_id;
         $data['district_id'] = $request->district_id;
         $data['state_id'] = $request->state_id;
         $data['post_code'] = $request->post_code;
         $data['notes'] = $request->notes;
         $data['payment'] = $request->payment;
 
         $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
             return $t->price * $t->quantity;
         });
         $carts = Cart::latest()->where('ip_address',request()->ip())->get();
         if ($request->payment =='Stripe') {
            
            return view('pages.payment.stripe',compact('data','total','carts'));
             }elseif ($request->payment == 'Rocket') {               
               return view('pages.payment.rocket',compact('data','total','carts'));
             }elseif ($request->payment =='Bkash') {
                return view('pages.payment.bkash',compact(' ','total','carts'));
             }else {
                 echo "Handcash";
             }
 
     }
 
   


}
