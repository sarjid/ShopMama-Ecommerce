@extends('admin.admin_layouts.admin_master')
@section('shipping_address') active show-sub @endsection
@section('district') active @endsection
@section('admin_title') Shipping district @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Add Districts</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">District List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-20p">SL</th>
                                  <th class="wd-50p">Division => District Name </th>
                                  <th class="wd-30p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php 
                                 $i = 1;
                                @endphp
                                @foreach ($districts as $row)                                  
                                <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>
                                    {{ $row->div->division_name }} => 
                                    {{ $row->district_name }} 
                                  </td>                                                   
                                  <td>
                                    <a href="{{ url('admin/shipping/district-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/shipping/district-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>                                   
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
                        <h5 class="text-danger text-center">Add New District</h5>
                        <hr>
                          <form action="{{ url('admin/shipping/district-store') }}" method="POST" >
                              @csrf
                              
                              <div class="form-group">
                                <label for="exampleInputEmail1">Select Division: <span class="text-danger">*</span></label>
                                <select name="division_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach ($divisions as $division)                                      
                                     <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                    @endforeach
                                  </select>
                                @error('division_id')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror     
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">District Name: <span class="text-danger">*</span></label>
                                <input type="text" name="district_name" class="form-control @error('district_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="district name">
      
                                @error('district_name')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
   
                              <button type="submit" class="btn btn-primary" >Add District</button>
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

