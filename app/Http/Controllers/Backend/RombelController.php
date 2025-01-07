<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Rombel;
use App\Models\Jurusan;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Group;


class RombelController extends Controller
{
    public function SemuaRombel(){
        $rombel = Rombel::latest()->get();
        return view('admin.backend.rombel.semua_rombel', compact('rombel'));
    }

    public function TambahRombel(){
        $user = User::where('role', 'guru')->get();
        $jurusan = Jurusan::latest()->get();
        $tingkat = Kelas::latest()->get();
        $group = Group::latest()->get();
        return view('admin.backend.rombel.tambah_rombel', compact('jurusan', 'user', 'tingkat', 'group'));
    }

    public function SimpanRombel(Request $request){
        
        $request->validate([
            // 'name' => ['required','string','max:255'],
            'walas_id' => ['required', 'string','unique:rombels'],
        ]);
            Rombel::insert([
                'kelas_id' => $request->kelas_id,
                'jurusan_id' => $request->jurusan_id,
                'group_id' => $request->group_id,
                'walas_id' => $request->walas_id,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Rombel Berhasil ditambahkan',
                'alert-type' => 'success',
            );

            return redirect()->route('semua.rombel')->with($notification);

    }

    public function EditJurusan($id){
        $jurusan = Rombel::find($id);
        // $user = User::where('role', 'wakil')->get();
        return view('admin.backend.jurusan.edit_jurusan', compact('jurusan', 'user'));
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
                'user_id' => $request->user_id,
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
                'user_id' => $request->user_id,
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
