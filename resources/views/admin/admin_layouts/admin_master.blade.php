<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Admin |@yield('admin_title')</title>

    <!-- vendor css -->
    <link href="{{ asset('backend') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/lib/highlightjs/github.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/lib/select2/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/lib/toastr/toastr.css">
    <link href="{{ asset('backend') }}/lib/medium-editor/medium-editor.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/lib/medium-editor/default.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/lib/summernote/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend')}}/lib/bootstrap-tagsinput.css" crossorigin="anonymous">
    <link href="{{ asset('backend') }}/lib/spectrum/spectrum.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('backend') }}/css/starlight.css">
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
      @include('admin.admin_layouts.left-bar')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <a href="{{ url('/') }}" target="_blank" style="color: white;"> <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i> Visit Site</a>
      <a href="{{ url('admin/all-user') }}" style="color: white;"><i class="icon ion-ios-person-outline"></i> All Users</a>
      <a href="{{ url('admin/inbox/message') }}" style="color: white;">All Message</a>
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user()->name }}</span>
              <img src="{{ asset(Auth::user()->image) }}" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href="{{ url('admin/profile') }}"><i class="icon ion-ios-person-outline"></i>My Profile</a></li>
                <li><a href="{{ route('admin.logout') }}"><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
            @php
                $messages = App\Contact::where('status',0)->latest()->limit(5)->get();
            @endphp
            <!-- start: if statement -->
            <i class='fab fa-facebook-messenger' style='font-size:28px;color:white;'><span class="badge badge-pill badge-danger" style='font-size:15px;color:white;'><span>{{ count($messages) }}</span>
            </span></i>
            <span class="square-8 bg-danger"></span>
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Unread Messages</a>
        </li>
      
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
          <div class="media-list">
            <!-- loop starts here -->
            @foreach ($messages as $msg)
            <a href="{{ url('admin/message/view/'.$msg->id) }}" class="media-list-link">
              <div class="media">
                <img src="{{ asset('backend') }}/backend/img/img3.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-13">{{ ucwords($msg->name) }}</p>
                  <span class="d-block tx-11 tx-gray-500">{{ $msg->created_at->diffForHumans() }}</span>
                  <p class="tx-13 mg-t-10 mg-b-0">{{ $msg->subject }}</p>
                </div>
              </div>
            </a>
            @endforeach
            <!-- loop ends here -->
          </div><!-- media-list -->
          <div class="pd-15">
            <a href="{{ url('admin/all-message') }}" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
          </div>
        </div><!-- #messages -->


      </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->
 

    @yield('admin_content')

    <script src="{{ asset('backend') }}/lib/jquery/jquery.js"></script>
    <script src="{{ asset('backend') }}/lib/popper.js/popper.js"></script>
    <script src="{{ asset('backend') }}/lib/bootstrap/bootstrap.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('backend') }}/lib/jquery-ui/jquery-ui.js"></script>
    <script src="{{asset('backend')}}/lib/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('backend') }}/lib/showimg.js"></script>
    <script src="{{ asset('backend') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="{{ asset('backend') }}/lib/highlightjs/highlight.pack.js"></script>
    <script src="{{ asset('backend') }}/lib/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('backend') }}/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="{{ asset('backend') }}/lib/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/lib/spectrum/spectrum.js"></script>
    <script src="{{ asset('backend') }}/lib/spectrum/code.js"></script>
    <script src="{{ asset('backend') }}/lib/dataCode.js"></script>
    <script src="{{ asset('backend')}}/lib/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('backend')}}/lib/medium-editor/medium-editor.js"></script>
    <script src="{{ asset('backend')}}/lib/summernote/summernote-code.js"></script>
    <script src="{{ asset('backend') }}/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
    <script src="{{ asset('backend') }}/lib/d3/d3.js"></script>
    <script src="{{ asset('backend') }}/lib/rickshaw/rickshaw.min.js"></script>
    <script src="{{ asset('backend') }}/lib/chart.js/Chart.js"></script>
    <script src="{{ asset('backend') }}/lib/Flot/jquery.flot.js"></script>
    <script src="{{ asset('backend') }}/lib/Flot/jquery.flot.pie.js"></script>
    <script src="{{ asset('backend') }}/lib/Flot/jquery.flot.resize.js"></script>
    <script src="{{ asset('backend') }}/lib/flot-spline/jquery.flot.spline.js"></script>
    <script src="{{ asset('backend') }}/js/starlight.js"></script>
    <script src="{{ asset('backend') }}/js/ResizeSensor.js"></script>
    <script src="{{ asset('backend') }}/js/dashboard.js"></script>
    <script src="{{ asset('backend') }}/js/sweetalert2@8.js"></script>
    <script src="{{ asset('backend')}}/lib/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('backend')}}/lib/sweetalert/sweetalertCode.js"></script>
    <script src="{{ asset('backend')}}/lib/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('backend')}}/lib/medium-editor/medium-editor.js"></script>
    <script>
      $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>
<script type="text/javascript" src="{{ asset('backend') }}/lib/jquery.form-validator.min.js"></script>
<script>
    $.validate({
      lang: 'en'
    });
  </script>
    <script type="text/javascript" src="{{ asset('backend') }}/lib/toastr/toastr.min.js"></script>
    <script>
      @if(Session::has('message'))
        var type ="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                toastr.info(" {{Session::get('message')}} ");
                break;

            case 'success':
                toastr.success(" {{Session::get('message')}} ");
                break;
                
            case 'warning':
                toastr.warning(" {{Session::get('message')}} ");
                break;

            case 'error':
                toastr.error(" {{Session::get('message')}} ");
                break;
        }
    @endif
    </script>
    
    {{-- <script type="text/javascript">
      function getallMessage(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/admin/message/all/ajax",
            success: function(data){
              getallMessage();
              var msg = ""
              $('#countMsg').text(data.totalMsg);
              $.each(data.message, function(key, value){
                  msg += `<a href="{{ url('admin/message/view') }}/${value.id}" class="media-list-link">
                          <div class="media">
                            <img src="/backend/img/img3.jpg" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                              <p class="mg-b-0 tx-medium tx-gray-800 tx-13">${value.name}</p>
                              <span class="d-block tx-11 tx-gray-500">${value.formattedDate}</span>
                              <p class="tx-13 mg-t-10 mg-b-0">${value.subject}</p>
                            </div>
                          </div>
                        </a>`
              });
              $('#message').html(msg);
             
            }
            
        });
      }
      getallMessage();
     
    </script> --}}
    <script>
      $(function() {
        'use strict';
        // show only the icons and hide left menu label by default
        $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');

        // scrollbar
        $('.mailbox-sideleft').perfectScrollbar();

        // showing mailbox left menu
        $('#showMailboxLeft').on('click', function(){
          $('body').toggleClass('show-mailbox-left');
        });
      });
    </script>
  </body>
</html>
