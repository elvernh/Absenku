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
        // // Validasi input
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        // if (Auth::guard('web')->attempt($credentials)) {
        //     $request->session()->regenerate(); // Regenerasi session
        //     return redirect()->route('dashboard'); // Redirect ke dashboard
        // }

        // return back()->withErrors([
        //     'email' => 'Email atau password salah.',
        // ]);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah pengguna ada di database
        $school = School::where('email', $request->email)->first();
        if ($school) {
            // Cek password
            if ($school && Hash::check($request->password, $school->password)) {
                // Menyimpan data ke session
                session(['school_id' => $school->id]);

                return redirect()->route('dashboard');
            }
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }


        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showDashboard()
    {
        // if (!Auth::check()) {
        //     return redirect()->route('/');
        // }

        // $school = Auth::guard('web')->user();

        // return view('dashboard', [
        //     'pageTitle' => "Dashboard Sekolah",
        //     'name' => $school->name,
        //     'email' => $school->email
        // ]);
        $schoolId = session('school_id');

        if (!$schoolId) {
            // Jika tidak ada school_id di sesi, redirect ke halaman login
            return redirect()->route('/');
        }

        // Ambil data sekolah dari database berdasarkan school_id
        $school = School::find($schoolId);

        // Jika tidak ditemukan, redirect ke login
        if (!$school) {
            return redirect()->route('/');
        }

        return view('dashboard', [
            'pageTitle' => "Dashboard Sekolah",
            'name' => $school->name,
            'email' => $school->email
        ]);
    }

    public function logout(Request $request)
    {
        session()->forget('school_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }
}
