<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
use App\ProductComment;

class ProductController extends Controller
{
   

   public function DetailsPage($poduct_id,$product_slug){
    $product = Product::find($poduct_id);
    $color = $product->product_color_en;
    $product_color_en =  explode(',',$color); 
    $color = $product->product_color_bn;
    $product_color_bn =  explode(',',$color); 

    $size = $product->product_size_en;
    $product_size_en =  explode(',',$size); 
    $size = $product->product_size_bn;
    $product_size_bn =  explode(',',$size); 
    $brands = Brand::latest()->where('status',1)->get();
    $hot_deals = Product::latest()->where('status',1)->where('hot_deals',1)->where('discount_price','!=', NUll)->limit(10)->get();
    
    $cat = Product::findOrFail($poduct_id);
    $category_id = $cat->category_id;
    $related_p = Product::where('category_id',$category_id)->where('id','!=',$poduct_id)->latest()->get();
    $comments = ProductComment::where('product_id',$poduct_id)->latest()->paginate(5);
    return view('pages.product-details',compact('product','brands','hot_deals','product_color_en','product_color_bn','product_size_en','product_size_bn','related_p','comments'));

   }


}
