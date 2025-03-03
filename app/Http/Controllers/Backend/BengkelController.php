<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BengkelImport;
use Carbon\Carbon;
use App\Models\Bengkel;
use App\Models\Jurusan;
use App\Models\Proka;
use Barryvdh\DomPDF\Facade\Pdf;

class BengkelController extends Controller
{
    public function SemuaBengkel(){
        $bengkel = Bengkel::latest()->get();
        return view('admin.backend.bengkel.semua_bengkel', compact('bengkel'));
    }

    public function TambahBengkel(){
        $proka = Proka::latest()->get();
        return view('admin.backend.bengkel.tambah_bengkel', compact('proka'));
    }

    public function SimpanBengkel(Request $request){
        Bengkel::insert([
            'jurusan_id' => $request->jurusan_id,
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

    public function EditBengkel($id){
        $bengkel = Bengkel::find($id);
        $proka = Proka::latest()->get();
        $jurusan = Jurusan::all();
        return view('admin.backend.bengkel.edit_bengkel', compact('bengkel', 'proka', 'jurusan'));
    }

    public function UpdateBengkel(Request $request){
        $id = $request->id;
        //dd($id);
        Bengkel::find($id)->update([
            'jurusan_id' => $request->jurusan_id,
            'nama_bengkel' => $request->nama_bengkel,
            'kode_bengkel' => $request->kode_bengkel,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Bengkel Berhasil Diperbaharui',
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
        $bengkel = Bengkel::find($id);
        if($bengkel->status != '1'){
            Bengkel::find($id)->delete();

            $notification = array(
                'message' => 'Bengkel Berhasil dihapus',
                'alert-type' => 'success',
            );
    
            return redirect()->route('semua.bengkel')->with($notification); 
        }else{
            $notification = array(
                'message' => 'Bengkel Gagal Dihapus',
                'alert-type' => 'error',
            );
    
            return redirect()->route('semua.bengkel')->with($notification);
        }

        
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

    public function CetakPerBengkel($id){
        // $sekolah = Sekolah::find(1)->get();
        // $id = Auth::user()->id;
        // $user = User::where('id',$id )->get();
        // dd($sekolah);
        $bengkel = Bengkel::find($id);
        // dd($bengkel);
        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            // 'date' => date('m/d/Y'),
            'bengkel' => $bengkel
        ];
        $customPaper = [0, 0, 200, 100];

        $pdf = PDF::loadView('admin.backend.bengkel.cetak_per_bengkel', $data, compact('bengkel'))
                    ->setPaper($customPaper, 'landscape');

        return $pdf->stream('bengkel '.$bengkel->nama_bengkel.'.pdf');
    }

    public function UpdateBengkelStatus(Request $request){
        $bengkelId = $request->input('bengkel');
        $isChecked = $request->input('is_checked', 0);
        $bengkel = Bengkel::find($bengkelId);
        if($bengkel->status != '1'){
            if ($bengkel) {
                $bengkel->status =  $isChecked;
                $bengkel->save();
            }
            return response()->json(['message'=>'Status Bengkel '.$bengkel->nama_bengkel. ' Berhasil diaktifkan']);
        }else{
            if ($bengkel) {
                $bengkel->status =  $isChecked;
                $bengkel->save();
            }
            return response()->json(['message'=>'Status Bengkel '.$bengkel->nama_bengkel. ' Berhasil dinonaktifkan']);
        }
        

    }

    
}
