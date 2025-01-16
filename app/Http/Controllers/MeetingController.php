<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MeetingController extends Controller
{
    public function createMeeting(Request $request){
       
        $validated = $request->validate([
            'excur_vendor_id' => 'required|integer',
            'meeting_date' => 'required|date',
            'topic' => 'required|string',
        ]);
        
        $validated['teacher'] = null;
        $validated['status'] = "ongoing";

        $meeting = Meeting::create($validated);
        if($meeting) {
            session()->flash('success', 'Berhasil menambahkan meeting');
            return redirect()->route('dashboardSchool');
        }else {
            session()->flash('error', 'Gagal menambahkan meeting');
            return redirect()->back();
        }
        
    }

    public function updateMeeting(Request $request)
{
    // Validasi input
    

    // Ambil ID dari parameter request
    $id = $request->route('id'); // Mengambil parameter 'id' dari URL
    $meeting = Meeting::find($id);

    // Cek apakah meeting dengan ID tersebut ditemukan
    if (!$meeting) {
        return redirect()->back()->with('error', 'Meeting not found.');
    }

    // Update data meeting
    $meeting->topic = $request['topic'];
    $meeting->teacher= $request['teacher']; 
    $meeting->status = $request['status'];

    // Simpan perubahan
    if ($meeting->save()) {
        return redirect()->back()->with('success', 'Meeting updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update meeting.');
    }
}

    
}
