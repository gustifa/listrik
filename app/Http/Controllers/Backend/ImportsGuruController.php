<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
class ImportsGuruController extends Controller
{
    public function LihatGuru(){
        // echo "tes";
        $guru = Guru::latest()->get();
        return view('admin.backend.guru.lihat_guru', compact('guru'));
    }
}
