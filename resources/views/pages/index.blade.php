@extends('layouts.fontend_master')
@section('title') Home @endsection
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
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
	<div class="row">
	<!-- ==================== SIDEBAR =========================== -->	
	<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
			
	<!-- ================================== TOP NAVIGATION ================================== -->
	{{-- include category section --}}
		@include('pages.inc.category')
<!-- ================================== TOP NAVIGATION : END ================================== -->

	<!-- ======================== HOT DEALS ================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
	<h3 class="section-title">	@if (session()->get('language') == 'bangla') গরম অফার @else Hot deals @endif</h3>
		<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
			@foreach ($hot_deals as $product)
				<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								<img src="{{ asset($product->image_one) }}" alt="">
							</div>
							@php
							$amount = $product->selling_price-$product->discount_price;
							$discount = $amount/$product->selling_price *100;
							@endphp
							@if ($product->discount_price == NULL)
							<div class="sale-offer-tag new">
								<span>New</span>
							</div>
							@else
							<div class="sale-offer-tag">
								@if (session()->get('language') == 'bangla')
								<span>{{ bn_price(round($discount)) }}% <br>ছাড়</span>
								@else
								<span>{{ round($discount) }}% <br>off</span>
								@endif
							</div>		
							@endif			
							{{-- <div class="timing-wrapper">
								<div class="box-wrapper">
									<div class="date box">
										<span class="key">120</span>
										<span class="value">DAYS</span>
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
							</div> --}}
						</div><!-- /.hot-deal-wrapper -->
						
						<div class="product-info text-left m-t-20">
							@if (session()->get('language') == 'bangla')
							<h3 class="name"><a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{ $product->product_name_bn }}</a>
							</h3>
							@else
							<h3 class="name"><a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords($product->product_name_en) }}</a>
							</h3>
							@endif
								@php
								$reviews = App\ProductComment::where('product_id',$product->id)->get();
								@endphp
									<div style="color: #FF0000;"> 
										<i class="fa fa-star" aria-hidden="true"></i>
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
							@if (session()->get('language') == 'bangla')
								@if ($product->discount_price == NULL)
								<span class="price">৳{{ bn_price($product->selling_price )}}</span>
								@else 
								<span class="price">৳{{ bn_price($product->discount_price) }}</span>
								<span class="price-before-discount">৳{{ bn_price($product->selling_price )}}</span>
								@endif	
							@else 
							@if ($product->discount_price == NULL)
								<span class="price">৳{{ $product->selling_price }}</span>
								@else 
								<span class="price">৳{{ $product->discount_price }}</span>
								<span class="price-before-discount">৳{{ $product->selling_price }}</span>
								@endif	
							@endif
							
							</div><!-- /.product-price -->
							
						</div><!-- /.product-info -->

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button  class="btn btn-primary icon product_cart_button" data-toggle="tooltip" id="{{ $product->id }}" onclick="addToWishlist(this.id)" title="Wishlist">
										<i class="fa fa-heart"></i>		
									</button>
									@if (session()->get('language') == 'bangla')
									<button class="btn btn-primary cart-btn product_cart_button" type="button" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">কার্টে সংযুক্ত করুন</button>
									@else
									<button class="btn btn-primary cart-btn product_cart_button" type="button" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)" title="Add Cart">Add to cart</button>
									@endif
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
				</div><!-- /.item end -->
			@endforeach						    
    	</div><!-- /.sidebar-widget -->
</div>
<!-- ================= HOT DEALS: END =================================== -->

<!-- ======================= SPECIAL OFFER ============================== -->
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	<h3 class="section-title"> @if(session()->get('language') == 'bangla') স্পেশাল অফার  @else Special Offer @endif </h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
	        <div class="item">
	        	<div class="products special-product">
					@foreach ($special_offer as $product)
		        		<div class="product">
							<div class="product-micro">
								<div class="row product-micro-row">
									<div class="col col-xs-5">
										<div class="product-image">
											<div class="image">
												@if(session()->get('language') == 'bangla')
												<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">
													<img src="{{ asset($product->image_one) }}" alt="{{ $product->product_name_bn }}">
												</a>
												@else
												<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">
													<img src="{{ asset($product->image_one) }}" alt="{{ $product->product_name_en }}">
												</a>
												@endif					
											</div><!-- /.image -->					
										</div><!-- /.product-image -->
									</div><!-- /.col -->
									<div class="col col-xs-7">
										<div class="product-info">
											<h3 class="name">
												@if(session()->get('language') == 'bangla')
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
									</div> 
										@if ( count($reviews) == 0)
										<span style="color: black;">(No Review )</span>	
										@else
										<span style="color: black;">( {{ count($reviews) }} Review )</span>	
										@endif

											<div class="product-price">	
										@if (session()->get('language') == 'bangla')
												@if ($product->discount_price == NULL)
												<span class="price">৳{{ bn_price($product->selling_price )}}</span>
												@else 
												<span class="price">৳{{ bn_price($product->discount_price) }}</span>
												<span class="price-before-discount">৳{{ bn_price($product->selling_price )}}</span>
												@endif	
										@else 
											@if ($product->discount_price == NULL)
												<span class="price">৳{{ $product->selling_price }}</span>
												@else 
												<span class="price">৳{{ $product->discount_price }}</span>
												<span class="price-before-discount">৳{{ $product->selling_price }}</span>
												@endif	
										@endif
											</div><!-- /.product-price -->
											
										</div>
									</div><!-- /.col -->
								</div><!-- /.product-micro-row -->
							</div><!-- /.product-micro -->    
						</div>
					@endforeach
		        </div>
	        </div>
	    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ================== SPECIAL OFFER : END ============================================== -->
<!-- =================================== PRODUCT TAGS ======================= -->
	@include('pages.inc.product-tag')
<!-- ================== PRODUCT TAGS : END ============================================== -->
<!-- =========================== SPECIAL DEALS ============================== -->

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	<h3 class="section-title"> @if (session()->get('language') == 'bangla') স্পেশাল ডিল @else Special Deals @endif</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
	        <div class="item">
	        	<div class="products special-product">
					@foreach ($special_deals as $product)
						<div class="product">
							<div class="product-micro">
								<div class="row product-micro-row">
									<div class="col col-xs-5">
										<div class="product-image">
											<div class="image">
												@if (session()->get('language') == 'bangla')
												<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">
													<img src="{{ asset($product->image_one) }}"  alt="{{ $product->product_name_bn }}">
												</a>
												@else
												<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">
													<img src="{{ asset($product->image_one) }}"  alt="{{ $product->product_name_en }}">
												</a>	
												@endif				
											</div><!-- /.image -->					
										</div><!-- /.product-image -->
									</div><!-- /.col -->
									<div class="col col-xs-7">
										<div class="product-info">
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
										<i class="fa fa-star" aria-hidden="true"></i>
									</div> 
									@if ( count($reviews) == 0)
										<span style="color: black;">(No Review )</span>	
										@else
										<span style="color: black;">( {{ count($reviews) }} Review )</span>	
										@endif
											<div class="product-price">	
										@if (session()->get('language') == 'bangla')
											@if ($product->discount_price == NULL)
											<span class="price">${{ bn_price($product->selling_price )}}</span>
											@else 
											<span class="price">${{ bn_price($product->discount_price) }}</span>
											<span class="price-before-discount">${{ bn_price($product->selling_price )}}</span>
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
										</div>
									</div><!-- /.col -->
								</div><!-- /.product-micro-row -->
							</div><!-- /.product-micro -->      
						</div>	
					@endforeach	        							
		    	</div>
	        </div>
	     </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ================= SPECIAL DEALS : END ==================================== -->
<!-- =========================== NEWSLETTER ================================= -->
	@include('pages.inc.newsletter')
<!-- ===================== NEWSLETTER: END ======================== -->

<!-- =================== Testimonials=================== -->
	@include('pages.inc.testimonial')
<!-- ================== Testimonials: END ==================== -->
 {{-- ads download flipmart apps  --}}
<div class="home-banner">
<img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
</div> 

<div class="home-banner">
<img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
</div> 
<div class="home-banner">
	<img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
</div> 
<div class="home-banner">
	<img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
</div> 




		</div><!-- /.sidemenu-holder -->
<!-- ============================= SIDEBAR : END ============================================== -->

<!-- ==================================== CONTENT ============================================== -->
		<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
			<!-- ================ SECTION – HERO ========================================= -->
			
<div id="hero">
	<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
		@foreach ($main_sliders as $main)
		<div class="item" style="background-image: url({{ asset($main->image) }});">
			<div class="container-fluid">
				<div class="caption bg-color vertical-center text-left">
                    <div class="slider-header fadeInDown-1">
						@if ($main->title == NULL )
						@else	
						ShopMama
						@endif							
						</div>
					<div class="big-text fadeInDown-1">						
						{{ ucwords($main->title ) }}
					</div>
					<div class="excerpt fadeInDown-2 hidden-xs">
					<span>{{ $main->description }}</span>
					</div>
					<div class="button-holder fadeInDown-3">
					@if ($main->title == NULL )
					@else	
					<a href="" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
					@endif
						
						
					</div>
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div><!-- /.item -->
		@endforeach
	</div><!-- /.owl-carousel -->
</div>
			
<!-- ========================================= SECTION – HERO : END ========================================= -->	

			<!-- ============================================== INFO BOXES ============================================== -->
<div class="info-boxes wow fadeInUp">
	<div class="info-boxes-inner">
		<div class="row">
			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">						
						<div class="col-xs-12">
							<h4 class="info-box-heading green">money back</h4>
						</div>
					</div>	
					<h6 class="text">30 Days Money Back Guarantee</h6>
				</div>
			</div><!-- .col -->

			<div class="hidden-md col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						
						<div class="col-xs-12">
							<h4 class="info-box-heading green">free shipping</h4>
						</div>
					</div>
					<h6 class="text">Shipping on orders over $99</h6>	
				</div>
			</div><!-- .col -->

			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						
						<div class="col-xs-12">
							<h4 class="info-box-heading green">Special Sale</h4>
						</div>
					</div>
					<h6 class="text">Extra $5 off on all items </h6>	
				</div>
			</div><!-- .col -->
		</div><!-- /.row -->
	</div><!-- /.info-boxes-inner -->
	
</div><!-- /.info-boxes -->
<!-- ========================== INFO BOXES : END =========================== -->
<!-- ========================== SCROLL TABS ================================== -->
<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
	<div class="more-info-tab clearfix ">
	   <h3 class="new-product-title pull-left">
			@if (session()->get('language') == 'bangla')
			নতুন পণ্য
			@else 
			New Products 
			@endif
		</h3>
		<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
			<li class="active">				
				@if (session()->get('language') == 'bangla')
				<a data-transition-type="backSlide" href="#all" data-toggle="tab">সকল</a>
				@else 
				<a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a>
				@endif
			</li>
			@foreach ($categories as $cat)		
			<li>				
				<a data-transition-type="backSlide" href="#category{{ $cat->id }}" data-toggle="tab">
					@if (session()->get('language') == 'bangla')			
					{{  $cat->category_name_bn }}
					@else
					{{ucwords( $cat->category_name_en) }}
					@endif
				</a>				
			</li>		
			@endforeach
		</ul><!-- /.nav-tabs -->
	</div>

	<div class="tab-content outer-top-xs">
		<div class="tab-pane in active" id="all">			
			<div class="product-slider">
				<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
				@foreach ($products as $product)		  	
					<div class="item item-carousel">
						<div class="products">						
							<div class="product">		
								<div class="product-image">
									<div class="image">
										@if (session()->get('language') == 'bangla')
										<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->image_one) }}" alt="{{ $product->product_name_bn }}"></a>
										@else
										<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->image_one) }}" alt="{{ $product->product_name_en }}"></a>
										@endif
									</div><!-- /.image -->
									@php
										$amount = $product->selling_price-$product->discount_price;
										$discount = $amount/$product->selling_price *100;
									@endphp
									@if ($product->discount_price == NULL)
									<div class="tag new"><span>New</span></div>  
									@else
									<div class="tag sale"><span><strong>
										@if (session()->get('language') == 'bangla')
										{{ bn_price(round($discount)) }}%
										@else
										{{ round($discount) }}%
										@endif
									</strong></span></div>  								
									@endif			
									                      		   
								</div><!-- /.product-image -->					
								<div class="product-info text-left">
									<h3 class="name">
										@if (session()->get('language') == 'bangla')
										<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{ $product->product_name_bn }}</a>
										@else
										<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ $product->product_name_en }}</a>
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
													<button  class="btn btn-primary icon" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
		</div><!-- /.product-slider -->
	</div><!-- /.tab-pane -->
	{{-- category wise product show  --}}
	@foreach ($categories as $category)
		<div class="tab-pane" id="category{{ $category->id }}">
			<div class="product-slider">
				<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
					@php
						$catproducts = App\Product::where('category_id',$category->id)->where('status',1)->latest()->get();
						
					@endphp	
					@forelse ($catproducts as $product)	    	
					<div class="item item-carousel">
						<div class="products">							
							<div class="product">		
								<div class="product-image">
									<div class="image">
										@if (session()->get('language') == 'bangla')
										<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->image_one) }}" alt="{{ $product->product_name_bn }}"></a>
										@else
										<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->image_one) }}" alt="{{ $product->product_name_en }}"></a>
										@endif
									</div><!-- /.image -->	
									@php
										$amount = $product->selling_price - $product->discount_price;
										$discount = $amount/$product->selling_price * 100;
									@endphp		
									@if ($product->discount_price == NULL)
									<div class="tag new"><span>New</span></div>            		   					@else
									<div class="tag sale"><span>@if (session()->get('language') == 'bangla')
										{{ bn_price(round($discount)) }}%
										@else
										{{ round($discount) }}%
										@endif</span></div>      					
									@endif
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
													<button  class="btn btn-primary icon product_cart_button addcart"  id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
					@empty 
					<div class="m-auto" style="text-align: center";>
						@if (session()->get('language') == 'bangla')
						<h4 class="text-center text-danger">কোনো পণ্য পাওয়া যায়নি</h4> 
						@else
						<h4 class="text-center text-danger">No Products Found</h4>
						@endif
					</div>
					@endforelse
			</div><!-- /.home-owl-carousel -->
			</div><!-- /.product-slider -->
		</div><!-- /.tab-pane -->
	@endforeach
	</div><!-- /.tab-content -->
</div><!-- /.scroll-tabs -->
<!-- =============== SCROLL TABS : END ====================================== -->
<!-- ========================= WIDE PRODUCTS =============================== -->
<div class="wide-banners wow fadeInUp outer-bottom-xs">
<div class="row">
<div class="col-md-7 col-sm-7">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="{{ asset('fontend') }}/assets/images/banners/home-banner1.jpg" alt="">
</div>

</div><!-- /.wide-banner -->
</div><!-- /.col -->
<div class="col-md-5 col-sm-5">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="{{ asset('fontend') }}/assets/images/banners/home-banner2.jpg" alt="">
</div>

</div><!-- /.wide-banner -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.wide-banners -->

<!-- ================================= WIDE PRODUCTS : END ==================================== -->
<!-- ======================= FEATURED PRODUCTS =================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">@if(session()->get('language') == 'bangla') বৈশিষ্ট্যযুক্ত পণ্যসমূহ @else Featured products @endif</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">	    
		@foreach ($featured_products as $product)
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
									@php
										$amount = $product->selling_price-$product->discount_price;
										$discount = $amount/$product->selling_price *100;
									@endphp
									@if ($product->discount_price == NULL)
									<div class="tag new" style="background: green;"><span>New</span></div>  
									@else
									<div class="tag sale"><span><strong>
										@if (session()->get('language') == 'bangla')
										{{ bn_price(round($discount)) }}%
										@else
										{{ round($discount) }}%
										@endif
									</strong></span></div>  								
									@endif	   
						</div><!-- /.product-image -->		
						<div class="product-info text-left">
							<h3 class="name">
								@if(session()->get('language') == 'bangla')
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{  $product->product_name_bn }}</a>
								@else
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords( $product->product_name_en)}}</a>
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
										<button  class="btn btn-primary icon product_cart_button " id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
<!-- ================== FEATURED PRODUCTS : END ============================ -->

<!-- ======================= SKip PRODUCTS 0 Show categories =================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">@if(session()->get('language') == 'bangla') {{ $skip_category_0->category_name_bn }} @else {{ $skip_category_0->category_name_en }} @endif</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">	    
		@foreach ($products_skip_0 as $product)
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
									@php
										$amount = $product->selling_price-$product->discount_price;
										$discount = $amount/$product->selling_price *100;
									@endphp
									@if ($product->discount_price == NULL)
									<div class="tag new"><span>New</span></div>  
									@else
									<div class="tag sale"><span><strong>
										@if (session()->get('language') == 'bangla')
										{{ bn_price(round($discount)) }}%
										@else
										{{ round($discount) }}%
										@endif
									</strong></span></div>  								
									@endif	   
						</div><!-- /.product-image -->		
						<div class="product-info text-left">
							<h3 class="name">
								@if(session()->get('language') == 'bangla')
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{  $product->product_name_bn }}</a>
								@else
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords( $product->product_name_en)}}</a>
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
										<button  class="btn btn-primary icon product_cart_button addcart" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
<!-- ================== SKip 0 PRODUCTS category wise : END ============================ -->

<!-- ======================= SKip PRODUCTS 1 Show categories =================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">@if(session()->get('language') == 'bangla') {{ $skip_category_1->category_name_bn }} @else {{ $skip_category_1->category_name_en }} @endif </h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">	    
		@foreach ($products_skip_1 as $product)
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
									@php
										$amount = $product->selling_price-$product->discount_price;
										$discount = $amount/$product->selling_price *100;
									@endphp
									@if ($product->discount_price == NULL)
									<div class="tag new"><span>New</span></div>  
									@else
									<div class="tag sale"><span><strong>
										@if (session()->get('language') == 'bangla')
										{{ bn_price(round($discount)) }}%
										@else
										{{ round($discount) }}%
										@endif
									</strong></span></div>  								
									@endif	   
						</div><!-- /.product-image -->		
						<div class="product-info text-left">
							<h3 class="name">
								@if(session()->get('language') == 'bangla')
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{  $product->product_name_bn }}</a>
								@else
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords( $product->product_name_en)}}</a>
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
										<button  class="btn btn-primary icon product_cart_button addcart" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
<!-- ================== SKip 1 PRODUCTS category wise : END ============================ -->

<!-- ======================= SKip PRODUCTS 2 Show categories =================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">@if(session()->get('language') == 'bangla') {{ $skip_category_2->category_name_bn }} @else {{ $skip_category_2->category_name_en }} @endif </h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">	    
		@foreach ($products_skip_2 as $product)
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
									@php
										$amount = $product->selling_price-$product->discount_price;
										$discount = $amount/$product->selling_price *100;
									@endphp
									@if ($product->discount_price == NULL)
									<div class="tag new"><span>New</span></div>  
									@else
									<div class="tag sale"><span><strong>
										@if (session()->get('language') == 'bangla')
										{{ bn_price(round($discount)) }}%
										@else
										{{ round($discount) }}%
										@endif
									</strong></span></div>  								
									@endif	   
						</div><!-- /.product-image -->		
						<div class="product-info text-left">
							<h3 class="name">
								@if(session()->get('language') == 'bangla')
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{  $product->product_name_bn }}</a>
								@else
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords( $product->product_name_en)}}</a>
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
										<button  class="btn btn-primary icon product_cart_button addcart" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
<!-- ================== SKip 2 PRODUCTS category wise : END ============================ -->

<!-- ======================= SKip PRODUCTS brand 0 Show  =================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">@if(session()->get('language') == 'bangla') {{ $skip_brand_0->brand_name_bn }} @else {{ $skip_brand_0->brand_name_en }} @endif </h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">	    
		@foreach ($products_brand_skip_0 as $product)
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
									@php
										$amount = $product->selling_price-$product->discount_price;
										$discount = $amount/$product->selling_price *100;
									@endphp
									@if ($product->discount_price == NULL)
									<div class="tag new"><span>New</span></div>  
									@else
									<div class="tag sale"><span><strong>
										@if (session()->get('language') == 'bangla')
										{{ bn_price(round($discount)) }}%
										@else
										{{ round($discount) }}%
										@endif
									</strong></span></div>  								
									@endif	   
						</div><!-- /.product-image -->		
						<div class="product-info text-left">
							<h3 class="name">
								@if(session()->get('language') == 'bangla')
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{  $product->product_name_bn }}</a>
								@else
								<a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords( $product->product_name_en)}}</a>
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
										<button  class="btn btn-primary icon product_cart_button addcart" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
<!-- ================== SKip 0 brand PRODUCTS category wise : END ============================ -->

<!-- ============================= WIDE PRODUCTS ============================= -->
<div class="wide-banners wow fadeInUp outer-bottom-xs">
	<div class="row">

		<div class="col-md-12">
			<div class="wide-banner cnt-strip">
				<div class="image">
					<img class="img-responsive" src="assets/images/banners/home-banner.jpg" alt="">
				</div>	
				<div class="strip strip-text">
					<div class="strip-inner">
						<h2 class="text-right">New Mens Fashion<br>
						<span class="shopping-needs">Save up to 40% off</span></h2>
					</div>	
				</div>
				<div class="new-label">
				    <div class="text">NEW</div>
				</div><!-- /.new-label -->
			</div><!-- /.wide-banner -->
		</div><!-- /.col -->

	</div><!-- /.row -->
</div><!-- /.wide-banners -->
<!-- ============================================== WIDE PRODUCTS : END ============================================== -->
			<!-- ============================================== BEST SELLER ============================================== -->

<div class="best-deal wow fadeInUp outer-bottom-xs">
	<h3 class="section-title">Best seller</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
	    	<div class="item">
	        	<div class="products best-product">
					{{-- @foreach ($collection as $item) --}}
						<div class="product">
							<div class="product-micro">
								<div class="row product-micro-row">
									<div class="col col-xs-5">
										<div class="product-image">
											<div class="image">
												<a href="#">
													<img src="{{ asset('fontend') }}/assets/images/products/p20.jpg" alt="">
												</a>					
											</div><!-- /.image -->					
										</div><!-- /.product-image -->
									</div><!-- /.col -->
									<div class="col2 col-xs-7">
										<div class="product-info">
											<h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
											<div class="rating rateit-small"></div>
											<div class="product-price">	
											<span class="price">$450.99</span>								
										</div><!-- /.product-price -->							
										</div>
									</div><!-- /.col -->
								</div><!-- /.product-micro-row -->
							</div><!-- /.product-micro -->
						</div>
					{{-- @endforeach		        							 --}}
		        </div>
	        </div>
	    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== BEST SELLER : END ============================================== -->	

			<!-- ============================================== BLOG SLIDER ============================================== -->
<section class="section latest-blog outer-bottom-vs wow fadeInUp">
	<h3 class="section-title">
		@if (session()->get('language') == 'bangla') ব্লগের নতুন পোষ্টসমূহ @else latest form blog	@endif
		</h3>
	<div class="blog-slider-container outer-top-xs">
		<div class="owl-carousel blog-slider custom-carousel">
			@foreach ($blogs as $blog)								
				<div class="item">
					<div class="blog-post">
						<div class="blog-post-image">
							<div class="image">
								<a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_en) }}"><img src="{{ asset($blog->post_image) }}" alt=""></a>
							</div>
						</div><!-- /.blog-post-image -->
						<div class="blog-post-info text-left">
							<h3 class="name">
								@if(session()->get('language') == 'bangla')	
								<a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_bn) }}">{{ $blog->post_title_bn }}</a>
								@else
								<a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_en) }}">{{ ucwords($blog->post_title_en) }}</a>
								@endif
							</h3>	
							<span class="info">{{ $blog->author->name }} &nbsp;|&nbsp; {{ Carbon\Carbon::Parse($blog->created_at)->format('d F Y') }}&nbsp;|&nbsp;{{ $blog->created_at->diffForHumans() }}</span>
							@if(session()->get('language') == 'bangla')
							<p class="text">{!! Str::words($blog->post_description_bn,50,'....') !!}</p>
							<a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_bn) }}" class="lnk btn btn-primary">বিস্তারিত পড়ুন</a>
							@else
							<p class="text">{!! Str::words($blog->post_description_en,50,'....') !!}</p>
							<a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_en) }}" class="lnk btn btn-primary">Read more</a>
							@endif
							
						</div><!-- /.blog-post-info -->						
					</div><!-- /.blog-post -->
				</div><!-- /.item -->
			@endforeach							
		</div><!-- /.owl-carousel -->
	</div><!-- /.blog-slider-container -->
</section><!-- /.section -->
<!-- ============================================== BLOG SLIDER : END ============================================== -->	

<!-- ================= New Arrivals ============================== -->
<section class="section wow fadeInUp new-arriavls">
	<h3 class="section-title"> @if (session()->get('language') == 'bangla') নতুন পণ্যসমূহ @else New Arrivals @endif </h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
	  @foreach ($new_arrivals as $product)
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

							<div class="tag new" style="background: blue;"><span>new</span></div>                        		   
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
										<button  class="btn btn-primary icon product_cart_button addcart" id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
<!-- ==================== New Arrivals  : END ========================= -->

		</div><!-- /.homebanner-holder -->
		<!-- ============================================== CONTENT : END ============================================== -->
	</div><!-- /.row -->
	<!-- ========================== BRANDS CAROUSEL =============================== -->
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
<!-- ======================= BRANDS CAROUSEL : END =================================== -->

	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->
	
    
@endsection