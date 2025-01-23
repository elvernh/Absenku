<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\ExcurVendor;
use App\Models\Student;
use App\Models\StudentExcurVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Str;

class StudentController extends Controller
{
   


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
        $results = StudentExcurVendor::where('student_id', $studentId)
        ->where('status', 'approved') // Menambahkan kondisi untuk kolom status
        ->get();
    
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
            'filename' => $student->profile_picture,
            'midScore' => $midScore,
            'finalScore' => $finalScore
        ]);
    }

    public function showSertifikat(){
        $studentId = session('student_id');
    
        if (!$studentId) {
            return redirect()->route('/');
        }
    
        $student = Student::find($studentId);
    
        // If student not found, redirect to login
        if (!$student) {
            return redirect()->route('/');
        }
    
        // Fetch the student's extracurricular vendor record
        $studentExcurVendor = StudentExcurVendor::where('student_id', $studentId)->get();
    
        if (!$studentExcurVendor) {
            // If no record is found, redirect with an error message
            return redirect()->route('/')->with('error', 'No extracurricular data found.');
        }
    
        // Get the list of certificates (assuming it's stored as an array or JSON)
    
    
        return view('sertifikat', [
            'pageTitle' => "Sertifikat", 
            'name' => $student->full_name,
            'email' => $student->email,
            'studentExcurVendor' => $studentExcurVendor
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
        $payments = $payments->map(function ($payment) {
            // Mengambil fee dari excurVendor dan format menjadi rupiah
            $transfer = $payment->transfer_url;
            $transfer1 = str_replace("bukti/", "", $transfer);    
            $payment->transfer_url = $transfer1;
            
            return $payment;
        });
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
       
        $studentExcs = StudentExcurVendor::where('student_id', $studentId)
            ->where('status', 'approved')  // Pengecekan status
            ->get();
        
            $studentExcs = $studentExcs->map(function ($studentExc) {
                // Mengambil fee dari excurVendor dan format menjadi rupiah
                $fee = $studentExc->excurVendor->fee;
                $formattedFee = 'Rp ' . number_format($fee, 2, ',', '.'); // Format dengan 2 desimal
        
                // Menambahkan formatted_fee ke dalam object studentExc
                $studentExc->formatted_fee = $formattedFee;
                
                return $studentExc; // Mengembalikan object yang sudah diupdate
            });
        return view('paymentform', [
            'pageTitle' => "Pembayaran",
            'name' => $student->full_name,
            'email' => $student->email,
            'studentExcs' => $studentExcs,

        ]);
    }

    public function register(Request $request)
    {        
        $search = Student::where('email', $request['email'])->get();
        if(!$search) {
            return redirect()->route(route: 'pendaftaran')->with('error', 'Registration failed!');
        }
        // Buat instance Student
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'educational_level' => 'required|string|max:255',
            'from_class' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|max:255',
            'password' => 'required|string|min:8',
            'profile_picture' => "default.png",
            'token' => Str::uuid(),
        ]);
        $validated['profile_picture'] = 'default.png';
        $validated['token'] = Str::uuid();
        $student = Student::create($validated);
    
        // Cek apakah berhasil disimpan
        if ($student) {
            session(['student_id' => $student->id]);
            return redirect()->route('dashboardStudent')->with('success', 'Registration successful!');
        } else {
            return redirect()->route(route: 'pendaftaran')->with('error', 'Registration failed!');
        }
    }
    
    public function showPendaftaranEkskul(Request $request) {
        $studentId = session('student_id');

        if (!$studentId) {
            // Jika tidak ada school_id di sesi, redirect ke halaman login
            return redirect()->route('/');
        }
        $student = Student::find($studentId);
        return view('student_pendaftaran', [
            'pageTitle' => "Pendaftaran Ekskul",
            'name' => $student->full_name,
            'email' => $student->email,
            'excurVendors' => ExcurVendor::where('status', 'Aktif')->get(),
            'historys' => StudentExcurVendor::where('student_id', $studentId)->paginate(10)
        ]);
    }

    public function profileView() {
        $studentId = session('student_id');

        if (!$studentId) {
            // Jika tidak ada school_id di sesi, redirect ke halaman login
            return redirect()->route('/');
        }
        $student = Student::find($studentId);
        return view('profileview', [
            'pageTitle' => "profile",
            'name' => $student->full_name,
            'email' => $student->email,
            'student' => $student
        ]);
    }

    public function editProfileView($id) {
        $studentId = session('student_id');

        if (!$studentId) {
            // Jika tidak ada school_id di sesi, redirect ke halaman login
            return redirect()->route('/');
        }
        $student = Student::find($studentId);

        return view('editprofile', [
            'pageTitle' => "profile",
            'name' => $student->full_name,
            'email' => $student->email,
            'student' => $student
        ]);
    }

    public function editProfileSubmit(Request $request, $id) {
       $update = Student::find($id);
        // Find the ExcurVendor record
        $student = Student::find($id);
        if (!$student) {
            return redirect()->back()->with('error', 'Data not found!');
        }
        // Ambil data berdasarkan ID
        $student = Student::find($id);
        if (!$student) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Update data
        $update = $student->update($request->all());


        // Check if update was successful
        if ($update) {
            return redirect()->back()->with('success', 'Data updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update the data');
        }
        // return view('tes', ['data' => $request['status']]);
    }
}
