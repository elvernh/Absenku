<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\StudentExcurVendor;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MeetingController extends Controller
{
    public function createMeeting(Request $request)
    {

        $validated = $request->validate([
            'excur_vendor_id' => 'required|integer',
            'meeting_date' => 'required|date',
            'topic' => 'required|string',
        ]);

        $validated['teacher'] = "";
        $validated['status'] = "ongoing";

        $meeting = Meeting::create($validated);
        if ($meeting) {
            session()->flash('success', 'Berhasil menambahkan meeting');
            return redirect()->route('dashboardSchool');
        } else {
            session()->flash('error', 'Gagal menambahkan meeting');
            return redirect()->back();
        }

    }

    public function addMeeting(Request $request)
    {
        $id = $request->route('id');
        $validated = $request->validate([
            'teacher' => 'required|string',
            'topic' => 'required|string',
        ]);

        // Simpan data dalam session
        session([
            'teacher' => $validated['teacher'],
            'topic' => $validated['topic'],
        ]);
        return redirect()->route('makePresences', [
            'id' => $id
            
        ]);
    }


    public function updateMeeting(Request $request)
{
    $request->validate([
        'topic' => 'required|string|max:255',
        'teacher' => 'required|string|max:255',
        'status' => 'required|in:active,inactive,completed', // Sesuaikan dengan status yang valid
    ]);

    $id = $request->route('id'); 
    $meeting = Meeting::findOrFail($id); // Otomatis `abort(404)` jika tidak ditemukan

    // Ambil siswa yang belum absen
    $studentExcurVendors = StudentExcurVendor::where('excur_vendor_id', $meeting->excur_vendor_id)
        ->whereDoesntHave('presences', fn($query) => $query->where('meeting_id', $meeting->id))
        ->where('status', 'approved')
        ->get();

    // Tambahkan absen "Tidak Hadir" jika siswa belum absen
    $presences = $studentExcurVendors->map(fn($student) => [
        'status_id' => 4,
        'keterangan' => 'Tidak Hadir',
        'meeting_id' => $meeting->id,
        'student_excur_vendor_id' => $student->id,
        'excur_vendor_id' => $meeting->excur_vendor_id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    Presence::insert($presences->toArray()); // Lebih efisien daripada `foreach()`

    // Update meeting dengan cara lebih ringkas
    $meeting->update($request->only(['topic', 'teacher', 'status']));

    session()->forget(['teacher', 'topic']);
    return redirect()->route('daftarPertemuan')->with('success', 'Meeting updated successfully.');

}



}
