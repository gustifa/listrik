<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Waktu;

class WaktuController extends Controller
{
    public function SemuaWaktu(){
        $waktu = Waktu::all();
        return view('admin.backend.waktu.semua_waktu', compact('waktu'));
    }

    public function TambahWaktu(){
        return view('admin.backend.waktu.tambah_waktu');
    }

    public function SimpanWaktu(Request $request){

        Waktu::insert([
            'nama' => strtoupper($request->nama),
            'waktu_mulai' => strtoupper($request->waktu_mulai),
            'waktu_selesai' => strtoupper($request->waktu_selesai),
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Waktu Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.waktu')->with($notification);



    }


}
