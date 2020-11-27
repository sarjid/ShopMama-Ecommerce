@extends('admin.admin_layouts.admin_master')
@section('slider') active @endsection
@section('admin_title') slider @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">slider</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">slider List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                 
                                  <th class="wd-20p">Slider Title</th>
                                  <th class="wd-30p">slider description </th>
                                  <th class="wd-20p">slider Image</th>
                                  <th class="wd-5">Status</th>
                                  <th class="wd-25p">Action</th>
                                </tr>
                              </thead>
                              <tbody
                              
                                @foreach ($sliders as $row)                                  
                                <tr>
                                  
                                  <td>
                                      @if ($row->title == NULL)
                                        <span class="badge badge-pill badge-danger">No Title</span>
                                        @else 
                                        {{ $row->title }}
                                      @endif
                                  </td>
                                  <td>
                                    @if ($row->description == NULL)
                                    <span class="badge badge-pill badge-danger">No description</span>
                                    @else 
                                      <textarea name="" id="" class="form-control" cols="30" rows="2" disabled>{{ $row->description }}</textarea>
                                      @endif
                                  </td>
                                  <td>
                                    <img src="{{ asset($row->image) }}" alt="{{ $row->title  }}" style="width: 215px; height:74px;">
                                  </td>
                                  <td>
                                    @if($row->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">Inactive</span>

                                    @endif
                                  </td>
                                  <td>
                                    <a href="{{ url('admin/slider-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/slider-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                                    @if($row->status == 1)
                                    <a href="{{ url('admin/slider-inactive/'.$row->id) }}" class="btn btn-sm btn-danger" title="Click to Inactive"><i class="fa fa-arrow-down"></i></a>
                                    @else 
                                    <a href="{{ url('admin/slider-active/'.$row->id) }}" class="btn btn-sm btn-success" title="click to active"><i class="fa fa-arrow-up"></i></a>
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
                        <h5 class="text-danger text-center">New Slider Add</h5>
                        <hr>
                          <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Slider Title <span class="text-danger"></span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="slider title" >
      
                                @error('title')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Slider Description <span class="text-danger"></span></label>
                                 <textarea name="description" id="exampleInputEmail1" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="slider short text"></textarea>
                                @error('description')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Image <span class="text-danger">*</span></label>
                                  <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  onchange="readURLslider(this);" data-validation="required" >
                                  <small class="text-danger">size must be 870 370 px</small> <br>
                                  <img src="#" id="slider_image" >
                                  @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                                  @enderror
      
                                </div>
          
      
                              <button type="submit" class="btn btn-primary">Submit</button>
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

