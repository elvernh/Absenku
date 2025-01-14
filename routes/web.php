<?php

use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentExcurVendorController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/login', function () {
    $type = request('type', 'vendor'); // Default to 'Vendor' if no type is provided
    return view('login', compact('type'));
});

Route::prefix('school')->group(function () {
    Route::get('/dashboard', [SchoolController::class, 'index'])->name('dashboardSchool');
    Route::get('/logoutSekolah', [SchoolController::class, 'logout'])->name('logout');
    Route::get('/daftarekskulaktif', action: [SchoolController::class, 'showDaftarEkskulAktif']);
    Route::get('/daftarekskul', action: [SchoolController::class, 'showDaftarEkskul'])->name("daftarekskul");
    Route::get('/daftarsiswa', action: [SchoolController::class, 'showDaftarMurid']);
    Route::get('/absensisiswa/{excurVendorId}', [SchoolController::class, 'showMeeting']);
    Route::get('/addvendor', [SchoolController::class, 'showAddVendor']);
    Route::post('/addvendorsubmit', [SchoolController::class, 'addVendor'])->name('add');
    Route::get('/detail/absensi/{id}', [SchoolController::class, 'showAbsensi']);
    Route::get(
        '/tambahekskul',
        [SchoolController::class, 'addExcur']
    );
    Route::post(
        '/tambahekskulsubmit',
        [ExtracurricularController::class, 'createEkskul']
    )->name(
            'tambahekskul'
        );
        Route::get("/pendaftaran", [SchoolController::class, 'showPendaftaran'])->name("pendaftaran");
        Route::get('/reject/{id}', [StudentExcurVendorController::class, 'reject'])->name(
            'reject'
        );
});

Route::prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboardStudent');
    Route::get('/logoutMurid', [StudentController::class, 'logout'])->name('logout');
    Route::get('/meeting', [StudentController::class, 'showMeeting']);
    Route::get('/payment', [StudentController::class, 'showPayment'])->name('payment');
    Route::get('/pendaftaran', [StudentController::class, 'showPendaftaran']);
    Route::post('/pendaftaranSubmit', [StudentController::class, 'registerExcur'])->name('pendaftaran');
    Route::get('/bayar', [StudentController::class, 'showBayar']);
    Route::post('/bayarsubmit', [PaymentController::class, 'createPayment'])->name('bayar');

});

Route::prefix('vendor')->group(function () {
    Route::get("/dashboard", [VendorController::class, 'showDashboard'])->name('dashboardVendor');

    Route::get('/daftarpertemuan', [VendorController::class, 'daftarPertemuan']);
    Route::get('/daftarpertemuan/{id}', [VendorController::class, 'detilPertemuan'])->name('detilPertemuan');
    Route::get('/daftarsiswa', [VendorController::class, 'daftarSiswa']);
});

Route::post('/login/{type}', [LoginController::class, 'processLogin']);
Route::get('/logout/{type}', [LoginController::class, 'logout']);
Route::delete('/extracurricular/{extracurricular}', [ExtracurricularController::class, 'destroy'])->name('deleteExtracurricular');

// Route::get("/dashboardStudent", [StudentController::class, 'showDashboard'])->name('dashboardStudent');
// Route::get("/meetingStudent", [StudentController::class, 'showMeeting']);
// Route::get("/payment", [StudentController::class, 'showPayment']);

// Route::get('/logoutMurid', [StudentController::class, 'logout'])->name('logoutMurid');

// Route::post("/loginVendor", [VendorController::class, 'processLogin']);
// Route::get('/logoutVendor', [VendorController::class, 'logout'])->name('logoutVendor');


Route::get('/pendaftaran', [StudentController::class, 'showPendaftaran']);
Route::get(
    '/tambahekskul',
    [SchoolController::class, 'addExcur']
);




// Route::get('/editprofile', function () {
//     return view('editprofile', [
//         "pageTitle" => "Edit Profile"
//     ]);
// });

// Route::get('/bayar', [StudentController::class, 'showBayar']);