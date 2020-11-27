@extends('admin.admin_layouts.admin_master')
@section('return-orders') active show-sub @endsection
@section('return-cancel-orders') active @endsection
@section('admin_title') return cancel Orders @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">View return cancel Orders</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12 ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header"><strong>Shipping</strong> Details</div>
        
                                <div class="card-body">
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
                                                @if ($order->return_order_status ==0)
                                                <span class="badge badge-primary" style="background: #59B210; text:white;">Aviable</span>
                                                @elseif($order->return_order_status ==1)
                                                <span class="badge badge-primary" style="background: #F89C0E; text:white;">Request Pending</span>
                                                @elseif($order->return_order_status ==2)
                                                <span class="badge badge-primary" style="background: #359BED; text:white;">Accept Request</span>
                                                @else
                                                <span class="badge badge-danger" style="background: red; text:white;">Cancel Return Order</span>
                                                @endif
                                       
                                            </th>
                                        </tr>
                   
                                   </table>
        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header"><strong>Order</strong> Details</div>
        
                                <div class="card-body">
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
                                            <th>{{ $order->payment_type }}</th>
                                        </tr>

                                        <tr>
                                            <th>Payment Number: </th>
                                            <th>{{ $order->payment_number }}</th>
                                        </tr>
                                        <tr>
                                            <th>Blnc Tnx Id :</th> 
                                            <th>{{ $order->transaction_id }}</th>
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
                </div>
                {{-- col-md-12 end  --}}        
            </div><!-- row -->

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="table-wrapper">
                        <table id="" class="table display responsive nowrap ">
                          <thead>
                            <tr>
                              <th class="wd-15p">Image</th>
                              <th class="wd-15p">Poduct Name</th>
                              <th class="wd-15p">Poduct Code</th>
                              <th class="wd-15p">Color</th>
                              <th class="wd-15p">Size </th>
                              <th class="wd-15p">Quantity</th>
                              <th class="wd-10p">Price</th>
                            </tr>
                          </thead>
                          <tbody>
              
                              @foreach ($order_details as $row)
                            <tr>
                              <td>
                                  <img src="{{ asset($row->product->image_one) }} " height="50px;" width="50px;" alt="img">
                                </td>
                              <td>{{ ($row->product->product_name_en )}}</td>
                              <td>{{ ($row->product->product_code )}}</td>
                              <td>
                                  {{ ($row->color )}}
                              </td>
                              <td>{{ $row->size }}</td>
                              <td>{{ $row->quantity }} pices</td>
                              <td>৳{{ $row->total_price }}</td>            
                            </tr>
                            @endforeach
              
                          </tbody>
                        </table>
                      </div><!-- table-wrapper --> 
                </div>
            </div>
          </div>

      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

