<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use Inertia\Inertia;



Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::get('registrar', function () {
    return Inertia::render('Auth/Register');
});
Route::get('registrar2', function () {
    return Inertia::render('Auth/Register2');
});

Route::get('dashboard', [PageController::class, 'dashboard'])
    ->middleware('auth:sanctum')->name('dashboard');

Route::resource('pacientes', PatientController::class)
    ->middleware('auth:sanctum');

Route::resource('tratamientos', TreatmentController::class)
    ->middleware('auth:sanctum');

Route::resource('citas', AppointmentController::class)
    ->middleware('auth:sanctum');

Route::resource('usuarios', UserController::class)
    ->middleware('auth:sanctum');

Route::get('calculadora', [PageController::class, 'calculator'])
    ->middleware('auth:sanctum')->name('calculadora');
    