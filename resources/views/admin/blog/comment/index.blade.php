@extends('admin.admin_layouts.admin_master')
@section('blogs') active show-sub @endsection
@section('blog-comment') active @endsection
@section('admin_title') Blog-Comment @endsection
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
          <span class="breadcrumb-item active">Blog Comments</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">Comment List <br>
                
                        </div> 
                        
                        <div class="card-body">
                          <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                              <thead>
                                <tr>
                                  <th class="wd-15p">Post Image</th>
                                  <th class="wd-25p">Post Title</th>
                                  <th class="wd-15p">Name</th>
                                  <th class="wd-30p">Comment</th>
                                  <th class="wd-15p">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($comments as $row)                                   
                                    <tr>
                                        <td>
                                            <img src="{{ asset($row->blog->post_image) }}" height="44px;" width="78px;" alt="post_image">
                                        </td>
                                        <td>{{ Str::limit($row->blog->post_title_en,40) }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ Str::limit($row->comment,20) }}</td>
                                        <td>
                                            <a href="{{ url('admin/blogs/comments-view/'.$row->id) }}" class="btn btn-sm btn-primary" title="view data"> <i class="fa fa-eye"></i>
                                            </a>                                         
                                            <a href="{{ url('admin/blogs/comments-delete/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i>
                                            </a>
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

