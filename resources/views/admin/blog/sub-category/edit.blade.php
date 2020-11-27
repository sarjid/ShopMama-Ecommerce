@extends('admin.admin_layouts.admin_master')
@section('blogs') active show-sub @endsection
@section('add-sub-category') active @endsection
@section('admin_title') Blogs Edit-Sub-Category @endsection
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
                        <h5 class="text-danger text-center">Edit Sub-Category</h5>
                        <hr>
                          <form action="{{ url('admin/blogs-sub-category-update/'.$subcategories->id)}}" method="POST" >
                              @csrf
                      
                              <div class="form-group">
                                <label for="exampleInputEmail1">Select Category:<span class="text-danger">*</span></label>
                                <select name="category_id" id="exampleInputEmail1" class="form-control  @error('category_id') is-invalid @enderror">
                                  @forelse ($categories as $row)                                    
                                  <option value="{{ $row->id }}" {{ $row->id == $subcategories->category_id ? "selected":'' }} >{{ $row->category_name_en }}</option>
                                  @empty 
                                  <option>No Category Found</option>
                                  @endforelse
                                </select>
      
                                @error('category_id')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>   

                              <div class="form-group">
                                <label for="exampleInputEmail1">Sub-Category English: <span class="text-danger">*</span></label>
                                <input type="text" name="subcategory_name_en" class="form-control @error('subcategory_name_en') is-invalid @enderror" id="exampleInputEmail1" value="{{ $subcategories->subcategory_name_en }}" aria-describedby="emailHelp">
      
                                @error('subcategory_name_en')
                              <strong class="text-danger">{{$message}}</strong>
                               @enderror
      
                              </div>  
                              
                              <div class="form-group">
                                <label for="exampleInputEmail1">Sub-Category Bangla: <span class="text-danger">*</span></label>
                                <input type="text" name="subcategory_name_bn" class="form-control @error('subcategory_name_bn') is-invalid @enderror" id="exampleInputEmail1" value="{{ $subcategories->subcategory_name_bn }}" aria-describedby="emailHelp">
      
                                @error('subcategory_name_bn')
                              <strong class="text-danger">{{$message}}</strong>
                               @enderror
      
                              </div>   

                              <button type="submit" class="btn btn-primary">Update</button>
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

