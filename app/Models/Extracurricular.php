<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Extracurricular extends Model
{
    //
    use HasFactory;

    public static function getAll()
    {
        $extracurriculars = Extracurricular::all();
        return $extracurriculars;
    }
    public function excurVendors(): HasMany
    {
        return $this->hasMany(ExcurVendor::class, 'extracurricular_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'StudentExcurVendor', 'extracurricular_id', 'student_id')
            ->withPivot('vendor_id'); // Include vendor info if needed
    }
}
