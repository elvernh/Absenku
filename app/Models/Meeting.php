<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    //

    public static function getAllByExcurVendorId($excurVendorId) {
        $meetings = Meeting::where('excur_vendor_id', $excurVendorId) // Filter berdasarkan parameter
                            ->paginate(15); // Paginasi dengan 15 item per halaman
        return $meetings;
    }
    use HasFactory;
    // Relationship with Presence model
    public function presences(): HasMany
    {
        return $this->hasMany(Presence::class, 'meeting_id'); 
    }


    public function excurVendor(): BelongsTo{
        return $this->belongsTo(ExcurVendor::class);
    }
}
