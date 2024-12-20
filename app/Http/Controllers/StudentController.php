<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
        if ($student) {
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

        $student = Student::find($studentId);
        $studentExcur = StudentExcurVendor::getStudentExcur($studentId);
        $sum = StudentExcurVendor::getSumExcur($studentId);

        // Jika tidak ditemukan, redirect ke login
        if (!$student) {
            return redirect()->route('/');
        }
        $results = StudentExcurVendor::where('student_id', $studentId)->get();

        // Mem-filter data berdasarkan hari ini
        $nows = $results->filter(function ($result) {
            return $result->excurVendor->day == Carbon::now()->format('l'); // Bandingkan dengan hari ini
        });
        return view('dashboard_student', [
            'pageTitle' => "Dashboard Murid",
            'name' => $student->full_name,
            'email' => $student->email,
            'studentExcurs' => $studentExcur,
            'results' => $results,
            'sum' => $sum,
            'nows' => $nows
        ]);
    }

    public function logout(Request $request)
    {
        session()->forget('student_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }

    public function showPendaftaran()
    {
        $excurVendors = ExcurVendor::getAll();
        $fees = ExcurVendor::pluck('fee');
        $feeRp = [];
        for ($i = 0; $i < count($fees); $i++) {
            $rp = ExcurVendor::formatRupiah($fees[$i]);
            $feeRp[$i] = $rp;
        }
        return view("pendaftaran", [
            "excurVendors" => $excurVendors,
            "feesRp" => $feeRp
        ]);
    }

    public function showMeeting()
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect()->route('/');
        }

        $student = Student::find($studentId);


        // Jika tidak ditemukan, redirect ke login
        if (!$student) {
            return redirect()->route('/');
        }
        $studentExcs = StudentExcurVendor::where('student_id',$studentId)->get();

        // Mem-filter data berdasarkan hari ini
        // Filter presences berdasarkan kondisi tertentu (misalnya: kehadiran hari ini)
        $presences = $studentExcs->pluck('presences')->flatten();

        return view('meeting_murid', [
            'pageTitle' => "Daftar Meeting",
            'name' => $student->full_name,
            'email' => $student->email,
            'presences' => $presences
        ]);
    }
    public function showPayment()
    {
        $studentId = session('student_id');

        if (!$studentId) {
            return redirect()->route('/');
        }

        $student = Student::find($studentId);


        // Jika tidak ditemukan, redirect ke login
        if (!$student) {
            return redirect()->route('/');
        }
        $studentExcs = StudentExcurVendor::where('student_id',$studentId)->get();
        
        // Filter presences berdasarkan kondisi tertentu (misalnya: kehadiran hari ini)
        $presences = $studentExcs->pluck('presences')->flatten();

        return view('payment_student', [
            'pageTitle' => "Pembayaran",
            'name' => $student->full_name,
            'email' => $student->email,
           
        ]);
    }

}
