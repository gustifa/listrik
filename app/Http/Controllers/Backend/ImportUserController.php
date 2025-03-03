<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use DataTables;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\Auth;

class ImportUserController extends Controller
{

    public function index()
    {
        $users = User::latest()->get();

        return view('admin.backend.user.lihat_user', compact('users'));
        // return $dataTable->render('admin.backend.user.lihat_user');

    }

    public function userAll(UserDataTable $dataTable){
        return $dataTable->render('admin.backend.user.all_user');
    }
    // Test
    public function userMultiSelectSelect()
    {
        $users = User::get('name', 'id');

        return view('admin.backend.user.lihat_user_multi_select', compact('users'));
    }

    public function storeuserMultiSelectSelect(Request $request){
        $tags = $request->tags;
        dd($tags);
    }

    public function getUser(Request $request){
        $tags =[];
        if($search=$request->name){
            // $tags=Usaaaaaaaer::where('username', 'LIKE', "%$search%")->get();
            $tags = User::select("*")

            ->where('name','LIKE','%'.$search.'%')

            ->get();
        }
        return response()->json($tags);
    }

    public function lihatUserYajra(Request $request)
    {
        if ($request->ajax()) {

            $data = User::where('jenis_user', 'admin')->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){
       
                            // $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            $btn = '
                            <a href="" class="btn btn-info" title="Print" target="_blank"><i class="lni lni-printer"></i></a>
                            <a href="" id="delete" class="btn btn-danger" id="delete" title="delete"><i class="lni lni-trash"></i></a>
                            ';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
          
        return view('admin.backend.user.lihat_user_yajra');
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
        $customPaper = [0, 0, 420, 570];

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
        $users = User::all()->where('jenis_user', 'guru');
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
        $users = User::all()->where('jenis_user', 'wakil');
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

    public function UpdateStatusUser(Request $request){
        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $userId = $request->input('user');
        if($id != $userId ){
            $isChecked = $request->input('is_checked', 0);
            if($isChecked){
                $user = User::find($userId);
                if ($user) {
                    $user->status =  $isChecked;
                    $user->save();
                }
                return response()->json(['message'=>'Pengguna <b class="text-dark">'.$user->name.' </b>Berhasil diaktifkan']); 
                // $notification = array(
                //     'message' => 'Kelas Berhasil ditambahkan',
                //     'alert-type' => 'success',
                // );
                // return redirect()->back()->with($notification); 
            }else{
                $user = User::find($userId);
                if ($user) {
                    $user->status =  $isChecked;
                    $user->save();
                }
                return response()->json(['message'=>'Pengguna <b class="text-danger">'.$user->name.' </b>Berhasil dinonaktifkan']);
                // $notification = array(
                //     'message' => 'Kelas Berhasil ditambahkan',
                //     'alert-type' => 'success',
                // );
                // return redirect()->back()->with($notification); 
            }
        }else{
            return response()->json(['message'=>'Anda Login sebagai <b class="text-danger">'.$name.' </b>Gagal Bro']);
        }
        
        

    }
}
