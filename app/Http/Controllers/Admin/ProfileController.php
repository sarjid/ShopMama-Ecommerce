<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

  public function adminProfile(){
     return view('admin.profile.index');
  }

//   ======== update profile -------------- 
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
            Admin::find($id)->update([
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
            Admin::find($id)->update([
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
        Admin::findOrFail($id)->update([
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

//   password page 
  public function password(){
    return view('admin.profile.password');

  }

//    update password 
  public function passUpdate(Request $request){
    $id = Auth::user()->id;
    $db_pass = Auth::user()->password;
    $old_pass = $request->old_password;
    $new_pass = $request->new_password;
    $confirm_pass = $request->confirm_password;

    if(Hash::check($old_pass, $db_pass)){

        if($new_pass === $confirm_pass){

            Admin::find($id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            Auth::logout();
            $notification=array(
                'message'=>'Password Change Successfully.! Now login With New Password',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.login')->with($notification);

        }else{
            return Redirect()->back()->with('danger','new password and confirm passoword not same');
        }

    }else{
        return Redirect()->back()->with('error','old Passowrd Not match');
    }
  }

//   ================= show all online and offline Users list =============
  public function allUsers(){
      $users = User::latest()->get();
      return view('admin.user-list.index',compact('users'));
  }

//   ============== delete users ============== 
  public function userDelete($user_id){
       $user =  User::findOrFail($user_id);
        $image = $user->image;
        if ($image == 'fontend/assets/images/profile/avatar.png') {
            User::findOrFail($user_id)->delete();
            $notification=array(
                'message'=>'Delete Success',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            unlink($image);
            User::findOrFail($user_id)->delete();
            $notification=array(
                'message'=>'Delete Success',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
  }

     // ================== user banned and unbannn ==================
     public function bannedUser($user_id){
        User::findOrFail($user_id)->update([
            'isban' => 1
        ]);
        $notification=array(
            'message'=>'user banned',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function unbanUser($user_id){
        User::findOrFail($user_id)->update([
            'isban' => 0
        ]);
        $notification=array(
            'message'=>'user Unban',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
  
}
