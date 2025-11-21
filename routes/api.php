<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\JadwalController;


    Route::post('/register', [PegawaiController::class, 'register']);
    Route::post('/login', [PegawaiController::class, 'login']);
    Route::get('/schedule/pegawai/{id}', [PegawaiController::class, 'byPegawai']);
    Route::get('/schedule/pegawai/{id}/bulan', [PegawaiController::class, 'byPegawaiMonth']);
    Route::post('/schedule/update-verifikasi', [PegawaiController::class, 'updateVerifikasiPegawai']);
    Route::get('/daftar_schedule/{id}', [PegawaiController::class, 'daftar_schedule']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [PegawaiController::class, 'logout']);
    Route::get('/me', [PegawaiController::class, 'me']);

    // CRUD Pegawai (hanya untuk user login)
    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show']);
    Route::post('/pegawai', [PegawaiController::class, 'store']);
    Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update']);
    Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy']);

});

Route::get('/test', function () {
    return response()->json(['message' => 'API route working!']);
});


Route::post('/jadwal/save', [JadwalController::class, 'save']);