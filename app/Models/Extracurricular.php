<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Extracurricular extends Model
{
    //
    use HasFactory;
    public function excurVendors():HasMany  
    {
        return $this->hasMany(ExcurVendor::class, 'extracurricular_id');
    }
}
