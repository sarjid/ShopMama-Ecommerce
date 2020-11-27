@extends('admin.admin_layouts.admin_master')
@section('settings') active show-sub @endsection
@section('seo-setting') active @endsection
@section('admin_title') seo @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">seo-setting</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
              <h6 class="card-body-title">Update Seo Setting</h6>
              <form action="{{ route('seo-update') }}" method="POST">
                @csrf
            <div class="row row-sm">
                       <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta Author Name: <span class="text-danger">*</span></label>
                                <input type="text" name="meta_author" class="form-control @error('meta_author') is-invalid @enderror" id="exampleInputEmail1" value="{{ $seo->meta_author }}" aria-describedby="emailHelp" placeholder="meta_author">
  
                                @error('meta_author')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
                              </div>
                        </div>    
                        
                        <div class="col-md-8">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Meta Keywords: <span class="text-danger">*</span></label>
                              <input type="text" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" id="exampleInputEmail1" value="{{ $seo->meta_keywords }}"  aria-describedby="emailHelp" data-role="tagsinput">
                              <small class="text-danger">use comma (,) separate two Keywords</small> <br>
                              @error('meta_keywords')
                            <strong class="text-danger">{{$message}}</strong>
                              @enderror
                            </div>
                      </div> 
  
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Meta Description : <span class="text-danger">*</span></label>
                              <textarea name="meta_description" id="summernote" >{{ $seo->meta_description }}</textarea>
                              @error('meta_description')
                               <strong class="text-danger">{{$message}}</strong>
                              @enderror
                            </div>
                      </div>    
                   
              </div>
              
              <div class="form-layout-footer mt-3">
                <button class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Upate Seo</button>
              </div><!-- form-layout-footer -->
            </form>
            </div>
            </div><!-- row -->         
          </div><!-- sl-pagebody -->      
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

