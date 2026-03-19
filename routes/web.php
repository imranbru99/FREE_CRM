<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'));

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Group
    Route::prefix('admin')->as('admin.')->group(function () {

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        // Customers
        Route::middleware(['role:admin|manager', 'permission:view customers'])->group(function () {
            Route::resource('customers', CustomerController::class);
        });

        // Leads
        Route::middleware(['role:admin|manager', 'permission:view leads'])->group(function () {
            Route::resource('leads', LeadController::class);
        });

        // Tasks
        Route::middleware(['role:admin|manager|sales', 'permission:view tasks'])->group(function () {
            Route::resource('tasks', TaskController::class);
        });

    });
});
