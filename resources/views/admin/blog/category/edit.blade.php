@extends('admin.admin_layouts.admin_master')
@section('blogs') active show-sub @endsection
@section('add-category') active @endsection
@section('admin_title') Blog Edit-Category @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Blogs</span>
          <span class="breadcrumb-item active">Edit Category</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
 
                <div class="col-md-8 m-auto">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">Update Blog Category</h5>
                        <hr>
                          <form action="{{ url('admin/blogs-category-update/'.$categories->id)}}" method="POST" >
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Category Name English: <span class="text-danger">*</span></label>
                                <input type="text" name="category_name_en" class="form-control @error('category_name_en') is-invalid @enderror" id="exampleInputEmail1" value="{{ $categories->category_name_en }}" aria-describedby="emailHelp" placeholder="category Name">
      
                                @error('category_name_en')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Category Name Bangla: <span class="text-danger">*</span></label>
                                <input type="text" name="category_name_bn" class="form-control @error('category_name_bn') is-invalid @enderror" id="exampleInputEmail1" value="{{ $categories->category_name_bn }}" aria-describedby="emailHelp" placeholder="category Name">
      
                                @error('category_name_bn')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
          
      
                              <button type="submit" class="btn btn-primary">Update Category</button>
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

