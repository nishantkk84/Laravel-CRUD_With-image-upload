<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// Public Home Page
Route::get('/', function () {
    return view('welcome');
});

// Protected Routes (Only logged-in users can see these)
Route::middleware(['auth'])->group(function () {

    // Dashboard Page
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Product CRUD Routes
    Route::resource('products', ProductController::class);

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/products/export/excel', [ProductController::class, 'exportExcel'])->name('products.export.excel');
Route::get('/products/export/pdf', [ProductController::class, 'exportPDF'])->name('products.export.pdf');


});

require __DIR__.'/auth.php';
