<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ImportUserController extends Controller
{

    public function index()
    {
        $users = User::latest()->get();

        return view('admin.backend.user.lihat_user', compact('users'));
    }
    // Test
    public function userMultiSelectSelect()
    {
        $users = User::get('name', 'id');

        return view('admin.backend.user.lihat_user_multi_select', compact('users'));
    }

    public function getUser(Request $request){
        $tags =[];
        if($search=$request->name){
            $tags=User::where('username', 'LIKE', "%$search%")->get();
        }
        return response()->json($tags);
    }

    public function ImportUser()
    {
        return view('admin.backend.user.import_user');
    }


    public function import(Request $request)
    {
        // Validate incoming request data
        // $request->validate([
        //     'file' => 'required|max:2048',
        // ]);

        Excel::import(new UsersImport, $request->file('file'));

        // return back()->with('success', 'Users imported successfully.');
        $notification = array(
            'message' => 'Import Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('lihat.user')->with($notification);
    }

    public function DownloadTemplateUser()
    {
        $path = public_path('template/users.xlsx');
        $name = basename($path);
        $headers = ["Content-Type:   application/vnd.ms-excel; charset=utf-8"];
        return response()->download($path, $name, $headers);
    }

    public function CetakPerUser($id){
        // $sekolah = Sekolah::find(1)->get();
        // $id = Auth::user()->id;
        // $user = User::where('id',$id )->get();
        // dd($sekolah);
        $user = User::find($id);
        // dd($bengkel);
        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            // 'date' => date('m/d/Y'),
            'user' => $user
        ];
        $customPaper = [0, 0, 320, 570];

        $pdf = PDF::loadView('admin.backend.user.cetak_per_user', $data, compact('user'))
                    ->setPaper($customPaper, 'landscape');

        return $pdf->stream('Cetak User '.$user->name.'.pdf');
    }

    public function CetakSemuaUser(){
        // $sekolah = Sekolah::find(1)->get();
        // $id = Auth::user()->id;
        // $user = User::where('id',$id )->get();
        // dd($sekolah);
        $users = User::all();
        // dd($bengkel);
        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            // 'date' => date('m/d/Y'),
            'users' => $users
        ];
        // $customPaper = [0, 0, 210, 570];

        $pdf = PDF::loadView('admin.backend.user.cetak_semua_user', $data, compact('users'));
                    // ->setPaper($customPaper, 'landscape');

        return $pdf->stream('Cetak User.pdf');
    }

    public function CetakGuruUser(){
        // $sekolah = Sekolah::find(1)->get();
        // $id = Auth::user()->id;
        // $user = User::where('id',$id )->get();
        // dd($sekolah);
        $users = User::all()->where('role', 'guru');
        // dd($bengkel);
        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            // 'date' => date('m/d/Y'),
            'users' => $users
        ];
        // $customPaper = [0, 0, 210, 570];

        $pdf = PDF::loadView('admin.backend.user.cetak_guru_user', $data, compact('users'));
                    // ->setPaper($customPaper, 'landscape');

        return $pdf->stream('Cetak User.pdf');
    }

    public function CetakWakilUser(){
        // $sekolah = Sekolah::find(1)->get();
        // $id = Auth::user()->id;
        // $user = User::where('id',$id )->get();
        // dd($sekolah);
        $users = User::all()->where('role', 'wakil');
        // dd($bengkel);
        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            // 'date' => date('m/d/Y'),
            'users' => $users
        ];
        // $customPaper = [0, 0, 210, 570];

        $pdf = PDF::loadView('admin.backend.user.cetak_wakil_user', $data, compact('users'));
                    // ->setPaper($customPaper, 'landscape');

        return $pdf->stream('Cetak User.pdf');
    }
}
