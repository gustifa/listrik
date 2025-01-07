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
            'nama' => $request->nama,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Semester Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.semester')->with($notification);

            

    }

    public function UpdateSemesterStatus(Request $request){
        $userId = $request->input('semester');
        $isChecked = $request->input('is_checked', 0);
        $semester = Semester::find($userId);
        if ($semester) {
            $semester->status =  $isChecked;
            $semester->save();
        }
        return response()->json(['message'=>'Semester Berhasil diganti']);

    }
}
