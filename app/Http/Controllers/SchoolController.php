<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function showSchool()
    {
        $sekolah = School::first(); 
        return view('school', compact('sekolah'));
    }
}
