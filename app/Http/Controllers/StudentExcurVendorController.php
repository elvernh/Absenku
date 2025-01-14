<?php

namespace App\Http\Controllers;

use App\Models\StudentExcurVendor;
use Illuminate\Http\Request;

class StudentExcurVendorController extends Controller
{
    //
    public function reject($id) {
        $student = StudentExcurVendor::find($id);
        $student->status = 'denied';
        $student->save();
        
    }
}
