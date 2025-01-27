<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Models\Sekolah;
use App\Models\User;

class SekolahController extends Controller
{
    public function ProfileSekolah(){
        $profileSekolah = Sekolah::latest()->get();
        // dd($profileSekolah);
        return view('admin.backend.sekolah.sekolah_profile', compact('profileSekolah'));
    }

    public function EditProfileSekolah($id){
        $sekolah = Sekolah::find($id);
        $kepsek = User::where('jenis_user', 'wakil')->get();
        return view('admin.backend.sekolah.edit_sekolah_profile', compact('sekolah', 'kepsek'));
    }

    public function UpdateProfileSekolah(Request $request){
        $id = $request->id;
        $data = Sekolah::find($id);
        // dd($data->logo_sekolah);
        if($request->file('logo_sekolah')){
            @unlink(public_path($data->logo_sekolah));
            $manager = new ImageManager(new Driver());
            $image_gen = hexdec(uniqid()).'.'.$request->file('logo_sekolah')->getClientOriginalExtension();
            $img = $manager->read($request->file('logo_sekolah'));
            $img = $img->resize(370,370);
            $img->toPng()->save(base_path('public/upload/logo_sekolah/'.$image_gen));
            $save_url = 'upload/logo_sekolah/'.$image_gen;


            Sekolah::find($id)->update([
                'nama' => $request->nama,
                'npsn' => $request->npsn,
                'nss' => $request->nss,
                'guru_id' => $request->guru_id,
                'alamat' => $request->alamat,
                'desa_kelurahan' => $request->desa_kelurahan,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'email' => $request->email,
                'website' => $request->website,
                'logo_sekolah' => $save_url,
            ]);

            $notification = array(
                'message' => 'Logo dan Data Sekolah Berhasil diganti',
                'alert-type' => 'success',
            );
            return redirect()->route('profile.sekolah')->with($notification);
         }else{
            Sekolah::find($id)->update([
                'nama' => $request->nama,
                'npsn' => $request->npsn,
                'guru_id' => $request->guru_id,
                'nss' => $request->nss,
                'alamat' => $request->alamat,
                'desa_kelurahan' => $request->desa_kelurahan,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'email' => $request->email,
                'website' => $request->website,
            ]);

            $notification = array(
                'message' => 'Data Sekolah Berhasil diganti',
                'alert-type' => 'success',
            );

            return redirect()->route('profile.sekolah')->with($notification);
         }

    }

}
