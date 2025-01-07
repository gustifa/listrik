<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\JadwalPelajaran;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Rombel;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Group;
use App\Models\Waktu;

class JadwalPelajaranController extends Controller
{
    public function SemuaJadwal(){
        $jadwal = JadwalPelajaran::latest()->get();
        return view('admin.backend.jadwal.lihat_jadwal', compact('jadwal'));
    }

    public function TambahJadwal(){
        $users = User::where('role', 'guru')->get();
        $mapel = Mapel::latest()->get();
        $rombel = Rombel::latest()->get();
        $jurusan = Jurusan::latest()->get();
        $tingkat = Kelas::latest()->get();
        $group = Group::latest()->get();
        $waktu = Waktu::latest()->get();
        return view('admin.backend.jadwal.tambah_jadwal', compact('users', 'mapel', 'rombel', 'jurusan', 'tingkat', 'group', 'waktu'));
    }

    public function SimpanJadwal(Request $request){

        JadwalPelajaran::insert([
            'user_id' => $request->user_id,
            'mapel_id' => $request->mapel_id,
            'rombel_id' => $request->rombel_id,
            'mulai_id' => $request->mulai_id,
            'selesai_id' => $request->selesai_id,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Jadwal Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.jadwal')->with($notification);

            

    }

    public function UpdateJadwalStatus(Request $request){
        $jadwalId = $request->input('jadwal');
        $isChecked = $request->input('is_checked', 0);
        $jadwal = Semester::find($jadwalId);
        if ($jadwal) {
            $jadwal->status =  $isChecked;
            $jadwal->save();
        }
        return response()->json(['message'=>'Jadwal Berhasil diganti']);

    }
}
