<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\StudentExcurVendor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{

    public function showDashboard()
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

    public function daftarPertemuan()
    {
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('/');
        }

        // Fetch ExcurVendor records for the vendor
        $excurVendors = ExcurVendor::with(['extracurricular'])
            ->withCount('studentExcurVendors') // This calculates the count of related StudentExcurVendor
            ->where('vendor_id', $vendorId)
            ->get();



        // Calculate the number of students for each ExcurVendor
        $excurVendors = ExcurVendor::getAllByVendorWithStudentCount($vendorId);

        // Fetch the vendor details
        $vendor = Vendor::find($vendorId);

        // Return the view with the data
        return view('daftarpertemuan', [
            'pageTitle' => "Daftar Pertemuan",
            'name' => $vendor->name,
            'email' => $vendor->email,
            'excurVendors' => $excurVendors,
        ]);
    }

    public function daftarSiswa(){
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('/');
        }

        $vendor = Vendor::find($vendorId);

        return view('daftarsiswa', [
            'pageTitle' => "Daftar Siswa",
            'name' => $vendor->name,
            'email' => $vendor->email,
        ]);
    }


    public function logout(Request $request)
    {
        session()->forget('vendor_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }
}
