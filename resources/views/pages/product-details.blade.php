@extends('layouts.fontend_master')
@section('title') 
@if (session()->get('language') == 'bangla') {{ $product->product_slug_bn }} @else {{ $product->product_slug_en }} @endif
@endsection
@section('home') active @endsection
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
				@if (session()->get('language') == 'bangla')
				<li><a href="#">হোম</a></li>
				<li><a href="#">পণ্যসমূহ</a></li>
				<li class='active'>{{ $product->product_name_bn }}</li>					
				@else
				<li><a href="#">Home</a></li>
				<li><a href="#">Products</a></li>
				<li class='active'>{{ $product->product_name_en }}</li>
				@endif
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
				<div class="home-banner outer-top-n">
                    <img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
                </div>		
    
    	<!-- =================================== HOT DEALS ===================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
	<h3 class="section-title">@if (session()->get('language') =='bangla')	হট ডিল @else hot deals @endif</h3>
		<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
			@foreach ($hot_deals as $hot)
				<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								<img src="{{ asset($hot->image_one) }}" alt="">
							</div>
							@php
							$amount = $hot->selling_price-$hot->discount_price;
							$discount = $amount/$hot->selling_price *100;
							@endphp
							@if ($hot->discount_price == NULL)
							<div class="sale-offer-tag new">
								<span>New</span>
							</div>
							@else
							<div class="sale-offer-tag">
								<span>{{ round($discount) }}% <br>off</span>
							</div>		
							@endif			
							<div class="timing-wrapper">
								<div class="box-wrapper">
									<div class="date box">
										<span class="key">120</span>
										<span class="value">Days</span>
									</div>
								</div>
				                
				                <div class="box-wrapper">
									<div class="hour box">
										<span class="key">20</span>
										<span class="value">HRS</span>
									</div>
								</div>

				                <div class="box-wrapper">
									<div class="minutes box">
										<span class="key">36</span>
										<span class="value">MINS</span>
									</div>
								</div>

				                <div class="box-wrapper hidden-md">
									<div class="seconds box">
										<span class="key">60</span>
										<span class="value">SEC</span>
									</div>
								</div>
							</div>
						</div><!-- /.hot-deal-wrapper -->

						<div class="product-info text-left m-t-20">
							<h3 class="name">
								@if(session()->get('language') == 'bangla')
								<a href="{{ url('product-details/'.$hot->id.'/'.$hot->product_slug_bn) }}">{{  $hot->product_name_bn }}</a>
								@else
								<a href="{{ url('product-details/'.$hot->id.'/'.$hot->product_slug_en) }}">{{ ucwords( $hot->product_name_en)}}</a>
								@endif
							</h3>
							@php
								$reviews = App\ProductComment::where('product_id',$product->id)->get();
							@endphp
									<div style="color: #FF0000;"> 
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										@if ( count($reviews) == 0)
										<span style="color: black;">(No Review )</span>	
										@else
										<span style="color: black;">( {{ count($reviews) }} Review )</span>	
										@endif
									</div> 
										

							<div class="product-price">	
								@if ($hot->discount_price == NULL)
									<span class="price">${{ $hot->selling_price }}</span>
								@else 
									<span class="price">${{ $hot->discount_price }}</span>
									<span class="price-before-discount">${{ $hot->selling_price }}</span>
								@endif					
							
							</div><!-- /.product-price -->

						</div><!-- /.product-info -->
						

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button  class="btn btn-primary icon"  data-toggle="modal" data-target="#cartmodal{{ $hot->id }}" title="Add Cart">
										<i class="fa fa-shopping-cart"></i>		
									</button>
									<button class="btn btn-primary cart-btn" type="button" data-toggle="modal" data-target="#cartmodal{{ $hot->id }}" title="Add Cart">Add to cart</button>
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
				</div>	
			@endforeach	        
							    
    </div><!-- /.sidebar-widget -->
</div>
<!-- ============== HOT DEALS: END ============================ -->					
<!-- ================== NEWSLETTER ========================================== -->
		@include('pages.inc.newsletter')
<!-- ============================================== NEWSLETTER: END ============================================== -->

<!-- ===================== Testimonials=================== -->
		@include('pages.inc.testimonial')
    
<!-- ========== Testimonials: END ================================= -->
	</div>
</div><!-- /.sidebar -->

		<div class='col-md-9'>
            <div class="detail-block">
				<div class="row  wow fadeInUp">              
					<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
						<div class="product-item-holder size-big single-product-gallery small-gallery">
							<div id="owl-single-product">
									<div class="single-product-gallery-item" id="name_{{ $product->id }}">
										<a data-lightbox="image-1" data-title="Gallery" href="{{ asset($product->image_one) }}">
											<img class="img-responsive" alt="" src="{{  asset($product->image_one)  }}" data-echo="{{  asset($product->image_one)  }}"/>
										</a>
									</div><!-- /.single-product-gallery-item -->
									
									<div class="single-product-gallery-item" id="name_{{ $product->id }}">
										<a data-lightbox="image-2" data-title="Gallery" href="{{ asset($product->image_two) }}">
											<img class="img-responsive" alt="" src="{{  asset($product->image_two)  }}" data-echo="{{  asset($product->image_two)  }}"/>
										</a>
									</div><!-- /.single-product-gallery-item -->

									<div class="single-product-gallery-item" id="name_{{ $product->id }}">
										<a data-lightbox="image-3" data-title="Gallery" href="{{ asset($product->image_three) }}">
											<img class="img-responsive" alt="" src="{{  asset($product->image_three)  }}" data-echo="{{  asset($product->image_three)  }}"/>
										</a>
									</div><!-- /.single-product-gallery-item -->

							</div><!-- /.single-product-slider -->

							<div class="single-product-gallery-thumbs gallery-thumbs">

								<div id="owl-single-product-thumbnails">
									<div class="item">
										<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#name_{{ $product->id }}">
											<img class="img-responsive" width="85" alt="" src="{{ asset($product->image_one) }}" data-echo="{{ asset($product->image_one) }}"/>
										</a>
									</div>
									
									<div class="item">
										<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="2" href="#name_{{ $product->id }}">
											<img class="img-responsive" width="85" alt="" src="{{ asset($product->image_two) }}" data-echo="{{ asset($product->image_two) }}"/>
										</a>
									</div>
									
									<div class="item">
										<a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="3" href="#name_{{ $product->id }}">
											<img class="img-responsive" width="85" alt="" src="{{ asset($product->image_three) }}" data-echo="{{ asset($product->image_three) }}"/>
										</a>
									</div>

								
								</div><!-- /#owl-single-product-thumbnails -->

								


							</div><!-- /.gallery-thumbs -->
						</div><!-- /.single-product-gallery -->
					</div><!-- /.gallery-holder -->   

					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							@if (session()->get('language') == 'bangla')
							<h1 class="name">{{ $product->product_name_bn }}</h1>
							@else
							<h1 class="name">{{ ucwords($product->product_name_en) }}</h1>
							@endif
							
							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
										<div style="color: red;"> 
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<a href="#" class="lnk">({{ count($comments) }} Reviews)</a>
										</div>
									</div>
								</div><!-- /.row -->		
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										@if (session()->get('language') =='bangla')
										<div class="stock-box">
											@if ($product->product_quantity > 0)
												<span class="value">
												স্টকে রয়েছে
												</span>
											@else 
											<span class="value">
												স্টক শেষ
											</span>
											@endif
										</div>
										@else								
										<div class="stock-box">
											@if ($product->product_quantity > 0)
												<span class="value">
													In Stock
												</span>
											@else 
											<span class="value">
												Stock Out
											</span>
											@endif
										</div>	
										@endif
									</div>
								</div><!-- /.row -->	
							</div><!-- /.stock-container -->
							@if (session()->get('language') =='bangla')
							<div class="description-container m-t-20">{{ $product->short_description_bn }}
							</div><!-- /.description-container -->
							@else
							<div class="description-container m-t-20">{{ $product->short_description_en }}
							</div><!-- /.description-container -->
							@endif

							<div class="price-container info-container m-t-20">
								<div class="row">
								{{-- <form action="{{ url('cart/add/'.$product->id) }}" method="POST">
									@csrf --}}
									<div class="col-sm-6">
										<div class="price-box">
										@if (session()->get('language') == 'bangla')
											@if ($product->discount_price == NULL)
											<span id="pprice">{{ $product->selling_price }}</span>
											<span class="price">৳{{ bn_price($product->selling_price) }}</span>
											@else 
											<span id="pprice">{{ $product->discount_price }}</span>
											<span class="price">৳{{ bn_price($product->discount_price) }}</span>
											<span class="price-strike">${{ bn_price($product->selling_price )}}</span>
											@endif
										@else 
										@if ($product->discount_price == NULL)
											<span id="pprice" class="price">৳{{ $product->selling_price }}</span>
											@else 
											<span id="pprice" class="price">৳{{ $product->discount_price }}</span>
											<span class="price-strike">${{ $product->selling_price }}</span>
											@endif
										@endif
										</div>
									</div>

									<div class="col-sm-6">
									 <div class="favorite-button m-t-10">
										<div class="sharethis-inline-share-buttons" data-href="{{ Request::url() }}"></div>
											{{-- <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
											    <i class="fa fa-heart"></i>
											</a>
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
											   <i class="fa fa-signal"></i>
											</a>
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
											    <i class="fa fa-envelope"></i>
											</a> --}}
										</div>
										
									</div>
								</div><!-- /.row -->

								<div class="row">
								@if ($product->product_size_en == NULL)
								@else
									<div class="col-sm-3">								
										<div class="form-group">
											<label for="exampleFormControlSelect1">Size:</label>
											<select class="form-control input-md"  id="size">
												@foreach ($product_size_en as $size)
												<option value="{{$size}}">{{$size}}</option>
												@endforeach
											</select>
										</div>	
									</div>
								@endif		
								
								<div class="col-sm-3">
										<div class="form-group">
											<label for="exampleFormControlSelect1">Color:</label>
											<select class="form-control input-md"  id="color">
												@foreach ($product_color_en as $color)
												<option value="{{$color}}">{{$color}}</option>
												@endforeach
											</select>
										</div>
								</div>
	
								</div>
							</div><!-- /.price-container -->

							<div class="quantity-container info-container">
								<div class="row">
									
									<div class="col-sm-2">
										@if (session()->get('language') == 'bangla')
										<span class="label">পরিমাণ :</span>
										@else 
										<span class="label">Qty :</span>
										@endif
									</div>
									
									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" id="qty" value="1" min="1">
							              </div>
							            </div>
									</div>
									<input type="hidden" id="product_id" value="{{ $product->id }}">
									<div class="col-sm-7">
										<button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i>@if (session()->get('language') == 'bangla') কার্টে সংযুক্ত করুন @else ADD TO CART @endif</button>
									</div>
								{{-- </form> --}}

									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->
							
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
                </div>
				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										@if (session()->get('language') =='bangla')										<p class="text">{!! $product->long_description_bn !!}</p>
										@else
										<p class="text">{!! $product->long_description_en !!}</p>
										@endif
									</div>	
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">
																				
										<div class="product-reviews">
											<h4 class="title">Customer Reviews</h4>

											<div class="reviews">
												@foreach ($comments as $comment)	
												<div class="review">
													<div class="review-title"><span class="summary">{{ $comment->name }}</span><span class="date"><i class="fa fa-calendar"></i><span>{{ $comment->created_at->diffForHumans() }}</span></span></div>
													<div class="text">"{{ $comment->review }}"</div>
												@if ($comment->rating == 1)
													<div style="color: #FF0000;"> 
														<i class="fa fa-star" aria-hidden="true"></i>
													
													</div>	
												@elseif($comment->rating == 2)
													<div style="color: #FF0000;">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
													</div>
												@elseif($comment->rating == 3)	
												<div style="color: #FF0000;"> 
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
												@elseif($comment->rating == 4)	
												<div style="color: #FF0000;"> 
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
												@elseif($comment->rating == 5)	
												<div style="color: #FF0000;"> 
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
												@endif											
												</div>
												@endforeach

												
											</div><!-- /.reviews -->
											{{-- product comment with facebook  --}}
											<div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="10" data-width=""></div>
										</div><!-- /.product-reviews -->
										

										
										<div class="product-add-review">
											<h4 class="title">Write your own review</h4>
										<form role="form" class="cnt-form" action="{{ route('product-comment') }}" method="POST">
												@csrf	
											<input type="hidden" name="product_id" value="{{ $product->id }}">
											<div class="review-table">												
												<div class="table-responsive">
													<table class="table">	
														<thead>
															<tr>
																<th class="cell-label">&nbsp;</th>
																<th>1 star</th>
																<th>2 stars</th>
																<th>3 stars</th>
																<th>4 stars</th>
																<th>5 stars</th>
															</tr>
														</thead>	
														<tbody>
															<tr>
																<td class="cell-label">Rating</td>
																<td><input type="radio" name="rating" class="radio" value="1"></td>
																<td><input type="radio" name="rating" class="radio" value="2"></td>
																<td><input type="radio" name="rating" class="radio" value="3"></td>
																<td><input type="radio" name="rating" class="radio" value="4"></td>
																<td><input type="radio" name="rating" class="radio" value="5"></td>
																
															</tr>
															
														</tbody>
														
													</table><!-- /.table .table-bordered -->
													@error('rating')
													<strong class="text-danger">{{ $message }}</strong>
													@enderror
												</div><!-- /.table-responsive -->
											</div><!-- /.review-table -->
											
											<div class="review-form">
												<div class="form-container">
													
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputName" placeholder="full name" name="name" data-validation="required">
																</div><!-- /.form-group -->
																<div class="form-group">
																	<label for="exampleInputSummary">Email <span class="astk">*</span></label>
																	<input type="email" class="form-control txt" id="exampleInputSummary" placeholder="email address" name="email" data-validation="required">
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Review <span class="astk">*</span></label>
																	<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="write review" name="review" data-validation="required"></textarea>
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->
														
														<div class="action text-right">
															<button class="btn btn-primary btn-upper" type="submit">SUBMIT REVIEW</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->										
										
							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

								

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

				<!-- ============================================== UPSELL PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">
		@if (session()->get('language') == 'bangla')
		সম্পর্কিত পণ্যসমূহ
		@else 
		Related products
		@endif 
	</h3>
	<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
	    	
		@foreach ($related_p as $product)
		<div class="item item-carousel">
			<div class="products">			
				<div class="product">		
					<div class="product-image">
						<div class="image">
							@if(session()->get('language') == 'bangla')
							<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">
								<img  src="{{ asset($product->image_one) }}" alt="{{ $product->product_name_bn }}">
							</a>
							@else
							<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">
								<img  src="{{ asset($product->image_one) }}" alt="{{ $product->product_name_en }}">
							</a>
							@endif
						</div><!-- /.image -->			

						<div class="tag new"><span>new</span></div>                        		   
					</div><!-- /.product-image -->

					<div class="product-info text-left">
						<h3 class="name">
							@if (session()->get('language') == 'bangla')
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{ $product->product_name_bn }}</a>
								@else
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords($product->product_name_en) }}</a>
							@endif
						</h3>
						@php
							$reviews = App\ProductComment::where('product_id',$product->id)->get();
						@endphp
									<div style="color: #FF0000;"> 
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										@if ( count($reviews) == 0)
										<span style="color: black;">(No Review )</span>	
										@else
										<span style="color: black;">( {{ count($reviews) }} Review )</span>	
										@endif
									</div>
						<div class="description"></div>
						<div class="product-price">	
							@if (session()->get('language') == 'bangla')
							@if ($product->discount_price == NULL)
							<span class="price">৳{{ bn_price($product->selling_price) }}</span>
							@else 
							<span class="price">৳{{ bn_price($product->discount_price) }}</span>
							<span class="price-before-discount">৳{{ bn_price($product->selling_price) }}</span>
							@endif
						@else
						@if ($product->discount_price == NULL)
							<span class="price">${{ $product->selling_price }}</span>
							@else 
							<span class="price">${{ $product->discount_price }}</span>
							<span class="price-before-discount">${{ $product->selling_price }}</span>
							@endif
						@endif
												
						</div><!-- /.product-price -->
						
					</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
						<div class="action">
							<ul class="list-unstyled">
								<li class="add-cart-button btn-group">
									<button  class="btn btn-primary icon product_cart_button addcart" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)" title="Add Cart">
										<i class="fa fa-shopping-cart"></i>		
									</button>
															
								</li>
							
								<li class="lnk">
								</li>
								<li >
									<button  type="submit" class="btn btn-primary icon product_cart_button" data-toggle="tooltip" id="{{ $product->id }}" onclick="addToWishlist(this.id)" title="Wishlist">
										<i class="fa fa-heart"></i>		
									</button>
									
								</li>
							</ul>
						</div><!-- /.action -->
					</div><!-- /.cart -->
				</div><!-- /.product -->   
			</div><!-- /.products -->
		</div><!-- /.item -->
   @endforeach  		
	
	</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ================ UPSELL PRODUCTS : END ============================= -->		
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
<!-- ======================== BRANDS CAROUSEL ===================== -->

    <div id="brands-carousel" class="logo-slider wow fadeInUp">

        <div class="logo-slider-inner">	
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                @foreach ($brands as $brand)			
                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="{{ asset($brand->brand_image) }}" src="{{ $brand->brand_name_en }}" alt="">
                        </a>	
                    </div><!--/.item-->
                @endforeach				
            </div><!-- /.owl-carousel #logo-slider -->
        </div><!-- /.logo-slider-inner -->	
    </div><!-- /.logo-slider -->
</div><!-- /.container -->
</div><!-- /.body-content -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=225614495464352&autoLogAppEvents=1"></script>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/bn_IN/sdk.js#xfbml=1&version=v3.2&appId=157325511530244&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5bf015c8b4a6560011bd9a88&product=inline-share-buttons' data-href="{{ Request::url() }}" async='async'></script>

@endsection