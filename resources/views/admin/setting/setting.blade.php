@extends('admin.admin_layouts.admin_master')
@section('settings') active show-sub @endsection
@section('site-setting') active @endsection
@section('admin_title') site-setting @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">site-setting</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
              <h6 class="card-body-title">Update Seo Setting</h6>
              <form action="{{ route('setting-update') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row row-sm">
                       <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Logo: <span class="text-danger">*</span></label>
                                <img src="{{ asset($setting->logo) }}" alt="" style="background: black;">
                              </div>
                        </div> 
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Change Logo: <span class="text-danger">*</span></label>
                                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
  
                                @error('logo')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email: <span class="text-danger">*</span></label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" value="{{ $setting->email }}" aria-describedby="emailHelp" placeholder="email">
  
                                @error('email')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div> 
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address: <span class="text-danger">*</span></label>
                               <textarea name="address" id="exampleInputEmail1" class="form-control" cols="30" rows="3">{{ $setting->address }}</textarea>
                                @error('address')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone 1: <span class="text-danger">*</span></label>
                                <input type="text" name="phone_no_one" class="form-control @error('phone_no_one') is-invalid @enderror" id="exampleInputEmail1" value="{{ $setting->phone_no_one }}" aria-describedby="emailHelp" placeholder="phone_no_one">
  
                                @error('phone_no_one')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone 2: <span class="text-danger">*</span></label>
                                <input type="text" name="phone_no_two" class="form-control @error('phone_no_two') is-invalid @enderror" id="exampleInputEmail1" value="{{ $setting->phone_no_two }}" aria-describedby="emailHelp" placeholder="phone_no_two">
                                @error('phone_no_two')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook Link: <span class="text-danger">*</span></label>
                                <input type="text" name="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" id="exampleInputEmail1" value="{{ $setting->facebook_link }}" aria-describedby="emailHelp" placeholder="facebook_link">
                                @error('facebook_link')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Twitter Link: <span class="text-danger">*</span></label>
                                <input type="text" name="twitter_link" class="form-control @error('twitter_link') is-invalid @enderror" id="exampleInputEmail1" value="{{ $setting->twitter_link }}" aria-describedby="emailHelp" placeholder="twitter_link">
                                @error('twitter_link')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">instagram Link: <span class="text-danger">*</span></label>
                                <input type="text" name="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" id="exampleInputEmail1" value="{{ $setting->instagram_link }}" aria-describedby="emailHelp" placeholder="instagram_link">
                                @error('instagram_link')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">linkedin Link: <span class="text-danger">*</span></label>
                                <input type="text" name="linkedin_link" class="form-control @error('linkedin_link') is-invalid @enderror" id="exampleInputEmail1" value="{{ $setting->linkedin_link }}" aria-describedby="emailHelp" placeholder="linkedin_link">
                                @error('linkedin_link')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div> 
              </div>
              
              <div class="form-layout-footer mt-3">
                <button class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Upate Setting</button>
              </div><!-- form-layout-footer -->
            </form>
            </div>
            </div><!-- row -->         
          </div><!-- sl-pagebody -->      
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

