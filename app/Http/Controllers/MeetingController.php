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
        
        $validated['teacher'] = "";
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
}
