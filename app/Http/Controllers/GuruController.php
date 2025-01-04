<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class GuruController extends Controller
{
    public function GuruDashboard(){
        return view('guru.index');
    }

    public function GuruLogout(){
        Auth::guard('web')->logout();
        return redirect('/guru/login');
    }

    public function GuruLogin(){
        return view('guru.guru_login');
    }

    public function GuruProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('guru.guru_profile', compact('profileData'));
    }

    public function GuruProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/guru_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/guru_images'),$filename);
            $data['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Profile Guru Berhasil diganti',
            'alert-type' => 'success',
        );

        $data->save();

        return redirect()->back()->with($notification);
    }

    public function GuruPassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('guru.guru_password', compact('profileData'));
    }

    public function GuruUpdatePassword(Request $request){
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

        return redirect('/guru/login');

    }
}
