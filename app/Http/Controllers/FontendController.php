<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Subsubcategory;
use App\Blog;
use App\Product;
use App\Brand;
use App\Slider;

class FontendController extends Controller
{
    // index pages
    public function index(){
      
        $skip_category_0 =Category::where('status',1)->skip(0)->first();
        $skip_category_1 =Category::where('status',1)->skip(1)->first();
        $skip_category_2 =Category::where('status',1)->skip(2)->first();
        $skip_brand_0 =Brand::where('status',1)->skip(0)->first();
        $products_skip_0 = Product::latest()->where('status',1)->where('category_id',$skip_category_0->id)->get();
        $products_skip_1 = Product::latest()->where('status',1)->where('category_id',$skip_category_1->id)->get();
        $products_skip_2 = Product::latest()->where('status',1)->where('category_id',$skip_category_2->id)->get();
        $products_brand_skip_0 = Product::latest()->where('status',1)->where('brand_id',$skip_brand_0->id)->get();
        return view('pages.index',[
            'categories' => Category::where('status',1)->orderBy('category_name_en','ASC')->get(),
            'main_sliders' => Slider::latest()->where('status',1)->limit(5)->get(),
            'products' => Product::latest()->where('status',1)->get(),
            'new_arrivals' => Product::latest()->where('status',1)->where('discount_price',NUll)->get(),
            'featured_products' => Product::latest()->where('status',1)->where('featured',1)->get(), 
            'blogs' => Blog::latest()->where('status',1)->get(),
            'brands' => Brand::latest()->where('status',1)->get(),
            'hot_deals' => Product::latest()->where('status',1)->where('hot_deals',1)->where('discount_price','!=', NUll)->limit(10)->get(),
            'special_offer' => Product::latest()->where('status',1)->where('special_offer',1)->get(),
            'special_deals' => Product::latest()->where('status',1)->where('special_deals',1)->get(),
            'brands' => Brand::where('status',1)->orderBy('brand_name_en','ASC')->get(),
            'tags' => Product::latest()->where('status',1)->get(),
  
        ],compact('skip_category_0','products_skip_0','skip_category_1','skip_category_2','products_skip_1','products_skip_2','skip_brand_0','products_brand_skip_0'));
    }



    

    


}
