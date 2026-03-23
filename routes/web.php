<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController, CustomerController, LeadController, TaskController, AdminController};
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Protected by roles
    Route::middleware('role:admin|manager')->group(function () {
        // Profile Management
        Route::get('/profile', [AdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('profile.password');
        Route::resource('admin/customers', CustomerController::class)->names('admin.customers');
        Route::resource('admin/leads', LeadController::class)->names('admin.leads');
    });

    Route::middleware('role:admin|manager|sales')->group(function () {
        Route::resource('admin/tasks', TaskController::class)->names('admin.tasks');
    });
});

require __DIR__.'/auth.php';
