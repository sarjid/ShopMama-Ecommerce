<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Order;
use App\Orderdetail;
use App\Shipping;
use Carbon\Carbon;
use PDF;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
        ]);
        $id = Auth::user()->id;
        if ($request->file('image')) {
            $request->validate([
                'image' => 'required|mimes:jpg,jpeg,png,gif'
            ]);
            if (Auth::user()->image === 'fontend/assets/images/profile/avatar.png') {        
                $image = $request->file('image');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('fontend/assets/images/profile/'.$name_gen);
                $save_url = 'fontend/assets/images/profile/'.$name_gen;
                User::find($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'image' => $save_url,
                ]);
                $notification=array(
                    'message'=>'Profile Update Success',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
            }else{
                $old_img = $request->old_image;
                $image = $request->file('image');
                $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('fontend/assets/images/profile/'.$name_gen);
                $save_url = 'fontend/assets/images/profile/'.$name_gen;
                unlink($old_img);
                User::find($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'image' => $save_url,
                ]);
                $notification=array(
                    'message'=>'Profile Update Success',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
            }
        }else{
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $notification=array(
                'message'=>'Profile Update Success',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    // ============== Change Passwrod ============== 
    public function passPage(){
        return view('pages.profile.password');
    }

    // ---------- update password --------------- 
    public function passUpdate(Request $request){
        $id = Auth::user()->id;
        $db_pass = Auth::user()->password;
        $old_pass = $request->old_password;
        $new_pass = $request->new_password;
        $confirm_pass = $request->confirm_password;

        if(Hash::check($old_pass, $db_pass)){

            if($new_pass === $confirm_pass){
                User::find($id)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                Auth::logout();
                $notification=array(
                    'message'=>'Password Change Successfully.! Now login With New Password',
                    'alert-type'=>'success'
                );
                return Redirect()->route('login')->with($notification);

            }else{
                return Redirect()->back()->with('danger','new password and confirm passoword not same');
            }

        }else{
            return Redirect()->back()->with('error','old Passowrd Not match');
        }
    }

    // my orders 
    public function myOrders(){
        $orders = Order::where('user_id',Auth::id())->latest()->paginate(3);
        return view('pages.profile.my-order',compact('orders'));
    }

    // view orders 
    public function orderView($order_id){
        $order = Order::with('user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $order_details = Orderdetail::with('product')->where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::with('division','district','state')->where('order_id',$order_id)->first();
        return view('pages.profile.view-order',compact('order','shipping','order_details'));
    }

    // return order view 
    public function retunrOrderIndex(){
        
        $orders = Order::where('status',5)->where('user_id',Auth::id())->latest()->paginate(3);
        return view('pages.profile.return-order',compact('orders'));
    }

    // send to reurn request 
    public function retunrOrderRequest(Request $request,$order_id){
        $request->validate([
            'return_reason' =>'required'
        ]);
        Order::findOrFail($order_id)->update([
            'return_reason' => $request->return_reason,
            'return_order_status' => 1,
            'return_request_date' => Carbon::now(),
            'return_request_month' => Carbon::now()->format('F'),
            'return_request_year' => Carbon::now()->format('Y'),
        ]);

        $notification=array(
            'message'=>'Return Request Send Success',
            'alert-type'=>'success'
        );
        return Redirect()->to('user/return/order')->with($notification);
    }

    // ------------------ return order view ------------------ 
    public function retunrOrderView($order_id){
        $order = Order::with('user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $order_details = Orderdetail::with('product')->where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::with('division','district','state')->where('order_id',$order_id)->first();
        return view('pages.profile.view-return-order',compact('order','shipping','order_details'));
    }    

    // --------------- user Invoice download ------------------------
    public function invoiceDownload($order_id){
        $order = Order::with('user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $order_details = Orderdetail::with('product')->where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::with('division','district','state')->where('order_id',$order_id)->first();
        $pdf = PDF::loadView('pages.profile.invoice', compact('order','order_details','shipping'));
        return $pdf->download('invoice.pdf');
    }

 
}
