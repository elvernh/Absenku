<?php

use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VendorController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("/");

// Route::get('/login', function () {
//     $type = request('type', 'Vendor'); // Default to 'Vendor' if no type is provided
//     return view('login', compact('type'));
// });
Route::resource("/student", StudentController::class);
Route::resource("/vendor", VendorController::class);
Route::resource("/school", SchoolController::class);

Route::post('/loginSekolah', [SchoolController::class, 'processLogin']);
Route::post("/loginMurid", [StudentController::class, 'processLogin']);
Route::post("/loginVendor", [VendorController::class, 'processLogin']);

// Route::get('/dashboard', [SchoolController::class, 'showDashboard'])->name('dashboard');
// Route::get('/logoutSekolah', [SchoolController::class, 'logout'])->name('logout');
// Route::get('/daftarekskul', action: [SchoolController::class, 'showDaftarEkskul']);
// Route::get('/daftarsiswa', action: [SchoolController::class, 'showDaftarMurid']);

// Route::get("/dashboardStudent", [StudentController::class, 'showDashboard'])->name('dashboardStudent');
// Route::get("/meetingStudent", [StudentController::class, 'showMeeting']);
// Route::get("/payment", [StudentController::class, 'showPayment']);

// Route::get('/logoutMurid', [StudentController::class, 'logout'])->name('logoutMurid');

// Route::post("/loginVendor", [VendorController::class, 'processLogin']);
// Route::get("/dashboardVendor", [VendorController::class, 'showDashboard'])->name('dashboardVendor');
// Route::get('/logoutVendor', [VendorController::class, 'logout'])->name('logoutVendor');

Route::get('/pendaftaran', [StudentController::class, 'showPendaftaran']);
Route::get(
    '/tambahekskul',
    [SchoolController::class, 'addExcur']
);




// Route::get('/absensisiswa', [SchoolController::class, 'showMeeting']);
// Route::get('/detail/absensi/{id}', [SchoolController::class, 'showAbsensi']);
// Route::get('/editprofile', function () {
//     return view('editprofile', [
//         "pageTitle" => "Edit Profile"
//     ]);
// });

// Route::get('/bayar', [StudentController::class, 'showBayar']);