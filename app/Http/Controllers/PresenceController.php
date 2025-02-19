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
        
        // Buat entry baru ke database
        $create = Presence::create($data);
    
        // Anda bisa menambahkan respon atau redirect setelah data berhasil disimpan
        if ($create) {
            return redirect()->back()->with('success', 'Absen berhasil disimpan!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan absen.');
        }
    }
    
}
