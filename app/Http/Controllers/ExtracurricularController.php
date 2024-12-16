<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    //
    use HasFactory;

    public function index(){
        return view('daftarekskul',[
            "pageTitle" => "Daftar Ekskul",
            "ekskulList" => Extracurricular::all()
        ]);
    }
}
