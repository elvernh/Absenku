<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Vendor extends Authenticatable
{
    //
    use Notifiable;

    public static function getAll() {
        $vendors = Vendor::all();
        return $vendors;
    }
    public function excurVendors():HasMany
    {
        return $this->hasMany(ExcurVendor::class, 'vendor_id');
    }
}
