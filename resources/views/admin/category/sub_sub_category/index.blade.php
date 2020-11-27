@extends('admin.admin_layouts.admin_master')
@section('categories') active show-sub @endsection
@section('sub_sub_category') active @endsection
@section('admin_title') Sub-Sub-Category @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Sub-Sub-Category</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">Sub-Category List</div>        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-15p">Name Bn</th>
                                  <th class="wd-15p">Name En</th>
                                  <th class="wd-15p">Sub-Category Name </th>
                                  <th class="wd-20p">Status</th>
                                  <th class="wd-25p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              
                                @foreach ($subsubcategories as $row)                                  
                                <tr>
                                  <td>{{ $row->subsubcategory_name_en}}</td>
                                  <td>{{ $row->subsubcategory_name_bn}}</td>
                                  <td>
                                    {{ $row->category->category_name_en }} =>
                                    {{ $row->subcategory->subcategory_name_en }}
                                  
                                  </td>
                                  <td>
                                    @if($row->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">Inactive</span>

                                    @endif
                                  </td>
                                  <td>
                                    <a href="{{ url('admin/sub-sub-categories-edit/'.$row->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('admin/sub-sub-categories-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                                    @if($row->status == 1)
                                    <a href="{{ url('admin/sub-sub-categories-inactive/'.$row->id) }}" class="btn btn-sm btn-danger" title="Click to Inactive"><i class="fa fa-arrow-down"></i></a>
                                    @else 
                                    <a href="{{ url('admin/sub-sub-categories-active/'.$row->id) }}" class="btn btn-sm btn-success" title="click to active"><i class="fa fa-arrow-up"></i></a>
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
                        <h5 class="text-danger text-center">Add Sub-sub-Category</h5>
                        <hr>
                          <form action="{{ route('store.sub-sub-category') }}" method="POST" >
                              @csrf
                              <div class="form-group">
                                <label for="exampleInputEmail1">Category:<span class="text-danger">*</span></label>
                                <select name="category_id" id="exampleInputEmail1" class="form-control select2-show-search" data-placeholder="Choose one" data-validation="required">
                                  <option label="Choose one"></option>
                                  @foreach ($categories as $row)
                                  <option value="{{ $row->id }}">{{ $row->category_name_en }}</option>                            
                                  @endforeach
                                </select>
      
                                @error('category_id')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>   

                              <div class="form-group">
                                <label for="exampleInputEmail1">Select Sub-Category:<span class="text-danger">*</span></label>
                                <select name="subcategory_id" id="exampleInputEmail1" class="form-control  select2-show-search" data-placeholder="Choose one" data-validation="required">
                                  
                                <option label="Choose one"></option>          
                                </select>
      
                                @error('subcategory_id')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
      
                              </div>   

                              <div class="form-group">
                                <label for="exampleInputEmail1">Sub-Category English: <span class="text-danger">*</span></label>
                                <input type="text" name="subsubcategory_name_en" class="form-control @error('subsubcategory_name_en') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('subsubcategory_name_en') }}" aria-describedby="emailHelp" placeholder="sub-sub-category english">
      
                                @error('subsubcategory_name_en')
                              <strong class="text-danger">{{$message}}</strong>
                               @enderror
      
                              </div>   

                              <div class="form-group">
                                <label for="exampleInputEmail1">Sub-Category Bangla: <span class="text-danger">*</span></label>
                                <input type="text" name="subsubcategory_name_bn" class="form-control @error('subsubcategory_name_bn') is-invalid @enderror" id="exampleInputEmail1" value="{{ old('subsubcategory_name_bn') }}" aria-describedby="emailHelp" placeholder="sub-sub-category bangla">
      
                                @error('subsubcategory_name_bn')
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

      <script src="{{asset('backend')}}/lib/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
      
      <script type="text/javascript">
        $(document).ready(function() {
          $('select[name="category_id"]').on('change', function(){
              var category_id = $(this).val();
              if(category_id) {
                  $.ajax({
                      url: "{{  url('/admin/subcategory/ajax') }}/"+category_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
      
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
      
                            });
      
                      },
      
                  });
              } else {
                  alert('danger');
              }
      
          });
          
      });
      
      </script>   
      
@endsection

