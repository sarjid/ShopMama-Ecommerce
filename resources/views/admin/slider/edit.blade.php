@extends('admin.admin_layouts.admin_master')
@section('slider') active @endsection
@section('admin_title') edit slider @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">slider</span>
          <span class="breadcrumb-item active">Edit slider</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                    
                <div class="col-md-8 m-auto">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">slider Update</h5>
                        <hr>
                          <form action="{{ route('update.slider') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" value="{{ $slider->image }}" name="old_image">
                              <input type="hidden" value="{{ $slider->id }}" name="slider_id">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Slider Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" value="{{ $slider->title }}" aria-describedby="emailHelp" >
      
                                @error('title')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Slider Description <span class="text-danger"></span></label>
                                 <textarea name="description" id="exampleInputEmail1" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="slider short text">{{ $slider->description }}</textarea>
                                @error('description')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Old Image </label>                             
                                <img src="{{ asset($slider->image) }}" alt="" style="width: 215px; height:74px;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  onchange="readURLslider(this);"  >
                                    <small class="text-danger">size must be 870 370 px</small> <br>
                                    <img src="#" id="slider_image" >
                                    @error('image')
                                  <strong class="text-danger">{{$message}}</strong>
                                    @enderror
        
                                  </div>
          
      
                              <button type="submit" class="btn btn-primary">Update slider</button>
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

