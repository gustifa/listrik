<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use Carbon\Carbon;

class SemesterController extends Controller
{
    public function SemuaSemester(){
        $semester = Semester::latest()->get();
        return view('admin.backend.semester.lihat_semester', compact('semester'));
    }

    public function TambahSemester(){
        return view('admin.backend.semester.tambah_semester');
    }

    public function SimpanSemester(Request $request){

        Semester::insert([
            'nama' => strtoupper($request->nama),
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Semester Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.semester')->with($notification);



    }

    public function UpdateSemesterStatus(Request $request){
        $semesterId = $request->input('semester');
        $isChecked = $request->input('is_checked', 0);
        $semester = Semester::find($semesterId);
        if ($semester) {
            $semester->status =  $isChecked;
            $semester->save();
        }
        return response()->json(['message'=>'Semester Berhasil diganti']);

    }

    public function EditSemester($id){
        $semester = Semester::find($id);
        return view('admin.backend.semester.edit_semester', compact('semester'));
    }


    public function UpdateSemester(Request $request){
        $semester_id = $request->id;
        Semester::find($semester_id)->update([
            'nama' => $request->nama,
        ]);

        $notification = array(
            'message' => 'Semester Berhasil Diganti',
            'alert-type' => 'success',
        );

        return redirect()->route('semua.semester')->with($notification);
    }

    public function DeleteSemester($id){

    if(Semester::find($id)->where('status', '0')->delete()){
        $notification = array(
            'message' => 'Semester Berhasil dihapus',
            'alert-type' => 'success',
        );

        return redirect()->route('semua.semester')->with($notification);
    }else{
        $notification = array(
            'message' => 'Semester Aktif, Gagal dihapus',
            'alert-type' => 'error',
        );

        return redirect()->route('semua.semester')->with($notification);
    }

    }

}
