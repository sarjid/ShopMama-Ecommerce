
<!DOCTYPE html>
<html lang="en">
    @php
    $categories = App\Category::where('status',1)->orderBy('category_name_en','ASC')->get();
    $seo = App\Seo::findOrFail(1);
@endphp
<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="{!! $seo->meta_description !!}">
		<meta name="author" content="{{ $seo->meta_author }}">
	    <meta name="keywords" content="{{ $seo->meta_keywords }}">
	    <meta name="robots" content="all">
	    <title>ShopMama | @yield('title')</title>
	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/bootstrap.min.css">
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/main.css">
	    <link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/blue.css">
	    <link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/owl.carousel.css">
		<link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/owl.transitions.css">
		<link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/animate.min.css">
		<link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/rateit.css">
        <link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/bootstrap-select.min.css">
        <link href="{{ asset('fontend') }}/assets/css/lightbox.css" rel="stylesheet">
        <!-- Icons/Glyphs -->
        <link rel="stylesheet" href="{{ asset('fontend') }}/assets/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/lib/toastr/toastr.css">        
        <!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>
    
	<body class="cnt-home">
  
       
		<!-- ================ HEADER ========================== -->
<header class="header-style-1">

   
<!-- ========================= TOP MENU ============================================== -->
<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">
                    <li><a href="" data-toggle="modal" data-target="#exampleModal"></i>Order Track</a></li>
                    @if (session()->get('language') == 'bangla')
                     <li><a href="{{ url('cart/page') }}"><i class="icon fa fa-shopping-cart"></i>কার্ট</a></li>
                    @else                     
                      <li><a href="{{ url('cart/page') }}"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                      @endif
                    @guest
                      @else
                      @if (session()->get('language') == 'bangla')
                      <li><a href="{{ route('wishlist.page') }}"><i class="icon fa fa-heart"></i>পছন্দের তালিকা</a></li>	
                     @else 
                     <li><a href="{{ route('wishlist.page') }}"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                    				
                     @endif
                    @endguest
                   @guest
                        @if (session()->get('language') == 'bangla')
                        <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>লগইন / নিবন্ধন</a></li>
                        @else 
                        <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Login / Register</a></li>
                        @endif
                    @else
                        @if (session()->get('language') == 'bangla')
                        <li><a href="{{ url('home') }}"><i class="icon fa fa-lock"></i>প্রোফাইল</a></li>
                        @else
                        <li><a href="{{ url('home') }}"><i class="icon fa fa-lock"></i>My Profile</a></li>
                        @endif
                   @endguest
					
				</ul>
			</div><!-- /.cnt-account -->

			<div class="cnt-block">
				<ul class="list-unstyled list-inline">
					
					<li class="dropdown dropdown-small">
                     @if (session()->get('language') == 'bangla')
                        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">ভাষা পরিবর্তন করুন</span><b class="caret"></b></a>
                    @else 
                    <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">Language</span><b class="caret"></b></a>
                    @endif                    
						<ul class="dropdown-menu">
                            @if (session()->get('language') == 'bangla')
                            <li><a href="{{ route('language.english') }}">English</a></li>
                            @else
                            <li><a href="{{ route('language.bangla') }}">বাংলা</a></li>
                            @endif
						</ul>						
				</ul><!-- /.list-unstyled -->
			</div><!-- /.cnt-cart -->
			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->
<!-- ============================ TOP MENU : END ================================== -->
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
<!-- =========================== LOGO ========================= -->
@php
    $setting = App\Setting::findOrFail(1);
@endphp
<div class="logo">
    @if (session()->get('language') == 'bangla')
    <a href="{{ url('/') }}">		
		<img src="{{ asset('fontend') }}/assets/images/bangla_logo.png" alt="">
    </a>
    @else 
	<a href="{{ url('/') }}">		
		<img src="{{ asset($setting->logo) }}" alt="">
    </a>
    @endif
</div><!-- /.logo -->
<!-- =========================================== LOGO : END ======================= -->				
</div><!-- /.logo-holder -->

				<div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
					<!-- /.contact-row -->
<!-- ============================= SEARCH AREA ======================================= -->
<div class="search-area">
    <form action="{{ route('search') }}" method="POST">
        @csrf
        <div class="control-group">

            <ul class="categories-filter animate-dropdown">
                <li class="dropdown">

                    <a class="dropdown-toggle"  data-toggle="dropdown" href="">
                        @if (session()->get('language') == 'bangla')
                        ক্যাটাগরি
                        @else
                        Categories 
                        @endif
                        <b class="caret"></b></a>

                    <ul class="dropdown-menu" role="menu" >
                        @foreach ($categories as $row)
                        @if (session()->get('language') == 'bangla')
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="">{{ $row->category_name_bn }}</a></li>
                        @else
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="">{{ $row->category_name_en }}</a></li>
                        @endif
                        @endforeach
                      

                    </ul>
                </li>
            </ul>
        
        
            <input class="search-field" name="search" required @if (session()->get('language') == 'bangla') placeholder="অনুসন্ধান করুন..."  @else  placeholder="Search here..." @endif />

            <button type="submit" class="search-button"></button>    

        </div>
    </form>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

   <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
    <!-- =========================================== SHOPPING CART DROPDOWN ============================== -->
    @php
        $carts = App\Cart::latest()->where('ip_address',request()->ip())->get();
        $total = App\Cart::all()->where('ip_address',request()->ip())->sum(function($t){
            return $t->price * $t->quantity;
        });
 
    @endphp
	<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
            <div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count" id="countqty"></span></div>
				<div class="total-price-basket">
					<span class="lbl">@if (session()->get('language') == 'bangla')কার্ট @else cart @endif-</span>
					<span class="total-price">
						    <span class="sign" style="font-size: 15px;">৳</span><span class="value"  id="showprice"></span>                          
					</span>
				</div>
				
			
		    </div>
		</a>
		<ul class="dropdown-menu">
			<li>

                {{-- @foreach ($carts as $cart) --}}
				{{-- <div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-4">
							<div class="image">
								<a href="detail.html"><img src="{{ asset($cart->product->image_one) }}" alt=""></a>
							</div>
						</div>
						<div class="col-xs-7">
							
							<h3 class="name"><a href="index8a95.html?page-detail">{{ $cart->product->product_name_en }}</a></h3>
							<div class="price">${{ $cart->price }} X {{ $cart->quantity }} </div>
						</div>
						<div class="col-xs-1 action">
							<a href="{{ url('cart/remove/product/'.$cart->id) }}"><i class="fa fa-trash"></i></a>
                        </div>
                        
					</div>
                </div><!-- /.cart-item -->
                <hr>
                <div class="clearfix"></div> --}}
                {{-- @endforeach --}}

            {{-- header cart products  --}}
              <div id="cart">

              </div>
            {{-- end header cart products  --}}
					
		
			<div class="clearfix cart-total">
				<div class="pull-right">
                        <span class="text">Sub Total :</span>$<span class='price' id="subtotal"></span>
				</div>
				<div class="clearfix"></div>
					
				<a href="{{ url('cart/page') }}"  class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a>	
            </div><!-- /.cart-total-->
            {{-- {{ route('cart.page') }} --}}
            {{-- onclick="routeCart()" --}}
				
		</li>
		</ul><!-- /.dropdown-menu-->
	</div><!-- /.dropdown-cart -->

<!-- ========== SHOPPING CART DROPDOWN : END========================== -->				
</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div><!-- /.main-header -->

	<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
		<ul class="nav navbar-nav">
			<li class="dropdown yamm-fw @yield('home')">
                <a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                    @if (session()->get('language') == 'bangla') হোম @else Home @endif</a>
			</li>
            @foreach ($categories as $row)                   
			<li class="dropdown yamm mega-menu">
                @if (session()->get('language') == 'bangla')
                <a href="" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $row->category_name_bn }}</a>
                @else
                <a href="" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $row->category_name_en }}</a>
                @endif
            <ul class="dropdown-menu container">
            <li>
               <div class="yamm-content ">
                <div class="row">
                    @php
                       $subcategories = App\Subcategory::where('category_id',$row->id)->where('status',1)->orderBy('subcategory_name_en','ASC')->get();
                    @endphp  
                    @foreach ($subcategories as $subcat)                       
                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                        @if (session()->get('language') == 'bangla')
                        <a href="{{ url('subcategory/products/'.$subcat->id.'/'.$subcat->subcategory_slug_bn) }}"><h2 class="title">{{ $subcat->subcategory_name_bn }}</h2></a>
                        @else
                        <a href="{{ url('subcategory/products/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}"><h2 class="title">{{ $subcat->subcategory_name_en }}</h2></a>
                        @endif
                        @php
                            $subsubcategories = App\Subsubcategory::where('category_id',$row->id)->where('subcategory_id',$subcat->id)->where('status',1)->orderBy('subsubcategory_name_en','ASC')->get();
                        @endphp
                        @foreach ($subsubcategories as $subsubcat)                          
                        <ul class="links">
                           @if (session()->get('language') == 'bangla')
                           <li>
                            <a href="{{ url('sub-subcategory/products/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_bn) }}">{{ $subsubcat->subsubcategory_name_bn }}</a>
                        </li>
                           @else
                            <li>
                                <a href="{{ url('sub-subcategory/products/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_en) }}">{{ $subsubcat->subsubcategory_name_en }}</a>
                            </li>
                            @endif                                                    
                        </ul>
                        @endforeach
                    </div><!-- /.col -->                
                    @endforeach                                            
                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                        <img class="img-responsive" src="{{ asset('fontend') }}/assets/images/banners/top-menu-banner.jpg" alt="">                            
                    </div><!-- /.yamm-content -->					
                </div>
            </div>

            </li>
		</ul>
				
    </li>
    @endforeach

    <li class="dropdown hidden-sm @yield('blog')">
        <a href="{{ url('blog') }}"> @if (session()->get('language') == 'bangla')ব্লগ @else Blog @endif</a>
    </li>	
    
    <li class="dropdown hidden-sm @yield('contact')">
        <a href="{{ url('contact-us') }}"> @if (session()->get('language') == 'bangla')যোগাযোগ @else Contact @endif</a>
    </li>	
		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div><!-- /.nav-outer -->
	</div><!-- /.navbar-collapse -->
	</div><!-- /.nav-bg-class -->
	</div><!-- /.navbar-default -->
	</div><!-- /.container-class -->
	</div><!-- /.header-nav -->
<!-- ============================== NAVBAR : END ==================================== -->
</header>
 
	@yield('content')

<!-- ========================================= FOOTER ===================================== -->

<footer id="footer" class="footer color-bg">
    @php
    $setting = App\Setting::findOrFail(1);
    @endphp
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Contact Us</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
        <ul class="toggle-footer" style="">
            <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                            <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p>{{ $setting->address }}</p>
                </div>
            </li>

              <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p>{{ $setting->phone_no_one }}<br>{{ $setting->phone_no_two }}</p>
                </div>
            </li>

              <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <span><a href="#">{{ $setting->email }}</a></span>
                </div>
            </li>
              
            </ul>
    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Customer Service</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="{{ route('home') }}" title="Contact us">My Account</a></li>
                <li><a href="{{ url('user/orders') }}" title="About us">Order History</a></li>
                <li><a href="#" title="faq">FAQ</a></li>
                <li><a href="#" title="Popular Searches">Specials</a></li>
                <li class="last"><a href="#" title="Where is my order?">Help Center</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Corporation</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                          <li class="first"><a title="Your Account" href="#">About us</a></li>
                <li><a title="Information" href="#">Customer Service</a></li>
                <li><a title="Addresses" href="#">Company</a></li>
                <li><a title="Addresses" href="#">Investor Relations</a></li>
                <li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div><!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="module-heading">
                        <h4 class="module-title">Why Choose Us</h4>
                    </div><!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="#" title="About us">Shopping Guide</a></li>
                <li><a href="{{ url('blog') }}" title="Blog">Blog</a></li>
                <li><a href="#" title="Company">Company</a></li>
                <li><a href="#" title="Investor Relations">Investor Relations</a></li>
                <li class=" last"><a href="{{ url('contact-us') }}" title="Suppliers">Contact Us</a></li>
                        </ul>
                    </div><!-- /.module-body -->
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding social">
                <ul class="link">
                  <li class="fb pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->facebook_link }}" title="Facebook"></a></li>
                  <li class="tw pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->twitter_link }}" title="Twitter"></a></li>
                  <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->instagram_link }}" title="PInterest"></a></li>
                  <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->linkedin_link }}" title="Linkedin"></a></li>
                
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods">
                    <ul>
                        <li><img src="{{ asset('fontend') }}/assets/images/payments/1.png" alt=""></li>
                        <li><img src="{{ asset('fontend') }}/assets/images/payments/2.png" alt=""></li>
                        <li><img src="{{ asset('fontend') }}/assets/images/payments/3.png" alt=""></li>
                        <li><img src="{{ asset('fontend') }}/assets/images/payments/rocket.png" alt="" style="height: 30px; width:40px;"" ></li>
                        <li><img src="{{ asset('fontend') }}/assets/images/payments/bkash.png" alt="" style="height: 30px; width:40px; background:white;"></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div>
    </div>
</footer>
<!-- ================================ FOOTER : END=============================-->
  <!--order tracking  modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Track Your Order</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		<form action="{{ url('order/track') }}" method="POST">
			@csrf
		<div class="form-group">		
		  <input type="text" class="form-control" name="invoice_no" placeholder="invoice no" data-validation="required" required>
        </div>
		  <button type="submit" class="btn btn-sm btn-primary">Track Now</button>
		</div>
	</form>		
	  </div>
	</div>
  </div>
  {{-- order tracking  modal end  --}}
    {{-- <Eglish Modal  --}}
    <div class="modal fade " id="cartmodal" tabindex="-1" >
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" style="font-size: 35px; color:red;" class="close" data-dismiss="modal" id="closeModal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
            </button>
            </div>
            <div class="modal-body">		
            <div class="row">
            {{-- <form action="{{ url('cart/add/'.$product->id) }}" method="POST">
                @csrf --}}
                
                <div class="col-md-4">
                    <div class="card" style="width: 16rem;">
                    <img src="" class="card-img-top" id="pimage" style="height: 240px;">
                    <div class="card-body">		
                    </div>
                </div>
                </div>
                <div class="col-md-4 ml-auto">
                    <ul class="list-group">
                    <li class="list-group-item"> <h5 class="card-title"><strong id="pname"></strong></h5></span></li>
                    <li class="list-group-item">Price: 
                        <strong class="text-danger">$<span id="pprice"></span> </strong>
                        <del id="oldprice">$</del>
                    </li>
                
                <li class="list-group-item">Product code: <span id="pcode"></span></li>
                    <li class="list-group-item">Category:  <span id="pcat"></span></li>
                    <li class="list-group-item">Brand: <span id="pbrand"></span></li>
                    <li class="list-group-item">Stock: <span class="badge" style="background: green; color:white;" id="aviable"></span>
                        <span class="badge" style="background: red; color:white;" id="stockout">$</span>
                    </li>
                        
                </ul>
                </div>
                <div class="col-md-4 ">
                
                        <div class="form-group" id="colordiv">
                            <label for="">Color</label>
                            <select name="color" class="form-control" id="color" >
                            
                            </select>
                        </div>
                
                    <div class="form-group" id="sizediv" >
                        <label for="exampleInputEmail1">Size</label>
                        <select name="size" class="form-control" id="size">
                            
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">Quantity</label>
                        <input type="number" id="qty" class="form-control" value="1" min="1" name="qty">
                    </div>
                    <input type="hidden" id="product_id">
                    <button type="submit"  onclick="addToCart()" class="btn btn-primary addcart">Add To Cart</button>
                </div>
            {{-- </form> --}}
            </div>
            </div>
        </div>
        </div>
    </div> 
    
    {{-- modal end --}}

   

	<!-- JavaScripts placed at the end of the document so the pages load faster -->
	<script src="{{ asset('fontend') }}/assets/js/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('fontend') }}/assets/js/bootstrap.min.js"></script>

	<script src="{{ asset('fontend') }}/assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="{{ asset('fontend') }}/assets/js/owl.carousel.min.js"></script>
	<script src="{{ asset('fontend') }}/assets/js/echo.min.js"></script>
	<script src="{{ asset('fontend') }}/assets/js/jquery.easing-1.3.min.js"></script>
	<script src="{{ asset('fontend') }}/assets/js/bootstrap-slider.min.js"></script>
    <script src="{{ asset('fontend') }}/assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="{{ asset('fontend') }}/assets/js/lightbox.min.js"></script>
    <script src="{{ asset('fontend') }}/assets/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('fontend') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('fontend') }}/assets/js/scripts.js"></script>
    <script src="{{asset('fontend')}}/sweetalert2@8.js"></script>
    <script src="{{ asset('backend')}}/lib/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('backend')}}/lib/sweetalert/sweetalertCode.js"></script>
    <script type="text/javascript" src="{{ asset('backend') }}/lib/jquery.form-validator.min.js"></script>
    <script>
        $.validate({
          lang: 'en'
        });
      </script>
    <script type="text/javascript" src="{{ asset('backend') }}/lib/toastr/toastr.min.js"></script>
    <script>
      @if(Session::has('message'))
         type ="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                toastr.info(" {{Session::get('message')}} ");
                break;

            case 'success':
                toastr.success(" {{Session::get('message')}} ");
                break;
                
            case 'warning':
                toastr.warning(" {{Session::get('message')}} ");
                break;

            case 'error':
                toastr.error(" {{Session::get('message')}} ");
                break;       
        }  
        
    @endif
    </script>

	
{{-- <script src="{{asset('fontend')}}/jquery.min.js"></script> --}}
<script type="text/javascript">
	  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
//start product view in modal
	function productview(id){
       
			$.ajax({
                     type:"GET",
                     dataType:"json",
					url: "/cart/product/view/"+id,

                    beforeSend: function(){
                        $('#loader').show();
                    },
                     success:function(data) {
                       $("#qty").val(1);
                       $('#pname').text(data.product.product_name_en);
                       $('#pimage').attr('src','/'+data.product.image_one);
					  
                       $('#pcat').text(data.product.category_name_en);
                       $('#psubcat').text(data.product.subcategory_name_en);
                       $('#pbrand').text(data.product.brand_name_en);
                       $('#pcode').text(data.product.product_code);
                       $('#product_id').val(id);
                     

					//    jodi discount price null thake and seeling price and discount price
						if (data.product.discount_price == null) {
							$('#pprice').text('');
							$('#oldprice').text('');
							$('#pprice').text(data.product.selling_price);
                            
						}else{
						
							$('#pprice').text(data.product.discount_price);
							$('#oldprice').text(data.product.selling_price);
						}

						// product stock 
						if (data.product.product_quantity > 0) {
							$('#stockout').text('');
							$('#aviable').text('');
							$('#aviable').text('aviable');
						}else{
							$('#stockout').text('');
							$('#aviable').text('');
							$('#stockout').text('stockout');
						}

                        var d =$('select[name="size"]').empty();
                         $.each(data.size, function(key, value){
                             $('select[name="size"]').append('<option value="'+ value +'">' + value + '</option>');
							 if (data.size == "") {
                                     $('#sizediv').hide();   
                              }else{
                                    $('#sizediv').show();
                              } 

                         });

                        var d =$('select[name="color"]').empty(); 
                         $.each(data.color, function(key, value){
                             $('select[name="color"]').append('<option  value="'+ value +'">' + value + '</option>');

                         });
             	},
                 //success end
                 complete: function(data){
                    $('#loader').hide();
                 }
			})
	}
// product view end

// start store cart product 
	function addToCart(){
		var id    = $('#product_id').val();
		var price = $('#pprice').text();
		// var color = $('#color').text();
		var color = $("#color option:selected").text();
		// var size = $('#size').text();
		var size = $("#size option:selected").text();
		var quantity = $("#qty").val();
    
		$.ajax({
                type: "POST",
                dataType: "json",
                data: {
					"_token": "{{ csrf_token() }}",
					price:price, color:color, size:size, quantity:quantity
					},
                url: "/cart/store/data/"+id,
				success:function(data) {
					viewData();
                    $("#qty").val(1);
					$('#closeModal').click();
                    //  start message 
                     const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      })

                     if($.isEmptyObject(data.error)){
                          Toast.fire({
                            type: 'success',
                            title: data.success
                          })
                     }else{
                           Toast.fire({
                              type: 'error',
                              title: data.error
                          })
					 }
                    //  end message 
										
                   },
            })
	
		
	}
// end store cart product 

</script>

{{--start show all cart in header product  --}}
<script type="text/javascript">
        function viewData(){  
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/show/cart/product/header",
                success: function (response){
                    var html = ""
                    $('#showprice').text(response.total);
                    $('#countqty').text(response.countqty);
                    $('#subtotal').text(response.total);
                    $.each(response.cart, function(key, value){
                    //image pelam = value.product.image_one; // product table er sathe join ache
                    //product name pelam = value.product.product_name_en; //product table join ache
                    //product er price pelam = value.price;
                    //product er quantity pelam = value.quantity;

                    html += `<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-4">
							<div class="image">
								<a href="detail.html"><img src="/${value.product.image_one}" alt=""></a>
							</div>
						</div>
						<div class="col-xs-7">
							<h3 class="name"><a href="index8a95.html?page-detail">${value.product.product_name_en}</a></h3>
							<div class="price">${value.price} <span class="text-info">X</span> ${value.quantity} = ${value.price * value.quantity} </div>
						</div>
						<div class="col-xs-1 action">
							<button type="submit" onclick="removeCart(${value.id})"><i class="fa fa-trash"></i></button>
                        </div>
                        
					</div>
                </div><!-- /.cart-item -->
                <hr>
                <div class="clearfix"></div>`  
                        
                    });

                    $("#cart").html(html);
                    
                }
            });

        }
        viewData();

        //start remove product from cart 
        function removeCart(id){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/cart/remove/product/"+id,
                success: function(data){
                    viewData();
                    getCartProduct();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      })

                     if($.isEmptyObject(data.error)){
                          Toast.fire({
                            type: 'success',
                            title: data.success
                          })
                     }else{
                           Toast.fire({
                              type: 'error',
                              title: data.error
                          })
					 }
                    //  end messag
                }

            })
        }
        //end remove product from cart 

 </script>
 {{--end show all cart product  --}}

 
 {{-- start addto wishlist start  --}}
 <script type="text/javascript">
    function addToWishlist(id){
        var id = id;
        $.ajax({
            type:"GET",
            dataType:"json",
            url: "/add/wishlist/"+id,
            success: function(data){
                 //  start message 
                 const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      })

                     if($.isEmptyObject(data.error)){
                          Toast.fire({
                            type: 'success',
                            title: data.success
                          })
                     }else{
                           Toast.fire({
                              type: 'error',
                              title: data.error
                          })
					 }
                    //  end message 
            }
        })
    }
 </script>
 {{-- endt addto wishlist  --}}

</body>



</html>
