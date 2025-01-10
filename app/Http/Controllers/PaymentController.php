<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StudentExcurVendor;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public static function rupiahFormat($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function createPayment(Request $request)
    {
        $validated = $request->validate([
            'transfer_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'student_excur_vendor_id' => 'required|numeric'
        ]);

        $filePath = $request->file('transfer_url')->store('bukti');
        $validated['transfer_url'] = $filePath;
        $validated['status_payment'] = 'berhasil'; // Tambahkan nilai default untuk status_payment
        $find = StudentExcurVendor::find($validated['student_excur_vendor_id']);
        if($find->bill <= 0){
            session()->flash('error', 'Tagihan sudah lunas');
            return redirect()->route('payment');
        }
        $payment = Payment::create($validated);

        if ($payment) {
            StudentExcurVendor::where('id', $validated['student_excur_vendor_id'])->update(['bill' => $find->bill - $validated['amount']]);
            session()->flash('success', 'PembayaranBerhasil');
            return redirect()->route('payment');
        }else {
            session()->flash('error', 'Pembayaran Gagal');
            return redirect()->route('payment');
        }

    }
}
