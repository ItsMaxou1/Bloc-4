<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProductController;

// Redirection vers le dashboard admin
Route::redirect('/', '/admin');

// Routes admin temporairement sans middleware (auth désactivé pour le dev)
Route::prefix('admin')->name('admin.')->group(function () {

    // 🔒 Pour remettre la protection plus tard :
    // Route::middleware(['auth', 'role:admin'])->group(function () {
    //     Route::get('/', [AdminProductController::class, 'dashboard'])->name('welcome');
    //
    //     Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    //     Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    //     Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    // });

    // 🔓 Routes accessibles sans authentification (temporairement)
    Route::get('/', [AdminProductController::class, 'dashboard'])->name('welcome');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
});
