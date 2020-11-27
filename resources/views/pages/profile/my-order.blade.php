@extends('layouts.fontend_master')
@section('title') My Profile @endsection
@section('user-order') active @endsection
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
				<li class='active'>My Orders</li>
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
                <div class="table-responsive">
                    <table class="table">
                    <tbody>                     
                            <tr style="background: #E9EBEC;">
                                <td class="col-md-1">
                                    <label for="">Date</label>
                                </td>
                                <td class="col-md-3">
                                <label for="">Total</label>                                 
                                </td>             

                                <td class="col-md-2">
                                    <label for="">Payment</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">Invoice</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">Order </label>
                                </td>
                            
                                <td class="col-md-1">                                                                   
                                    <label for="">Action</label>
                                </td>

                            </tr>
                                            
                        @forelse ($orders as $row)
                            <tr>
                                <td class="col-md-1">
                                   <strong>{{$row->order_date}}</strong>
                                </td>
                                <td class="col-md-3">
                                <strong>৳{{$row->paying_amount}}</strong>                                  
                                </td>             

                                <td class="col-md-2">
                                <strong>{{$row->payment_type}}</strong>
                                </td>

                                <td class="col-md-2">
                                <strong>{{$row->invoice_no}}</strong>
                                </td>

                                <td class="col-md-2">
                                    @if ($row->status ==0)
                                    <span class="badge badge-pill badge-warning" style="background: #418DB9; text:white;">Pending</span>
                                    @elseif($row->status ==1)
                                    <span class="badge badge-primary" style="background: #59B210; text:white;">Confirmed</span>
                                    @elseif($row->status ==2)
                                    <span class="badge badge-primary" style="background: #359BED; text:white;">Processing</span>
                                    @elseif($row->status ==3)
                                    <span class="badge badge-success" style="background: #59B210; text:white;">Picked</span>
                                    @elseif($row->status ==4)
                                    <span class="badge badge-success" style="background: #FD9F13; text:white;">Shipped</span>
                                    @elseif($row->status ==5)
                                    <span class="badge badge-success" style="background: green; text:white;">Delivered</span>
                                    @else
                                    <span class="badge badge-danger" style="background: red; text:white;">Cancel Order</span>
                                    @endif
                                </td>
                            
                            <td     class="col-md-1">                                                                     
                            <a href="{{ url('user/view/orders/'.$row->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
                            @if ($row->status ==0 || $row->status ==6)
                            @else
                            <a href="{{ url('user/order/invoice/'.$row->id) }}" style="margin-top: 5px;"  class="btn btn-sm btn-danger "><i class="fa fa-download" style="color:white;"></i> Invoice</a>
                            @endif
                            </td>
                        </tr>
                        @empty
                        <h4 class="text-danger text-center">No Order Found</h4>
                        @endforelse
                        </tbody>
                    </table>
                    <span style="float:right;"> {{$orders->links()}}</span>
                </div>              
            </div>
    
	     </div>
	</div>
</div>
</div>
@endsection
