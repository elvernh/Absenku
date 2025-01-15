<?php

use App\Http\Controllers\ExcurVendorController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentExcurVendorController;

use App\Models\ExcurVendor;
use App\Models\Extracurricular;
use App\Models\Vendor;
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
    Route::get('/daftarekskulaktif', action: [SchoolController::class, 'showDaftarEkskulAktif'])->name("daftarekskulaktif");
    Route::get('/daftarekskul', action: [SchoolController::class, 'showDaftarEkskul'])->name("daftarekskul");
    Route::get('/daftarsiswa', action: [SchoolController::class, 'showDaftarMurid']);
    Route::get('/daftarvendor', action: [SchoolController::class, 'showDaftarVendor']);
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
    Route::get('/approve/{id}', [StudentExcurVendorController::class, 'approve'])->name(
        'approve'
    );
    Route::get(uri: '/create/meeting', action: function() {
        return view('pertemuanform', ["excurVendors" => ExcurVendor::all()]);
    });
    Route::get(uri: '/activate', action: function() {
        return view('activateekskul', ["Vendors" => Vendor::all(), "extras" => Extracurricular::all()]);
    });
    Route::post(uri: '/submitactivate', action: [ExcurVendorController::class, 'store'])->name("submitActivate");

    Route::post(uri: '/submitmeeting', action: [MeetingController::class, 'createMeeting'])->name("createMeeting");
});

Route::prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboardStudent');
    Route::get('/logoutMurid', [StudentController::class, 'logout'])->name('logout');
    Route::get('/meeting', action: [StudentController::class, 'showMeeting']);
    Route::get('/payment', [StudentController::class, 'showPayment'])->name('payment');
    Route::get('/pendaftaran', [StudentController::class, 'showPendaftaran']);
    // Route::post('/pendaftaranSubmit', [StudentController::class, 'registerExcur'])->name('pendaftaran');
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




Route::get('/pendaftaran', [StudentController::class, 'showPendaftaran']);
// Route::get(
//     '/tambahekskul',
//     [SchoolController::class, 'addExcur']
// );




