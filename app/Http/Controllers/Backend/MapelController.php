<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function SemuaMapel(){
        $mapel = Mapel::latest()->get();
        return view('admin.backend.mapel.semua_mapel', compact('mapel'));
    }

    public function TambahMapel(){
        return view('admin.backend.mapel.tambah_mapel');
    }

    public function SimpanMapel(Request $request){
        Mapel::insert([
            'nama_mapel' => $request->nama_mapel,
            'kode_mapel' => $request->kode_mapel,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'RMapel Berhasil ditambahkan',
            'alert-type' => 'success',
        );

        return redirect()->route('semua.mapel')->with($notification);

}

    
}
