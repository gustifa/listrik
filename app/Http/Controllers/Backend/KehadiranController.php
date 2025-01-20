<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kehadiran;
use Carbon\Carbon;

class KehadiranController extends Controller
{
    public function LihatKehadiran(){
        $kehadiran = Kehadiran::all();
        return view('admin.backend.kehadiran.lihat_kehadiran', compact('kehadiran'));
    }

    public function TambahKehadiran(){
        return view('admin.backend.kehadiran.tambah_kehadiran');
    }

    public function SimpanKehadiran(Request $request){
        Kehadiran::insert([
            'nama_kehadiran' => strtoupper($request->nama_kehadiran),
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Kehadiran Berhasil disimpan',
            'alert-type' => 'success',
        );
        return redirect()->route('lihat.kehadiran')->with($notification);
    }

    public function editKehadiran($id){
        $kehadiran = Kehadiran::find($id);
        return view('admin.backend.kehadiran.edit_kehadiran', compact('kehadiran'));
    }

    public function updateKehadiran(Request $request){
        $kehadiran_id = $request->id;
        Kehadiran::find($kehadiran_id)->update([
            'nama_kehadiran' => $request->nama_kehadiran,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Data Kehadiran Berhasil diperbaharui',
            'alert-type' => 'success',
        );

        return redirect()->route('lihat.kehadiran')->with($notification);
    }

    public function hapusKehadiran($id){
        Kehadiran::find($id)->delete();
        $notification = array(
            'message' => 'Kehadiran Berhasil dihapus',
            'alert-type' => 'success',
        );

        return redirect()->route('lihat.kehadiran')->with($notification);
    }

    public function UpdateKehadiranStatus(Request $request){
        $kehadiranId = $request->input('kehadiran');
        $isChecked = $request->input('is_checked', 0);
        if($isChecked){
            $kehadiran = Kehadiran::find($kehadiranId);
            if ($kehadiran) {
                $kehadiran->status =  $isChecked;
                $kehadiran->save();
            }
            return response()->json(['message'=>'Kehadiran Berhasil diaktifkan']); 
        }else{
            $kehadiran = Kehadiran::find($kehadiranId);
            if ($kehadiran) {
                $kehadiran->status =  $isChecked;
                $kehadiran->save();
            }
            return response()->json(['message'=>'Kehadiran Berhasil dinonaktifkan']); 
        }

    }
}
