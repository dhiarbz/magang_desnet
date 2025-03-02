<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PengunjungController;

// Route::get('/', function () {
//     return view('index');
// });
// Route untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//route untuk admin
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'showAfterLogin'])->name('admin.index');
    Route::get('/admin/view_karyawan', [AdminController::class, 'view_karyawan'])->name('admin.view_karyawan');
    Route::get('/admin/view_pengunjung', [AdminController::class, 'view_pengunjung'])->name('admin.view_pengunjung');
    Route::get('/admin/log_pengunjung', [AdminController::class, 'log_pengunjung'])->name('admin.log_pengunjung');
    Route::get('/admin/add_karyawan', [AdminController::class, 'add_karyawan'])->name('admin.add_karyawan');
    Route::get('/admin/update_karyawan', [AdminController::class, 'update_karyawan'])->name('admin.update_karyawan');
    Route::get('/admin/delete_karyawan', [AdminController::class, 'delete_karyawan'])->name('admin.delete_karyawan');
    Route::get('/admin/export_pdf', [AdminController::class, 'exportPdf'])->name('admin.export_pdf');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Route untuk karyawan
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan/index', [KaryawanController::class, 'showAfterLogin'])->name('karyawan.index');
});
Route::get('/', [PengunjungController::class, 'showForm'])->name('index');
Route::post('/submit', [PengunjungController::class, 'submitForm'])->name('submit');