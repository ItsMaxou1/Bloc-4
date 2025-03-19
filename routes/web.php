<?php

use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;


// Admin routes

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
});


