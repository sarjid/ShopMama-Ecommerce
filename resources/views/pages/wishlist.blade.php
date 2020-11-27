@extends('layouts.fontend_master')
@section('title') My Wishlist @endsection
@section('content')
@php
function bn_price($str)
	{
	$en = array(1,2,3,4,5,6,7,8,9,0);
	$bn = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
	$str = str_replace($en, $bn, $str);
	 return $str;
	}
@endphp
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Profile</a></li>
				<li class='active'>Wishlist</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="my-wishlist-page">
			<div class="row">
				<div class="col-md-12 my-wishlist">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="4" class="heading-title">My Wishlist</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($wishlists as $wishlist)
				<tr>
					<td class="col-md-2"><img src="{{ asset($wishlist->product->image_one) }}" alt="imga"></td>
					<td class="col-md-7">
						<div class="product-name"><a href="#">{{ $wishlist->product->product_name_en }}</a></div>
						<div class="price">
                            @if ($wishlist->product->discount_price == NULL)
                            ${{ $wishlist->product->selling_price }}
                             @else 
                            ${{ $wishlist->product->discount_price }}
                             <span >${{ $wishlist->product->selling_price }}</span>
                             @endif
						</div>
					</td>
					<td class="col-md-2">
                        <button  class="btn btn-primary icon product_cart_button "  data-toggle="modal" data-target="#cartmodal{{ $wishlist->product_id }}" title="Add Cart">
                           Add to Cart	
                        </button>
					</td>
					<td class="col-md-1 close-btn">
						<a href="{{ url('wishlist/remove-item/'.$wishlist->id) }}" class=""><i class="fa fa-times"></i></a>
					</td>
                </tr>
                @endforeach		
			</tbody>
		</table>
	</div>
</div>			
</div><!-- /.row -->
</div><!-- /.sigin-in-->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

		<div class="logo-slider-inner">	
			<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
				<div class="item m-t-15">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item m-t-10">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->
		    </div><!-- /.owl-carousel #logo-slider -->
		</div><!-- /.logo-slider-inner -->
    </div><!-- /.logo-slider -->
<!-- =================== BRANDS CAROUSEL : END ============================= -->	
    </div><!-- /.container -->
</div><!-- /.body-content -->
@if (session()->get('language') == 'bangla')
	@foreach ($products as $product)
		<!--Bangla Modal -->
		<div class="modal fade " id="cartmodal{{ $product->id }}" tabindex="-1" >
			<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button"  class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="font-size: 35px; color:red;" >&times;</span>
				</button>
				</div>
				<div class="modal-body">
				<form action="{{ url('cart/add/'.$product->id) }}" method="POST">
				 @csrf
				<div class="row">
					<div class="col-md-4">
						<div class="card" style="width: 16rem;">
						<img src="{{ asset($product->image_one) }}" class="card-img-top" id="pimage" style="height: 240px;">
						<div class="card-body">
						</div>
					</div>
					</div>
					<div class="col-md-4 ml-auto">
						<ul class="list-group">
						<li class="list-group-item"> <h5 class="card-title" id="pname"><strong>{{ $product->product_name_bn }}</strong></h5></span></li>
						<li class="list-group-item">মূল্য: 
							@if ($product->discount_price == NULL)
								<strong class="text-danger">${{ $product->selling_price }}</strong>
							@else
								<strong class="text-danger">${{ $product->discount_price }}</strong>
								<del>${{ $product->selling_price }}</del>							  
							@endif
						</li>
					<li class="list-group-item">পণ্যের কোড: <span id="pcode">{{ $product->product_code }}</span></li>
						<li class="list-group-item">ক্যাটাগরি:  <span id="pcat">{{ $product->category->category_name_bn }}</span></li>
						<li class="list-group-item">ব্র্যান্ড: <span id="pbrand">{{ $product->brand->brand_name_bn }}</span></li>
						<li class="list-group-item">স্টোক: 
							@if($product->product_quantity > 0)
							<span class="badge" style="background: green; color:white;">রয়েছে</span></li>
							@else 
							<span class="badge " style="background: red; color:white;">Stock শেষ</span></li>
							@endif
					</ul>						

					</div>
				
					<div class="col-md-4 ">
					<form action="" method="post">
						@csrf
						<input type="hidden" name="product_id" id="product_id">
						@if($product->product_color_bn == NULL)
						@else
							@php
							$color =  $product->product_color_bn;
							$product_color_bn = explode(',',$color);
							@endphp
							<div class="form-group" id="colordiv">
								<label for="">কালার</label>
								<select name="color" class="form-control">
									@foreach ($product_color_bn as $color)								
									<option value="{{ $color }}">{{ $color }}</option>
									@endforeach
								</select>
							</div>
						@endif
						@if($product->product_size_en == NULL)
						@else
							@php
							$size =  $product->product_size_bn;
							$product_size_bn = explode(',',$size);
							@endphp
						<div class="form-group" id="sizediv" >
							<label for="exampleInputEmail1">সাইজ</label>
							<select name="size" class="form-control" id="size">
								@foreach ($product_size_bn as $size)
									<option value="{{ $size }}">{{ $size }}</option>
								@endforeach
							</select>
						</div>
						@endif
						<div class="form-group">
							<label for="exampleInputPassword1">পরিমাণ</label>
							<input type="number" class="form-control" value="1" min="1" name="qty">
						</div>
						<button type="submit" class="btn btn-primary">কার্টে সংযুক্ত করুন</button>
					</div>
				</form>
					
				</div>
				</div>
			</div>
			</div>
		</div> 	<!-- Bangla modal end>
	@endforeach
@else
	@foreach ($products as $product)
		<!-Eglish Modal -->
		<div class="modal fade " id="cartmodal{{ $product->id }}" tabindex="-1" >
			<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" style="font-size: 35px; color:red;" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" >&times;</span>
				</button>
				</div>
				<div class="modal-body">		
				<div class="row">
				<form action="{{ url('cart/add/'.$product->id) }}" method="POST">
					@csrf
					<div class="col-md-4">
						<div class="card" style="width: 16rem;">
						<img src="{{ asset($product->image_one) }}" class="card-img-top" id="pimage" style="height: 240px;">
						<div class="card-body">		
						</div>
					</div>
					</div>
					<div class="col-md-4 ml-auto">
						<ul class="list-group">
						<li class="list-group-item"> <h5 class="card-title" id="pname"><strong>{{ ucwords($product->product_name_en) }}</strong></h5></span></li>
						<li class="list-group-item">Price: 
							@if ($product->discount_price == NULL)
								<strong class="text-danger">${{ $product->selling_price }}</strong>
							@else
								<strong class="text-danger">${{ $product->discount_price }}</strong>
								<del>${{ $product->selling_price }}</del>							  
							@endif
						</li>
					
					<li class="list-group-item">Product code: <span id="pcode">{{ $product->product_code }}</span></li>
						<li class="list-group-item">Category:  <span id="pcat">{{ $product->category->category_name_en }}</span></li>
						<li class="list-group-item">Brand: <span id="pbrand">{{ $product->brand->brand_name_en }}</span></li>
						<li class="list-group-item">Stock: 
							@if($product->product_quantity > 0)
							<span class="badge" style="background: green; color:white;">Available</span></li>
							@else 
							<span class="badge " style="background: red; color:white;">Stock Out</span></li>
							@endif
					</ul>
					</div>
					<div class="col-md-4 ">
					
						@if($product->product_color_en == NULL)
						@else
							@php
							$color =  $product->product_color_en;
							$product_color_en = explode(',',$color);
							@endphp
							<div class="form-group" id="colordiv">
								<label for="">Color</label>
								<select name="color" class="form-control">
									@foreach ($product_color_en as $color)								
									<option value="{{ $color }}">{{ $color }}</option>
									@endforeach
								</select>
							</div>
						@endif
						@if($product->product_size_en == NULL)
						@else
							@php
							$size =  $product->product_size_en;
							$product_size_en = explode(',',$size);
							@endphp
						<div class="form-group" id="sizediv" >
							<label for="exampleInputEmail1">Size</label>
							<select name="size" class="form-control" id="size">
								@foreach ($product_size_en as $size)
									<option value="{{ $size }}">{{ $size }}</option>
								@endforeach
							</select>
						</div>
						@endif
						<div class="form-group">
							<label for="exampleInputPassword1">Quantity</label>
							<input type="number" class="form-control" value="1" min="1" name="qty">
						</div>
						<button type="submit" data-id="{{ $product->id }}" class="btn btn-primary addcart">Add To Cart</button>
					</div>
				</form>
				</div>
				</div>
			</div>
			</div>
		</div> 	<!-- modal end>
	@endforeach
@endif
@endsection