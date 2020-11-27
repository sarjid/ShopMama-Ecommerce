@extends('admin.admin_layouts.admin_master')
@section('coupon') active @endsection
@section('admin_title') Coupon @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Coupon</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm"> 
                <div class="col-md-8 m-auto">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">Coupon Edit</h5>
                        <hr>
                          <form action="{{ route('update.coupon') }}" method="POST" >
                              @csrf
                              <input type="hidden" name="id" value="{{ $coupons->id }}">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Name: <span class="text-danger">*</span></label>
                                <input type="text" name="coupon_name" class="form-control @error('coupon_name') is-invalid @enderror" value="{{ $coupons->coupon_name }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Coupon Name">
      
                                @error('coupon_name')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Discount: <span class="text-danger">*</span></label>
                                <input type="text" name="coupon_discount" class="form-control @error('coupon_discount') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $coupons->coupon_discount }}" placeholder="Coupon Discount %">
      
                                @error('coupon_discount')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Old Date:</label>
                                  
                                    <input type="text" readonly class="form-control @error('coupon_validity') is-invalid @enderror" id="exampleInputEmail1" value="{{ Carbon\Carbon::parse($coupons->coupon_validity)->format('D d F Y') }}" aria-describedby="emailHelp" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">validity <span class="text-danger">*</span></label>
                                    <input type="date" name="coupon_validity" class="form-control @error('coupon_validity') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $coupons->coupon_validity }}"  min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" >
                                    @error('coupon_validity')
                                  <strong class="text-danger">{{$message}}</strong>
                                    @enderror
        
                                  </div>
          
    
                              <button type="submit" class="btn btn-primary">Update Coupon</button>
                            </form>
    
      
      
                      </div>
                  </div>
              </div>
        
            </div>
          </div><!-- row -->

          
        </div><!-- sl-pagebody -->
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

