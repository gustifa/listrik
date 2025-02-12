<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesertaDidikController extends Controller
{
    public function allPesertaDidik(){
        return view('admin.backend.peserta_didik.all_peserta_didik');
    }
}
