@extends('admin.admin_layouts.admin_master')
@section('admin_title') user list @endsection

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">User List</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">User List</div>
                        <div class="card-body">
                            <h6 class="text-danger"> Total User: {{ count($users) }}</h6>
                            @php
                                $online_user = 0;
                            @endphp    
                            @foreach ($users as $item)
                            @php
                              if($item->isUserOnline()){
                                  $online_user = $online_user + 1 ;
                                }
                              @endphp   
                            @endforeach 
                            <h6 class="text-danger"> Active Now: {{ $online_user }}</h6>        
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-5p">SL</th>
                                  <th class="wd-15p">Name</th>
                                  <th class="wd-15p">Email</th>
                                  <th class="wd-15p">image</th>
                                  <th class="wd-15p">Online/Offline</th>
                                  <th class="wd-15p">Banned/Unban</th>
                                  <th class="wd-20p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php 
                                 $i = 1;
                                @endphp
                                @foreach ($users as $row)                                  
                                <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $row->name }}</td>
                                  <td>{{ $row->email }}</td>
                                  <td>
                                      @if ($row->image == NULL)
                                      <img src="" alt="" width="35px;" width="63px;" style="border-radius: 50%;">
                                      <span class="badge badge-pill badge-danger">No image Found</span>
                                      @else   
                                      <img src="{{ asset($row->image) }}" alt="{{ $row->name  }}" width="35px;" width="63px;" style="border-radius: 50%;">
                                      @endif
                                  </td>
                                  <td>
                                    @if ($row->isUserOnline())
                                    <span class="py-2 px-3 badge  btn-success">Active Now</span>
                                     @else   
                                     active {{ Carbon\Carbon::parse($row->last_seen)->diffForHumans() }}
                                    @endif
                                  </td>
                                  <td>
                                    @if ($row->isban == 0)
                                    <span class="py-2 px-3 badge btn-success">Unbann</span>
                                     @else   
                                     <span class="py-2 px-3 badge btn-danger">Banned</span>
                                    @endif
                                  </td>
                                  <td>
                                    @if($row->isban == 0)
                                    <a href="{{ url('admin/user-banned/'.$row->id) }}" class="btn btn-sm btn-warning" title="Click to banned User"><i class="fa fa-arrow-down"> Banned</i>
                                    </a>
                                    @else 
                                    <a href="{{ url('admin/user-unban/'.$row->id) }}" class="btn btn-sm btn-success" title="click to Unban user"><i class="fa fa-arrow-up"> Unban</i>
                                    </a>
                                    @endif
                                    <a href="{{ url('admin/user-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i> Delete</a>
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
     


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        @csrf
      <div class="modal-body">
        <input type="text" value="{{ $row->id }}">
        <div class="form-group">
          <select class="form-control " name="year_name" data-placeholder="Choose one" data-validation="required">
            <option label="Choose one"></option>
            <option value="0">Unban</option>
            <option value="1">Banned</option>
          </select> 
          @error('banned')
          <strong class="text-danger">{{$message}}</strong>
          @enderror
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
        

@endsection

