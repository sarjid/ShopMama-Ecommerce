@extends('admin.admin_layouts.admin_master')
@section('shipping_address') active show-sub @endsection
@section('division') active @endsection
@section('admin_title') Shipping Division @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Edit Division</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-6 m-auto">
                  <div class="card">
                      <div class="card-body">
                        <h5 class="text-danger text-center">Update Division</h5>
                        <hr>
                          <form action="{{ url('admin/shipping/division-update/'.$division->id) }}" method="POST" >
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Divison Name: <span class="text-danger">*</span></label>
                                <input type="text" name="division_name" class="form-control @error('division_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $division->division_name }}">
      
                                @error('division_name')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>        
                              <button type="submit" class="btn btn-primary" >Update Division</button>
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

