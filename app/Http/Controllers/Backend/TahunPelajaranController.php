<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunPelajaran;

class TahunPelajaranController extends Controller
{
    public function SemuaTahunPelajaran(){
        $tahunPelajaran = TahunPelajaran::latest()->get();
        return view('admin.backend.tahun_pelajaran.lihat_tahun_pelajaran', compact('tahunPelajaran'));
    }

    public function TambahTahunPelajaran(){
        return view('admin.backend.tahun_pelajaran.tambah_tahun_pelajaran');
    }

    public function SimpanTahunPelajaran(Request $request){

        TahunPelajaran::insert([
            'nama' => $request->nama,
        ]);

        $notification = array(
            'message' => 'Tahun Pelajaran Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.tahun.pelajaran')->with($notification);

            

    }
}
