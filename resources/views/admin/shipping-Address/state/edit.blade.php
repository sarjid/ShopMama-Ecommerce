@extends('admin.admin_layouts.admin_master')
@section('shipping_address') active show-sub @endsection
@section('state') active @endsection
@section('admin_title') Shipping State @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Update State</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">     
                <div class="col-md-6 m-auto">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">update State</h5>
                        <hr>
                          <form action="{{ url('admin/shipping/state-update/'.$state->id) }}" method="POST" >
                              @csrf
                              
                              <div class="form-group">
                                <label for="exampleInputEmail1">Division: </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled value="{{ $state->divs->division_name }}">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">District: </label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled value="{{ $state->dis->district_name }}">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">State Name: <span class="text-danger">*</span></label>
                                <input type="text" name="state_name" class="form-control @error('state_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $state->state_name }}">
      
                                @error('state_name')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
   
                              <button type="submit" class="btn btn-primary" >Update Data</button>
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

