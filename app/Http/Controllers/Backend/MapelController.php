<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MapelImport;
use App\Models\Mapel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Sekolah;
use App\Models\Proka;
use App\Models\TujuanPembelajaran;
use App\Models\JadwalPelajaran;
use App\Models\Hari;
use App\Models\Rombel;
use App\Models\AnggotaRombel;
use App\Models\Kehadiran;
use App\DataTables\TujuanPembelajaranDataTable;

class MapelController extends Controller
{
    public function SemuaMapel(){
        $mapel = Mapel::latest()->get();
        return view('admin.backend.mapel.semua_mapel', compact('mapel'));
    }

    public function TambahMapel(){
        $proka = Proka::latest()->get();
        return view('admin.backend.mapel.tambah_mapel', compact('proka'));
    }

    public function EditMapel($id){
        $proka = Proka::latest()->get();
        $mapel = Mapel::find($id);
        return view('admin.backend.mapel.edit_mapel', compact('proka', 'mapel'));
    }

    public function SimpanMapel(Request $request){
        Mapel::insert([
            'jurusan_id' => $request->jurusan_id,
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

    public function DownloadTemplateMapel(){
        $path = public_path('template/mata_pelajaran.xlsx');
        $name = basename($path);
        $headers = ["Content-Type:   application/vnd.ms-excel; charset=utf-8"];
        return response()->download($path, $name, $headers);
    }

    public function ImportMapel(Request $request)
    {
        // Validate incoming request data
        // $request->validate([
        //     'file' => 'required|max:2048',
        // ]);

        Excel::import(new MapelImport, $request->file('file'));

        // return back()->with('success', 'Users imported successfully.');
        $notification = array(
            'message' => 'Import Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.mapel')->with($notification);
    }

    public function HapusMapel($id){

        Mapel::find($id)->delete();

        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('semua.mapel')->with($notification);
    }

    public function CetakMapel(){
        $sekolah = Sekolah::find(1)->get();
        $id = Auth::user()->id;
        $user = User::where('id',$id )->get();
        // dd($sekolah);
        $mapel = Mapel::get();

        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            // 'date' => date('m/d/Y'),
            'mapel' => $mapel
        ];

        $pdf = PDF::loadView('admin.backend.mapel.cetak_mapel', $data);

        return $pdf->stream('mapel.pdf');
    }
    public function UpdateMapelStatus(Request $request){
        $mapelId = $request->input('mapel');
        $isChecked = $request->input('is_checked', 0);
        $mapel = Mapel::find($mapelId);
        if ($mapel) {
            $mapel->status =  $isChecked;
            $mapel->save();
        }
        return response()->json(['message'=>'Mapel Berhasil diganti']);

    }



    public function SemuaTp(TujuanPembelajaranDataTable $dataTable){
        return $dataTable->render('guru.tp.lihat_tp');
    }

    public function tambahTpGuru(){
        $mapel = Mapel::where('status', '1')->get();
        return view('guru.tp.tambah_tp', compact('mapel'));
    }
    public function simpanTpGuru(Request $request){
        $guru_id = Auth::user()->id;
        TujuanPembelajaran::insert([
            'mapel_id' => $request->mapel_id,
            'nama' => $request->nama,
            'guru_id' => $guru_id,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'TP Berhasil ditambahkan',
            'alert-type' => 'success',
        );

        return redirect()->route('semua.tp.guru')->with($notification);
    }

    public function editTpGuru($id){
        $tp = TujuanPembelajaran::find($id);
        $mapel = Mapel::all();
        return view('guru.tp.edit_tp', compact('tp', 'mapel'));
    }

    public function updateTpGuru(Request $request){
        $tp_id = $request->id;
        $guru_id = Auth::user()->id;
        // dd($tp_id);

        TujuanPembelajaran::find($tp_id)->update([
            'mapel_id' => $request->mapel_id,
            'nama' => $request->nama,
            'guru_id' => $guru_id,
            'keterangan' => $request->keterangan,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'TP Berhasil diperbaharui',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.tp.guru')->with($notification);

    }

    public function TpTambahJurnal($tp){
        $id = Auth::user()->id;
        $jadwal = JadwalPelajaran::latest()->Where('user_id',$id)->where('status', '1')->get();
        $rombel = $jadwal->implode('rombel_id');
        $hari = Hari::latest()->get();
        $rombel_id = Rombel::all();
        $anggota_rombel = AnggotaRombel::all();
        $tp = TujuanPembelajaran::find($tp);
        // $tp = $implode_tp->implode('nama');
        // dd($tp);
        $kehadiran = Kehadiran::where('status', '1')->get();
        // dd($anggota_rombel);
        // echo "tes";
        return view('guru.tp.tambah_jurnal', compact('jadwal', 'rombel_id', 'anggota_rombel', 'kehadiran', 'tp'));
    }

    
}
