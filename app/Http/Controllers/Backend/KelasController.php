<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function SemuaKelas(){
        $kelas = Kelas::latest()->get();
        return view('admin.backend.kelas.semua_kelas', compact('kelas'));
    }

    public function TambahKelas(){
        $kelas = Kelas::latest()->get();
        return view('admin.backend.kelas.tambah_kelas', compact('kelas'));
    }

    public function SimpanKelas(Request $request){

        Kelas::insert([
            'nama_kelas' => strtoupper($request->nama_kelas),
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Kelas Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.kelas')->with($notification);

            

    }
}
