<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Models\Rombel;
use App\Models\Jurusan;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Group;
use App\Models\Proka;
use App\Models\AnggotaRombel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class RombelController extends Controller
{
    public function SemuaRombel(){
        $rombel = Rombel::latest()->get();
        $proka = Proka::latest()->get();
        $siswa = User::where('jenis_user', 'siswa')->get();
        $guru = User::where('jenis_user', 'guru')->get();
       
        $anggota_rombel = AnggotaRombel::all();
        return view('admin.backend.rombel.semua_rombel', compact('rombel', 'proka', 'siswa', 'guru', 'anggota_rombel'));
    }

    public function TambahRombel(){
        // $guru = User::where('jenis_user', 'guru')->get();
        $guru = DB::table('rombels')
            ->rightjoin('users', 'rombels.walas_id', '=', 'users.id')
            ->where('jenis_user', 'guru')
            ->whereNull('rombels.walas_id')
            ->get();
        // $c = User::leftJoin('orders', function($join) {
        //     $join->on('customers.id', '=', 'orders.customer_id');
        //   })
        //   ->whereNull('orders.customer_id')
        //   ->first();
        // $guru = DB::select("SELECT * FROM users");
        $siswa = User::where('jenis_user', 'siswa')->get();
        $proka = Proka::latest()->get();
        $jurusan = Jurusan::latest()->get();
        $tingkat = Kelas::latest()->get();
        $group = Group::latest()->get();
        return view('admin.backend.rombel.tambah_rombel', compact('jurusan', 'guru', 'tingkat', 'group', 'proka', 'siswa'));
    }

    public function SimpanRombel(Request $request){
        // $id = $request->id;
        // dd($id);
        // $request->validate([
        //     'nama_rombel' => ['required','string','max:255'],
        //     'walas_id' => ['required', 'string','unique:rombels'],
        // ]);
            Rombel::insert([
                'id' => Str::uuid(),
                'jurusan_id' => $request->jurusan_id,
                'nama_rombel' => strtoupper($request->nama_rombel),
                'walas_id' => $request->walas_id,
                // 'siswa_id' => $request->siswa_id,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Rombel Berhasil ditambahkan',
                'alert-type' => 'success',
            );

            return redirect()->route('semua.rombel')->with($notification);

    }

    public function DetailRombel($id){
        $anggota_rombel = AnggotaRombel::where('rombel_id', $id)->get();
        $walas_id = Rombel::where('id',$id)->get();
        $nama_walas = $walas_id->implode('walas_id');
        $wali_kelas = User::find($nama_walas);
        // dd($walas_id);
        return view('admin.backend.rombel.rombel_anggota_rombel', compact('anggota_rombel','wali_kelas'));
    }

    

    public function GetJurusan($proka_id){

        $rombel = Jurusan::where('proka_id',$proka_id)->orderBy('nama_jurusan','ASC')->get();
        return json_encode($rombel);

    }// End Method

    public function GetRombel($jurusan_id){

        $jurusan = Rombel::where('jurusan_id',$jurusan_id)->orderBy('nama_rombel','ASC')->get();
        return json_encode($jurusan);

    }// End Method

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

    public function TambahAnggotaRombel(){
        $siswa = User::where('role', 'siswa')->get();
        $rombel = Rombel::latest()->get();
        $proka = Proka::latest()->get();
        return view('admin.backend.rombel.tambah_anggota_rombel', compact('siswa', 'rombel', 'proka'));
    }

    public function SimpanAnggotaRombel(Request $request){
        $siswa_id = $request->siswa_id;
        //dd($siswa_id);
        $request->validate([
            // 'name' => ['required','string','max:255'],
            // 'siswa_id' => ['required', 'unique:anggota_rombels'],
        ]);
            foreach($siswa_id as $item){
                AnggotaRombel::insert([
                    'id' => Str::uuid(),
                    'rombel_id' => $request->rombel_id,
                    'siswa_id' => $item,
                    'created_at' => Carbon::now(),
                ]);
            }

            

            $notification = array(
                'message' => 'Rombel Berhasil ditambahkan',
                'alert-type' => 'success',
            );

            return redirect()->route('semua.rombel')->with($notification);

    }

    public function getUserSiswa(Request $request){
        $siswa_id =[];
        // $user = DB::table('anggota_rombels')
        //     ->rightjoin('users', 'anggota_rombels.siswa_id', '=', 'users.id')
        //     ->where('jenis_user', 'siswa')
        //     ->whereNull('anggota_rombels.siswa_id')
        //     ->select("*")

        //     ->where('name','LIKE','%'.$search.'%')
        //     ->get();
        //dd( $siswa_id);
        if($search=$request->name){
            // // $tags=Usaaaaaaaer::where('username', 'LIKE', "%$search%")->get();
            // $siswa_id = User::where('jenis_user', 'siswa')->select("*")

            // ->where('name','LIKE','%'.$search.'%')

            // ->get();
            $siswa_id = DB::table('anggota_rombels')
            ->rightjoin('users', 'anggota_rombels.siswa_id', '=', 'users.id')
            ->where('jenis_user', 'siswa')
            ->whereNull('anggota_rombels.siswa_id')
            ->select("*")
            ->where('name','LIKE','%'.$search.'%')
            ->get();
        }
        return response()->json($siswa_id);
    }

    public function AllAnggotaRombel(){
        
        $anggota_rombel = AnggotaRombel::all();
        return view('admin.backend.rombel.all_anggota_rombel', compact('anggota_rombel'));
    }

    public function HapusAnggotaRombel($id){
        // $item = AnggotaRombel::find($id);
        AnggotaRombel::find($id)->delete();

        $notification = array(
            'message' => 'Anggota Rombel Berhasil dikeluarkan',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


}
