@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-md-12 border">
            <h5 class="text-center bg-olive border-rounded shadow-lg py-2 ">Change Password 
                <a href="{{route('home')}}"  class="text-md mt-1 float-left btn btn-primary btn-sm">
                    </i><i class="fas fa-arrow-left"></i> Back
                </a>
            </h5>
            <form role="form" method="POST" action="{{route('profiles.password.update')}}" id="myForm" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control form-control-sm" placeholder="Enter Current Password"
                                name="current_password" id="password">
                            <font class="text-danger">
                                {{ $errors->has('password') ? $errors->first('password') : '' }}</font>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control form-control-sm" placeholder="Enter New Password"
                                name="new_password" id="password">
                            <font class="text-danger">
                                {{ $errors->has('password') ? $errors->first('password') : '' }}</font>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control form-control-sm" placeholder="Confirm New Password"
                                name="confirm_password">
                            <font class="text-danger">
                                {{ $errors->has('password2') ? $errors->first('password2') : '' }}</font>
                        </div>
                    </div>
                </div>
                <div class="form-group pt-2">
                    <input type="submit" value="Submit" class="btn btn-md btn-primary px-4">
                </div>
            </form>
        </div>
    </div>
</div>
  
@endsection