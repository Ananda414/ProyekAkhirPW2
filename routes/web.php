<?php

use App\Http\Controllers\KomputerController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexKomputerController;
use App\Http\Controllers\IndexSimplisaController;
use App\Http\Controllers\IndexResepController;
use App\Http\Controllers\IndexKimiaController;
use App\Http\Controllers\SimplisaController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\KimiaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::group(['middleware' => 'prevent-back-history'], function () {
    // Tambahkan route yang ingin dilindungi disini
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/listkomputer', [IndexKomputerController::class, 'index'])->name('listkomputer');
    Route::get('/komputer/download-pdf', [IndexKomputerController::class, 'downloadPDF'])->name('komputer.downloadPDF');
    Route::get('/listkimia', [IndexKimiaController::class, 'index'])->name('listkimia');
    Route::get('/kimia/download-pdf', [IndexKimiaController::class, 'downloadPDF'])->name('kimia.downloadPDF');
    Route::get('/listresep', [IndexResepController::class, 'index'])->name('listresep');
    Route::get('/resep/download-pdf', [IndexResepController::class, 'downloadPDF'])->name('resep.downloadPDF');
    Route::get('/listsimplisa', [IndexSimplisaController::class, 'index'])->name('listsimplisa');
    Route::get('/simplisa/download-pdf', [IndexSimplisaController::class, 'downloadPDF'])->name('simplisa.downloadPDF');
    // Route lain yang dilindungi
});

Route::get('listkomputer', [IndexKomputerController::class, 'index'])->name('listkomputer');
Route::get('komputer/download-pdf', [IndexKomputerController::class, 'downloadPDF'])->name('komputer.downloadPDF');
Route::get('listkimia', [IndexKimiaController::class, 'index'])->name('listkimia');
Route::get('kimia/download-pdf', [IndexKimiaController::class, 'downloadPDF'])->name('kimia.downloadPDF');
Route::get('listresep', [IndexResepController::class, 'index'])->name('listresep');
Route::get('resep/download-pdf', [IndexResepController::class, 'downloadPDF'])->name('resep.downloadPDF');
Route::get('listsimplisa', [IndexSimplisaController::class, 'index'])->name('listsimplisa');
Route::get('simplisa/download-pdf', [IndexSimplisaController::class, 'downloadPDF'])->name('simplisa.downloadPDF');

Route::get('/komputer/{komputer}', [KomputerController::class, 'edit']);
Route::get('/komputer/{komputer}/edit', [KomputerController::class, 'edit']);
Route::put('/komputer/{komputer}', [KomputerController::class, 'update']);
Route::delete('/komputer/{komputer}', [KomputerController::class, 'destroy']);
Route::delete('/listkomputer/{listkomputer}', [IndexKomputerController::class, 'destroy']);

Route::get('/kimia/{kimia}', [KimiaController::class, 'show']);
Route::get('/kimia/{kimia}/edit', [KimiaController::class, 'edit']);
Route::put('/kimia/{kimia}', [KimiaController::class, 'update']);
Route::delete('/kimia/{kimia}', [KimiaController::class, 'destroy']);

Route::get('/listkimia/{listkimia}', [KimiaController::class, 'show']);
Route::get('/listkimia/{listkimia}/edit', [KimiaController::class, 'edit']);
Route::put('/listkimia/{listkimia}', [KimiaController::class, 'update']);
Route::delete('/listkimia/{listkimia}', [IndexKimiaController::class, 'destroy']);

Route::get('/resep/{resep}', [ResepController::class, 'show']);
Route::get('/resep/{resep}/edit', [ResepController::class, 'edit']);
Route::put('/resep/{resep}', [ResepController::class, 'update']);
Route::delete('/resep/{resep}', [ResepController::class, 'destroy']);

Route::get('/listresep/{listresep}', [ResepController::class, 'show']);
Route::get('/listresep/{listresep}/edit', [ResepController::class, 'edit']);
Route::put('/listresep/{listresep}', [ResepController::class, 'update']);
Route::delete('/listresep/{listresep}', [ResepController::class, 'destroy']);

Route::get('/simplisa/{simplisa}', [SimplisaController::class, 'show']);
Route::get('/simplisa/{simplisa}/edit', [SimplisaController::class, 'edit']);
Route::put('/simplisa/{simplisa}', [SimplisaController::class, 'update']);
Route::delete('/simplisa/{simplisa}', [SimplisaController::class, 'destroy']);

Route::get('/listsimplisa/{listsimplisa}', [SimplisaController::class, 'show']);
Route::get('/listsimplisa/{listsimplisa}/edit', [SimplisaController::class, 'edit']);
Route::put('/listsimplisa/{listsimplisa}', [SimplisaController::class, 'update']);
Route::delete('/listsimplisa/{listsimplisa}', [SimplisaController::class, 'destroy']);

Route::resource('komputer', KomputerController::class);
Route::resource('kimia', KimiaController::class);
Route::resource('resep', ResepController::class);
Route::resource('simplisa', SimplisaController::class);
Route::resource('listkomputer', IndexKomputerController::class);
Route::resource('listkimia', IndexKimiaController::class);
Route::resource('listresep', IndexResepController::class);
Route::resource('listsimplisa', IndexSimplisaController::class);

require __DIR__.'/auth.php';
