<?php

use App\Http\Controllers\API\KomputerController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ResepController;
use App\Http\Controllers\API\KimiaController;
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

Route::middleware('auth:sanctum')->get('/komputer', [KomputerController::class, 'index']);
Route::middleware('auth:sanctum')->post('/komputer/store', [KomputerController::class, 'store']);
Route::middleware('auth:sanctum')->put('/komputer/update/{id}', [KomputerController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/komputer/delete/{id}', [KomputerController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/kimia', [KimiaController::class, 'index']);
Route::middleware('auth:sanctum')->post('/kimia/store', [KimiaController::class, 'store']);
Route::middleware('auth:sanctum')->put('/kimia/update/{id}', [KimiaController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/kimia/delete/{id}', [KimiaController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/resep', [ResepController::class, 'index']);
Route::middleware('auth:sanctum')->post('/resep/store', [ResepController::class, 'store']);
Route::middleware('auth:sanctum')->put('/resep/update/{id}', [ResepController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/resep/delete/{id}', [ResepController::class, 'delete']);

// Route::middleware('auth:sanctum')->get('/simplisa', [ResepController::class, 'index']);
// Route::middleware('auth:sanctum')->post('/simplisa/store', [ResepController::class, 'store']);
// Route::middleware('auth:sanctum')->put('/simplisa/update/{id}', [ResepController::class, 'update']);
// Route::middleware('auth:sanctum')->delete('/simplisa/delete/{id}', [ResepController::class, 'delete']);