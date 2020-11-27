<?php

namespace App\Http\Controllers\Fontend;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Subcategory;
use App\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatWiseProuctController extends Controller
{
    public function subCatProducts($subcat_id,$subcat_slug){
        $products = Product::where('subcategory_id',$subcat_id)->latest()->paginate(12);
        $categories = Category::where('status',1)->orderBy('category_name_en','ASC')->latest()->get();
        $brands = Brand::where('status',1)->orderBy('brand_name_en','ASC')->latest()->get();
        $sub_cat = Subcategory::findOrFail($subcat_id);      
        return view('pages.subcat-products',compact('products','categories','brands','sub_cat'));
    }

        // brand wise product show 
        public function brandProducts($brand_id,$brand_slug){
            $products = Product::where('brand_id',$brand_id)->latest()->paginate(12);
            $categories = Category::where('status',1)->orderBy('category_name_en','ASC')->latest()->get();
            $brands = Brand::where('status',1)->orderBy('brand_name_en','ASC')->latest()->get();
            $brand = Brand::findOrFail($brand_id);
            return view('pages.brand-products',compact('products','categories','brands','brand'));
        }

        // subsubcategory products 
        public function subsubProducts($subsub_id,$subsub_slug){
            $products = Product::where('subsubcategory_id',$subsub_id)->latest()->paginate(12);
            $categories = Category::where('status',1)->orderBy('category_name_en','ASC')->latest()->get();
            $brands = Brand::where('status',1)->orderBy('brand_name_en','ASC')->latest()->get();
            $subsub_cat = Subsubcategory::findOrFail($subsub_id);      
            return view('pages.sub-subcat-products',compact('products','categories','brands','subsub_cat'));
        }

        // tage wise product show 
        public function tagWiseProduct($tag){
            $products = Product::where('product_tags_en',$tag)->orWhere('product_tags_bn',$tag)->latest()->paginate(12);
            $categories = Category::where('status',1)->orderBy('category_name_en','ASC')->latest()->get();
            $brands = Brand::where('status',1)->orderBy('brand_name_en','ASC')->latest()->get();
            // $tag = Product::where('product_tags_en',$tag)->orWhere('product_tags_bn',$tag)->first();      
            return view('pages.tag-products',compact('products','categories','brands','tag'));
        }
}
