@extends('layouts.fontend_master')
@section('title')
@if(session()->get('language') == 'bangla') {{ __('লগইন ও রেজিষ্টার') }} @else {{ __(' Login & Register') }} @endif @endsection
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
				@if(session()->get('language') == 'bangla')
				<li><a href="home.html">{{ __('হোম') }}</a></li>
				<li class='active'>{{ __('লগইন ও রেজিষ্টার') }}</li>
				@else 
				<li><a href="home.html">{{ __('Home') }}</a></li>
				<li class='active'>{{ __('Login & Register') }}</li>
				 @endif 
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
                <div class="col-md-6 col-sm-6 sign-in">
					@error('banned')
					<h3 class="text-danger">{{ $message }}</h3>
					@enderror

					@if (session()->get('language') == 'bangla')
					<h4 class="">লগইন করুন</h4>
					@else
					<h4 class="">Sign in</h4>
					@endif
                    <div class="social-sign-in outer-top-xs">
                        <a href="{{ url('/auth/redirect/facebook') }}" class="facebook-sign-in"><i class="fa fa-facebook"></i>@if (session()->get('language') == 'bangla') ফেসবুক দিয়ে লগইন করুন @else Sign In with Facebook @endif</a>
                        <a href="{{ url('/auth/redirect/google') }}" class="twitter-sign-in" style="margin-top: 5px;"><i class="fa fa-google"></i>@if (session()->get('language') == 'bangla') গুগল দিয়ে লগইন করুন @else Sign In with Google @endif</a>                       
                    </div>
                    <form class="register-form outer-top-xs" role="form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') ইমেইল @else Email Address @endif<span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" placeholder="@if (session()->get('language') == 'bangla') ইমেইল ঠিকানা @else email address @endif" value="{{ old('email') }}" required autocomplete="email" autofocus >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">@if (session()->get('language') == 'bangla') পাসওয়ার্ড @else Password @endif<span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input @error('email') is-invalid @enderror" name="password" id="exampleInputPassword1" placeholder="@if (session()->get('language') == 'bangla') পাসওয়ার্ড @else password @endif" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="radio outer-xs">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember me!
                            </label>
                            <a href="#" class="forgot-password pull-right">@if (session()->get('language') == 'bangla') পাসওয়ার্ড ভুলে গিয়েছি @else Forgot your Password? @endif</a>
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">@if (session()->get('language') == 'bangla') লগইন করুন @else Login @endif</button>
                    </form>					
                </div>
                <!-- Sign-in -->

        <!-- create a new account -->
        <div class="col-md-6 col-sm-6 create-new-account">
            <h4 class="checkout-subtitle">@if (session()->get('language') == 'bangla')নতুন একাউন্ট খুলুন @else Create a new account @endif</h4>
            <form class="register-form outer-top-xs" role="form" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail2">@if (session()->get('language') == 'bangla') নাম @else Name @endif<span>*</span></label>
					<input type="text" class="form-control unicase-form-control text-input @error('name') is-invalid @enderror" id="exampleInputEmail2" placeholder=" @if (session()->get('language') == 'bangla') আপনার নাম লিখুন @else your name @endif " name="name" value="{{ old('name') }}" required autocomplete="name" autofocus >
					@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
                </div>
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') ইমেইল @else Email Address @endif<span>*</span></label>
					<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="@if (session()->get('language') == 'bangla') ইমেইল ঠিকানা @else email address @endif" name="email" value="{{ old('email') }}" required autocomplete="email">
					@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				  @enderror
                </div>
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') মোবাইল নাম্বার @else Phone Number @endif<span>*</span></label>
					<input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="@if (session()->get('language') == 'bangla') ১১ সংখ্যার মোবাইল নাম্বার @else phone number @endif " name="phone" value="{{ old('phone') }}">
					@error('phone')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				  @enderror
                </div>
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') পাসওয়ার্ড @else Password @endif<span>*</span></label>
					<input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="@if (session()->get('language') == 'bangla') পাসওয়ার্ড @else password @endif" name="password" required autocomplete="new-password">
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				  @enderror
                </div>
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') কনফার্ম পাসওয়ার্ড @else Confirm Password @endif <span>*</span></label>
                    <input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="@if (session()->get('language') == 'bangla') কনফার্ম পাসওয়ার্ড @else confirm password @endif" name="password_confirmation" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">@if (session()->get('language') == 'bangla') {{ __('রেজিষ্টার করুন') }} @else {{ __('Sign Up') }} @endif </button>
            </form>
            
            
        </div>	
        <!-- create a new account -->			
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
<!-- ================== BRANDS CAROUSEL : END =================== -->	
</div><!-- /.container -->
</div><!-- /.body-content -->
@endsection