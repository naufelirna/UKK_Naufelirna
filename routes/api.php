<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PklController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\IndustriController;
use App\Http\Controllers\Api\APIGuruontroller; // <-- tambahkan ini juga

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('pkl', PklController::class);
Route::apiResource('siswa', SiswaController::class);
Route::apiResource('guru', GuruController::class);
Route::apiResource('industri', IndustriController::class);
Route::apiResource('guruapi', APIGuruontroller::class); // boleh asalkan controller-nya ada
