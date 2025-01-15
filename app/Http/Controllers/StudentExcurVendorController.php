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
}
