<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MapelImport;
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
}
