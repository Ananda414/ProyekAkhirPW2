<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('listanggota', [IndexAnggotaController::class, 'index'])->name('listanggota');
Route::get('listim', [IndexTimController::class, 'index'])->name('listim');
Route::get('listproyek', [IndexProyekController::class, 'index'])->name('listproyek');
Route::get('/anggota/{anggota}', [AnggotaController::class, 'edit']);
Route::get('/anggota/{anggota}/edit', [AnggotaController::class, 'edit']);
Route::put('/anggota/{anggota}', [AnggotaController::class, 'update']);
Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy']);
Route::delete('/listanggota/{listanggota}', [IndexAnggotaController::class, 'destroy']);

Route::resource('anggota', AnggotaController::class);
Route::resource('tim', TImController::class);
Route::resource('proyek', ProyekController::class);
Route::resource('listanggota', IndexAnggotaController::class);
Route::resource('listim', IndexTimController::class);
Route::resource('listproyek', IndexProyekController::class);

require __DIR__.'/auth.php';
