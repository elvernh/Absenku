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
        $student = Student::create($validatedData);

        // Mengembalikan respon
        return $student->id;
    }


    public function index()
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
        $results = StudentExcurVendor::where('student_id', $studentId)->get();

        // Mem-filter data berdasarkan hari ini
        $nows = $results->filter(function ($result) {
            return $result->excurVendor->day == Carbon::now()->format('l');
        });

        $midScore = StudentExcurVendor::getMidScoreAvg($studentId);
        $finalScore = StudentExcurVendor::getFinalScoreAvg($studentId);
        return view('dashboard_student', [
            'pageTitle' => "Dashboard Murid",
            'name' => $student->full_name,
            'email' => $student->email,
            'results' => $results,
            'nows' => $nows,
            'student' => $studentId,
           
            'midScore' => $midScore,
            'finalScore' => $finalScore
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
        $studentExcs = StudentExcurVendor::where('student_id', $studentId)->get();
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
        $studentExcs = StudentExcurVendor::where('student_id', $studentId)->get();
        $payments = $studentExcs->pluck('payment')->flatten();

        return view('payment_student', [
            'pageTitle' => "Pembayaran",
            'name' => $student->full_name,
            'email' => $student->email,
            'studentExcs' => $studentExcs,
            'payments' => $payments,
        ]);
    }
    public function showBayar()
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
        $studentExcs = StudentExcurVendor::where('student_id', $studentId)->get();
        $studentExcs = $studentExcs->map(function ($item) {
            // Modifikasi nilai dalam array
            $item->bill = PaymentController::rupiahFormat($item->bill);
            return $item;
        });

        return view('paymentform', [
            'pageTitle' => "Pembayaran",
            'name' => $student->full_name,
            'email' => $student->email,
            'studentExcs' => $studentExcs,

        ]);
    }

    public function registerExcur(Request $request)
    {
        $validated = $request->validate([
            'excur_vendor_id' => 'required|integer',
            'day' => 'required|string',
            'full_name' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'educational_level' => 'required|string|max:255',
            'from_class' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $ekskur = $request->input('ekskur', []); // Jika tidak ada checkbox dicentang, akan mengembalikan array kosong.

        $studentId = StudentController::store($request);
        
        return view('tes', [
            'data' => $ekskur,


        ]);
    }
}
