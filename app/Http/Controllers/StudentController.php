<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\ExcurVendor;
use App\Models\Student;
use App\Models\StudentExcurVendor;
use DB;
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
            ->where('status', 'approved')
            ->paginate(6); 

        $total = count($results);

        return view('dashboard_student', [
            'pageTitle' => "Dashboard Murid",
            'name' => $student->full_name,
            'email' => $student->email,
            'results' => $results,
            'student' => $studentId,
            'filename' => $student->profile_picture,
            'total' => $total
        ]);
    }

    public function showSertifikat()
    {
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
            ,
            'filename' => $student->profile_picture,

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
            "feesRp" => $feeRp,

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
            'presences' => $presences,
            'filename' => $student->profile_picture,

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
            'filename' => $student->profile_picture,

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
            'filename' => $student->profile_picture,

        ]);
    }

    public function register(Request $request)
    {
        $search = Student::where('email', $request['email'])->get();
        if (!$search) {
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

    public function showPendaftaranEkskul(Request $request)
    {
        $studentId = session('student_id');

        if (!$studentId) {
            // Jika tidak ada school_id di sesi, redirect ke halaman login
            return redirect()->route('/');
        }

        $excurActive = ExcurVendor::where('status', operator: 'Aktif')->get();

        $student = Student::find($studentId);
        return view('student_pendaftaran', [
            'pageTitle' => "Pendaftaran Ekskul",
            'name' => $student->full_name,
            'email' => $student->email,
            'excurVendors' => ExcurVendor::where('status', 'Aktif')->get(),
            'filename' => $student->profile_picture,
            'historys' => StudentExcurVendor::where('student_id', $studentId)->paginate(10)
        ]);
    }

    public function profileView()
    {
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
            ,
            'filename' => $student->profile_picture,

        ]);
    }

    public function editProfileView($id)
    {
        $studentId = session('student_id');

        if (!$studentId) {
            // Jika tidak ada school_id di sesi, redirect ke halaman login
            return redirect()->route('/');
        }
        $student = Student::find($studentId);

        return view('editprofile', [
            'pageTitle' => "Profile",
            'name' => $student->full_name,
            'email' => $student->email,
            'student' => $student,
            'filename' => $student->profile_picture,

        ]);
    }



    public function editProfileSubmit(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return redirect()->back()->with('error', 'Data not found!');
        }
        $validated = $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        if ($request->hasFile(key: 'profile_picture')) {
            $filePath = $request->file('profile_picture')->store('profile');
            $fileName = basename($filePath);
        } else {
            $fileName = $student->profile_picture;
        }

        // return view('tes', ['data' => $request['profile_picture']]);
        $update = DB::table('students')
            ->where('id', $id)
            ->update([
                'full_name' => $request['full_name'],
                'grade' => $request['grade'],
                'educational_level' => $request['educational_level'],
                'from_class' => $request['from_class'],
                'email' => $request['email'],
                'profile_picture' => $fileName
            ]);

        // Redirect dengan pesan sukses atau gagal
        if ($update) {
            return redirect()->back()->with('success', 'Data updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update the data');
        }
    }


}
