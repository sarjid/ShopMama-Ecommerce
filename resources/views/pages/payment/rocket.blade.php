@extends('layouts.fontend_master')
@section('title') Rocket Payment @endsection
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
				<li><a href="home.html">User</a></li>
				<li class='active'>Payment</li>
				<li class='active'>Rocket</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
            <div class="row">
                <form action="{{ url('rocket/order/store') }}" method="post">
                    @csrf
                <div class="col-md-4">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title text-center">
										@if (session()->get('language') == 'bangla')
										টোটাল পেমেন্ট
										@else
										Payment Total
										@endif
									</h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">
                                        <h4 class="text-center" style="margin-top: 5px;"><strong>Sub total: </strong>৳{{  round($total)  }} </h4>
                                    @if (Session::has('coupon'))
                                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Coupon: </strong>{{ session()->get('coupon')['coupon_name'] }}</h4>
                                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Discount( {{ session()->get('coupon')['discount'] }}% ): </strong>-৳{{ round(session()->get('coupon')['coupon_balance']) }}</h4>                                   
										<h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong> Total: </strong>৳{{ $ort = round($total - session()->get('coupon')['coupon_balance']) }} + ৳{{$rkcrg = round($ort*0.0185) }}</h4>
										<small class="text-danger" style="margin-left: 80px;">Per 1K Rocket Charge 18.50tk ( ৳{{ $rkcrg }} )</small> <hr>
                                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong> Paying Amount: </strong>৳{{ $pay = ($ort + $rkcrg) }} </h4>
                                    @else
										<h4 class="text-center" style="margin-top: 5px;"><strong>Rocket Charge: ৳{{ round($total*0.0185) }}</strong></h4>
										<small class="text-danger" style="margin-left: 80px;">Per 1K Rocket Charge 18.50tk ( ৳{{ round($total*0.0185) }} )</small>
										<hr>
                                        <h4 class="text-center" style="margin-top: 5px;"><strong>Paying Amount: </strong>৳{{ $pay = round($total + ($total * 0.0185)) }} </h4>
                                    @endif   
                                                                 
                                    </ul>			
								</div>
                            </div>
						</div>
                    </div> 
                    <!-- checkout-progress-sidebar -->
                </div>
                <input type="hidden" value="{{ $pay }}" name="paying_amount">
                <input type="hidden" value="{{ $total }}" name="subtotal">
                <input type="hidden" value="{{ $data['shipping_name'] }}" name="shipping_name">
                <input type="hidden" value="{{ $data['shipping_email'] }}" name="shipping_email">
                <input type="hidden" value="{{ $data['shipping_phone'] }}" name="shipping_phone">
                <input type="hidden" value="{{ $data['division_id'] }}" name="division_id">
                <input type="hidden" value="{{ $data['district_id'] }}" name="district_id">
                <input type="hidden" value="{{ $data['state_id'] }}" name="state_id">
                <input type="hidden" value="{{ $data['post_code'] }}" name="post_code">
                <input type="hidden" value="{{ $data['notes'] }}" name="notes">
                <input type="hidden" value="{{ $data['payment'] }}" name="payment">
                @if (Session::has('coupon'))
                <input type="hidden" name="coupon_discount" value="{{ session()->get('coupon')['discount'] }}">
                @else   
                @endif
                <div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <!-- panel-body  -->
                                    <h3>
										@if (session()->get('language') == 'bangla')
										রকেটের মাধ্যমে পেমেন্ট করুন
										@else 
										Payment By Rocket
										@endif
									</h3>
                                    <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla')রকেট নাম্বার @else Rocket Number @endif<span>*</span></label>
                                                <input type="text" disabled name="" id="" class="form-control" value="01776620826+9">
                                                <small class="text-danger">৳{{ $pay }} Send Money This Number</small>
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                            <div class="form-group">
												<label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') আপনার পেমেন্ট নাম্বার নাম্বার @else Your Paying Number @endif<span>*</span></label>
												<input type="text"  name="payment_number" id="exampleInputEmail1" class="form-control" value="{{ old('payment_number') }}" placeholder="i paid from this number" data-validation="required">
												@error('payment_number')
												<strong class="text-danger">{{$message}}</strong>
												@enderror 
												
                                             </div>
                                          </div>                                            
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla')ব্যালেন্স ট্রান্সেকশন আইডি @else Transaction ID @endif<span>*</span></label>
                                              <textarea name="transaction_id" id="exampleInputEmail1" cols="40" rows="5" placeholder="your payment transaction id " data-validation="required"></textarea>
                                               @error('transaction_id')
                                               <strong class="text-danger">{{$message}}</strong>
                                               @enderror 
										  </div>
									 </div>
                                    <button class="btn btn-primary pull-right" type="submit">@if (session()->get('language') == 'bangla') এখন পেমেন্ট করুন @else  Pay Now @endif</button>
                                </div>
                            </form>
                        </div><!-- row -->
                    </div>  <!-- checkout-step-01  -->					  	
				</div><!-- /.checkout-steps -->
             </div>
        </div>
	</div><!-- /.checkout-box -->
		<!-- =================== BRANDS CAROUSEL =================================== -->
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
<!-- ======================== BRANDS CAROUSEL : END =================================== -->	
</div><!-- /.container -->
</div><!-- /.body-content -->	
</div><!-- /.container -->
</div><!-- /.body-content -->
  
@endsection