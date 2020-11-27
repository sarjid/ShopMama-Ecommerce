@extends('admin.admin_layouts.admin_master')
@section('shipping_address') active show-sub @endsection
@section('division') active @endsection
@section('admin_title') Shipping Division @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Add Division</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">Division List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-30p">SL</th>
                                  <th class="wd-40p">Division Name </th>
                                  <th class="wd-30p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php 
                                 $i = 1;
                                @endphp
                                @foreach ($divisions as $row)                                  
                                <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $row->division_name }}</td>                                                   
                                  <td>
                                    <a href="{{ url('admin/shipping/division-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/shipping/division-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>                                   
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
                        <h5 class="text-danger text-center">Add New Division</h5>
                        <hr>
                          <form action="{{ url('admin/shipping/division-store') }}" method="POST" >
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Divison Name: <span class="text-danger">*</span></label>
                                <input type="text" name="division_name" class="form-control @error('division_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="division name">
      
                                @error('division_name')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>    
      
                              <button type="submit" class="btn btn-primary" >Add Division</button>
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

