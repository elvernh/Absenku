<?php

namespace App\Http\Controllers;

use App\Models\ExcurVendor;
use Illuminate\Http\Request;

class ExcurVendorController extends Controller
{
    //
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $validated = $request->validate([
    //         'extracurricular_id' => 'required|integer',
    //         'academic_year' => 'required|string',
    //         'semester' => 'required|string',
    //         'pic' => 'required|string',
    //         'day' => 'required|string',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //         'start_time' => 'required|string',
    //         'end_time' => 'required|string',
    //         'fee' => 'required|numeric',
    //         'vendor' => 'required|array',
    //         'vendor.*' => 'integer|exists:vendors,id',
    //     ]);

    //     $vendor = $validated['vendor'];
    //     foreach ($vendor as $vendor_id) {
    //         ExcurVendor::create([
    //             'extracurricular_id' => $validated['extracurricular_id'],
    //             'academic_year' => $validated['academic_year'],
    //             'semester' => $validated['semester'],
    //             'pic' => $validated['pic'],
    //             'day' => $validated['day'],
    //             'start_date' => $validated['start_date'],
    //             'end_date' => $validated['end_date'],
    //             'start_time' => $validated['start_time'],
                
    //             'end_time' => $validated['end_time'],
    //             'fee' => $validated['fee'],
    //             'vendor_id' => $vendor_id,
    //             'status' => 'Aktif'
    //         ]);
    //     }

    //     if (count($vendor) > 0) {
    //         session()->flash('success', 'Berhasil mengaktifkan ekskul');
    //     } else {
    //         session()->flash('error', 'Gagal mengaktifkan ekskul, tidak ada vendor yang valid.');
    //     }
    //     return redirect()->route('daftarekskulaktif');
    // }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'extracurricular_id' => 'required|integer',
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'pic' => 'required|string',
            'day' => 'required|string',
            'vendor_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'fee' => 'required|numeric',
        ]);
        $validated['status'] = 'Aktif';
        $create = ExcurVendor::create($validated);

        if ($create) {
            session()->flash('success', 'Berhasil mengaktifkan ekskul');
        } else {
            session()->flash('error', 'Gagal mengaktifkan ekskul, tidak ada vendor yang valid.');
        }
        return redirect()->route('daftarekskulaktif');
    }
}
