@extends('admin.admin_layouts.admin_master')
@section('brands') active @endsection
@section('admin_title') message @endsection
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <div class="mailbox-sideleft">

        <nav class="nav nav-mailbox flex-column mg-y-20">
          <a href="{{ url('admin/inbox/message') }}" class="nav-link active">
            <i class="icon ion-ios-filing-outline tx-24"></i>
            <span>Inbox</span>
            <span class="mg-l-auto tx-12">{{ count($messages) }}</span>
          </a>
          <a href="{{ url('admin/trash/message') }}" class="nav-link">
            <i class="icon ion-ios-filing-outline tx-24"></i>
            <span>Trash</span>
            <span class="mg-l-auto tx-12">8</span>
          </a>
      
        </nav>
      
      </div><!-- mailbox-sideleft -->
        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12 m-auto">
                  <div class="mailbox-content">
                    <nav class="breadcrumb sl-breadcrumb">
                      <a class="breadcrumb-item" href="#">ShopMama</a>
                      <a class="breadcrumb-item" href="#">Trash</a>
                      <a class="breadcrumb-item" href="#">Messages</a>
                    </nav>
                    <table class="table table-hover mg-t-25 mg-b-0">
                        <a href="{{ url('admin/inbox/message') }}" class="btn btn-sm btn-primary pull-right">  <i class="icon ion-ios-folder-outline tx-20"></i> Inbox</a>
                      <tbody>
                      @foreach ($messages as $msg)
                        <tr>
                         
                          <td>
                            <img src="{{ asset('backend') }}/img/img10.jpg" class="wd-30 rounded-circle" alt="">
                          </td>
                          <td class="valign-middle">
                            <p class="mg-b-0">
                              <span class="tx-medium tx-gray-800">{{ ucwords($msg->name) }}</span> => 
                             {{ $msg->subject }}
                            </p>
                          </td>
                          <td class="valign-middle">{{ $msg->created_at->diffForHumans() }}</td>
                          <td>
                            <a href="{{ url('admin/message/view/'.$msg->id) }}" class="badge badge-pill badge-primary"><i class="fa fa-eye" style="font-size: 25px;"></i>
                            </a>
                            <a href="{{ url('admin/trash/message/delete/'.$msg->id) }}" class="badge badge-pill badge-danger" id="delete" title="delete data"><i class="fa fa-trash" style="font-size: 25px;"></i></a>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div><!-- mailbox-content -->
                </div>
            </div>
          </div><!-- row -->
        </div><!-- sl-pagebody -->
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
@endsection

