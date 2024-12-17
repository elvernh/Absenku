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
        return $this->belongsTo(Status::class);
    }
}
