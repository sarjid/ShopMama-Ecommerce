<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Division;
use App\District;
use App\State;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function checkoutPage(){
        
        if (Auth::check()) {
            $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
                return $t->price * $t->quantity;
            });
          $carts = Cart::latest()->where('ip_address',request()->ip())->get();
          $divisions = Division::orderBy('division_name','ASC')->get();
            return view('pages.checkout',compact('total','carts','divisions'));
        }else{
            $notification=array(
                'message'=>'At First Login Your Account',
                'alert-type'=>'error'
            );
            return Redirect()->route('login')->with($notification);

        }
    }

     // get district ajax 
     public function getDisAjax($id){
        $district = District::where('division_id',$id)->orderBy('district_name','ASC')->get();
        return json_encode($district);
    }

      // get district ajax 
      public function getStateAjax($id){
        $state = State::where('district_id',$id)->orderBy('state_name','ASC')->get();
        return json_encode($state);
    }

  
}
