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

        // Cek user berdasarkan email
        $school = School::where('email', $request->email)->first();

        if ($school && Hash::check($request->password, $school->password)) {
            session(['school_id' => $school->id]);
            return redirect()->route('dashboard'); 
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function showDashboard()
    {
        $school = School::find(session('school_id'));
        $schoolArray = $school->toArray();
        $schoolArray = $school->only(['name', 'email']); 

        return view('dashboard', [
            'pageTitle' => "Sekolah",
            'name' => $schoolArray['name'],
            'email' => $schoolArray['email']
        ]);
    }
}
