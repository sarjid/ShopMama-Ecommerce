@extends('admin.admin_layouts.admin_master')
@section('blogs') active show-sub @endsection
@section('manage-post') active @endsection
@section('admin_title') View-Post @endsection
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
            <h6 class="card-body-title">Post view <a href="{{ route('manage-post') }}" class="btn btn-success btn-sm pull-right">Back</a></h6>
          <div class="row row-sm">
            
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Category: <span class="text-danger">*</span></label>
                      <input type="text" name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="exampleInputEmail1" readonly value="{{ $blog->post_category->category_name_en }}" aria-describedby="emailHelp" >
                      @error('category_id')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror
  
                    </div>
                </div> 

              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Sub-Category: <span class="text-danger">*</span></label>
                    <input type="text" name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" readonly id="exampleInputEmail1" value="{{ $blog->post_subcategory->subcategory_name_en }}" aria-describedby="emailHelp" placeholder="category Name English">
                    @error('subcategory_id')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
                </div>   
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Post Title English: <span class="text-danger">*</span></label>
                        <textarea name="post_title_en" readonly id="exampleInputEmail1" cols="60" rows="5">{{ $blog->post_title_en }}</textarea>
                        <br>
                        @error('post_title_en')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div>  
               
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Post Title Bangla: <span class="text-danger">*</span></label>
                      <textarea name="post_title_bn" readonly id="exampleInputEmail1" cols="60" rows="5">{{ $blog->post_title_bn }}</textarea>
                      <br>
                      @error('post_title_bn')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror

                    </div>
              </div>  

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Post Description English: <span class="text-danger">*</span></label>
                        <textarea name="post_description_en" readonly  id="summernote" >{{ $blog->post_description_en }}</textarea>
                        @error('post_description_en')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div> 
                
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Post Description Bangla: <span class="text-danger">*</span></label>
                      <textarea name="post_description_bn" readonly id="summernote2">{{ $blog->post_description_bn }}</textarea>
                      @error('post_description_bn')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror

                    </div>
              </div>  

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Old Image: <span class="text-danger">*</span></label>
                      <img src="{{ asset($blog->post_image) }}" height="88px;" width="158px;" alt="">

                      </div>
                </div> 
                          
            </div>
    
          </div>
          </div><!-- row -->         
        </div><!-- sl-pagebody -->       
      </div><!-- sl-mainpanel -->    
      {{-- <script src="{{asset('backend')}}/lib/jquery.min.js">
      </script> --}}
<script src="{{asset('backend')}}/lib/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
      
<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "{{  url('/get/post/subcategory/') }}/"+category_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                   var d =$('select[name="subcategory_id"]').empty();
                      $.each(data, function(key, value){

                          $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');

                      });

                },

            });
        } else {
            alert('danger');
        }

    });
   
});

</script>
     
@endsection

