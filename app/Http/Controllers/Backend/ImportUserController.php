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


    public function import(Request $request)
    {
        // Validate incoming request data
        // $request->validate([
        //     'file' => 'required|max:2048',
        // ]);

        Excel::import(new UsersImport, $request->file('file'));

        return back()->with('success', 'Users imported successfully.');
    }
}
