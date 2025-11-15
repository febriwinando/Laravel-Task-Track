<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UserController;


//User
Route::resource('users', UserController::class);

// Tampilkan form login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/', [LoginController::class, 'login'])->name('login');

//Pegawai
Route::resource('pegawai', PegawaiController::class);

//Lokasi
Route::resource('lokasi', LokasiController::class);

//Kegiatan
Route::resource('kegiatan', KegiatanController::class);

// Jadwal
Route::get('/jadwal/modal-data/{tanggal}/{pegawai_id}', [JadwalController::class, 'modalData']);
// Menyimpan schedule (bukan kegiatan-list)
Route::post('/jadwal/save', [JadwalController::class, 'save']);
Route::delete('/jadwal/delete/{id}', [JadwalController::class, 'delete']);

Route::resource('jadwal', JadwalController::class);

// Route::get('/jadwal/kegiatan/{tanggal}', [JadwalController::class, 'getKegiatan']);
// Route::post('/jadwal/kegiatan', [JadwalController::class, 'storeKegiatan']);
// Route::get('/jadwal/events/{pegawai_id}', [JadwalController::class, 'getEvents']);
// Route::get('/jadwal/kegiatan/{tanggal}/{pegawai_id}', [JadwalController::class, 'getKegiatanByDate']);
// Route::post('/jadwal/kegiatan', [JadwalController::class, 'saveSchedule']);
// Route::delete('/jadwal/delete/{id}',[JadwalController::class, 'delete']);
// Route::get('/jadwal/day', [JadwalController::class, 'getDayActivities']);
// Route::resource('jadwal', JadwalController::class);





