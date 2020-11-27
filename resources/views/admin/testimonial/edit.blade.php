@extends('admin.admin_layouts.admin_master')
@section('testimonial') @endsection
@section('admin_title') Edit-testimonial @endsection
@section('admin_content')

   <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">testimonial</span>
          <span class="breadcrumb-item active">Edit</span>
        </nav>

        <div class="sl-pagebody">
          <div class="card pd-20 pd-sm-40">
         
            <form action="{{ route('testimonial.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $testimonial->id }}">
              <input type="hidden" name="old_image" value="{{ $testimonial->image }}">
          <div class="row row-sm">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1"> Old Image <span class="text-danger"></span></label>
                    <img src="{{ asset($testimonial->image) }}" height="100px;" width="100px;" alt="">
                  </div>
              </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Client Name <span class="text-danger"></span></label>
                        <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $testimonial->client_name }}" data-validation="required">
                        @error('client_name')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                      </div>
                  </div> 
                  
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Client Review <span class="text-danger"></span></label>
                         <textarea name="review" id="exampleInputEmail1" cols="30" rows="5" class="form-control @error('review') is-invalid @enderror" placeholder="client review" data-validation="required">{{ $testimonial->review }}</textarea>
                        @error('review')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  onchange="readURL(this);" data-validation="required" >
                        <img src="#" id="one" >
                        @error('image')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                  </div>
  
                <div class="form-layout-footer mt-4">
                <button  class="btn btn-info " type="submit" style="cursor: pointer;">Update</button>
              </div><!-- form-layout-footer -->
            </form>
          </div>
          </div>
          </div><!-- row -->         
        </div><!-- sl-pagebody -->       
      </div><!-- sl-mainpanel -->  
      
      
@endsection

