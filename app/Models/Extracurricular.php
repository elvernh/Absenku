<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Extracurricular extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'division',
        'level',
        'school_id'
    ];

    public static function getAll($sortDirection = 'asc') {
        $extracurriculars = Extracurricular::all()->sortBy(function ($extracurricular) {
            // Define the order for the divisions
            $order = [
                'SMP' => 1,
                'SMA' => 2,
            ];
    
            // Return the order value, default to a high number if division is unknown
            return $order[$extracurricular->division] ?? 999;
        });
    
        // Apply descending order if needed
        if ($sortDirection === 'desc') {
            $extracurriculars = $extracurriculars->reverse();
        }
    
        return $extracurriculars;
    }
    
    public function excurVendors():HasMany  
    {
        return $this->hasMany(ExcurVendor::class, 'extracurricular_id');
    }
}
