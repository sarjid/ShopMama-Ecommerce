@extends('admin.admin_layouts.admin_master')
@section('shipping_address') active show-sub @endsection
@section('state') active @endsection
@section('admin_title') Shipping State @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Add State</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">State List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-80p">Division => District Name => State </th>
                                  <th class="wd-20p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              
                                @foreach ($states as $row)                                  
                                <tr>
                                  <td>
                                    {{ $row->divs->division_name }} => 
                                    {{ $row->dis->district_name }} => 
                                    {{ $row->state_name }} 
                                  </td>                                                   
                                  <td>
                                    <a href="{{ url('admin/shipping/state-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/shipping/state-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>                                   
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
                        <h5 class="text-danger text-center">Add New State</h5>
                        <hr>
                          <form action="{{ url('admin/shipping/state-store') }}" method="POST" >
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
                                <label for="exampleInputEmail1">Select District: <span class="text-danger">*</span></label>
                                <select name="district_id" class="form-control select2-show-search" data-placeholder="Choose one">
                                </select>
                                @error('district_id')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror     
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">State Name: <span class="text-danger">*</span></label>
                                <input type="text" name="state_name" class="form-control @error('state_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="state name">
      
                                @error('state_name')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
   
                              <button type="submit" class="btn btn-primary" >Add State</button>
                            </form>
 
      
                      </div>
                  </div>
              </div>
        
            </div>
          </div><!-- row -->

          
        </div><!-- sl-pagebody -->
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->

      <script src="{{asset('backend')}}/lib/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
      
      <script type="text/javascript">
        $(document).ready(function() {
          $('select[name="division_id"]').on('change', function(){
              var division_id = $(this).val();
              if(division_id) {
                  $.ajax({
                      url: "{{  url('/get/district/') }}/"+division_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         var d =$('select[name="district_id"]').empty();
                            $.each(data, function(key, value){
      
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
      
                            });
      
                      },
      
                  });
              } else {
                  alert('danger');
              }
      
          });
          
      });
      
      </script>   
      
@endsection

