@extends('admin.admin_layouts.admin_master')
@section('categories') active show-sub @endsection
@section('sub_sub_category') active @endsection
@section('admin_title') Sub-Category-Edit @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Edit-Sub-Category</span>
        </nav>
        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">Edit Sub-Sub-Category</h5>
                        <hr>
                          <form action="{{ url('admin/sub-sub-categories-update/'.$subsubcategories->id)}}" method="POST" >
                              @csrf
                      
                              <div class="form-group">
                                <label for="exampleInputEmail1">Select Sub-Category:<span class="text-danger">*</span></label>
                                <select name="subcategory_id" id="exampleInputEmail1" class="form-control  @error('subcategory_id') is-invalid @enderror">
                                  <option>select one</option>
                                  @forelse ($subcategories as $row)                                    
                                  <option value="{{ $row->id }}" {{ $row->id == $subsubcategories->subcategory_id ? "selected":'' }} >{{ $row->subcategory_name_en }}</option>
                                  @empty 
                                  <option>No Category Found</option>
                                  @endforelse
                                </select>
      
                                @error('subcategory_id')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>   

                              <div class="form-group">
                                <label for="exampleInputEmail1">Sub-Sub-Category English: <span class="text-danger">*</span></label>
                                <input type="text" name="subsubcategory_name_en" class="form-control @error('subsubcategory_name_en') is-invalid @enderror" id="exampleInputEmail1" value="{{ $subsubcategories->subsubcategory_name_en }}" aria-describedby="emailHelp">
      
                                @error('subsubcategory_name_en')
                              <strong class="text-danger">{{$message}}</strong>
                               @enderror
      
                              </div>   

                              <div class="form-group">
                                <label for="exampleInputEmail1">Sub-Sub-Category Bangla: <span class="text-danger">*</span></label>
                                <input type="text" name="subsubcategory_name_bn" class="form-control @error('subsubcategory_name_bn') is-invalid @enderror" id="exampleInputEmail1" value="{{ $subsubcategories->subsubcategory_name_bn }}" aria-describedby="emailHelp">
      
                                @error('subsubcategory_name_bn')
                              <strong class="text-danger">{{$message}}</strong>
                               @enderror
      
                              </div>   

                              <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
    
      
      
                      </div>
                  </div>
              </div>
        
            </div>
          </div><!-- row -->

          
        </div><!-- sl-pagebody -->
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

