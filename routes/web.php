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
    Route::get('/admin/update_karyawan/{id}', [AdminController::class, 'update_karyawan'])->name('admin.update_karyawan');
    Route::put('/admin/fupdate_karyawan/{id}', [AdminController::class, 'fupdate_karyawan'])->name('admin.fupdate_karyawan');
    Route::get('/admin/export_pdf', [AdminController::class, 'exportPdf'])->name('admin.export_pdf');
    Route::get('/admin/add_karyawan', [AdminController::class, 'view_add_karyawan'])->name('admin.add_karyawan');
    Route::post('/admin/add_karyawan/store', [AdminController::class, 'fadd_karyawan'])->name('admin.fadd_karyawan');
    Route::delete('/admin/delete_karyawan/{id}', [AdminController::class, 'delete_karyawan'])->name('admin.delete_karyawan');
    Route::get('/admin/add_pengunjung', [AdminController::class, 'view_add_pengunjung'])->name('admin.add_pengunjung');
    Route::post('/admin/add_pengunjung/store', [AdminController::class, 'fadd_pengunjung'])->name('admin.fadd_pengunjung');
    Route::get('/admin/update_pengunjung/{id}', [AdminController::class, 'update_pengunjung'])->name('admin.update_pengunjung');
    Route::put('/admin/fupdate_pengunjung/{id}', [AdminController::class, 'fupdate_pengunjung'])->name('admin.fupdate_pengunjung');
    Route::delete('/admin/delete_pengunjung/{id}', [AdminController::class, 'delete_pengunjung'])->name('admin.delete_pengunjung');

});

// Route untuk karyawan
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan/index', [KaryawanController::class, 'showAfterLogin'])->name('karyawan.index');
    
});
Route::get('/', [PengunjungController::class, 'showForm'])->name('index');
Route::post('/submit', [PengunjungController::class, 'submitForm'])->name('submit');