@extends('admin.admin_layouts.admin_master')
@section('blogs') active show-sub @endsection
@section('manage-post') active @endsection
@section('admin_title') Manage-Post @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Manage Post</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">Post List <br>
                
                        </div> 
                        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-15p">SL</th>
                                  <th class="wd-15p">Image</th>
                                  <th class="wd-15p">Title</th>
                                  <th class="wd-15p">Category</th>
                                  <th class="wd-15p">Status</th>
                                  <th class="wd-25p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($posts as $row)                                   
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <img src="{{ asset($row->post_image) }}" height="44px;" width="78px;" alt="">
                                        </td>
                                        <td>
                                            {{ Str::limit($row->post_title_en,20) }}
                                        </td>
                                        <td>{{ $row->post_category->category_name_en }} =>
                                            {{ $row->post_subcategory->subcategory_name_en }}

                                        </td>
                                        <td>
                                            @if($row->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>      
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/blogs-post-view/'.$row->id.'/'.$row->post_slug_en) }}" class="btn btn-sm btn-primary" title="view data"> <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('admin/blogs-post-edit/'.$row->id.'/'.$row->post_slug_en) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ url('admin/blogs-post-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i>
                                            </a>
                                            @if($row->status == 1)
                                            <a href="{{ url('admin/blogs-post-inactive/'.$row->id) }}" class="btn btn-sm btn-danger" title="Click to Inactive"><i class="fa fa-arrow-down"></i>
                                            </a>
                                            @else 
                                            <a href="{{ url('admin/blogs-post-active/'.$row->id) }}" class="btn btn-sm btn-success" title="click to active"><i class="fa fa-arrow-up"></i>
                                            </a>
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
        

        
            </div>
          </div><!-- row -->

          
        </div><!-- sl-pagebody -->
        
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      
@endsection

