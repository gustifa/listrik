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
use App\Models\Kehadiran;
use App\Models\TujuanPembelajaran;
use Illuminate\Support\Facades\DB;
use App\DataTables\JurnalDataTable;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class JurnalController extends Controller
{
    public function SemuaJurnalGuru(JurnalDataTable $dataTable){
        return $dataTable->render('guru.jurnal.lihat_jurnal');

    }

    //public function SemuaJurnalGuru(){
        // $tes = Jurnal::select('kehadiran', 'siswa_id')->get()->toArray();
        //$tes = Jurnal::select('kehadiran', 'siswa_id')->get()->toArray();
       
        // foreach ($tes as $key => $item) {
        // $kehadiran = $item->kehadiran;
        // $siswa = $item->siswa_id;
        // }
        // dd($kehadiran);

        // $result = DB::select($sql);
        // $result = Jurnal::select('kehadiran', 'siswa_id')->get();
        // $arr = [];
        // foreach($result as $row)
        // {
        //     $arr[] = (array) $row;
        // }

        // dd($arr);
       // return view('guru.jurnal.lihat_jurnal', compact('tes'));
    //}
    public function TambahJurnalGuru(){
        $id = Auth::user()->id;
        $jadwal = JadwalPelajaran::latest()->Where('user_id',$id)->where('status', '1')->get();
        $rombel = $jadwal->implode('rombel_id');
        $hari = Hari::latest()->get();
        $rombel_id = Rombel::all();
        $anggota_rombel = AnggotaRombel::all();
        $tp = TujuanPembelajaran::all();
        $kehadiran = Kehadiran::where('status', '1')->get();
        // dd($anggota_rombel);
        return view('guru.jurnal.tambah_jurnal', compact('jadwal', 'rombel_id', 'anggota_rombel', 'kehadiran', 'tp'));
    }

    public function SimpaJurnalGuru(Request $request){
        
    }

    public function GetAnggotaRombel(Request $request){
    	//dd('ok done');
    	$allData = AnggotaRombel::with(['peserta_didik'])->where('rombel_id',$request->rombel_id)->get();
    	// $allData = AnggotaRombel::where('rombel_id',$request->rombel_id)->get();
    	// dd($allData->toArray());
    	return response()->json($allData);

    }

    public function SimpanJurnalGuru(Request $request){
        $siswa_id = $request->siswa_id;
        $kehadiran = $request->kehadiran;
        $jadwal = $request->jadwal_id;
        $tp_id = $request->tp_id;
        //dd($id);
        $guru_id = Auth::user()->id;
        if($siswa_id == !NULL){
            $countsiswa_id = count($siswa_id);
            for ($i=0; $i < $countsiswa_id; $i++) { 
                $jurnal = new Jurnal();
                $jurnal->siswa_id = $request->siswa_id[$i];
                $jurnal->kehadiran = $request->kehadiran[$i];
                $jurnal->tp_id = $tp_id;
                $jurnal->guru_id = $guru_id;
                $jurnal->jadwal_id = $jadwal;
                $jurnal->created_at = Carbon::now();
                $jurnal->save();
            }
            $notification = array(
            'message' => 'Berhasil Menyimpan Jurnal',
            'alert-type' => 'success'
            );

            return redirect()->route('lihat.jurnal.guru')->with($notification);
        }else{
            $notification = array(
                'message' => 'Gagal Menyimpan Jurnal',
                'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }

                // $jurnal = new Jurnal();
                // $jurnal->siswa_id = $request['siswa_id'];
                // $jurnal->kehadiran = $request['kehadiran'];
                // $jurnal->guru_id = Auth::user()->id;
                // $jurnal->jadwal_id = $request->jadwal_id;
                // $jurnal->tp_id = $request->tp_id;
                // $jurnal->created_at = Carbon::now();
                // $jurnal->save();

                // $notification = array(
                //         'message' => 'Berhasil Menyimpan Jurnal',
                //         'alert-type' => 'success'
                //         );
            
                       // return redirect()->route('lihat.jurnal.guru')->with($notification);


    }

    public function EditJurnalGuru($id){
        $id = Auth::user()->id;
        $jadwal = JadwalPelajaran::latest()->Where('user_id',$id)->where('status', '1')->get();
        $rombel = $jadwal->implode('rombel_id');
        $hari = Hari::latest()->get();
        $rombel_id = Rombel::all();
        $anggota_rombel = AnggotaRombel::all();
        $tp = TujuanPembelajaran::all();
        $kehadiran = Kehadiran::where('status', '1')->get();
        return view('guru.jurnal.edit_jurnal', compact('jadwal', 'rombel_id', 'anggota_rombel', 'kehadiran', 'tp'));
    }

    public function ViewJurnal($id){
        $jurnal = Jurnal::where('tp_id', $id)->get();
        return view('guru.jurnal.view_jurnal', compact('jurnal'));
    }
}
