<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    //
    public function processLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('vendor')->attempt($credentials)) {
            $request->session()->regenerate(); 
            return redirect()->route('dashboardVendor'); 
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
       
    }

    public function showDashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('/');
        }

        $vendor = Auth::guard('vendor')->user(); 

        return view('dashboard_vendor', [
            'pageTitle' => "Dashboard Vendor",
            'name' => $vendor->name,
            'email' => $vendor->email
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect()->route('/'); // Redirect ke halaman login
    }

}
