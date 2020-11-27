@extends('layouts.fontend_master')
@section('title') search result @endsection
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
				<li><a href="#">Home</a></li>
				<li><a href="#">Search</a></li>
				<li class='active'>Result</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row'>
			<div class='col-md-3 sidebar'>
<!-- ================================== TOP NAVIGATION ================================== -->
        
		@include('pages.inc.category')
<!-- ======================== TOP NAVIGATION : END ============================= -->	            
<div class="sidebar-module-container">
	            	
<div class="sidebar-filter">
<!-- ======================================== SIDEBAR CATEGORY ================================= -->
<div class="sidebar-widget wow fadeInUp">
<h3 class="section-title">shop by</h3>
	<div class="widget-header">
		
	</div>
	<div class="sidebar-widget-body">
		<div class="accordion">
        @foreach ($categories as $cat)                     
	    	<div class="accordion-group">
	            <div class="accordion-heading">
                    <a href="#{{ $cat->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
                        @if (session()->get('language') == 'bangla')
                        {{ $cat->category_name_bn }}
                        @else  
                        {{ $cat->category_name_en }}  
                        @endif	                  
	                </a>
	            </div><!-- /.accordion-heading -->
	            <div class="accordion-body collapse" id="{{ $cat->id }}" style="height: 0px;">
	                <div class="accordion-inner">
                        @php
                            $subcategories = App\Subcategory::where('category_id',$cat->id)->orderBy('subcategory_name_en','ASC')->get();
                        @endphp
	                    <ul>
                            @foreach ($subcategories as $subcat)                               
                           
                            <li>
                                @if (session()->get('language') == 'bangla')
                                <a href="{{ url('subcategory/products/'.$subcat->id.'/'.$subcat->subcategory_slug_bn) }}">{{ $subcat->subcategory_name_bn }}</a>
                                @else
                                <a href="{{ url('subcategory/products/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}">{{ ucwords($subcat->subcategory_name_en) }}</a>
                                @endif
                            </li>
                            @endforeach
	                    </ul>
	                </div><!-- /.accordion-inner -->
	            </div><!-- /.accordion-body -->
	        </div><!-- /.accordion-group -->
        @endforeach
	    </div><!-- /.accordion -->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ========================= SIDEBAR CATEGORY : END =================== -->

<!-- =================== PRICE SILDER============================================== -->

<!-- ======================= PRICE SILDER : END ==================================== -->
<!-- ============================= MANUFACTURES============================== -->
<div class="sidebar-widget wow fadeInUp">
	<div class="widget-header">
		<h4 class="widget-title">Shop By Brands</h4>
    </div>
    
	<div class="sidebar-widget-body">
		<ul class="list">
         @foreach ($brands as $brand)
         @if (session()->get('language') == 'bangla')
         <li><a href="{{ url('brand/products/'.$brand->id.'/'.$brand->brand_slug_bn) }}">{{ $brand->brand_name_bn }}</a></li>
         @else 
         <li><a href="{{ url('brand/products/'.$brand->id.'/'.$brand->brand_slug_en) }}">{{ $brand->brand_name_en }}</a></li>
         @endif         
            
         @endforeach
           
          </ul>
        <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ====================== MANUFACTURES: END ==================== -->

<!-- ========================== PRODUCT TAGS =================================== -->
	@include('pages.inc.product-tag')
<!-- ================ PRODUCT TAGS : END ============================================== -->		            	
<!--============================ Testimonials========================= -->
		@include('pages.inc.testimonial')
    
<!-- ================= Testimonials: END ========================= -->

<div class="home-banner">
<img src="{{ asset('fontend/') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
</div> 

	            	</div><!-- /.sidebar-filter -->
	            </div><!-- /.sidebar-module-container -->
            </div><!-- /.sidebar -->
			<div class='col-md-9'>
					<!-- ========================================== SECTION – HERO ========================================= -->

	<div id="category" class="category-carousel hidden-xs">
		<div class="item">	
			<div class="image">
				<img src="{{ asset('fontend') }}/assets/images/banners/home-banner.jpg" alt=""  class="img-responsive">
			</div>
			<div class="container-fluid">
				<div class="caption vertical-top text-left">

					<div class="excerpt hidden-sm hidden-md">
						Shopping Now Save up to 49% off
					</div>
                    <div class="excerpt-normal hidden-sm hidden-md">
						This Months Special Discount Offer Available Here. Shopping Now and  get Cashback Discount
					</div>
					
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div>
</div>

		

			
<!-- ===================== SECTION – HERO : END =================================== -->
				<div class="clearfix filters-container m-t-10">
	<div class="row">
		<div class="col col-sm-6 col-md-2">
			<div class="filter-tabs">
				<ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
					<li class="active">
						<a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a>
					</li>
					<li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
				</ul>
			</div><!-- /.filter-tabs -->
		</div><!-- /.col -->
		<div class="col col-sm-12 col-md-6">
			<div class="col col-sm-3 col-md-6 no-padding">
				<div class="lbl-cnt">
					<span class="lbl">Sort by</span>
					<div class="fld inline">
						<div class="dropdown dropdown-small dropdown-med dropdown-white inline">
							<button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
								Position <span class="caret"></span>
							</button>

							<ul role="menu" class="dropdown-menu">
								<li role="presentation"><a href="#">position</a></li>
								<li role="presentation"><a href="#">Price:Lowest first</a></li>
								<li role="presentation"><a href="#">Price:HIghest first</a></li>
								<li role="presentation"><a href="#">Product Name:A to Z</a></li>
							</ul>
						</div>
					</div><!-- /.fld -->
				</div><!-- /.lbl-cnt -->
			</div><!-- /.col -->
			<div class="col col-sm-3 col-md-6 no-padding">
				
			</div><!-- /.col -->
		</div><!-- /.col -->
		<div class="col col-sm-6 col-md-4 text-right">
			
        </div><!-- /.col -->
    </div><!-- /.row -->
 </div>
				<div class="search-result-container ">
					<div id="myTabContent" class="tab-content category-list">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product">
								<div class="row">									
								@forelse ($products as $product)                              
                                    <div class="col-sm-6 col-md-4 wow fadeInUp">
                                        <div class="products">
                                            
                                            <div class="product">		
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="detail.html"><img  src="{{ asset($product->image_one) }}" alt=""></a>
                                                    </div><!-- /.image -->			
                                                        @php
                                                        $amount = $product->selling_price-$product->discount_price;
                                                        $discount = $amount/$product->selling_price *100;
                                                        @endphp
                                                        @if ($product->discount_price == NULL)
                                                        <div class="tag new">
                                                            <span>New</span>
                                                        </div>
                                                        @else
                                                        <div class="tag new">
                                                            @if (session()->get('language') == 'bangla')
                                                            <span>{{ bn_price(round($discount)) }}%</span>
                                                            @else
                                                            <span>{{ round($discount) }}%</span>
                                                            @endif
                                                        </div>		
                                                        @endif		
                                                                    		   
                                                </div><!-- /.product-image -->
                                                    
                                                
                                                <div class="product-info text-left">
                                                    @if (session()->get('language') == 'bangla')
                                                    <h3 class="name"><a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{ $product->product_name_bn }}</a>
                                                    </h3>
                                                    @else
                                                    <h3 class="name"><a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords($product->product_name_en) }}</a>
                                                    </h3>
                                                    @endif
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

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
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button  class="btn btn-primary icon product_cart_button"  id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)" title="Add Cart">
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
                                    <h4 class="text-danger text-center">
                                        @if (session()->get('language') == 'bangla') 
                                        দুঃখিত কোনো পণ্য পাওয়া যায়নি
                                        @else
                                        Opps..! No Products Found                                      
                                        @endif 
                                </h4>                                       
                                   
                                @endforelse		
								</div><!-- /.row -->
							</div><!-- /.category-product -->
						
                        </div><!-- /.tab-pane -->
                        
				{{-- list continer start 	 --}}
						<div class="tab-pane "  id="list-container">
							<div class="category-product">
						@foreach ($products as $product)							
                            <div class="category-product-inner wow fadeInUp">
                                <div class="products">				
                                    <div class="product-list product">
                                        <div class="row product-list-row">
                                            <div class="col col-sm-4 col-lg-4">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <img src="{{ asset($product->image_one) }}" alt="">
                                                    </div>
                                                </div><!-- /.product-image -->
                                            </div><!-- /.col -->
                                            <div class="col col-sm-8 col-lg-8">
                                                <div class="product-info">
                                                    @if (session()->get('language') == 'bangla')
                                                    <h3 class="name"><a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_bn) }}">{{ $product->product_name_bn }}</a>
                                                    </h3>
                                                    @else
                                                    <h3 class="name"><a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en) }}">{{ ucwords($product->product_name_en) }}</a>
                                                    </h3>
                                                    @endif
                                                    <div class="rating rateit-small"></div>
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
                                                    <div class="description m-t-10">
                                                        @if (session()->get('language') == 'bangla')
                                                        {!! Str::words($product->short_description_en,50,'..') !!}
                                                         @else  
                                                         {!! Str::words($product->short_description_en,50,'..') !!} 
                                                        @endif
                                                    </div>
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
																	<button  class="btn btn-primary icon product_cart_button" 
																	id="{{ $product->id }}" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)"  title="Add Cart">
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
                                                </div><!-- /.product-info -->	
                                            </div><!-- /.col -->
                                        </div><!-- /.product-list-row -->
                                        @php
                                        $amount = $product->selling_price-$product->discount_price;
                                        $discount = $amount/$product->selling_price *100;
                                        @endphp
                                        @if ($product->discount_price == NULL)
                                        <div class="tag new">
                                            <span>New</span>
                                        </div>
                                        @else
                                        <div class="tag new">
                                            @if (session()->get('language') == 'bangla')
                                            <span>{{ bn_price(round($discount)) }}%</span>
                                            @else
                                            <span>{{ round($discount) }}%</span>
                                            @endif
                                        </div>		
                                        @endif		
                                    </div><!-- /.product-list -->
                                </div><!-- /.products -->
                            </div><!-- /.category-product-inner -->
                        @endforeach								
						</div><!-- /.category-product -->
					</div><!-- /.tab-pane #list-container -->
				</div><!-- /.tab-content -->
			<div class="clearfix filters-container">					
							<div class="text-right">
                                {{ $products->links() }}
                            </div><!-- /.text-right -->						
					</div><!-- /.filters-container -->
				</div><!-- /.search-result-container -->
			</div><!-- /.col -->
		</div><!-- /.row -->
<!-- ==================================== BRANDS CAROUSEL =============================== -->
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
<!-- ===================== BRANDS CAROUSEL : END ==================== -->	
</div><!-- /.container -->

</div><!-- /.body-content -->

@endsection