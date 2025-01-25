<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use App\Models\StudentExcurVendor;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        // Validasi request untuk vendor IDs
        $request->validate([
            'excurVendor' => 'required|array|min:1',
            'excurVendor.*' => 'exists:excur_vendors,id',
        ]);

        $excurVendor = $request['excurVendor'];
        $allExcurData = [];
        $conflictingVendors = [];
        $conflictingMessages = [];

        // Ambil data vendor berdasarkan ID
        foreach ($excurVendor as $vendorId) {
            $vendorData = ExcurVendor::find($vendorId);

            if ($vendorData) {
                $allExcurData[] = $vendorData;
            } else {
                session()->flash('error', 'Vendor not found for ID: ' . $vendorId);
                return redirect()->back();
            }
        }

        // Validasi waktu mulai antar vendor
        for ($i = 0; $i < count($allExcurData) - 1; $i++) {
            for ($j = $i + 1; $j < count($allExcurData); $j++) {
                $startTime1 = Carbon::parse($allExcurData[$i]->start_time);
                $endTime1 = Carbon::parse($allExcurData[$i]->end_time);
                $startTime2 = Carbon::parse($allExcurData[$j]->start_time);
                $endTime2 = Carbon::parse($allExcurData[$j]->end_time);

                // Periksa jika waktu mulai dan selesai tumpang tindih
                if (
                    ($startTime1->between($startTime2, $endTime2) || $endTime1->between($startTime2, $endTime2)) ||
                    ($startTime2->between($startTime1, $endTime1) || $endTime2->between($startTime1, $endTime1))
                ) {
                    $conflictingVendors[] = $allExcurData[$i];
                    $conflictingMessages[] = $allExcurData[$i]->extracurricular->name . ' conflicts with ' . $allExcurData[$j]->extracurricular->name;
                }
            }
        }


        // Jika ada konflik waktu
        if (count($conflictingVendors) > 0) {
            foreach ($conflictingVendors as $vendor) {
                StudentExcurVendor::create([
                    'excur_vendor_id' => $vendor->id,
                    'status' => 'pending',
                    'student_id' => session('student_id'),
                    'score_mid' => 0,
                    'score_final' => 0,
                    'url_certificate' => '-',
                    'note' => '-',
                ]);
            }

            session()->flash('error', implode(' ', $conflictingMessages));
            return redirect()->back();
        }

        // Jika tidak ada konflik, buat semua entri
        foreach ($allExcurData as $vendor) {
            StudentExcurVendor::create([
                'excur_vendor_id' => $vendor->id,
                'status' => 'active',
                'student_id' => session('student_id'),
                'score_mid' => 0,
                'score_final' => 0,
                'url_certificate' => '-',
                'note' => '-',
            ]);
        }

        // Redirect sukses
        session()->flash('success', 'Successfully registered for the extracurricular activities.');
        return redirect()->route('daftarEks');
    }




}
