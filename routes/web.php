<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\IndexAnggotaController;
use App\Http\Controllers\IndexProyekController;
use App\Http\Controllers\IndexTimController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\TImController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('listanggota', [IndexAnggotaController::class, 'index'])->name('listanggota');
Route::get('listim', [IndexTimController::class, 'index'])->name('listim');

Route::resource('anggota', AnggotaController::class);
Route::resource('tim', TImController::class);
Route::resource('proyek', ProyekController::class);
Route::resource('listanggota', IndexAnggotaController::class);
Route::resource('listim', IndexTimController::class);
Route::resource('listproyek', IndexProyekController::class);