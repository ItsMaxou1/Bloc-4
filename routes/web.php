<?php

use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

// 🏠 Page d’accueil publique
Route::get('/', function () {
    return view('public'); // une vue simple genre bouton "accès admin"
});

// 🔁 Fix Laravel pour les redirections internes
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');

// 📁 Groupe admin
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('orders', [AdminOrderController::class, 'index'])
        ->name('orders.index');

    // 👁️ Formulaire de connexion sur /admin
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('login');

    // 🔐 Connexion / déconnexion
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // 🔒 Accès aux fonctionnalités admin après connexion
    Route::middleware('auth')->group(function () {

        // 🏠 Dashboard (protégé dans le contrôleur)
        Route::get('/dashboard', [AdminProductController::class, 'dashboard'])->name('welcome');

    // 📦 CRUD Produits
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');             // Liste des produits
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');     // Formulaire de création
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');             // Traitement de création
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');      // Affichage d’un produit
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit'); // Formulaire d’édition
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');  // Traitement de l’édition
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy'); // Suppression

});
