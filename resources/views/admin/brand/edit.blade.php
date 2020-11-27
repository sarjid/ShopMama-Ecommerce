@extends('admin.admin_layouts.admin_master')
@section('brands') active @endsection
@section('admin_title') Edit Brands @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Brands</span>
          <span class="breadcrumb-item active">Edit Brands</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                    
                <div class="col-md-8 m-auto">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">Brand Update</h5>
                        <hr>
                          <form action="{{ route('update.brand') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" value="{{ $brands->brand_image }}" name="old_image">
                              <input type="hidden" value="{{ $brands->id }}" name="id">
                              <input type="hidden" value="{{ $brands->brand_slug }}" name="old_slug">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name English:<span class="text-danger">*</span></label>
                                <input type="text" name="brand_name_en" class="form-control @error('brand_name_en') is-invalid @enderror" id="exampleInputEmail1" value="{{ $brands->brand_name_en }}" aria-describedby="emailHelp" placeholder="Brand Name">
      
                                @error('brand_name_en')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name Bangla:<span class="text-danger">*</span></label>
                                <input type="text" name="brand_name_bn" class="form-control @error('brand_name_bn') is-invalid @enderror" id="exampleInputEmail1" value="{{ $brands->brand_name_bn }}" aria-describedby="emailHelp" placeholder="Brand Name">
      
                                @error('brand_name_bn')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Old Image </label>                             
                                <img src="{{ asset($brands->brand_image) }}" alt="" height="55px;" width="83px;">
                                </div>

                                <div class="form-group">
                                  <label for="exampleInputEmail1">Change Image: <span class="text-danger">*</span></label>
                                  <input type="file" name="brand_image" class="form-control @error('brand_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                  
                                  @error('brand_image')
                                <strong class="text-danger">{{$message}}</strong>
                                  @enderror
                                  
                                 
      
                                </div>
          
      
                              <button type="submit" class="btn btn-primary">Add Brand</button>
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

