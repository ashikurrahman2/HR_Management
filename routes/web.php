<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [FrontendController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Employee & Attendance
    Route::get('/list-workers', [FrontendController::class, 'employeelist'])->name('list.works');
    Route::get('/attendance', [FrontendController::class, 'attendanceList'])->name('attendance.list');
    Route::get('/list-salary', [FrontendController::class, 'SalaryList'])->name('list.salary');
    
    // Overtime Routes
    Route::get('/over-time', [FrontendController::class, 'TimeOver'])->name('over.time');
    Route::post('/overtime/store', [FrontendController::class, 'store'])->name('overtime.store');
    Route::delete('/overtime/{id}', [FrontendController::class, 'destroy'])->name('overtime.destroy');
    Route::get('/overtime/employee/{id}', [FrontendController::class, 'getEmployeeOvertimes'])->name('overtime.employee');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';