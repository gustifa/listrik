<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BengkelImport;
use Carbon\Carbon;
use App\Models\Bengkel;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function DownloadTemplateBengkel(){
        $path = public_path('template/bengkel.xlsx');
        $name = basename($path);
        $headers = ["Content-Type:   application/vnd.ms-excel; charset=utf-8"];
        return response()->download($path, $name, $headers);
    }

    public function ImportBengkel(Request $request)
    {
        // Validate incoming request data
        // $request->validate([
        //     'file' => 'required|max:2048',
        // ]);

        Excel::import(new BengkelImport, $request->file('file'));

        // return back()->with('success', 'Users imported successfully.');
        $notification = array(
            'message' => 'Import Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.bengkel')->with($notification);
    }

    public function HapusBengkel($id){

        Bengkel::find($id)->delete();

        $notification = array(
            'message' => 'Bengkel Berhasil dihapus',
            'alert-type' => 'success',
        );

        return redirect()->route('semua.bengkel')->with($notification);
    }

    public function CetakBengkel(){
        // $sekolah = Sekolah::find(1)->get();
        // $id = Auth::user()->id;
        // $user = User::where('id',$id )->get();
        // dd($sekolah);
        $bengkel = Bengkel::get();

        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            // 'date' => date('m/d/Y'),
            'bengkel' => $bengkel
        ];

        $pdf = PDF::loadView('admin.backend.bengkel.cetak_bengkel', $data);

        return $pdf->stream('bengkel.pdf');
    }

}
