<?php

use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/loginSekolah', [SchoolController::class, 'processLogin']);
Route::get('/dashboard', [SchoolController::class, 'showDashboard'])->name('dashboard');

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
});
Route::get('/login', function () {
    $type = request('type', 'Vendor'); // Default to 'Vendor' if no type is provided
    return view('login', compact('type'));
});



Route::get('/daftarekskul', [ExtracurricularController::class, 'index']);

Route::get('/absensisiswa', function(){
    return view('absensisiswa',[
        "pageTitle" => "Absensi Siswa"
    ]);
});

Route::get('/editprofile', function(){
    return view('editprofile',[
        "pageTitle" => "Edit Profile"
    ]);
});