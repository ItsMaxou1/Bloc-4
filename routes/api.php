<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProductVariantController;
use App\Http\Controllers\Api\CheckoutController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::get('product_variants/{productVariant}', [ProductVariantController::class, 'show']);

Route::post('checkout/payment-intent', [CheckoutController::class, 'createPaymentIntent']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/brands', [BrandController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
