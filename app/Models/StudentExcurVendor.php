<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentExcurVendor extends Model
{
    //or
    use HasFactory;
    protected $fillable = ['student_id', 'excur_vendor_id', 'status', 'score_mid', 'score_final', 'url_certificate', 'note'];
    public static function getStudentExcur($id) {
        $student = StudentExcurVendor::find($id);
        return $student;
    }


    public static function getSumExcur($id) {
        $count = StudentExcurVendor::where('student_id', $id)->sum('bill');
        return $count;
    }
    public static function getMidScoreAvg($id) {
        $count = StudentExcurVendor::where('student_id', $id)->avg('score_mid');
        return $count;
    }
    public static function getFinalScoreAvg($id) {
        $count = StudentExcurVendor::where('student_id', $id)->avg('score_final');
        return $count;
    }

    public static function listPending() {
        $student = StudentExcurVendor::where('status', "pending")->paginate(10, ['*'], 'pagePendings');;
        return $student;
    }

    public static function getHistory() {
        $student = StudentExcurVendor::whereIn('status', ['approved', 'denied'])->paginate(15, ['*'], 'pageHistorys');;
        return $student;
    }


        public function payment(): HasMany
    {
        return $this->hasMany(Payment::class, 'student_excur_vendor_id'); 
    }

    public function student():BelongsTo {
        return $this->belongsTo(Student::class);
    }

    public function excurVendor(): BelongsTo
    {
        return $this->belongsTo(ExcurVendor::class, 'excur_vendor_id');

    }

    public function presences():HasMany
    {
        return $this->hasMany(Presence::class, 'student_excur_vendor_id');
    }

    public function payments():HasMany
    {
        return $this->hasMany(Payment::class, 'student_excur_vendor_id');
    }

    public static function getAllByVendorId($vendorId)
    {
        return self::with(['extracurricular', 'excurVendor'])
                    ->whereHas('excurVendor', function ($query) use ($vendorId) {
                        $query->where('vendor_id', $vendorId);  // Filter ExcurVendor by vendor_id
                    })
                    ->get();  // Get all records for the specific vendor
    }


    // Define the relationship to Extracurricular
    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class, 'extracurricular_id');
    }

}
