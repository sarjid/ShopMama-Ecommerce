<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Brand index page 
    public function BrandPage(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));

    }

 // ====================================== store Brands ============================== 
    public function StoreBrand(Request $request){
        $request->validate([
            'brand_name_en' => 'required|unique:brands,brand_name_en',
            'brand_name_bn' => 'required|unique:brands,brand_name_bn',
            'brand_image' => 'required|mimes:jpg,jpeg,png,gif'
        ],[
            'brand_name_en.required' => 'input brand name in english',
            'brand_name_en.unique' => 'The English Brand name has already been taken.',
            'brand_name_bn.required' => 'input brand name in bangla',
            'brand_name_bn.unique' => 'আপনার ব্রান্ড এর নামটি ইতিমধ্যে রয়েছে',


            'brand_image.required' => 'select any image',
        ]);

        $image = $request->file('brand_image');
        $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(166,110)->save('fontend/assets/images/brands/'.$name_gen);
        $save_url = 'fontend/assets/images/brands/'.$name_gen;
       $insert = Brand::insert([
        'brand_name_en' => $request->brand_name_en,
        'brand_name_bn' => $request->brand_name_bn,
        'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)) ,
        'brand_slug_bn' => str_replace(' ','-',$request->brand_name_bn) ,
        'brand_image' => $save_url,
        'created_at' => Carbon::now()
       ]);
        $notification=array(
            'message'=>'Brand Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // ============================= edit brand ===================== 
    public function EditBrand($brand_id){
        
       $brands = Brand::find($brand_id);
       return view('admin.brand.edit',compact('brands'));
    }

    // ================================ update brand ============================= 
    public function UpdateBrand(Request $request){
    
        $old_img = $request->old_image;
        $brand_id = $request->id;
        $image = $request->file('brand_image');
       
        if ($image) {
            $request->validate([           
                'brand_image' => 'mimes:jpg,jpeg,png,gif'
            ]);
         
            unlink($old_img);
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(166,110)->save('fontend/assets/images/brands/'.$name_gen);
            $save_url = 'fontend/assets/images/brands/'.$name_gen;
                 Brand::find($brand_id)->update([
                    'brand_name_en' => $request->brand_name_en,
                    'brand_name_bn' => $request->brand_name_bn,
                    'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)) ,
                    'brand_slug_bn' => strtolower(str_replace(' ','-',$request->brand_name_bn)) ,
                    'brand_image' => $save_url,
                    'updated_at' => Carbon::now()
            ]);
            $notification=array(
                'message'=>'Brand Updated Success',
                'alert-type'=>'success'
            );
            return Redirect()->route('brand.page')->with($notification);

           
        }else{
            
            $insert = Brand::find($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_bn' => $request->brand_name_bn,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)) ,
                'brand_slug_bn' => strtolower(str_replace(' ','-',$request->brand_name_bn)) ,
                'updated_at' => Carbon::now()
            ]);
            $notification=array(
                'message'=>'Brand Updated Success',
                'alert-type'=>'success'
            );
            return Redirect()->route('brand.page')->with($notification);

        }
    }

    // ===================================== delete Brands ================================

    public function DeleteBrand($brand_id){
        $brand = Brand::find($brand_id);
        $img = $brand->brand_image;
        unlink($img);
        $delete = Brand::find($brand_id)->delete();
        $notification=array(
            'message'=>'Brand Delete Success',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== Inactive Brands ================== 
    public function Inactive($brand_id){

        Brand::find($brand_id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'Brand Inactive',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== active Brands ================== 
    public function Active($brand_id){

        Brand::find($brand_id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'Brand Activated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
