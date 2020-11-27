@extends('layouts.fontend_master')
@section('title') Card Payment @endsection
@section('content')
<script src="https://js.stripe.com/v3/"></script>
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
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
				<li class='active'>Card</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box "> 
            <div class="row">
                <div class="col-md-4">
          <!-- checkout-progress-sidebar -->
          <form action="{{ route('stripe.charge') }}" method="POST">
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title text-center">Payment Total</h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">
                    <h4 class="text-center" style="margin-top: 5px;"><strong>Sub total: </strong>৳{{  round($total)  }} </h4>
                      @if (Session::has('coupon'))
                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Coupon: </strong>{{ session()->get('coupon')['coupon_name'] }}</h4>
                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Discount( {{ session()->get('coupon')['discount'] }}% ): </strong>-৳{{ round(session()->get('coupon')['coupon_balance']) }}</h4>                             
                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong> Paying Amount: </strong>৳{{ $pay = round($total - session()->get('coupon')['coupon_balance']) }}</h4>
                      @else
                        <h4 class="text-center" style="margin-top: 5px;"><strong>Paying Amount: </strong>৳{{ $pay = round($total) }} </h4>
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
										কার্ডের মাধ্যমে পেমেন্ট করুন
										@else 
										Payment By Debit/Credit Card
										@endif 
								</h3>
                                    <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- <form action="{{ route('stripe.charge') }}" method="POST" id="payment-form"> --}}
                                             @csrf
                                            <div class="form-row">
                                                <label for="card-element">
                                                Credit or debit card
                                                </label>
                                                <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                            
                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary pull-right mt-5">Submit Payment</button>
                                            </form>
                                        </div>
                                </div>
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

<script>
    // Create a Stripe client.
var stripe = Stripe('pk_test_zuURZYgtzc5QCrAq3ITN7h2M007nb4GJy9');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection