<?php
namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function processLogin(Request $request, $type)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = null;
        if ($type == "student") {
            // Cek apakah pengguna ada di database
            $user = Student::where('email', $request->email)->first();
        } else if ($type == "vendor") {
            // Cek apakah pengguna ada di database
            $user = Vendor::where('email', $request->email)->first();
        } else if ($type == "school") {
            // Cek apakah pengguna ada di database
            $user = School::where('email', $request->email)->first();
        }
        if ($user) {
            if ($user && Hash::check($request->password, $user->password)) {
                if ($type == "student") {
                    session(['student_id' => $user->id]);
                    return redirect()->route('dashboardStudent');
                } else if ($type == "vendor") {
                    session(['vendor_id' => $user->id]);
                    return redirect()->route('dashboardVendor');
                } else if ($type == "school") {
                    session(['school_id' => $user->id]);
                    return redirect()->route('dashboard');
                }

            }
            return back()->withErrors(['password' => 'The email and password is incorrect.']);
        }



        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}

?>