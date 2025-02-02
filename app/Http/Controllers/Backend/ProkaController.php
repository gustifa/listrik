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
}
