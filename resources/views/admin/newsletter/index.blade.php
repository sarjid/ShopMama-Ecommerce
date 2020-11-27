@extends('admin.admin_layouts.admin_master')
@section('newsletter') active @endsection
@section('admin_title') subscribers @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">subscribers</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-10 m-auto">
                    <div class="card">
                        <div class="card-header">subscribers List</div>
                        <h5 class="text-danger ml-3">Total Subscribers: {{ count($subscribers) }}</h5>     
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-15p">SL</th>
                                  <th class="wd-35p">Email Address</th>
                                  <th class="wd-30p">Date</th>
                                  <th class="wd-20p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php 
                                 $i = 1;
                                @endphp
                                @foreach ($subscribers as $row)                                  
                                <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $row->email }}</td>
                                  <td>
                                      {{ Carbon\Carbon::parse( $row->created_at)->format('d F Y') }} | {{  $row->created_at->diffForHumans() }}
                                </td>
                                  
                                  <td>
                                   
                                    <a href="{{ url('admin/subscriber/delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                                  
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

