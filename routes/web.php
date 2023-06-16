<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\IndexAnggotaController;
use App\Http\Controllers\IndexProyekController;
use App\Http\Controllers\IndexTimController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\TImController;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
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
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::post('anggota-multi-delete', [AnggotaController::class, 'multiDelete']) -> name('anggota-multi-delete');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('listanggota', [IndexAnggotaController::class, 'index'])->name('listanggota');
Route::get('listim', [IndexTimController::class, 'index'])->name('listim');
Route::get('listproyek', [IndexProyekController::class, 'index'])->name('listproyek');

Route::resource('anggotas', AnggotaController::class);
Route::resource('tim', TImController::class);
Route::resource('proyek', ProyekController::class);
Route::resource('listanggota', IndexAnggotaController::class);
Route::resource('listim', IndexTimController::class);
Route::resource('listproyek', IndexProyekController::class);
// Route::resource('/login', 'AuthenticatedSessionController@Create');
// Route::resource('/register', 'RegisteredUserController@Create');
// Route::resource('logout', logout::class);

// Route::get('/login', 'AuthenticatedSessionController@Create');
// Route::get('/register', 'RegisteredUserController@Create');
// Route::post('login', 'AuthenticatedSessionController@Store');
// Route::post('register', 'RegisteredUserController@Store');
// Route::get('/logout', 'AuthenticatedSessionController@Destroy');

require __DIR__.'/auth.php';
