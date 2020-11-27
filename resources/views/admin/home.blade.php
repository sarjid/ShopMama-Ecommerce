@extends('admin.admin_layouts.admin_master')
@section('dashboard') active @endsection
@section('admin_title') Home @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Dashboard</span>
        </nav>

        <div class="sl-pagebody">

          <div class="row row-sm">
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0 mt-3">
              <div class="card pd-20 bg-sl-primary">
                <div class="d-flex justify-content-between align-items-center mg-b-10">
                  <h4 class=" mg-b-0 tx-spacing-1 tx-white">{{Carbon\Carbon::now()->format('D') }},
                    {{Carbon\Carbon::now()->format('d F Y') }}
                 </h4>
                </div><!-- card-header -->
                <div class="d-flex align-items-center justify-content-between">
                 
                  <h3 class="mg-b-0 tx-white tx-lato tx-bold" id="curr_time"></h3>
                </div><!-- card-body -->
                <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                 
                </div><!-- -->
              </div><!-- card -->
            </div><!-- col-3 -->
              {{-- Todays pending orders  --}}
              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-primary">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's Pending Orders</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white">3</h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold">1420Tk</h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->
              {{-- today's Aceept Orders --}}
              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-info">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's Accept Orders</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white">6</h4>
                    
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold">2430Tk</h3>
            
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                    
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-warning">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Months Orders</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white">13</h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold">5963Tk</h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-warning">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Years Orders</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white">10</h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold">17630Tk</h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-danger">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Products</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white">15</h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold"></h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-warning">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Brand</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white">13</h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold"></h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-danger">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Cancel Orders</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white">0</h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold"></h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-primary">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Category</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white">12</h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold"></h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-warning">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Product Stock</h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white"></h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold">Aviable</h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-danger">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Comments </h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white"></h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold">3 People</h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->

              <div class="col-sm-6 col-xl-3 mt-3">
                <div class="card pd-20 bg-primary">
                  <div class="d-flex justify-content-between align-items-center mg-b-10">
                    <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Coupon </h6>
                    <h4 class=" mg-b-0 tx-spacing-1 tx-white"></h4>
                  </div><!-- card-header -->
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                    <h3 class="mg-b-0 tx-white tx-lato tx-bold">Aviable</h3>
                  </div><!-- card-body -->
                  <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                  </div><!-- -->
                </div><!-- card -->
              </div><!-- col-3 -->


          </div><!-- row -->

          
        </div><!-- sl-pagebody -->
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      <script>
         
        var div = document.getElementById('curr_time'); 
           function time() {
           div.innerHTML = "";
           var d = new Date();
           var t = d.toLocaleTimeString();
           div.innerHTML = t;
           }

       setInterval(time, 1000);

</script>

@endsection

