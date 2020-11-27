@extends('admin.admin_layouts.admin_master')
@section('shipping_address') active show-sub @endsection
@section('district') active @endsection
@section('admin_title') Update district @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Update Districts</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-6 m-auto">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">Update District</h5>
                        <hr>
                          <form action="{{ url('admin/shipping/district-update/'.$district->id) }}" method="POST" >
                              @csrf
                              
                              <div class="form-group">
                                <label for="exampleInputEmail1">Select Division: <span class="text-danger">*</span></label>
                                <select name="division_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                    <option label="Choose one"></option>
                                    @foreach ($divisions as $division)                                      
                                     <option value="{{ $division->id }}" {{ $district->division_id == $division->id ?'selected':'' }}>{{ $division->division_name }}</option>
                                    @endforeach
                                  </select>
                                @error('division_id')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror     
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">District Name: <span class="text-danger">*</span></label>
                                <input type="text" name="district_name" class="form-control @error('district_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $district->district_name }}">
      
                                @error('district_name')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
   
                              <button type="submit" class="btn btn-primary" >Update District</button>
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

