<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{

    

    public function index()
    {
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('/');
        }

        $vendor = Vendor::find($vendorId);

        if (!$vendor) {
            return redirect()->route('/');
        }
        $today = date('l');

        // Fetch today's schedule
        $jadwalHariIni = ExcurVendor::getAllTodayByVendor($vendorId);
        $jumlahEkskul = ExcurVendor::getJumlahEkskul($vendorId);
        return view('dashboard_vendor', [
            'pageTitle' => "Dashboard Vendor",
            'name' => $vendor->name,
            'email' => $vendor->email,
            'jadwalHariIni' => $jadwalHariIni,
            'jumlahEkskul' => $jumlahEkskul
        ]);
    }

 

    public function logout(Request $request)
    {
        session()->forget('vendor_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }
}
