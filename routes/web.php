<?php

use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VendorController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/login', function () {
    $type = request('type', 'vendor'); // Default to 'Vendor' if no type is provided
    return view('login', compact('type'));
});

Route::prefix('school')->group(function () {
    Route::get('/daftarekskul', [SchoolController::class, 'showDaftarEkskul']);
    Route::get('/dashboard', [SchoolController::class, 'index'])->name('dashboardSchool');
    Route::get('/logoutSekolah', [SchoolController::class, 'logout'])->name('logout');
    Route::get('/daftarekskul', action: [SchoolController::class, 'showDaftarEkskul']);
    Route::get('/daftarsiswa', action: [SchoolController::class, 'showDaftarMurid']);
    Route::get('/absensisiswa', [SchoolController::class, 'showMeeting']);

});

Route::prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboardStudent');
    Route::get('/logoutMurid', [StudentController::class, 'logout'])->name('logout');
    Route::get('/meeting', [StudentController::class, 'showMeeting']);
    Route::get('/payment', [StudentController::class, 'showPayment']);
    Route::get('/pendaftaran', [StudentController::class, 'showPendaftaran']);
    Route::get('/bayar', [StudentController::class, 'showBayar']);

});
Route::post('/login/{type}', [LoginController::class, 'processLogin']);
Route::get('/logout/{type}', [LoginController::class, 'logout']);


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




// Route::get('/detail/absensi/{id}', [SchoolController::class, 'showAbsensi']);
// Route::get('/editprofile', function () {
//     return view('editprofile', [
//         "pageTitle" => "Edit Profile"
//     ]);
// });

// Route::get('/bayar', [StudentController::class, 'showBayar']);