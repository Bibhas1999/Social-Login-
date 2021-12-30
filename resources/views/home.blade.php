@extends('layouts.app')
@php
    $allData = App\User::all();
    $user = Auth::user(); 
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card text-dark">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if ($user->avatar == null)
                        <img class="profile-user-img img-fluid img-circle" style="height:130px; width:130px"
                        src="{{ !empty($user->image) ? url('./uploads/' . $user->image) : url('./uploads/no-user.png') }}"
                        name="image" alt="User profile picture">
                        @else
                        <img class="profile-user-img img-fluid img-circle" style="height:130px; width:130px"
                        src="{{ Auth::user()->avatar }}" name="image" alt="User profile picture">
                        @endif
                    </div>

                    <h3 class="profile-username text-center text-capitalize">{{ $user->name }}</h3>

                    <p class="text-muted text-center">{{ $user->email }}</p>
                     <h3 class="text-center">
                         <a href="{{route('edit-profile')}}" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i> Edit Profile</a>
                     </h3>
                    
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9 border">
            <h5 class="text-center bg-olive border-rounded shadow-lg py-2 px-2">ALL USERS
                <a href="#" data-target="#userAdd" data-toggle="modal" class="text-md mt-1 float-right btn btn-primary btn-sm">
                    </i><i class="fas fa-plus"></i> Add User
                </a>
            </h5>
            @if (Session::has('msg'))
            <div class="alert alert-primary" role="alert">
               {{Session::get('msg')}}
              </div>
            @endif
            <table id="example1" class="table table-responsive w-100 d-md-table d-block">
                <thead class="bg-olive">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allData as $key => $user)
                    
                        <tr>

                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center" class="text-center">
                                @if ($user->avatar == null)
                                <img class="profile-user-img img-fluid img-circle" style="height:30px; width:30px"
                                src="{{ !empty($user->image) ? url('./uploads/' . $user->image) : url('./uploads/no-user.png') }}"
                                name="image" alt="User profile picture">
                                @else
                                <img class="profile-user-img img-fluid img-circle" style="height:30px; width:30px"
                                src="{{$user->avatar }}" name="image" alt="User profile picture">
                                @endif
                            </td>
                            <td class="text-center" class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-info btn-sm"> <i class="fa fa-edit"></i> Edit</a>
                                
                                    <a href="{{ route('users.delete', $user->id) }}"
                                        class="btn btn-danger btn-sm" id="delete"> Delete</a>

                                        <a href="{{ route('payments.view', $user->id) }}"
                                            class="btn btn-success btn-sm" id="delete">Pay Fees</a>
                                
                            </td>
                        </tr>
                     
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
</div>

 {{-- user Add --}}
 <div class="modal fade bd-example-modal-lg" id="userAdd" tabindex="-1" role="dialog"
 aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
     <div class="modal-content">
         <div class="modal-header bg-primary">
             <h5 class="modal-title text-white" id="exampleModalLabel">Add User</h5>
             <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
             <form role="form" method="POST" action="{{ route('users.store') }}" id="myForm" enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                     
                     <div class="col-sm-4">
                         <div class="form-group">
                             <label>Username</label>
                             <input type="text" class="form-control form-control-sm" placeholder="Enter Username" name="name">
                            
                         </div>
                     </div>
                     <div class="col-sm-4">
                         <div class="form-group">
                             <label>Email</label>
                             <input type="email" class="form-control form-control-sm" placeholder="Enter Email" name="email">
                             <font class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}
                             </font>
                         </div>
                     </div>

                     <div class="col-sm-4">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control form-control-sm" name="image">
                         
                        </div>
                    </div>
                 </div>

                 <div class="row">
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
                 </div>
                 <div class="form-group pt-2">
                     <input type="submit" value="Submit" class="btn btn-md btn-primary px-4">
                 </div>
             </form>
         </div>
     </div>
 </div>
</div>
{{-- user add modal --}}
@endsection
