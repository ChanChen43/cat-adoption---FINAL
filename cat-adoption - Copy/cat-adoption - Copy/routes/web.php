<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdoptController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Livewire\AdminApplications;
use App\Http\Controllers\CatController;
use App\Http\Controllers\AdminCatController;

Route::patch('/admin/cats/{id}/status', [CatController::class, 'updateStatus'])
     ->name('admin.cats.updateStatus');

// ==============================
// Public Routes
// ==============================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/adopt', [AdoptController::class, 'index'])->name('adopt.index');
Route::get('/cats/{id}', [AdoptController::class, 'show'])->name('cats.show');

// ==============================
// User Routes (Authenticated Users)
// ==============================
Route::middleware(['auth', 'verified'])->group(function () {

    // User Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Applications
    Route::get('/applications/create/{catId}', [ApplicationController::class, 'create'])
        ->name('applications.create');
    Route::post('/applications/{catId}', [ApplicationController::class, 'store'])
        ->name('applications.store');
    Route::get('/applications', [ApplicationController::class, 'index'])
        ->name('applications.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==============================
// Admin Routes (Authenticated + AdminMiddleware)
// ==============================
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Admin Applications Management
    Route::get('/admin/applications', [AdminController::class, 'applications'])
        ->name('admin.applications.index');
Route::post('/admin/applications/{id}/update-status', [AdminController::class, 'updateStatus'])
        ->name('admin.applications.updateStatus');
    // Add other admin routes here if needed

      Route::get('/admin/cats', [AdminCatController::class, 'index'])->name('admin.cats.index');
    Route::patch('/admin/cats/{id}/status', [AdminCatController::class, 'updateStatus'])->name('admin.cats.updateStatus');
    // Show add cat form
Route::get('/admin/cats/create', [AdminCatController::class, 'create'])
     ->name('admin.cats.create');

    // Edit cat form
    Route::get('/admin/cats/{id}/edit', [AdminCatController::class, 'edit'])->name('admin.cats.edit');

    // Update cat
    Route::put('/admin/cats/{id}', [AdminCatController::class, 'update'])->name('admin.cats.update');

    // Delete cat
    Route::delete('/admin/cats/{id}', [AdminCatController::class, 'destroy'])->name('admin.cats.destroy');

// Handle form submission
Route::post('/admin/cats', [AdminCatController::class, 'store'])
     ->name('admin.cats.store');

});

// ==============================
// Authentication Routes
// ==============================
require __DIR__.'/auth.php';
