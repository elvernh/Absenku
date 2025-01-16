<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    //
    protected $fillable = [
        'excur_vendor_id',
        'meeting_date',
        'topic',
        'teacher',
        'status',
    ];
    
    public static function getAllByExcurVendorId($excurVendorId)
    {
        $meetings = Meeting::where('excur_vendor_id', $excurVendorId) // Filter berdasarkan parameter
            ->paginate(15); // Paginasi dengan 15 item per halaman
        return $meetings;
    }
    use HasFactory;
    // Relationship with Presence model


    public static function getMeetingToday() {
        $today = Carbon::today()->toDateString();
        $meetings = Meeting::where('meeting_date', $today)->get();
        return $meetings;
    }
    public static function getMeetingTodayVendor($vendorId) {
        $today = Carbon::today()->toDateString();
    
        // Query meeting berdasarkan tanggal hari ini dan vendor
        $meetings = Meeting::where('meeting_date', $today)
            ->whereHas('excurVendor', function($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->get();
    
        return $meetings;
    }
    
    public static function getMeetingVendor($vendorId) {
        // Query semua meeting yang terkait dengan vendor tertentu
        $meetings = Meeting::whereHas('excurVendor', function ($query) use ($vendorId) {
                $query->where('vendor_id', $vendorId);
            })
            ->get();
    
        return $meetings;
    }
    

    public function presences(): HasMany
    {
        return $this->hasMany(Presence::class, 'meeting_id');
    }


    public function excurVendor(): BelongsTo
    {
        return $this->belongsTo(ExcurVendor::class, 'excur_vendor_id',);
    }
}
