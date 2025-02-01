<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/user/{id}/appointments', [AdminController::class, 'userAppointments'])->name('admin.user.appointments');
    Route::get('/admin/user/{id}/appointments/create', [AdminController::class, 'createAppointment'])->name('admin.user.appointments.create');
    Route::post('/admin/user/{id}/appointments', [AdminController::class, 'storeAppointment'])->name('admin.user.appointments.store');
    Route::get('/admin/user/{userId}/appointments/{appointmentId}/edit', [AdminController::class, 'editAppointment'])->name('admin.user.appointments.edit');
    Route::put('/admin/user/{userId}/appointments/{appointmentId}', [AdminController::class, 'updateAppointment'])->name('admin.user.appointments.update');
    Route::delete('/admin/user/{userId}/appointments/{appointmentId}', [AdminController::class, 'destroyAppointment'])->name('admin.user.appointments.destroy');
});
