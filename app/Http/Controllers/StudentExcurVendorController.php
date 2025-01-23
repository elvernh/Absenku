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
        // Retrieve the list of vendor IDs from the request
        $excurVendor = $request['excurVendor'];
        $allExcurData = [];
        $validateExc = [];
        $data = [];

        // Fetch data for each vendor from the database
        for ($i = 0; $i < count($excurVendor); $i++) {
            $excurVendorData = ExcurVendor::find($excurVendor[$i]);

            if ($excurVendorData) {
                $allExcurData[] = $excurVendorData;
            } else {
                // Vendor not found, add an error message or handle it accordingly
                session()->flash('error', 'Vendor not found for ID: ' . $excurVendor[$i]);
                return redirect()->back();
            }
        }

        // Validate if start times of consecutive vendors are the same
        for ($i = 0; $i < count($allExcurData) - 1; $i++) {
            $startTime1 = Carbon::parse($allExcurData[$i]->start_time);
            $startTime2 = Carbon::parse($allExcurData[$i + 1]->start_time);

            // Check if start times are different
            if (!($startTime1->equalTo($startTime2))) {
                $validateExc[] = $allExcurData[$i];
                $data[] = $allExcurData[$i]->extracurricular->name . " has different time";
            }

        }

        // If there are any vendors with conflicting start times, return an error
        if (count($validateExc) > 0) {
            foreach ($validateExc as $vendor) {
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

            // Check if any vendors were successfully processed
            if (count($excurVendor) > 0) {
                session()->flash('success', 'Successfully registered for the extracurricular activities. Count: ' . count($validateExc));
                return redirect()->route('daftarEks');
            } else {
                session()->flash('error', 'Failed to register');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'There are vendors with conflicting start times.' . count($validateExc));
            return redirect()->back();
        }

        // Proceed to create the StudentExcurVendor records

    }




}
