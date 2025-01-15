<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;

// Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('admin/laporan', [AdminController::class, 'index']);
    Route::put('admin/laporan/{id}/approve', [AdminController::class, 'approve']);
    Route::put('admin/laporan/{id}/reject', [AdminController::class, 'reject']);
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
});

// Pengguna Daerah Routes
Route::middleware('auth')->group(function () {
    Route::resource('laporan', LaporanController::class);
});

// Admin Dashboard (untuk memastikan hanya yang login yang bisa akses)
Route::middleware('auth')->get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Autentikasi Routes
require __DIR__.'/auth.php';

