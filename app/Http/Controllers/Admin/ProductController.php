<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Subsubcategory;
use App\Brand;
use App\Product;
use App\ProductComment;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //============================ add product page ===================== 
    public function AddProduct(){

        $categories = Category::orderBy('category_name_en','ASC')->where('status',1)->get();
        $brands = Brand::orderBy('brand_name_en','ASC')->where('status',1)->get();
        return view('admin.product.add',compact('categories','brands'));
    }

    // get subcategory name with ajax 
    public function GetSubCat($cat_id){   
        $subcat = Subcategory::where('category_id',$cat_id)->where('status',1)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }

    // get sub-sub-category name with ajax 
    public function GetSubSubCat($subcat_id){    
        $subsubcat = Subsubcategory::where('subcategory_id',$subcat_id)->where('status',1)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
    }

    public function StoreProducts(Request $request){
        
        $request->validate([
            'product_name_en' => 'required|unique:products,product_name_en',
            'product_name_bn' => 'required|unique:products,product_name_bn',
            'product_code' => 'required|unique:products,product_code',
            'product_color_en' => 'required',
            'product_color_bn' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_quantity' => 'required',
            'selling_price' => 'required',
            'product_weight' => 'required',
            'product_tags_en' => 'required',
            'product_tags_bn' => 'required',
            'short_description_en' => 'required',
            'short_description_bn' => 'required',
            'long_description_en' => 'required',
            'long_description_bn' => 'required',
            'image_one' => 'required',
            'image_two' => 'required',
            'image_three' => 'required',
        ],
        [
            'product_name_bn.required' => 'The product name bangla field is required',
            'product_name_en.required' => 'The product name english field is required',
            'product_color_en.required' => 'The product color english field is required',
            'product_color_bn.required' => 'The product color bangla field is required',
            'short_description_en.required' => 'The short description english field is required',
            'short_description_bn.required' => 'The short description bangla field is required',
            'long_description_en.required' => 'The long description english field is required',
            'long_description_bn.required' => 'The long description bangla field is required',
            'product_tags_en.required' => 'The product tags english field is required',
            'product_tags_bn.required' => 'The product tags bangla field is required',
        ]);

            $image_one = $request->file('image_one');
            $image_two = $request->file('image_two');
            $image_three = $request->file('image_three');

            $img_name_gen_one = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(917,1000)->save('media/products/'.$img_name_gen_one);
            $img_one= 'media/products/'.$img_name_gen_one;

            $img_name_gen_two = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(917,1000)->save('media/products/'.$img_name_gen_two);
            $img_two= 'media/products/'.$img_name_gen_two;

            $img_name_gen_three = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(917,1000)->save('media/products/'.$img_name_gen_three);
            $img_three= 'media/products/'.$img_name_gen_three;

        $insert = product::insert([
            'product_name_en' => $request->product_name_en,
            'product_name_bn' => $request->product_name_bn,
            'product_slug_en' => strtolower(str_replace(' ','-', $request->product_name_en)),
            'product_slug_bn' => str_replace(' ','-', $request->product_name_bn),
            'product_code' => strtoupper($request->product_code),
            'product_color_en' => $request->product_color_en,
            'product_color_bn' => $request->product_color_bn,
            'product_size_en' => $request->product_size_en,
            'product_size_bn' => $request->product_size_bn,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_quantity' => $request->product_quantity,
            'selling_price' => $request->selling_price,
            'product_weight' => $request->product_weight,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_bn' => $request->product_tags_bn,
            'video_link' => $request->video_link,
            'short_description_en' => $request->short_description_en,
            'short_description_bn' => $request->short_description_bn,
            'long_description_en' => $request->long_description_en,
            'long_description_bn' => $request->long_description_bn,
            'image_one' => $img_one,
            'image_two' => $img_two,
            'image_three' => $img_three,
            'main_slider' => $request->main_slider,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'created_at' => Carbon::now()
        ]);
        $notification=array(
            'message'=>'Products Upload Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('manage-products')->with($notification);

    }

    // ======================== Manage products or all products list show page =========================
    public function ManageProduct(){
        $products = Product::latest()->get();
        return view('admin.product.manage-product',compact('products'));

    }


    // ================================= view products ==============================
    public function ViewProducts($product_id,$slug){
        $products = Product::find($product_id);
        return view('admin.product.view',compact('products'));
    }

    // ================================= Edit products ==============================
    public function EditProducts($product_id,$slug){
        $products = Product::find($product_id);
          $cat_id = $products->category_id;
          $subcat_id = $products->subcategory_id;
        $brands = Brand::orderBy('brand_name_en','ASC')->where('status',1)->get();
        $categories = Category::orderBy('category_name_en','ASC')->where('status',1)->get();
        $subcategories = Subcategory::orderBy('subcategory_name_en','ASC')->where('category_id',$cat_id)->where('status',1)->get();
        $subsubcategories = Subsubcategory::orderBy('subsubcategory_name_en','ASC')->where('subcategory_id',$subcat_id)->where('status',1)->get();
        return view('admin.product.edit',compact('products','brands','categories','subcategories','subsubcategories'));
    }

       // ================================= update products without image ==============================

       public function WithoutImgUpdt(Request $request,$product_id){
        
        $products = Product::find($product_id);
        $price =  $products->selling_price;
       
       
        if ($price <= $request->discount_price) {         
        return Redirect()->back()->with('error','product Discount Price Must Be Less then Selling Price');
        }else {           
       $update = product::find($product_id)->update([
           'product_name_en' => $request->product_name_en,
           'product_name_bn' => $request->product_name_bn,
           'product_slug_en' => strtolower(str_replace(' ','-', $request->product_name_en)),
           'product_slug_bn' => str_replace(' ','-', $request->product_name_bn),
           'product_code' => strtoupper($request->product_code),
           'product_color_en' => $request->product_color_en,
           'product_color_bn' => $request->product_color_bn,
           'product_size_en' => $request->product_size_en,
           'product_size_bn' => $request->product_size_bn,
           'brand_id' => $request->brand_id,
           'category_id' => $request->category_id,
           'subcategory_id' => $request->subcategory_id,
           'subsubcategory_id' => $request->subsubcategory_id,
           'product_quantity' => $request->product_quantity,
           'selling_price' => $request->selling_price,
           'discount_price' => $request->discount_price,
           'product_weight' => $request->product_weight,
           'product_tags_en' => $request->product_tags_en,
           'product_tags_bn' => $request->product_tags_bn,
           'video_link' => $request->video_link,
           'short_description_en' => $request->short_description_en,
           'short_description_bn' => $request->short_description_bn,
           'long_description_en' => $request->long_description_en,
           'long_description_bn' => $request->long_description_bn,
           'main_slider' => $request->main_slider,
           'hot_deals' => $request->hot_deals,
           'featured' => $request->featured,
           'special_offer' => $request->special_offer,
           'special_deals' => $request->special_deals,
           'updated_at' => Carbon::now()
       ]);
       $notification=array(
           'message'=>'Products Updated Success',
           'alert-type'=>'success'
       );
       return Redirect()->route('manage-products')->with($notification);
       }
    }


    // update image 
    public function WithImgUpdt(Request $request,$product_id){
     

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        $old_One = $request->old_one;
        $old_two = $request->old_two;
        $old_three = $request->old_three;

        // all image update
        if ($request->has('image_one') && $request->has('image_two') && $request->has('image_three') ) {
 
           unlink($old_One);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(917,1000)->save('media/products/'.$image_one_name);
            $img_one_url = 'media/products/'.$image_one_name;
            Product::find($product_id)->update([
                'image_one' => $img_one_url,
            ]);
           
          
            unlink($old_two);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(917,1000)->save('media/products/'.$image_two_name);
            $img_two_url = 'media/products/'.$image_two_name;
            Product::find($product_id)->update([           
                'image_two' => $img_two_url              
            ]);

           
            unlink($old_three);
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(917,1000)->save('media/products/'.$image_three_name);
            $img_three_url = 'media/products/'.$image_three_name;
            Product::find($product_id)->update([
                'image_three' => $img_three_url
            ]);
            $notification=array(
                'message'=>'Product All Image Updated Successfully ',
                'alert-type'=>'success'
               );
        return Redirect()->route('manage-products')->with($notification);

        }
    
        // image One and two updated
        if ($request->has('image_one') && $request->has('image_two')) {
            unlink($old_One);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(917,1000)->save('media/products/'.$image_one_name);
            $img_one_url = 'media/products/'.$image_one_name;
            Product::find($product_id)->update([
                'image_one' => $img_one_url,
            ]);
 
            unlink($old_two);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(917,1000)->save('media/products/'.$image_two_name);
            $img_two_url = 'media/products/'.$image_two_name;
            Product::find($product_id)->update([           
                'image_two' => $img_two_url              
            ]);

            $notification=array(
                'message'=>'Image One And Two Updated Successfully ',
                'alert-type'=>'success'
               );
        return Redirect()->route('manage-product')->with($notification);


        }

        // image two and three update

        if ($request->has('image_two') && $request->has('image_three')) {
            unlink($old_two);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(917,1000)->save('media/products/'.$image_two_name);
            $img_two_url = 'media/products/'.$image_two_name;
            Product::find($product_id)->update([           
                'image_two' => $img_two_url              
            ]);

            unlink($old_three);
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(917,1000)->save('media/products/'.$image_three_name);
            $img_three_url = 'media/products/'.$image_three_name;
            Product::find($product_id)->update([
                'image_three' => $img_three_url
            ]);
            $notification=array(
                'message'=>'Product Image Two & Three Updated Successfully ',
                'alert-type'=>'success'
               );
        return Redirect()->route('manage-products')->with($notification);
        }

       // image one and image three update
        if ($request->has('image_one') && $request->has('image_two') ) {
            unlink($old_One);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(917,1000)->save('media/products/'.$image_one_name);
            $img_one_url = 'media/products/'.$image_one_name;
            Product::find($product_id)->update([
                'image_one' => $img_one_url,
            ]);
 

            unlink($old_two);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(917,1000)->save('media/products/'.$image_two_name);
            $img_two_url = 'media/products/'.$image_two_name;
            Product::find($product_id)->update([           
                'image_two' => $img_two_url              
            ]);
            $notification=array(
                'message'=>'Image One & Three Updated Successfully ',
                'alert-type'=>'success'
               );
             return Redirect()->route('manage-products')->with($notification);
        }
        //Image One updated
        if ($request->has('image_one')) {
            unlink($old_One);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(917,1000)->save('media/products/'.$image_one_name);
            $img_one_url = 'media/products/'.$image_one_name;
            Product::find($product_id)->update([
                'image_one' => $img_one_url,
            ]);
 
            $notification=array(
                'message'=>'Image One Updated Successfully ',
                'alert-type'=>'success'
               );
             return Redirect()->route('manage-products')->with($notification);
        }
         //Image Two updated
        if ($request->has('image_two')) {
            unlink($old_two);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(917,1000)->save('media/products/'.$image_two_name);
            $img_two_url = 'media/products/'.$image_two_name;
            Product::find($product_id)->update([           
                'image_two' => $img_two_url              
            ]);
            $notification=array(
                'message'=>'Image Two Updated Successfully ',
                'alert-type'=>'success'
               );
             return Redirect()->route('manage-products')->with($notification);
        }
         //Image Three updated
        if ($request->has('image_three')) {
            unlink($old_three);
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(917,1000)->save('media/products/'.$image_three_name);
            $img_three_url = 'media/products/'.$image_three_name;
            Product::find($product_id)->update([
                'image_three' => $img_three_url
            ]);
            $notification=array(
                'message'=>'Image Three Updated Successfully ',
                'alert-type'=>'success'
               );
             return Redirect()->route('manage-products')->with($notification);


        }
    }


    // ======================= Delete Products ===================== 
    public function delete($product_id){
        $products = Product::find($product_id);
        $img_one = $products->image_one;
        $img_two = $products->image_two;
        $img_three = $products->image_three;
        unlink($img_one);
        unlink($img_two);
        unlink($img_three);
        Product::find($product_id)->delete();
        $notification=array(
            'message'=>'Product Deleted Successfully ',
            'alert-type'=>'success'
           );
         return Redirect()->route('manage-products')->with($notification);
    }

     // ====================== Inactive  ================== 
     public function Inactive($product_id){

        Product::find($product_id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'Product Inactive',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== active ================== 
    public function Active($product_id){

        Product::find($product_id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'Product Activated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // =================== product comment or review ================ 
    public function reviewProducts(){
        $comments = ProductComment::with('product')->latest()->get();
        return view('admin.product.comment.index',compact('comments'));
    }

    // delete product comment 
    public function deleteProduct($product_id){
        ProductComment::findOrFail($product_id)->delete();
        $notification=array(
            'message'=>'Successfully Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

}
