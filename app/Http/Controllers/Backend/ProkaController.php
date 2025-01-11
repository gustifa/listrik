<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proka;

class ProkaController extends Controller
{
    public function SemuaProka(){
        $proka = Proka::latest()->get();    
        return view('admin.backend.proka.semua_proka', compact('proka'));
    }
}
