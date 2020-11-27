@extends('admin.admin_layouts.admin_master')
@section('return-orders') active show-sub @endsection
@section('return-request-orders') active @endsection
@section('admin_title') return Pending Orders @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Pending Orders</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12 ">
                    <div class="card pd-20 pd-sm-40 ">
                        <div class="text-danger">Return Pending Order Total: {{ count($orders) }}</div>
                        <h6 class="card-body-title">Return Pending List                
                        </h6>
                  
                        <div class="table-wrapper">
                          <table id="datatable1" class="table display responsive nowrap ">
                            <thead>
                              <tr>
                                <th class="wd-15p">Payment Type</th>
                                <th class="wd-15p">Transaction Id</th>
                                <th class="wd-15p">Invoice</th>
                                <th class="wd-15p">Total</th>
                                <th class="wd-15p">Coupon </th>
                                <th class="wd-15p">Return Status</th>
                                <th class="wd-10p">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                
                                @foreach ($orders as $row)
                              <tr>
                                <td>{{ ucwords($row->payment_type ) }}</td>
                                <td>{{ ($row->transaction_id )}}</td>
                                <td>{{ ($row->invoice_no )}}</td>
                                <td>
                                    ৳{{ ($row->paying_amount )}}
                                </td>
                                <td> 
                                    @if($row->coupon_discount == NUll)
                                    <span class=" badge badge-danger">No</span>
                                    @else
                                    <span class=" badge badge-info">{{ ($row->coupon_discount )}}%</span>                                  
                                    @endif
                                </td>
                               
                                <td>
                                  @if ($row->return_order_status ==0)
                                  <span class="badge badge-primary" style="background: #59B210; text:white;">Aviable</span>
                                  @elseif($row->return_order_status ==1)
                                  <span class="badge badge-primary" style="background: #F89C0E; text:white;">Request Pending</span>
                                  @elseif($row->return_order_status ==2)
                                  <span class="badge badge-primary" style="background: #359BED; text:white;">Accept Return Request</span>
                                  @else
                                  <span class="badge badge-danger" style="background: red; text:white;">Cancel Return Order</span>
                                  @endif
                
                                </td>
                
                                <td>                
                                    <a href="{{ URL::to('admin/return-request-orders/view/'.$row->id) }}" class="btn btn-sm btn-primary"  title="Order View"><i class="fa fa-eye"></i> View</a>
                                </td>
                
                              </tr>
                              @endforeach
                
                            </tbody>
                          </table>
                        </div><!-- table-wrapper -->
                      </div><!-- card -->
                </div>
        

        
            </div>
          </div><!-- row -->

          
        </div><!-- sl-pagebody -->
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

