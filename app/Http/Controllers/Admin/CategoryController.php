<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
use App\Subcategory;
use App\Subsubcategory;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // =================== index page ============== 
    public function Catindex(){
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }
    // ================== store category ==========================
    public function StoreCategory(Request $request){
        $request->validate([
            'category_name_en' => 'required|unique:categories,category_name_en',
            'category_name_bn' => 'required|unique:categories,category_name_bn',
            'category_icon' => 'required'
        ],[
            'category_name_en.required' => 'input Category name in english',
            'category_name_en.unique' => 'The English category name has already been taken.',
            'category_name_bn.required' => 'input Category name in english',
            'category_name_bn.unique' => 'আপনার ক্যাটেগরির নামটি ইতিমধ্যে রয়েছে',
            'category_icon.required' => 'input fontawesome icon class',
        ]);

       
       $insert = Category::insert([
        'category_name_en' => $request->category_name_en,
        'category_name_bn' => $request->category_name_bn,
        'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
        'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
        'category_icon' => $request->category_icon,
        'created_at' => Carbon::now()
       ]);
        $notification=array(
            'message'=>'Category insert Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

      // ============================= edit category ===================== 
      public function EditCat($cat_id){
        
        $categories = Category::find($cat_id);
        return view('admin.category.edit',compact('categories'));
     }

      // ============================= Update category ===================== 
     public function UpdateCat(Request $request,$cat_id){
        
        Category::find($cat_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_bn' => $request->category_name_bn,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_bn' => str_replace(' ','-',$request->category_name_bn),
            'category_icon' => $request->category_icon,
            'updated_at' => Carbon::now()
       ]);
        $notification=array(
            'message'=>'Category Updated',
            'alert-type'=>'success'
        );
        return Redirect()->route('category.page')->with($notification);

     }

    //================================ Delete Category =========================== 
    public function DeleteCat($cat_id){
        Category::find($cat_id)->delete();
        Subcategory::where('category_id',$cat_id)->delete();
        Subsubcategory::where('category_id',$cat_id)->delete();
        $notification=array(
            'message'=>'Category Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->route('category.page')->with($notification);

     }

      // ====================== Inactive Categories ================== 
    public function Inactive($cat_id){

        Category::find($cat_id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'Category Inactive',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== active categories ================== 
    public function Active($cat_id){

        Category::find($cat_id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'Category Activated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    // ================================== sub Category ========================= 
        // subcategory index 
        public function SubCatindex(){
            $categories = Category::where('status',1)->orderBy('category_name_en','ASC')->get();
            $subcategories = Subcategory::latest()->get();
            return view('admin.category.subcategory.index',compact('categories','subcategories'));
        }

        // store sub category 
        public function StoreSubCategory(Request $request){
            $request->validate([
                'category_id' => 'required',
                'subcategory_name_en' => 'required',
                'subcategory_name_bn' => 'required',
            ],[
                'category_id.required' => 'Select Category name',
                'subcategory_name_en.required' => 'input sub category name in english',
                'subcategory_name_bn.required' => 'input sub category name in bangla',
            ]);
                
           
           $insert = Subcategory::insert([
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

        // ======================= edit subcategory ========================= 
        public function EditSubCat($subcat_id){
            $subcategories = Subcategory::find($subcat_id);
            $categories = Category::where('status',1)->orderBy('category_name_en','ASC')->get();
            return view('admin.category.subcategory.edit',compact('subcategories','categories'));

        }

        // =============================== update subcategory ============================== 
        public function UpdateSubCat(Request $request,$subcat_id){            
           
           $update = Subcategory::find($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_bn' => $request->subcategory_name_bn,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_bn' => str_replace(' ','-',$request->subcategory_name_bn),
            'updated_at' => Carbon::now()
           ]);
           if ($update) {
            $notification=array(
                'message'=>'Sub Category Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('subcategory.page')->with($notification);

           }

        }
        
     //  ================================ Delete Sub Category =========================== 
            public function DeleteSubCat($subcat_id){
                Subcategory::find($subcat_id)->delete();
                Subsubcategory::where('subcategory_id',$subcat_id)->delete();
                $notification=array(
                    'message'=>'SubCategory Deleted',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);

            }


         // ====================== Inactive Sub Categories ================== 
    public function InactiveSubcat($subcat_id){

        Subcategory::find($subcat_id)->update([
            'status' => 0
        ]);
        $notification=array(
            'message'=>'Sub-Category Inactive',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
    }

    // ====================== active sub categories ================== 
    public function ActiveSubcat($subcat_id){

        Subcategory::find($subcat_id)->update([
            'status' => 1
        ]);
        $notification=array(
            'message'=>'Sub-Category Activated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }


     // ================================== sub-sub-Category ========================= 
        // subcategory index 
        public function SubSubCatindex(){
            $categories = Category::where('status',1)->orderBy('category_name_en','ASC')->get();
            $subsubcategories = Subsubcategory::latest()->get();
            return view('admin.category.sub_sub_category.index',compact('categories','subsubcategories'));
        }

        // store sub-sub-category 
        public function StoreSubSubCategory(Request $request){
            $request->validate([
                'subcategory_id' => 'required',
                'subsubcategory_name_en' => 'required|unique:subsubcategories,subsubcategory_name_en',
                'subsubcategory_name_bn' => 'required||unique:subsubcategories,subsubcategory_name_bn',
            ],[
                'subcategory_id.required' => 'Select sub-Category name',
                'subsubcategory_name_en.required' => 'input sub-sub-category name in english',
                'subsubcategory_name_en.unique' => 'The sub-sub-category name has already been taken.',
                'subsubcategory_name_en.unique' => 'আপনার সাব-সাব-ক্যাটেগরির নামটি ইতিমধ্যে রয়েছে',
                'subsubcategory_name_bn.required' => 'input sub-sub-category name in bangla',
            ]);
                
           
           $insert = Subsubcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_bn' => str_replace(' ','-',$request->subsubcategory_name_bn),
            'created_at' => Carbon::now()
           ]);
           if ($insert) {
            $notification=array(
                'message'=>'Sub-Sub-Category insert Success',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

           }
           
        }

         // ======================= edit sub-sub-category ========================= 
         public function EditSubSubCat($subsubcat_id){
            $subsubcategories = Subsubcategory::find($subsubcat_id);
            $subcategories = Subcategory::where('status',1)->orderBy('subcategory_name_en','ASC')->get();
          ;
            return view('admin.category.sub_sub_category.edit',compact('subsubcategories','subcategories'));

        }

        // ================================ update sub-sub-category ================================ 
        public function UpdateSubSubCat(Request $request,$subsubcat_id){

            $db_data = Subsubcategory::find($subsubcat_id);
            $db_en_check = $db_data->subsubcategory_name_en;
            if ($request->subsubcategory_name_en === $db_en_check ) {
                $update = Subsubcategory::find($subsubcat_id)->update([
                    'subcategory_id' => $request->subcategory_id,
                    'subsubcategory_name_en' => $request->subsubcategory_name_en,
                    'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
                    'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
                    'subsubcategory_slug_bn' => str_replace(' ','-',$request->subsubcategory_name_bn),
                    'created_at' => Carbon::now()
                   ]);
                   if ($update) {
                    $notification=array(
                        'message'=>'Sub-Sub-Category Updated',
                        'alert-type'=>'success'
                    );
                    return Redirect()->route('sub-sub-category.page')->with($notification);
        
                   }
            }else{
                $request->validate([
                    'subsubcategory_name_en' => 'unique:subsubcategories,subsubcategory_name_en',
                    'subsubcategory_name_bn' => 'unique:subsubcategories,subsubcategory_name_bn',
                ],[
                   
                    'subsubcategory_name_en.unique' => 'The sub-sub-category name has already been taken.',
                    'subsubcategory_name_bn.unique' => 'আপনার সাব-সাব-ক্যাটেগরির নামটি ইতিমধ্যে রয়েছে',
                    
                ]);

            }      
           
           
        }

        //  ================================ Delete Sub-sub-Category =========================== 
        public function DeleteSubSubCat($subsubcat_id){
            Subsubcategory::find($subsubcat_id)->delete();
            $notification=array(
                'message'=>'Sub-sub-Category Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }

                 // ====================== Inactive Sub Categories ================== 
            public function InactiveSubSubcat($subsubcat_id){

                Subsubcategory::find($subsubcat_id)->update([
                    'status' => 0
                ]);
                $notification=array(
                    'message'=>'Sub-Sub-Category Inactive',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }

            // ====================== active sub categories ================== 
            public function ActiveSubSubcat($subsubcat_id){

                Subsubcategory::find($subsubcat_id)->update([
                    'status' => 1
                ]);
                $notification=array(
                    'message'=>'Sub-Sub-Category Activated',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
            }

    // get subcategory name with ajax 
    public function GetSubCatajax($cat_id){   
        $subcat = Subcategory::where('category_id',$cat_id)->where('status',1)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }


    
}
