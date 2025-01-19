<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class ScanAbsensiController extends Controller
{
    public function scanAbsensi(){
        return view('frontend.absensi.scan_absensi');
    }

    public function scanAbsensi1(){
        return view('frontend.absensi.scan_absensi_html5');
    }

    public function Absensi(){
        return view('frontend.absensi.absensi');
    }

    public function index()
    {
        // Adjust the layout to suit your needs
        return view('admin.pages.qr_code.index');
    }

    public function submit(Request $request)
    {
        $this->validate($request, ['link' => 'required|url']);
        
        // In this use case, the data is not saved to a database.
        // Instead, a unique code is generated based on the current time 
        // (at the moment the QR image is created), 
        // which serves as the identifier for the generated image.
        $code = time();

        // You can adjust the format to your needs 
        // (available formats: png, eps, and svg)
        // Additionally, you can set the QR image size in pixels using ->size(sizeInPixels, e.g., 100).
        // Example: QrCode::format('png')->size(100)->generate($request->link);
        $qr = QrCode::format('png')->generate($request->link);
        $qrImageName = $code . '.png';

        // Save the QR code image to local storage
        Storage::put('public/qr/' . $qrImageName, $qr);

        // Adjust the layout to your needs
        return view('admin.pages.qr_code.scanner', compact('code'));
    }
}
