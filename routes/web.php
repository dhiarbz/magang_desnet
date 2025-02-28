<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PengunjungController;

Route::get('/', function () {
    return view('index');
});
// Route untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//route untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
});

// Route untuk karyawan
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan/index', [KaryawanController::class, 'index'])->name('karyawan.index');
});

Route::post('/', [PengunjungController::class, 'showForm'])->name('index');
Route::post('/submit', [PengunjungController::class, 'submitForm'])->name('submit');