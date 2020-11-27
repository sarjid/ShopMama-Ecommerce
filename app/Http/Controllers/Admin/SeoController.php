<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seo;
use Illuminate\Http\Request;
use Carbon\Carbon;
class SeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        
        $seo = Seo::findOrFail(1);
        return view('admin.setting.seo',compact('seo'));
    }

    // -------------------- update settings -------------- 
    public function update(Request $request){
        Seo::findOrFail(1)->update([
            'meta_author' => $request->meta_author,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'updated_at' => Carbon::now()
        ]);

        $notification=array(
            'message'=>'Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
