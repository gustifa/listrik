<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function SemuaJurusan(){
        $jurusan = Jurusan::latest()->get();
        return view('admin.backend.jurusan.semua_jurusan', compact('jurusan'));
    }

    public function TambahJurusan(){
        $jurusan = Jurusan::latest()->get();
        return view('admin.backend.jurusan.tambah_jurusan', compact('jurusan'));
    }

    public function SimpanJurusan(Request $request){
        if($request->file('logo_jurusan')){
            $manager = new ImageManager(new Driver());
            $image_gen = hexdec(uniqid()).'.'.$request->file('logo_jurusan')->getClientOriginalExtension();
            $img = $manager->read($request->file('logo_jurusan'));
            $img = $img->resize(370,246);
            $img->toPng()->save(base_path('public/upload/logo_jurusan/'.$image_gen));
            $save_url = 'upload/logo_jurusan/'.$image_gen;


            Jurusan::insert([
                'nama_jurusan' => $request->nama_jurusan,
                'kode_jurusan' => strtoupper($request->kode_jurusan),
                'slug_jurusan' => strtolower(str_replace(' ', '-',$request->slug_jurusan)),
                'logo_jurusan' => $save_url,
            ]);


            $notification = array(
                'message' => 'Jurusan Berhasil ditambahkan',
                'alert-type' => 'success',
            );
            return redirect()->route('semua.jurusan')->with($notification);
         }else{
            Jurusan::insert([
                'nama_jurusan' => $request->nama_jurusan,
                'kode_jurusan' => strtoupper($request->kode_jurusan),
                'slug_jurusan' => strtolower(str_replace(' ', '-',$request->nama_jurusan)),
            ]);

            $notification = array(
                'message' => 'Jurusan Berhasil ditambahkan',
                'alert-type' => 'success',
            );

            return redirect()->route('semua.jurusan')->with($notification);
         }

    }

    public function EditJurusan($id){
        $jurusan = Jurusan::find($id);
        return view('admin.backend.jurusan.edit_jurusan', compact('jurusan'));
    }

    public function UpdateJurusan(Request $request){
        $id = $request->id;
        $data = Jurusan::find($id);
        // dd($data->logo_sekolah);
        if($request->file('logo_jurusan')){
            @unlink(public_path($data->logo_sekolah));
            $manager = new ImageManager(new Driver());
            $image_gen = hexdec(uniqid()).'.'.$request->file('logo_jurusan')->getClientOriginalExtension();
            $img = $manager->read($request->file('logo_jurusan'));
            $img = $img->resize(370,370);
            $img->toPng()->save(base_path('public/upload/logo_jurusan/'.$image_gen));
            $save_url = 'upload/logo_jurusan/'.$image_gen;


            Jurusan::find($id)->update([
                'nama_jurusan' => $request->nama_jurusan,
                'kode_jurusan' => strtoupper($request->kode_jurusan),
                'slug_jurusan' => strtolower(str_replace(' ', '-',$request->nama_jurusan)),
                'logo_jurusan' => $save_url,
            ]);

            $notification = array(
                'message' => 'Logo Berhasil diganti',
                'alert-type' => 'success',
            );
            return redirect()->route('semua.jurusan')->with($notification);
         }else{
            Jurusan::find($id)->update([
                'nama_jurusan' => $request->nama_jurusan,
                'kode_jurusan' => strtoupper($request->kode_jurusan),
                'slug_jurusan' => strtolower(str_replace(' ', '-',$request->nama_jurusan)),
            ]);

            $notification = array(
                'message' => 'Jurusan Berhasil diganti',
                'alert-type' => 'success',
            );

            return redirect()->route('semua.jurusan')->with($notification);
         }

    }
}
