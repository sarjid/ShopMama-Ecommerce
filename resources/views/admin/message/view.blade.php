@extends('admin.admin_layouts.admin_master')
@section('admin_title') view Message @endsection
@section('admin_content')
   <!-- ########## START: MAIN PANEL ########## -->
   <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
      <span class="breadcrumb-item active">Brands</span>
      <a href="{{ url('admin/inbox/message') }}" class="btn btn-sm btn-primary pull-right ml-5">  <i class="icon ion-ios-folder-outline tx-20"></i> Inbox</a>
      <a href="{{ url('admin/trash/message') }}" class="btn btn-sm btn-danger pull-right ml-5">  <i class="icon ion-ios-folder-outline tx-20"></i> Trash</a>
    </nav>

        <div class="sl-pagebody">
        <div class="row row-sm">
          <div class="col-md-8 m-auto">
        <div class="card pd-20 pd-sm-40 mg-t-25">
            <dl class="row">
              <dt class="col-sm-3 tx-inverse">Name</dt>
              <dd class="col-sm-9">{{ ucwords($message->name) }}</dd>
  
              <dt class="col-sm-3 tx-inverse">Email</dt>
              <dd class="col-sm-9">
                <p class="mg-b-10">{{ $message->email }}</p>
              </dd>
              <dt class="col-sm-3 tx-inverse">Subject</dt>
              <dd class="col-sm-9">
                <p class="mg-b-10">{{ $message->subject }}</p>
              </dd>

              <dt class="col-sm-3 tx-inverse">Message</dt>
              <dd class="col-sm-9">
                <p class="mg-b-10">{{ $message->message }}</p>
              </dd>
           
            </dl>
          </div><!-- card -->
        </div>
        </div>
        </div>
   </div>

@endsection