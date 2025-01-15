<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use App\Models\Extracurricular;
use App\Models\Meeting;
use App\Models\Presence;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentExcurVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    //


    public function index()
    {

        $schoolId = session('school_id');
        // Jika tidak ditemukan, redirect ke login
        if (!$schoolId) {
            return redirect()->route('/');
        }
        $school = School::find($schoolId);
        if (!$school) {
            return redirect()->route('/');
        }

        $vendorsCount = Vendor::withCount('excurVendors')->get();

        return view('dashboard', [
            'pageTitle' => "Dashboard Sekolah",
            'name' => $school->name,
            'email' => $school->email,
            'meetingsToday' => Meeting::getMeetingToday(),
            'vendors' => Vendor::all(),
            'counts' => $vendorsCount
        ]);
    }
    public function showDaftarEkskulAktif()
    {

        $schoolId = session('school_id');

        if (!$schoolId) {
            return redirect()->route('/');
        }

        $school = School::find($schoolId);

        if (!$school) {
            return redirect()->route('/');
        }

        return view('daftarekskulaktif', [
            'pageTitle' => "Daftar Ekstrakulikuler Aktif",
            'school' => $school,
            'excurVendors' => ExcurVendor::getAll()
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
            'pageTitle' => "Daftar Ekstrakulikuler",
            'school' => $school,
            'extracurriculars' => Extracurricular::getAll()
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
    public function showDaftarVendor()
    {

        $schoolId = session('school_id');

        if (!$schoolId) {
            return redirect()->route('/');
        }

        $school = School::find($schoolId);

        if (!$school) {
            return redirect()->route('/');
        }

        return view('listvendor', [
            'pageTitle' => "Daftar Vendor",
            'school' => $school,
            'vendors' => Vendor::getAll()

        ]);
    }
    public static function showMeeting($excurVendorId)
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
        $name = ExcurVendor::find($excurVendorId);

        return view('absensisiswa', [
            'pageTitle' => $name->extracurricular->name,
            'name' => $school->name,
            'email' => $school->email,
            'meetings' => Meeting::getAllByExcurVendorId($excurVendorId)
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
        $name = Meeting::find($id);

        return view('detilabsensi', [
            'pageTitle' => "Detail Absensi",
            'name' => $school->name,
            'email' => $school->email,
            'presences' => Presence::getPresenceBasedOnMeet($id),
            'excur' => $name
        ]);
    }



    public function showAddExcur()
    {
        $schoolId = session('school_id');

        if (!$schoolId) {
            return redirect()->route('/');
        }

        $school = School::find($schoolId);

        if (!$school) {
            return redirect()->route('/');
        }
        $vendors = Vendor::getAll();
        return view('tambahekskul', [
            'pageTitle' => "Tambah Ekskul",
            'all' => $vendors,
            'name' => $school->name,
            'email' => $school->email,
        ]);
    }
    public function addExcur(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'division' => 'required',
            'level' => 'required',
            'fee' => 'required|numeric',
            'vendor_id' => 'required|array',
            'vendor_id.*' => 'exists:vendors,id', // Ensure each vendor ID exists
        ]);
        $ekskul = Extracurricular::create($validated);
        if ($ekskul) {
            // Flash message ke session
            session()->flash('success', 'Berhasil menambahkan ekskul');
            return redirect()->route('dashboardSchool');
        } else {
            session()->flash('error', 'Gagal menambahkan ekskul');
            return redirect()->back();
        }
    }

    public function updateExcur($id)
    {
        $schoolId = session('school_id');

        if (!$schoolId) {
            return redirect()->route('/');
        }

        $school = School::find($schoolId);

        if (!$school) {
            return redirect()->route('/');
        }

        // Retrieve the extracurricular record with the given ID and school ID
        $extracurricular = Extracurricular::find($id);

        if (!$extracurricular) {
            return redirect()->route('/')->with('error', 'Extracurricular not found');
        }

        return view('editekskul', [
            'pageTitle' => "Update Ekskul",
            'name' => $school->name,
            'email' => $school->email,
            'extracurricular' => $extracurricular,
            'school' => $school,
        ]);
    }


    public function setUpdateExcur(Request $request, $id)
    {
        $schoolId = session('school_id');

        if (!$schoolId) {
            return redirect()->route('/');
        }

        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|string',
            'level' => 'required|string',
        ]);

        // Find the extracurricular by its ID and school ID
        $extracurricular = Extracurricular::find($id);

        if (!$extracurricular) {
            return redirect()->route('/')->with('error', 'Extracurricular not found');
        }

        // Update the extracurricular data
        $extracurricular->update([
            'name' => $request->name,
            'division' => $request->division,
            'level' => $request->level,
        ]);

        // Redirect back with success message
        return redirect()->route('daftarekskul')->with('success', 'Extracurricular updated successfully!');
    }


    public function showAddVendor()
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
        $vendors = Vendor::getAll();
        return view('add_vendor', [
            'pageTitle' => "Tambah Vendor",
            'name' => $school->name,
            'email' => $school->email,
        ]);
    }

    public function addVendor(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:vendors',
            'password' => 'required',
            'description' => 'required',
        ]);

        // Hash password
        $validated['password'] = bcrypt($validated['password']);

        // Generate UUID token
        $validated['token'] = Str::uuid();
        $vendor = Vendor::create($validated);
        if ($vendor) {
            // Flash message ke session
            session()->flash('success', 'Berhasil menambahkan vendor');
            return redirect()->route('dashboardSchool');
        } else {
            session()->flash('error', 'Gagal menambahkan vendor');
            return redirect()->back();
        }
    }

    public function showPendaftaran()
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
            return redirect()->route(route: '/');
        }

        return view('listpendaftaran', [
            'pageTitle' => "Pendaftaran",
            'name' => $school->name,
            'email' => $school->email,
            'pendings' => StudentExcurVendor::listPending(),
            'historys' => StudentExcurVendor::getHistory(),
            'all' => StudentExcurVendor::all()
        ]);
    }
}
