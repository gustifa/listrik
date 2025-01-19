<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScanAbsensiController extends Controller
{
    public function scanAbsensi(){
        return view('frontend.absensi.scan_absensi');
    }

    public function scanAbsensi1(){
        return view('frontend.absensi.scan_absensi_html5');
    }
}
