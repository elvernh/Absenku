<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Student extends Authenticatable
{
    //
    Use HasFactory,Notifiable;
    protected $fillable = ['full_name','grade', 'email', 'password'];

    // Kolom yang harus disembunyikan (untuk keamanan)
    protected $hidden = ['password', 'token'];
}
