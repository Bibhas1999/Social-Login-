<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function edit($id)
    {

        $data['editData'] = User::find($id);
        return view('edit-user', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required',
            'password2' => 'required',
        ]);
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $imageName = $request->image->getClientOriginalName();
        $data->image = $request->image->move('uploads', $imageName);
        $data->image = $imageName;
        $data->save();

        return redirect()->route('home')->with('msg', 'User Created Successfully');

    }

    public function update(Request $request, $id)
    {

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('uploads/' . $data->image));
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = $filename;
        }

        $data->save();
        return redirect()->route('home')->with('msg', 'User Updated Successfully');

    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('home')->with('msg', 'User Deleted Successfully');
    }

    public function editProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('edit-profile', compact('editData'));
    }

    public function updateProfile(Request $request)
    {
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('uploads' . $data->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = $filename;
        }

        $data->save();
        return redirect()->route('home')->with('msg', 'Profile Updated Successfully');
    }
    public function passwordEdit()
    {

        return view('edit-password');
    }

    public function passwordUpdate(Request $request)
    {

        if (Auth::attempt(['id' => Auth::user()->id, 'password' => $request->current_password])) {
            
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            if ($user->save()) {
                Alert::success('Success', 'Password Changed Successfully');
                return redirect()->route('profiles.view');
            }
        } else {
            Alert::error('Ooopss', 'your current password is incorrect');
        }

        return view('backend.user.edit-password');
    }
}
