@extends('admin.admin_layouts.admin_master')
@section('testimonial') active @endsection
@section('admin_title') testimonial @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">testimonial</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">testimonial List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                 
                                  <th class="wd-20p">Cient Name</th>
                                  <th class="wd-35p">Review </th>
                                  <th class="wd-20p">Image</th>
                                  <th class="wd-25p">Action</th>
                                </tr>
                              </thead>
                              <tbody
                              
                                @foreach ($testimonials as $row)                                  
                                <tr>
                                  
                                  <td>{{ $row->client_name }}
                                  </td>
                                  <td>
                                      <textarea name="" id="" class="form-control" cols="30" rows="3" disabled>{{ $row->review }}</textarea>
                                     
                                  </td>
                                  <td>
                                    <img src="{{ asset($row->image) }}" alt="{{ $row->client_name  }}" style="width: 74px; height:74px;">
                                  </td>
                                  
                                  <td>
                                    <a href="{{ url('admin/testimonial-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/testimonial-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                                 
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
                        <h5 class="text-danger text-center">New Testimonial Add</h5>
                        <hr>
                          <form action="{{ route('store.testimonial') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Client Name <span class="text-danger"></span></label>
                                <input type="text" name="client_name" class="form-control @error('client_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="client name" data-validation="required">
      
                                @error('client_name')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Client Review <span class="text-danger"></span></label>
                                 <textarea name="review" id="exampleInputEmail1" cols="30" rows="5" class="form-control @error('review') is-invalid @enderror" placeholder="client review" data-validation="required"></textarea>
                                @error('review')
                              <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>
      
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Image <span class="text-danger">*</span></label>
                                  <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  onchange="readURL(this);" data-validation="required" >
                                  <img src="#" id="one" >
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

