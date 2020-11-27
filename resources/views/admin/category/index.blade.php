@extends('admin.admin_layouts.admin_master')
@section('categories') active show-sub @endsection
@section('category') active @endsection
@section('admin_title') Category @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Category</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">Category List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-15p">SL</th>
                                  <th class="wd-15p">Icon</th>
                                  <th class="wd-15p">Category Name En </th>
                                  <th class="wd-15p">Category Name Bn </th>
                                  <th class="wd-20p">Status</th>
                                  <th class="wd-25p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php 
                                 $i = 1;
                                @endphp
                                @foreach ($categories as $row)                                  
                                <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>
                                    <i class="{{ $row->category_icon }}" title="{{ $row->category_icon }}"></i>
                                  </td>
                                  <td>
                                    {{ $row->category_name_en }}
                                  </td>
                                  <td>
                                    {{ $row->category_name_bn }}
                                  </td>
                                  <td>
                                    @if($row->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">Inactive</span>

                                    @endif
                                  </td>
                                  <td>
                                    <a href="{{ url('admin/categories-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/categories-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                                    @if($row->status == 1)
                                    <a href="{{ url('admin/categories-inactive/'.$row->id) }}" class="btn btn-sm btn-danger" title="Click to Inactive"><i class="fa fa-arrow-down"></i></a>
                                    @else 
                                    <a href="{{ url('admin/categories-active/'.$row->id) }}" class="btn btn-sm btn-success" title="click to active"><i class="fa fa-arrow-up"></i></a>
                                    @endif
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
                        <h5 class="text-danger text-center">Add Category</h5>
                        <hr>
                          <form action="{{ route('store.category') }}" method="POST" >
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Category Name English:<span class="text-danger">*</span></label>
                                <input type="text" name="category_name_en" class="form-control @error('category_name_en') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('category_name_en') }}" aria-describedby="emailHelp" placeholder="category Name English">
      
                                @error('category_name_en')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Category Name Bangla:<span class="text-danger">*</span></label>
                                <input type="text" name="category_name_bn" class="form-control @error('category_name_bn') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('category_name_bn') }}" aria-describedby="emailHelp" placeholder="category Name Bangla">
      
                                @error('category_name_bn')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Icon Class Name: <span class="text-danger">*</span></label>
                                  <input type="text" name="category_icon" class="form-control @error('category_icon') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('category_icon') }}" aria-describedby="emailHelp" placeholder="fa fa-icon name" >
                              
                                  @error('category_icon')
                                <strong class="text-danger">{{$message}}</strong>
                                  @enderror
      
                                </div>
          
      
                              <button type="submit" class="btn btn-primary">Add Category</button>
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

