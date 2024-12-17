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

    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class, 'student_excur_vendor_id'); 
    }
}
