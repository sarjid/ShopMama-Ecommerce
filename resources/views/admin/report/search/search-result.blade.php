@extends('admin.admin_layouts.admin_master')
@section('reports') active show-sub @endsection
@section('search-orders') active  @endsection
@section('admin_title') Search Orders Result @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="">Shop MaMa</a>
          <span class="breadcrumb-item active">Search Orders</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12 ">
                    <div class="card pd-20 pd-sm-40 ">
                        <div class="text-danger">Search Order Total: {{ count($orders) }}</div>
                        <h6 class="card-body-title">Order List                
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
                                <th class="wd-15p">Status</th>
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
                                    @if ($row->status ==0)
                                    <span class="badge badge-pill badge-warning">Pending</span>
                                    @elseif($row->status ==1)
                                    <span class="badge badge-success">Confirmed</span>
                                    @elseif($row->status ==2)
                                    <span class="badge badge-primary">Processing</span>
                                    @elseif($row->status ==3)
                                    <span class="badge badge-info">Picked</span>
                                    @elseif($row->status ==4)
                                    <span class="badge badge-primary">Shipped</span>
                                    @elseif($row->status ==5)
                                    <span class="badge badge-success">Delivered</span>
                                    @else
                                    <span class="badge badge-danger">Cancel Order</span>
                                    @endif
                
                                </td>
                
                                <td>                
                                    <a href="{{ URL::to('admin/reports/order-view/'.$row->id) }}" class="btn btn-sm btn-primary"  title="Order View"><i class="fa fa-eye"></i> View</a>
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

