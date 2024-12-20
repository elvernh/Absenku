<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{

    public function processLogin(Request $request)
    {
        // // Validasi input
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        // if (Auth::guard('vendor')->attempt($credentials)) {
        //     $request->session()->regenerate(); 
        //     return redirect()->route('dashboardVendor'); 
        // }

        // return back()->withErrors([
        //     'email' => 'Email atau password salah.',
        // ]);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah pengguna ada di database
        $vendor = Vendor::where('email', $request->email)->first();
        if ($vendor) {
            // Cek password
            if ($vendor && Hash::check($request->password, $vendor->password)) {
                // Menyimpan data ke session
                session(['vendor_id' => $vendor->id]);

                return redirect()->route('dashboardVendor');
            }
            // Password is incorrect
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }


        return back()->withErrors(['email' => 'Invalid credentials']);
    }

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

 

    public function logout(Request $request)
    {
        session()->forget('vendor_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }
}
