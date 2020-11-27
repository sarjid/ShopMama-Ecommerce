@extends('layouts.fontend_master')
@section('title') Chekout page @endsection
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
                <li><a href="home.html">ইউজার</a></li>
				<li class='active'>চেকআউট</li>
                @else 
                <li><a href="home.html">User</a></li>
				<li class='active'>Checkout</li>
                @endif
				
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">		
                                            <div class="table-responsive">
                                                <table class="table">
                                                <tbody>                     
                                                        <tr>
                                                            <td class="col-md-1">
                                                                <label for="">@if (session()->get('language') == 'bangla')পণ্যের ছবি @else Image @endif</label>
                                                            </td>
                                                            <td class="col-md-3">
                                                            <label for="">@if (session()->get('language') == 'bangla') পণ্যের নামে @else Poduct Name @endif</label>                                 
                                                            </td>             

                                                            <td class="col-md-2">
                                                                <label for="">@if (session()->get('language') == 'bangla') কালার @else Color @endif</label>
                                                            </td>

                                                            <td class="col-md-2">
                                                                <label for="">@if (session()->get('language') == 'bangla')সাইজ @else Size @endif</label>
                                                            </td>

                                                            <td class="col-md-2">
                                                                <label for="">@if (session()->get('language') == 'bangla') পরিমাণ @else Quantity @endif</label>
                                                            </td>
                                                        
                                                            <td class="col-md-1">                                                                   
                                                                <label for="">@if (session()->get('language') == 'bangla')মুল্য @else Price @endif</label>
                                                            </td>

                                                        </tr>
                                                                        
                                                    @foreach ($carts as $cart)
                                                        <tr>
                                                            <td class="col-md-1"><img src="{{ asset($cart->product->image_one) }} " height="50px;" width="50px;" alt="imga"></td>
                                                            <td class="col-md-3">
                                                                <div class="product-name"><strong>{{ $cart->product->product_name_en }}</strong>
                                                                </div>                                      
                                                                <div class="price">
                                                                    @if ($cart->product->discount_price == NULL)
                                                                    <strong class="text-danger">${{ $cart->product->selling_price }}</strong>
                                                                    @else 
                                                                    <strong class="text-danger">${{ $cart->product->discount_price }}</strong>
                                                                    <del>${{ $cart->product->selling_price }}</del>
                                                                    @endif
                                                                </div>
                                                            </td>             
                            
                                                            <td class="col-md-2">
                                                            <strong>{{ $cart->color }}</strong>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                            <strong>{{ $cart->size }}</strong>
                                                            </td>
                            
                                                            <td class="col-md-2">
                                                            <strong>{{ $cart->quantity }} pices</strong>
                                                            </td>
                                                        
                                                            <td class="col-md-1">                                  @if (session()->get('language') == 'bangla')
                                                                <strong>${{ bn_price($cart->price * $cart->quantity) }}</strong>
                                                            @else                                                                         
                                                            <strong>${{ $cart->price * $cart->quantity }}</strong>
                                                            @endif          

                                                            </td>
                            
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>			
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->					  	
					     </div><!-- /.checkout-steps -->
				    </div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title text-center">@if (session()->get('language') == 'bangla') সর্বমোট অর্ডার @else Your Total Order @endif</h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">
                                        <h4 class="text-center" style="margin-top: 5px;"><strong>Sub Total: </strong>${{ $total }}</h4>
                                        @if (Session::has('coupon'))
                                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Coupon: </strong>{{ session()->get('coupon')['coupon_name'] }}</h4>
                                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Discount( {{ session()->get('coupon')['discount'] }}% ): </strong>-${{ round(session()->get('coupon')['coupon_balance']) }}</h4>
                                        <hr>
                                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Order Total: </strong>${{ round($total - session()->get('coupon')['coupon_balance']) }}</h4>
                                        @else
                                        @endif                                         
                                    </ul>			
								</div>
                                        <div class="" style="margin-top: 5px;" >
                                            <img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg"  alt="Image">
                                        </div> 
                            </div>
						</div>
                    </div> 
                    					
<!-- checkout-progress-sidebar -->
			    </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-md-12">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <!-- panel-body  -->
                                    <h3>
                                        @if (session()->get('language') == 'bangla')
                                       শিপিং ঠিকানা
                                        @else
                                        Shipping Address
                                        @endif 
                                   </h3>
                                    <div class="panel-body">
                                    <form action="{{ route('payment.process') }}" method="POST">
                                        @csrf
                                        <div class="row">		
                                           <div class="col-md-4">
                                             <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') সম্পুর্ণ নাম @else Full Name @endif<span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="shipping_name" placeholder="Your Name" value="{{ Auth::user()->name }}" data-validation="required">
                                                @error('shipping_name')
                                                <strong class="text-danger">{{$message}}</strong>
                                                @enderror 
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla')ইমেইল ঠিকানা @else Email Address @endif<span>*</span></label>
                                               <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email Address" value="{{ Auth::user()->email }}" data-validation="required">
                                               @error('shipping_email')
                                               <strong class="text-danger">{{$message}}</strong>
                                               @enderror 
                                             </div>
                                          </div>

                                          <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') মুঠোফোন নাম্বার @else Mobile No. @endif<span>*</span></label>
                                               <input type="text" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="phone number" value="{{ Auth::user()->phone }}" data-validation="required">
                                               @error('shipping_phone')
                                               <strong class="text-danger">{{$message}}</strong>
                                               @enderror 
                                             </div>
                                          </div><div class="col-md-4">
                                            <div class="form-group">
                                               <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') বিভাগ নির্বাচন করুন @else Select Division @endif<span>*</span></label>
                                               <select name="division_id" class="form-control select2-show-search" data-placeholder="Choose one" data-validation="required">
                                                <option label="Choose one"></option>
                                                @foreach ($divisions as $division)                                      
                                                 <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                                @endforeach
                                              </select>
                                            @error('division_id')
                                            <strong class="text-danger">{{$message}}</strong>
                                            @enderror     
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') জেলা নির্বাচন করুন @else Select District @endif<span>*</span></label>
                                               <select name="district_id" class="form-control select2-show-search" data-placeholder="Choose one" data-validation="required">
                                                <option label="Choose one"></option>
                                            
                                              </select>
                                              @error('district_id')
                                              <strong class="text-danger">{{$message}}</strong>
                                              @enderror  
                                             </div>
                                          </div><div class="col-md-4">
                                            <div class="form-group">
                                               <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla')কাছের স্থান @else Select Near State @endif<span>*</span></label>
                                               <select name="state_id" class="form-control select2-show-search" data-placeholder="Choose one" data-validation="required">
                                                <option label="Choose one"></option>
                                            
                                              </select>
                                              @error('state_id')
                                              <strong class="text-danger">{{$message}}</strong>
                                              @enderror  
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') পোস্ট কোড @else Post Code @endif <span>*</span></label>
                                               <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="post code" value="{{ old('post_code') }}" data-validation="required" >
                                               @error('post_code')
                                               <strong class="text-danger">{{$message}}</strong>
                                               @enderror  
                                             </div>
                                          </div>

                                          <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="info-title" for="exampleInputEmail1">@if (session()->get('language') == 'bangla') নোটস @else Notes: @endif(optional)</label> <br>
                                              <textarea name="notes" id="exampleInputEmail1" cols="40" rows="4" placeholder="write something">{{ old('notes') }}</textarea>
                                             </div>
                                          </div>

                                          <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="info-title" for="exampleInputEmail1"><strong><h4>@if (session()->get('language') == 'bangla') পেমেন্ট মাধ্যম নির্বাচন করুন @else Select Payment Method @endif</h4></strong></label> <br>
                                             
                                                    <ul class="logos_list">
                                                        <li>
                                                            <input type="radio" name="payment" checked title="Stripe"  value="Stripe">
                                                            <img src="{{ asset('fontend') }}/assets/images/payments/4.png" height="28px" width="46px;" alt=""></a>
                                                        </li>
                                                        <li style="margin-top: 5px;">
                                                            <input type="radio" name="payment" title="Rocket"  value="Rocket">
                                                            <img src="{{ asset('fontend') }}/assets/images/payments/rocket.png" height="28px" width="46px;" alt=""></a>
                                                        </li>
                                                        <li style="margin-top: 5px;">
                                                            <input type="radio" name="payment" title="Bkash" value="Bkash">
                                                            <img src="{{ asset('fontend') }}/assets/images/payments/bkash.png" height="28px" width="56px;" alt="">
                                                        </li>                                                       
                                                </ul>
                        
                                                @error('payment')
                                                <span class="text-danger">{{$message}}</span>
                                                 @enderror
                                                
                                             </div>
                                          </div>
                                        </div>	                                      
                                     <button class="btn btn-primary pull-right" type="submit">@if (session()->get('language') == 'bangla')পরবর্তী ধাপ @else Next Step @endif</button>
                                    </form>
                                    </div>
                               
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->					  	
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

<script src="{{asset('backend')}}/lib/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
      
<script type="text/javascript">
        $(document).ready(function() {
          $('select[name="division_id"]').on('change', function(){
              var division_id = $(this).val();
              if(division_id) {
                  $.ajax({
                      url: "{{  url('checkout/get/district/') }}/"+division_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         var d =$('select[name="district_id"]').empty();
                            $.each(data, function(key, value){
      
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
      
                            });
      
                      },
      
                  });
              } else {
                  alert('select district name');
              }
      
          });

          $('select[name="district_id"]').on('change', function(){
              var district_id = $(this).val();
              if(district_id) {
                  $.ajax({
                      url: "{{  url('checkout/get/state/') }}/"+district_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         var d =$('select[name="state_id"]').empty();
                            $.each(data, function(key, value){
      
                                $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
      
                            });
      
                      },
      
                  });
              } else {
                  alert('select District name');
              }
      
          });
          
      });
      
      </script>   
@endsection