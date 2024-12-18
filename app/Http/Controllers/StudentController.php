<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //
    public function processLogin(Request $request)
    {
        // Validasi input
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        // if (Auth::guard('student')->attempt($credentials)) {
        //     $request->session()->regenerate(); 
        //     return redirect()->route('dashboardStudent'); 
        // }
        // return back()->withErrors([
        //     'email' => 'Email atau password salah.',
        // ]);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah pengguna ada di database
        $student = Student::where('email', $request->email)->first();
        if($student){
            // Cek password
            if ($student && Hash::check($request->password, $student->password)) {
                // Menyimpan data ke session
                session(['student_id' => $student->id]);
    
                return redirect()->route('dashboardStudent');
            }
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }
        

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showDashboard()
    {
        $studentId = session('student_id');

        if (!$studentId) {
            // Jika tidak ada student_id di sesi, redirect ke halaman login
            return redirect()->route('/');
        }

        // Ambil data sekolah dari database berdasarkan student_id
        $student = student::find($studentId);

        // Jika tidak ditemukan, redirect ke login
        if (!$student) {
            return redirect()->route('/');
        }

        return view('dashboard', [
            'pageTitle' => "Dashboard Sekolah",
            'name' => $student->full_name,
            'email' => $student->email
        ]);
    }

    public function logout(Request $request)
    {
        session()->forget('student_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }

}
