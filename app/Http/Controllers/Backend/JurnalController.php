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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $rombel_id = Rombel::all();
        $anggota_rombel = AnggotaRombel::all();
        $kehadiran = Kehadiran::where('status', '1')->get();
        // dd($anggota_rombel);
        return view('guru.jurnal.tambah_jurnal', compact('jadwal', 'rombel_id', 'anggota_rombel', 'kehadiran'));
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
        $guru_id = Auth::user()->id;
        // dd($kehadiran);

        
        // $jurnal = $request->permission;
        //         foreach($permissions as $key => $item){
        //             $data['role_id'] = $request->role_id;
        //             $data['permission_id'] = $item;
        
        //             DB::table('role_has_permissions')->insert($data);
                
        //         }  // End Foreach

        //         $notification = array(
        //             'message' => 'Roles Permission Berhasil ditambahkan',
        //             'alert-type' => 'success',
        //         );
        //         return redirect()->route('all.role.permissions')->with($notification);

        if($siswa_id == !NULL){
            for ($i=0; $i < $siswa_id; $i++) { 
                $jurnal = new Jurnal();
                $jurnal->siswa_id = $request->siswa_id[$i];
                $jurnal->kehadiran = $request->kehadiran[$i];
                $jurnal->guru_id = $guru_id;
                $jurnal->jadwal_id = $jadwal;
                $jurnal->created_at = Carbon::now();
                $jurnal->save();
            }
            // $data = array();
            // foreach($kehadiran as $key => $item){
            //                 $data['siswa_id'] = $siswa_id;
            //                 $data['kehadiran'] = $item;
                
            //                 DB::table('jurnals')->insert($data);
                        
                        // }  // End Foreach
            $notification = array(
            'message' => 'Berhasil Menyimpan Jurnal',
            'alert-type' => 'error'
            );

            return redirect()->route('SemuaJurnalGuru')->with($notification);
        }else{
            $notification = array(
                'message' => 'Gagal Menyimpan Jurnal',
                'alert-type' => 'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
