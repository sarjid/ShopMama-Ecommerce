@extends('admin.admin_layouts.admin_master')
@section('products') active show-sub @endsection
@section('manage-products') active @endsection
@section('admin_title') Edit-Products @endsection
@section('admin_content')


   <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Products</span>
          <span class="breadcrumb-item active">Edit</span>
        </nav>

        <div class="sl-pagebody">
          <div class="card pd-20 pd-sm-40">
         
            <form action="{{ url('admin/products-update-without-image/'.$products->id) }}" method="POST" >
              @csrf
          <div class="row row-sm">
                  <div class="col-md-4">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Product Name English: <span class="text-danger">*</span></label>
                              <input type="text" name="product_name_en" class="form-control @error('product_name_en') is-invalid @enderror"  id="exampleInputEmail1"  aria-describedby="emailHelp" value="{{ $products->product_name_en }}">

                              @error('product_name_en')
                            <strong class="text-danger">{{$message}}</strong>
                              @enderror
                            </div>
                  </div>  

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name Bangla: <span class="text-danger">*</span></label>
                      <input type="text" name="product_name_bn" class="form-control @error('product_name_bn') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->product_name_bn }}" aria-describedby="emailHelp" placeholder="product name Bangla">

                      @error('product_name_bn')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror
                    </div>
                  </div>  
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Code: <span class="text-danger">*</span></label>
                        <input type="text" name="product_code" class="form-control @error('product_code') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->product_code }}" aria-describedby="emailHelp" placeholder="product code">

                        @error('product_code')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div> 

                
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Product Size English: <span class="text-danger">*</span></label>
                      <input type="text" name="product_size_en" class="form-control @error('product_size_en') is-invalid @enderror" id="exampleInputEmail1" data-role="tagsinput"  value="{{ $products->product_size_en }}" aria-describedby="emailHelp" >

                      @error('product_size_en')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror

                    </div>
              </div> 

              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1 text-black">Product Size Bangla: <span class="text-danger">*</span></label>
                    <input type="text" name="product_size_bn" class="form-control @error('product_size_bn') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->product_size_bn }}" aria-describedby="emailHelp" data-role="tagsinput" >

                    @error('product_size_bn')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
            </div> 


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Color English: <span class="text-danger">*</span></label>
                        <input type="text" name="product_color_en"  id="color" class="form-control @error('product_color_en') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->product_color_en }}" data-role="tagsinput" aria-describedby="emailHelp">

                        @error('product_color_en')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div> 
                
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Product Color Bangla: <span class="text-danger">*</span></label>
                      <input type="text"  name="product_color_bn" class="form-control @error('product_color_bn') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->product_color_bn }}" aria-describedby="emailHelp" data-role="tagsinput">

                      @error('product_color_bn')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror

                    </div>
              </div>  
              
              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Video Link: <span class="text-danger">*</span></label>
                    <input type="text" name="video_link" class="form-control @error('video_link') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->video_link }}" aria-describedby="emailHelp" placeholder="video link">
  
                     @error('video_link')
                      <strong class="text-danger">{{$message}}</strong>
                     @enderror
  
                  </div>
             </div> 

              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand: <span class="text-danger">*</span></label>
                    <select name="brand_id" id="exampleInputEmail1" class="form-control" >
                        @foreach ($brands as $row)                          
                        <option value="{{ $row->id }}" {{ $row->id == $products->brand_id ? "selected":'' }}>{{ $row->brand_name_en }}</option>
                        @endforeach                       
                      </select>
                          @error('brand_id')
                        <strong class="text-danger">{{$message}}</strong>
                          @enderror
  
                  </div>
                  
              </div>  

                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Category: <span class="text-danger">*</span></label>
                      <select name="category_id" id="exampleInputEmail1" class="form-control" >
                        @foreach ($categories as $row)
                        <option value="{{ $row->id }}" {{ $row->id == $products->category_id ? "selected":'' }}>{{ $row->category_name_en }}</option>                            
                        @endforeach
                      </select>
                      @error('category_id')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror
  
                    </div>
              </div> 

              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Sub-Category: <span class="text-danger">*</span></label>
                    <select name="subcategory_id" id="exampleInputEmail1" class="form-control" >
                      @foreach ($subcategories as $row)                         
                      <option value="{{ $row->id }}" {{ $row->id == $products->subcategory_id ? "selected":'' }} >{{ $row->subcategory_name_en }}</option>
                      @endforeach
                      </select>
                    @error('subcategory_id')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
              </div> 

            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Sub-Sub-Category: <span class="text-danger">*</span></label>
                  <select name="subsubcategory_id" id="exampleInputEmail1" class="form-control" >
                    @foreach ($subsubcategories as $row)                         
                    <option value="{{ $row->id }}" {{ $row->id == $products->subsubcategory_id ? "selected":'' }} >{{ $row->subsubcategory_name_en }}</option>
                    @endforeach
                  </select>
                  @error('subsubcategory_id')
                <strong class="text-danger">{{$message}}</strong>
                  @enderror

                </div>
           </div> 

           
      

              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Quantity:<span class="text-danger">*</span></label>
                    <input type="number" name="product_quantity" class="form-control @error('product_quantity') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->product_quantity }}" aria-describedby="emailHelp" placeholder="product quantity">

                    @error('product_quantity')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
              </div> 
      

            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Selling Price: <span class="text-danger">*</span></label>
                  <input type="number" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->selling_price }}" aria-describedby="emailHelp" placeholder="selling price">

                  @error('selling_price')
                <strong class="text-danger">{{$message}}</strong>
                  @enderror

                </div>
            </div> 

            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Discount Price: <span class="text-danger">*</span></label>
                  <input type="number" name="discount_price" class="form-control @error('discount_price') is-invalid @enderror" id="exampleInputEmail1" value="{{ $products->discount_price }}" aria-describedby="emailHelp" placeholder="discount price">

                  @if(session('error'))
                  <strong class="text-danger">{{session('error')}}</strong>
                  @endif

                  @error('discount_price')
                <strong class="text-danger">{{$message}}</strong>
                  @enderror

                </div>
            </div> 

               <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">product Weight:</label>
                    <input type="text" name="product_weight" class="form-control @error('product_weight') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $products->product_weight }}" aria-describedby="emailHelp" placeholder="product Weight">

                    @error('product_weight')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
              </div> 

              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Tags English: <span class="text-danger">*</span></label>
                    <input type="text" name="product_tags_en" class="form-control @error('product_tags_en') is-invalid @enderror" id="exampleInputEmail1" value="{{ $products->product_tags_en }}" aria-describedby="emailHelp" data-role="tagsinput">
                    @error('product_tags_en')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror
  
                  </div>
              </div>  

              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Product Tags Bangla: <span class="text-danger">*</span></label>
                    <input type="text" name="product_tags_bn" class="form-control @error('product_tags_bn') is-invalid @enderror" id="exampleInputEmail1" value="{{ $products->product_tags_bn }}" aria-describedby="emailHelp" data-role="tagsinput">
                    @error('product_tags_bn')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror
  
                  </div>
              </div>  

  
          
        
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Short Description English: <span class="text-danger">*</span></label>
                        <textarea name="short_description_en"  id="exampleInputEmail1" cols="60" rows="10">{{ $products->short_description_en }}</textarea>
                        <br>
                        @error('short_description_en')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div>  

                
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Short Description Bangla: <span class="text-danger">*</span></label>
                      <textarea name="short_description_bn"  id="exampleInputEmail1" cols="60" rows="10">{{ $products->short_description_bn }}</textarea>
                      <br>
                      @error('short_description_bn')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror

                    </div>
              </div>  

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Long Description English: <span class="text-danger">*</span></label>
                        <textarea name="long_description_en" id="summernote" >{{ $products->long_description_en }}</textarea>
                       
                      
                        @error('long_description_en')
                      <strong class="text-danger">{{$message}}</strong>
                        @enderror

                      </div>
                </div> 
                
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Long Description Bangla: <span class="text-danger">*</span></label>
                      <textarea name="long_description_bn" id="summernote2">{{ $products->long_description_bn }}</textarea>
                      @error('long_description_bn')
                    <strong class="text-danger">{{$message}}</strong>
                      @enderror

                    </div>
              </div>  

                
                <div class="col-lg-4 mt-5">
                  <label class="ckbox"> 
                    <input type="checkbox" name="main_slider" {{ $products->main_slider == 1 ? "checked":'' }} value="1">
                    <span>Main Slider</span>
                    
                  </label>
                </div>
                
                <div class="col-lg-4 mt-5">
            		<label class="ckbox"> 
                    <input type="checkbox" name="hot_deals" {{ $products->hot_deals == 1 ? "checked":'' }} value="1">
                    <span>Hot Deals</span>
				    </label>
                </div>
                
                <div class="col-lg-4 mt-5">
            		<label class="ckbox"> 
                  <input type="checkbox" name="featured" {{ $products->featured == 1 ? "checked":'' }}  value="1">
                  <span>Featured</span>
                </label>
                </div>
                
                <div class="col-lg-4 mt-5">
            		<label class="ckbox"> 
                  <input type="checkbox" name="special_offer" {{ $products->special_offer == 1 ? "checked":'' }}  value="1">
                  <span>Special Offer</span>
                 
                </label>
                </div>
                
                <div class="col-lg-3 mt-5">
                  <label class="ckbox"> 
                    <input type="checkbox" name="special_deals" {{ $products->special_deals == 1 ? "checked":'' }}  value="1">
                    <span>Special Deals</span>
                  </label>
                  </div>
            </div>
            
            <div class="form-layout-footer mt-3">
              <button  class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Update</button>
            </div><!-- form-layout-footer -->
          </form>

          <form action="{{ url('admin/products-update-with-image/'.$products->id) }}" method="POST" enctype="multipart/form-data">
              @csrf 
              <input type="hidden" name="old_one" value="{{ $products->image_one }}">
              <input type="hidden" name="old_two" value="{{ $products->image_two }}">
              <input type="hidden" name="old_three" value="{{ $products->image_three }}">
          <div class="row row-sm mt-5">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Main Thambnail: <span class="text-danger">*</span></label>
                    <input type="file" name="image_one" class="form-control @error('image_one') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" onchange="readURL(this);" >
                    <img src="#" id="one" >

                    <img src="{{ asset($products->image_one) }}" height="83px;" width="88px;" alt="">

                    @error('image_one')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
            </div> 
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Image Two <span class="text-danger">*</span></label>
                    <input type="file" name="image_two" class="form-control @error('image_two') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('image_two') }}" aria-describedby="emailHelp" placeholder="video link" onchange="readURL1(this);" >
                    <img src="#" id="two" >
                    <img src="{{ asset($products->image_two) }}" height="83px;" width="88px;" alt="">

                    @error('image_two')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
            </div>  

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Image Three: <span class="text-danger">*</span></label>
                    <input type="file" name="image_three" class="form-control @error('image_three') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('image_three') }}" aria-describedby="emailHelp"  onchange="readURL2(this);" >
                    <img src="#" id="three" >
                    <img src="{{ asset($products->image_three) }}" height="83px;" width="88px;" alt="">

                    @error('image_three')
                  <strong class="text-danger">{{$message}}</strong>
                    @enderror

                  </div>
            </div>  
            <div class="form-layout-footer mt-3">
                <button  class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Update Image</button>
              </div><!-- form-layout-footer -->
            </form>
          </div>
          </div>
          </div><!-- row -->         
        </div><!-- sl-pagebody -->       
      </div><!-- sl-mainpanel -->  
      
      
      <script src="{{asset('backend')}}/lib/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
      
<script type="text/javascript">
  $(document).ready(function() {
    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "{{  url('/get/subcategory/') }}/"+category_id,
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
    $('select[name="subcategory_id"]').on('change', function(){
        var subcategory_id = $(this).val();
        if(subcategory_id) {
            $.ajax({
                url: "{{  url('/get/subsubcategory/') }}/"+subcategory_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                   var d =$('select[name="subsubcategory_id"]').empty();
                      $.each(data, function(key, value){

                          $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');

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

