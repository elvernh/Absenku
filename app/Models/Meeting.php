<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    //
    use HasFactory;
    public function presences(): HasMany
    {
        return $this->hasMany(Meeting::class, 'excur_vendor_id'); 
    }
    public function excurVendor(): BelongsTo{
        return $this->belongsTo(ExcurVendor::class);
    }
}
