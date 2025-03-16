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
    protected $fillable = [
        'extracurricular_id',
        'vendor_id',
        'academic_year',
        'semester',
        'pic',
        'day',
        'start_time',
        'end_time',
        'fee',
        'status',
        'start_date',
        'end_date'
    ];
    public static function formatRupiah($number)
    {
        return "Rp " . number_format($number, 0, ',', '.');
    }

    public static function getAllTodayByVendor($vendorId)
    {
        return ExcurVendor::with(['extracurricular', 'vendor'])
            ->where('day', Carbon::now()->format('l')) // Filter by the current day of the week
            ->where('vendor_id', $vendorId)  // Filter by the specific vendor ID
            ->get();
    }
    public static function getAllById($vendorId)
    {
        return ExcurVendor::with(['extracurricular', 'vendor'])
            ->where('vendor_id', $vendorId)  // Filter by the specific vendor ID
            ->get();
    }

    public static function getAllToday()
    {
        return ExcurVendor::with(['extracurricular', 'vendor'])
            ->where('day', Carbon::now()->format('l'))  // Ensure it filters by the day of the week
            ->get();
    }

    public static function getJumlahEkskul($vendorId)
    {
        return ExcurVendor::where('vendor_id', $vendorId)->count();
    }

    public function meetings(): HasMany
    {
        return $this->HasMany(Meeting::class, 'excur_vendor_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function studentsCount()
    {
        return $this->hasMany(StudentExcurVendor::class, 'excur_vendor_id');
    }

    // public function getById($id){
    //     return ExcurVendor::find($id);
    // }

    public static function getAllByVendorWithStudentCount($vendorId)
    {
        return self::with(['extracurricular', 'vendor'])
            ->withCount('studentsCount') // Adds a `students_count` field
            ->where('vendor_id', $vendorId)
            ->get();
    }



    public static function getAllByVendorWithStudent($vendorId)
    {
        return self::with(['extracurricular', 'vendor'])->where('vendor_id', $vendorId)->get();
    }
    public function extracurricular(): BelongsTo
    {
        return $this->belongsTo(Extracurricular::class, 'extracurricular_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_excur_vendor', 'excur_vendor_id', 'student_id');
    }

    public static function getAll($sortDirection = 'asc')
    {
        return self::with(['extracurricular', 'vendor'])
            ->orderBy('academic_year', $sortDirection)
            ->get();
    }

    public function studentExcurVendors(): HasMany
    {
        return $this->hasMany(StudentExcurVendor::class, 'excur_vendor_id');
    }
}
