<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalPelajaran;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Rombel;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Group;
use App\Models\Waktu;
use App\Models\Hari;
use App\Models\Bengkel;

class JadwalPelajaranController extends Controller
{
    public function SemuaJadwal(){
        $jadwal = JadwalPelajaran::latest()->get();
        $users = User::where('jenis_user', 'guru')->get();
        $mapel = Mapel::latest()->get();
        $rombel = Rombel::latest()->get();
        $jurusan = Jurusan::latest()->get();
        $tingkat = Kelas::latest()->get();
        $group = Group::latest()->get();
        $waktu = Waktu::latest()->get();
        $hari = Hari::latest()->get();
        $bengkel = Bengkel::latest()->get();
        return view('admin.backend.jadwal.lihat_jadwal', compact('jadwal', 'users', 'mapel', 'rombel', 'jurusan', 'tingkat', 'group', 'waktu', 'hari', 'bengkel'));
    }

    public function TambahJadwal(){
        $users = User::where('jenis_user', 'guru')->get();
        $mapel = Mapel::latest()->get();
        $rombel = Rombel::latest()->get();
        $jurusan = Jurusan::latest()->get();
        $tingkat = Kelas::latest()->get();
        $group = Group::latest()->get();
        $waktu = Waktu::latest()->get();
        $hari = Hari::latest()->get();
        $bengkel = Bengkel::latest()->get();
        return view('admin.backend.jadwal.tambah_jadwal', compact('users', 'mapel', 'rombel', 'jurusan', 'tingkat', 'group', 'waktu', 'hari', 'bengkel'));
    }

    public function SimpanJadwal(Request $request){
        $request->validate([
            // 'name' => ['required','string','max:255'],
            // 'mapel_id' => ['required','unique:jadwal_pelajarans'],
        ]);
        JadwalPelajaran::insert([
            'user_id' => $request->user_id,
            'mapel_id' => $request->mapel_id,
            'rombel_id' => $request->rombel_id,
            'bengkel_id' => $request->bengkel_id,
            'hari_id' => $request->hari_id,
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
        $jadwal = JadwalPelajaran::find($jadwalId);
        if ($jadwal) {
            $jadwal->status =  $isChecked;
            $jadwal->save();
        }
        return response()->json(['message'=>'Jadwal Berhasil diganti']);

    }


    // Guru
    public function SemuaJadwalGuru(){
        $id = Auth::user()->id;
        $jadwal = JadwalPelajaran::where('user_id', $id)->get();
        return view('guru.jadwal.lihat_jadwal_guru', compact('jadwal'));
    }

    public function TambahJadwalGuru(){
        $users = User::where('jenis_user', 'guru')->get();
        $mapel = Mapel::latest()->get();
        $rombel = Rombel::latest()->get();
        $jurusan = Jurusan::latest()->get();
        $tingkat = Kelas::latest()->get();
        $group = Group::latest()->get();
        $waktu = Waktu::latest()->get();
        $hari = Hari::latest()->get();
        $bengkel = Bengkel::latest()->get();
        return view('guru.jadwal.tambah_jadwal_guru', compact('users', 'mapel', 'rombel', 'jurusan', 'tingkat', 'group', 'waktu', 'hari', 'bengkel'));
    }

    public function SimpanJadwalGuru(Request $request){
        $id = Auth::user()->id;
        //dd($id);
        // $request->validate([
        //     'name' => ['required','string','max:255'],
        //     'mapel_id' => ['required','unique:jadwal_pelajarans'],
        // ]);
        JadwalPelajaran::insert([
            'user_id' => $id,
            'mapel_id' => $request->mapel_id,
            'rombel_id' => $request->rombel_id,
            'bengkel_id' => $request->bengkel_id,
            'hari_id' => $request->hari_id,
            'mulai_id' => $request->mulai_id,
            'selesai_id' => $request->selesai_id,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Jadwal Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('lihat.jadwal.guru')->with($notification);

    }

    public function DeleteJadwal($id){

        $jadwal = JadwalPelajaran::find($id);

        if($jadwal->status != '1'){
            $jadwal_pelajaran = JadwalPelajaran::find($id)->delete();
            $notification = array(
                'message' => 'Jadwal Berhasil dihapus',
                'alert-type' => 'success',
            );
            return redirect()->route('semua.jadwal')->with($notification);
        }else{
            $notification = array(
                'message' => 'Jadwal Aktif, tidak bisa dihapus',
                'alert-type' => 'error',
            );
            return redirect()->route('semua.jadwal')->with($notification);
        }

        
    }
}
