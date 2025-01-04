<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StaffController extends controller
{
    public function StaffDashboard(){
        return view('staff.index');
    }

    public function staffLogout(){
        Auth::guard('web')->logout();
        return redirect('/staff/login');
    }

    public function staffLogin(){
        return view('staff.staff_login');
    }

    public function staffProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('staff.staff_profile', compact('profileData'));
    }

    public function staffProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/staff_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/staff_images'),$filename);
            $data['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Profile Staff Berhasil diganti',
            'alert-type' => 'success',
        );

        $data->save();

        return redirect()->back()->with($notification);
    }

    public function staffPassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('staff.staff_password', compact('profileData'));
    }

    public function staffUpdatePassword(Request $request){
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
            'message' => 'Password Berhasil diganti',
            'alert-type' => 'success',
        );

        return redirect('/staff/login');

    }
}
