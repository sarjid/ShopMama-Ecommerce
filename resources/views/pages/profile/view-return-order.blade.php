@extends('layouts.fontend_master')
@section('title')view return order @endsection
@section('user-return-order') active @endsection
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
				<li><a href="{{ route('home') }}">Profile</a></li>
				<li class='active'>Return Orders</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
        <div class="my-wishlist-page">
			<div class="row">
                <div class="col-md-4 ">
                    <div class="card " style="width: 18rem;">
                      <img class="card-img-top"  style="border-radius: 50%;" src="{{ asset(Auth::user()->image) }}" height="100%;" width="100%;" alt="Card image cap">
                      <div class="card-body">
                      <ul class="list-group list-group-flush text-center">
                        <a href="{{ url('home') }}" class="btn btn-primary btn-sm btn-block @yield('user-home')" style="margin-top: 5px;">Home</a>
                        <a href="{{ route('wishlist.page') }}" class="btn btn-primary btn-sm btn-block">My Wishlist</a>
                        <a href="{{ url('user/orders') }}" class="btn btn-primary btn-sm btn-block @yield('user-order')">My orders</a>
                        <a href="{{ url('user/return/order') }}" class="btn btn-primary btn-sm btn-block @yield('user-return-order')">Return orders</a>
                        <a href="{{ url('user/password') }}" class="btn btn-primary btn-sm btn-block @yield('user-pass')">Change Password</a>                  
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm btn-block" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Log Out</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </ul>
                        </div>                
                    </div>
                  </div>  
            
            <div class="col-md-8 mt-2">
                <div class="row">
                   <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><h4>Shipping Details </h4></div> <hr>
        
                        <div class="card-body" style="background: #E9EBEC;">
                        <table class="table">
                             <tr>
                                 <th>Name: </th>
                                 <th>{{ $shipping->shipping_name }}</th>
                             </tr>
                             <tr>
                                 <th>Phone: </th>
                                 <th>{{ $shipping->shipping_phone }}</th>
                             </tr>
                             <tr>
                                 <th>Email: </th>
                                 <th>{{ $shipping->shipping_email }}</th>
                             </tr>
                             <tr>
                                 <th>Division: </th>
                                 <th>{{ $shipping->division->division_name }}</th>
                             </tr>
                             <tr>
                                 <th>District :</th>
                                 <th>{{ $shipping->district->district_name }}</th>
                             </tr>

                             <tr>
                                <th>State :</th>
                                <th>{{ $shipping->state->state_name }}</th>
                            </tr>
                            <tr>
                                <th>Post Code :</th>
                                <th>{{ $shipping->post_code }}</th>
                            </tr>

                            <tr>
                                <th>Order Date :</th>
                                <th>{{ $order->order_date }}</th>
                            </tr>

                              <tr>
                                 <th>Order : </th>
                                 <th>
                                    @if ($order->status ==0)
                                    <span class="badge badge-pill badge-warning" style="background: #418DB9; text:white;">Pending</span>
                                    @elseif($order->status ==1)
                                    <span class="badge badge-primary" style="background: #59B210; text:white;">Confirmed</span>
                                    @elseif($order->status ==2)
                                    <span class="badge badge-primary" style="background: #359BED; text:white;">Processing</span>
                                    @elseif($order->status ==3)
                                    <span class="badge badge-success" style="background: #59B210; text:white;">Picked</span>
                                    @elseif($order->status ==4)
                                    <span class="badge badge-success" style="background: #FD9F13; text:white;">Shipped</span>
                                    @elseif($order->status ==5)
                                    <span class="badge badge-success" style="background: green; text:white;">Delivered</span>
                                    @else
                                    <span class="badge badge-danger" style="background: red; text:white;">Cancel Order</span>
                                    @endif
                                 </th>
                             </tr>
        
                        </table>
        
                        </div>
                    </div>
                   </div>

                   <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><h4>Order Details <span class="text-danger">Invoice: {{ $order->invoice_no }}</span></h4></div>
                        <hr>
        
                        <div class="card-body" style="background: #E9EBEC;">
                        <table class="table">
                             <tr>
                                 <th>Name: </th>
                                 <th>{{ $order->user->name }}</th>
                             </tr>
                             <tr>
                                 <th>Phone: </th>
                                 <th>{{ $order->user->phone }}</th>
                             </tr>
                             
                             <tr>
                                 <th>Payment Type: </th>
                                 <th>{{ $order->payment_type }} ( {{ $order->payment_number }} )</th>
                             </tr>
                             <tr>
                                 <th>Blnc Tnx Id :</th> 
                                 <th><input type="text" readonly value="{{ $order->transaction_id }}"></th>
                             </tr>

                             <tr>
                                <th>Invoice :</th>
                                <th class="text-danger">{{ $order->invoice_no }}</th>
                               
                            </tr>
                            <tr>
                                <th>SubTotal:</th>
                                <th>৳{{ $order->subtotal }}</th>
                            </tr>

                            @if ($order->coupon_discount == NULL)
                            @else                         
                                <tr>
                                    <th>Coupon Discount:</th>
                                    <th>{{ $order->coupon_discount }}% </th>
                                </tr>
                            @endif

                            <tr>
                                <th>Total:</th>
                                <th>৳{{ $order->paying_amount }}</th>
                            </tr>
                             
        
                        </table>
        
                        </div>
                    </div>
                   </div>
                </div>  
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                            <tbody>                     
                                    <tr style="background: #E9EBEC;">
                                        <td class="col-md-1">
                                            <label for="">Image</label>
                                        </td>
                                        <td class="col-md-3">
                                        <label for="">Poduct Name</label>                                 
                                        </td>  
                                        
                                        <td class="col-md-3">
                                            <label for="">Poduct Code</label>                                 
                                        </td>  

                                        <td class="col-md-2">
                                            <label for="">Color</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">Size</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">Quantity</label>
                                        </td>
                                    
                                        <td class="col-md-1">                                                                   
                                            <label for="">Price</label>
                                        </td>

                                    </tr>
                                                    
                                @foreach ($order_details as $row)
                                    <tr>
                                        <td class="col-md-1"><img src="{{ asset($row->product->image_one) }} " height="50px;" width="50px;" alt="imga"></td>
                                        <td class="col-md-3">
                                            <div class="product-name"><strong>{{ $row->product->product_name_en }}</strong>
                                            </div>                                      
                                           
                                        </td>             
        
                                        <td class="col-md-2">
                                        <strong>{{ $row->product->product_code }}</strong>
                                        </td>

                                        <td class="col-md-2">
                                            <strong>{{ $row->color }}</strong>
                                            </td>
        
                                        <td class="col-md-2">
                                        <strong>{{ $row->size }}</strong>
                                        </td>
        
                                        <td class="col-md-2">
                                        <strong>{{ $row->quantity }} pices</strong>
                                        </td>
                                    
                                        <td class="col-md-1">                                                                     
                                        <strong>৳{{ $row->total_price }}</strong>

                                        </td>
        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>     
                    </div>
                </div>

                @if ($order->return_order_status ==0)
                <form action="{{ url('user/return-request/order/'.$order->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="label">Order Return Reason:</label>
                        <textarea name="return_reason" id="label"  class="form-control" cols="30" rows="05"></textarea>
                        @error('return_reason')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror            
                    </div>
                    <button type="submit" class="btn btn-danger">I Want To Return Order</button>
                </form>                        
                @else              
                @endif
                
            </div>
            {{-- col-md-8 end  --}}

           
    
	     </div>
	</div>
</div>
</div>
@endsection
