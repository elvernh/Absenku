<?php

use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VendorController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("/");

Route::get('/login', function () {
    $type = request('type', 'Vendor'); // Default to 'Vendor' if no type is provided
    return view('login', compact('type'));
});

Route::post('/loginSekolah', [SchoolController::class, 'processLogin']);
Route::get('/dashboard', [SchoolController::class, 'showDashboard'])->name('dashboard');
Route::get('/logoutSekolah', [SchoolController::class, 'logout'])->name('logout');
Route::get('/daftarekskul', action: [SchoolController::class, 'showDaftarEkskul']);
Route::get('/daftarsiswa', action: [SchoolController::class, 'showDaftarMurid']);

Route::post("/loginMurid",[StudentController::class, 'processLogin']);
Route::get("/dashboardStudent", [StudentController::class, 'showDashboard'])->name('dashboardStudent');
Route::get('/logoutMurid', [StudentController::class, 'logout'])->name('logoutMurid');

Route::post("/loginVendor", [VendorController::class, 'processLogin']);
Route::get("/dashboardVendor", [VendorController::class, 'showDashboard'])->name('dashboardVendor');
Route::get('/logoutVendor', [VendorController::class, 'logout'])->name('logoutVendor');

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
});





Route::get('/absensisiswa', function () {
    return view('absensisiswa', [
        "pageTitle" => "Absensi Siswa"
    ]);
});

Route::get('/editprofile', function () {
    return view('editprofile', [
        "pageTitle" => "Edit Profile"
    ]);
});