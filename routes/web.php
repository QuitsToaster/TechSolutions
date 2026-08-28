<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\RepairJobController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('customers', CustomerController::class);

Route::resource('appointments', AppointmentController::class);

Route::resource('suppliers', SupplierController::class);

Route::resource('parts', PartController::class);

Route::get('/repair-jobs', [RepairJobController::class, 'index'])
    ->name('repair-jobs.index');

Route::get('/repair-jobs/{repairJob}', [RepairJobController::class, 'show'])
    ->name('repair-jobs.show');

Route::post('/appointments/{appointment}/convert-to-repair-job', [RepairJobController::class, 'convertFromAppointment'])
    ->name('appointments.convert-to-repair-job');