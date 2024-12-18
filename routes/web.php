<?php

use App\Http\Controllers\ExtracurricularController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    $type = request('type', 'Vendor'); // Default to 'Vendor' if no type is provided
    return view('login', compact('type'));
});

Route::get('/dashboard', function(){
    return view('dashboard',[
        "pageTitle" => "Dashboard"
    ]);
});

Route::get('/daftarekskul', [ExtracurricularController::class, 'index']);
Route::get('/detilabsensi/{id}',[ExtracurricularController::class, 'findDetilAbsensi']);

Route::get('/absensisiswa', function(){
    return view('absensisiswa',[
        "pageTitle" => "Absensi Siswa"
    ]);
});

Route::get('/editprofile', function(){
    $type = request('type', 'Vendor');
    return view('editprofile', compact('type')
    );
});

