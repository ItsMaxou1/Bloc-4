<?php

use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminProductController::class, 'index']);


Route::middleware(['auth', 'role:admin'])->group(function () {
    // User is authenticated and has the 'admin' role
});



