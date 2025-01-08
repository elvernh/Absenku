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
    public static function getStudentExcur($id) {
        $student = StudentExcurVendor::find($id);
        return $student;
    }

    public static function getSumExcur($id) {
        $count = StudentExcurVendor::where('student_id', $id)->count();
        return $count;
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

    // public function getDetailExcur($id){
    //     $extracurricular = Extracurricular::with('students')->find($id);
    //     $totalStudents = $extracurricular->students->count();
    // }

    public function payments():HasMany
    {
        return $this->hasMany(Payment::class, 'student_excur_vendor_id');
    }
}
