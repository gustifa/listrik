<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Bengkel;

class BengkelController extends Controller
{
    public function SemuaBengkel(){
        $bengkel = Bengkel::latest()->get();
        return view('admin.backend.bengkel.semua_bengkel', compact('bengkel'));
    }

    public function TambahBengkel(){
        return view('admin.backend.bengkel.tambah_bengkel');
    }

    public function SimpanBengkel(Request $request){
        Bengkel::insert([
            'nama_bengkel' => $request->nama_bengkel,
            'kode_bengkel' => $request->kode_bengkel,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'RMapel Berhasil ditambahkan',
            'alert-type' => 'success',
        );

        return redirect()->route('semua.bengkel')->with($notification);
    }

}
