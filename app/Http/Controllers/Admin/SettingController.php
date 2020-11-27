<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $setting = Setting::findOrFail(1);
       return view('admin.setting.setting',compact('setting'));
    }

     // -------------------- update settings -------------- 
     public function update(Request $request){

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(131,29)->save('fontend/assets/images/logo/'.$name_gen);
            $logo = 'fontend/assets/images/logo/'.$name_gen;
            Setting::findOrFail(1)->update([
                'logo' => $logo,
                'address' => $request->address,
                'email' => $request->email,
                'address' => $request->address,
                'phone_no_one' => $request->phone_no_one,
                'phone_no_two' => $request->phone_no_two,
                'facebook_link' => $request->facebook_link,
                'twitter_link' => $request->twitter_link,
                'instagram_link' => $request->instagram_link,
                'linkedin_link' => $request->linkedin_link,
                'updated_at' => Carbon::now()
            ]);
    
            $notification=array(
                'message'=>'Update Success',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else {
            Setting::findOrFail(1)->update([
                'address' => $request->address,
                'email' => $request->email,
                'address' => $request->address,
                'phone_no_one' => $request->phone_no_one,
                'phone_no_two' => $request->phone_no_two,
                'facebook_link' => $request->facebook_link,
                'twitter_link' => $request->twitter_link,
                'instagram_link' => $request->instagram_link,
                'linkedin_link' => $request->linkedin_link,
                'updated_at' => Carbon::now()
            ]);
    
            $notification=array(
                'message'=>'Update Success',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
        
    }


}
