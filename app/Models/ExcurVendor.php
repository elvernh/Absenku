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

    public static function getAllToday() {
        $excurVendors = ExcurVendor::where('day', [Carbon::now()->format('l')])->get();;
        return $excurVendors;
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
    public function studentExcurVendors():HasMany
    {
        return $this->hasMany(StudentExcurVendor::class, 'excur_vendor_id');
    }
}
