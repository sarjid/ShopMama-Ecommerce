<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create(){
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonial.index',compact('testimonials'));
    }

    // -------------------- store testimonial --------------- 
    public function store(Request $request){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(270,270)->save('fontend/assets/images/testimonial/'.$name_gen);
        $save_url = 'fontend/assets/images/testimonial/'.$name_gen;
        Testimonial::insert([
            'client_name' => $request->client_name,
            'review' => $request->review,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification=array(
            'message'=>'Successfully Added',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


    }

    // ===================== edit testimonial ============== 
    public function edit($id){
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit',compact('testimonial'));
    }

    // ================== update testimonial =========== 
    public function update(Request $request){
        $old_img = $request->old_image;
        $id = $request->id;
        $image = $request->file('image');
       
        if ($image) {
            $request->validate([           
                'image' => 'mimes:jpg,jpeg,png,gif'
            ]);
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(270,270)->save('fontend/assets/images/testimonial/'.$name_gen);
            $save_url = 'fontend/assets/images/testimonial/'.$name_gen;
            Testimonial::findOrFail($id)->update([
                'client_name' => $request->client_name,
                'review' => $request->review,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification=array(
                'message'=>'Successfully Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('testimonial.page')->with($notification);
           
        }else{
            Testimonial::findOrFail($id)->update([
                'client_name' => $request->client_name,
                'review' => $request->review,
                'created_at' => Carbon::now(),
            ]);

            $notification=array(
                'message'=>'Successfully Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('testimonial.page')->with($notification);
        }
    }

    // =================== destroy testimonial ============== 
    public function destroy($id){
       $tsmnl = Testimonial::findOrFail($id);
       $img = $tsmnl->image;
       unlink($img);
       Testimonial::findOrFail($id)->delete();
       $notification=array(
        'message'=>'Successfully Deleted',
        'alert-type'=>'success'
    );
    return Redirect()->route('testimonial.page')->with($notification);

    }

}
