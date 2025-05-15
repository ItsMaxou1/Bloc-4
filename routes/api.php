<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{product}', [ProductController::class, 'show']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
