<?php

use Illuminate\Support\Facades\Route;

// Controladores Admin
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DoctorScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])

->prefix('admin')
->name('admin.')

->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | DOCTORES
    |--------------------------------------------------------------------------
    */

    Route::resource('doctors', DoctorController::class);

    // Horarios de doctores
    Route::get(
        'doctors/{doctor}/schedule',
        [DoctorScheduleController::class, 'edit']
    )->name('doctors.schedule');

    Route::post(
        'doctors/{doctor}/schedule',
        [DoctorScheduleController::class, 'update']
    )->name('doctors.schedule.update');

    /*
    |--------------------------------------------------------------------------
    | CITAS MÉDICAS
    |--------------------------------------------------------------------------
    */

    Route::resource('appointments', AppointmentController::class);

});