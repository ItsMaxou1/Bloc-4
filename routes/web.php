<?php

use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminProductController::class, 'index'])->name('admin.products.index');


Route::middleware(['auth', 'role:admin'])->group(function () {
    // User is authenticated and has the 'admin' role+
    Route::get('/admin-product', [AdminProductController::class, 'index']);
    Route::get('/admin-store', [AdminProductController::class, 'store']);

});



