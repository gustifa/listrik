<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\User;

class ImportUserController extends Controller
{

    public function index()
    {
        $users = User::latest()->get();

        return view('admin.backend.user.lihat_user', compact('users'));
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
}
