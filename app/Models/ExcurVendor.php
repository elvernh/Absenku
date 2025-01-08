<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExcurVendor extends Model
{
    //
    use HasFactory;
    public static function formatRupiah($number) {
        return "Rp " . number_format($number, 0, ',', '.');
    }
    
    public static function getAllTodayByVendor($vendorId) {
        return ExcurVendor::with(['extracurricular', 'vendor'])
                          ->where('day', Carbon::now()->format('l')) // Filter by the current day of the week
                          ->where('vendor_id', $vendorId)  // Filter by the specific vendor ID
                          ->get();
    }

    public static function getAllToday() {
        return ExcurVendor::with(['extracurricular', 'vendor'])
                          ->where('day', Carbon::now()->format('l'))  // Ensure it filters by the day of the week
                          ->get();
    }

    public static function getJumlahEkskul($vendorId){
        return ExcurVendor::where('vendor_id', $vendorId)->count();
    }

    public function meetings(): HasMany
    {
        return $this->HasMany(Meeting::class, 'excur_vendor_id'); 
    }

    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
    public function extracurricular():BelongsTo
    {
        return $this->belongsTo(Extracurricular::class);
    }

    public static function getAll() {
        $excurvendors = ExcurVendor::all();
        return $excurvendors;
    }

    public function studentExcurVendors():HasMany
    {
        return $this->hasMany(StudentExcurVendor::class, 'excur_vendor_id');
    }
}
