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
                        <div class="card-header">Coupons List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-15p">SL</th>
                                  <th class="wd-15p">Coupon Name </th>
                                  <th class="wd-15p">Coupon Discount</th>
                                  <th class="wd-15p">Validity</th>
                                  <th class="wd-15p">Date</th>
                                  <th class="wd-25p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php 
                                 $i = 1;
                                @endphp
                                @foreach ($coupons as $row)                                  
                                <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $row->coupon_name }}</td>
                                  <td>{{ $row->coupon_discount }}%</td>
                                  <td>
                                    @if ($row->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                    <span class="badge badge-success">Valid</span>
                                    @else
                                    <span class="badge badge-danger">Invalid</span>
                                    @endif
                                  <td>
                                    {{ Carbon\Carbon::parse( $row->coupon_validity)->format('D, d F Y') }}
                                  </td>
                               
                        
                                  <td>
                                    <a href="{{ url('admin/coupon-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/coupon-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                                    
                                  </td>
                                </tr>                               
                                @endforeach
                              </tbody>
                            </table>
                          </div><!-- table-wrapper -->
                        </div>

                    </div>
                </div>
        
        
              
        
                <div class="col-md-4">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">Coupon Add</h5>
                        <hr>
                          <form action="{{ route('store.coupon') }}" method="POST" >
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Name: <span class="text-danger">*</span></label>
                                <input type="text" name="coupon_name" class="form-control @error('coupon_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Coupon Name">
      
                                @error('coupon_name')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Discount: <span class="text-danger">*</span></label>
                                <input type="text" name="coupon_discount" class="form-control @error('coupon_discount') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Coupon Discount %">
      
                                @error('coupon_discount')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
                              <div class="form-group">
                                  <label for="exampleInputEmail1">validity <span class="text-danger">*</span></label>
                                  <input type="date" name="coupon_validity" class="form-control @error('coupon_validity') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" >
                                  @error('coupon_validity')
                                <strong class="text-danger">{{$message}}</strong>
                                  @enderror
      
                                </div>
          
      
                              <button type="submit" class="btn btn-primary">Add Coupon</button>
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

