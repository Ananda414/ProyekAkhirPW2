<?php

use App\Http\Controllers\API\AnggotaController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProyekController;
use App\Http\Controllers\API\TimController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/anggota', [AnggotaController::class, 'index']);
Route::middleware('auth:sanctum')->post('/anggota/store', [AnggotaController::class, 'store']);
Route::middleware('auth:sanctum')->put('/anggota/update/{id}', [AnggotaController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/anggota/delete/{id}', [AnggotaController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/tim', [TimController::class, 'index']);
Route::middleware('auth:sanctum')->post('/tim/store', [TimController::class, 'store']);
Route::middleware('auth:sanctum')->put('/tim/update/{id}', [TimController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/tim/delete/{id}', [TimController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/proyek', [ProyekController::class, 'index']);
Route::middleware('auth:sanctum')->post('/proyek/store', [ProyekController::class, 'store']);
Route::middleware('auth:sanctum')->put('/proyek/update/{id}', [ProyekController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/proyek/delete/{id}', [ProyekController::class, 'delete']);