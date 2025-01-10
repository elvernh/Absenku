<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    //
    use HasFactory;
    protected $fillable = ['amount', 'payment_date', 'transfer_url', 'student_excur_vendor_id', 'status_payment'];


    public function studentExcurVendors():BelongsTo {
        return $this->belongsTo(StudentExcurVendor::class, 'student_excur_vendor_id');
    }
}
