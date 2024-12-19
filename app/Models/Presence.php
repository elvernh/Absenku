<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presence extends Model
{
    //
    use HasFactory;
    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(related: Status::class);
    }

    public static function getPresenceBasedOnMeet($id) {
        $presences = Presence::where('meeting_id', $id)->get();
        return $presences;

    }
    
    public function studentExcurVendor():BelongsTo{
        return $this->belongsTo(related: StudentExcurVendor::class);
    }
}
