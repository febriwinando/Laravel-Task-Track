<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UserController;




// Tampilkan form login


Route::get('/', [LoginController::class, 'showLogin'])->name('login');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/resetpassword', [LoginController::class, 'reset']);


Route::middleware('auth')->group(function () {
    //User
    Route::resource('users', UserController::class)->middleware('role:administrator,staff');
     //Pegawai
    Route::resource('pegawai', PegawaiController::class)->middleware('role:administrator,staff');

    //Lokasi
    Route::resource('lokasi', LokasiController::class)->middleware('role:administrator,staff');

    //Kegiatan
    Route::resource('kegiatan', KegiatanController::class)->middleware('role:administrator,staff');

    // Jadwal
    Route::get('/jadwal/modal-data/{tanggal}/{pegawai_id}', [JadwalController::class, 'modalData'])->middleware('role:administrator,staff');
    Route::post('/jadwal/save', [JadwalController::class, 'save'])->middleware('role:administrator,staff');
    Route::delete('/jadwal/delete/{id}', [JadwalController::class, 'delete'])->middleware('role:administrator,staff');
    Route::get('/jadwal/events/{pegawai_id}', [JadwalController::class, 'getEvents'])->middleware('role:administrator,staff');
    Route::resource('jadwal', JadwalController::class)->middleware('role:administrator,staff');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('role:administrator,staff');
});


// Route::get('/jadwal/kegiatan/{tanggal}', [JadwalController::class, 'getKegiatan']);
// Route::post('/jadwal/kegiatan', [JadwalController::class, 'storeKegiatan']);
// Route::get('/jadwal/kegiatan/{tanggal}/{pegawai_id}', [JadwalController::class, 'getKegiatanByDate']);
// Route::post('/jadwal/kegiatan', [JadwalController::class, 'saveSchedule']);
// Route::delete('/jadwal/delete/{id}',[JadwalController::class, 'delete']);
// Route::get('/jadwal/day', [JadwalController::class, 'getDayActivities']);
// Route::resource('jadwal', JadwalController::class);





