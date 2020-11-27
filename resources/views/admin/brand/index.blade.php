@extends('admin.admin_layouts.admin_master')
@section('brands') active @endsection
@section('admin_title') Brands @endsection
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Brands</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">Brands List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-15p">SL</th>
                                  <th class="wd-15p">Brand Name En</th>
                                  <th class="wd-15p">Brand Name Bn</th>
                                  <th class="wd-15p">Brand Image</th>
                                  <th class="wd-20p">Status</th>
                                  <th class="wd-25p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php 
                                 $i = 1;
                                @endphp
                                @foreach ($brands as $row)                                  
                                <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $row->brand_name_en }}</td>
                                  <td>{{ $row->brand_name_bn }}</td>
                                  <td>
                                    <img src="{{ asset($row->brand_image) }}" alt="{{ $row->brand_name  }}" width="55px;" width="83px;">
                                  </td>
                                  <td>
                                    @if($row->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">Inactive</span>

                                    @endif
                                  </td>
                                  <td>
                                    <a href="{{ url('admin/brands-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/brands-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                                    @if($row->status == 1)
                                    <a href="{{ url('admin/brands-inactive/'.$row->id) }}" class="btn btn-sm btn-danger" title="Click to Inactive"><i class="fa fa-arrow-down"></i></a>
                                    @else 
                                    <a href="{{ url('admin/brands-active/'.$row->id) }}" class="btn btn-sm btn-success" title="click to active"><i class="fa fa-arrow-up"></i></a>
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
                        <h5 class="text-danger text-center">Brand Add</h5>
                        <hr>
                          <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name English <span class="text-danger">*</span></label>
                                <input type="text" name="brand_name_en" class="form-control @error('brand_name_en') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Brand Name English">
      
                                @error('brand_name_en')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name Bangla <span class="text-danger">*</span></label>
                                <input type="text" name="brand_name_bn" class="form-control @error('brand_name_bn') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Brand Name Bangla">
      
                                @error('brand_name_bn')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Image <span class="text-danger">*</span></label>
                                  <input type="file" name="brand_image" class="form-control @error('brand_image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  onchange="readURL(this);" >
                                  <img src="#" id="one" >
                                  @error('brand_image')
                                <strong class="text-danger">{{$message}}</strong>
                                  @enderror
      
                                </div>
          
      
                              <button type="submit" class="btn btn-primary">Add Brand</button>
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

