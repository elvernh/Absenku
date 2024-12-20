<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use App\Models\Student;
use App\Models\StudentExcurVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'educational_level' => 'required|string|max:255',
            'from_class' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Membuat data student
        $student = Student::createData($validatedData);

        // Mengembalikan respon
        return response()->json([
            'message' => 'Data berhasil dibuat',
            'data' => $student,
        ], 201);
    }
    public function processLogin(Request $request)
    {
        
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
            return redirect()->route('/');
        }

        // Ambil data sekolah dari database berdasarkan student_id
        $student = Student::find($studentId);
        $studentExcur = StudentExcurVendor::getStudentExcur($studentId);
        $sum = StudentExcurVendor::getSumExcur($studentId);

        // Jika tidak ditemukan, redirect ke login
        if (!$student) {
            return redirect()->route('/');
        }

        return view('dashboard_student', [
            'pageTitle' => "Dashboard Sekolah",
            'name' => $student->full_name,
            'email' => $student->email,
            'studentExcur' => $studentExcur,
            'sum'=> $sum
        ]);
    }

    public function logout(Request $request)
    {
        session()->forget('student_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }

    public function showPendaftaran() {
        $excurVendors = ExcurVendor::getAll();
        $fees = ExcurVendor::pluck('fee');
        $feeRp = [];
        for($i = 0; $i < count($fees); $i++) {
            $rp = ExcurVendor::formatRupiah($fees[$i]);
            $feeRp[$i] = $rp;
        }
        return view("pendaftaran", [
            "excurVendors" => $excurVendors,
            "feesRp" => $feeRp
        ]);
    }
}
