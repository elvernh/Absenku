<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function processLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate(); 
            return redirect()->route('dashboardStudent'); 
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

        $student = Auth::guard('student')->user(); 

        return view('dashboard_student', [
            'pageTitle' => "Dashboard",
            'name' => $student->full_name,
            'email' => $student->email
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate(); // Hapus session
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect()->route('/'); // Redirect ke halaman login
    }

}
