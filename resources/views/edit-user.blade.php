@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-md-12 border">
            <h5 class="text-center bg-olive border-rounded shadow-lg py-2 ">Edit User
                <a href="{{route('home')}}"  class="text-md mt-1 float-left btn btn-primary btn-sm">
                    </i><i class="fas fa-arrow-left"></i> Back
                </a>
            </h5>
            <form role="form" method="POST" action="{{ route('users.update',$editData->id) }}" id="myForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Enter Username" name="name" value="{{$editData->name}}">
                           
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-sm" placeholder="Enter Email" name="email" value="{{$editData->email}}" >
                            <font class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}
                            </font>
                        </div>
                    </div>
            
                    <div class="col-sm-4">
                       <div class="form-group">
                           <label>Image</label>
                           <input type="file" class="form-control form-control-sm" name="image">
                           <font class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}
                           </font>
                       </div>
                   </div>
                </div>
            
                {{-- <div class="row">
                    <div class="col-sm-5">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control form-control-sm" placeholder="Enter Password"
                                name="password" id="password">
                            <font class="text-danger">
                                {{ $errors->has('password') ? $errors->first('password') : '' }}</font>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control form-control-sm" placeholder="Retype Password"
                                name="password2">
                            <font class="text-danger">
                                {{ $errors->has('password2') ? $errors->first('password2') : '' }}</font>
                        </div>
                    </div>
                </div> --}}
                <div class="form-group pt-2">
                    <input type="submit" value="Submit" class="btn btn-md btn-primary px-4">
                </div>
            </form>
        </div>
    </div>
</div>
  
@endsection