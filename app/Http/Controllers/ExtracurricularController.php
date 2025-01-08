<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    //
    use HasFactory;

    public function index()
    {
        $ekskulList = Extracurricular::paginate(7);
        return view('daftarekskul', [
            "pageTitle" => "Daftar Ekskul",
            "ekskulList" => $ekskulList,
        ]);
    }

    public function findDetilAbsensi($id)
    {
        return view('detilabsensi', [
            "pageTitle" => "Detil Absensi",
            'ekskul' => Extracurricular::find($id)
        ]);
    }
    function destroy(Extracurricular $extracurricular)
    {
        // delete all related projects
        $del = $extracurricular->excurVendors()->delete();
        // delete extracurricular
        $del2 = $extracurricular->delete();
        if ($del && $del2) {
            session()->flash('success', 'Berhasil menghapus ekskul');
            return redirect()->route('dashboardSchool');
        } else {
            session()->flash('error', 'Gagal menghapus ekskul');
            return redirect()->back();
        }
    }
}
