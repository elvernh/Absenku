<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    //
    public function processLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session
            return redirect()->route('dashboard'); // Redirect ke dashboard
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

        $school = Auth::guard('web')->user();

        return view('dashboard', [
            'pageTitle' => "Dashboard Sekolah",
            'name' => $school->name,
            'email' => $school->email
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect()->route('/'); // Redirect ke halaman login
    }
}
