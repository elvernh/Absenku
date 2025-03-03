<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use App\Models\Meeting;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\StudentExcurVendor;
use App\Models\Presence;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{

    public function showDashboard()
    {
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('/');
        }

        $vendor = Vendor::find($vendorId);

        if (!$vendor) {
            return redirect()->route('/');
        }
        $today = date('l');

        // Fetch today's schedule
        $jadwalHariIni = ExcurVendor::getAllTodayByVendor($vendorId);
        $jumlahEkskul = ExcurVendor::getJumlahEkskul($vendorId);
        $meetingsToday = Meeting::getMeetingTodayVendor($vendorId);
        return view('dashboard_vendor', [
            'pageTitle' => "Dashboard Vendor",
            'name' => $vendor->name,
            'email' => $vendor->email,
            'jadwalHariIni' => $jadwalHariIni,
            'jumlahEkskul' => $jumlahEkskul,
            'meetingsToday' => $meetingsToday,
        ]);
    }

    public function daftarPertemuan()
    {
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('/');
        }

        // Fetch ExcurVendor records for the vendor
        $excurVendors = ExcurVendor::with(['extracurricular'])
            ->withCount('studentExcurVendors') // This calculates the count of related StudentExcurVendor
            ->where('vendor_id', $vendorId)
            ->get();



        // Calculate the number of students for each ExcurVendor
        $excurVendors = ExcurVendor::getAllByVendorWithStudentCount($vendorId);
        // $excurVendors  = ExcurVendor::where('vendor_id', $vendorId)->get();
        // $excurVendors = $excurVendors->map(function ($item){
        //     $item->total = StudentExcurVendor::where('excur_vendor_id', 3)->count();
        //     return $item;
        // });
        // Fetch the vendor details
        $vendor = Vendor::find($vendorId);

        // Return the view with the data
        return view('daftarpertemuan', [
            'pageTitle' => "Daftar Pertemuan",
            'name' => $vendor->name,
            'email' => $vendor->email,
            'excurVendors' => $excurVendors,
            'meetings' => Meeting::getMeetingVendor($vendorId)
        ]);
    }

    public function detilPertemuan($id)
    {
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('/');
        }

        // Fetch the ExcurVendor details along with related data
        $excurVendor = ExcurVendor::getAllByVendorWithStudent($vendorId);

        $excurVendor = ExcurVendor::with(['extracurricular', 'studentExcurVendors.student', 'studentExcurVendors.presences'])
            ->where('id', $id)
            ->where('vendor_id', $vendorId)
            ->first();

        // Check if the record exists and belongs to the vendor
        if (!$excurVendor) {
            return redirect()->route('daftarPertemuan')->withErrors('Data not found or unauthorized access.');
        }

        $vendor = Vendor::find($vendorId);

        // Collect all student details and their presences for the specific meeting
        $presences = $excurVendor->studentExcurVendors->map(function ($studentExcurVendor) use ($id) {
            $presence = $studentExcurVendor->presences()->where('meeting_id', $id)->first();

            // Include student and presence only if presence exists
            if ($presence) {
                return [
                    'student' => $studentExcurVendor->student,
                    'presence' => $presence
                ];
            }

            return null; // Skip if no presence exists
        })->filter(); // Remove null values
        //data shouldve shown 13 but instead it is not showing anything
        // Return the detail view with the data
        return view('detilpertemuan', [
            'pageTitle' => "Detil Pertemuan",
            'name' => $vendor->name,
            'email' => $vendor->email,
            'excurVendor' => $excurVendor,
            'presences' => $presences,
        ]);
    }



    public function daftarSiswa()
    {
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('/');
        }

        $vendor = Vendor::find($vendorId);

        return view('daftarsiswa', [
            'pageTitle' => "Daftar Siswa",
            'name' => $vendor->name,
            'email' => $vendor->email,
        ]);
    }

    public function makePresences($id)
    {
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('/');
        }

        $vendor = Vendor::find($vendorId);
        // Ambil data meeting berdasarkan ID
        $meeting = Meeting::with('excurVendor.studentExcurVendors.student')
            ->find($id);

        if (!$meeting) {
            return redirect()->route('404');
        }

        // Ambil data murid yang terhubung
        $students = $meeting->excurVendor->studentExcurVendors
            ->filter(function ($muridVendorEkskul) {
                // Ganti 'status' dan 'active' dengan atribut dan nilai yang sesuai
                return $muridVendorEkskul->status === 'approved';
            })
            ->map(function ($muridVendorEkskul) {
                return $muridVendorEkskul;
            });
        $presences = Presence::where('meeting_id', $id)->get();

        return view('tambahabsen', [
            'pageTitle' => "Tambah Absen " . $meeting->ExcurVendor->extracurricular->name,
            'name' => $vendor->name,
            'email' => $vendor->email,
            'meeting' => $meeting,
            'students' => $students,
            'presences' => $presences
        ]);
    }
    public function logout(Request $request)
    {
        session()->forget('vendor_id');
        return redirect()->route('/'); // Redirect ke halaman login
    }
}
