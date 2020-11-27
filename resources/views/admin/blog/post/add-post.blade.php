@extends('admin.admin_layouts.admin_master')
@section('blogs') active show-sub @endsection
@section('add-post') active @endsection
@section('admin_title') Add-Post @endsection
@section('admin_content')


   <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Blogs</span>
          <span class="breadcrumb-item active">Add Post</span>
        </nav>

        <div class="sl-pagebody">
          <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">New Post Add <a href="{{ route('manage-post') }}" class="btn btn-success btn-sm pull-right">All Post</a></h6>
            <form action="{{ route('store-blog-post') }}" method="POST" enctype="multipart/form-data">
              @csrf
          <div class="row row-sm">
            
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Category: <span class="text-danger">*</span></label>
                      <select name="category_id" id="exampleInputEmail1" class="form-control" >
                        <option >choose category</option>
                        @foreach ($categories as $row)
                        <option value="{{ $row->id }}">{{ $row->category_name_en }}</option>                            
                        @endforeach
                      </select>
                      @error('category_id')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror
  
                    </div>
                </div> 

              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Sub-Category: <span class="text-danger">*</span></label>
                    <select name="subcategory_id" id="exampleInputEmail1" class="form-control" >
                      
                    </select>
                    @error('subcategory_id')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
                </div>   
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Post Title English: <span class="text-danger">*</span></label>
                        <textarea name="post_title_en" id="exampleInputEmail1" cols="60" rows="5"></textarea>
                        <br>
                        @error('post_title_en')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div>  
               
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Post Title Bangla: <span class="text-danger">*</span></label>
                      <textarea name="post_title_bn" id="exampleInputEmail1" cols="60" rows="5"></textarea>
                      <br>
                      @error('post_title_bn')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror

                    </div>
              </div>  

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Post Description English: <span class="text-danger">*</span></label>
                        <textarea name="post_description_en" id="summernote" ></textarea>
                        @error('post_description_en')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div> 
                
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Post Description Bangla: <span class="text-danger">*</span></label>
                      <textarea name="post_description_bn" id="summernote2" ></textarea>
                      @error('post_description_bn')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror

                    </div>
              </div>  

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image: <span class="text-danger">*</span></label>
                        <input type="file" name="post_image" class="form-control @error('post_image') is-invalid @enderror" id="exampleInputEmail1"  aria-describedby="emailHelp" onchange="readURLpost(this);" >
                        <img src="#" id="post_img" >
                        @error('post_image')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div> 
                          
            </div>
            
            <div class="form-layout-footer mt-3">
              <button class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Add Post</button>
            </div><!-- form-layout-footer -->
          </form>
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

