<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

// Place custom routes first
Route::get('/attendances/export-pdf', [AttendanceController::class, 'exportPdf'])->name('attendances.exportPdf');

Route::post('/attendances/{attendance}/login', [AttendanceController::class, 'login'])->name('attendances.login');

Route::post('/attendances/{attendance}/mark-status', [AttendanceController::class, 'markStatus'])->name('attendances.markStatus');

// Then the resource route last
Route::resource('attendances', AttendanceController::class);
Route::post('/attendances/reset', [AttendanceController::class, 'reset'])->name('attendances.reset');
