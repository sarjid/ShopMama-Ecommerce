<?php

namespace App\Http\Controllers\Fontend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Division;
use App\District;
use App\State;
use App\Order;
use App\Shipping;
use App\Orderdetail;
use Symfony\Component\HttpFoundation\Session\Session;
use Carbon\Carbon;
class StripeController extends Controller
{
    public function stripeOrderStore(Request $request){
           
            // \Stripe\Stripe::setApiKey('sk_test_fAbqMVCkCwIqxFL7nhfgpG1e00RazfME62');
            // $token = $_POST['stripeToken'];

            // $charge = \Stripe\Charge::create([
            // 'amount' => 999*100,
            // 'currency' => 'usd',
            // 'description' => 'Payment From ShopMama',
            // 'source' => $token,
            // 'metadata' => ['order_id' => '6735'],
            // ]);

            // dd($charge);


            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'payment_type' => $request->payment,
                'payment_id' => mt_rand(100000,999999),
                'transaction_id' => 'DXCSBT6EK9DP',
                'paying_amount' => $request->paying_amount,
                'subtotal' => $request->subtotal,
                'coupon_discount' => $request->coupon_discount,
                'invoice_no' =>'SPM'.mt_rand(10000000,99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'created_at' => Carbon::now()
           ]);
    
            // shipping info 
              Shipping::insert([
                'order_id' => $order_id,
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_id' => $request->state_id,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'created_at' => Carbon::now()
           ]);
    
           // Order Details 
           $carts = Cart::where('ip_address',request()->ip())->latest()->get();
           foreach ($carts as $cart) {
              Orderdetail::insert([
                'order_id' => $order_id,
                'product_id' => $cart->product_id, 
                'color' => $cart->color,
                'size' => $cart->size,
                'quantity' => $cart->quantity,
                'single_price' => $cart->price,
                'total_price' => $cart->quantity * $cart->price,
                'created_at' => Carbon::now()
           ]);
           }
    
           $delete = Cart::where('ip_address',request()->ip())->delete();
           if (session()->has('coupon')) {
              session()->forget('coupon');
              
           }  
    
           $notification=array(
            'message'=>'Order Completed',
            'alert-type'=>'success'
        );
        return Redirect()->to('user/view/orders/'.$order_id)->with($notification);
         }

            
    }

