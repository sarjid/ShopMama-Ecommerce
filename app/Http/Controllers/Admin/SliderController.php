<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function sliderPage(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    // ========= stor slider ========== 
    public function storeSlider(Request $request){       
        $request->validate([
            'image' => 'required|mimes:png,jpg,gif,jpeg',         
        ]);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('fontend/assets/images/slider/'.$name_gen);
        $save_url = 'fontend/assets/images/slider/'.$name_gen;
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification=array(
            'message'=>'Slider Upload Done',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // ============= edit slider ============= 
    public function sliderEdit($slider_id){
        $slider = Slider::findOrFail($slider_id);
        return view('admin.slider.edit',compact('slider'));
    }
    
    // ------------ update slider -----------j 
    public function sliderUpdate(Request $request){
        $old_img = $request->old_image;
        $slider_id = $request->slider_id;
        $image = $request->file('image');
       
        if ($image) {
            $request->validate([           
                'image' => 'mimes:jpg,jpeg,png,gif'
            ]);
            unlink($old_img);
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(870,370)->save('fontend/assets/images/slider/'.$name_gen);
            $save_url = 'fontend/assets/images/slider/'.$name_gen;
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url,
                'created_at' => Carbon::now()
            ]);
    
            $notification=array(
                'message'=>'Slider update Done',
                'alert-type'=>'success'
            );
            return Redirect()->route('slider.page')->with($notification);
           
        }else{
            $slider_id = $request->slider_id;
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'updated' => Carbon::now()
            ]);
    
            $notification=array(
                'message'=>'Slider Update Done',
                'alert-type'=>'success'
            );
            return Redirect()->route('slider.page')->with($notification);
        }
    }

    // ================ delete slider ========= 
    public function sliderDelete($slider_id){
        $delete = Slider::findOrFail($slider_id);
        $img = $delete->image;
        unlink($img);
        $delete = Slider::findOrFail($slider_id)->delete();
        $notification=array(
            'message'=>'Delete Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('slider.page')->with($notification);

    }

    // ====================== Inactive slider ================== 
    public function Inactive($slider_id){

        Slider::find($slider_id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'slider Inactive',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== active slider ================== 
    public function Active($slider_id){

        Slider::find($slider_id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'slider Activated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
