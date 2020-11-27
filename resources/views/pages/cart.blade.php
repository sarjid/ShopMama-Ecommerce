@extends('layouts.fontend_master')
@section('title') cart page @endsection
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
                <li><a href="">হোম</a></li>
				<li class='active'>কার্ট</li>
                @else
                <li><a href="">Home</a></li>
				<li class='active'>Cart</li>
                @endif
				
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
                                    @if (session()->get('language') == 'bangla') 
                                    <th colspan="4" class="heading-title">আমার কার্ট</th>
                                    @else
                                    <th colspan="4" class="heading-title">My Cart</th>
                                    @endif
                                </tr>
                            </thead>
                         <tbody>
                            {{-- <form action="{{ url('cart/update') }}" method="POST">
                            @csrf --}}
                            @foreach ($carts as $cart)
                                
                            @endforeach
                            {{-- cart page product will be show here  --}}
                            <div id="cartPageProduct">

                            </div>
                            {{-- cart page product will be show here  --}}
                            </tbody>
                        </table>                       
                    </div>
                    {{-- <button class="btn btn-primary " type="submit">@if (session()->get('language') == 'bangla') কার্ট আপডেট @else Update Cart @endif</button> --}}
                {{-- </form> --}}
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-4 " style="margin-top: 5px;">
            </div>
         
            <div class="col-md-4 mt-2">
                @if (Session::has('coupon'))
                @else  
                <!-- checkout-progress-sidebar -->
                <div class="checkout-progress-sidebar ">
                    <div class="panel-group" id="couponField">     
                        {{-- <form action="{{ url('coupon/apply') }}" method="POST">
                            @csrf       --}}
                            {{-- <input type="hidden" name="total_order" value="{{ $total }}"> --}} 
                                    <div class="form-group">
                                        @if (session()->get('language') == 'bangla')
                                        <label class="info-title" for="exampleInputEmail1">কুপন কোড:</label>
                                        @else 
                                       <label class="info-title" for="exampleInputEmail1">Apply Coupon:</label>
                                       @endif
                                       <input type="text" id="coupon_name" name="coupon_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="  @if (session()->get('language') == 'bangla') কুপনের নাম লিখুন @else coupon name @endif">
                                     </div>
                                                          
                                    <button class="btn btn-danger" onclick="submitCoupon()" type="submit">Apply</button>	  
                                
                        {{-- </form>             --}}
                </div>
            </div> 	
            @endif				
  <!-- checkout-progress-sidebar -->
    </div>
    <div class="col-md-4 mt-2">
        <!-- checkout-progress-sidebar -->
        <div class="checkout-progress-sidebar ">
            <div class="panel-group">
                        <ul class="nav nav-checkout-progress list-unstyled" id="couponCal">
                           
                                                                 
                        </ul>		              
            </div>
        </div> 		
        {{-- <form action="{{ url('checkout') }}" method="POST">
            @csrf --}}
            {{-- <input type="hidden" name="total" value="{{ $total }}"> --}}
        
            <a href="{{ url('checkout') }}" class="btn btn-primary pull-right" type="submit">@if (session()->get('language') == 'bangla')চেকআউট করুন @else Checkout @endif</a>
        {{-- </form>                --}}
        <!-- checkout-progress-sidebar -->
    </div>
 </div>
</div><!-- /.sigin-in-->
<!-- ================================= BRANDS CAROUSEL ======================================== -->
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
<!-- =========================== BRANDS CAROUSEL : END ================================== -->	
</div><!-- /.container -->
</div><!-- /.body-content -->

<script src="{{asset('fontend')}}/jquery.min.js"></script>
{{--start show all cart product  --}}
<script type="text/javascript">
    // start show all cart product
    function getCartProduct(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/show/cart/product/header",
            success: function (response){
                couponCalculation();
                var rows = ""
                $('#showprice').text(response.total);
                $('#countqty').text(response.countqty);
                $('#total').text(response.total);
                $.each(response.cart, function(key, value){
                    var discount = value.product.discount_price;

                    rows += ` <tr>
                                <td class="col-md-1"><img src="/${value.product.image_one}" alt="imga" style="height:60px; width:60px;"></td>
                                    <td class="col-md-3">
                                        <div class="product-name">
                                            <a href="">
                                                ${value.product.product_name_en}
                                            </a>
                                        </div>                                      
                                        <div class="price">
                                         ${discount == null
                                            ? `৳ ${value.product.selling_price}`
                                            :
                                            `৳ ${value.product.discount_price}`
                                         }
                                        </div>
                                    </td>             

                                    <td class="col-md-2">
                               
                                    <div class="form-group">
                                        <strong>${value.color}</strong>
                                    </div>
                                  
                                    </td>

                                    <td class="col-md-2">
                                        ${value.size == null
                                            ? `<span>.....</span>`
                                            :
                                            `<strong>${value.size}</strong>`
                                         }
                                    </td>
                                    <td class="col-md-2 ">
                                        <div class="form-group">
                                            ${value.quantity > 1 ?
                                            `<button type="submit" class="btn btn-sm btn-success" onclick="decrementCart(${value.id})" class="">-</button>`
                                            : 
                                            `<button type="submit" class="btn btn-sm btn-success" disabled class="">-</button>`
                                            }
                                            
                                            <input type="text"  disabled value="${value.quantity}" min="1" max ="100" style="width:25px;">

                                            <button type="submit" class="btn btn-sm btn-success" onclick="incrementCart(${value.id})" class="">+</button>
                                        </div>
                                    </td>
                                    <td class="col-md-1">
                                    <div class="price">${ value.price * value.quantity }
                                    </div>      
                                    </td>
                                    <td class="col-md-1 close-btn">
                                        <button type="submit" onclick="deleteCart(${value.id})" class=""><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>`
                    });
                    $('tbody').html(rows);
            }
        })
    }
    getCartProduct();
 // end show all cart product

    //start remove product from cart 
    function deleteCart(id){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/cart/remove/product/"+id,
                success: function(data){
                    getCartProduct();
                    viewData();
                    couponCalculation();
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
        //end remove product from cart 

    //    start decrement cart quantity
        function decrementCart(id){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/cart/quantity/decrement/"+id,
                success: function(data){
                    getCartProduct();
                    couponCalculation();
                }

            })
        }
    // end decrement cart quantity 

    //    start increment cart quantity
    function incrementCart(id){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/cart/quantity/increment/"+id,
                success: function(data){
                    getCartProduct();
                    couponCalculation();
                }

            })
        }
    // end increment cart quantity 

   
</script>
{{--end show all cart product  --}}
<script type="text/javascript">
 //start coupon apply
 function submitCoupon(){
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: "POST",
            dataType:"json",
            data: {
                "_token": "{{ csrf_token() }}",
                coupon_name:coupon_name
                },
            url: "/coupon/apply",
            success: function(data){
                if(data.coupon_validity == true){
                    couponCalculation();
                $('#couponField').hide();
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
                }else{
                    $('#coupon_name').val('');
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
              
            }
        })
    }
    // end coupon apply

// start after coupon applied and calculation 
    function couponCalculation(){
    
        $.ajax({
            type: "GET",
            dataType:"json",
            url: "/get/coupon/calculation",
            success: function(data){
                if (data.total) {
                    $('#couponCal').html(
                        `<h4 class="text-center" style="margin-top: 5px;"><strong>Sub Total: ৳<span></span>${data.total}</strong></h4>`
                    )
                }else{
                    $('#couponCal').html(
                        `<h4 class="text-center" style="margin-top: 5px;"><strong>Sub Total: ৳<span></span>${data.subtotal}</strong></h4>
                        <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Coupon: </strong>${data.coupon_name} <button type="submit" onclick="couponRemove()" ><i class="fa fa-times" style="color: red;"></i></button> </h4>
                            <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Discount( ${data.coupon_discount}% ): </strong>-৳${data.coupon_balance}</h4>
                            <h4 class="text-center" style="margin-top: 5px; margin-bottom: 5px;"><strong>Order Total: ৳</strong>${data.subtotal - data.coupon_balance}</h4>`
                    )
                }

            }

        }) 
    }
    couponCalculation();
    //coupon calculation end

// start coupon remove 
    function couponRemove(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/coupon/remove",
            success:function(data){
                couponCalculation();
                getCartProduct();
                $('#couponField').show();
                $('#coupon_name').val('');
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

    // end coupon remove
    
    </script>
@endsection