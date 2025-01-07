<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Hari;

class HariController extends Controller
{
    public function SemuaHari(){
        $hari = Hari::latest()->get();
        return view('admin.backend.hari.lihat_hari', compact('hari'));
    }

    public function TambahHari(){
        return view('admin.backend.hari.tambah_hari');
    }

    
    public function SimpanHari(Request $request){

        Hari::insert([
            'nama_hari' => strtoupper($request->nama_hari),
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Nama Hari Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.hari')->with($notification);



    }
}
