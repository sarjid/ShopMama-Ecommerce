@extends('layouts.fontend_master')
@section('title') My Profile @endsection
@section('user-pass') active @endsection
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
				<li class='active'>password update</li>
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
                <div class="card">
                    <h3 class="text-center"> <span class="text-danger">Hi..!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Change Your Password</h3>
                    <div class="card-body">                  
                          <form action="{{ url('user/password-update') }}" method="POST">
                              @csrf
                          <div class="form-group">
                            <label for="exampleInputEmail1">Old Passowrd</label>
                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=" old_password">
                            @if(session('error'))               
                             <strong class="text-danger">{{session('error')}}</strong>                                         
                            @endif
                            @error('old_password')
                              <span class="text-danger">{{$message}}</span>
                            @enderror  
                          </div> 
                          <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="new_password">
                            @error('new_password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror 
                          </div> 
                          <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="confirm_password">
                            @if(session('danger'))          
                             <strong class="text-danger">{{session('danger')}}</strong>                                           
                           @endif 
                            @error('confirm_password')
                          <span class="text-danger">{{$message}}</span>
                            @enderror  
                          </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Update Password</button>
                        </div>                    
                    </form> 
                    </div>
                </div>
            </div>
    
	        </div>
	</div>
</div>
</div>
@endsection
