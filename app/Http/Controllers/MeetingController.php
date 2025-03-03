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

        $id = $request->route('id'); // Mengambil parameter 'id' dari URL
        $meeting = Meeting::find($id);

        // Cek apakah meeting dengan ID tersebut ditemukan
        if (!$meeting) {
            return redirect()->back()->with('error', 'Meeting not found.');
        }

        $studentExcurVendors = StudentExcurVendor::where('excur_vendor_id', $meeting->excur_vendor_id)
            ->whereDoesntHave('presences', function ($query) use ($meeting) {
                $query->where('meeting_id', $meeting->id);
            })
            ->where('status', 'approved')
            ->get();

        // Jika tidak ada siswa yang belum absen buat absen tidak hadir
        foreach ($studentExcurVendors as $studentExcurVendor) {
            Presence::create([
                'status_id' => 4,
                'keterangan' => 'Tidak Hadir',
                'meeting_id' => $meeting->id,
                'student_excur_vendor_id' => $studentExcurVendor->id,
                'excur_vendor_id' => $meeting->excur_vendor_id,
            ]);
        }

        // Update data meeting
        $meeting->topic = $request['topic'];
        $meeting->teacher = $request['teacher'];
        $meeting->status = $request['status'];

        session()->forget(['teacher', 'topic']);

        // Simpan perubahan
        if ($meeting->save()) {
            return redirect()->back()->with('success', 'Meeting updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update meeting.');
        }
    }


}
