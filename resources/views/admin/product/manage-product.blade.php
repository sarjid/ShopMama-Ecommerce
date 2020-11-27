@extends('admin.admin_layouts.admin_master')
@section('products') active show-sub @endsection
@section('manage-products') active @endsection
@section('admin_title') Manage-Products @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Manage Products</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">Products List <br>
                            <strong class="text-danger"> Total Products:{{ count($products) }}</strong>  
                        </div> 
                        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-15p">Image</th>
                                  <th class="wd-15p">Name</th>
                                  <th class="wd-15p">Code</th>
                                  <th class="wd-15p">Price</th>
                                  <th class="wd-15p">Discount</th>
                                  <th class="wd-15p">Status</th>
                                  <th class="wd-25p">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach ($products as $row)                                   
                                    <tr>
                                        <td>
                                            <img src="{{ asset($row->image_one) }}" height="42px;" width="44px;" alt="">
                                        </td>
                                        <td>
                                            {{ $row->product_name_en }}
                                        </td>
                                        <td>{{ $row->product_code }}</td>
                                        <td>{{ $row->selling_price }}$</td>
                                        <td>
                                            @if($row->discount_price == NULL)
                                            <span class="badge badge-pill badge-danger">No</span>
                                            @else 
                                            @php 
                                            $amount = $row->selling_price - $row->discount_price;
                                            $discount = ($amount/$row->selling_price) * 100;
                                            @endphp
                                               <span class="badge badge-pill badge-info"> {{ round($discount) }}%</span>
                                           
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>      
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/products-view/'.$row->id.'/'.$row->product_slug_en) }}" class="btn btn-sm btn-primary" title="view data"> <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('admin/products-edit/'.$row->id.'/'.$row->product_slug_en) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ url('admin/products-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i>
                                            </a>
                                            @if($row->status == 1)
                                            <a href="{{ url('admin/products-inactive/'.$row->id) }}" class="btn btn-sm btn-danger" title="Click to Inactive"><i class="fa fa-arrow-down"></i>
                                            </a>
                                            @else 
                                            <a href="{{ url('admin/products-active/'.$row->id) }}" class="btn btn-sm btn-success" title="click to active"><i class="fa fa-arrow-up"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>                       
                                @endforeach
                               
                            </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                        </div>

                    </div>
                </div>
        

        
            </div>
          </div><!-- row -->

          
        </div><!-- sl-pagebody -->
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

