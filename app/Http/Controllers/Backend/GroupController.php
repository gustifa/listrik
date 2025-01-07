<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function SemuaGroup(){
        $group = Group::latest()->get();
        return view('admin.backend.group.semua_group', compact('group'));
    }

    public function TambahGroup(){
        $group = Group::latest()->get();
        return view('admin.backend.group.tambah_group', compact('group'));
    }

    public function SimpanGroup(Request $request){

        Group::insert([
            'nama_group' => strtoupper($request->nama_group),
        ]);


        $notification = array(
            'message' => 'Group Berhasil ditambahkan',
            'alert-type' => 'success',
        );
        return redirect()->route('semua.group')->with($notification);

            

    }
}
