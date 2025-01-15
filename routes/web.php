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
use App\Models\School;
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
    // Dashboard and Logout
    Route::get('/dashboard', [SchoolController::class, 'index'])->name('dashboardSchool');
    Route::get('/logoutSekolah', [SchoolController::class, 'logout'])->name('logout');

    // Extracurricular Routes
    Route::get('/daftarekskulaktif', [SchoolController::class, 'showDaftarEkskulAktif'])->name('daftarekskulaktif');
    Route::get('/daftarekskul', [SchoolController::class, 'showDaftarEkskul'])->name('daftarekskul');
    Route::get('/tambahekskul', [SchoolController::class, 'showAddExcur']);
    Route::post('/tambahekskulsubmit', [ExtracurricularController::class, 'createEkskul'])->name('tambahekskul');
    Route::get('/editekskul/{id}', [SchoolController::class, 'updateExcur'])->name('editExcur'); // Added route name
    Route::put('/editekskul/{id}', [SchoolController::class, 'setUpdateExcur'])->name('updateExcur');

    // Student and Vendor Routes
    Route::get('/daftarsiswa', [SchoolController::class, 'showDaftarMurid']);
    Route::get('/daftarvendor', [SchoolController::class, 'showDaftarVendor']);
    Route::get('/addvendor', [SchoolController::class, 'showAddVendor']);
    Route::post('/addvendorsubmit', [SchoolController::class, 'addVendor'])->name('add');

    // Attendance Routes
    Route::get('/absensisiswa/{excurVendorId}', [SchoolController::class, 'showMeeting']);
    Route::get('/detail/absensi/{id}', [SchoolController::class, 'showAbsensi']);

    // Pendaftaran
    Route::get('/pendaftaran', [SchoolController::class, 'showPendaftaran'])->name('pendaftaran');
    Route::get('/reject/{id}', [StudentExcurVendorController::class, 'reject'])->name('reject');
    Route::get('/approve/{id}', [StudentExcurVendorController::class, 'approve'])->name('approve');

    // Meeting and Activation Routes
    Route::get('/create/meeting', function () {
        return view('pertemuanform', ['excurVendors' => ExcurVendor::all()]);
    });
    Route::post('/submitmeeting', [MeetingController::class, 'createMeeting'])->name('createMeeting');
    Route::get('/activate', function () {
        return view('activateekskul', ['Vendors' => Vendor::all(), 'extras' => Extracurricular::all(),
        'pageTitle' => 'Aktifkan Ekstrakulikuler',
        'school' => School::find(session('school_id'))]);
    });
    Route::post('/submitactivate', [ExcurVendorController::class, 'store'])->name('submitActivate');
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
