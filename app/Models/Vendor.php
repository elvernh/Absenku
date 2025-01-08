<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    //
    use Notifiable;
    public function excurVendors(): HasMany
    {
        return $this->hasMany(ExcurVendor::class, 'vendor_id');
    }

    // public function extracurriculars()
    // {
    //     return $this->belongsToMany(Extracurricular::class, 'StudentExcurVendor', 'vendor_id', 'extracurricular_id')
    //         ->withPivot('student_id');
    // }
}
