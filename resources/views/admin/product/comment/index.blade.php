@extends('admin.admin_layouts.admin_master')
@section('products') active show-sub @endsection
@section('review-products') active @endsection
@section('admin_title') review-Products @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">review Products</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Products List <br>
                            <strong class="text-danger"> Total Comments:{{ count($comments) }}</strong>  
                        </div> 
                        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-10p">Product Image</th>
                                  <th class="wd-15p">Product Name</th>
                                  <th class="wd-15p">Name</th>
                                  <th class="wd-15p">Email</th>
                                  <th class="wd-5p">Rating</th>
                                  <th class="wd-30p">Review</th>
                                  <th class="wd-10p">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach ($comments as $row)                                   
                                    <tr>
                                        <td>
                                            <img src="{{ asset($row->product->image_one) }}" height="42px;" width="44px;" alt="">
                                        </td>
                                        <td>
                                            {{ $row->product->product_name_en }}
                                        </td>
                                        <td>
                                            {{ $row->name }}
                                        </td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->rating }}Star</td>
                                        <td>
                                            <textarea name="" id="" disabled cols="35" rows="2">{{ $row->review }}</textarea>
                                        </td>
                                        
                                        
                                        <td>
                                            <a href="{{ url('admin/products-review/delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i>
                                            </a>
                                           
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

