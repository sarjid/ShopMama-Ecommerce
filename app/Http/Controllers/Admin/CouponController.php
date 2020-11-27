<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

// ===================== index page====================
    public function index(){
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index',compact('coupons'));
    }

    // ====================== store coupon ======================= 
    public function StoreCoupon(Request $request){
        
        $request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name',
            'coupon_discount' => 'required|numeric|min:1|max:99',
            'coupon_validity' => 'required',
        ]);


        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now()
        ]);

        $notification=array(
            'message'=>'Coupon Added',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // ======================== Edit coupon ===================
    public function Edit($coupon_id){
        $coupons = Coupon::find($coupon_id);
        return view('admin.coupon.edit',compact('coupons'));
    }

    // ==================== update =================== 
    public function Update(Request $request){
        
        $request->validate([
            'coupon_discount' => 'numeric|min:1|max:99',
        ]);
        $coupon_id = $request->id;
        $check = Coupon::find($coupon_id);
        $db_name = $check->coupon_name;

        if ($db_name === $request->coupon_name) {
            Coupon::find($coupon_id)->update([
                'coupon_name' => strtoupper($request->coupon_name),
                'coupon_discount' => $request->coupon_discount,
                'coupon_validity' => $request->coupon_validity,
                'updated_at' => Carbon::now()
            ]);

            $notification=array(
                'message'=>'Coupon Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('coupon.page')->with($notification);
           
        }else{
            $request->validate([
                'coupon_name' => 'unique:coupons,coupon_name',             
            ]);
            Coupon::find($coupon_id)->update([
                'coupon_name' => strtoupper($request->coupon_name),
                'coupon_discount' => $request->coupon_discount,
                'coupon_validity' => $request->coupon_validity,
                'updated_at' => Carbon::now()
            ]);

            $notification=array(
                'message'=>'Coupon Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('coupon.page')->with($notification);
           
         }
    }

    // ========================== Delete Coupon ============== 
    public function Delete($coupon_id){

        $delete = Coupon::find($coupon_id)->delete();
        if ($delete) {
            $notification=array(
                'message'=>'Coupon Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->route('coupon.page')->with($notification);
        }
    }
}
