<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Jurnal;
use App\Models\JadwalPelajaran;
use App\Models\Hari;
use App\Models\AnggotaRombel;
use App\Models\Rombel;

class JurnalController extends Controller
{
    public function SemuaJurnalGuru(){
        $jurnal = Jurnal::latest()->get();
        return view('guru.jurnal.lihat_jurnal', compact('jurnal'));
    }

    public function TambahJurnalGuru(){
        $id = Auth::user()->id;
        $jadwal = JadwalPelajaran::latest()->Where('user_id',$id)->where('status', '1')->get();
        $rombel = $jadwal->implode('rombel_id');
        $hari = Hari::latest()->get();
        $rombel_id = Rombel::where('id',$rombel)->get();
        $anggota_rombel = AnggotaRombel::all();
        // dd($rombel);
        return view('guru.jurnal.tambah_jurnal', compact('jadwal', 'rombel_id'));
    }

    public function SimpaJurnalGuru(Request $request){
        
    }
}
