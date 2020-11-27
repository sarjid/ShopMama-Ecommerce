@extends('admin.admin_layouts.admin_master')
@section('reports') active show-sub @endsection
@section('search-orders') active  @endsection
@section('admin_title') Search Orders @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="">Shop MaMa</a>
          <span class="breadcrumb-item active">Search Orders</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm">
                <div class="card pd-20 pd-sm-40 mg-t-50">
                    <h6 class="card-body-title">Search Orders</h6>
                    <div class="row">
                      <div class="col-md-4 mg-t-20 mg-md-t-0">
                        <div class="card rounded-0">
                          <div class="card-header card-header-default bg-primary">
                            Sarch By Date
                          </div><!-- card-header -->
                        <form action="{{ route('search-order-date') }}" method="POST">
                          @csrf
                          <div class="form-group">
                            <label for="exampleInputEmail1">select date: <span class="text-danger">*</span></label>
                            <input type="date" name="search_date" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" max="{{ carbon\Carbon::now()->format('m/d/y') }}" data-validation="required">

                            @error('search_date')
                          <strong class="text-danger">{{$message}}</strong>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-primary">Search</button>
                      </form>
                        </div><!-- card -->
                      </div><!-- col -->
                      <div class="col-md-4 mg-t-20 mg-md-t-0">
                        <div class="card bd-0">
                          <div class="card-header card-header-default bg-primary">
                           Search By Month
                          </div><!-- card-header -->
                      <form action="{{ route('search-order-month') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">Select Month: <span class="text-danger">*</span></label>
                              <select class="form-control select2" name="month_name" data-placeholder="Choose one" data-validation="required">
                                <option label="Choose one"></option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>                           
                              </select> 
                              @error('month_name')
                              <strong class="text-danger">{{$message}}</strong>
                              @enderror
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Select Year: <span class="text-danger">*</span></label>
                              <select class="form-control select2" name="year_name" data-placeholder="Choose one" data-validation="required">
                                <option label="Choose one"></option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                              </select> 
                              @error('year_name')
                              <strong class="text-danger">{{$message}}</strong>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                      </form>
                        </div><!-- card -->
                      </div><!-- col -->
                      <div class="col-md-4 mg-t-20 mg-md-t-0">
                        <div class="card bd-0">
                          <div class="card-header card-header-default bg-primary">
                          Search Order By Year
                          </div><!-- card-header -->
                          <form action="{{ route('search-order-year') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">Select Year: <span class="text-danger">*</span></label>
                              <select class="form-control select2" name="year_name" data-placeholder="Choose one" data-validation="required">
                                <option label="Choose one"></option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                              </select> 
                              @error('year_name')
                              <strong class="text-danger">{{$message}}</strong>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        </div><!-- card -->
                      </div><!-- col -->
          
                     
                    </div><!-- row -->
                  </div><!-- card -->
            </div>
        </div> 
</div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

