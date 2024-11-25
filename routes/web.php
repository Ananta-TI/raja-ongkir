<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesanSaranController;

Route::resource('pesan_saran', PesanSaranController::class)->only(['index', 'store']);

 Route::get('/', function () {
    return view('welcome');
 });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('role:admin,super_admin');;
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('role:admin,super_admin');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('role:admin,super_admin');
});

Route::resource('pesan_saran', PesanSaranController::class)->middleware('role:admin,super_admin');
Route::resource('berita',BeritaController::class)->middleware(['role:admin']);
Route::resource('blog',BlogController::class);
Route::get('test', [HomeController::class, 'index'])->name('home');
Route::get('tes', [HomeController::class, 'tes'])->name('tes');
Route::resource('beri', BeritaController::class);

Route::get('/rajaongkir', function () {
    return view('raja-ongkir');
});


require __DIR__.'/auth.php';
