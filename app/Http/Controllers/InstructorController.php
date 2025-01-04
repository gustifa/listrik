<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InstructorController extends Controller
{
    public function InstructorDashboard(){
        return view('instructor.index');
    }

    public function InstructorLogout(){
        Auth::guard('web')->logout();
        return redirect('/instructor/login');
    }

    public function InstructorLogin(){
        return view('instructor.instructor_login');
    }

    public function InstructorProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('instructor.instructor_profile', compact('profileData'));
    }

    public function InstructorProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/instructor_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/instructor_images'),$filename);
            $data['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Instructor Profile Update Succesfully',
            'alert-type' => 'success',
        );

        $data->save();

        return redirect()->back()->with($notification);
    }

    public function InstructorPassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('instructor.instructor_password', compact('profileData'));
    }

    public function InstructorUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Not Match',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => 'Change Password Update Succesfully',
            'alert-type' => 'success',
        );

        return back()->with($notification);

    }
}
