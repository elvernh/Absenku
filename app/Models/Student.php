<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use Str;

class Student extends Authenticatable
{
    //
    use HasFactory, Notifiable;
    protected $fillable = ['full_name', 'grade', 'email', 'password'];

    // Kolom yang harus disembunyikan (untuk keamanan)
    protected $hidden = ['password', 'token'];

    

    public static function getSma()
    {
        $smas = Student::where('educational_level', 'SMA')->get();
        return $smas;
    }

    public static function getUser($id)
    {
        $student = Student::find($id);
        return $student;
    }

    public static function getSmp()
    {
        $smps = Student::where('educational_level', 'SMP')->get();
        return $smps;
    }
    public function studentExcurVendors(): HasMany
    {
        return $this->hasMany(StudentExcurVendor::class, 'student_id');
    }
}
