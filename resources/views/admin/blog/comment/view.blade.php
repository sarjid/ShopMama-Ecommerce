@extends('admin.admin_layouts.admin_master')
@section('blogs') active show-sub @endsection
@section('blog-comment') active @endsection
@section('admin_title') View-Comment @endsection
@section('admin_content')
   <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Blogs</span>
          <span class="breadcrumb-item active">View Post</span>
        </nav>

        <div class="sl-pagebody">
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Comment view <a href="{{ route('blog-comment') }}" class="btn btn-success btn-sm pull-right">Back</a></h6>
          <div class="row row-sm">
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Post Image: <span class="text-danger">*</span></label>
                  <img src="{{ asset($comment->blog->post_image) }}" height="88px;" width="158px;" alt="">

                  </div>
            </div> 

                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Post title: <span class="text-danger">*</span></label>
                      <input type="text" name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="exampleInputEmail1" readonly value="{{ $comment->blog->post_title_en }}" aria-describedby="emailHelp" >
                    </div>
                </div> 

              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Visitor Name: <span class="text-danger">*</span></label>
                    <input type="text" name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" readonly id="exampleInputEmail1" value="{{ $comment->name }}" aria-describedby="emailHelp" placeholder="category Name English">
                </div>
             </div>   
             
             <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email: <span class="text-danger">*</span></label>
                    <input type="text" name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" readonly id="exampleInputEmail1" value="{{ $comment->email }}" aria-describedby="emailHelp" placeholder="category Name English">
                </div>
             </div>

             <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title: <span class="text-danger">*</span></label>
                    <input type="text" name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" readonly id="exampleInputEmail1" value="{{ $comment->title }}" aria-describedby="emailHelp" placeholder="category Name English">
                </div>
             </div>

             <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Post Comment: <span class="text-danger">*</span></label>
                    <textarea name="post_title_en" readonly id="exampleInputEmail1" cols="60" rows="5">{{ $comment->comment }}</textarea>
                  </div>
            </div>  
                          
            </div>
    
          </div>
          </div><!-- row -->         
        </div><!-- sl-pagebody -->       
      </div><!-- sl-mainpanel -->    

     
@endsection

