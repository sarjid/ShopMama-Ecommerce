<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Post_category;
use App\Post_subcategory;
use App\Blogcomment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // ================================================= category ======================================== 
    // category page
    public function AddCat(){
        
        $categories = Post_category::latest()->get();
        return view('admin.blog.category.add-cat',compact('categories'));

    } 

    // ================= store category ================ 
    public function StoreCat(Request $request){
        $request->validate([
            'category_name_en' => 'required|unique:post_categories,category_name_en',
            'category_name_bn' => 'required|unique:post_categories,category_name_bn',
        ],[
            'category_name_en.required' => 'input Category name in english',
            'category_name_en.unique' => 'The English category name has already been taken.',
            'category_name_bn.required' => 'input Category name in english',
            'category_name_bn.unique' => 'আপনার ক্যাটেগরির নামটি ইতিমধ্যে রয়েছে',
        ]);


    
            $insert = Post_category::insert([
                'category_name_en' => $request->category_name_en,
                'category_name_bn' => $request->category_name_bn,
                'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
                'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
                'created_at' => Carbon::now()
               ]);
                $notification=array(
                    'message'=>'Category insert Success',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);

    }

// ==================== edit category ==============
    public function EditCat($cat_id){
        $categories = Post_category::find($cat_id);
        return view('admin.blog.category.edit',compact('categories'));
    }

    // ====================== update category ================ 
    public function UpdateCat(Request $request,$cat_id){

        $check = Post_category::find($cat_id);
        $db_name_en = $check->category_name_en;
        $db_name_bn = $check->category_name_bn;

        if ($db_name_en !== $request->category_name_en) {
            $request->validate([
                'category_name_en' => 'required|unique:post_categories,category_name_en',
            ],[
                'category_name_en.unique' => 'The English category name has already been taken.',             
            ]);

        }elseif ($db_name_bn !== $request->category_name_bn) {
            $request->validate([            
                'category_name_bn' => 'required|unique:post_categories,category_name_bn',
            ],[
                'category_name_bn.unique' => 'আপনার ক্যাটেগরির নামটি ইতিমধ্যে রয়েছে',
            ]);         
           
        }else {
            $insert = Post_category::find($cat_id)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_bn' => $request->category_name_bn,
                'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
                'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
                'updated_at' => Carbon::now()
               ]);
                $notification=array(
                    'message'=>'Category updated Success',
                    'alert-type'=>'success'
                );
                return Redirect()->route('add-category')->with($notification);
           
        }

    }

    // ================== delete cat =============== 
    public function DeleteCat($cat_id){
        Post_category::find($cat_id)->delete();
        Post_subcategory::where('category_id',$cat_id)->delete();
        $notification=array(
            'message'=>'Category Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
        
    }

      // ====================== Inactive category ================== 
      public function InactiveCat($cat_id){

        Post_category::find($cat_id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'Category Inactive',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== active category ================== 
    public function ActiveCat($cat_id){

        Post_category::find($cat_id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'Category Activated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

// ==================================================== sub category ========================================= 
    public function AddSubCat(){
        $categories = Post_category::where('status',1)->orderBy('category_name_en','ASC')->get();
        $subcategories = Post_subcategory::latest()->get();
        return view('admin.blog.sub-category.index',compact('categories','subcategories'));

    }

    public function StoreSubCat(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required|unique:post_subcategories,subcategory_name_en',
            'subcategory_name_bn' => 'required||unique:post_subcategories,subcategory_name_bn',
        ],[
            'category_id.required' => 'Select Category name',
            'subcategory_name_en.required' => 'input sub category name in english',
            'subcategory_name_bn.required' => 'input sub category name in bangla',
        ]);
            
       
       $insert = Post_subcategory::insert([
        'category_id' => $request->category_id,
        'subcategory_name_en' => $request->subcategory_name_en,
        'subcategory_name_bn' => $request->subcategory_name_bn,
        'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
        'subcategory_slug_bn' => str_replace(' ','-',$request->subcategory_name_bn),
        'created_at' => Carbon::now()
       ]);
       if ($insert) {
        $notification=array(
            'message'=>'Sub Category insert Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

       }
    }
      
    // ==================== edit sub category ==============
    public function EditSubCat($subcat_id){
        $categories = Post_category::where('status',1)->orderBy('category_name_en','ASC')->get();
        $subcategories = Post_subcategory::find($subcat_id);
        return view('admin.blog.sub-category.edit',compact('categories','subcategories'));
    }

    // =================== update subcategory ===================== 
    public function UpdateSubCat(Request $request,$subcat_id){

        // $request->validate([
        //     'category_id' => 'required',
        //     'subcategory_name_en' => 'required|unique:post_subcategories,subcategory_name_en',
        //     'subcategory_name_bn' => 'required||unique:post_subcategories,subcategory_name_bn',
        // ],[
        //     'category_id.required' => 'Select Category name',
        //     'subcategory_name_en.required' => 'input sub category name in english',
        //     'subcategory_name_bn.required' => 'input sub category name in bangla',
        // ]);


        $check = Post_subcategory::find($subcat_id);
        $db_name_en = $check->subcategory_name_en;
        $db_name_bn = $check->subcategory_name_bn;
            
        if ($db_name_en !== $request->subcategory_name_en) {
            $request->validate([
                'subcategory_name_en' => 'unique:post_subcategories,subcategory_name_en',
            ]);
        }elseif ($db_name_bn !== $request->subcategory_name_bn) {
            $request->validate([
                'subcategory_name_bn' => 'unique:post_subcategories,subcategory_name_bn',
            ]);

        }else {
            
            $update = Post_subcategory::find($subcat_id)->update([
             'category_id' => $request->category_id,
             'subcategory_name_en' => $request->subcategory_name_en,
             'subcategory_name_bn' => $request->subcategory_name_bn,
             'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
             'subcategory_slug_bn' => str_replace(' ','-',$request->subcategory_name_bn),
             'updated_at' => Carbon::now()
            ]);
            if ($update) {
             $notification=array(
                 'message'=>'Sub Category Updated Success',
                 'alert-type'=>'success'
             );
             return Redirect()->route('add-sub-category')->with($notification);
     
            }
        }
    

    }

     // ================== delete sub-cat =============== 
     public function DeleteSubCat($subcat_id){
        Post_subcategory::find($subcat_id)->delete();
        $notification=array(
            'message'=>'Sub-Category Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
        
    }

     // ====================== Inactive sub category ================== 
     public function InactiveSubCat($subcat_id){

        Post_subcategory::find($subcat_id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'Sub-Category Inactive',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== active sub category ================== 
    public function ActiveSubCat($subcat_id){

        Post_subcategory::find($subcat_id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'Sub-Category Activated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // ======================================================== post ============================================ 
    public function addpost(){
        $categories = Post_category::where('status',1)->orderBy('category_name_en','ASC')->get();
        return view('admin.blog.post.add-post',compact('categories'));
    }
    // =================== get blog subcategory by ajax =================== 
    public function GetBLogSubCatAjax($cat_id){
        $subcat = Post_subcategory::where('category_id',$cat_id)->where('status',1)->orderBy('subcategory_name_en','ASC')->get(); 
        return json_encode($subcat);
    }


    // ======================== store post ===================== 
    public function StorePost(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'post_title_en' => 'required',
            'post_title_bn' => 'required',
            'post_description_en' => 'required',
            'post_description_bn' => 'required',
            'post_image' => 'required|mimes:jpg,png,jpeg,'
        ],[
            'category_id.required' => 'select category',
            'subcategory_id.required' => 'select subcategory',
            'post_title_en.required' => 'write english post title',
            'post_title_bn.required' => 'write bangla post title',
            'post_description_en.required' => 'write post description in english',
            'post_description_bn.required' => 'write post description in bangla',
            'post_image.required' => 'please select any image'
        ]);

            $Image = $request->file('post_image');
            $Image_name = hexdec(uniqid()).'.'.$Image->getClientOriginalExtension();
            Image::make($Image)->resize(780,433)->save('media/post/'.$Image_name);
            $Img_url = 'media/post/'.$Image_name;


        $insert = Blog::insert([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'post_title_en' => $request->post_title_en,
            'post_title_bn' => $request->post_title_bn,
            'post_slug_en' => strtolower(str_replace(' ','-',$request->post_title_en)),
            'post_slug_bn' => str_replace(' ','-',$request->post_title_bn),
            'post_description_en' => $request->post_description_en,
            'post_description_bn' => $request->post_description_bn,
            'post_image' => $Img_url,
            'created_at' => Carbon::now()
        ]);
        $notification=array(
            'message'=>'Post Upload Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('manage-post')->with($notification);
    }

    // ========================================== Manage all Post ==================================== 
    public function ManageAllPost(){
        $posts = Blog::latest()->get();
        return view('admin.blog.post.index',compact('posts'));
    }


    // ========================================= view post ================================ 
    public function ViewPost($blog_id,$slug){
        $blog = Blog::find($blog_id);
       return view('admin.blog.post.view',compact('blog'));
    }
    // ========================================= edit post ================================ 
    public function EditPost($blog_id,$slug){
        $blog = Blog::find($blog_id);
        $categories = Post_category::where('status',1)->orderBy('category_name_en','ASC')->get();
        $subcategories = Post_subcategory::where('status',1)->orderBy('subcategory_name_en','ASC')->get();
       return view('admin.blog.post.edit',compact('blog','categories','subcategories'));
    }

    // ======================== Update post ===================== 
    public function UpdatePost(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'post_title_en' => 'required',
            'post_title_bn' => 'required',
            'post_description_en' => 'required',
            'post_description_bn' => 'required',
        ],[
            'category_id.required' => 'select category',
            'subcategory_id.required' => 'select subcategory',
            'post_title_en.required' => 'write english post title',
            'post_title_bn.required' => 'write bangla post title',
            'post_description_en.required' => 'write post description in english',
            'post_description_bn.required' => 'write post description in bangla',
        ]);


        
            $Image = $request->file('post_image');
            $old_img = $request->old_image;
            $blog_id = $request->id;

            if ($Image) {
                    $request->validate([
                        'post_image' => 'mimes:jpg,png,jpeg,'
                    ]);
                    unlink($old_img);
                    $Image_name = hexdec(uniqid()).'.'.$Image->getClientOriginalExtension();
                    Image::make($Image)->resize(780,433)->save('media/post/'.$Image_name);
                    $Img_url = 'media/post/'.$Image_name;
                
                Blog::find($blog_id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->subcategory_id,
                    'post_title_en' => $request->post_title_en,
                    'post_title_bn' => $request->post_title_bn,
                    'post_slug_en' => strtolower(str_replace(' ','-',$request->post_title_en)),
                    'post_slug_bn' => str_replace(' ','-',$request->post_title_bn),
                    'post_description_en' => $request->post_description_en,
                    'post_description_bn' => $request->post_description_bn,
                    'post_image' => $Img_url,
                    'updated_at' => Carbon::now()
                    ]);
                    $notification=array(
                        'message'=>'Post Update Success',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('manage-post')->with($notification);
               
            }else{
                Blog::find($blog_id)->update([
                    'user_id' => Auth::user()->id,
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->subcategory_id,
                    'post_title_en' => $request->post_title_en,
                    'post_title_bn' => $request->post_title_bn,
                    'post_slug_en' => strtolower(str_replace(' ','-',$request->post_title_en)),
                    'post_slug_bn' => str_replace(' ','-',$request->post_title_bn),
                    'post_description_en' => $request->post_description_en,
                    'post_description_bn' => $request->post_description_bn,
                    'updated_at' => Carbon::now()
                    ]);
                    $notification=array(
                        'message'=>'Post Update Success',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('manage-post')->with($notification);
            }
  
    }

    // ======================================= Delete post ===================================== 
        public function DeletePost($blog_id){
            $blog = Blog::find($blog_id);
            $old_img = $blog->post_image;
            unlink($old_img);
            $delete = BLog::find($blog_id)->delete();
            if($delete){
                $notification=array(
                    'message'=>'Post Deleted Success',
                    'alert-type'=>'success'
                );
                return Redirect()->route('manage-post')->with($notification);
            }
        }

    // ====================== Inactive blog post ================== 
    public function InactivePost($blog_id){

        Blog::find($blog_id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'Post Inactive',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== active blogs post ================== 
    public function ActivePost($blog_id){

        Blog::find($blog_id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'Post Activated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== comment section ======================= 
    public function Comment(){

        $comments = Blogcomment::latest()->get();
        return view('admin.blog.comment.index',compact('comments'));
    }

    // ------------------------ view comment ------------------ 
    public function ViewComment($id){
        
        $comment = Blogcomment::findOrFail($id);
        return view('admin.blog.comment.view',compact('comment'));
    }
    // ---------------------------- delete comment ------------------- 
    public function deleteComment($id){
        $delete = Blogcomment::findOrFail($id)->delete();
        if($delete){
            $notification=array(
                'message'=>'Post Deleted Success',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

}
