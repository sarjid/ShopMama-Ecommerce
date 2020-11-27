<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Division;
use App\District;
use App\State;
use Carbon\Carbon;
class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function divPage(){
        $divisions = Division::latest()->get();
        return view('admin.shipping-Address.division.add',compact('divisions'));
    }

// -------------------------------- store divison ---------------------- 
    public function divStore(Request $request){
        $request->validate([
            'division_name' => 'required|unique:divisions,division_name',
        ]);
        Division::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now()
        ]);
        $notification=array(
            'message'=>'Division Added',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // --------------------- edit data ================== 
    public function divEdit($id){
        $division = Division::findOrFail($id);
        return view('admin.shipping-Address.division.edit',compact('division'));

    }

    // ------------------ update data ------------------- 
     public function divUpdate(Request $request,$id){
        
        $check = Division::find($id);
        $db_name = $check->division_name;

        if ($db_name === $request->division_name) {
            Division::find($id)->update([
                'division_name' => $request->division_name,
                'coupon_validity' => $request->coupon_validity,
                'updated_at' => Carbon::now()
            ]);

            $notification=array(
                'message'=>'Division Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('add-division')->with($notification);
           
        }else{
            $request->validate([
                'division_name' => 'unique:divisions,division_name',             
            ]);
            Division::find($id)->update([
                'division_name' => $request->division_name,
                'coupon_validity' => $request->coupon_validity,
                'updated_at' => Carbon::now()
            ]);

            $notification=array(
                'message'=>'Division Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('add-division')->with($notification);
         }
    }
    // --------------------- Delete data ================== 
    public function divDelete($id){
        Division::find($id)->delete();
        District::where('division_id',$id)->delete();
        State::where('division_id',$id)->delete();
            $notification=array(
                'message'=>'District Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->route('coupon.page')->with($notification);
      
    }

    // =============================== district section --------------------- 
    public function disPage(){
        $divisions = Division::latest()->get();
        $districts = District::latest()->get();
        return view('admin.shipping-Address.district.add',compact('divisions','districts'));
    }

    
    // -------------------------------- store divison ---------------------- 
    public function disStore(Request $request){
        $request->validate([
            'district_name' => 'required|unique:districts,district_name',
            'division_id' => 'required|',
        ],[
            'division_id' => 'plase select division',
        ]);
        District::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now()
        ]);
        $notification=array(
            'message'=>'District Added',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    // =============== district name -=====================
    public function disEdit($id){
        $district = District::findOrFail($id);
        $divisions = Division::latest()->get();
        return view('admin.shipping-Address.district.edit',compact('district','divisions'));

    }

    
    // -------------------------------- store divison ---------------------- 
    public function disUpdate(Request $request,$id){
        $request->validate([
            'division_id' => 'required',
        ],[
            'division_id.required' => 'plase select division',
        ]);
        $check = District::find($id);
        $db_name = $check->district_name;
            if ($db_name === $request->district_name) {
                District::findOrFail($id)->update([
                    'division_id' => $request->division_id,
                    'district_name' => $request->district_name,
                    'created_at' => Carbon::now()
                ]);
                $notification=array(
                    'message'=>'Data Update Success',
                    'alert-type'=>'success'
                );
                return Redirect()->route('add-district')->with($notification);
        }else{
            $request->validate([
                'district_name' => 'required|unique:districts,district_name',
            ]);
            District::findOrFail($id)->update([
                'division_id' => $request->division_id,
                'district_name' => $request->district_name,
                'created_at' => Carbon::now()
            ]);
            $notification=array(
                'message'=>'Data Update Success',
                'alert-type'=>'success'
            );
            return Redirect()->route('add-district')->with($notification);
        }
    }
    // --------------------- Delete district data ================== 
    public function disDelete($id){
        District::find($id)->delete();
        State::where('district_id',$id)->delete();
            $notification=array(
                'message'=>'Delete Success',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
    
    }

    // =================================== State Section ============================== 
    public function statePage(){
        $divisions = Division::latest()->get();
        $states = State::latest()->get();
        return view('admin.shipping-Address.state.add',compact('divisions','states'));
    }

    // get district ajax 
    public function getDisAjax($id){
        $district = District::where('division_id',$id)->orderBy('district_name','ASC')->get();
        return json_encode($district);
    }

    // ---------------------- store state --------------------- 
    public function stateStore(Request $request){
        $request->validate([
            'state_name' => 'required|unique:states,state_name',
            'division_id' => 'required|',
            'district_id' => 'required|',
        ],[
            'division_id.required' => 'plase select division',
            'district_id.required' => 'plase select district',
        ]);
        State::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now()
        ]);
        $notification=array(
            'message'=>'State Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
 
    // ------------------------- state edit -----------------------
    public function stateEdit($id){
        $divisions = Division::latest()->get();
        $districts = Division::latest()->get();
        $state = State::findOrFail($id);
        return view('admin.shipping-Address.state.edit',compact('divisions','state','districts'));
    }


    public function stateUpdate(Request $request,$id){
        State::findOrFail($id)->update([
            'state_name' => $request->state_name,
            'created_at' => Carbon::now()
        ]);
        $notification=array(
            'message'=>'State Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('add-state')->with($notification);
    }

    // -------------------- delete state ---------------- 
    public function stateDelete($id){
        State::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
}
