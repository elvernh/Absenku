<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    //
    public function store(Request $request)
    {
        // Ambil data yang diperlukan dari request
        $data = $request->only(['status_id', 'keterangan', 'meeting_id', 'student_excur_vendor_id', 'excur_vendor_id']);
        
        //cek apakah sudah terbuat
        $presence = Presence::where('student_excur_vendor_id', $data['student_excur_vendor_id'])
            ->where('meeting_id', $data['meeting_id'])
            ->first();
            
        if ($presence) {
            return redirect()->back()->with('error', 'Anda sudah absen pada pertemuan ini.');
        }

        // Buat entry baru ke database
        $create = Presence::create($data);
    
        // Anda bisa menambahkan respon atau redirect setelah data berhasil disimpan
        if ($create) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan absen.');
        }
    }
    
}
