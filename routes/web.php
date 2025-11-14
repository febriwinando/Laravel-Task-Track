<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LokasiController;







// Tampilkan form login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/', [LoginController::class, 'login'])->name('login');

// Route::get('/kegiatan', [KegiatanController::class, 'kegiatan'])->name('kegiatan');
// Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

//Pegawai
Route::resource('pegawai', PegawaiController::class);

//Lokasi
Route::resource('lokasi', LokasiController::class);

//Kegiatan
Route::resource('kegiatan', KegiatanController::class);


// Jadwal
Route::get('/jadwal/kegiatan/{tanggal}', [JadwalController::class, 'getKegiatan']);
// Route::post('/jadwal/kegiatan', [JadwalController::class, 'storeKegiatan']);

Route::get('/jadwal/events/{pegawai_id}', [JadwalController::class, 'getEvents']);
Route::get('/jadwal/kegiatan/{tanggal}/{pegawai_id}', [JadwalController::class, 'getKegiatanByDate']);
Route::post('/jadwal/kegiatan', [JadwalController::class, 'saveSchedule']);

Route::get('/jadwal/day', [JadwalController::class, 'getDayActivities']);


Route::resource('jadwal', JadwalController::class);





