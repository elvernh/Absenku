<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use App\Models\Extracurricular;
use App\Models\Meeting;
use App\Models\Presence;
use App\Models\School;
use App\Models\Student;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    //
    public function processLogin(Request $request)
    {

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
        $vendorsCount = Vendor::withCount('excurVendors')->get();

        return view('dashboard', [
            'pageTitle' => "Dashboard Sekolah",
            'name' => $school->name,
            'email' => $school->email,
            'excurVendors' => ExcurVendor::getAllToday(),
            'vendors' => Vendor::all(),
            'counts' => $vendorsCount
        ]);
    }
    public function showDaftarEkskul()
    {

        $schoolId = session('school_id');

        if (!$schoolId) {
            return redirect()->route('/');
        }

        $school = School::find($schoolId);

        if (!$school) {
            return redirect()->route('/');
        }

        return view('daftarekskul', [
            'pageTitle' => "Daftar Ekskul",
            'school' => $school,
            'excurVendors' => ExcurVendor::getAll()
        ]);
    }

    public function showDaftarMurid()
    {

        $schoolId = session('school_id');

        if (!$schoolId) {
            return redirect()->route('/');
        }

        $school = School::find($schoolId);

        if (!$school) {
            return redirect()->route('/');
        }

        return view('daftarmurid', [
            'pageTitle' => "Daftar Murid",
            'school' => $school,
            'smps' => Student::getSmp(),
            'smas' => Student::getSma()
        ]);
    }

    public static function showMeeting()
    {
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

        return view('absensisiswa', [
            'pageTitle' => "Meeting",
            'name' => $school->name,
            'email' => $school->email,
            'meetings' => Meeting::getAll()
        ]);
    }

    public static function showAbsensi($id)
    {
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

        return view('detilabsensi', [
            'pageTitle' => "Detail Absensi",
            'name' => $school->name,
            'email' => $school->email,
            'presences' => Presence::getPresenceBasedOnMeet($id)
        ]);
    }

    public function logout(Request $request)
    {
        session()->forget('school_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }
}
