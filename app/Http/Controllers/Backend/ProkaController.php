<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Models\Proka;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class ProkaController extends Controller

{
    public function SemuaProka(){
        $proka = Proka::latest()->get();    
        $user = User::where('jenis_user', 'guru')->get();
        return view('admin.backend.proka.semua_proka', compact('proka', 'user'));
    }

    public function TambahProka(){
        $proka = Proka::latest()->get();
        // $user = User::where('jenis_user', 'guru')->get();
        // $user = User::where('jenis_user', 'guru')->leftJoin('prokas', function($join) {
        //     $join->on('users.id', '=', 'prokas.ka_proka_id');
        //   })
        //   ->whereNull('prokas.ka_proka_id')
        //   ->select('users.*', 'prokas.*')
        //   ->select('users.*', 'prokas.*')
        //   ->get();
        // $user = DB::table('users')
        //     ->where('jenis_user', 'guru')
        //     ->join('prokas', 'users.id', '=', 'prokas.ka_proka_id')
        //     ->get();

        $user = DB::table('prokas')
            ->rightjoin('users', 'prokas.ka_proka_id', '=', 'users.id')
            ->where('jenis_user', 'guru')
            ->whereNull('prokas.ka_proka_id')
            ->get();

        // $user = DB::table('users')
        // ->join('prokas', function (JoinClause $join) {
        //     $join->on('users.id', '=', 'prokas.ka_proka_id')
        //          ->where('users.id', '!=', 'prokas.ka_proka_id');
        // })
        // ->get();
        
        //   dd($user);
        return view('admin.backend.proka.tambah_proka', compact('user', 'proka'));
    }

    public function SimpanProka(Request $request){
        $kode = $request->nama_proka;
        $arr = explode(' ', $kode);
        $singkatan = '';
        foreach($arr as $kata)
        {
        $singkatan .= substr($kata, 0, 1);
        }
        // $arr = substr($kode, 0, 1);
        // foreach($arr as $kata)
        //     {
        //     $singkatan = substr($kata, 0, 1);
        //     }
        // dd(strtoupper($singkatan));
        $request->validate([
            // 'name' => ['required','string','max:255'],
            // 'ka_proka_id' => ['required', 'string','unique:prokas'],
            'nama_proka' => ['required', 'string','unique:prokas'],
            // 'kode_proka' => ['required', 'string','unique:prokas'],
        ]);
        if($request->file('logo_proka')){
            $manager = new ImageManager(new Driver());
            $image_gen = hexdec(uniqid()).'.'.$request->file('logo_proka')->getClientOriginalExtension();
            $img = $manager->read($request->file('logo_proka'));
            $img = $img->resize(370,246);
            $img->toPng()->save(base_path('public/upload/logo_proka/'.$image_gen));
            $save_url = 'upload/logo_proka/'.$image_gen;


            Proka::insert([
                'nama_proka' => $request->nama_proka,
                'ka_proka_id' => $request->ka_proka_id,
                'kode_proka' => strtoupper($request->kode_proka),
                'slug_proka' => strtolower(str_replace(' ', '-',$request->slug_proka)),
                'logo_proka' => $save_url,
                'created_at' => Carbon::now(),
            ]);


            $notification = array(
                'message' => 'Proka Berhasil ditambahkan',
                'alert-type' => 'success',
            );
            return redirect()->route('semua.proka')->with($notification);
         }else{
            Jurusan::insert([
                'nama_proka' => $request->nama_proka,
                'ka_proka_id' => $request->ka_proka_id,
                'kode_proka' => strtoupper($request->kode_proka),
                'slug_proka' => strtolower(str_replace(' ', '-',$request->slug_proka)),
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Proka Berhasil ditambahkan',
                'alert-type' => 'success',
            );

            return redirect()->route('semua.proka')->with($notification);
         }

    }

    public function EditProka($id){
        $proka = Proka::find($id);
        // $user = DB::table('prokas')
        //     ->rightjoin('users', 'prokas.ka_proka_id', '=', 'users.id')
        //     ->where('jenis_user', 'guru')
        //     ->whereNull('prokas.ka_proka_id')
        //     ->get();

        $user = User::where('jenis_user', 'guru')->get();

        return view('admin.backend.proka.edit_proka', compact('user', 'proka'));   
    }

    public function UpdateProka(Request $request){
        $id = $request->id;
        //dd($id);
        $data = Proka::find($id);
        $logo_proka = $request->file('logo_proka');
        if($logo_proka){
            @unlink(public_path($data->logo_proka));
            $manager = new ImageManager(new Driver());
            $image_gen_logo_proka = hexdec(uniqid()).'.'.$request->file('logo_proka')->getClientOriginalExtension();
            $img = $manager->read($request->file('logo_proka'));
            $img = $img->resize(370,370);
            $img->toPng()->save(base_path('public/upload/logo_proka/'.$image_gen_logo_proka));
            $save_url_logo_proka = 'upload/logo_proka/'.$image_gen_logo_proka;
            Proka::find($id)->update([
                'nama_proka' => strtoupper($request->nama_proka),
                'ka_proka_id' => $request->ka_proka_id,
                'kode_proka' => strtoupper($request->kode_proka),
                'slug_proka' => strtolower(str_replace(' ', '-',$request->slug_proka)),
                'logo_proka' => $save_url_logo_proka,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Logo dan Data Proka Berhasil diganti',
                'alert-type' => 'success',
            );
            return redirect()->route('semua.proka')->with($notification);
         }else{
            Proka::find($id)->update([
                'nama_proka' => strtoupper($request->nama_proka),
                'ka_proka_id' => $request->ka_proka_id,
                'kode_proka' => strtoupper($request->kode_proka),
                'slug_proka' => strtolower(str_replace(' ', '-',$request->slug_proka)),
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Data Proka Berhasil diganti',
                'alert-type' => 'success',
            );

            return redirect()->route('semua.proka')->with($notification);
         }

    }

    public function UpdateProkaStatus(Request $request){
        $prokaId = $request->input('proka');
        $isChecked = $request->input('is_checked', 0);
        $proka = Proka::find($prokaId);
        if ($proka) {
            $proka->status =  $isChecked;
            $proka->save();
        }
        return response()->json(['message'=>'Proka Berhasil diganti']);

    }

    public function DeleteProka($id){

        $proka = Proka::find($id);
        if($proka->status != '1'){
            $proka->delete();
            @unlink(public_path($proka->logo_proka));

            $notification = array(
                'message' => 'Proka '.$proka->nama_proka. 'Berhasil dihapus',
                'alert-type' => 'success',
            );
            return redirect()->route('semua.proka')->with($notification);
        }else{
            
        $notification = array(
            'message' => 'Proka '.$proka->nama_proka. 'Aktif, Gagal dihapus',
            'alert-type' => 'error',
        );
        return redirect()->route('semua.proka')->with($notification);
        }
       

    }

}
