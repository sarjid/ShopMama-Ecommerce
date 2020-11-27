<?php

namespace App\Http\Controllers\Fontend;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
   public function searchProduct(Request $request){
      $search =  $request->search;
   
      if ($search == NULL) {
        $notification=array(
            'message'=>'পণ্যের নাম লিখে অনুসন্ধান করুন',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);

      }else{
           $products = DB::table('products')
                     ->join('categories','products.category_id','categories.id')
                     ->join('subcategories','products.subcategory_id','subcategories.id')
                     ->join('subsubcategories','products.subsubcategory_id','subsubcategories.id')
                     ->Join('brands','products.brand_id','brands.id')
                     ->select('products.*','categories.category_name_en','categories.category_name_bn','subcategories.subcategory_name_en','subcategories.subcategory_name_bn','subsubcategories.subsubcategory_name_en','subsubcategories.subsubcategory_name_bn','brands.brand_name_en','brands.brand_name_bn')
                     ->where('product_name_en','LIKE',"%{$search}%")
                     ->orWhere('product_name_bn','LIKE',"%{$search}%")
                     ->orWhere('short_description_en','LIKE',"%{$search}%")
                     ->orWhere('short_description_bn','LIKE',"%{$search}%")
                     ->orWhere('long_description_en','LIKE',"%{$search}%")
                     ->orWhere('long_description_bn','LIKE',"%{$search}%")
                     ->orWhere('category_name_en','LIKE',"%{$search}%")
                     ->orWhere('category_name_bn','LIKE',"%{$search}%")
                     ->orWhere('subcategory_name_en','LIKE',"%{$search}%")
                     ->orWhere('subcategory_name_bn','LIKE',"%{$search}%")
                     ->orWhere('subsubcategory_name_bn','LIKE',"%{$search}%")
                     ->orWhere('subsubcategory_name_bn','LIKE',"%{$search}%")
                     ->orWhere('brand_name_en','LIKE',"%{$search}%")
                     ->orWhere('brand_name_bn','LIKE',"%{$search}%")
                     ->paginate(12);
       $categories = Category::where('status',1)->orderBy('category_name_en','ASC')->latest()->get();
        $brands = Brand::where('status',1)->orderBy('brand_name_en','ASC')->latest()->get();
            return view('pages.search-result',compact('products','categories','brands'));
      }

   }
}
