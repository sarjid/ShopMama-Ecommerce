@extends('admin.admin_layouts.admin_master')
@section('admin_title') Profile @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Shop MaMa</a>
        <span class="breadcrumb-item active">Profile</span>
    </nav>

    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
        <div class="row row-sm">
            <div class="col-md-4 ">
                <div class="card " style="width: 18rem;">
                  <img class="card-img-top"  style="border-radius: 50%;" src="{{ asset(Auth::user()->image) }}" height="100%;" width="100%;" alt="Card image cap">
                <div class="card-body">
                  <ul class="list-group list-group-flush text-center">
                    <a href="{{ url('admin/profile') }}" class="btn btn-primary btn-sm btn-block @yield('user-home')" style="margin-top: 5px;">Home</a>
                    <a href="{{ url('admin/password') }}" class="btn btn-primary btn-sm btn-block @yield('user-pass')">Change Password</a>                  
                    <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-sm btn-block"><i class="icon ion-power"></i> Log Out</a>
                    
                  </ul>
                </div>                
                </div>
              </div>  
              
            <div div class="col-md-8 mt-1">
                <div class="card">
                <h3 class="text-center"> <span class="text-danger">Hi..!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your profile</h3>
                    
                    <div class="card-body">
                         <form action="{{ url('admin/profile-update') }}" method="POST" enctype="multipart/form-data">
                            @csrf       
                          <input type="hidden" name="old_image" value="{{ Auth::user()->image }}">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ Auth::user()->name }}">
    
                            @error('name')
                          <span class="text-danger">{{$message}}</span>
                            @enderror
    
                          </div>
    
    
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ Auth::user()->email }}">
    
                            @error('email')
                          <span class="text-danger">{{$message}}</span>
                            @enderror
    
                          </div>
    
                          <div class="form-group">
                            <label for="exampleInputEmail1">Profile Picture</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" >
                            @error('image')
                          <span class="text-danger">{{$message}}</span>
                            @enderror
    
                          </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Update Data</button>
                        </div>
                      
                    </form>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection