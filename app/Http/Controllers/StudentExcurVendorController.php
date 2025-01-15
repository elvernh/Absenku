<?php

namespace App\Http\Controllers;

use App\Models\StudentExcurVendor;
use Illuminate\Http\Request;

class StudentExcurVendorController extends Controller
{
    //
    public function reject($id)
    {
        $student = StudentExcurVendor::find($id);
        $student->status = 'denied';
        if (
            $student->save()
        ) {
            return redirect()->route(route: 'pendaftaran');

        }

    }
    public function approve($id)
    {
        $student = StudentExcurVendor::find($id);
        $student->status = 'approved';
        if (
            $student->save()
        ) {
            return redirect()->route(route: 'pendaftaran');

        }

    }

    public function store(Request $request)
    {
        
        $excurVendor = $request['excurVendor'];
        foreach ($excurVendor as $vendor_id) {
            StudentExcurVendor::create(
                ['excur_vendor_id' => $vendor_id, 'status' => 'pending', 'student_id' => session('student_id'), 'score_mid' => 0, 'score_final' => 0, 'url_certificate' => "-", 'note' => "-"]
            );
        }

        // return view('tes', data: ['data'=>  $request['excurVendor']]);

        if (count($excurVendor) > 0) {
            session()->flash('success', 'Berhasil daftar ekskul');
            return redirect()->route('daftarEks');
        } else {
            session()->flash('error', 'Gagal');
        }
    }
}
