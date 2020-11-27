<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Product;
use App\Post_category;
use App\Blogcomment;
use Illuminate\Support\Facades\DB;

class BlogsdetailsController extends Controller
{

   // blog page show 
   public function blogPage(){
      $blogs = Blog::with('post_category','post_subcategory','author')->latest()->paginate(3);
      return view('pages.blog',compact('blogs'));
   }
   
   // details show blog post 
   public function ViewPost($blog_id,$blog_slug){

    $blog = Blog::find($blog_id);
    $blog_categories = Post_category::orderBy('category_name_en','ASC')->where('status',1)->get();
    $blog_posts = Blog::latest()->where('status',1)->limit('4')->get();
    $tags = Product::latest()->where('status',1)->get();
    $comments = Blogcomment::latest()->where('post_id',$blog_id)->get();
    return view('pages.blog-details',compact('blog','blog_categories','blog_posts','tags','comments'));
   }

   // ==================== blog search ================ 
   public function search(Request $request){
      $search = $request->blog_search;
     $blogs = DB::table('blogs')
            ->join('post_categories','blogs.category_id','post_categories.id')
            ->join('post_subcategories','blogs.sub_category_id','post_subcategories.id')
            ->join('admins','blogs.user_id','admins.id')
            ->select('blogs.*','post_categories.category_name_en','post_categories.category_name_bn','post_subcategories.subcategory_name_en','post_subcategories.subcategory_name_bn','admins.name')
            ->where('post_title_en','LIKE',"%{$search}%")
            ->orWhere('post_title_bn','LIKE',"%{$search}%")
            ->orWhere('post_description_en','LIKE',"%{$search}%")
            ->orWhere('post_description_bn','LIKE',"%{$search}%")
            ->orWhere('category_name_en','LIKE',"%{$search}%")
            ->orWhere('category_name_bn','LIKE',"%{$search}%")
            ->orWhere('subcategory_name_en','LIKE',"%{$search}%")
            ->orWhere('subcategory_name_bn','LIKE',"%{$search}%")
            ->paginate(3);
      return view('pages.blog-search',compact('blogs'));
   }
   // ==================== subcategory wise blog show ==================== 
   public function showSubcatWiseBlog($sub_cat,$slug){
      $blogs = Blog::where('sub_category_id',$sub_cat)->latest()->paginate(3);
      return view('pages.blog-subcat',compact('blogs'));

   }
}
